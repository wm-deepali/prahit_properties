<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Invoice;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;

class PricingController extends Controller
{
    /**
     * Show all active packages on pricing page
     */
    public function index(Request $request)
    {
        $packageType = $request->query('type', 'property');  // default to property
        $packages = Package::where('is_active', true)
            ->where('package_type', $packageType)
            ->orderBy('price', 'asc')->get();

        return view('front.user.pricing', compact('packages', 'packageType'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); // ✅ Start transaction

        try {
            $user = Auth::user();

            // Validate request
            $request->validate([
                'package_id' => 'required|exists:packages,id',
                'payment_method' => 'required|string',
                'razorpay_payment_id' => 'required|string',
            ]);

            $package = Package::findOrFail($request->package_id);

            // 🧪 TEST MODE SWITCH
            $testMode = true; // change to false when using live Razorpay

            if ($testMode) {
                // Fake Razorpay payment object
                $payment = (object) [
                    'id' => $request->razorpay_payment_id ?: 'test_' . strtoupper(Str::random(10)),
                    'status' => 'captured',
                    'toArray' => fn() => [
                        'id' => 'test_' . strtoupper(Str::random(10)),
                        'entity' => 'payment',
                        'amount' => $package->price * 100,
                        'currency' => 'INR',
                        'status' => 'captured',
                        'method' => 'test',
                        'description' => 'Simulated test payment'
                    ]
                ];
            } else {
                // Verify Razorpay Payment (Live mode)
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $payment = $api->payment->fetch($request->razorpay_payment_id);

                if (!$payment || $payment->status !== 'captured') {
                    return response()->json(['success' => false, 'message' => 'Payment not verified.'], 400);
                }
            }

            $start_date = Carbon::now();
            $end_date = null;

            if (!empty($package->validity)) {
                // Split validity string into number and unit, e.g. "30 Days"
                $parts = explode(' ', $package->validity, 2);
                $number = intval($parts[0]);
                $unit = strtolower($parts[1] ?? '');

                switch ($unit) {
                    case 'day':
                    case 'days':
                        $end_date = $start_date->copy()->addDays($number);
                        break;
                    case 'month':
                    case 'months':
                        $end_date = $start_date->copy()->addMonths($number);
                        break;
                    case 'year':
                    case 'years':
                        $end_date = $start_date->copy()->addYears($number);
                        break;
                    default:
                        $end_date = $start_date->copy()->addMonths(1); // default fallback
                        break;
                }
            } else {
                // fallback if validity string empty or missing
                $end_date = $start_date->copy()->addMonths(1);
            }

            // Create Subscription
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'amount' => $package->price,
                'payment_status' => 'paid',
                'transaction_id' => $payment->id,
                'is_active' => 1,
            ]);

            // Create Payment Record
            $paymentRecord = Payment::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'subscription_id' => $subscription->id,
                'payment_method' => 'razorpay',
                'transaction_id' => $payment->id,
                'amount' => $package->price,
                'currency' => 'INR',
                'status' => $payment->status === 'captured' ? 'success' : 'pending',
                'payment_response' => is_callable([$payment, 'toArray']) ? $payment->toArray() : [],
            ]);

            // Generate Invoice
            $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'payment_id' => $paymentRecord->id,
                'invoice_number' => $invoiceNumber,
                'invoice_date' => Carbon::now(),
                'amount' => $package->price,
                'currency' => 'INR',
                'tax_amount' => round($package->price * 0.18, 2), // Example: 18% GST
                'total_amount' => round($package->price * 1.18, 2),
                'billing_name' => $user->name,
                'billing_email' => $user->email,
                'billing_phone' => $user->phone ?? '',
                'billing_address' => $user->address ?? '',
                'status' => 'paid',
            ]);

            DB::commit(); // ✅ Commit all inserts

            return response()->json([
                'success' => true,
                'message' => $testMode
                    ? '✅ Test subscription activated successfully!'
                    : 'Subscription activated successfully!',
                'subscription' => $subscription,
                'invoice' => $invoice
            ]);

        } catch (Exception $e) {
            DB::rollBack(); // ❌ Undo all changes if any error
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function subscriptions(Request $request)
    {
        $user = Auth::user();
        $type = $request->query('type', 'property'); // Get 'type' query param or default to 'property'

        // Current active subscriptions filtered by package_type
        $currentSubscriptions = Subscription::with(['package', 'user'])
            ->where('user_id', $user->id)
            ->whereHas('package', function ($query) use ($type) {
                $query->where('package_type', $type);
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', Carbon::now());
            })
            ->get();

        // Subscription history filtered by package_type
        $subscriptionHistory = Subscription::with(['package', 'invoice'])
            ->where('user_id', $user->id)
            ->whereHas('package', function ($query) use ($type) {
                $query->where('package_type', $type);
            })
            ->get();

        foreach ($currentSubscriptions as $sub) {
            // Property Subscription Usage
            if ($sub->package->package_type === 'property') {
                $sub->used_listings = $user->getProperties()
                    ->where('created_at', '>=', $sub->start_date)
                    ->count();
            }
        }

        $availablePackages = Package::where('package_type', $type)->where('price', '>', $currentSubscriptions->first()?->package?->price ?? 0)->get();

        return view('front.user.current-subscriptions', compact('currentSubscriptions', 'subscriptionHistory', 'type', 'availablePackages'));
    }

    public function payments(Request $request)
    {
        $user = Auth::user();
        $type = $request->query('type', 'property');

        $invoices = Invoice::with(['subscription.package'])
            ->whereHas('subscription', function ($query) use ($user, $type) {
                $query->where('user_id', $user->id);
                if ($type) {
                    $query->whereHas('package', function ($query) use ($type) {
                        $query->where('package_type', $type);
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.user.payments', compact('invoices', 'type'));
    }

    public function invoiceDetails($subscriptionId)
    {
        $subscription = Subscription::with(['user', 'package', 'payment'])
            ->findOrFail($subscriptionId);

        $user = $subscription->user;

        return view('front.user.invoice', compact('subscription', 'user'));
    }

    public function downloadInvoicePDF($invoiceId)
    {
        $invoice = Invoice::with(['subscription.package', 'user'])->findOrFail($invoiceId);

        // Load a view for invoice PDF generation
        $pdf = PDF::loadView('front.user.invoice_pdf', compact('invoice'));

        // Return downloadable PDF file named by invoice number
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function downloadAllInvoices()
    {
        $user = Auth::user();

        // Fetch all invoices for the user with relations
        $invoices = Invoice::with(['subscription.package'])
            ->whereHas('subscription', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Generate PDF with a custom blade view that lists all invoices
        $pdf = PDF::loadView('front.user.invoices_all_pdf', compact('invoices', 'user'));

        // Return the PDF for download
        return $pdf->download('All_Invoices_' . $user->id . '.pdf');
    }

    public function renew(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            // ✅ Validate request
            $request->validate([
                'subscription_id' => 'required|exists:subscriptions,id',
                'payment_method' => 'required|string',
                'razorpay_payment_id' => 'required|string',
            ]);

            // ✅ Fetch old subscription and related package
            $oldSubscription = Subscription::with('package')->findOrFail($request->subscription_id);
            $package = $oldSubscription->package;

            // 🔹 Test Mode (change to false for live)
            $testMode = true;

            if ($testMode) {
                $payment = (object) [
                    'id' => $request->razorpay_payment_id ?: 'test_' . strtoupper(Str::random(10)),
                    'status' => 'captured',
                    'toArray' => fn() => [
                        'id' => 'test_' . strtoupper(Str::random(10)),
                        'entity' => 'payment',
                        'amount' => $package->price * 100,
                        'currency' => 'INR',
                        'status' => 'captured',
                        'method' => 'test',
                        'description' => 'Simulated renewal test payment'
                    ]
                ];
            } else {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $payment = $api->payment->fetch($request->razorpay_payment_id);

                if (!$payment || $payment->status !== 'captured') {
                    return response()->json(['success' => false, 'message' => 'Payment not verified.'], 400);
                }
            }

            // ✅ Calculate new validity period
            $start_date = Carbon::now();
            $end_date = null;

            if (!empty($package->validity)) {
                $parts = explode(' ', $package->validity, 2);
                $number = intval($parts[0]);
                $unit = strtolower($parts[1] ?? '');

                switch ($unit) {
                    case 'day':
                    case 'days':
                        $end_date = $start_date->copy()->addDays($number);
                        break;
                    case 'month':
                    case 'months':
                        $end_date = $start_date->copy()->addMonths($number);
                        break;
                    case 'year':
                    case 'years':
                        $end_date = $start_date->copy()->addYears($number);
                        break;
                    default:
                        $end_date = $start_date->copy()->addMonths(1);
                        break;
                }
            } else {
                $end_date = $start_date->copy()->addMonths(1);
            }

            // ✅ Create new renewed subscription
            $newSubscription = Subscription::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'amount' => $package->price,
                'payment_status' => 'paid',
                'transaction_id' => $payment->id,
                'is_active' => 1,
            ]);

            // Deactivate old subscription
            $oldSubscription->update(['is_active' => 0]);

            // ✅ Create new Payment record
            $paymentRecord = Payment::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'subscription_id' => $newSubscription->id,
                'payment_method' => 'razorpay',
                'transaction_id' => $payment->id,
                'amount' => $package->price,
                'currency' => 'INR',
                'status' => $payment->status === 'captured' ? 'success' : 'pending',
                'payment_response' => is_callable([$payment, 'toArray']) ? $payment->toArray() : [],
            ]);

            // ✅ Generate invoice
            $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'subscription_id' => $newSubscription->id,
                'payment_id' => $paymentRecord->id,
                'invoice_number' => $invoiceNumber,
                'invoice_date' => Carbon::now(),
                'amount' => $package->price,
                'currency' => 'INR',
                'tax_amount' => 0,
                'total_amount' => $package->price,
                'billing_name' => $user->name,
                'billing_email' => $user->email,
                'billing_phone' => $user->phone ?? '',
                'billing_address' => $user->address ?? '',
                'status' => 'paid',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Subscription renewed successfully!',
                'subscription' => $newSubscription,
                'invoice' => $invoice,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function upgrade(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            // ✅ Validate input
            $request->validate([
                'current_subscription_id' => 'required|exists:subscriptions,id',
                'new_package_id' => 'required|exists:packages,id',
                'payment_method' => 'required|string',
                'razorpay_payment_id' => 'required|string',
            ]);

            $oldSubscription = Subscription::with('package')->findOrFail($request->current_subscription_id);
            $newPackage = Package::findOrFail($request->new_package_id);

            // 🧠 Optional: Prevent downgrading
            if ($newPackage->price <= $oldSubscription->package->price) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only upgrade to a higher-priced plan.'
                ], 400);
            }

            // 🔹 Test mode toggle
            $testMode = true;

            if ($testMode) {
                $payment = (object) [
                    'id' => $request->razorpay_payment_id ?: 'test_' . strtoupper(Str::random(10)),
                    'status' => 'captured',
                    'toArray' => fn() => [
                        'id' => 'test_' . strtoupper(Str::random(10)),
                        'entity' => 'payment',
                        'amount' => $newPackage->price * 100,
                        'currency' => 'INR',
                        'status' => 'captured',
                        'method' => 'test',
                        'description' => 'Simulated upgrade test payment'
                    ]
                ];
            } else {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $payment = $api->payment->fetch($request->razorpay_payment_id);

                if (!$payment || $payment->status !== 'captured') {
                    return response()->json(['success' => false, 'message' => 'Payment not verified.'], 400);
                }
            }

            // ✅ Calculate validity
            $start_date = Carbon::now();
            $end_date = null;

            if (!empty($newPackage->validity)) {
                $parts = explode(' ', $newPackage->validity, 2);
                $number = intval($parts[0]);
                $unit = strtolower($parts[1] ?? '');

                switch ($unit) {
                    case 'day':
                    case 'days':
                        $end_date = $start_date->copy()->addDays($number);
                        break;
                    case 'month':
                    case 'months':
                        $end_date = $start_date->copy()->addMonths($number);
                        break;
                    case 'year':
                    case 'years':
                        $end_date = $start_date->copy()->addYears($number);
                        break;
                    default:
                        $end_date = $start_date->copy()->addMonths(1);
                        break;
                }
            } else {
                $end_date = $start_date->copy()->addMonths(1);
            }

            // ✅ Deactivate old subscription
            $oldSubscription->update(['is_active' => 0]);

            // ✅ Create new upgraded subscription
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'package_id' => $newPackage->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'amount' => $newPackage->price,
                'payment_status' => 'paid',
                'transaction_id' => $payment->id,
                'is_active' => 1,
            ]);

            // ✅ Create payment record
            $paymentRecord = Payment::create([
                'user_id' => $user->id,
                'package_id' => $newPackage->id,
                'subscription_id' => $subscription->id,
                'payment_method' => $request->payment_method,
                'transaction_id' => $payment->id,
                'amount' => $newPackage->price,
                'currency' => 'INR',
                'status' => $payment->status === 'captured' ? 'success' : 'pending',
                'payment_response' => is_callable([$payment, 'toArray']) ? $payment->toArray() : [],
            ]);

            // ✅ Generate invoice
            $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'payment_id' => $paymentRecord->id,
                'invoice_number' => $invoiceNumber,
                'invoice_date' => Carbon::now(),
                'amount' => $newPackage->price,
                'currency' => 'INR',
                'tax_amount' => round($newPackage->price * 0.18, 2),
                'total_amount' => round($newPackage->price * 1.18, 2),
                'billing_name' => $user->name,
                'billing_email' => $user->email,
                'billing_phone' => $user->phone ?? '',
                'billing_address' => $user->address ?? '',
                'status' => 'paid',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Subscription upgraded successfully!',
                'subscription' => $subscription,
                'invoice' => $invoice,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }



}
