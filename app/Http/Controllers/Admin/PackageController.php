<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created package.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:packages,name',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|integer|min:1',
            'duration_unit' => 'nullable|in:days,months,years',
            'service_limit' => 'nullable|integer|min:0',
            'image_upload_limit' => 'nullable|integer|min:0',
            'appear_in_search' => 'nullable|string|max:50',
            'lead_enquiries' => 'nullable|string|max:50',
            'response_rate' => 'nullable|string|max:50',
            'customer_support' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $package = Package::create([
                'name' => $request->name,
                'price' => $request->price,
                'business_listing' => $request->boolean('business_listing'),
                'profile_page_with_contact' => $request->boolean('profile_page_with_contact'),
                'business_logo_banner' => $request->boolean('business_logo_banner'),
                'service_limit' => $request->service_limit,
                'duration' => $request->duration,
                'duration_unit' => $request->duration_unit,
                'image_upload_limit' => $request->image_upload_limit,
                'video_upload' => $request->boolean('video_upload'),
                'appear_in_search' => $request->appear_in_search,
                'verified_badge' => $request->boolean('verified_badge'),
                'premium_badge' => $request->boolean('premium_badge'),
                'lead_enquiries' => $request->lead_enquiries,
                'response_rate' => $request->response_rate,
                'featured_in_top' => $request->boolean('featured_in_top'),
                'customer_support' => $request->customer_support,
                'lead_alerts' => $request->boolean('lead_alerts'),
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Package created successfully!',
                'data' => $package
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Package store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving the package.'
            ], 500);
        }
    }


    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }


    public function update(Request $request, $id)
    {
        try {
            $package = Package::findOrFail($id);

            // ✅ Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'duration' => 'nullable|integer|min:1',
                'duration_unit' => 'nullable|in:days,months,years',
                'service_limit' => 'nullable|integer|min:0',
                'image_upload_limit' => 'nullable|integer|min:0',
                'appear_in_search' => 'nullable|string|max:50',
                'lead_enquiries' => 'nullable|string|max:50',
                'response_rate' => 'nullable|string|max:50',
                'customer_support' => 'nullable|string|max:50',
                'description' => 'nullable|string',
            ]);

            // ✅ Handle all boolean fields
            $booleanFields = [
                'business_listing',
                'profile_page_with_contact',
                'business_logo_banner',
                'video_upload',
                'verified_badge',
                'premium_badge',
                'featured_in_top',
                'lead_alerts',
                'is_active',
            ];

            foreach ($booleanFields as $field) {
                $validated[$field] = $request->has($field) && $request->$field == 'on' ? true : false;
            }

            // ✅ Update record
            $package->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Package updated successfully!'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

}
