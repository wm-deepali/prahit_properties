

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            
            <section class="breadcrumb-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="content-header">
                                <h3 class="content-header-title">Add Package</h3>
                                <a href="<?php echo e(route('admin.packages.index')); ?>" class="btn btn-secondary btn-save">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.packages.index')); ?>">Packages</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Package</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
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
                                        <?php echo csrf_field(); ?>
                                        <div class="row">

                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="package_type" id="package_type" class="form-control" required>
                                                    <option value="">Select Type</option>
                                                    <option value="property">Property Package</option>
                                                    <option value="service">Service Provider Package</option>
                                                </select>
                                            </div>

                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Package Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Price (₹) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="price" class="form-control"
                                                    placeholder="e.g., 1,999/- for 3 Months" required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Validity</label>
                                                <input type="text" name="validity" class="form-control"
                                                    placeholder="e.g., 30 Days or 3 Months">
                                            </div>

                                            
                                            <div id="property_fields" style="display:none;margin:15px;">
                                                <h5 class="mt-4 text-primary">Property Package Details</h5>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label>Number of Listing</label>
                                                        <input type="number" name="number_of_listing" class="form-control"
                                                            placeholder="e.g., 1, 5, 25, 50">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Photos per Listing</label>
                                                        <input type="number" name="photos_per_listing" class="form-control"
                                                            placeholder="e.g., 2, 5, 10, 20">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Video Upload</label>
                                                        <select name="video_upload" class="form-control">
                                                            <option value="Not Allowed">Not Allowed</option>
                                                            <option value="Yes">Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Response Rate</label>
                                                        <select name="response_rate" class="form-control">
                                                            <option value="Normal">Normal</option>
                                                            <option value="Standard">Standard</option>
                                                            <option value="Upto 2 times more">Upto 2 times more</option>
                                                            <option value="Upto 4 times more">Upto 4 times more</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Property Visibility</label>
                                                        <select name="property_visibility" class="form-control">
                                                            <option value="Normal">Normal</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="High">High</option>
                                                            <option value="Top Priority">Top Priority</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Verified Tag</label>
                                                        <select name="verified_tag" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Premium Seller</label>
                                                        <select name="premium_seller" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Page</label>
                                                        <select name="profile_page" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Visibility</label>
                                                        <select name="profile_visibility" class="form-control">
                                                            <option value="No">No</option>
                                                            <option value="Normal">Normal</option>
                                                            <option value="Featured">Featured</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile in Search Result</label>
                                                        <select name="profile_in_search_result" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Priority in Search Results</label>
                                                        <select name="priority_in_search" class="form-control">
                                                            <option value="No">No</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="High">High</option>
                                                            <option value="Top Priority">Top Priority</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Customer Support</label>
                                                        <select name="customer_support" class="form-control">
                                                            <option value="Email">Email</option>
                                                            <option value="Email & Phone">Email & Phone</option>
                                                            <option value="Email / Phone / Chat">Email / Phone / Chat
                                                            </option>
                                                            <option value="Dedicated">Dedicated</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Alerts via SMS/Email</label>
                                                        <select name="lead_alerts" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                   
                                                </div>
                                            </div>

                                            
                                            <div id="service_fields" style="display:none; margin:15px;">
                                                <h5 class="mt-4 text-primary">Service Provider Package Details</h5>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label>Business Listing</label>
                                                        <select name="business_listing" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Total Services You Can List</label>
                                                        <input type="number" name="total_services" class="form-control"
                                                            placeholder="e.g., 1, 3, 5, Unlimited">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Profile Page with Contact Form</label>
                                                        <select name="profile_page_with_contact" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Business Logo & Banner</label>
                                                        <select name="business_logo_banner" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Appear in Local Search Results</label>
                                                        <select name="appear_in_local_search" class="form-control">
                                                            <option value="No">No</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="High">High</option>
                                                            <option value="Top Priority">Top Priority</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Verified Badge</label>
                                                        <select name="verified_badge" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Premium Badge</label>
                                                        <select name="premium_badge" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Image Upload Limit</label>
                                                        <input type="number" name="image_upload_limit" class="form-control"
                                                            placeholder="e.g., 2, 5, 10, 20">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Video Upload</label>
                                                        <select name="video_upload_service" class="form-control">
                                                            <option value="Not Allowed">Not Allowed</option>
                                                            <option value="Yes">Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Enquiries</label>
                                                        <select name="lead_enquiries" class="form-control">
                                                            <option value="Limited">Limited</option>
                                                            <option value="Moderate">Moderate</option>
                                                            <option value="High">High</option>
                                                            <option value="Priority">Priority</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Response Rate</label>
                                                        <select name="response_rate_service" class="form-control">
                                                            <option value="Normal">Normal</option>
                                                            <option value="Standard">Standard</option>
                                                            <option value="Upto 2 times more">Upto 2 times more</option>
                                                            <option value="Upto 4 times more">Upto 4 times more</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Featured in “Top Service Provider”</label>
                                                        <select name="featured_in_top_provider" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Customer Support</label>
                                                        <select name="customer_support_service" class="form-control">
                                                            <option value="Email">Email</option>
                                                            <option value="Email & Phone">Email & Phone</option>
                                                            <option value="Email / Phone / Chat">Email / Phone / Chat
                                                            </option>
                                                            <option value="Dedicated">Dedicated</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Lead Alerts via SMS/Email</label>
                                                        <select name="lead_alerts" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            
                                            <div class="col-md-12 mb-3">
                                                <label>Description</label>
                                                <textarea name="description" rows="3" class="form-control"></textarea>
                                            </div>

                                            
                                            <div class="col-md-4 mb-3">
                                                <label>Active Status</label>
                                                <select name="is_active" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>

                                            
                                            <div class="col-md-12 text-end mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Save Package
                                                </button>
                                                <a href="<?php echo e(route('admin.packages.index')); ?>"
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {

            // toggle field visibility
            $('#package_type').on('change', function () {
                const type = $(this).val();
                if (type === 'property') {
                    $('#property_fields').show();
                    $('#service_fields').hide();
                } else if (type === 'service') {
                    $('#property_fields').hide();
                    $('#service_fields').show();
                } else {
                    $('#property_fields, #service_fields').hide();
                }
            });

            // form submit
            $('#packageForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('admin.packages.store')); ?>",
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
                            window.location.href = "<?php echo e(route('admin.packages.index')); ?>";
                        }, 1500);
                    },
                    error: function (xhr) {
                        $('button[type="submit"]').prop('disabled', false).text('Save Package');
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/packages/create.blade.php ENDPATH**/ ?>