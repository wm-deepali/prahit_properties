

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
                                <h3 class="content-header-title">Subscription Details</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.subscriptions.index')); ?>">Subscriptions</a></li>
                                    <li class="breadcrumb-item active">Details</li>
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

                                <div class="card-header">
                                    <h4><?php echo e($subscription->plan_name ?? 'Subscription'); ?></h4>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>User Details</th>
                                            <td>  
                                            <?php echo e($subscription->user->firstname ?? 'N/A'); ?> <?php echo e($subscription->user->lastname ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->email ?? ''); ?><br/>
                                                            <?php echo e($subscription->user->mobile_number ?? ''); ?>

                                                        </td>
                                        </tr>
                                        <tr>
                                            <th>Plan Name</th>
                                             <td><?php echo e($subscription->package->name ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td><?php echo e($subscription->amount ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Id</th>
                                            <td><?php echo e($subscription->transaction_id ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>
                                                 <?php if($subscription->payment_status === 'paid'): ?>
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            <?php elseif($subscription->payment_status === 'unpaid'): ?>
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->payment_status)); ?></span>
                                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                            <th>Status</th>
                                             <td>
                                                            <?php if($subscription->is_active === 1): ?>
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            <?php elseif($subscription->status === 0): ?>
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                        </tr>
                                        <tr>
                                             <?php if($subscription->package->package_type === 'property'): ?>
                                             <th>Used Listings</th>
                                             <td><?php echo e($subscription->used_listings ?? '-'); ?></td>
                                             <?php else: ?>
                                               <th>Used Services</th>
                                             <td><?php echo e($subscription->used_services ?? '-'); ?></td>
                                                <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td><?php echo e($subscription->start_date ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td><?php echo e($subscription->end_date ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td><?php echo e($subscription->created_at ? $subscription->created_at->format('d M Y, h:i A') : '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td><?php echo e($subscription->updated_at ? $subscription->updated_at->format('d M Y, h:i A') : '-'); ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="btn btn-secondary mt-3">Back to List</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/subscriptions/show.blade.php ENDPATH**/ ?>