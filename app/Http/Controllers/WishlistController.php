<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Toggle wishlist (add/remove property)
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'property_id' => 'required|integer',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', $user->id)
            ->where('property_id', $request->property_id)
            ->exists();

        if ($exists) {
            // Remove from wishlist
            Wishlist::where('user_id', $user->id)
                ->where('property_id', $request->property_id)
                ->delete();

            return response()->json(['added' => false, 'message' => 'Removed from wishlist']);
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'property_id' => $request->property_id,
            ]);

            return response()->json(['added' => true, 'message' => 'Added to wishlist']);
        }
    }

    /**
     * Show all wishlist properties for logged-in user
     */
    public function myWishlist()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        // Eager load property relationships if needed
        $wishlistItems = Wishlist::with(['property.getCity', 'property.Category', 'property.SubCategory'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        return view('front.user.my-wishlist', compact('wishlistItems'));
    }
}
