@extends('layouts.front.app')

@section('title')
    <title>My Business Listing Reviews</title>
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>My Reviews</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Business Listing Reviews</li>
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
                @if($reviews->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Business</th>
                                <th>Reviewer Name</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        {{ $review->businessListing->business_name ?? 'N/A' }}<br>
                                        <small>{{ $review->businessListing->city ?? '' }}</small>
                                    </td>
                                    <td>{{ $review->name }}</td>
                                   
                                    <td>
                                        ⭐ {{ $review->rating }}/5
                                    </td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <p>No reviews found.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
