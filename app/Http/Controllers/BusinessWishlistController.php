<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessWishlist;

class BusinessWishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }

        $businessId = $request->input('business_listing_id');

        $wishlist = BusinessWishlist::where('user_id', $user->id)
            ->where('business_listing_id', $businessId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            BusinessWishlist::create([
                'user_id' => $user->id,
                'business_listing_id' => $businessId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
