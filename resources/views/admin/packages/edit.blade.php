@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            {{-- Breadcrumb --}}
            <section class="breadcrumb-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="content-header">
                                <h3 class="content-header-title">Edit Package</h3>
                                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-save">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Packages</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Package</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Edit Package Form --}}
            <section class="content-main-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Update Package</h5>
                                </div>
                                <div class="card-body">
                                    <form id="packageForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            {{-- PACKAGE TYPE --}}
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="package_type" id="package_type" class="form-control" required>
                                                    <option value="">Select Type</option>
                                                    <option value="property" {{ $package->package_type == 'property' ? 'selected' : '' }}>Property Package</option>
                                                    <option value="service" {{ $package->package_type == 'service' ? 'selected' : '' }}>Service Provider Package</option>
                                                </select>
                                            </div>

                                            {{-- COMMON FIELDS --}}
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" required
                                                    value="{{ $package->name }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Price (₹) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="price" class="form-control"
                                                    value="{{ $package->price }}" placeholder="e.g., 1,999/- for 3 Months"
                                                    required>
                                            </div>


                                            @php 
                                            $validityNumber = null;
                                                $validityUnit = null;

                                                if (!empty($package->validity)) {
                                                    $parts = explode(' ', $package->validity, 2);
                                                    $validityNumber = $parts[0] ?? null;
                                                    $validityUnit = $parts[1] ?? null;
                                                }
                                            @endphp

                                            <div class="col-md-2 mb-3">
                                                <label class="form-label">Validity</label>
                                                <input type="number" name="validity_number" class="form-control" min="1"
                                                    required value="{{ old('validity_number', $validityNumber) }}"
                                                    placeholder="e.g., 30">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label">Unit</label>
                                                <select name="validity_unit" class="form-control" required>
                                                    <option value="Days" {{ (old('validity_unit', $validityUnit) == 'Days') ? 'selected' : '' }}>Days</option>
                                                    <option value="Months" {{ (old('validity_unit', $validityUnit) == 'Months') ? 'selected' : '' }}>Months</option>
                                                    <option value="Years" {{ (old('validity_unit', $validityUnit) == 'Years') ? 'selected' : '' }}>Years</option>
                                                </select>
                                            </div>


                                            {{-- PROPERTY PACKAGE FIELDS --}}
                                            <div id="property_fields" style="display:none;margin:15px;">
                                                <h5 class="mt-4 text-primary">Property Package Details</h5>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label>Number of Listing</label>
                                                        <input type="number" name="number_of_listing" class="form-control"
                                                            value="{{ $package->number_of_listing }}">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Photos per Listing</label>
                                                        <input type="number" name="photos_per_listing" class="form-control"
                                                            value="{{ $package->photos_per_listing }}">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Video Upload</label>
                                                        <select name="video_upload" class="form-control">
                                                            <option value="Not Allowed" {{ $package->video_upload == 'Not Allowed' ? 'selected' : '' }}>Not Allowed</option>
                                                            <option value="Yes" {{ $package->video_upload == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Response Rate</label>
                                                        <select name="response_rate" class="form-control">
                                                            @foreach (['Normal', 'Standard', 'Upto 2 times more', 'Upto 4 times more'] as $option)
                                                                <option value="{{ $option }}" {{ $package->response_rate == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Property Visibility</label>
                                                        <select name="property_visibility" class="form-control">
                                                            @foreach (['Normal', 'Medium', 'High', 'Top Priority'] as $option)
                                                                <option value="{{ $option }}" {{ $package->property_visibility == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Verified Tag</label>
                                                        <select name="verified_tag" class="form-control">
                                                            <option value="Yes" {{ $package->verified_tag == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->verified_tag == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Premium Seller</label>
                                                        <select name="premium_seller" class="form-control">
                                                            <option value="Yes" {{ $package->premium_seller == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->premium_seller == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Page</label>
                                                        <select name="profile_page" class="form-control">
                                                            <option value="Yes" {{ $package->profile_page == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->profile_page == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Visibility</label>
                                                        <select name="profile_visibility" class="form-control">
                                                            @foreach (['No', 'Normal', 'Featured'] as $option)
                                                                <option value="{{ $option }}" {{ $package->profile_visibility == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile in Search Result</label>
                                                        <select name="profile_in_search_result" class="form-control">
                                                            <option value="Yes" {{ $package->profile_in_search_result == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->profile_in_search_result == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Priority in Search Results</label>
                                                        <select name="priority_in_search" class="form-control">
                                                            @foreach (['No', 'Medium', 'High', 'Top Priority'] as $option)
                                                                <option value="{{ $option }}" {{ $package->priority_in_search == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Customer Support</label>
                                                        <select name="customer_support" class="form-control">
                                                            @foreach (['Email', 'Email & Phone', 'Email / Phone / Chat', 'Dedicated'] as $option)
                                                                <option value="{{ $option }}" {{ $package->customer_support == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Alerts via SMS/Email</label>
                                                        <select name="lead_alerts" class="form-control">
                                                            <option value="Yes" {{ $package->lead_alerts == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->lead_alerts == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- SERVICE PROVIDER PACKAGE FIELDS --}}
                                            <div id="service_fields" style="display:none;margin:15px;">
                                                <h5 class="mt-4 text-primary">Service Provider Package Details</h5>
                                                <hr>
                                                <div class="row">
                                                    {{-- repeat same structure as Add form, but with selected values --}}
                                                    @php
                                                        $serviceFields = [
                                                            'business_listing',
                                                            'profile_page_with_contact',
                                                            'business_logo_banner',
                                                            'verified_badge',
                                                            'premium_badge',
                                                            'featured_in_top_provider',
                                                            'lead_alerts'
                                                        ];
                                                    @endphp

                                                    <div class="col-md-4 mb-3">
                                                        <label>Business Listing</label>
                                                        <select name="business_listing" class="form-control">
                                                            <option value="Yes" {{ $package->business_listing == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->business_listing == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Total Services You Can List</label>
                                                        <input type="number" name="total_services" class="form-control"
                                                            value="{{ $package->total_services }}">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Page with Contact Form</label>
                                                        <select name="profile_page_with_contact" class="form-control">
                                                            <option value="Yes" {{ $package->profile_page_with_contact == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->profile_page_with_contact == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Business Logo & Banner</label>
                                                        <select name="business_logo_banner" class="form-control">
                                                            <option value="Yes" {{ $package->business_logo_banner == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->business_logo_banner == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Appear in Local Search Results</label>
                                                        <select name="appear_in_local_search" class="form-control">
                                                            @foreach (['No', 'Medium', 'High', 'Top Priority'] as $option)
                                                                <option value="{{ $option }}" {{ $package->appear_in_local_search == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Verified Badge</label>
                                                        <select name="verified_badge" class="form-control">
                                                            <option value="Yes" {{ $package->verified_badge == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->verified_badge == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Premium Badge</label>
                                                        <select name="premium_badge" class="form-control">
                                                            <option value="Yes" {{ $package->premium_badge == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->premium_badge == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Image Upload Limit</label>
                                                        <input type="number" name="image_upload_limit" class="form-control"
                                                            value="{{ $package->image_upload_limit }}">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Video Upload</label>
                                                        <select name="video_upload_service" class="form-control">
                                                            <option value="Not Allowed" {{ $package->video_upload_service == 'Not Allowed' ? 'selected' : '' }}>Not Allowed</option>
                                                            <option value="Yes" {{ $package->video_upload_service == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Enquiries</label>
                                                        <select name="lead_enquiries" class="form-control">
                                                            @foreach (['Limited', 'Moderate', 'High', 'Priority'] as $option)
                                                                <option value="{{ $option }}" {{ $package->lead_enquiries == $option ? 'selected' : '' }}>
                                                                    {{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Response Rate</label>
                                                        <select name="response_rate_service" class="form-control">
                                                            @foreach (['Normal', 'Standard', 'Upto 2 times more', 'Upto 4 times more'] as $option)
                                                                <option value="{{ $option }}" {{ $package->response_rate_service == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Featured in “Top Service Provider”</label>
                                                        <select name="featured_in_top_provider" class="form-control">
                                                            <option value="Yes" {{ $package->featured_in_top_provider == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->featured_in_top_provider == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Customer Support</label>
                                                        <select name="customer_support_service" class="form-control">
                                                            @foreach (['Email', 'Email & Phone', 'Email / Phone / Chat', 'Dedicated'] as $option)
                                                                <option value="{{ $option }}" {{ $package->customer_support_service == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Alerts via SMS/Email</label>
                                                        <select name="lead_alerts" class="form-control">
                                                            <option value="Yes" {{ $package->lead_alerts == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $package->lead_alerts == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- DESCRIPTION --}}
                                            <div class="col-md-12 mb-3">
                                                <label>Description</label>
                                                <textarea name="description" rows="3"
                                                    class="form-control">{{ $package->description }}</textarea>
                                            </div>

                                            {{-- STATUS --}}
                                            <div class="col-md-4 mb-3">
                                                <label>Active Status</label>
                                                <select name="is_active" class="form-control">
                                                    <option value="1" {{ $package->is_active ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="0" {{ !$package->is_active ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                            </div>

                                            {{-- BUTTONS --}}
                                            <div class="col-md-12 text-end mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update Package
                                                </button>
                                                <a href="{{ route('admin.packages.index') }}"
                                                    class="btn btn-secondary">Cancel</a>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const type = "{{ $package->package_type }}";
            if (type === 'property') {
                $('#property_fields').show();
                $('#service_fields').hide();
            } else if (type === 'service') {
                $('#property_fields').hide();
                $('#service_fields').show();
            }

            $('#package_type').on('change', function () {
                const val = $(this).val();
                if (val === 'property') {
                    $('#property_fields').show();
                    $('#service_fields').hide();
                } else if (val === 'service') {
                    $('#property_fields').hide();
                    $('#service_fields').show();
                } else {
                    $('#property_fields, #service_fields').hide();
                }
            });

            // Update form
            $('#packageForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.packages.update', $package->id) }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('button[type="submit"]').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Package updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.href = "{{ route('admin.packages.index') }}";
                        }, 1500);
                    },
                    error: function (xhr) {
                        $('button[type="submit"]').prop('disabled', false).text('Update Package');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = Object.values(errors).map(val => val[0]).join('<br>');
                            Swal.fire({ icon: 'error', title: 'Validation Error', html: msg });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong! Please try again.' });
                        }
                    }
                });
            });
        });
    </script>
@endsection