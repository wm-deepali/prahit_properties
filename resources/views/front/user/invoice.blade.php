@extends('layouts.front.app')

@section('title')
  <title>Invoice Details</title>
@endsection

<style>
  .invoice-card {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
  }

  .invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    border-bottom: 2px solid #eaeaea;
    padding-bottom: 20px;
    margin-bottom: 20px;
  }

  .invoice-header .company-details,
  .invoice-header .user-details {
    width: 48%;
  }

  .invoice-header h4 {
    margin-bottom: 10px;
    font-weight: 600;
  }

  .invoice-header p {
    margin: 0;
    font-size: 14px;
    color: #444;
  }

  .invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
  }

  .invoice-table th,
  .invoice-table td {
    border: 1px solid #ddd;
    padding: 10px 12px;
    font-size: 14px;
    text-align: left;
  }

  .invoice-table th {
    background: #f4f6fb;
    font-weight: 600;
  }

  .total-section {
    text-align: right;
    margin-top: 10px;
    font-size: 16px;
    font-weight: 600;
  }

  .btn-download {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s ease;
  }

  .btn-download:hover {
    background-color: #0056b3;
    color: #fff;
  }
</style>

@section('content')

  <section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>Invoice Details</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Invoice Details</li>
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
          <div class="invoice-card">

            <!-- Header Section -->
            <div class="invoice-header">
              <div class="company-details">
                <h4>🏢 Tirkey Estates Pvt. Ltd.</h4>
                <p>Plot No. 23, Tech Park Road</p>
                <p>Bangalore - 560103</p>
                <p>Email: support@tirkey.com</p>
                <p>Phone: +91-9876543210</p>
              </div>

              <div class="user-details">
                <h4>👤 Customer Details</h4>
                <p><strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Mobile:</strong> {{ $user->mobile_number }}</p>
                <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
              </div>
            </div>

            <!-- Invoice Details Table -->
            <div class="table-responsive">
              <table class="invoice-table">
                <thead>
                  <tr>
                    <th>Package</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $subscription->package->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</td>
                    <td>{{ $subscription->payment->transaction_id ?? 'N/A' }}</td>
                    <td>₹{{ number_format($subscription->amount, 2) }}</td>
                    <td>
                      @php
                        $status = $subscription->payment_status ?? $subscription->payment->status ?? 'pending';
                      @endphp
                      <span
                        class="badge bg-{{ $status == 'success' ? 'success' : ($status == 'pending' ? 'warning' : 'danger') }} text-light">
                        {{ ucfirst($status) }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Total -->
            <div class="total-section">
              Total Amount Paid: ₹{{ number_format($subscription->amount, 2) }}
            </div>

            <!-- Download Button -->
            <div class="text-end mt-4">
              <a href="{{ route('invoice.download', $subscription->invoice->id) }}" class="btn-download">
                <i class="fas fa-file-pdf"></i> Download PDF
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection