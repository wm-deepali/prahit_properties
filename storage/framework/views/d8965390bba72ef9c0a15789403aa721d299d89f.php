

<?php $__env->startSection('title'); ?>
    <title>Post Business Listing</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .service-row {
            margin-bottom: 15px;
        }

        .service-row img {
            max-width: 100px;
        }

        .form-section-h {
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 18px;
        }

        .card {
            border-radius: 10px;
        }

        .form-group label {
            font-weight: 500;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-2">Post Your Business</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light p-0 mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Business Listing</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content-main-body py-4 postproperty-section">
        <div class="p-4">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card property-left-widgets">
                        <form action="<?php echo e(route('submit_business_listing')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <!-- Membership & Category -->
                            <div class="row mb-3">
                                <!-- <div class="col-md-3">
                                    <label>Membership Type</label>
                                    <select name="membership_type" class="form-control" required>
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div> -->
                                <div class="col-md-4">
                                    <label>Verified Status</label>
                                    <select name="verified_status" class="form-control" required>
                                        <option value="Verified">Verified</option>
                                        <option value="Unverified">Unverified</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Sub Category</label>
                                    <select name="sub_category_ids[]" id="sub_category_ids"
                                        class="form-control select2-multiple" multiple required></select>
                                </div>
                            </div>

                            <!-- Property Categories -->
                            <h4 class="form-section-h">Assigned To Property Category</h4>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Property Available For</label>
                                    <select name="property_category_id" id="property_category_id" class="form-control"
                                        onchange="handlePropertyCategoryChange(this.value)" required>
                                        <option value="">Select Category</option>
                                        <option value="all">Select All</option>
                                        <?php $__currentLoopData = $property_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4" id="property_category_div">
                                    <label>Property Category</label>
                                    <select name="property_subcategory_id" id="property_subcategory_id"
                                        class="form-control populate_subcategories"
                                        onchange="handleSubCategoryChange(this.value)" required>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="property_type_div">
                                    <label>Property Type</label>
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

                            <!-- Business Info -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Business Name</label>
                                    <input type="text" name="business_name" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Email ID</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Website</label>
                                    <input type="url" name="website" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Established Year</label>
                                    <input type="number" name="established_year" class="form-control" min="1800" max="2099">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- General Info -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Registration Number</label>
                                    <input type="text" class="form-control" name="registration_number"
                                        value="<?php echo e(old('registration_number', $profileSection->registration_number ?? '')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Deals In</label>
                                    <input type="text" class="form-control" name="deals_in"
                                        value="<?php echo e(old('deals_in', $profileSection->deals_in ?? '')); ?>">
                                    <small class="text-muted">Separate multiple values with commas.</small>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Satisfied Clients</label>
                                    <input type="number" class="form-control" name="satisfied_clients" min="0"
                                        value="<?php echo e(old('satisfied_clients', $profileSection->satisfied_clients ?? '')); ?>">
                                </div>
                            </div>

  <div class="row mb-3">
      <div class="col-md-4">
          <label>Introduction</label>
          <textarea name="introduction" class="form-control" rows="3"></textarea>
      </div>

      <div class="col-md-4">
          <label>Detail</label>
          <textarea name="detail" class="form-control" rows="5"></textarea>
      </div>
      <div class="col-md-4">
          <label>Full Address</label>
          <textarea name="full_address" class="form-control" rows="3"></textarea>
      </div>

  </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Pin Code</label>
                                    <input type="text" name="pin_code" class="form-control">
                                </div>
                            </div>

                           
<?php if( $business_logo_banner === 'Yes'): ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Business Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Banner Image</label>
            <input type="file" name="banner_image" class="form-control">
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-3">
        <i class="fa fa-info-circle"></i> 
        Your current plan does not include Business Logo & Banner uploads.
    </div>
<?php endif; ?>


                            <!-- Services -->
                             <div class="service-section p-3 border rounded mb-4">
                            <h5 class="form-section-h">Services</h5>
                            <div id="services-container">
                                <div class="service-row row mb-2">
                                    <div class="col-md-2">
                                        <input type="text" name="services[0][name]" class="form-control"
                                            placeholder="Service Name">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="services[0][description]" class="form-control"
                                        placeholder="Description">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="services[0][price]" class="form-control"
                                        placeholder="Price" min="0" step="0.01">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" name="services[0][image]" class="form-control-file">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success add-service">Add More</button>
                                    </div>
                                </div>
                            </div>
</div>

                            <!-- Portfolio Section -->
                             <div class="portfolio-section p-3 border rounded mb-4">
<h5 class="form-section-h">Portfolio</h5>
<div id="portfolio-container">
    <div class="portfolio-row row mb-2">
        <div class="col-md-3">
            <input type="text" name="portfolio[0][title]" class="form-control" placeholder="Title">
        </div>
        <div class="col-md-3">
            <input type="url" name="portfolio[0][link]" class="form-control" placeholder="Link">
        </div>
        <div class="col-md-4">
            <input type="file" name="portfolio[0][image]" class="form-control-file">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-success add-portfolio">Add More</button>
        </div>
    </div>
</div>
</div>

                                                                <?php
    // Load existing working_hours as array if present, otherwise create sensible defaults
    $existingWH = [];

    if (!$existingWH || !is_array($existingWH)) {
        $existingWH = [
            ['day' => 'Monday - Friday', 'start' => '09:00', 'end' => '19:00', 'closed' => false],
            ['day' => 'Saturday',        'start' => '10:00', 'end' => '17:00', 'closed' => false],
            ['day' => 'Sunday',          'start' => '',      'end' => '',      'closed' => true ],
        ];
    }
?>

<div class="contact-section p-3 border rounded mb-4">
    <div class="mb-4">
        <h5 class="mb-2">Working Hours</h5>

        <div id="working-hours-container">
            <?php $__currentLoopData = $existingWH; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="timing-item row align-items-center mb-2 gx-2" data-index="<?php echo e($index); ?>">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="working_hours[<?php echo e($index); ?>][day]"
                               value="<?php echo e($wh['day'] ?? ''); ?>" placeholder="Day or range (e.g. Monday - Friday)">
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm start-time"
                               name="working_hours[<?php echo e($index); ?>][start]" value="<?php echo e($wh['start'] ?? ''); ?>"
                               <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm end-time"
                               name="working_hours[<?php echo e($index); ?>][end]" value="<?php echo e($wh['end'] ?? ''); ?>"
                               <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input closed-checkbox" type="checkbox"
                                   name="working_hours[<?php echo e($index); ?>][closed]" value="1"
                                   id="closed_<?php echo e($index); ?>" <?php echo e(!empty($wh['closed']) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="closed_<?php echo e($index); ?>">Closed</label>
                        </div>
                    </div>

                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-working-hour" title="Remove">
                           <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-2">
            <button type="button" id="add-working-hour" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add Row
            </button>
            <small class="text-muted d-block mt-1">Use rows to show day ranges or individual days. Time fields use 24-hour format.</small>
        </div>
    </div>
</div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Add Business</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('detail');
        CKEDITOR.replace('introduction');

        var allSubCategories = <?php echo json_encode($subCategories, 15, 512) ?>;
        $(document).ready(function () {

            $('#category_id').change(function () {
                var categoryId = $(this).val();
                console.log(categoryId, 'categoryId');

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


           // Add More services dynamically with limit
var serviceIndex = 1;
var serviceLimit = <?php echo e($total_services ?? 5); ?>; // 👈 dynamic from backend

$(document).on('click', '.add-service', function () {
    var totalServices = $('#services-container .service-row').length;

    if (totalServices >= serviceLimit) {
        Swal.fire({
            icon: 'warning',
            title: 'Limit Reached',
            text: 'You can add a maximum of ' + serviceLimit + ' services as per your plan.'
        });
        return;
    }

    var row = `<div class="service-row row mb-2">
                    <div class="form-group col-md-2">
                      <input type="text" name="services[${serviceIndex}][name]" class="form-control" placeholder="Service Name">
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" name="services[${serviceIndex}][description]" class="form-control" placeholder="Description">
                    </div>
                    <div class="form-group col-md-2">
                      <input type="number" name="services[${serviceIndex}][price]" class="form-control" placeholder="Price" min="0" step="0.01">
                    </div>
                    <div class="form-group col-md-3">
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
            var route = "<?php echo e(config('app.api_url')); ?>/fetch_subcategories_by_cat_id/" + id;

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
            var route = "<?php echo e(config('app.api_url')); ?>/fetch_subsubcategories_by_subcat_id/" + id;

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
                // Remove required when hidden to avoid blocking submit
                $('#property_subcategory_id').prop('required', false);
                // Reset subcategory select and clear sub-sub selections
                $('#property_subcategory_id').val('');
                $('#sub_sub_category_items').empty().html('<p class="text-muted m-0">Select a property subcategory first</p>');
                $('#select_all_sub_sub').prop('checked', false);
            } else {
                // Show Property Category and load subcategories
                $('#property_category_div').show();
                $('#property_subcategory_id').prop('required', true);
                fetch_subcategories(value, function () { /* wait for user to choose subcategory */ });
            }
        }

        function handleSubCategoryChange(value) {
            if (value === 'all') {
                // Hide Property Type
                $('#property_type_div').hide();
                // Clear any previously selected sub-subcategories
                $('#sub_sub_category_items').empty().html('<p class="text-muted m-0">Select a property subcategory first</p>');
                $('#select_all_sub_sub').prop('checked', false);
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
            $('#property_subcategory_id').prop('required', false);
        });


    // Add More portfolio dynamically
var portfolioIndex = 1;
$(document).on('click', '.add-portfolio', function () {
    var row = `<div class="portfolio-row row mb-2">
                    <div class="form-group col-md-3">
                        <input type="text" name="portfolio[${portfolioIndex}][title]" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="url" name="portfolio[${portfolioIndex}][link]" class="form-control" placeholder="Link">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="portfolio[${portfolioIndex}][image]" class="form-control-file">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="button" class="btn btn-danger remove-portfolio">Remove</button>
                    </div>
                </div>`;
    $('#portfolio-container').append(row);
    portfolioIndex++;
});

// Remove portfolio row
$(document).on('click', '.remove-portfolio', function () {
    $(this).closest('.portfolio-row').remove();
});


document.addEventListener('click', function (e) {
    // Add working hour row
    if (e.target.closest('#add-working-hour')) {
        let container = document.getElementById('working-hours-container');
        let index = container.querySelectorAll('.timing-item').length;
        let row = document.createElement('div');
        row.className = 'timing-item row align-items-center mb-2 gx-2';
        row.dataset.index = index;

        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" name="working_hours[${index}][day]" placeholder="Day or range (e.g. Monday - Friday)">
            </div>
            <div class="col-md-2">
                <input type="time" class="form-control form-control-sm start-time" name="working_hours[${index}][start]" value="">
            </div>
            <div class="col-md-2">
                <input type="time" class="form-control form-control-sm end-time" name="working_hours[${index}][end]" value="">
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input closed-checkbox" type="checkbox" name="working_hours[${index}][closed]" value="1" id="closed_${index}">
                    <label class="form-check-label" for="closed_${index}">Closed</label>
                </div>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm remove-working-hour" title="Remove">
                   <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    // Remove working hour row
    if (e.target.closest('.remove-working-hour')) {
        let row = e.target.closest('.timing-item');
        if (row) row.remove();

        // Re-index names so server receives contiguous indices
        reindexWorkingHours();
    }
});

// toggle time inputs when closed checkbox changes (use delegation)
document.addEventListener('change', function (e) {
    if (e.target.classList && e.target.classList.contains('closed-checkbox')) {
        let row = e.target.closest('.timing-item');
        if (!row) return;
        let start = row.querySelector('.start-time');
        let end = row.querySelector('.end-time');
        if (e.target.checked) {
            if (start) { start.disabled = true; start.value = ''; }
            if (end)   { end.disabled = true; end.value = ''; }
        } else {
            if (start) start.disabled = false;
            if (end)   end.disabled = false;
        }
        // after toggling, reindex names to keep inputs consistent
        reindexWorkingHours();
    }
});

// Reindex function - ensures names are sequential for server (0,1,2,...)
function reindexWorkingHours(){
    const container = document.getElementById('working-hours-container');
    const rows = container.querySelectorAll('.timing-item');
    rows.forEach((row, idx) => {
        row.dataset.index = idx;
        // update inputs' name and id attributes
        const day = row.querySelector('input[type="text"]');
        if (day) day.name = `working_hours[${idx}][day]`;

        const start = row.querySelector('.start-time');
        if (start) start.name = `working_hours[${idx}][start]`;

        const end = row.querySelector('.end-time');
        if (end) end.name = `working_hours[${idx}][end]`;

        const checkbox = row.querySelector('.closed-checkbox');
        if (checkbox) {
            checkbox.name = `working_hours[${idx}][closed]`;
            checkbox.id = `closed_${idx}`;
            const label = row.querySelector('label.form-check-label');
            if (label) label.htmlFor = `closed_${idx}`;
        }
    });
}

// Run once on load to ensure names are indexed correctly (useful if server-rendered indices were non-contiguous)
document.addEventListener('DOMContentLoaded', function(){ reindexWorkingHours(); });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/create_business_listing.blade.php ENDPATH**/ ?>