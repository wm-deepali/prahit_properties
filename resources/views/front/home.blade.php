@extends('layouts.front.app')

@section('title')
  <title>Welcome</title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
  .newupdateContainer {
    text-align: center;
    padding: 20px;
    /*max-width: 900px;*/
    width: 100%;
    height: 550px;
    margin: auto;
    background: linear-gradient(135deg,
        /* Angle of the gradient */
        #ffda9e,
        /* Soft Pastel Orange (e.g., Apricot) */
        #a6e3e0,
        /* Soft Pastel Blue/Cyan (e.g., Pale Aqua) */
        #b2f7b2
        /* Soft Pastel Green (e.g., Mint Green) */
      );
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .banner-top-content h1 {
    font-size: 46px;
    font-weight: 700;
  }


  .newupdateSearchContainer {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #333;
    width: 60%;

  }

  .newupdateTabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  .newupdateTab {
    background: none;
    border: none;
    color: #2d2d5c;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s;
  }

  .newupdateTab.active {
    border-bottom: 2px solid #00cc88;
  }

  .newupdateTab:hover {
    border-bottom: 2px solid #3d3d7c;
  }

  .newupdateSearchBar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    background: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
  }

  .newupdateDropdown {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 150px;
    appearance: none;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%23666" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
    background-size: 12px;
  }

  .newupdateSearchInput {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
  }

  .newupdateSearchIcon,
  .newupdateMicIcon {
    background: #00cc8817;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #00cc88;
    padding: 5px;
    border-radius: 50%;
    padding: 10px;
  }

  .newupdateFilters {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .newupdateSearchBtn {
    background-color: #00cc88;
    border: none;
    color: #fff;
    padding: 10px 60px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
  }

  .newupdateSearchBtn:hover {
    background-color: #00aa70;
  }

  .newupdateSecondarySearch {
    text-align: center;
  }

  .newupdateSecondaryBtn {
    background-color: #2d2d5c;
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
  }

  .newupdateSecondaryBtn:hover {
    background-color: #3d3d7c;
  }
</style>
<style>
  .property-tab {
    border: 1px solid #e38e32;
    background: #fff;
    color: #e38e32;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .property-tab:hover {
    background: #e38e32;
    color: #fff;
    transform: translateY(-1px);
  }

  .property-tab.active {
    background: #e38e32;
    color: #fff;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
  }

  /*.newdesign-verified-seal {*/
  /*  position: absolute;*/
  /*  top: 10px;*/
  /*  left: 10px;*/
  /*  background: #198754;*/
  /*  color: #fff;*/
  /*  padding: 4px 8px;*/
  /*  font-size: 13px;*/
  /*  border-radius: 20px;*/
  /*}*/
  .property-card {
    transition: all 0.3s ease;
  }

  .property-card.hide {
    display: none !important;
  }

  .newdesign-project-main {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.3s ease;
  }

  .newdesign-project-main:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }
</style>

@section('content')
  @php
    // Get all front contents keyed by slug
    $allContents = App\Models\FrontContent::all()->keyBy('slug');

    // List of all required slugs
    $slugs = [
      'Banner',
      'Hand-Picked',
      'Trending-Projects',
      'Latest-Properties',
      'Featured-Property',
      'Exclusive-Launch',
      'Commercial-Property-for-Sale',
      'Commercial-Property-for-Rent',
      'Residential-Property-for-Sale',
      'Residential-Property-for-Rent',
      'Web-Directory',
      'Property-by-Business-Type',
      'Reels',
      'Testimonials'
    ];

    // Dynamic variable assignment by converting slug to snake_case variable name
    foreach ($slugs as $slug) {
      // Convert slug to snake_case (e.g., 'Exclusive-Launch' → 'exclusive_launch')
      $varName = strtolower(str_replace('-', '_', $slug));
      // Assign variable dynamically with null fallback if not found
      ${$varName} = $allContents->get($slug) ?? null;
    }
  @endphp
  {{--
  <section class="property-search-filter">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-8">
          <div class="search-head">
            <h3>{{ $banner ? $banner->heading : '' }}</h3>
            <h5>{{ $banner ? $banner->title : '' }}</h5>
          </div>
          <div class="search-filters">
            @php
            use Illuminate\Support\Facades\Crypt;

            $activeCategory = null;
            if (request()->has('category')) {
            try {
            $activeCategory = Crypt::decrypt(request()->query('category'));
            } catch (\Exception $e) {
            $activeCategory = null; // invalid value
            }
            }
            @endphp

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{ $activeCategory == 22 ? 'active' : '' }}"
                  href="{{ url('/') }}/{{ Cache::get('location-name') ?? '' }}?category={{ encrypt(22) }}">
                  Buy
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $activeCategory == 21 ? 'active' : '' }}"
                  href="{{ url('/') }}/{{ Cache::get('location-name') ?? '' }}?category={{ encrypt(21) }}">
                  Rent
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $activeCategory == 20 ? 'active' : '' }}"
                  href="{{ url('/') }}/{{ Cache::get('location-name') ?? '' }}?category={{ encrypt(20) }}">
                  PG / Hostel
                </a>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                <div class="search-content-fil">
                  <form id="search_property" action="{{url('/')}}/search/" name="search_property">
                    <div class="row no-gutters">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input type="text" class="text-control" placeholder="Enter Location, Landmark" name="property"
                            required />
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <select class="text-control" name="type">
                            <option value="">Property Type</option>
                            @if(isset($property_types))
                            @foreach($property_types as $p => $t)
                            <option value="{{$t->id}}"> {{$t->type}} </option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group row no-gutters">
                          <div class="col-sm-6 col-xs-6">
                            <select name="min_price" class="text-control" name="min_price" required>
                              <option data-min="0" value="0">Min</option>
                              <option data-min="0" value="0">0</option>
                              <option data-min="10000" value="10000">10 K </option>
                              <option data-min="20000" value="20000">20 K </option>
                              <option data-min="30000" value="30000">30 K </option>
                              <option data-min="40000" value="40000">40 K </option>
                              <option data-min="50000" value="50000">50 K</option>
                              <option data-min="100000" value="100000">1 Lakhs</option>
                              <option data-min="200000" value="200000">2 Lakhs</option>
                              <option data-min="300000" value="300000">3 Lakhs</option>
                              <option data-min="500000" value="500000">5 Lakhs</option>
                              <option data-min="1000000" value="1000000">10 Lakhs</option>
                              <option data-min="1500000" value="1500000">15 Lakhs</option>
                              <option data-min="2000000" value="2000000">20 Lakhs</option>
                              <option data-min="2500000" value="2500000">25 Lakhs</option>
                              <option data-min="5000000" value="5000000">50 Lakhs</option>
                              <option data-min="10000000" value="10000000">1 Crore</option>
                              <option data-min="20000000" value="20000000">2 Crore</option>
                              <option data-min="30000000" value="30000000">3 Crore</option>
                              <option data-min="50000000" value="50000000">5 Crore</option>
                              <option data-min="100000000" value="100000000">10 Crore</option>
                              <option data-min="500000000" value="500000000">50 Crore</option>
                              <option data-min="1000000000" value="1000000000">50+ Crore</option>
                            </select>
                          </div>
                          <div class="col-sm-6 col-xs-6">
                            <select name="max_price" class="text-control" name="max_price" required>
                              <option data-min="0" value="0">Max</option>
                              <option data-min="10000" value="10000">10 K </option>
                              <option data-min="20000" value="20000">20 K </option>
                              <option data-min="30000" value="30000">30 K </option>
                              <option data-min="40000" value="40000">40 K </option>
                              <option data-min="50000" value="50000">50 K</option>
                              <option data-max="100000" value="100000">1 Lakhs</option>
                              <option data-min="200000" value="200000">2 Lakhs</option>
                              <option data-min="300000" value="300000">3 Lakhs</option>
                              <option data-max="500000" value="500000">5 Lakhs</option>
                              <option data-max="1000000" value="1000000">10 Lakhs</option>
                              <option data-max="1500000" value="1500000">15 Lakhs</option>
                              <option data-max="2000000" value="2000000">20 Lakhs</option>
                              <option data-max="2500000" value="2500000">25 Lakhs</option>
                              <option data-max="5000000" value="5000000">50 Lakhs</option>
                              <option data-max="10000000" value="10000000">1 Crore</option>
                              <option data-min="20000000" value="20000000">2 Crore</option>
                              <option data-min="30000000" value="30000000">3 Crore</option>
                              <option data-max="50000000" value="50000000">5 Crore</option>
                              <option data-max="100000000" value="100000000">10 Crore</option>
                              <option data-max="500000000" value="500000000">50 Crore</option>
                              <option data-min="1000000000" value="1000000000">50+ Crore</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <button class="btn btn-search" type="submit">Search</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="men-prop"> <img src="{{ asset('storage') }}/{{ $banner ? $banner->image : '' }}" class="img-fluid"> </div>
  </section>
  --}}
  @php
    $popular_cities_content = App\PopularCity::where('slug', 'heading')->first();
    $popular_cities = App\PopularCity::where('slug', 'city')->get();
  @endphp

  <div class="newupdateContainer">
    <div class="banner-top-content">
      <h1>{{ $banner ? $banner->heading : 'Gateway to Verified Properties Across India'}}</h1>
      <p>
        {{ $banner ? $banner->title : 'Discover thousands of verified properties, exclusive builder projects, and trusted service providers all in one
                                                                                    place. Connect, explore, and make informed decisions with Bhawan Bhoomi – your reliable real estate partner.' }}
      </p>
    </div>
    <div class="newupdateSearchContainer">
      <div class="newupdateTabs">
        <button class="newupdateTab active" data-type="buy">Buy</button>
        <button class="newupdateTab" data-type="rental">Rental</button>
        <button class="newupdateTab" data-type="projects">Projects</button>
        <button class="newupdateTab" data-type="pg-hostels">PG / Hostels</button>
        <button class="newupdateTab" data-type="plot-land">Plot & Land</button>
        <button class="newupdateTab" data-type="commercial">Commercial</button>
        <button class="newupdateTab" data-type="agents">Agents</button>
      </div>
      <div class="newupdateSearchBar" data-type="buy">
        <select class="newupdateDropdown">
          <option value="Chennai">Chennai</option>
          <option value="Mumbai">Mumbai</option>
          <option value="Delhi">Delhi</option>
        </select>
        <input type="text" placeholder="Search by Project, Locality, or Builder" class="newupdateSearchInput">
        <button class="newupdateSearchIcon"><i class="fa-solid fa-location-crosshairs"></i></button>
        <!--<button class="newupdateMicIcon">ðŸŽ¤</button>-->
      </div>
      <div class="newupdateFilters">
        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown">
            <option value="Budget">Budget</option>
            <option value="0-10L">0-10L</option>
            <option value="10-20L">10-20L</option>
          </select>
          <select class="newupdateDropdown">
            <option value="Property Type">Property Type</option>
            <option value="Apartment">Apartment</option>
            <option value="House">House</option>
          </select>
          <select class="newupdateDropdown">
            <option value="Furnishing Status">Furnishing Status</option>
            <option value="Furnished">Furnished</option>
            <option value="Unfurnished">Unfurnished</option>
          </select>
        </div>
        <button class="newupdateSearchBtn">Search</button>
      </div>

    </div>
  </div>

  <section class="property-popular-cities">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>{{ $popular_cities_content->heading }}</h4>
          </div>
        </div>
      </div>
      <div class="row">
        @if(count($popular_cities) > 0)
          @foreach($popular_cities as $popular_city)
            <div class="col-sm-6 col-lg-4 col-xl">
              <div class="city-main text-center">
                @php
                  $get_city = App\City::find($popular_city->city_id);
                @endphp
                <a href="{{ url('/') }}/{{ $get_city->name }}">
                  <div class="thumb"> <img class="img-fluid" src="{{ asset('storage') }}/{{ $popular_city->image }}"
                      alt="pc1.png"> </div>
                  <div class="details">
                    <h4>{{ $popular_city->getCity ? $popular_city->getCity->name : '' }}</h4>
                    <p>{{ $popular_city->getPropertyCount($popular_city->city_id) }} Properties</p>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <h5>No Any Popular Cities Found.</h5>
        @endif
      </div>
    </div>
  </section>

  <!-- hand picked projects section -->
  <section class="property-home-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>{{ $hand_picked ? $hand_picked->heading : '' }}</h4>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @if(isset($listings))
                @foreach($listings as $key => $value)
                  @if(in_array($value->id, explode(',', $hand_picked->ids)))
                    <div class="swiper-slide">
                      <div class=" property-card" data-type="office">
                        <div class="newdesign-project-main shadow-sm">
                          <div class="newdesign-image-proj position-relative">
                            <a href="{{route('property_detail', ['title' => $value->slug])}}">
                              <img
                                src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                                alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                            </a>
                            <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                          </div>
                          <div class="newdesign-info-proj p-3">
                            <div class="d-flex justify-content-between align-items-start">
                              <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                                  href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                              </h5>

                            </div>
                            <hr class="" style="margin-bottom:10px; margin-top:10px;">
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                                style=" height:30px;">Office Space</p>
                              <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                              <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                            </div>

                            <div class="horizontal-line mt-2"></div>
                            <div class="d-flex justify-content-between align-items-center">

                              <p class="small text-secondary mb-2 mt-2">
                                <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                                {{ $value->getState->name }}
                              </p>
                              <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                            </div>

                            <div class="horizontal-line"></div>
                            <p class="small text-muted mb-2 mt-2">
                              {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                            </p>

                            <div class="d-flex justify-content-between">
                              <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                              <p class="m-0 small">
                                <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                              </p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                              <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                                {{number_format($value->price, 2)}}</h6>
                              <button class="btn btn-sm btn-primary">Contact Now</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  @endif
                @endforeach
              @endif
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--static card-->
  <section class="newdesign-property-topprojects">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="newdesign-section-title">
            <h4>{{ $exclusive_launch->heading ?? 'Recently Launched'}}</h4>
            <p>
              {{ $exclusive_launch->title ?? 'Explore our latest properties fresh on the market.Find your dream home today!'}}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Property Card 1 -->
        <div class="col-lg-4 mb-3">
          <div class="newdesign-project-main">
            <!--<a href="#">-->
            <div class="newdesign-image-proj">
              <img
                src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;"
                class="img-fluid" alt="Property 1">
              <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
            </div>
            <div class="newdesign-info-proj">
              <div class="d-flex justify-content-between">
                <h4 class="newdesign-proj-name"> West Center Meridian Courts</h4>
                <span class="newdesign-proj-category">Villa</span>
              </div>
              <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in
                the heart of Kandivali....</span>
              <hr>
              <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra
                West</span>



              <div class="newdesign-proj-price">
                <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                <span class="newdesign-proj-owner"><strong>Posted:</strong><br> 10 Oct 2027.</span>
              </div>
            </div>
            <!--</a>-->
          </div>
        </div>
        <!-- Property Card 2 -->
        <div class="col-lg-4 mb-3">
          <div class="newdesign-project-main">

            <div class="newdesign-image-proj">
              <img
                src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;"
                class="img-fluid" alt="Property 2">
              <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
            </div>
            <div class="newdesign-info-proj">
              <div class="d-flex justify-content-between">
                <h4 class="newdesign-proj-name"> Origin Rock Highland</h4>
                <span class="newdesign-proj-category">Apartment</span>
              </div>
              <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in
                the heart of Kandivali....</span>
              <hr>
              <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra
                West</span>



              <div class="newdesign-proj-price">
                <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                <span class="newdesign-proj-owner"><strong>Publish:</strong><br> 10 Oct 2027.</span>
              </div>
            </div>


          </div>
        </div>
        <!-- Property Card 3 -->
        <div class="col-lg-4 mb-3">
          <div class="newdesign-project-main">

            <div class="newdesign-image-proj">
              <img
                src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;"
                class="img-fluid" alt="Property 3">
              <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
            </div>
            <div class="newdesign-info-proj">
              <div class="d-flex justify-content-between">
                <h4 class="newdesign-proj-name">Greenfield Estate</h4>
                <span class="newdesign-proj-category">Apartment</span>
              </div>
              <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in
                the heart of Kandivali....</span>
              <hr>
              <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra
                West</span>
              <div class="newdesign-proj-price">
                <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                <span class="newdesign-proj-owner"><strong>Publish:</strong><br> 10 Oct 2027.</span>
              </div>
            </div>


          </div>
        </div>

      </div>
    </div>
  </section>

  @php
    use App\Helpers\Helper;
    $propertiesSellCommercial = Helper::getPropertiesByCategoryAndSubcategory('Sell', 'ALL COMMERCIAL');
    $propertiesSellResidential = Helper::getPropertiesByCategoryAndSubcategory('Sell', 'ALL RESIDENTIAL');

    $propertiesRentCommercial = Helper::getPropertiesByCategoryAndSubcategory('Rent', 'ALL COMMERCIAL');
    $propertiesRentResidential = Helper::getPropertiesByCategoryAndSubcategory('Rent', 'ALL RESIDENTIAL');

  @endphp


  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2">{{ $commercial_property_for_sale->heading ?? 'Commercial Properties for Sale'}}</h4>
        <p class="text-muted mb-0">
          {{ $commercial_property_for_sale->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'}}
        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns d-inline-flex flex-wrap justify-content-center gap-2">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <button type="button" class="property-tab" data-filter="office">Office Space</button>
          <button type="button" class="property-tab" data-filter="shops">Shops & Showrooms</button>
          <button type="button" class="property-tab" data-filter="godowns">Godowns & Warehouse</button>
          <button type="button" class="property-tab" data-filter="lands">Lands & Plots</button>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesSellCommercial as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="office">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="{{route('property_detail', ['title' => $value->slug])}}">
                          <img
                            src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                              href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;">Office Space</p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                            {{ $value->getState->name }}
                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{number_format($value->price, 2)}}</h6>
                          <button class="btn btn-sm btn-primary">Contact Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- CSS -->
  <section class="newdesign-directory" style="background:#fff;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="newdesign-section-title">
            <h4>{{ $web_directory->heading ?? 'Directory'}}</h4>
            <p>
              {{ $web_directory->title ?? 'Explore top companies and their services. Connect with the best in the industry!'}}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <div class="swiper-slide">
                <div class="directory-card-main d-flex flex-column">
                  <div class="directory-logo">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"
                      class="img-fluid" alt="Company Logo 1">
                  </div>
                  <div class="verified-seal">
                    <div class="top-veri">
                      <img src="{{ asset('images') }}/verify.png" alt="verified">
                      <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                    </div>


                  </div>
                  <div class="directory-info">
                    <h4 class="directory-company-name">Tech Innovations Inc.</h4>
                    <hr>

                    <div class="cat-btn">
                      <button class="category-name-btn">Category Name</button>
                      <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                      <div class="dir-left">
                        <h5>Member Since</h5>
                        <p>2019</p>
                      </div>
                      <div class="ver-line"></div>
                      <div class="dir-left">
                        <h5>Location</h5>
                        <p>Aliganj, Lucknow</p>
                      </div>
                    </div>

                    <div class="horizontal-line"></div>

                    <p class="directory-description">Leading provider of cutting-edge software solutions and IT services
                      for businesses worldwide.</p>
                    <div class="directory-buttons">
                      <div class="d-flex align-items-center">
                        <p class="m-0" style="font-size:14px;"><strong>Publish:</strong><br>26 Aug 2023</p>
                      </div>
                      <button class="btn btn-sm btn-primary">Contact Now</button>
                      <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                      <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                    </div>
                  </div>
                </div>
              </div>
              <!-- Directory Card 2 -->
              <div class="swiper-slide">
                <div class="directory-card-main d-flex flex-column">
                  <div class="directory-logo">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"
                      class="img-fluid" alt="Company Logo 1">
                  </div>
                  <div class="verified-seal">
                    <div class="top-veri">
                      <img src="{{ asset('images') }}/verify.png" alt="verified">
                      <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                    </div>


                  </div>
                  <div class="directory-info">
                    <h4 class="directory-company-name">Tech Innovations Inc.</h4>
                    <hr>

                    <div class="cat-btn">
                      <button class="category-name-btn">Category Name</button>
                      <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                      <div class="dir-left">
                        <h5>Member Since</h5>
                        <p>2019</p>
                      </div>
                      <div class="ver-line"></div>
                      <div class="dir-left">
                        <h5>Location</h5>
                        <p>Aliganj, Lucknow</p>
                      </div>
                    </div>

                    <div class="horizontal-line"></div>

                    <p class="directory-description">Leading provider of cutting-edge software solutions and IT services
                      for businesses worldwide.</p>
                    <div class="directory-buttons">
                      <div class="d-flex align-items-center">
                        <p class="m-0" style="font-size:14px;"><strong>Publish:</strong><br>26 Aug 2023</p>
                      </div>
                      <button class="btn btn-sm btn-primary">Contact Now</button>
                      <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                      <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                    </div>
                  </div>
                </div>
              </div>
              <!-- Directory Card 3 -->
              <div class="swiper-slide">
                <div class="directory-card-main d-flex flex-column">
                  <div class="directory-logo">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"
                      class="img-fluid" alt="Company Logo 1">
                  </div>
                  <div class="verified-seal">
                    <div class="top-veri">
                      <img src="{{ asset('images') }}/verify.png" alt="verified">
                      <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                    </div>


                  </div>
                  <div class="directory-info">
                    <h4 class="directory-company-name">Tech Innovations Inc.</h4>
                    <hr>

                    <div class="cat-btn">
                      <button class="category-name-btn">Category Name</button>
                      <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                      <div class="dir-left">
                        <h5>Member Since</h5>
                        <p>2019</p>
                      </div>
                      <div class="ver-line"></div>
                      <div class="dir-left">
                        <h5>Location</h5>
                        <p>Aliganj, Lucknow</p>
                      </div>
                    </div>

                    <div class="horizontal-line"></div>

                    <p class="directory-description">Leading provider of cutting-edge software solutions and IT services
                      for businesses worldwide.</p>
                    <div class="directory-buttons">
                      <div class="d-flex align-items-center">
                        <p class="m-0" style="font-size:14px;"><strong>Publish:</strong><br>26 Aug 2023</p>
                      </div>
                      <button class="btn btn-sm btn-primary">Contact Now</button>
                      <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                      <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="directory-card-main d-flex flex-column">
                  <div class="directory-logo">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"
                      class="img-fluid" alt="Company Logo 1">
                  </div>
                  <div class="verified-seal">
                    <div class="top-veri">
                      <img src="{{ asset('images') }}/verify.png" alt="verified">
                      <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                    </div>


                  </div>
                  <div class="directory-info">
                    <h4 class="directory-company-name">Tech Innovations Inc.</h4>
                    <hr>

                    <div class="cat-btn">
                      <button class="category-name-btn">Category Name</button>
                      <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                      <div class="dir-left">
                        <h5>Member Since</h5>
                        <p>2019</p>
                      </div>
                      <div class="ver-line"></div>
                      <div class="dir-left">
                        <h5>Location</h5>
                        <p>Aliganj, Lucknow</p>
                      </div>
                    </div>

                    <div class="horizontal-line"></div>

                    <p class="directory-description">Leading provider of cutting-edge software solutions and IT services
                      for businesses worldwide.</p>
                    <div class="directory-buttons">
                      <div class="d-flex align-items-center">
                        <p class="m-0" style="font-size:14px;"><strong>Publish:</strong><br>26 Aug 2023</p>
                      </div>
                      <button class="btn btn-sm btn-primary">Contact Now</button>
                      <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                      <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="directory-card-main d-flex flex-column">
                  <div class="directory-logo">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"
                      class="img-fluid" alt="Company Logo 1">
                  </div>
                  <div class="verified-seal">
                    <div class="top-veri">
                      <img src="{{ asset('images') }}/verify.png" alt="verified">
                      <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                    </div>


                  </div>
                  <div class="directory-info">
                    <h4 class="directory-company-name">Tech Innovations Inc.</h4>
                    <hr>

                    <div class="cat-btn">
                      <button class="category-name-btn">Category Name</button>
                      <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="d-flex justify-content-between">
                      <div class="dir-left">
                        <h5>Member Since</h5>
                        <p>2019</p>
                      </div>
                      <div class="ver-line"></div>
                      <div class="dir-left">
                        <h5>Location</h5>
                        <p>Aliganj, Lucknow</p>
                      </div>
                    </div>

                    <div class="horizontal-line"></div>

                    <p class="directory-description">Leading provider of cutting-edge software solutions and IT services
                      for businesses worldwide.</p>
                    <div class="directory-buttons">
                      <div class="d-flex align-items-center">
                        <p class="m-0" style="font-size:14px;"><strong>Publish:</strong><br>26 Aug 2023</p>
                      </div>
                      <button class="btn btn-sm btn-primary">Contact Now</button>
                      <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                      <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                    </div>
                  </div>
                </div>
              </div>
              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <!--<div class="swiper-button-prev"></div>-->
            <!--<div class="swiper-button-next"></div>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2">{{ $residential_property_for_sale->heading ?? 'Residential Properties for Sale'}}</h4>
        <p class="text-muted mb-0">
          {{ $residential_property_for_sale->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'}}
        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns d-inline-flex flex-wrap justify-content-center gap-2">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <button type="button" class="property-tab" data-filter="office">Flats</button>
          <button type="button" class="property-tab" data-filter="shops">House & Villa</button>
          <button type="button" class="property-tab" data-filter="godowns">Lands & Plots</button>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesSellResidential as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="office">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="{{route('property_detail', ['title' => $value->slug])}}">
                          <img
                            src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                              href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;">Office Space</p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                            {{ $value->getState->name }}
                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{number_format($value->price, 2)}}</h6>
                          <button class="btn btn-sm btn-primary">Contact Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>


    </div>
  </section>

  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2">{{ $commercial_property_for_rent->heading ?? 'Commercial Properties for Rent'}}</h4>
        <p class="text-muted mb-0">
          {{ $commercial_property_for_rent->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'}}
        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns d-inline-flex flex-wrap justify-content-center gap-2">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <button type="button" class="property-tab" data-filter="office">Office Space</button>
          <button type="button" class="property-tab" data-filter="shops">Shops & Showrooms</button>
          <button type="button" class="property-tab" data-filter="godowns">Warehouse & Godowns</button>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesRentCommercial as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="office">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="{{route('property_detail', ['title' => $value->slug])}}">
                          <img
                            src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                              href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;">Office Space</p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                            {{ $value->getState->name }}
                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{number_format($value->price, 2)}}</h6>
                          <button class="btn btn-sm btn-primary">Contact Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2">{{ $residential_property_for_rent->heading ?? 'Residential Properties for Rent'}}</h4>
        <p class="text-muted mb-0">
          {{ $residential_property_for_rent->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'}}
        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns d-inline-flex flex-wrap justify-content-center gap-2">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <button type="button" class="property-tab" data-filter="office">Office Space</button>
          <button type="button" class="property-tab" data-filter="shops">Shops & Showrooms</button>
          <button type="button" class="property-tab" data-filter="godowns">Warehouse & Godowns</button>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesRentResidential as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="office">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="{{route('property_detail', ['title' => $value->slug])}}">
                          <img
                            src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                              href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;">Office Space</p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                            {{ $value->getState->name }}
                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{number_format($value->price, 2)}}</h6>
                          <button class="btn btn-sm btn-primary">Contact Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="new-card-section">
    <div class="new-main-card">
      <!-- LEFT SIDE: Tabs -->
      <div class="new-left-tabs">
        <button class="new-tab-btn active" data-tab="tab1">Technology</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab2">Healthcare</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab3">Education</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab4">Business</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Travel</button>
      </div>

      <!-- RIGHT SIDE: Image Sections -->
      <div class="new-right-slider">
        <div class="new-tab-content active" id="tab1">
          <div class="new-slider-container">
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=870"
                alt="AI" />
              <h3 class="new-image-title">Artificial Intelligence</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&q=80&w=870"
                alt="Coding" />
              <h3 class="new-image-title">Web Development</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=870"
                alt="Cybersecurity" />
              <h3 class="new-image-title">Cybersecurity</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=870"
                alt="Tech" />
              <h3 class="new-image-title">Cloud Computing</h3>
            </div>
          </div>
        </div>

        <div class="new-tab-content" id="tab2">
          <div class="new-slider-container">
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1587502536263-9297b6d1a8ef?auto=format&fit=crop&q=80&w=870"
                alt="Healthcare" />
              <h3 class="new-image-title">Medical Research</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1580281657521-95868b0cbec3?auto=format&fit=crop&q=80&w=870"
                alt="Doctor" />
              <h3 class="new-image-title">Healthcare Services</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&q=80&w=870"
                alt="Hospital" />
              <h3 class="new-image-title">Modern Hospitals</h3>
            </div>
          </div>
        </div>

        <div class="new-tab-content" id="tab3">
          <div class="new-slider-container">
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=870"
                alt="Education" />
              <h3 class="new-image-title">E-Learning</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&q=80&w=870"
                alt="School" />
              <h3 class="new-image-title">Online Courses</h3>
            </div>
            <div class="new-slide">
              <img src="https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?auto=format&fit=crop&q=80&w=870"
                alt="Student" />
              <h3 class="new-image-title">Skill Development</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- reels section -->
  <section class="testimonial-reels-section py-5 bg-light">
    <div class="container">
      <h2 class="sec__title mb-3 text-center">{{ $reels->heading ?? 'Reels'}}</h2>
      <p class="sec__desc text-center">
        {{ $reels->title ?? 'Explore a range of digital assets ready to buy or sell'}}
      </p>
      <div class="row g-4 justify-content-center">

        <!-- Reel 1 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="{{ asset('images') }}/reels.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 2 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="{{ asset('images') }}/reels1.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 3 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="{{ asset('images') }}/reels.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 4 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="{{ asset('images') }}/reels1.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- trending property section -->
  @php
    $city_id = Cache::get('location-id');
    $projects = App\Properties::where('publish_status', 'Publish')->where('approval', '!=', 'Rejected')->where('trending', 'Yes')->where('status', '1')->where('city_id', $city_id)->orderBy('id', 'DESC')->get();
  @endphp
  @if(count($projects) > 0)
    <section class="property-topprojects">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title section-left">
              <h4>{{ $trending_projects ? $trending_projects->heading : '' }}</h4>
              <p>{{ $trending_projects ? $trending_projects->title : '' }}</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="swiper directory-slider pt-3 pb-3">
              <div class="swiper-wrapper">
                <!-- Directory Card 1 -->
                @foreach($projects as $key => $value)
                  <div class="swiper-slide">
                    <div class=" property-card" data-type="office">
                      <div class="newdesign-project-main shadow-sm">
                        <div class="newdesign-image-proj position-relative">
                          <a href="{{route('property_detail', ['title' => $value->slug])}}">
                            <img
                              src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                              alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                          </a>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        </div>
                        <div class="newdesign-info-proj p-3">
                          <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                                href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                            </h5>

                          </div>
                          <hr class="" style="margin-bottom:10px; margin-top:10px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                              style=" height:30px;">Office Space</p>
                            <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                            <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                          </div>

                          <div class="horizontal-line mt-2"></div>
                          <div class="d-flex justify-content-between align-items-center">

                            <p class="small text-secondary mb-2 mt-2">
                              <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                              {{ $value->getState->name }}
                            </p>
                            <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                          </div>

                          <div class="horizontal-line"></div>
                          <p class="small text-muted mb-2 mt-2">
                            {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              {{number_format($value->price, 2)}}</h6>
                            <button class="btn btn-sm btn-primary">Contact Now</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- features section -->
  <section class="home-features">
    <div class="features-overlay">
      <div class="container">
        <div class="row">
          @foreach($features as $feature)
            <div class="col-sm-3">
              <div class="feature"> <img src="{{ asset('storage') }}/{{ $feature->image }}" alt="Map" class="img-fluid">
                <h3 class="feature__title">{{ $feature->heading }}</h3>
                <p class="feature__desc"> {!! $feature->description !!} </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- latest property section -->
  <section class="property-home-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>{{ $latest_properties ? $latest_properties->heading : '' }}</h4>
            <p>{{ $latest_properties ? $latest_properties->title : '' }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($listings as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="office">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="{{route('property_detail', ['title' => $value->slug])}}">
                          <img
                            src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                              href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;">Office Space</p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                            {{ $value->getState->name }}
                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{number_format($value->price, 2)}}</h6>
                          <button class="btn btn-sm btn-primary">Contact Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- featured property section -->
  @php
    $featured_projects = App\Properties::where('publish_status', 'Publish')->where('approval', '!=', 'Rejected')->where('featured', 'Yes')->where('status', '1')->where('city_id', $city_id)->orderBy('id', 'DESC')->get();
  @endphp
  @if(count($featured_projects) > 0)
    <section class="featured-sold-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title section-center">
              <h4>{{ $featured_property ? $featured_property->heading : '' }}</h4>
              <p>{{ $featured_property ? $featured_property->title : '' }}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="swiper directory-slider pt-3 pb-3">
              <div class="swiper-wrapper">
                <!-- Directory Card 1 -->
                @foreach($featured_projects as $key => $value)
                  <div class="swiper-slide">
                    <div class=" property-card" data-type="office">
                      <div class="newdesign-project-main shadow-sm">
                        <div class="newdesign-image-proj position-relative">
                          <a href="{{route('property_detail', ['title' => $value->slug])}}">
                            <img
                              src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'}}"
                              alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                          </a>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        </div>
                        <div class="newdesign-info-proj p-3">
                          <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a
                                href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a>
                            </h5>

                          </div>
                          <hr class="" style="margin-bottom:10px; margin-top:10px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                              style=" height:30px;">Office Space</p>
                            <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                            <p class="share-now m-0"><i class="fa-solid fa-share-nodes" style="font-size:18px;"></i></p>

                          </div>

                          <div class="horizontal-line mt-2"></div>
                          <div class="d-flex justify-content-between align-items-center">

                            <p class="small text-secondary mb-2 mt-2">
                              <i class="fa-solid fa-location-dot"></i>{{ $value->getCity->name }} ,
                              {{ $value->getState->name }}
                            </p>
                            <p class="m-0 small"><i class="fa-solid fa-eye"></i> 197</p>
                          </div>

                          <div class="horizontal-line"></div>
                          <p class="small text-muted mb-2 mt-2">
                            {{ \Illuminate\Support\Str::limit($value->description, 50) }}
                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname }}</p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              {{number_format($value->price, 2)}}</h6>
                            <button class="btn btn-sm btn-primary">Contact Now</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- testimonial section -->
  <section class="testimonial-section">
    <h2 class="testimonial-heading">{{ $testimonials->heading ?? 'What Our Clients Say'}}</h2>
    <p>{{ $testimonials->title ?? ''}}</p>
    <div class="testimonial-slider pt-4 pb-4">
      <div class="testimonial-container">
        <!-- Testimonial 1 -->
        @if(isset($testimonial))
          @foreach($testimonial as $k => $testimoniall)

            <div class="testimonial-card">
              <div class="testimonial-profile">
                <img src="{{ asset('storage') }}/{{ $testimoniall->image }}" alt="Client 1">
              </div>
              <div class="testimonial-content">
                <p class="testimonial-text">
                  {{ $testimoniall->description }}
                </p>
                <div class="testimonial-stars">
                  ★★★★★
                </div>
                <h4 class="testimonial-name">{{ $testimoniall->name }}</h4>
                <p class="testimonial-role">{{ $testimoniall->designation }}</p>
              </div>
            </div>
          @endforeach
        @endif

      </div>
    </div>
    <div class="col-sm-12 text-center mt-3">
      <button class="btn btn-feedback" type="button" data-target="#send-feedback" data-toggle="modal">Send
        Feedback</button>
    </div>
  </section>

  <!-- send feedback modal -->
  <div class="modal fade custom-modal" id="send-feedback" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="top-design">
          <img src="{{ asset('images/top-designs.png')}}" class="img-fluid">
        </div>
        <div class="modal-body">
          <div class="modal-main">
            <div class="row login-heads">
              <div class="col-sm-12">
                <h3 class="heads-login">Send Feedback</h3>
                <span class="allrequired">All field are required</span>
              </div>
            </div>
            <div class="modal-form">
              <form method="post" action="{{ route('front.createTestimonial') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="label-control">Profile Picture</label>
                    <input type="file" class="text-control" name="image" required />
                  </div>
                  <div class="col-sm-6">
                    <label class="label-control">Name</label>
                    <input type="text" class="text-control" name="name" placeholder="Enter Name" required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="label-control">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" class="text-control" required="">
                  </div>
                  <div class="col-sm-6">
                    <label class="label-control">Mobile No.</label>
                    <input type="number" class="text-control" name="mobile_number" placeholder="Enter Mobile No."
                      required="">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Designation</label>
                    <input type="text" class="text-control" name="designation" placeholder="Enter Designation" required />
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Feedback</label>
                    <textarea class="text-control" rows="4" cols="2" name="description" placeholder="Your Feedback here.."
                      required=""></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-send w-100">Send Feedback <i
                        class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- contact us section -->
  <section class="need-help-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>{{ $help_content->heading }}</h4>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="help-box box-1">
            {!! $help_content->content_one !!}
            <a class="btn btn-startweb" href="#"> Start Chat</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="help-box box-2">
            {!! $help_content->content_two !!}
          </div>
        </div>
        <div class="col-md-4">
          <div class="help-box box-3">
            {!! $help_content->content_three !!}
          </div>
        </div>
      </div>
    </div>
  </section>

  @php
    $app_content = App\FooterContent::where('slug', 'app')->first();
  @endphp
  <!--<section class="app-section">-->
  <!--  <div class="container">-->
  <!--    <div class="row">-->
  <!--      <div class="col-lg-7 align-self-center">-->
  <!--        <div class="section-title">-->
  <!--          <h2>{{ $app_content->heading }}</h2>-->
  <!--          <p>{{ $app_content->title }}</p>-->
  <!--        </div>-->
  <!--        <div class="row">-->
  <!--          <div class="col-md-4">-->
  <!--            <div class="d-flex">-->
  <!--              <div class="mr-3"><i class="fas fa-truck-loading app-xll"></i></div>-->
  <!--              <h6 class="text-app-prim">{{ $app_content->key_one }}</h6>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <div class="col-md-4">-->
  <!--            <div class="d-flex">-->
  <!--              <div class="mr-3"><i class="fas fa-file-signature app-xll"></i></div>-->
  <!--              <h6 class="text-app-prim">{{ $app_content->key_two }}</h6>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--          <div class="col-md-4">-->
  <!--            <div class="d-flex">-->
  <!--              <div class="mr-3"> <i class="far fa-comment-dots app-xll"></i></div>-->
  <!--              <h6 class="text-app-prim">{{ $app_content->key_three }}</h6>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--      <div class="col-lg-5">-->
  <!--        <div class="app-mobile"> <img src="{{ asset('storage') }}/{{ $app_content->image }}" class="img-fluid"> </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->


@endsection



@section('js')

  <!-- JS -->
  <script>
    document.querySelectorAll('.property-tab').forEach(tab => {
      tab.addEventListener('click', function () {
        document.querySelectorAll('.property-tab').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');
        document.querySelectorAll('.property-card').forEach(card => {
          if (filter === 'all' || card.getAttribute('data-type') === filter) {
            card.classList.remove('hide');
          } else {
            card.classList.add('hide');
          }
        });
      });
    });
  </script>
  <script>
    (function () {
      const buttons = document.querySelectorAll('.tabs-btns .btn');
      const cards = document.querySelectorAll('.property-card');


      function setActiveButton(activeBtn) {
        buttons.forEach(b => b.classList.remove('active'));
        activeBtn.classList.add('active');
      }


      function filterCards(type) {
        cards.forEach(card => {
          const t = card.getAttribute('data-type');
          if (type === 'all' || t === type) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      }


      buttons.forEach(btn => {
        btn.addEventListener('click', function () {
          const type = this.getAttribute('data-filter');
          setActiveButton(this);
          filterCards(type);
        });
      });


      // initial state - show all
      filterCards('all');


    })();
  </script>
  <script>
    const tabs = document.querySelectorAll('.newupdateTab');
    const searchBar = document.querySelector('.newupdateSearchBar');
    const filters = document.querySelector('.newupdateFilterOptions');
    const searchInput = document.querySelector('.newupdateSearchInput');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const type = tab.getAttribute('data-type');
        searchBar.setAttribute('data-type', type);

        let placeholder = '';
        switch (type) {
          case 'buy':
            placeholder = 'Search by Project, Locality, or Builder';
            break;
          case 'rental':
            placeholder = 'Search by Location, Apartment, or PG';
            break;
          case 'projects':
            placeholder = 'Search by Project Name or Builder';
            break;
          case 'pg-hostels':
            placeholder = 'Search by PG Name or Locality';
            break;
          case 'plot-land':
            placeholder = 'Search by Area or Plot Type';
            break;
          case 'commercial':
            placeholder = 'Search by Office or Shop';
            break;
          case 'agents':
            placeholder = 'Search by Agent Name or Area';
            break;
        }
        searchInput.placeholder = placeholder;

        const dropdowns = filters.querySelectorAll('.newupdateDropdown');
        dropdowns.forEach((dropdown, index) => {
          dropdown.innerHTML = '';
          let options = [];
          switch (type) {
            case 'buy':
              options = index === 0 ? ['Budget', '0-10L', '10-20L'] :
                index === 1 ? ['Property Type', 'Apartment', 'House'] :
                  ['Furnishing Status', 'Furnished', 'Unfurnished'];
              break;
            case 'rental':
              options = index === 0 ? ['Budget', '0-5L', '5-10L'] :
                index === 1 ? ['Property Type', 'Apartment', 'Flat'] :
                  ['Furnishing Status', 'Furnished', 'Semi-Furnished'];
              break;
            default:
              options = ['Option 1', 'Option 2', 'Option 3'];
          }
          options.forEach(option => {
            const opt = document.createElement('option')
            opt.value = option;
            opt.textContent = option;
            dropdown.appendChild(opt);
          });
        });
      });
    });

    document.querySelector('.newupdateSearchBtn').addEventListener('click', function () {
      const location = document.querySelector('.newupdateSearchBar select').value;
      const query = document.querySelector('.newupdateSearchInput').value;
      const budget = document.querySelectorAll('.newupdateFilters select')[0].value;
      const propertyType = document.querySelectorAll('.newupdateFilters select')[1].value;
      const furnishing = document.querySelectorAll('.newupdateFilters select')[2].value;
      console.log(`Search: ${location}, ${query}, ${budget}, ${propertyType}, ${furnishing}`);
      alert(`Searching for: ${location}, ${query}, ${budget}, ${propertyType}, ${furnishing}`);
    });
  </script>
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper('.directory-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 1, // Slide one card at a time
      loop: true, // Disable loop for now, enable if you want infinite sliding
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        992: {
          slidesPerView: 4,
        },
        768: {
          slidesPerView: 1,
        },
      },
    });
  </script>
  <script>
    // Tab switching
    const newTabButtons = document.querySelectorAll(".new-tab-btn");
    const newTabContents = document.querySelectorAll(".new-tab-content");

    newTabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        newTabButtons.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        const target = btn.getAttribute("data-tab");
        newTabContents.forEach((content) => {
          content.classList.toggle("active", content.id === target);
        });
      });
    });

    // Infinite Auto Slide
    setInterval(() => {
      document.querySelectorAll(".new-slider-container").forEach((container) => {
        container.appendChild(container.firstElementChild);
      });
    }, 2500);

    // Infinite Auto Slide for Testimonials
    setInterval(() => {
      const container = document.querySelector(".testimonial-container");
      container.appendChild(container.firstElementChild);
    }, 3500);

  </script>



  <script type="text/javascript">
    $("#search_property").validate();
  </script>

@endsection