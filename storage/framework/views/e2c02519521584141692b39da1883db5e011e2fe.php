<?php $__env->startSection('title'); ?>
    <title>Dashboard</title>
<?php $__env->stopSection(); ?>
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #4dabf7);
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #28a745, #51cf66);
    }

    .bg-gradient-warning {
        background: linear-gradient(45deg, #ffc107, #ffd43b);
    }

    .dashboard-area .card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 10px;
        overflow: hidden;
    }

    .dashboard-area .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .table th,
    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5em 1em;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .head-tit {
        font-weight: 700;
        color: #343a40;
    }

    .switch-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        background: #f9f9f9;
        padding: 0px;
        border-radius: 50px;
        font-family: "Segoe UI", sans-serif;
    }

    .switch-label {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    /* Toggle switch styling */
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
        display: inline-block;
        margin: 0px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #ccc;
        border-radius: 30px;
        transition: 0.3s;
    }

    .slider::before {
        content: "";
        position: absolute;
        height: 24px;
        width: 24px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: 0.3s;
    }

    /* When checked — move the toggle right and change color */
    .toggle-switch input:checked+.slider {
        background-color: #007bff;
    }

    .toggle-switch input:checked+.slider::before {
        transform: translateX(30px);
    }
</style>

<?php $__env->startSection('content'); ?>

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Account</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="head-tit">Dashboard</h3>
                            <div class="switch-container">
                                <span class="switch-label">Properties</span>

                                <label class="toggle-switch">
                                    <input type="checkbox" id="roleToggle">
                                    <span class="slider"></span>
                                </label>

                                <span class="switch-label">Services</span>
                            </div>
                        </div>
                        <hr>

                        <section class="dashboard-area">
                            <!-- PROPERTIES DASHBOARD -->
                            <div id="property-dashboard">
                                <!-- Report Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-primary text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-home fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Total Properties</h5>
                                                    <h3 class="card-text"><?php echo e($totalProperties); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-success text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-eye fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Published Properties</h5>
                                                    <h3 class="card-text"><?php echo e($publishedProperties); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-warning text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-star fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Enquired Properties</h5>
                                                    <h3 class="card-text"><?php echo e($enquiredPropertyIds); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Graphs -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <div class="card shadow-sm border-1">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Property Types</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="propertyTypeChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card shadow-sm border-1">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Property Status</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="propertyStatusChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Properties Table -->
                                <div class="card shadow-sm border-1 mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Your Properties</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th scope="col">Property</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($property->title); ?></td>
                                                            <td><?php echo e(isset($property->location->location) ? $property->location->location : ''); ?>

                                                            </td>
                                                            <td>₹<?php echo e(\App\Helpers\Helper::formatIndianPrice($property->price)); ?>

                                                            </td>
                                                            <td>
                                                                <?php if($property->status == '1'): ?>
                                                                    <span class="badge bg-success">Active</span>
                                                                <?php elseif($property->status == '0'): ?>
                                                                    <span class="badge bg-warning">Pending</span>
                                                                <?php else: ?>
                                                                    <span
                                                                        class="badge bg-secondary"><?php echo e(ucfirst($property->status)); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo e(url('update/property')); ?>/<?php echo e($property->id); ?>"
                                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                                                <a onclick="deleteProperty('<?php echo e($property->id); ?>')"
                                                                    class="btn btn-sm btn-outline-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Exclusive Property Cards -->
                                <h5 class="mb-3">Exclusive Properties</h5>
                                <div class="row">
                                    <?php $__currentLoopData = $ExclusiveProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card shadow-sm border-1">
                                                <img src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c'); ?>"
                                                    class="card-img-top" alt="<?php echo e($value->title); ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo e($value->title); ?></h5>
                                                    <p class="card-text"><i
                                                            class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?>,
                                                        <?php echo e($value->getState->name); ?>

                                                    </p>
                                                    <p class="card-text text-primary fw-bold">₹
                                                        <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?>

                                                    </p>
                                                    <a href="<?php echo e(route('property_detail', ['title' => $value->slug])); ?>"
                                                        class="btn btn-primary btn-sm">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- BUSINESS DASHBOARD -->
                            <div id="business-dashboard" style="display:none;">
                                <div class="row mb-4">
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-primary text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-building fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Total Businesses</h5>
                                                    <h3 class="card-text"><?php echo e($totalBusiness); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-success text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-eye fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Published Businesses</h5>
                                                    <h3 class="card-text"><?php echo e($publishedBusiness); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 bg-gradient-warning text-white">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="fas fa-star fa-2x me-3"></i>
                                                <div>
                                                    <h5 class="card-title mb-0">Enquired Businesses</h5>
                                                    <h3 class="card-text"><?php echo e($enquiredBusiness); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               

                                <!-- Business Listings Table -->
                                <div class="card shadow-sm border-1 mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Your Business Listings</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Business Name</th>
                                                        <th>Category</th>
                                                        <th>Membership</th>
                                                        <th>Verified</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $businessListings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($business->business_name); ?></td>
                                                            <td><?php echo e($business->category->category_name ?? ''); ?></td>
                                                            <td><?php echo e($business->membership_type); ?></td>
                                                            <td><?php echo e($business->verified_status); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(route('user.services.edit', $business->id)); ?>"
                                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                                                <a onclick="deleteBusiness('<?php echo e($business->id); ?>')"
                                                                    class="btn btn-sm btn-outline-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("roleToggle");
            const propertyDashboard = document.getElementById("property-dashboard");
            const businessDashboard = document.getElementById("business-dashboard");

            const currentUrl = new URL(window.location.href);
            const currentType = localStorage.getItem("user_type") || "property"; // default to property

            // === Set initial toggle state ===
            toggle.checked = currentType === "service";


            function updateDashboard(type) {
                if (type === 'service') {
                    propertyDashboard.style.display = 'none';
                    businessDashboard.style.display = 'block';
                } else {
                    propertyDashboard.style.display = 'block';
                    businessDashboard.style.display = 'none';
                }
                localStorage.setItem("user_type", type);
            }

            // === Update UI or reload page with param ===
            function updateType(type) {
                localStorage.setItem("user_type", type);
                currentUrl.searchParams.set("type", type);
                window.location.href = currentUrl.toString(); // reload with ?type=...
            }

            updateDashboard(currentType);
            // === Listen for toggle change ===
            toggle.addEventListener("change", function () {
                const newType = this.checked ? "service" : "property";
                updateType(newType);
                updateDashboard(type);
            });

            // === Optional: Reflect active type visually ===
            document.querySelectorAll(".switch-label").forEach(label => {
                label.style.fontWeight = (label.textContent.toLowerCase().includes(currentType)) ? "bold" : "normal";
            });
        });

        // Bar Chart for Property Types
        const ctx1 = document.getElementById('propertyTypeChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Apartment', 'Villa', 'Plot', 'Commercial'],
                datasets: [{
                    label: 'Number of Properties',
                    data: [12, 8, 5, 3],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#0056b3', '#218838', '#e0a800', '#c82333'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Pie Chart for Property Status
        const ctx2 = document.getElementById('propertyStatusChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Active', 'Pending', 'Sold'],
                datasets: [{
                    data: [15, 8, 5],
                    backgroundColor: ['#28a745', '#ffc107', '#6c757d'],
                    borderColor: ['#218838', '#e0a800', '#5a6268'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });


        function deleteProperty(id) {
            swal({
                title: "Are you sure?",
                text: "Delete this Property",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'post',
                            url: "<?php echo e(route('property.delete')); ?>",
                            data: {
                                "_token": "<?php echo e(csrf_token()); ?>",
                                'id': id
                            },
                            success: function (data) {
                                toastr.success(data);
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
        }

        function deleteBusiness(id) {
            swal({
                title: "Are you sure?",
                text: "Delete this Business Listing",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'DELETE',
                            url: "<?php echo e(url('user/services/delete')); ?>/" + id,
                            data: {
                                "_token": "<?php echo e(csrf_token()); ?>",
                                "_method": "DELETE"
                            },
                            success: function (data) {
                                toastr.success(data.message || 'Deleted successfully');
                                // Remove deleted card from DOM
                                $('#business-' + id).remove();
                            },
                            error: function (err) {
                                toastr.error(err.responseJSON?.message || 'Something went wrong');
                            }
                        });
                    }
                });
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/dashboard.blade.php ENDPATH**/ ?>