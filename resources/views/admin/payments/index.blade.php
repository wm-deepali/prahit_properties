@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            {{-- Breadcrumb --}}
            <section class="breadcrumb-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="content-header">
                                <h3 class="content-header-title">Payments</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Payments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Tabs --}}
            <section class="content-main-body">
                <div class="container-fluid">
                    <ul class="nav nav-tabs" id="paymentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="success-tab" data-bs-toggle="tab"
                                data-bs-target="#success" type="button" role="tab"
                                aria-controls="success" aria-selected="true">
                                Successful Payments
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="failed-tab" data-bs-toggle="tab"
                                data-bs-target="#failed" type="button" role="tab"
                                aria-controls="failed" aria-selected="false">
                                Failed / Pending
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="paymentTabsContent">

                        {{-- Successful Payments Tab --}}
                        <div class="tab-pane fade show active" id="success" role="tabpanel"
                             aria-labelledby="success-tab">

                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Package</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($payments->where('status', 'success') as $payment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        <td>
                                                            {{ $payment->user->firstname ?? 'N/A' }}
                                                            {{ $payment->user->lastname ?? '' }} <br>
                                                            {{ $payment->user->email ?? '' }} <br>
                                                            {{ $payment->user->mobile_number ?? '' }}
                                                        </td>

                                                        <td>{{ $payment->package->name ?? '-' }}</td>
                                                        <td>{{ $payment->amount ?? '-' }} {{ $payment->currency }}</td>
                                                        <td>{{ $payment->transaction_id ?? '-' }}</td>
                                                        <td>{{ ucfirst($payment->payment_method) ?? '-' }}</td>

                                                        <td>
                                                            <span class="badge bg-success" style="color:white;">Success</span>
                                                        </td>

                                                        <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>

                                                         <td class="text-center">
    <a href="{{ route('admin.payments.show', $payment->id) }}"
       class="btn btn-sm btn-primary" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{ route('admin.payments.invoice', $payment->id) }}"
       class="btn btn-sm btn-info" title="View Invoice">
        <i class="fas fa-file-invoice"></i>
    </a>
</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">
                                                            No successful payments found.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            {{ $payments->links() }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Failed / Pending Payments Tab --}}
                        <div class="tab-pane fade" id="failed" role="tabpanel" aria-labelledby="failed-tab">

                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Package</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($payments->where('status', '!=', 'success') as $payment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        <td>
                                                            {{ $payment->user->firstname ?? 'N/A' }}
                                                            {{ $payment->user->lastname ?? '' }} <br>
                                                            {{ $payment->user->email ?? '' }} <br>
                                                            {{ $payment->user->mobile_number ?? '' }}
                                                        </td>

                                                        <td>{{ $payment->package->name ?? '-' }}</td>
                                                        <td>{{ $payment->amount ?? '-' }} {{ $payment->currency }}</td>
                                                        <td>{{ $payment->transaction_id ?? '-' }}</td>
                                                        <td>{{ ucfirst($payment->payment_method) ?? '-' }}</td>

                                                        <td>
                                                            @if($payment->status === 'failed')
                                                                <span class="badge bg-danger" style="color:white;">Failed</span>
                                                            @elseif($payment->status === 'pending')
                                                                <span class="badge bg-warning" style="color:white;">Pending</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                                                            @endif
                                                        </td>

                                                        <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>

                                                       <td class="text-center">
    <a href="{{ route('admin.payments.show', $payment->id) }}"
       class="btn btn-sm btn-primary" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{ route('admin.payments.invoice', $payment->id) }}"
       class="btn btn-sm btn-info" title="View Invoice">
        <i class="fas fa-file-invoice"></i>
    </a>
</td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">
                                                            No failed/pending payments found.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            {{ $payments->links() }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> {{-- tab content --}}
                </div>
            </section>

        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
