

<?php $__env->startSection('title'); ?>
    <title>Edit Business Listing</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
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
        .portfolio-row img {
            max-width: 100px;
            display: block;
            margin-top: 5px;
        }
        .timing-item input[type="text"],
        .timing-item input[type="time"] {
            width: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Edit Business Listing</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
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
                    <?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-sm-9">
                    <div class="main-area-dash">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo e(route('user.services.update', $business->id)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Membership Type</label>
                                            <select name="membership_type" class="form-control" required>
                                                <option value="Free" <?php echo e($business->membership_type == 'Free' ? 'selected' : ''); ?>>
                                                    Free
                                                </option>
                                                <option value="Paid" <?php echo e($business->membership_type == 'Paid' ? 'selected' : ''); ?>>
                                                    Paid
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Verified Status</label>
                                            <select name="verified_status" class="form-control" required>
                                                <option value="Verified" <?php echo e($business->verified_status == 'Verified' ? 'selected' : ''); ?>>Verified</option>
                                                <option value="Unverified" <?php echo e($business->verified_status == 'Unverified' ? 'selected' : ''); ?>>Unverified
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Category</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"
                                                        <?php echo e($business->category_id == $category->id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Sub Category</label>
                                            <select name="sub_category_ids[]" id="sub_category_ids" class="form-control select2-multiple" multiple required>
                                                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($sub->id); ?>"
                                                        <?php echo e(in_array($sub->id, $business->subCategories->pluck('id')->toArray()) ? 'selected' : ''); ?>>
                                                        <?php echo e($sub->sub_category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <h4 class="form-section-h">Assigned To Property Category</h4>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="label-control">Property Available For</label>
                                            <select class="text-control populate_categories" name="property_category_id"
                                                id="property_category_id" onchange="handlePropertyCategoryChange(this.value)" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                    $totalPropertyCategories = $property_categories->count();
                                                    $selectedCategoryIds = $business->propertyCategories->pluck('id');
                                                    $isAllCategories = $selectedCategoryIds->count() === $totalPropertyCategories && $totalPropertyCategories > 0;
                                                    $firstSelectedCategory = $selectedCategoryIds->first();
                                                ?>
                                                <option value="all" <?php echo e($isAllCategories ? 'selected' : ''); ?>>Select All
                                                </option>
                                                <?php $__currentLoopData = $property_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($v->id); ?>"
                                                        <?php echo e((!$isAllCategories && $firstSelectedCategory == $v->id) ? 'selected' : ''); ?>>
                                                        <?php echo e($v->category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-4" id="property_category_div">
                                            <label class="label-control">Property Category</label>
                                            <select class="text-control populate_subcategories" name="property_subcategory_id"
                                                id="property_subcategory_id" onchange="handleSubCategoryChange(this.value)" required>
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
                                                value="<?php echo e($business->business_name); ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email ID</label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?php echo e($business->email); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Mobile Number</label>
                                            <input type="text" name="mobile_number" class="form-control"
                                                value="<?php echo e($business->mobile_number); ?>">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>WhatsApp Number</label>
                                            <input type="text" name="whatsapp_number" class="form-control"
                                                value="<?php echo e($business->whatsapp_number); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Website</label>
                                            <input type="url" name="website" class="form-control"
                                                value="<?php echo e($business->website); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Established Year</label>
                                            <input type="number" name="established_year" class="form-control" min="1800" max="2099"
                                                value="<?php echo e($business->established_year); ?>">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Registration Number</label>
                                            <input type="text" name="registration_number" class="form-control" 
                                                value="<?php echo e($business->registration_number); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Deals In</label>
                                            <input type="text" name="deals_in" class="form-control"
                                                value="<?php echo e($business->deals_in); ?>">
                                            <small class="text-muted">Separate multiple values with commas.</small>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Satisfied Clients</label>
                                            <input type="number" name="satisfied_clients" class="form-control" min="0"
                                                value="<?php echo e($business->satisfied_clients); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Introduction</label>
                                        <textarea name="introduction" class="form-control"><?php echo e($business->introduction); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Detail</label>
                                        <textarea name="detail" class="form-control" id="detail"><?php echo e($business->detail); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Full Address</label>
                                        <textarea name="full_address" class="form-control"><?php echo e($business->full_address); ?></textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" value="<?php echo e($business->state); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" value="<?php echo e($business->city); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Pin Code</label>
                                            <input type="text" name="pin_code" class="form-control" value="<?php echo e($business->pin_code); ?>">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Logo</label>
                                            <input type="file" name="logo" class="form-control-file">
                                            <?php if($business->logo): ?>
                                                <img src="<?php echo e(asset('storage/' . $business->logo)); ?>" alt="Logo" style="max-width: 100px; display: block; margin-top: 5px;">
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Banner Image</label>
                                            <input type="file" name="banner_image" class="form-control-file">
                                            <?php if($business->banner_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $business->banner_image)); ?>" alt="Banner" style="max-width: 100px; display: block; margin-top: 5px;">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5>Services</h5>
                                    <div id="services-container">
                                        <?php $__currentLoopData = $business->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="service-row row">
                                                <input type="hidden" name="services[<?php echo e($index); ?>][id]" value="<?php echo e($service->id); ?>">
                                                <div class="form-group col-md-3">
                                                    <input type="text" name="services[<?php echo e($index); ?>][name]" class="form-control"
                                                        value="<?php echo e($service->name); ?>" placeholder="Service Name">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="services[<?php echo e($index); ?>][description]" class="form-control"
                                                        value="<?php echo e($service->description); ?>" placeholder="Description">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <input type="number" name="services[<?php echo e($index); ?>][price]" class="form-control" min="0" step="0.01"
                                                        value="<?php echo e($service->price); ?>" placeholder="Price">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="file" name="services[<?php echo e($index); ?>][image]" class="form-control-file">
                                                    <?php if($service->image): ?>
                                                        <img src="<?php echo e(asset('storage/' . $service->image)); ?>" alt="Service Image" style="max-width: 100px; display: block; margin-top: 5px;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-danger remove-service">Remove</button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button type="button" class="btn btn-success add-service">Add More</button>
                                    </div>

                                    <hr>
                                    <h5>Portfolio</h5>
                                    <div id="portfolio-container">
                                        <?php $__currentLoopData = $business->portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="portfolio-row row mb-2">
                                                <input type="hidden" name="portfolio[<?php echo e($index); ?>][id]" value="<?php echo e($portfolio->id); ?>">
                                                <div class="form-group col-md-3">
                                                    <input type="text" name="portfolio[<?php echo e($index); ?>][title]" class="form-control"
                                                        value="<?php echo e($portfolio->title); ?>" placeholder="Title">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <input type="url" name="portfolio[<?php echo e($index); ?>][link]" class="form-control"
                                                        value="<?php echo e($portfolio->link); ?>" placeholder="Link">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="file" name="portfolio[<?php echo e($index); ?>][image]" class="form-control-file">
                                                    <?php if($portfolio->image): ?>
                                                        <img src="<?php echo e(asset('storage/' . $portfolio->image)); ?>" alt="Portfolio Image"
                                                            style="max-width: 100px; display: block; margin-top: 5px;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-danger remove-portfolio">Remove</button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="form-group text-center mb-4">
                                        <button type="button" class="btn btn-success add-portfolio">Add More</button>
                                    </div>

                                    <hr>
                                    <h5>Working Hours</h5>
                                    <div id="working-hours-container">
                                        <?php
                                            $existingWH = $business->working_hours ?? [
                                                ['day' => 'Monday - Friday', 'start' => '09:00', 'end' => '19:00', 'closed' => false],
                                                ['day' => 'Saturday', 'start' => '10:00', 'end' => '17:00', 'closed' => false],
                                                ['day' => 'Sunday', 'start' => '', 'end' => '', 'closed' => true],
                                            ];
                                        ?>
                                        <?php $__currentLoopData = $existingWH; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="timing-item row align-items-center mb-2 gx-2" data-index="<?php echo e($index); ?>">
                                                <div class="col-md-4">
                                                    <input type="text" name="working_hours[<?php echo e($index); ?>][day]"
                                                        class="form-control form-control-sm" value="<?php echo e($wh['day'] ?? ''); ?>"
                                                        placeholder="Day or range (e.g. Monday - Friday)">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="time" name="working_hours[<?php echo e($index); ?>][start]"
                                                        class="form-control form-control-sm start-time"
                                                        value="<?php echo e($wh['start'] ?? ''); ?>" <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="time" name="working_hours[<?php echo e($index); ?>][end]"
                                                        class="form-control form-control-sm end-time"
                                                        value="<?php echo e($wh['end'] ?? ''); ?>" <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input closed-checkbox"
                                                            name="working_hours[<?php echo e($index); ?>][closed]" value="1"
                                                            id="closed_<?php echo e($index); ?>" <?php if(!empty($wh['closed'])): ?> checked <?php endif; ?>>
                                                        <label class="form-check-label" for="closed_<?php echo e($index); ?>">Closed</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm remove-working-hour"
                                                        title="Remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <button type="button" id="add-working-hour" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Add Row
                                    </button>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Update Business</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('detail');
        CKEDITOR.replace('introduction');

        var allSubCategories = <?php echo json_encode($subCategories, 15, 512) ?>;

        $(document).ready(function() {

            // Load subcategories dynamically on category change
            $('#category_id').change(function() {
                var categoryId = $(this).val();
                $('#sub_category_ids').empty();

                if (categoryId) {
                    var filteredSubs = allSubCategories.filter(function(sub) {
                        return sub.category_id == categoryId;
                    });

                    filteredSubs.forEach(function(sub) {
                        $('#sub_category_ids').append('<option value="' + sub.id + '">' + sub.sub_category_name + '</option>');
                    });

                    $('#sub_category_ids').trigger('change');
                }
            });

            // Add More services dynamically
            var serviceIndex = <?php echo e($business->services->count()); ?>;
            $(document).on('click', '.add-service', function() {
                var row = `<div class="service-row row">
                                <div class="form-group col-md-3">
                                     <input type="text" name="services[${serviceIndex}][name]" class="form-control" placeholder="Service Name">
                                </div>
                                <div class="form-group col-md-4">
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

            $(document).on('click', '.remove-service', function() {
                $(this).closest('.service-row').remove();
            });


            // Add More portfolio dynamically
            var portfolioIndex = <?php echo e($business->portfolio->count()); ?>;
            $(document).on('click', '.add-portfolio', function() {
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

            $(document).on('click', '.remove-portfolio', function() {
                $(this).closest('.portfolio-row').remove();
            });


            // Working Hours Add Row
            $(document).on('click', '#add-working-hour', function() {
                let container = $('#working-hours-container');
                let index = container.find('.timing-item').length;
                var row = `<div class="timing-item row align-items-center mb-2 gx-2" data-index="${index}">
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
                            </div>`;
                container.append(row);
            });

            // Remove working hour row
            $(document).on('click', '.remove-working-hour', function() {
                $(this).closest('.timing-item').remove();
                reindexWorkingHours();
            });

            // Toggle time inputs when closed checked/unchecked (delegated)
            $(document).on('change', '.closed-checkbox', function() {
                let row = $(this).closest('.timing-item');
                let start = row.find('.start-time');
                let end = row.find('.end-time');
                if ($(this).is(':checked')) {
                    start.val('').prop('disabled', true);
                    end.val('').prop('disabled', true);
                } else {
                    start.prop('disabled', false);
                    end.prop('disabled', false);
                }
                reindexWorkingHours();
            });

            // Reindex working hour inputs for sequential names
            function reindexWorkingHours() {
                $('#working-hours-container .timing-item').each(function(i, el) {
                    let row = $(el);
                    row.attr('data-index', i);
                    row.find('input[type="text"]').attr('name', `working_hours[${i}][day]`);
                    row.find('.start-time').attr('name', `working_hours[${i}][start]`);
                    row.find('.end-time').attr('name', `working_hours[${i}][end]`);
                    row.find('.closed-checkbox').attr({
                        'name': `working_hours[${i}][closed]`,
                        'id': `closed_${i}`
                    });
                    row.find('label.form-check-label').attr('for', `closed_${i}`);
                });
            }

            // Initial reindex on page load for working hours in case of server non-contiguous indices
            reindexWorkingHours();

            // Property category related scripts are assumed included here (same logic as in your previous JS)
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
            var totalPropertyCategories = <?php echo e($property_categories->count()); ?>;
            var selectedCategoryIds = <?php echo json_encode($business->propertyCategories->pluck('id')->values()->all(), 15, 512) ?>;
            var selectedSubCategoryIds = <?php echo json_encode($business->propertySubCategories->pluck('id')->values()->all(), 15, 512) ?>;
            var selectedSubSubIds = <?php echo json_encode($business->propertySubSubCategories->pluck('id')->values()->all(), 15, 512) ?>;

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
                        try { return <?php echo json_encode($property_subcategories->map(function ($s) {
                        return ['id' => $s->id, 'category_id' => $s->category_id]; })->values()->all(), 512) ?>; }
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/services/edit.blade.php ENDPATH**/ ?>