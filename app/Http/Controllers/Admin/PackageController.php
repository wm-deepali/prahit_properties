<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // Validate common fields
        $validator = Validator::make($request->all(), [
            'package_type' => 'required|in:property,service',
            'name' => 'required|string|max:255|unique:packages,name',
            'price' => 'required|string|max:255',
            'validity_number' => 'required|integer|min:1',
            'validity_unit' => 'required|in:Days,Months,Years',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            // Combine validity data
            $validityNumber = $request->input('validity_number');
            $validityUnit = $request->input('validity_unit');
            $validity = $validityNumber . ' ' . $validityUnit; // e.g., "30 Days"

            $data = [
                'package_type' => $request->package_type,
                'name' => $request->name,
                'price' => $request->price,
                'validity' => $validity,
                'description' => $request->description,
                'is_active' => $request->boolean('is_active', true),
            ];

            // PROPERTY PACKAGE
            if ($request->package_type === 'property') {
                $data = array_merge($data, [
                    'number_of_listing' => $request->number_of_listing,
                    'photos_per_listing' => $request->photos_per_listing,
                    'video_upload' => $request->video_upload,
                    'response_rate' => $request->response_rate,
                    'property_visibility' => $request->property_visibility,
                    'verified_tag' => $request->verified_tag,
                    'premium_seller' => $request->premium_seller,
                    'profile_page' => $request->profile_page,
                    'profile_visibility' => $request->profile_visibility,
                    'profile_in_search_result' => $request->profile_in_search_result,
                    'priority_in_search' => $request->priority_in_search,
                    'customer_support' => $request->customer_support,
                    'lead_alerts' => $request->lead_alerts,
                ]);
            }

            // SERVICE PROVIDER PACKAGE
            if ($request->package_type === 'service') {
                $data = array_merge($data, [
                    'business_listing' => $request->business_listing,
                    'total_services' => $request->total_services,
                    'profile_page_with_contact' => $request->profile_page_with_contact,
                    'business_logo_banner' => $request->business_logo_banner,
                    'appear_in_local_search' => $request->appear_in_local_search,
                    'verified_badge' => $request->verified_badge,
                    'premium_badge' => $request->premium_badge,
                    'image_upload_limit' => $request->image_upload_limit,
                    'video_upload_service' => $request->video_upload_service,
                    'lead_enquiries' => $request->lead_enquiries,
                    'response_rate_service' => $request->response_rate_service,
                    'featured_in_top_provider' => $request->featured_in_top_provider,
                    'customer_support_service' => $request->customer_support_service,
                    'lead_alerts' => $request->lead_alerts,
                ]);
            }

            $package = Package::create($data);

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
        $package = Package::findOrFail($id);

        $rules = [
            'package_type' => ['required', Rule::in(['property', 'service'])],
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:100',
            'validity_number' => 'required|integer|min:1',
            'validity_unit' => 'required|in:Days,Months,Years',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];

        // Add type-specific validation
        if ($request->package_type === 'property') {
            $rules = array_merge($rules, [
                'number_of_listing' => 'nullable|integer',
                'photos_per_listing' => 'nullable|integer',
                'video_upload' => 'nullable|string',
                'response_rate' => 'nullable|string',
                'property_visibility' => 'nullable|string',
                'verified_tag' => 'nullable|string',
                'premium_seller' => 'nullable|string',
                'profile_page' => 'nullable|string',
                'profile_visibility' => 'nullable|string',
                'profile_in_search_result' => 'nullable|string',
                'priority_in_search' => 'nullable|string',
                'customer_support' => 'nullable|string',
                'lead_alerts' => 'nullable|string',
            ]);
        } elseif ($request->package_type === 'service') {
            $rules = array_merge($rules, [
                'business_listing' => 'nullable|string',
                'total_services' => 'nullable|integer',
                'profile_page_with_contact' => 'nullable|string',
                'business_logo_banner' => 'nullable|string',
                'appear_in_local_search' => 'nullable|string',
                'verified_badge' => 'nullable|string',
                'premium_badge' => 'nullable|string',
                'image_upload_limit' => 'nullable|integer',
                'video_upload_service' => 'nullable|string',
                'lead_enquiries' => 'nullable|string',
                'response_rate_service' => 'nullable|string',
                'featured_in_top_provider' => 'nullable|string',
                'customer_support_service' => 'nullable|string',
                'lead_alerts' => 'nullable|string',
            ]);
        }

        $validated = $request->validate($rules);
        // Save combined validity
        $validityNumber = $validated['validity_number'];
        $validityUnit = $validated['validity_unit'];
        $validated['validity'] = $validityNumber . ' ' . $validityUnit;

        // Remove individual validity fields after merging
        unset($validated['validity_number'], $validated['validity_unit']);

        // ✅ Update package
        $package->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Package updated successfully.',
        ]);
    }

    /**
     * Delete the specified package.
     */
    public function destroy($id)
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found.',
            ], 404);
        }

        $package->delete();

        return response()->json([
            'success' => true,
            'message' => 'Package deleted successfully.',
        ]);
    }

}
