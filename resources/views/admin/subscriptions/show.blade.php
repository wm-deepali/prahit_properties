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
                                <h3 class="content-header-title">Subscription Details</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
                                    <li class="breadcrumb-item active">Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-main-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4>{{ $subscription->plan_name ?? 'Subscription' }}</h4>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>User Details</th>
                                            <td>  
                                            {{ $subscription->user->firstname ?? 'N/A' }} {{ $subscription->user->lastname ?? '' }}<br/>
                                                            {{ $subscription->user->email ?? '' }}<br/>
                                                            {{ $subscription->user->mobile_number ?? '' }}
                                                        </td>
                                        </tr>
                                        <tr>
                                            <th>Plan Name</th>
                                             <td>{{ $subscription->package->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ $subscription->amount ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Id</th>
                                            <td>{{ $subscription->transaction_id ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>
                                                 @if($subscription->payment_status === 'paid')
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            @elseif($subscription->payment_status === 'unpaid')
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->payment_status) }}</span>
                                                            @endif
                                            </td>
                                        </tr>
                                            <th>Status</th>
                                             <td>
                                                            @if($subscription->is_active === 1)
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            @elseif($subscription->status === 0)
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->status) }}</span>
                                                            @endif
                                                        </td>
                                        </tr>
                                        <tr>
                                             @if($subscription->package->package_type === 'property')
                                             <th>Used Listings</th>
                                             <td>{{ $subscription->used_listings ?? '-' }}</td>
                                             @else
                                               <th>Used Services</th>
                                             <td>{{ $subscription->used_services ?? '-' }}</td>
                                                @endif
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $subscription->start_date ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $subscription->end_date ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $subscription->created_at ? $subscription->created_at->format('d M Y, h:i A') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $subscription->updated_at ? $subscription->updated_at->format('d M Y, h:i A') : '-' }}</td>
                                        </tr>
                                    </table>
                                    <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
