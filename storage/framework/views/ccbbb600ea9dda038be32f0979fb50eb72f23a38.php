

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
                                <h3 class="content-header-title">Payments</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Payments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
            <section class="content-main-body">
                <div class="container-fluid">
                    <ul class="nav nav-tabs" id="paymentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="success-tab" data-bs-toggle="tab"
                                data-bs-target="#success" type="button" role="tab"
                                aria-controls="success" aria-selected="true">
                                Successful Payments
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="failed-tab" data-bs-toggle="tab"
                                data-bs-target="#failed" type="button" role="tab"
                                aria-controls="failed" aria-selected="false">
                                Failed / Pending
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="paymentTabsContent">

                        
                        <div class="tab-pane fade show active" id="success" role="tabpanel"
                             aria-labelledby="success-tab">

                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Package</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $payments->where('status', 'success'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>

                                                        <td>
                                                            <?php echo e($payment->user->firstname ?? 'N/A'); ?>

                                                            <?php echo e($payment->user->lastname ?? ''); ?> <br>
                                                            <?php echo e($payment->user->email ?? ''); ?> <br>
                                                            <?php echo e($payment->user->mobile_number ?? ''); ?>

                                                        </td>

                                                        <td><?php echo e($payment->package->name ?? '-'); ?></td>
                                                        <td><?php echo e($payment->amount ?? '-'); ?> <?php echo e($payment->currency); ?></td>
                                                        <td><?php echo e($payment->transaction_id ?? '-'); ?></td>
                                                        <td><?php echo e(ucfirst($payment->payment_method) ?? '-'); ?></td>

                                                        <td>
                                                            <span class="badge bg-success" style="color:white;">Success</span>
                                                        </td>

                                                        <td><?php echo e($payment->created_at->format('Y-m-d H:i')); ?></td>

                                                         <td class="text-center">
    <a href="<?php echo e(route('admin.payments.show', $payment->id)); ?>"
       class="btn btn-sm btn-primary" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    <a href="<?php echo e(route('admin.payments.invoice', $payment->id)); ?>"
       class="btn btn-sm btn-info" title="View Invoice">
        <i class="fas fa-file-invoice"></i>
    </a>
</td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center">
                                                            No successful payments found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            <?php echo e($payments->links()); ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="tab-pane fade" id="failed" role="tabpanel" aria-labelledby="failed-tab">

                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Package</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $payments->where('status', '!=', 'success'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>

                                                        <td>
                                                            <?php echo e($payment->user->firstname ?? 'N/A'); ?>

                                                            <?php echo e($payment->user->lastname ?? ''); ?> <br>
                                                            <?php echo e($payment->user->email ?? ''); ?> <br>
                                                            <?php echo e($payment->user->mobile_number ?? ''); ?>

                                                        </td>

                                                        <td><?php echo e($payment->package->name ?? '-'); ?></td>
                                                        <td><?php echo e($payment->amount ?? '-'); ?> <?php echo e($payment->currency); ?></td>
                                                        <td><?php echo e($payment->transaction_id ?? '-'); ?></td>
                                                        <td><?php echo e(ucfirst($payment->payment_method) ?? '-'); ?></td>

                                                        <td>
                                                            <?php if($payment->status === 'failed'): ?>
                                                                <span class="badge bg-danger" style="color:white;">Failed</span>
                                                            <?php elseif($payment->status === 'pending'): ?>
                                                                <span class="badge bg-warning" style="color:white;">Pending</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e(ucfirst($payment->status)); ?></span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td><?php echo e($payment->created_at->format('Y-m-d H:i')); ?></td>

                                                       <td class="text-center">
    <a href="<?php echo e(route('admin.payments.show', $payment->id)); ?>"
       class="btn btn-sm btn-primary" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    <a href="<?php echo e(route('admin.payments.invoice', $payment->id)); ?>"
       class="btn btn-sm btn-info" title="View Invoice">
        <i class="fas fa-file-invoice"></i>
    </a>
</td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center">
                                                            No failed/pending payments found.
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            <?php echo e($payments->links()); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>