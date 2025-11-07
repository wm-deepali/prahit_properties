<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessListingReview;
use Illuminate\Http\Request;

class BusinessListingReviewController extends Controller
{
    /**
     * Display all business listing reviews.
     */
    public function index()
    {
        // Load reviews with business listing and user info
        $reviews = BusinessListingReview::with(['businessListing', 'user'])
            ->whereHas('businessListing.user') // ensures user exists
            ->latest()
            ->paginate(10);
            

        return view('admin.business-listing-reviews.index', compact('reviews'));
    }

    /**
     * Show a single review.
     */
    public function show($id)
    {
        $review = BusinessListingReview::with(['businessListing', 'user'])->find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Review fetched successfully.',
            'data' => $review
        ]);
    }


    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = BusinessListingReview::findOrFail($id);
        $review->delete();

        return response()->json(['status' => 200, 'message' => 'Review deleted successfully.']);
    }

    public function userIndex()
    {
        $reviews = BusinessListingReview::with(['businessListing', 'user'])
            // ->whereHas('businessListing', function ($q) {
            //     $q->where('user_id', auth()->id());
            // })
            ->latest()
            ->paginate(10);

        return view('front.user.services.listing-review', compact('reviews'));
    }


}
