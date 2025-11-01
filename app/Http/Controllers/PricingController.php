<?php

namespace App\Http\Controllers;

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

class PricingController extends Controller
{
    /**
     * Show all active packages on pricing page
     */
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->orderBy('price', 'asc')
            ->get();

        return view('front.user.pricing', compact('packages'));
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

            // Determine start & end date
            $start_date = Carbon::now();
            $end_date = null;

            if ($package->duration && $package->duration_unit) {
                $unit = strtolower($package->duration_unit);
                switch ($unit) {
                    case 'day':
                    case 'days':
                        $end_date = $start_date->copy()->addDays($package->duration);
                        break;
                    case 'month':
                    case 'months':
                        $end_date = $start_date->copy()->addMonths($package->duration);
                        break;
                    case 'year':
                    case 'years':
                        $end_date = $start_date->copy()->addYears($package->duration);
                        break;
                    default:
                        $end_date = $start_date->copy()->addMonths(1);
                }
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

    public function subscriptions()
    {
        $user = Auth::user();

        $currentSubscriptions = Subscription::with(['package', 'user'])
            ->where('user_id', $user->id)
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', Carbon::now());
            })
            ->get();

        $subscriptionHistory = Subscription::with(['package', 'invoice'])
            ->where('user_id', $user->id)
            // ->where(function ($q) {
            //     $q->where('is_active', 0)
            //         ->orWhere('end_date', '<', now());
            // })
            ->get();

        return view('front.user.current-subscriptions', compact('currentSubscriptions', 'subscriptionHistory'));
    }

    public function invoices()
    {
        $user = Auth::user();

        // Get all invoices that belong to the logged-in user
        $invoices = Invoice::with(['subscription.package'])
            ->whereHas('subscription', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.user.invoice', compact('invoices'));
    }

    public function invoiceDetails($subscriptionId)
    {
        $subscription = Subscription::with(['user', 'package', 'payment'])
            ->findOrFail($subscriptionId);

        $user = $subscription->user;

        return view('front.user.invoice-details', compact('subscription', 'user'));
    }

    
}
