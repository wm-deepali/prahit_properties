

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
                                <h3 class="content-header-title">User Subscriptions</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Subscriptions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
            <section class="content-main-body">
                <div class="container-fluid">
                    <ul class="nav nav-tabs" id="subscriptionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                                type="button" role="tab" aria-controls="active" aria-selected="true">Active</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired"
                                type="button" role="tab" aria-controls="expired" aria-selected="false">Expired</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="subscriptionTabsContent">
                        <!-- Active Subscriptions Tab -->
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="active-subscriptions-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Plan Name</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Id</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Started At</th>
                                                    <th>Ends At</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $subscriptions->where('is_active', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                                            <?php echo e($subscription->user->firstname ?? 'N/A'); ?> <?php echo e($subscription->user->lastname ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->email ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->mobile_number ?? ''); ?>

                                                        </td>
                                                        <td><?php echo e($subscription->package->name ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->amount ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->transaction_id ?? ''); ?></td>
                                                        <td>
                                                            <?php if($subscription->payment_status === 'paid'): ?>
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            <?php elseif($subscription->payment_status === 'unpaid'): ?>
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->payment_status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($subscription->is_active === 1): ?>
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            <?php elseif($subscription->status === 0): ?>
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($subscription->start_date ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->end_date ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <a href="<?php echo e(route('admin.subscriptions.show', $subscription->id)); ?>"
                                                               class="btn btn-sm btn-primary" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center">No active subscriptions found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            <?php echo e($subscriptions->links()); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Expired Subscriptions Tab -->
                        <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="expired-subscriptions-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Plan Name</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Id</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Started At</th>
                                                    <th>Ends At</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $subscriptions->where('is_active', '!=', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                                            <?php echo e($subscription->user->firstname ?? 'N/A'); ?> <?php echo e($subscription->user->lastname ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->email ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->mobile_number ?? ''); ?>

                                                        </td>
                                                        <td><?php echo e($subscription->package->name ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->amount ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->transaction_id ?? ''); ?></td>
                                                        <td>
                                                            <?php if($subscription->payment_status === 'paid'): ?>
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            <?php elseif($subscription->payment_status === 'unpaid'): ?>
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->payment_status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($subscription->is_active === 1): ?>
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            <?php elseif($subscription->status === 0): ?>
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($subscription->start_date ?? '-'); ?></td>
                                                        <td><?php echo e($subscription->end_date ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <a href="<?php echo e(route('admin.subscriptions.show', $subscription->id)); ?>"
                                                               class="btn btn-sm btn-primary" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center">No expired subscriptions found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                           <?php echo e($subscriptions->links()); ?>

                                        </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/subscriptions/index.blade.php ENDPATH**/ ?>