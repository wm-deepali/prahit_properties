@extends('layouts.front.app')

@section('title')
    <title>My Wishlist</title>
@endsection

<style>
    .wishlist-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background: #f9fbff;
    }

    .wishlist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .wishlist-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .wishlist-info {
        padding: 1rem 1.25rem;
    }

    .wishlist-info h5 {
        font-size: 1.1rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .wishlist-info h5 a {
        text-decoration: none;
        color: #007bff;
    }

    .wishlist-info h5 a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .wishlist-info p {
        margin: 0 0 5px;
        font-size: 14px;
        color: #333;
    }

    .property-actions {
        margin-top: 10px;
    }

    .property-actions .btn {
        margin-right: 8px;
        border-radius: 6px;
    }

    .property-actions .btn:last-child {
        margin-right: 0;
    }
</style>

@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Wishlist</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
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
                    <div class="main-area-dash">
                        <h3 class="head-tit mb-4">Saved Properties</h3>

                        <div class="row g-3">
                            @forelse($wishlist as $item)
                                @php
                                    $company = $item->business;
                                  @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card wishlist-card">
                                        <img src="{{ isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80' }}"
                                            alt="{{ $company->business_name }}">
                                        <div class="wishlist-info">
                                            <h5><a
                                                    href="{{ route('business.details', ['id' => $company->id, 'slug' => $company->slug]) }}">{{ $company->business_name }}</a>
                                            </h5>
                                            <p><strong>Location:</strong> {{ $company->city ?? 'N/A' }},
                                                {{ $company->state ?? 'N/A' }}</p>
                                            <p><strong>Category:</strong> {{ $company->Category->category_name ?? '-' }}</p>
                                            <div class="property-actions">
                                                <a href="{{ route('business.details', ['id' => $company->id, 'slug' => $company->slug]) }}"
                                                    class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-outline-danger remove-wishlist"
                                                    data-business-id="{{ $company->id }}">
                                                    <i class="fas fa-trash"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center mb-0">
                                        You haven't added any properties to your wishlist yet.
                                    </div>
                                </div>
                            @endforelse
                        </div> <!-- row end -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).on('click', '.remove-wishlist', function () {
            const businessId = $(this).data('business-id');
            if (confirm('Are you sure you want to remove this property from your wishlist?')) {
                $.ajax({
                    url: "{{ route('business.wishlist.toggle') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        business_listing_id: businessId
                    },
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        });
    </script>
@endsection