<!DOCTYPE html>
<html>

<head>
    <title>Invoice - <?php echo e($invoice->invoice_number ?? ''); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            border: 1px solid #ddd;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            font-size: 12px;
            padding: 8px;
            border: 1px solid #ddd;
        }

        .no-border td {
            border: none !important;
        }

        .header-table td {
            border: none !important;
        }

        .heading-row {
            background-color: #ddd;
            font-weight: bold;
        }

        .note {
            margin-top: 40px;
            color: red;
            font-size: 16px;
        }

    </style>
</head>

<body>

    <div class="invoice-container">

        <table class="header-table">
            <tr>
                <td colspan="4">
                    <img src="<?php echo e(asset('images/logoicon.png')); ?>" style="height: 50px;">
                </td>

                <td colspan="3" style="text-align:right;">
                    <h3 style="margin:0;">Invoice</h3>
                    <p>Company Name: <strong>ABC</strong></p>
                    <p>Address: <strong>ABC</strong></p>
                    <p>Tax Number: <strong>ABC</strong></p>
                </td>
            </tr>
        </table>

        <table class="no-border">
            <tr>
                <td colspan="4">
                    <h4>Invoice To</h4>
                    <p><strong>Name:</strong> <?php echo e($payment->user->firstname); ?> <?php echo e($payment->user->lastname); ?></p>
                    <p><strong>Address:</strong>
                        <?php echo e($payment->user->address); ?>,
                        <?php echo e($payment->user->getCity->name ?? ''); ?>,
                        <?php echo e($payment->user->getState->name ?? ''); ?>

                    </p>
                    <p><strong>Phone:</strong> <?php echo e($payment->user->mobile_number); ?></p>
                    <p><strong>Email:</strong> <?php echo e($payment->user->email); ?></p>
                </td>

                <td colspan="3" style="text-align:right;">
                    <h4>Payment Details</h4>
                    <p><strong>Invoice Number:</strong> <?php echo e($invoice->invoice_number); ?></p>
                    <p><strong>Order Date:</strong> <?php echo e($invoice->created_at); ?></p>
                    <p><strong>Status:</strong> <?php echo e(ucfirst($payment->status)); ?></p>
                </td>
            </tr>
        </table>

        <table>
            <tr class="heading-row">
                <th>#</th>
                <th>Product Name</th>
                <th>MRP (Per QTY)</th>
                <th>Quantity</th>
                <th>Product Cost</th>
            </tr>

            <?php if(isset($payment->subscription)): ?>
                <tr>
                    <td>1</td>
                    <td>
                        <?php echo e($payment->subscription->package->name); ?>

                        <br>
                        <small>Validity: <?php echo e($payment->subscription->package->validity); ?></small>
                    </td>
                    <td><?php echo e($payment->subscription->amount); ?></td>
                    <td>1</td>
                    <td><?php echo e($payment->amount); ?></td>
                </tr>
            <?php endif; ?>

            <tr>
                <td colspan="4" style="text-align:right;"><strong>Sub Total</strong></td>
                <td>Rs <?php echo e($payment->subscription->amount); ?></td>
            </tr>

            <tr>
                <td colspan="4" style="text-align:right;"><strong>Grand Total</strong></td>
                <td><strong>Rs <?php echo e($payment->amount); ?></strong></td>
            </tr>
        </table>

        <p class="note">
            Note: All prices include applicable taxes.
        </p>

    </div>

</body>

</html>
<?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/payments/invoice.blade.php ENDPATH**/ ?>