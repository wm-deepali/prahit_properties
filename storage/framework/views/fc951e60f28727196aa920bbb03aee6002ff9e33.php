<!DOCTYPE html>
<html>

<head>
    <title>Izharson Perfumers - Order Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Start here SEO Part -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- End here SEO Part -->
    <!--start here favicon-->
    <link rel="shortcut icon" href="" alt="Signo Elevators">

    <!--end here favicon-->
    <!--start here css file-->
    <style type="text/css">
        @page  {
            size: 8in 10.25in;
            margin: 10mm 10mm 10mm 10mm;
            mso-header-margin: .5in;
            mso-footer-margin: .5in;
            mso-paper-source: 0;
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div style="border: 1px solid #ddd; padding-left: 15px;">
 
        <div class="inovice-view">

            <table style="width:100%">

                <tr style="border-bottom: 1px solid #ddd; ">
                    <td colspan="4">
                        <div style="max-width:290px;">
                            <div style="max-width:290px;">
                                
                            </div>
                        </div>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        <h6 style="margin-bottom: 5px; font-size: 15px; font-weight: bold;text-transform:uppercase">
                            Invoice</h6>
                        <p style="margin-bottom: 0px; font-size: 12px; font-weight: bold; ">Company Name - <span
                                style="font-weight: normal;">ABC </span></p>
                        <p style="margin-bottom: 0; font-size: 12px; font-weight: bold; ">Address - <span
                                style="font-weight: normal;">ABC</span></p>
                        <p style="margin-bottom: 0px; font-size: 12px; font-weight: bold; ">Tax Number - <span
                                style="font-weight: normal;">ABC</span></p>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid #ddd; ">
                    <td colspan="4">
                        <div style="max-width:290px;margin-bottom:15px">
                            <h6 style="margin-bottom: 10px; font-size: 12px; font-weight: bold;">Invoice To </h6>
                            <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Name </strong> :
                                <span><?php echo e($payment->user->firstname ?? ''); ?> <?php echo e($payment->user->lastname ?? ''); ?> </span>
                            </p>
                            <p style="font-size: 12px;"><strong>Address </strong> : <?php echo e($payment->user->address ?? ''); ?>,
                                <?php echo e($payment->user->getCity->name ?? ''); ?>, <?php echo e($payment->user->getState->name ?? ''); ?>

                            </p>
                            <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Phone Number </strong> :
                                <span><?php echo e($payment->user->mobile_number ?? ''); ?> </span>
                            </p>
                            <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Email Id </strong> :
                                <span><?php echo e($payment->user->email ?? ''); ?></span>
                            </p>

                        </div>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        <h6 style="margin-bottom: 10px; font-size: 12px; font-weight: bold;">Payment Details </h6>
                        <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Invoice Number </strong> :
                            <span><?php echo e($invoice->invoice_number ?? ''); ?></span>
                        </p>
                        <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Order Date </strong> :
                            <span><?php echo e($invoice->created_at ?? ''); ?></span>
                        </p>
                        <p style="font-size: 12px;margin-bottom: 0px;"> <strong>Payment Status </strong> :
                            <span><?php echo e($payment->status ?? ''); ?></span>
                        </p>
                    </td>
                </tr>

                <tr style="background-color: #ddd;font-weight: normal;">
                    <th style="padding:6px; font-size: 12px;"> # </th>
                    <th style="padding:6px; font-size: 12px;"> Product Image </th>
                    <th style="padding:6px; font-size: 12px;"> Product Name </th>
                    <th style="padding:6px; font-size: 12px;"> MRP (Per QTY)</th>
                    <th style="padding:6px; font-size: 12px;"> Quantity (Per QTY)</th>
                    <th style="padding:6px; font-size: 12px;"> Pre-Discount </th>
                    <th style="padding:6px; font-size: 12px;"> Product Cost </th>
                </tr>
                <?php if(isset($payment->subscription)): ?>
                    <tr style=" font-size: 14px; font-weight: normal;">
                        <td style="padding:10px; border:1px solid #ddd; ">1</td>
                        <td style="padding:10px; border:1px solid #ddd; ">
                            <a href="javascript:void(0)">
                                <img src="<?php echo e(URL::asset('front/images/no_image.jpg')); ?>" class="img-fluid">
                            </a>
                        </td>
                        <td style="padding:10px; border:1px solid #ddd; ">
                            <?php echo e($payment->subscription->package->name); ?>

                            <span style="font-size:11px; font-weight:400">
                                validity <?php echo e($payment->subscription->package->validity); ?>

                            </span>
                        </td>

                        <td style="padding:10px; border:1px solid #ddd; "><?php echo e($payment->subscription->amount); ?></td>
                        <td style="padding:10px; border:1px solid #ddd; ">1</td>
                        <td style="padding:10px; border:1px solid #ddd; ">0
                        </td>
                        <td style="padding:10px; border:1px solid #ddd; "><?php echo e($payment->amount); ?></td>

                    </tr>
                <?php endif; ?>
                <tr style=" font-size: 14px; font-weight: normal;">
                    <td colspan="6" style="text-align: right"> <strong style="padding: 0px 10px"> Sub Total </strong>
                    </td>
                    <td style="padding:10px; border:1px solid #ddd; "> Rs <?php echo e($payment->subscription->amount); ?>

                    </td>
                </tr>
                <tr style=" font-size: 14px; font-weight: normal;">
                    <td colspan="6" style="text-align: right;"> <strong style="padding: 0px 10px"> Grand Total </strong>
                    </td>
                    <td style="padding:10px; border:1px solid #ddd; "> <strong> Rs
                            <?php echo e($payment->amount); ?> </strong> </td>
                </tr>
                <tr style=" font-size: 14px; font-weight: normal;color:red">
                    <td colspan="8" style="text-align: left; border-top: 1px solid #ddd; padding: 0px 10px;">
                        <h4 style="margin-bottom: 2px; font-size: 18px; margin-top: 200px; margin-bottom: 15px;"> Note:-
                            All prices are including applicable taxes </h4>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/payments/invoice.blade.php ENDPATH**/ ?>