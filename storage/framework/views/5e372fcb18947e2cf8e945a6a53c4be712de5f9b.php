

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
                                <div class="loading">
                                    <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
                                </div>
                                <h3 class="content-header-title">Packages</h3>
                                <a href="<?php echo e(route('admin.packages.create')); ?>" class="btn btn-primary btn-save">
                                    <i class="fas fa-plus"></i> Add Package
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Packages</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
            <section class="content-main-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="packages-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th> 
                                                    <th>Name</th>
                                                    <th>Price (₹)</th>
                                                    <th>Duration</th>
                                                    <th>Active</th>
                                                    <th>Created At</th>
                                                    <th width="120px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                                            <?php if($package->package_type == 'property'): ?>
                                                                <span class="badge bg-info" style="color:white;">Property</span>
                                                            <?php elseif($package->package_type == 'service'): ?>
                                                                <span class="badge bg-success" style="color:white;">Service</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary">—</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($package->name); ?></td>
                                                        <td><?php echo e(number_format($package->price, 2)); ?></td>
                                                        <td>
                                                            <?php if($package->validity): ?>
                                                                <?php echo e($package->validity); ?>

                                                            <?php else: ?>
                                                                —
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($package->is_active): ?>
                                                                <span class="badge badge-success">Active</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Inactive</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($package->created_at->format('d M Y, h:i A')); ?></td>
                                                        <td class="text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-light dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="<?php echo e(route('admin.packages.edit', $package->id)); ?>">
                                                                            <i class="fas fa-edit text-primary me-2"></i> Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            onclick="deletePackage(<?php echo e($package->id); ?>)">
                                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No packages found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <?php echo e($packages->links()); ?>

                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function deletePackage(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This package will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?php echo e(url('admin/packages')); ?>/${id}`,
                        type: 'DELETE',
                        data: { _token: '<?php echo e(csrf_token()); ?>' },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Deleted!', res.message, 'success');
                                setTimeout(() => location.reload(), 500);
                            } else {
                                Swal.fire('Error!', res.message || 'Failed to delete.', 'error');
                            }
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/packages/index.blade.php ENDPATH**/ ?>