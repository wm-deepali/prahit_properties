@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Payment Details</h5>
                <h6 class="card-subtitle mb-2 text-muted">View full payment information</h6>

                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Back
                </a>

                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $payment->id }}</td>
                    </tr>

                    <tr>
                        <th>User</th>
                        <td>
                            {{ $payment->user->firstname ?? 'N/A' }}
                            {{ $payment->user->lastname ?? '' }} <br>
                            {{ $payment->user->email ?? '' }} <br>
                            {{ $payment->user->mobile_number ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Package</th>
                        <td>{{ $payment->package->name ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Amount</th>
                        <td>₹{{ number_format($payment->amount, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $payment->transaction_id }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($payment->status == 'success')
                                <span class="badge bg-success text-light">Success</span>
                            @elseif($payment->status == 'failed')
                                <span class="badge bg-danger text-light">Failed</span>
                            @else
                                <span class="badge bg-warning text-light">Pending</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $payment->payment_method }}</td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                    </tr>

                </table>

                
            </div>
        </div>
    </div>
@endsection