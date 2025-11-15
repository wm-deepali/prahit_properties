<!DOCTYPE html>
<html>

<head>
    <title>Invoice - {{ $invoice->invoice_number ?? '' }}</title>
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
                    <img src="{{ asset('images/logoicon.png') }}" style="height: 50px;">
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
                    <p><strong>Name:</strong> {{ $payment->user->firstname }} {{ $payment->user->lastname }}</p>
                    <p><strong>Address:</strong>
                        {{ $payment->user->address }},
                        {{ $payment->user->getCity->name ?? '' }},
                        {{ $payment->user->getState->name ?? '' }}
                    </p>
                    <p><strong>Phone:</strong> {{ $payment->user->mobile_number }}</p>
                    <p><strong>Email:</strong> {{ $payment->user->email }}</p>
                </td>

                <td colspan="3" style="text-align:right;">
                    <h4>Payment Details</h4>
                    <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Order Date:</strong> {{ $invoice->created_at }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
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

            @if(isset($payment->subscription))
                <tr>
                    <td>1</td>
                    <td>
                        {{ $payment->subscription->package->name }}
                        <br>
                        <small>Validity: {{ $payment->subscription->package->validity }}</small>
                    </td>
                    <td>{{ $payment->subscription->amount }}</td>
                    <td>1</td>
                    <td>{{ $payment->amount }}</td>
                </tr>
            @endif

            <tr>
                <td colspan="4" style="text-align:right;"><strong>Sub Total</strong></td>
                <td>Rs {{ $payment->subscription->amount }}</td>
            </tr>

            <tr>
                <td colspan="4" style="text-align:right;"><strong>Grand Total</strong></td>
                <td><strong>Rs {{ $payment->amount }}</strong></td>
            </tr>
        </table>

        <p class="note">
            Note: All prices include applicable taxes.
        </p>

    </div>

</body>

</html>
