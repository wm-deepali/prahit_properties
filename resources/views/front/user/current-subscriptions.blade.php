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

  <!-- 🔷 Current Subscription Card -->
  <div class="card shadow-lg mb-4 border-0 rounded-4 overflow-hidden">
    <div class="row g-0 align-items-center">

      <!-- Left Side: Subscription Card Design -->
      <div class="col-md-5 m-3">
        <div class="p-4 text-white h-100 d-flex flex-column justify-content-center"
             style="background: linear-gradient(135deg, #4facfe, #00f2fe); border-radius: .5rem; width: 92%;">
          
          <h5 class="fw-bold mb-3">Subscription Details</h5>
          <div class="mb-3">
            <p class="mb-1"><strong>Customer Name:</strong> John Doe</p>
            <p class="mb-1"><strong>Mobile Number:</strong> +91-9876543210</p>
            <p class="mb-1"><strong>Email ID:</strong> johndoe@gmail.com</p>
          </div>
          <!--<hr class="border-light opacity-50">-->
          <div>
            <p class="mb-1"><strong>Subscription Name:</strong> Premium Plus Plan</p>
            <p class="mb-1"><strong>Validity:</strong> 6 Months (Till 25 Apr 2026)</p>
            <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
          </div>
        </div>
      </div>

      <!-- Right Side: Listing Stats -->
      <div class="col-md-6">
        <div class="card-body p-4">
          <h6 class="fw-bold text-uppercase mb-3">Account Summary</h6>
          
          <div class="row text-center mb-3">
            <div class="col-4">
              <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                <h5 class="fw-bold text-primary mb-0">120</h5>
                <small>Total Listing</small>
              </div>
            </div>
            <div class="col-4">
              <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                <h5 class="fw-bold text-success mb-0">95</h5>
                <small>Property Posted</small>
              </div>
            </div>
            <div class="col-4">
              <div class="p-1 pt-3 pb-3 bg-light rounded shadow-sm">
                <h5 class="fw-bold text-danger mb-0">25</h5>
                <small>Remaining</small>
              </div>
            </div>
          </div>

          <div class="d-flex  gap-2 mt-3" style="gap:20px;">
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

  <!-- 📜 Previous History Table -->
  <h5 class="fw-bold mb-3">Previous History</h5>
  
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th style="white-space:nowrap;">Date & Time</th>
          <th style="white-space:nowrap;">Subscription Name</th>
          <th>Validity</th>
          <th style="white-space:nowrap;">Paid Amount</th>
          <th style="white-space:nowrap;">Invoice Number</th>
          <th style="white-space:nowrap;">Payment Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>25 Sep 2025, 06:45 PM</td>
          <td>Standard Plan</td>
          <td>1 Month</td>
          <td>₹499</td>
          <td>INV-5896</td>
          <td><span class="badge bg-success">Paid</span></td>
          <td>
            <button class="btn btn-sm btn-outline-primary">
              <i class="fas fa-file-invoice"></i> View Invoice
            </button>
          </td>
        </tr>
        <tr>
          <td>25 Aug 2025, 02:15 PM</td>
          <td>Basic Plan</td>
          <td>1 Month</td>
          <td>₹299</td>
          <td>INV-5789</td>
          <td><span class="badge bg-success">Paid</span></td>
          <td>
            <button class="btn btn-sm btn-outline-primary">
              <i class="fas fa-file-invoice"></i> View Invoice
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>




    </div>
  </div>
</section>

@endsection