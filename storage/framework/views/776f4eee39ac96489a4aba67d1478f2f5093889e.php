

<?php $__env->startSection('title', 'Payment Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-light rounded">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">Payment Details</h4>
                    <small class="text-muted">View full payment information</small>
                </div>

                <a href="<?php echo e(route('admin.payments.index')); ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="250">Payment ID</th>
                        <td><?php echo e($payment->id); ?></td>
                    </tr>

                    <tr>
                        <th>User</th>
                        <td>
                            <strong><?php echo e($payment->user->firstname ?? 'N/A'); ?> <?php echo e($payment->user->lastname); ?></strong><br>
                            <?php echo e($payment->user->email); ?> <br>
                            <?php echo e($payment->user->mobile_number); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>Package</th>
                        <td><?php echo e($payment->package->name ?? 'N/A'); ?></td>
                    </tr>

                    <tr>
                        <th>Amount</th>
                        <td><strong>₹<?php echo e(number_format($payment->amount, 2)); ?></strong></td>
                    </tr>

                    <tr>
                        <th>Transaction ID</th>
                        <td><?php echo e($payment->transaction_id); ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($payment->status == 'success'): ?>
                                <span class="badge bg-success">Success</span>
                            <?php elseif($payment->status == 'failed'): ?>
                                <span class="badge bg-danger">Failed</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Payment Method</th>
                        <td><?php echo e(ucfirst($payment->payment_method)); ?></td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td><?php echo e($payment->created_at->format('d M Y, h:i A')); ?></td>
                    </tr>
                </table>
            </div>

            <hr class="my-4">

            
            <h4 class="mb-3">Invoice Details</h4>

            <?php if($payment->invoice): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">

                        <tr>
                            <th width="250">Invoice Number</th>
                            <td><?php echo e($payment->invoice->invoice_number); ?></td>
                        </tr>

                        <tr>
                            <th>Invoice Date</th>
                            <td><?php echo e($payment->invoice->invoice_date->format('d M Y')); ?></td>
                        </tr>

                        <tr>
                            <th>Billing Name</th>
                            <td><?php echo e($payment->invoice->billing_name); ?></td>
                        </tr>

                        <tr>
                            <th>Billing Email</th>
                            <td><?php echo e($payment->invoice->billing_email); ?></td>
                        </tr>

                        <tr>
                            <th>Billing Phone</th>
                            <td><?php echo e($payment->invoice->billing_phone); ?></td>
                        </tr>

                        <tr>
                            <th>Billing Address</th>
                            <td><?php echo e($payment->invoice->billing_address); ?></td>
                        </tr>

                        <tr>
                            <th>Amount</th>
                            <td><?php echo e($payment->invoice->amount); ?> <?php echo e($payment->invoice->currency); ?></td>
                        </tr>

                        <tr>
                            <th>Tax</th>
                            <td><?php echo e($payment->invoice->tax_amount); ?></td>
                        </tr>

                        <tr>
                            <th>Total Amount</th>
                            <td>
                                <strong><?php echo e($payment->invoice->total_amount); ?> <?php echo e($payment->invoice->currency); ?></strong>
                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td><?php echo e(ucfirst($payment->invoice->status)); ?></td>
                        </tr>

                        <tr>
                            <th>Invoice File</th>
                            <td>
                                <?php if($payment->invoice->invoice_file): ?>
                                    <a href="<?php echo e(asset('storage/' . $payment->invoice->invoice_file)); ?>"
                                       target="_blank"
                                       class="btn btn-success btn-sm">
                                        <i class="fas fa-file-invoice"></i> View / Download Invoice
                                    </a>
                                <?php else: ?>
                                    <span class="text-danger">No invoice file uploaded.</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                    </table>
                </div>

            <?php else: ?>
                <div class="alert alert-warning">
                    No invoice generated for this payment.
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/payments/show.blade.php ENDPATH**/ ?>