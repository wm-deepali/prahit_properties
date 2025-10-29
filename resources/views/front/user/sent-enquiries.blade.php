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

                    @if($enquiries->count())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Interested In</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Sent On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $enquiry)
                                    <tr>
                                        <td>
                                            {{ $enquiry->Property->title ?? 'N/A' }}<br>
                                            {{ $enquiry->Property->getCity->name ?? '' }}<br>
                                            {{ $enquiry->Property->Category->category_name ?? '' }}
                                        </td>
                                        @php
                                            $interestedTypes = [
                                                1 => 'Site Visit',
                                                2 => 'Immediate Purchase',
                                                3 => 'Home Loan'
                                            ];
                                        @endphp

                                        <td>
                                            <span
                                                class="badge bg-info">{{ $interestedTypes[$enquiry->interested_in] ?? 'N/A' }}</span>
                                        </td>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->mobile_number }}</td>
                                        <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
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