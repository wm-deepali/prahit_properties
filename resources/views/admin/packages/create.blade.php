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
                            <h3 class="content-header-title">Add Package</h3>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-save">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Packages</a></li>
                                <li class="breadcrumb-item active">Add Package</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Add Package Form --}}
        <section class="content-main-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Create New Package</h5>
                            </div>
                            <div class="card-body">
                                <form id="packageForm">
                                    @csrf
                                    <div class="row">
                                        {{-- BASIC INFO --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Package Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Price (₹) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="price" class="form-control" required>
                                        </div>

                                        {{-- DURATION --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Duration</label>
                                            <input type="number" name="duration" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Duration Unit</label>
                                            <select name="duration_unit" class="form-control">
                                                <option value="">Select Unit</option>
                                                <option value="days">Days</option>
                                                <option value="months">Months</option>
                                                <option value="years">Years</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Service Limit</label>
                                            <input type="number" name="service_limit" class="form-control">
                                        </div>

                                        {{-- IMAGE / VIDEO --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Image Upload Limit</label>
                                            <input type="number" name="image_upload_limit" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Video Upload</label>
                                            <select name="video_upload" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        {{-- BOOLEAN FEATURES --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Business Listing</label>
                                            <select name="business_listing" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Profile Page with Contact</label>
                                            <select name="profile_page_with_contact" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Business Logo / Banner</label>
                                            <select name="business_logo_banner" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        {{-- SEARCH / VISIBILITY --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Appear in Search</label>
                                            <select name="appear_in_search" class="form-control">
                                                <option value="">Select</option>
                                                <option value="No">No</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                                <option value="Top Priority">Top Priority</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Verified Badge</label>
                                            <select name="verified_badge" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Premium Badge</label>
                                            <select name="premium_badge" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        {{-- LEAD & RESPONSE --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Lead Enquiries</label>
                                            <select name="lead_enquiries" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Limited">Limited</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>
                                                <option value="Priority">Priority</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Response Rate</label>
                                            <select name="response_rate" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Standard">Standard</option>
                                                <option value="2x">2x</option>
                                                <option value="4x">4x</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Featured in Top</label>
                                            <select name="featured_in_top" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        {{-- SUPPORT --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Customer Support</label>
                                            <select name="customer_support" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Email">Email</option>
                                                <option value="Phone">Phone</option>
                                                <option value="Dedicated">Dedicated</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Lead Alerts</label>
                                            <select name="lead_alerts" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        {{-- DESCRIPTION --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" rows="3" class="form-control"></textarea>
                                        </div>

                                        {{-- ACTIVE --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Active Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        {{-- BUTTONS --}}
                                        <div class="col-md-12 text-end mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save Package
                                            </button>
                                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
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
    $('#packageForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.packages.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Package created successfully!',
                    timer: 2000,
                    showConfirmButton: false
                });
                setTimeout(() => {
                    window.location.href = "{{ route('admin.packages.index') }}";
                }, 1500);
            },
            error: function (xhr) {
                $('button[type="submit"]').prop('disabled', false).text('Save Package');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).map(val => val[0]).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: msg
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong! Please try again.'
                    });
                }
            }
        });
    });
});
</script>
@endsection
