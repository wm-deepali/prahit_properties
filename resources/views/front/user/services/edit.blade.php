@extends('layouts.front.app')

@section('title')
    <title>Edit Business Listing</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .single-listing.card {
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .single-listing.card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .card-body {
            padding: 1.25rem;
        }

        .property-title a {
            color: #007bff;
            text-decoration: none;
        }

        .property-title a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .property-buttons .btn {
            margin-right: 5px;
        }

        .property-buttons .btn:last-child {
            margin-right: 0;
        }

        .alert-info {
            background-color: #e9f1ff;
            border-color: #cce5ff;
        }

        .card-text {
            margin: 0px;
            font-weight: 400;
            font-size: 14px;
        }

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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Edit Business Listing</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Business Listing</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="owner-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('front.user.sidebar')
                </div>
                <div class="col-sm-9">
                    <div class="main-area-dash">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.services.update', $business->id) }}" method="POST"
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

                                    <h4 class="form-section-h">Assigned To Property Category</h4>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="label-control">Property Available For</label>
                                            <select class="text-control populate_categories" name="property_category_id"
                                                id="property_category_id"
                                                onchange="handlePropertyCategoryChange(this.value)" required>
                                                <option value="">Select Category</option>
                                                @php
                                                    $totalPropertyCategories = $property_categories->count();
                                                    $selectedCategoryIds = $business->propertyCategories->pluck('id');
                                                    $isAllCategories = $selectedCategoryIds->count() === $totalPropertyCategories && $totalPropertyCategories > 0;
                                                    $firstSelectedCategory = $selectedCategoryIds->first();
                                                @endphp
                                                <option value="all" {{ $isAllCategories ? 'selected' : '' }}>Select All
                                                </option>
                                                @foreach($property_categories as $v)
                                                    <option value="{{$v->id}}" {{ (!$isAllCategories && $firstSelectedCategory == $v->id) ? 'selected' : '' }}>
                                                        {{$v->category_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4" id="property_category_div">
                                            <label class="label-control">Property Category</label>
                                            <select class="text-control populate_subcategories"
                                                name="property_subcategory_id" id="property_subcategory_id"
                                                onchange="handleSubCategoryChange(this.value)" required>
                                                <option value="">Select Sub Category</option>

                                            </select>
                                        </div>

                                        <div class="col-sm-4" id="property_type_div">
                                            <label class="label-control">Property Type</label>
                                            <div id="sub_sub_category_list" class="border rounded p-2"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="select_all_sub_sub">
                                                    <label class="form-check-label" for="select_all_sub_sub"><strong>Select
                                                            All</strong></label>
                                                </div>
                                                <div id="sub_sub_category_items">
                                                    <p class="text-muted m-0">Select a property subcategory first</p>
                                                </div>
                                            </div>
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
                                            <input type="text" name="state" class="form-control"
                                                value="{{ $business->state }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control"
                                                value="{{ $business->city }}">
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
                                                <input type="hidden" name="services[{{ $index }}][id]"
                                                    value="{{ $service->id }}">
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
        </div>
    </section>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('detail');

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

        function fetch_subcategories(id, callback) {
            var route = "{{ config('app.api_url') }}/fetch_subcategories_by_cat_id/" + id;

            $.ajax({
                url: route,
                method: 'get',
                beforeSend: function () {
                    $(".addproperty").attr('disabled', true);
                    $(".add_formtype").empty();
                    $(".loading").css('display', 'block');
                },
                success: function (response) {
                    if (response.responseCode === 200) {
                        var subcategories = response.data.SubCategory;
                        var $select = $(".populate_subcategories");
                        $select.empty();

                        if (subcategories.length > 0) {
                            // ✅ Add Select and Select All options first
                            $select.append(`<option value="">Select Category</option>`);
                            $select.append(`<option value="all">Select All</option>`);

                            // ✅ Append fetched subcategories
                            $.each(subcategories, function (x, y) {
                                $select.append(
                                    `<option value="${y.id}">${y.sub_category_name}</option>`
                                );
                            });
                        } else {
                            $select.append(`<option value="">No subcategories found</option>`);
                        }

                        if (callback) callback();
                    } else {
                        toastr.error('Failed to fetch subcategories.');
                    }
                },
                error: function () {
                    toastr.error('An error occurred while fetching subcategories.');
                },
                complete: function () {
                    $(".loading").css('display', 'none');
                    $(".addproperty").attr('disabled', false);
                }
            });
        }


        function fetch_subsubcategories(id, callback) {
            var route = "{{config('app.api_url')}}/fetch_subsubcategories_by_subcat_id/" + id;

            $.ajax({
                url: route,
                method: 'get',
                beforeSend: function () {
                    $(".loading").css('display', 'block');
                    $("#sub_sub_category_items").html('<p class="text-muted m-0">Loading...</p>');
                },

                success: function (response) {
                    if (response.responseCode === 200) {
                        var container = $("#sub_sub_category_items");
                        container.empty();

                        var subcategories = response.data.SubSubCategory;
                        if (subcategories.length > 0) {
                            $.each(subcategories, function (index, item) {
                                container.append(`
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" 
                                                         name="sub_sub_category_ids[]" 
                                                         value="${item.id}" 
                                                         id="subsub_${item.id}">
                                                  <label class="form-check-label" for="subsub_${item.id}">
                                                    ${item.sub_sub_category_name}
                                                  </label>
                                                </div>
                                            `);
                            });
                        } else {
                            container.html('<p class="text-muted m-0">No Sub Sub Categories found</p>');
                        }

                        // Automatically check "Select All" if all loaded checkboxes are pre-checked
                        var total = container.find('input[type="checkbox"]').length;
                        var checked = container.find('input[type="checkbox"]:checked').length;
                        $('#select_all_sub_sub').prop('checked', total === checked);

                        if (callback) callback();
                    } else {
                        $("#sub_sub_category_items").html('<p class="text-danger m-0">Error loading data</p>');
                    }
                },
                error: function () {
                    $("#sub_sub_category_list").html('<p class="text-danger m-0">An error occurred</p>');
                },
                complete: function () {
                    $(".loading").css('display', 'none');
                }
            });
        }

        function handlePropertyCategoryChange(value) {
            if (value === 'all') {
                // Hide Property Category and Property Type
                $('#property_category_div').hide();
                $('#property_type_div').hide();
            } else {
                // Show Property Category and load subcategories
                $('#property_category_div').show();
                fetch_subcategories(value, fetch_subsubcategories);
            }
        }

        function handleSubCategoryChange(value) {
            if (value === 'all') {
                // Hide Property Type
                $('#property_type_div').hide();
            } else {
                // Show Property Type and fetch sub-subcategories
                $('#property_type_div').show();
                fetch_subsubcategories(value);
            }
        }

        // Ensure proper visibility on initial load
        $(document).ready(function () {
            $('#property_category_div').hide();
            $('#property_type_div').hide();

            // Preselect property relationship values on Edit
            var totalPropertyCategories = {{ $property_categories->count() }};
            var selectedCategoryIds = @json($business->propertyCategories->pluck('id')->values()->all());
            var selectedSubCategoryIds = @json($business->propertySubCategories->pluck('id')->values()->all());
            var selectedSubSubIds = @json($business->propertySubSubCategories->pluck('id')->values()->all());

            var preselectedCategoryValue = '';
            if (selectedCategoryIds.length === 0) {
                preselectedCategoryValue = '';
            } else if (selectedCategoryIds.length === totalPropertyCategories) {
                preselectedCategoryValue = 'all';
            } else {
                preselectedCategoryValue = selectedCategoryIds[0];
            }

            if (preselectedCategoryValue) {
                $('#property_category_id').val(preselectedCategoryValue);
            }

            if (preselectedCategoryValue === 'all') {
                // Hide dependent sections when "all"
                $('#property_category_div').hide();
                $('#property_type_div').hide();
                $('#property_subcategory_id').prop('required', false);
                // Reset dependent selections
                $('#property_subcategory_id').val('');
                $('#sub_sub_category_items').empty().html('<p class="text-muted m-0">Select a property subcategory first</p>');
                $('#select_all_sub_sub').prop('checked', false);
            } else if (preselectedCategoryValue) {
                // Load subcategories for the selected category, then preselect subcategory
                fetch_subcategories(preselectedCategoryValue, function () {
                    var preselectedSubCategoryValue = '';

                    // Build quick lookup for subcategory -> category_id
                    var allSubs = (function () {
                        try { return @json($property_subcategories->map(function ($s) {
                        return ['id' => $s->id, 'category_id' => $s->category_id]; })->values()->all()); }
                        catch (e) { return []; }
                    })();
                    var subIdToCatId = {};
                    allSubs.forEach(function (s) { subIdToCatId[String(s.id)] = String(s.category_id); });

                    // Filter saved subcategories to current category
                    var selectedSubsForCat = (selectedSubCategoryIds || []).filter(function (id) {
                        return subIdToCatId[String(id)] === String(preselectedCategoryValue);
                    });

                    // Count total subs for current category
                    var totalSubsForCat = allSubs.filter(function (s) { return String(s.category_id) === String(preselectedCategoryValue); }).length;

                    if ((selectedSubsForCat.length > 0) && (selectedSubsForCat.length === totalSubsForCat)) {
                        preselectedSubCategoryValue = 'all';
                    } else if (selectedSubsForCat.length > 0) {
                        preselectedSubCategoryValue = selectedSubsForCat[0];
                    } else {
                        preselectedSubCategoryValue = '';
                    }

                    if (preselectedSubCategoryValue) {
                        $('#property_subcategory_id').val(String(preselectedSubCategoryValue));
                        $('#property_subcategory_id').prop('required', true);
                    }

                    if (preselectedSubCategoryValue === 'all') {
                        $('#property_type_div').hide();
                        $('#property_subcategory_id').prop('required', false);
                        // Clear any previously selected sub-subcategories
                        $('#sub_sub_category_items').empty().html('<p class="text-muted m-0">Select a property subcategory first</p>');
                        $('#select_all_sub_sub').prop('checked', false);
                    } else if (preselectedSubCategoryValue) {
                        $('#property_type_div').show();
                        // Load sub-subcategories and then check saved ones
                        fetch_subsubcategories(preselectedSubCategoryValue, function () {
                            try {
                                if (Array.isArray(selectedSubSubIds)) {
                                    selectedSubSubIds.forEach(function (id) {
                                        $('#subsub_' + id).prop('checked', true);
                                    });
                                    var total = $('#sub_sub_category_items').find('input[type="checkbox"]').length;
                                    var checked = $('#sub_sub_category_items').find('input[type="checkbox"]:checked').length;
                                    $('#select_all_sub_sub').prop('checked', total > 0 && total === checked);
                                }
                            } catch (e) { /* no-op */ }
                        });
                    }
                });
                $('#property_category_div').show();
            }
        });
    </script>
@endsection