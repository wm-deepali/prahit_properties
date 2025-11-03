<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BusinessEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessWishlist;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    /**
     * Show list of user's services.
     */
    public function index()
    {
        $user = Auth::user();

        $services = [];
        return view('front.user.services.index', compact('services'));
    }

    /**
     * Show received service inquiries.
     */
    public function receivedInquiries()
    {
        $user = Auth::user();

        $inquiries = BusinessEnquiry::with('business')
            ->where(function ($query) use ($user) {
                $query->where('email', 'kjnkjn')
                    ->orWhere('mobile', 'mbn');
            })
            ->latest()
            ->get();

        // Count stats
        $currentMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $lastMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $totalCount = $inquiries->count();


        return view('front.user.services.received-inquiries', compact('inquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
    }

    /**
     * Show inquiries sent by the user.
     */
    public function sentInquiries()
    {
        $user = Auth::user();

        $inquiries = BusinessEnquiry::with('business')
            ->where(function ($query) use ($user) {
                $query->where('email', $user->email)
                    ->orWhere('mobile', $user->mobile_number);
            })
            ->latest()
            ->get();

        // Count stats
        $currentMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $lastMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $totalCount = $inquiries->count();

        return view('front.user.services.sent-inquiries', compact('inquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
    }

    /**
     * Show user's service wishlist.
     */
    public function wishlist()
    {
        $user = Auth::user();

        // You may need to adjust based on wishlist table structure
        $wishlist = BusinessWishlist::where('user_id', $user->id)
            ->with('business')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.user.services.wishlist', compact('wishlist'));
    }
}
