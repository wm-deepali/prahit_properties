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
    <h1>All Invoices for {{ $user->firstname }} {{ $user->lastname }}</h1>

    @foreach($invoices as $invoice)
        <div class="invoice">
            <h2>Invoice #{{ $invoice->invoice_number }}</h2>
            <p>Date: {{ $invoice->invoice_date->format('d M Y') }}</p>

            <table>
                <tr><th>Subscription Name</th><td>{{ $invoice->subscription->package->name ?? 'N/A' }}</td></tr>
                <tr><th>Total Amount</th><td>₹{{ number_format($invoice->total_amount ?? $invoice->amount, 2) }}</td></tr>
                <tr><th>Paid Amount</th><td>₹{{ number_format($invoice->amount, 2) }}</td></tr>
                <tr><th>Payment Status</th><td>{{ ucfirst($invoice->status ?? $invoice->payment_status) }}</td></tr>
                <tr><th>Transaction ID</th><td>{{ $invoice->subscription->transaction_id ?? '—' }}</td></tr>
                <tr><th>Current Status</th>
                    <td>
                        @if($invoice->subscription->is_active)
                            Active
                        @else
                            Expired
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
</body>
</html>
