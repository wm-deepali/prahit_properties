<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription; // Your Subscription model

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
}
