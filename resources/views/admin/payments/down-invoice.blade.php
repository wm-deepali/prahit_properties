<!DOCTYPE html>
<html>

<head>
    <title>Izharson Perfumers - Order Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <style type="text/css">
        @page {
            size: 8in 10.25in;
            margin: 10mm;
            mso-header-margin: .5in;
            mso-footer-margin: .5in;
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div style="border: 1px solid #ddd; padding-left: 15px;">
        <div class="inovice-view">

            <table style="width:100%; border-collapse: collapse;">

                <!-- HEADER LOGO + COMPANY DETAILS -->
                <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="3">
                        <div style="max-width:290px;">
                            <img src="{{ URL::asset('images/logoicon.png') }}" style="height: 50px;">
                        </div>
                    </td>

                    <td colspan="2" style="text-align: right;">
                        <h6 style="margin-bottom: 5px; font-size: 15px; font-weight: bold; text-transform:uppercase">
                            Invoice
                        </h6>
                        <p style="margin-bottom: 0; font-size: 12px;">
                            <strong>Company Name: </strong> ABC
                        </p>
                        <p style="margin-bottom: 0; font-size: 12px;">
                            <strong>Address: </strong> ABC
                        </p>
                        <p style="margin-bottom: 0; font-size: 12px;">
                            <strong>Tax Number: </strong> ABC
                        </p>
                    </td>
                </tr>

                <!-- INVOICE TO + PAYMENT DETAILS -->
                <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="3">
                        <div style="margin-bottom: 15px;">
                            <h6 style="margin-bottom: 10px; font-size: 12px; font-weight: bold;">Invoice To</h6>

                            <p style="font-size: 12px; margin-bottom: 0;">
                                <strong>Name:</strong>
                                {{ $payment->user->firstname ?? '' }} {{ $payment->user->lastname ?? '' }}
                            </p>

                            <p style="font-size: 12px; margin-bottom: 0;">
                                <strong>Address:</strong>
                                {{ $payment->user->address ?? '' }},
                                {{ $payment->user->getCity->name ?? '' }},
                                {{ $payment->user->getState->name ?? '' }}
                            </p>

                            <p style="font-size: 12px; margin-bottom: 0;">
                                <strong>Phone Number:</strong> {{ $payment->user->mobile_number ?? '' }}
                            </p>

                            <p style="font-size: 12px; margin-bottom: 0;">
                                <strong>Email:</strong> {{ $payment->user->email ?? '' }}
                            </p>
                        </div>
                    </td>

                    <td colspan="2" style="text-align: right;">
                        <h6 style="margin-bottom: 10px; font-size: 12px; font-weight: bold;">Payment Details</h6>

                        <p style="font-size: 12px; margin-bottom: 0;">
                            <strong>Invoice Number:</strong> {{ $invoice->invoice_number ?? '' }}
                        </p>

                        <p style="font-size: 12px; margin-bottom: 0;">
                            <strong>Order Date:</strong> {{ $invoice->created_at ?? '' }}
                        </p>

                        <p style="font-size: 12px; margin-bottom: 0;">
                            <strong>Payment Status:</strong> {{ $payment->status ?? '' }}
                        </p>
                    </td>
                </tr>

                <!-- TABLE HEADERS -->
                <tr style="background-color: #ddd; font-weight: bold;">
                    <th style="padding:6px; font-size: 12px;">#</th>
                    <th style="padding:6px; font-size: 12px;">Product Name</th>
                    <th style="padding:6px; font-size: 12px;">MRP (Per QTY)</th>
                    <th style="padding:6px; font-size: 12px;">Quantity</th>
                    <th style="padding:6px; font-size: 12px;">Product Cost</th>
                </tr>

                <!-- PRODUCT ROW -->
                @if(isset($payment->subscription))
                <tr style="font-size: 14px;">
                    <td style="padding:10px; border:1px solid #ddd;">1</td>

                    <td style="padding:10px; border:1px solid #ddd;">
                        {{ $payment->subscription->package->name }}
                        <br>
                        <span style="font-size:11px; font-weight:400;">
                            Validity: {{ $payment->subscription->package->validity }}
                        </span>
                    </td>

                    <td style="padding:10px; border:1px solid #ddd;">
                        {{ $payment->subscription->amount }}
                    </td>

                    <td style="padding:10px; border:1px solid #ddd;">1</td>

                    <td style="padding:10px; border:1px solid #ddd;">
                        {{ $payment->amount }}
                    </td>
                </tr>
                @endif

                <!-- SUBTOTAL -->
                <tr style="font-size: 14px;">
                    <td colspan="4" style="text-align: right; padding-right:10px;">
                        <strong>Sub Total</strong>
                    </td>
                    <td style="padding:10px; border:1px solid #ddd;">
                        Rs {{ $payment->subscription->amount }}
                    </td>
                </tr>

                <!-- GRAND TOTAL -->
                <tr style="font-size: 14px;">
                    <td colspan="4" style="text-align: right; padding-right:10px;">
                        <strong>Grand Total</strong>
                    </td>
                    <td style="padding:10px; border:1px solid #ddd;">
                        <strong>Rs {{ $payment->amount }}</strong>
                    </td>
                </tr>

                <!-- NOTE -->
                <tr style="font-size: 14px; color:red;">
                    <td colspan="5" style="text-align: left; border-top: 1px solid #ddd; padding: 20px 10px;">
                        <h4 style="margin: 0; font-size: 18px;">
                            Note: All prices are including applicable taxes.
                        </h4>
                    </td>
                </tr>

            </table>

        </div>
    </div>
</body>

</html>
