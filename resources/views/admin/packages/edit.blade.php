@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Edit Package</h4>
        </div>
        <div class="card-body">
            <form id="updatePackageForm" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Package Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $package->name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ $package->price }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Duration</label>
                        <input type="number" name="duration" class="form-control" value="{{ $package->duration }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Duration Unit</label>
                        <select name="duration_unit" class="form-select">
                            <option value="">Select</option>
                            <option value="days" {{ $package->duration_unit == 'days' ? 'selected' : '' }}>Days</option>
                            <option value="months" {{ $package->duration_unit == 'months' ? 'selected' : '' }}>Months</option>
                            <option value="years" {{ $package->duration_unit == 'years' ? 'selected' : '' }}>Years</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Service Limit</label>
                        <input type="number" name="service_limit" class="form-control" value="{{ $package->service_limit }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Image Upload Limit</label>
                        <input type="number" name="image_upload_limit" class="form-control" value="{{ $package->image_upload_limit }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Appear in Search</label>
                        <input type="text" name="appear_in_search" class="form-control" value="{{ $package->appear_in_search }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Lead Enquiries</label>
                        <input type="text" name="lead_enquiries" class="form-control" value="{{ $package->lead_enquiries }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Response Rate</label>
                        <input type="text" name="response_rate" class="form-control" value="{{ $package->response_rate }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Customer Support</label>
                        <input type="text" name="customer_support" class="form-control" value="{{ $package->customer_support }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $package->description }}</textarea>
                    </div>

                    <div class="col-12 mt-3">
                        <label class="form-label fw-bold d-block">Features</label>
                        <div class="row g-2">
                            @php
                                $features = [
                                    'business_listing' => 'Business Listing',
                                    'profile_page_with_contact' => 'Profile Page with Contact',
                                    'business_logo_banner' => 'Business Logo & Banner',
                                    'video_upload' => 'Video Upload',
                                    'verified_badge' => 'Verified Badge',
                                    'premium_badge' => 'Premium Badge',
                                    'featured_in_top' => 'Featured in Top',
                                    'lead_alerts' => 'Lead Alerts',
                                ];
                            @endphp

                            @foreach($features as $key => $label)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="{{ $key }}" id="{{ $key }}"
                                            {{ $package->$key ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $package->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Update Package</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- AJAX Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#updatePackageForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let url = "{{ route('admin.packages.update', $package->id) }}";

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
            },
            success: function(response) {
                $('button[type="submit"]').prop('disabled', false).html('Update Package');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Package updated successfully!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('admin.packages.index') }}";
                });
            },
            error: function(xhr) {
                $('button[type="submit"]').prop('disabled', false).html('Update Package');
                let msg = 'Something went wrong!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg
                });
            }
        });
    });
});
</script>
@endsection
