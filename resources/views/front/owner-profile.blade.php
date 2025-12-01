@extends('layouts.front.app')

@section('title')
    <title>Profile</title>
@endsection

@section('content')
    <style>
        .profile-section1 {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .profile-header {
            position: relative;
            background: linear-gradient(135deg, #e8f1f9 0%, #e5feff 100%);
            background-size: cover;
            background-position: center;
            height: 350px;
            display: flex;
            align-items: center;
            color: #333;
            margin-bottom: 40px;
        }

        .profile-avatar {
            width: 230px;
            height: 280px;
            border-radius: 5px;
            border: 6px solid rgba(255, 255, 255, 0.8);
            margin-right: 30px;
            object-fit: cover;
            float: inline-end;
        }

        .profil-data {
            color: #444;
        }

        .profile-name-info h2 {
            font-size: 2.5rem;
            margin: 0;
            font-family: 'Arial', sans-serif;
            font-weight: 700;
            color: #333;
        }

        .profile-name-info p {
            margin: 0;
            font-size: 1.1rem;
            color: #555;
        }

        .profile-name-info p strong {
            color: #444;
        }

        .hori-line {
            width: 70%;
            height: auto;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .hori-line p {
            margin: 0;
            padding: 10px;
            font-size: 1rem;
            color: #555;
        }

        .hori-line p strong {
            color: #333;
            font-size: 1.2rem;
        }

        .line {
            width: 1px;
            height: 50px;
            background: #ccc;
        }

        .stats-card {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            color: #585858;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: bold;
            font-family: 'Verdana', sans-serif;
        }

        .stat-label {
            color: #585858;
            font-size: 1rem;
            font-family: 'Arial', sans-serif;
            opacity: 0.9;
        }

        .card1 {
            background: linear-gradient(135deg, #fbf4f5 0%, #fff5f2 100%);
        }

        .card2 {
            background: linear-gradient(135deg, #e6efff 0%, #edf4f7 100%);
        }

        .card3 {
            background: linear-gradient(135deg, #e4f1e4 0%, #d7e9d7 100%);
        }

        .card4 {
            background: linear-gradient(135deg, #fffafa 0%, #f7e4bc 100%);
        }

        .services-section,
        .properties-section,
        .contact-section {
            padding: 50px 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .service-item,
        .property-card {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .service-item:hover,
        .property-card:hover {
            transform: translateY(-5px);
        }

        .introduction {
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            line-height: 1.8;
            font-family: 'Georgia', serif;
            color: #333;
        }

        .property-card {
            border: none;
            overflow: hidden;
        }

        .property-img {
            height: 250px;
            object-fit: cover;
            position: relative;
        }

        .property-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .property-card:hover .property-overlay {
            opacity: 1;
        }

        .property-favorite {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
        }

        .property-details {
            padding: 15px;
        }

        .property-details h5 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            font-family: 'Arial', sans-serif;
        }

        .property-details p {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 10px;
        }

        .property-meta {
            font-size: 0.9rem;
            color: #888;
        }

        .contact-card,
        .feedback-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .timing-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            font-size: 1rem;
        }

        .related-agents {
            position: sticky;
            top: 20px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .agent-card {
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .agent-card:hover {
            transform: translateY(-5px);
        }

        .newdesign-image-agent {
            position: relative;
        }

        .newdesign-image-agent img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .newdesign-verified-seal {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .newdesign-info-agent {
            padding: 15px;
        }

        .newdesign-info-agent .newdesign-proj-name {
            font-size: 1.3rem;
            margin-bottom: 5px;
            font-family: 'Arial', sans-serif;
        }

        .newdesign-info-agent .newdesign-apart-name {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 10px;
        }

        .newdesign-info-agent hr {
            margin: 10px 0;
            border: 0;
            border-top: 1px solid #eee;
        }

        .newdesign-info-agent .newdesign-apart-adress {
            font-size: 0.9rem;
            color: #888;
            display: block;
            margin-bottom: 10px;
        }

        .newdesign-info-agent .newdesign-proj-owner {
            font-size: 0.9rem;
            color: #666;
        }

        .newdesign-info-agent .view-profile-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .newdesign-info-agent .view-profile-btn:hover {
            background: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-header {
                height: 250px;
            }

            .profile-avatar {
                width: 150px;
                height: 180px;
                margin-right: 15px;
            }

            .profile-name-info h2 {
                font-size: 2rem;
            }

            .profile-name-info p {
                font-size: 0.9rem;
            }

            .hori-line {
                width: 100%;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hori-line p {
                text-align: center;
                margin: 5px 0;
            }

            .line {
                display: none;
            }

            .col-md-3,
            .col-md-6,
            .col-md-8,
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .stats-card {
                margin-bottom: 15px;
            }

            .services-section,
            .properties-section,
            .contact-section {
                padding: 30px 0;
            }

            .service-item,
            .property-card {
                margin-bottom: 15px;
            }

            .introduction {
                padding: 20px;
            }

            .contact-card,
            .feedback-form {
                padding: 20px;
            }

            .related-agents {
                position: relative;
                top: 0;
                margin-top: 20px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .profile-header {
                height: 300px;
            }

            .profile-avatar {
                width: 180px;
                height: 220px;
            }

            .profile-name-info h2 {
                font-size: 2.2rem;
            }

            .hori-line {
                width: 80%;
            }

            .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-8,
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .related-agents {
                position: relative;
                top: 0;
                margin-top: 20px;
            }
        }

        .info-btn {
            flex: 1;
            min-width: 200px;
            background: #f3f7ff;
            border: 1px solid #d9e4ff;
            border-radius: 10px;
            padding: 12px 15px;
            text-align: center;
            font-size: 15px;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .info-btn:hover {
            background: #e7f0ff;
            transform: translateY(-2px);
        }

        @media(max-width: 768px) {
            .info-btn {
                flex: 100%;
            }
        }
    </style>

    <section class="profile-section1" style="100%">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header mb-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            @php
                                $logoUrl = isset($user->avatar)
                                    ? asset('storage/' . $user->avatar)
                                    : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80';
                            @endphp

                            <img src="{{ $logoUrl }}" alt="Profile" class="profile-avatar">
                        </div>
                        <div class="col-md-9">
                            <div class="profil-data">
                                <div class="profile-name-info">
                                    <h2 class="m-0">{{ $user->firstname ?? '' }} {{ $user->lastname ?? '' }}
                                        @if($user->premium_seller == 'Yes')
                                            <span class="badge bg-success text-light" style="font-size: 14px;">
                                                Premium
                                            </span>
                                        @endif
                                    </h2>
                                </div>
                                <div class="rera-section my-4">
                                    <button class="info-btn">
                                        <strong>Membership:</strong>
                                        {{ $user->activePropertySubscription->package->name ?? 'Free' }}
                                    </button>

                                </div>
                                <div class="hori-line">
                                    <p><strong>{{ $sellCount }}</strong><br>Properties For Sale</p>
                                    <div class="line"></div>
                                    <p><strong>{{ $rentCount }}</strong><br>Properties For Rent</p>
                                    <div class="line"></div>
                                    <p><strong>{{ $pgHostelCount }}</strong><br>Properties For PG/Hostel</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="stats-card card1">
                        <div class="stat-number">{{ $totalProperties }}</div>
                        <div class="stat-label">Total Properties</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="stats-card card2">
                        <div class="stat-number">{{ $sellCount }}</div>
                        <div class="stat-label">For Sale</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="stats-card card3">
                        <div class="stat-number">{{ $rentCount }}</div>
                        <div class="stat-label">For Rent</div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Main Content -->
                <div class="col-md-8" style="padding-left:0px;">

                    <div class="properties-section p-3">
                        <h3 class="mb-4">Featured Properties</h3>
                        <div class="row">
                            @foreach($properties as $key => $value)
                                <!-- Property Card 1 -->
                                <div class="col-lg-6 mb-3">
                                    <div class="newdesign-project-main">
                                        <div class="newdesign-image-proj">
                                            <img src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;'}}"
                                                class="img-fluid" alt="Property 1">
                                            @if($value->verified_tag === 'Yes')
                                                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i>
                                                    Verified</span>
                                            @endif
                                        </div>
                                        <div class="newdesign-info-proj">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="newdesign-proj-name"> <a href="{{ route('property_detail', ['id' => $value->id, 'slug' => $value->slug]) }}
                                        ">{{$value->title}}</a>
                                                </h4>
                                                <span class="newdesign-proj-category">Villa</span>
                                            </div>
                                            <span class="newdesign-apart-name">
                                                {{ \Illuminate\Support\Str::limit($value->description, 100) }}</span>
                                            <hr>
                                            <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i>
                                                {{ $value->getCity->name }},
                                                {{ $value->getState->name }}</span>
                                            <div class="newdesign-proj-price">
                                                <span><i
                                                        class="fas fa-rupee-sign"></i>{{\App\Helpers\Helper::formatIndianPrice($value->price)}}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="newdesign-proj-owner"><strong>Builder:</strong><br> <a
                                                        href="{{ route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')]) }}">
                                                        {{ $value->getUser->firstname ?? '' }}
                                                    </a></span>
                                                <span class="newdesign-proj-owner"><strong>Posted:</strong><br>
                                                    {{ optional($value->created_at)->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>

                <!-- Related Agents/Builders Sidebar -->
                <div class="col-md-4" style="padding-right:0px;">
                    <div class="related-agents">
                        <h4 class="mb-4">Other Experts</h4>

                        @forelse($otherUsers as $other)
                            @php
                                $section = $other->profileSection;
                                $logo = isset($section->logo)
                                    ? asset('storage/' . $section->logo)
                                    : 'https://via.placeholder.com/300x200?text=No+Image';
                            @endphp

                            <div class="agent-card mb-3 border">
                                <div class="newdesign-image-agent">
                                    <img src="{{ $logo }}" alt="Agent" class="agent-avatar">
                                    <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i>
                                        @if($other->premium_seller === 'Yes')
                                            Premium
                                        @else
                                            Verified
                                        @endif
                                    </span>
                                </div>
                                <div class="newdesign-info-agent">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="newdesign-proj-name">
                                            {{ $other->firstname }} {{ $other->lastname }}
                                        </h4>
                                        <span class="newdesign-proj-category">
                                            {{ $other->role ?? 'Agent' }}
                                        </span>
                                    </div>
                                    <span class="newdesign-apart-name">
                                        {!! Str::limit(preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode($section->description ?? 'No description available')))), 100) !!}
                                    </span>
                                    <hr>
                                    <span class="newdesign-apart-adress">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $user->getCity->name ?? 'N/A' }},
                                        {{ $user->getState->name ?? '' }}
                                    </span>
                                    <div class="d-flex justify-content-between">
                                        <span
                                            class="newdesign-proj-owner"><strong>Company:</strong><br>{{ $section->business_name ?? 'N/A' }}</span>
                                        <span
                                            class="newdesign-proj-owner"><strong>Experience:</strong><br>{{ $section->years_experience ?? 0 }}
                                            yrs</span>
                                    </div>
                                    <a href="{{ route('profile.page', ['slug' => Str::slug($other->firstname)]) }}"
                                        class="view-profile-btn">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No other experts available right now.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection