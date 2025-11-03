@extends('layouts.front.app')

@section('title')
    <title>My Sent Enquiries</title>
@endsection

@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Properties</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sent Enquiries</li>
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

                    <!-- Top Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <h6 class="card-title">Current Month</h6>
                                    <p class="card-text display-5 m-0">{{ $currentMonthCount }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm text-center h-100" style="background-color: #fce4ec;">
                                <div class="card-body">
                                    <h6 class="card-title">Last Month</h6>
                                    <p class="card-text display-5 m-0">{{ $lastMonthCount }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm text-center h-100" style="background-color: #e0f7fa;">
                                <div class="card-body">
                                    <h6 class="card-title">Total</h6>
                                    <p class="card-text display-5 m-0">{{ $totalCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($inquiries->count())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Customer Detail</th>
                                    <th>Business ID</th>
                                    <th>Business Detail</th>
                                    <th>Interested In</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiries as $enquiry)
                                    <tr>
                                        <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            {{ $enquiry->name }}<br>
                                            {{ $enquiry->email }}<br>
                                            {{ $enquiry->mobile_number }}
                                        </td>
                                        <td>{{ $enquiry->business->id ?? 'N/A' }}</td>
                                        <td>
                                            {{ $enquiry->business->business_name ?? 'N/A' }}<br>
                                            {{ $enquiry->business->city ?? '' }}<br>
                                        </td>
                                        <td>
                                            {{ $enquiry->message}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1 view-inquiry-btn" data-bs-toggle="modal"
                                                data-bs-target="#viewInquiryModal" data-enquiry='@json($enquiry)'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <p>No enquiries found.</p>
                    @endif

                </div>
            </div>
    </section>
@endsection