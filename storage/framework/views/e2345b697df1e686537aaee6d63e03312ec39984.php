

<?php $__env->startSection('title'); ?>
    Edit Business
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="breadcrumb-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-header">
                        <h3 class="content-header-title">Web Directory - Edit Business</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.business-listing.index')); ?>">Business
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
                            <form action="<?php echo e(route('admin.business-listing.update', $business->id)); ?>" method="POST"
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
                                                <option value="<?php echo e($category->id); ?>" <?php echo e($business->category_id == $category->id ? 'selected' : ''); ?>>
                                                    <?php echo e($category->category_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Sub Category</label>
                                        <select name="sub_category_ids[]" id="sub_category_ids"
                                            class="form-control select2-multiple" multiple required>
                                            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($sub->id); ?>" <?php echo e(in_array($sub->id, $business->subCategories->pluck('id')->toArray()) ? 'selected' : ''); ?>>
                                                    <?php echo e($sub->sub_category_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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
                                        <input type="number" name="established_year" class="form-control" min="1800"
                                            max="2099" value="<?php echo e($business->established_year); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Introduction</label>
                                    <textarea name="introduction"
                                        class="form-control"><?php echo e($business->introduction); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="form-control"><?php echo e($business->detail); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Full Address</label>
                                    <textarea name="full_address"
                                        class="form-control"><?php echo e($business->full_address); ?></textarea>
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
                                        <input type="text" name="pin_code" class="form-control"
                                            value="<?php echo e($business->pin_code); ?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control-file">
                                        <?php if($business->logo): ?>
                                            <img src="<?php echo e(asset('storage/' . $business->logo)); ?>" alt="Logo">
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Banner Image</label>
                                        <input type="file" name="banner_image" class="form-control-file">
                                        <?php if($business->banner_image): ?>
                                            <img src="<?php echo e(asset('storage/' . $business->banner_image)); ?>" alt="Banner">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <hr>
                                <h5>Services</h5>
                                <div id="services-container">
                                    <?php $__currentLoopData = $business->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="service-row row">
                                            <input type="hidden" name="services[<?php echo e($index); ?>][id]" value="<?php echo e($service->id); ?>">
                                            <div class="form-group col-md-5">
                                                <input type="text" name="services[<?php echo e($index); ?>][name]" class="form-control"
                                                    value="<?php echo e($service->name); ?>" placeholder="Service Name">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <input type="file" name="services[<?php echo e($index); ?>][image]"
                                                    class="form-control-file">
                                                <?php if($service->image): ?>
                                                    <img src="<?php echo e(asset('storage/' . $service->image)); ?>" alt="Service Image">
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
                                    <button type="submit" class="btn btn-primary">Update Business</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        var allSubCategories = <?php echo json_encode($subCategories, 15, 512) ?>;

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
            var serviceIndex = <?php echo e($business->services->count()); ?>;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/business-listing/edit.blade.php ENDPATH**/ ?>