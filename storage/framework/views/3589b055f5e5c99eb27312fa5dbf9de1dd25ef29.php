<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice <?php echo e($invoice->invoice_number); ?></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f0f0f0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Invoice #<?php echo e($invoice->invoice_number); ?></h2>
        <p>Date: <?php echo e($invoice->invoice_date->format('d M Y')); ?></p>
    </div>
    <table>
        <tr>
            <th>Subscription Name</th>
            <td><?php echo e($invoice->subscription->package->name ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>₹<?php echo e(number_format($invoice->amount, 2)); ?></td>
        </tr>
        <tr>
            <th>Paid Amount</th>
            <td>₹<?php echo e(number_format($invoice->amount, 2)); ?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td><?php echo e(ucfirst($invoice->status ?? $invoice->payment_status)); ?></td>
        </tr>
        <tr>
            <th>Transaction ID</th>
            <td><?php echo e($invoice->subscription->transaction_id ?? '—'); ?></td>
        </tr>
        <tr>
            <th>Current Status</th>
            <td>
                <?php if($invoice->subscription->is_active): ?>
                    <span class="status-active">Active</span>
                <?php else: ?>
                    <span class="status-expired">Expired</span>
                <?php endif; ?>
            </td>
        </tr>
    </table>

</body>

</html><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/invoice_pdf.blade.php ENDPATH**/ ?>