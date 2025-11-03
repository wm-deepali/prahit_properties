@extends('layouts.front.app')

@section('title')
  <title>My Subscriptions</title>
@endsection

@section('content')

  <section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>My Subscriptions</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">My Subscriptions</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="owner-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          @include('front.user.sidebar')
        </div>

        <div class="col-sm-9">

          {{-- 🔷 Current Subscription Card --}}
          @if($currentSubscriptions->isNotEmpty())
            @php $current = $currentSubscriptions->first(); @endphp

            <div class="card shadow-lg mb-4 border-0 rounded-4 overflow-hidden">
              <div class="row g-0 align-items-center">

                {{-- Left Side: Subscription Card --}}
                <div class="col-md-5 m-3">
                  <div class="p-4 text-white h-100 d-flex flex-column justify-content-center"
                    style="background: linear-gradient(135deg, #4facfe, #00f2fe); border-radius: .5rem; width: 92%;">

                    <h5 class="fw-bold mb-3">Subscription Details</h5>
                    <div class="mb-3">
                      <p class="mb-1"><strong>Customer Name:</strong> {{ $current->user->full_name ?? '' }}</p>
                      <p class="mb-1"><strong>Mobile Number:</strong> {{ $current->user->mobile_number ?? 'N/A' }}</p>
                      <p class="mb-1"><strong>Email ID:</strong> {{ $current->user->email ?? 'N/A' }}</p>
                    </div>

                    <div>
                      <p class="mb-1"><strong>Subscription Name:</strong> {{ $current->package->name ?? 'N/A' }}</p>
                      <p class="mb-1">
                        <strong>Validity:</strong>
                        {{ $current->package->validity ?? '-' }}
                        (Till
                        {{ $current->end_date ? \Carbon\Carbon::parse($current->end_date)->format('d M Y') : 'Ongoing' }})
                      </p>
                      <p class="mb-1">
                        <strong>Status:</strong>
                        <span class="badge bg-success">Active</span>
                      </p>
                    </div>
                  </div>
                </div>

                {{-- Right Side: Listing Stats --}}
                <div class="col-md-6">
                  <div class="card-body p-4">
                    <h6 class="fw-bold text-uppercase mb-3">Account Summary</h6>

                    <div class="row text-center mb-3">
                      @if($type === 'property')
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-primary mb-0">{{ $current->package->number_of_listing ?? 0 }}</h5>
                            <small>Total Listings</small>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-success mb-0">{{ $current->used_listings ?? 0 }}</h5>
                            <small>Properties Posted</small>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-danger mb-0">
                              {{ ($current->package->number_of_listing ?? 0) - ($current->used_listings ?? 0) }}
                            </h5>
                            <small>Remaining</small>
                          </div>
                        </div>
                      @elseif($type === 'service')
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-primary mb-0">{{ $current->package->total_services ?? 0 }}</h5>
                            <small>Total Services</small>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-success mb-0">{{ $current->used_services ?? 0 }}</h5>
                            <small>Services Posted</small>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                            <h5 class="fw-bold text-danger mb-0">
                              {{ ($current->package->total_services ?? 0) - ($current->used_services ?? 0) }}
                            </h5>
                            <small>Remaining</small>
                          </div>
                        </div>
                      @endif
                    </div>

                    <div class="d-flex gap-2 mt-3" style="gap:20px;">
                      <button class="btn btn-primary btn-sm px-3">
                        <i class="fas fa-sync-alt me-1"></i> Renew Now
                      </button>
                      <button class="btn btn-outline-primary btn-sm px-3">
                        <i class="fas fa-arrow-up me-1"></i> Upgrade Now
                      </button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          @else
            <div class="alert alert-info">You have no active subscription at the moment.</div>
          @endif

          {{-- 📜 Previous History Table --}}
          <h5 class="fw-bold mb-3">Previous History</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>Date & Time</th>
                  <th>Subscription Name</th>
                  <th>Validity</th>
                  <th>Paid Amount</th>
                  <th>Invoice Number</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($subscriptionHistory as $history)
                  <tr>
                    <td>{{ $history->created_at->format('d M Y, h:i A') }}</td>
                    <td>{{ $history->package->name ?? 'N/A' }}</td>
                    <td>{{ $history->package->validity ?? '-' }}</td>
                    <td>₹{{ number_format($history->amount, 2) }}</td>
                    <td>{{ $history->invoice->invoice_number ?? 'N/A' }}</td>
                    <td>
                      <span class="badge bg-success">Paid</span>
                    </td>
                    <td>
                      @if(isset($history->invoice))
                        <a href="{{ route('invoice-details', $history->id) }}" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-file-invoice"></i> View Invoice
                        </a>
                      @else
                        <span class="text-muted">N/A</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center text-muted">No previous subscriptions found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </section>

@endsection