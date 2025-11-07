@extends('layouts.front.app')

@section('title')
    <title>My Sent Reviews</title>
@endsection

@section('content')
<section class="breadcrumb-section">
    <div class="container">
        <h3>My Sent Reviews</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Sent Reviews</li>
            </ol>
        </nav>
    </div>
</section>

<section class="owner-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">@include('front.user.sidebar')</div>

            <div class="col-sm-9">
                <h5 class="mb-3">Agent Reviews You’ve Sent</h5>
                @if($agentReviews->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Agent</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agentReviews as $review)
                                <tr>
                                    <td>{{ $review->profileSection->user->firstname ?? 'N/A' }}</td>
                                    <td>{{ $review->rating ?? '-' }}</td>
                                    <td>{{ $review->comment ?? '-' }}</td>
                                    <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No agent reviews sent yet.</p>
                @endif

                <h5 class="mt-5 mb-3">Business Listing Reviews You’ve Sent</h5>
                @if($businessReviews->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Business</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($businessReviews as $review)
                                <tr>
                                    <td>{{ $review->businessListing->business_name ?? 'N/A' }}</td>
                                    <td>{{ $review->rating ?? '-' }}</td>
                                    <td>{{ $review->comment ?? '-' }}</td>
                                    <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No business reviews sent yet.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
