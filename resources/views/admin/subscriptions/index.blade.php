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
                                <h3 class="content-header-title">User Subscriptions</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Subscriptions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Tabs --}}
            <section class="content-main-body">
                <div class="container-fluid">
                    <ul class="nav nav-tabs" id="subscriptionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                                type="button" role="tab" aria-controls="active" aria-selected="true">Active</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired"
                                type="button" role="tab" aria-controls="expired" aria-selected="false">Expired</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="subscriptionTabsContent">
                        <!-- Active Subscriptions Tab -->
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="active-subscriptions-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Plan Name</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Id</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Started At</th>
                                                    <th>Ends At</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($subscriptions->where('is_active', 1) as $subscription)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $subscription->user->firstname ?? 'N/A' }} {{ $subscription->user->lastname ?? '' }}<br/>
                                                            {{ $subscription->user->email ?? '' }}<br/>
                                                            {{ $subscription->user->mobile_number ?? '' }}
                                                        </td>
                                                        <td>{{ $subscription->package->name ?? '-' }}</td>
                                                        <td>{{ $subscription->amount ?? '-' }}</td>
                                                        <td>{{ $subscription->transaction_id ?? '' }}</td>
                                                        <td>
                                                            @if($subscription->payment_status === 'paid')
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            @elseif($subscription->payment_status === 'unpaid')
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->payment_status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($subscription->is_active === 1)
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            @elseif($subscription->status === 0)
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $subscription->start_date ?? '-' }}</td>
                                                        <td>{{ $subscription->end_date ?? '-' }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.subscriptions.show', $subscription->id) }}"
                                                               class="btn btn-sm btn-primary" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">No active subscriptions found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                            {{ $subscriptions->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Expired Subscriptions Tab -->
                        <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="expired-subscriptions-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Details</th>
                                                    <th>Plan Name</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Id</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Started At</th>
                                                    <th>Ends At</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($subscriptions->where('is_active', '!=', 1) as $subscription)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $subscription->user->firstname ?? 'N/A' }} {{ $subscription->user->lastname ?? '' }}<br/>
                                                            {{ $subscription->user->email ?? '' }}<br/>
                                                            {{ $subscription->user->mobile_number ?? '' }}
                                                        </td>
                                                        <td>{{ $subscription->package->name ?? '-' }}</td>
                                                        <td>{{ $subscription->amount ?? '-' }}</td>
                                                        <td>{{ $subscription->transaction_id ?? '' }}</td>
                                                        <td>
                                                            @if($subscription->payment_status === 'paid')
                                                                <span class="badge bg-success" style="color:white;">Paid</span>
                                                            @elseif($subscription->payment_status === 'unpaid')
                                                                <span class="badge bg-danger" style="color:white;">UnPaid</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->payment_status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($subscription->is_active === 1)
                                                                <span class="badge bg-success" style="color:white;">Active</span>
                                                            @elseif($subscription->status === 0)
                                                                <span class="badge bg-danger" style="color:white;">Expired</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($subscription->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $subscription->start_date ?? '-' }}</td>
                                                        <td>{{ $subscription->end_date ?? '-' }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.subscriptions.show', $subscription->id) }}"
                                                               class="btn btn-sm btn-primary" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">No expired subscriptions found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-end">
                                           {{ $subscriptions->links() }}
                                        </div>
                                    </div>
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
