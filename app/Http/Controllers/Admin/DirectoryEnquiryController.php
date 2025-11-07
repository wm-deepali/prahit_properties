<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessEnquiry;
use Illuminate\Http\Request;

class DirectoryEnquiryController extends Controller
{
    /**
     * Display a listing of the directory enquiries.
     */
    public function index()
    {
        // Load enquiries with related business and paginate
        $enquiries = BusinessEnquiry::with('business')
            ->whereHas('business')
            ->latest()->paginate(10);

        // Attach matched user to each enquiry manually
        $enquiries->getCollection()->transform(function ($enquiry) {
            $enquiry->user = \App\Models\User::where('email', $enquiry->email)
                ->orWhere('mobile_number', $enquiry->mobile)
                ->first();
            return $enquiry;
        });

        // Debug check (optional)
        // dd($enquiries->toArray());

        return view('admin.directory-enquiries.index', compact('enquiries'));
    }


    /**
     * Display a single enquiry (optional).
     */
    public function show($id)
    {
        $enquiry = BusinessEnquiry::with('business')->findOrFail($id);
        return view('admin.directory-enquiries.show', compact('enquiry'));
    }

    /**
     * Delete an enquiry.
     */
    public function destroy($id)
    {
        $enquiry = BusinessEnquiry::findOrFail($id);
        $enquiry->delete();

        return response()->json(['status' => 200, 'message' => 'Review deleted successfully.']);
    }
}
