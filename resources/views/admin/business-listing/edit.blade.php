@extends('layouts.app')

@section('title')
    Edit Business
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .service-row {
            margin-bottom: 15px;
        }

        .service-row img {
            max-width: 100px;
            display: block;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <section class="breadcrumb-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-header">
                        <h3 class="content-header-title">Web Directory - Edit Business</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.business-listing.index') }}">Business
                                    Listing</a></li>
                            <li class="breadcrumb-item active">Edit Business</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-main-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.business-listing.update', $business->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Membership Type</label>
                                        <select name="membership_type" class="form-control" required>
                                            <option value="Free" {{ $business->membership_type == 'Free' ? 'selected' : '' }}>
                                                Free
                                            </option>
                                            <option value="Paid" {{ $business->membership_type == 'Paid' ? 'selected' : '' }}>
                                                Paid
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Verified Status</label>
                                        <select name="verified_status" class="form-control" required>
                                            <option value="Verified" {{ $business->verified_status == 'Verified' ? 'selected' : '' }}>Verified</option>
                                            <option value="Unverified" {{ $business->verified_status == 'Unverified' ? 'selected' : '' }}>Unverified
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Category</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $business->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Sub Category</label>
                                        <select name="sub_category_ids[]" id="sub_category_ids"
                                            class="form-control select2-multiple" multiple required>
                                            @foreach($subCategories as $sub)
                                                <option value="{{ $sub->id }}" {{ in_array($sub->id, $business->subCategories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $sub->sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Business Name</label>
                                        <input type="text" name="business_name" class="form-control"
                                            value="{{ $business->business_name }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email ID</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $business->email }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control"
                                            value="{{ $business->mobile_number }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>WhatsApp Number</label>
                                        <input type="text" name="whatsapp_number" class="form-control"
                                            value="{{ $business->whatsapp_number }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Website</label>
                                        <input type="url" name="website" class="form-control"
                                            value="{{ $business->website }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Established Year</label>
                                        <input type="number" name="established_year" class="form-control" min="1800"
                                            max="2099" value="{{ $business->established_year }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Introduction</label>
                                    <textarea name="introduction"
                                        class="form-control">{{ $business->introduction }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="form-control">{{ $business->detail }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Full Address</label>
                                    <textarea name="full_address"
                                        class="form-control">{{ $business->full_address }}</textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control" value="{{ $business->state }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $business->city }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Pin Code</label>
                                        <input type="text" name="pin_code" class="form-control"
                                            value="{{ $business->pin_code }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control-file">
                                        @if($business->logo)
                                            <img src="{{ asset('storage/' . $business->logo) }}" alt="Logo">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Banner Image</label>
                                        <input type="file" name="banner_image" class="form-control-file">
                                        @if($business->banner_image)
                                            <img src="{{ asset('storage/' . $business->banner_image) }}" alt="Banner">
                                        @endif
                                    </div>
                                </div>

                                <hr>
                                <h5>Services</h5>
                                <div id="services-container">
                                    @foreach($business->services as $index => $service)
                                    <div class="service-row row">
                                            <input type="hidden" name="services[{{ $index }}][id]" value="{{ $service->id }}">
                                            <div class="form-group col-md-5">
                                                <input type="text" name="services[{{ $index }}][name]" class="form-control"
                                                    value="{{ $service->name }}" placeholder="Service Name">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <input type="file" name="services[{{ $index }}][image]"
                                                    class="form-control-file">
                                                @if($service->image)
                                                    <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image">
                                                @endif
                                            </div>
                                            <div class="form-group col-md-2">
                                                <button type="button" class="btn btn-danger remove-service">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group text-center mt-3">
                                    <button type="button" class="btn btn-success add-service">Add More</button>
                                    <button type="submit" class="btn btn-primary">Update Business</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        var allSubCategories = @json($subCategories);

        $(document).ready(function () {

            // Dynamic subcategories based on category selection
            $('#category_id').change(function () {
                var categoryId = $(this).val();
                $('#sub_category_ids').empty();

                if (categoryId) {
                    var filteredSubs = allSubCategories.filter(function (sub) {
                        return sub.category_id == categoryId;
                    });

                    filteredSubs.forEach(function (sub) {
                        $('#sub_category_ids').append('<option value="' + sub.id + '">' + sub.sub_category_name + '</option>');
                    });
                }
            });

            // Add More services dynamically
            var serviceIndex = {{ $business->services->count() }};
            $(document).on('click', '.add-service', function () {
                var row = `<div class="service-row row">
                                <div class="form-group col-md-5">
                                  <input type="text" name="services[${serviceIndex}][name]" class="form-control" placeholder="Service Name">
                                </div>
                                <div class="form-group col-md-5">
                                  <input type="file" name="services[${serviceIndex}][image]" class="form-control-file">
                                </div>
                                <div class="form-group col-md-2">
                                  <button type="button" class="btn btn-danger remove-service">Remove</button>
                                </div>
                              </div>`;
                $('#services-container').append(row);
                serviceIndex++;
            });

            $(document).on('click', '.remove-service', function () {
                $(this).closest('.service-row').remove();
            });

        });
    </script>
@endsection