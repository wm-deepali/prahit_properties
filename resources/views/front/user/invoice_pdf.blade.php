<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice {{ $invoice->invoice_number }}</title>
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
        <h2>Invoice #{{ $invoice->invoice_number }}</h2>
        <p>Date: {{ $invoice->invoice_date->format('d M Y') }}</p>
    </div>
    <table>
        <tr>
            <th>Subscription Name</th>
            <td>{{ $invoice->subscription->package->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>₹{{ number_format($invoice->total_amount ?? $invoice->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Paid Amount</th>
            <td>₹{{ number_format($invoice->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>{{ ucfirst($invoice->status ?? $invoice->payment_status) }}</td>
        </tr>
        <tr>
            <th>Transaction ID</th>
            <td>{{ $invoice->subscription->transaction_id ?? '—' }}</td>
        </tr>
        <tr>
            <th>Current Status</th>
            <td>
                @if($invoice->subscription->is_active)
                    <span class="status-active">Active</span>
                @else
                    <span class="status-expired">Expired</span>
                @endif
            </td>
        </tr>
    </table>

</body>

</html>