@extends('layouts.front.app')

@section('title')
  <title>My Properties</title>
@endsection



@section('content')

  <section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>My Properties</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">My Properties</li>
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

          <!-- 🔷 Invoice Page Header -->
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h4 class="fw-bold m-0">Invoices</h4>
            <button class="btn btn-primary btn-sm mt-2 mt-sm-0">
              <i class="fas fa-download me-1"></i> Download All
            </button>
          </div>

          <!-- 🔹 Invoice Table Card -->
          <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body">
              <h5 class="fw-semibold mb-3">Invoice History</h5>

              <div class="table-responsive" style="overflow-x:auto; white-space:nowrap;">
                <table class="table table-bordered table-striped align-middle text-center mb-0" style="min-width:1100px;">
                  <thead class="table-light text-nowrap">
                    <tr>
                      <th>Date & Time</th>
                      <th>Invoice Number</th>
                      <th>Subscription Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Payment Status</th>
                      <th>Transaction ID</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($invoices as $invoice)
                      <tr>
                        <td>{{ $invoice->created_at->format('d M Y, h:i A') }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->subscription->package->name ?? 'N/A' }}</td>
                        <td>₹{{ number_format($invoice->total_amount ?? $invoice->amount, 2) }}</td>
                        <td>₹{{ number_format($invoice->amount, 2) }}</td>
                        <td>
                          <span class="badge bg-success text-white">
                            {{ ucfirst($invoice->status ?? $invoice->payment_status) }}
                          </span>
                        </td>
                        <td>{{ $invoice->subscription->transaction_id ?? '—' }}</td>
                        <td>
                          @if($invoice->subscription->is_active)
                            <span class="badge bg-success text-white">Active</span>
                          @else
                            <span class="badge bg-secondary text-white">Expired</span>
                          @endif
                        </td>
                        <td>
                          <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#viewInvoiceModal{{ $invoice->id }}">
                            <i class="fas fa-file-invoice"></i> View
                          </button>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="9" class="text-center text-muted">No invoices found.</td>
                      </tr>
                    @endforelse
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- 🔹 Invoice Modal -->
    <div class="modal fade" id="viewInvoiceModal{{ $invoice->id }}" tabindex="-1"
      aria-labelledby="viewInvoiceModalLabel{{ $invoice->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-primary text-white rounded-top-4">
            <h5 class="modal-title fw-semibold" id="viewInvoiceModalLabel{{ $invoice->id }}">Invoice
              Details</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered mb-0">
              <tbody>
                <tr>
                  <th>Invoice Number</th>
                  <td>{{ $invoice->invoice_number }}</td>
                </tr>
                <tr>
                  <th>Date & Time</th>
                  <td>{{ $invoice->created_at->format('d M Y, h:i A') }}</td>
                </tr>
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
                  <td><span class="badge bg-success">Paid</span></td>
                </tr>
                <tr>
                  <th>Transaction ID</th>
                  <td>{{ $invoice->subscription->transaction_id ?? '—' }}</td>
                </tr>
                <tr>
                  <th>Current Status</th>
                  <td>
                    @if($invoice->subscription->is_active)
                      <span class="badge bg-success">Active</span>
                    @else
                      <span class="badge bg-secondary">Expired</span>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-primary">
              <i class="fas fa-download me-1"></i> Download Invoice
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>

@endsection