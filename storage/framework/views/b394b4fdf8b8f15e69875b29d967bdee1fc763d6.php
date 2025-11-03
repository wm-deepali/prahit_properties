<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>All Invoices</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice { page-break-after: always; margin-bottom: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top:10px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 14px; }
        th { background: #f4f6fb; font-weight: bold; }
        h2 { margin: 0; }
    </style>
</head>
<body>
    <h1>All Invoices for <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></h1>

    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="invoice">
            <h2>Invoice #<?php echo e($invoice->invoice_number); ?></h2>
            <p>Date: <?php echo e($invoice->invoice_date->format('d M Y')); ?></p>

            <table>
                <tr><th>Subscription Name</th><td><?php echo e($invoice->subscription->package->name ?? 'N/A'); ?></td></tr>
                <tr><th>Total Amount</th><td>₹<?php echo e(number_format($invoice->total_amount ?? $invoice->amount, 2)); ?></td></tr>
                <tr><th>Paid Amount</th><td>₹<?php echo e(number_format($invoice->amount, 2)); ?></td></tr>
                <tr><th>Payment Status</th><td><?php echo e(ucfirst($invoice->status ?? $invoice->payment_status)); ?></td></tr>
                <tr><th>Transaction ID</th><td><?php echo e($invoice->subscription->transaction_id ?? '—'); ?></td></tr>
                <tr><th>Current Status</th>
                    <td>
                        <?php if($invoice->subscription->is_active): ?>
                            Active
                        <?php else: ?>
                            Expired
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/invoices_all_pdf.blade.php ENDPATH**/ ?>