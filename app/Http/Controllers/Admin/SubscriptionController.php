<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription; // Your Subscription model
use Barryvdh\DomPDF\Facade\Pdf;
class SubscriptionController extends Controller
{
    // List all subscriptions with related user data
    public function index()
    {
        $subscriptions = Subscription::with('user', 'package')->paginate(10);

        // Iterate through the current page of subscriptions to check expiration
        foreach ($subscriptions as $subscription) {
            if ($subscription->end_date && now()->gt($subscription->end_date) && $subscription->is_active) {
                // Mark as inactive if expired
                $subscription->is_active = 0;
                $subscription->save();
            }
        }

        // Re-fetch with updated status after any changes (optional, or just return as is)
        $subscriptions = Subscription::with('user', 'package')->paginate(10);

        return view('admin.subscriptions.index', compact('subscriptions'));
    }


    // Show details of a specific subscription
    public function show($id)
    {
        $subscription = Subscription::with('user', 'package')->findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function payments()
    {
        // Fetch latest payments with user + subscription
        $payments = Payment::with(['user', 'subscription'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    public function paymentShow($id)
    {
        $payment = Payment::with(['user', 'package'])->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }


    public function showInvoice($id)
    {
        // Load payment with invoice and user details
        $payment = Payment::with(['invoice', 'user', 'subscription'])
            ->findOrFail($id);

        // If no invoice exists
        if (!$payment->invoice) {
            return redirect()->back()->with('error', 'Invoice not found for this payment.');
        }

        $invoice = $payment->invoice;

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 180);
        // Generate PDF
        $pdf = PDF::loadView('admin.payments.invoice', compact('payment', 'invoice'))
            ->setPaper('A4', 'portrait');

        $filename = 'Invoice-' . $invoice->invoice_number . '.pdf';

        // Download file
        return $pdf->download($filename);
    }

}
