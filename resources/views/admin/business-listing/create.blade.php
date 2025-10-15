@extends('layouts.app')

@section('title')
    Add New Business
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .service-row {
            margin-bottom: 15px;
        }

        .service-row img {
            max-width: 100px;
        }
    </style>
@endsection

@section('content')
    <section class="breadcrumb-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-header">
                        <h3 class="content-header-title">Web Directory - Add Business</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.business-listing.index') }}">Business
                                    Listing</a></li>
                            <li class="breadcrumb-item active">Add New Business</li>
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
                            <form action="{{ route('admin.business-listing.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Membership Type</label>
                                        <select name="membership_type" class="form-control" required>
                                            <option value="Free">Free</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Verified Status</label>
                                        <select name="verified_status" class="form-control" required>
                                            <option value="Verified">Verified</option>
                                            <option value="Unverified">Unverified</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Category</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Sub Category</label>
                                        <select name="sub_category_ids[]" id="sub_category_ids"
                                            class="form-control select2-multiple" multiple required>
                                            <!-- Dynamically populated via JS -->
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Business Name</label>
                                        <input type="text" name="business_name" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email ID</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>WhatsApp Number</label>
                                        <input type="text" name="whatsapp_number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Website</label>
                                        <input type="url" name="website" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Established Year</label>
                                        <input type="number" name="established_year" class="form-control" min="1800"
                                            max="2099">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Introduction</label>
                                    <textarea name="introduction" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Full Address</label>
                                    <textarea name="full_address" class="form-control"></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Pin Code</label>
                                        <input type="text" name="pin_code" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control-file">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Banner Image</label>
                                        <input type="file" name="banner_image" class="form-control-file">
                                    </div>
                                </div>

                                <hr>
                                <h5>Services</h5>
                                <div id="services-container">
                                    <div class="service-row row">
                                        <div class="form-group col-md-5">
                                            <input type="text" name="services[0][name]" class="form-control"
                                                placeholder="Service Name">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <input type="file" name="services[0][image]" class="form-control-file">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="button" class="btn btn-success add-service">Add More</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Add Business</button>
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
            var serviceIndex = 1;
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