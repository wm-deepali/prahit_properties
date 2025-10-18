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

    $popular_cities_content = App\PopularCity::where('slug', 'heading')->first();
    $popular_cities = App\PopularCity::where('slug', 'city')->get();

  @endphp

  @php
    use App\Helpers\Helper;
    $buyFilters = Helper::getBuyFilterData();
    $rentalFilters = Helper::getRentalFilterData();
    $pgFilters = Helper::getPgHostelFilterData();
    $exclusiveFilters = Helper::getExclusiveLaunchFilterData(); // create this in Helper
    $plotFilters = Helper::getPlotLandFilterData();
    $cities = App\PopularCity::where('slug', 'city')->get();
  @endphp

  <div class="newupdateContainer">
    <div class="banner-top-content">
      <h1>{{ $banner ? $banner->heading : 'Gateway to Verified Properties Across India' }}</h1>
      <p>
        {{ $banner ? $banner->title : 'Discover thousands of verified properties, exclusive builder projects, and trusted service providers all in one place. Connect, explore, and make informed decisions with Bhawan Bhoomi – your reliable real estate partner.' }}
      </p>
    </div>

    <div class="newupdateSearchContainer">
      <div class="newupdateTabs">
        <button class="newupdateTab active" data-type="buy">Buy</button>
        <button class="newupdateTab" data-type="rental">Rental</button>
        <button class="newupdateTab" data-type="pg-hostels">PG / Hostels</button>
        <button class="newupdateTab" data-type="exculsive-launch">Exclusive Launch</button>
        <button class="newupdateTab" data-type="plot-land">Plot & Land</button>
      </div>

      <div class="newupdateSearchBar" data-type="buy">
        <select class="newupdateDropdown" id="citySelect">
          <option value="">Select City</option>
          @foreach($cities as $city)
            <option value="{{ $city->getCity->id }}">{{ $city->getCity->name }}</option>
          @endforeach
        </select>

        <input type="text" placeholder="Search by Project, Locality, or Builder" class="newupdateSearchInput">
        <button class="newupdateSearchIcon"><i class="fa-solid fa-location-crosshairs"></i></button>
      </div>

      {{-- BUY FILTERS --}}
      <div class="newupdateFilters" data-type="buy">
        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown" id="sub_category_id">
            <option value="">Property Category</option>
            @foreach ($buyFilters['categories'] as $cat)
              <option value="{{ $cat->id }}">{{ $cat->sub_category_name }}</option>
            @endforeach
          </select>

          {{-- ✅ Property Type as Checkboxes --}}
          <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
            style="max-height:100px; overflow-y:auto; width: 150px;">
            <label class="fw-bold mb-1">Property Type</label>
            <div id="sub_sub_category_items">
              @foreach($buyFilters['types'] as $v)
                <div class="form-check">
                  <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                    id="subsub_{{ $v->id }}" value="{{ $v->id }}">
                  <label class="form-check-label" for="subsub_{{ $v->id }}">
                    {{ $v->sub_sub_category_name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            @foreach ($buyFilters['budgets'] as $budget)
              <option value="{{ $budget['query'] }}">{{ $budget['label'] }}</option>
            @endforeach
          </select>

          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            @foreach ($buyFilters['posted_by'] as $poster)
              <option value="{{ strtolower($poster) }}">{{ $poster }}</option>
            @endforeach
          </select>
        </div>
        <button class="newupdateSearchBtn mt-2">Search</button>
      </div>


      {{-- RENTAL FILTERS --}}
      <div class="newupdateFilters" data-type="rental" style="display:none;">
        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown" id="sub_category_id">
            <option value="">Property Category</option>
            @foreach ($rentalFilters['categories'] as $cat)
              <option value="{{ $cat->id }}">{{ $cat->sub_category_name }}</option>
            @endforeach
          </select>

          {{-- ✅ Property Type as Checkboxes --}}
          <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
            style="max-height:100px; overflow-y:auto; width: 150px;">
            <label class="fw-bold mb-1">Property Type</label>
            <div id="sub_sub_category_items">
              @foreach($buyFilters['types'] as $v)
                <div class="form-check">
                  <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                    id="subsub_{{ $v->id }}" value="{{ $v->id }}">
                  <label class="form-check-label" for="subsub_{{ $v->id }}">
                    {{ $v->sub_sub_category_name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            @foreach ($rentalFilters['budgets'] as $budget)
              <option value="{{ $budget['query'] }}">{{ $budget['label'] }}</option>
            @endforeach
          </select>



          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            @foreach ($rentalFilters['posted_by'] as $poster)
              <option value="{{ strtolower($poster) }}">{{ $poster }}</option>
            @endforeach
          </select>
        </div>
        <button class="newupdateSearchBtn mt-2">Search</button>
      </div>

      {{-- PG / HOSTELS FILTERS --}}
      <div class="newupdateFilters" data-type="pg-hostels" style="display:none;">
        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            @foreach ($pgFilters['budgets'] as $budget)
              <option value="{{ $budget['query'] }}">{{ $budget['label'] }}</option>
            @endforeach
          </select>

          <select class="newupdateDropdown" id="pg_availavle_for">
            <option value="">Available For</option>
            @foreach ($pgFilters['available_for'] as $option)
              <option value="{{ strtolower($option) }}">{{ $option }}</option>
            @endforeach
          </select>

          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            @foreach ($pgFilters['posted_by'] as $poster)
              <option value="{{ strtolower($poster) }}">{{ $poster }}</option>
            @endforeach
          </select>
        </div>
        <button class="newupdateSearchBtn mt-2">Search</button>
      </div>

      {{-- EXCLUSIVE LAUNCH FILTERS --}}
      <div class="newupdateFilters" data-type="exculsive-launch" style="display:none;">
        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown" id="sub_category_id">
            <option value="">Sub Category</option>
            @foreach ($exclusiveFilters['categories'] as $cat)
              <option value="{{ $cat->id }}">{{ $cat->sub_category_name }}</option>
            @endforeach
          </select>

          <!-- <select class="newupdateDropdown" id="sub_sub_category_id"  multiple>
                              <option value="">Property Type</option>
                              @foreach ($exclusiveFilters['types'] as $type)
                                <option value="{{ $type->id }}">{{ $type->sub_sub_category_name }}</option>
                              @endforeach
                            </select> -->

          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            @foreach ($exclusiveFilters['budgets'] as $budget)
              <option value="{{ $budget['query'] }}">{{ $budget['label'] }}</option>
            @endforeach
          </select>



          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            @foreach ($exclusiveFilters['posted_by'] as $poster)
              <option value="{{ strtolower($poster) }}">{{ $poster }}</option>
            @endforeach
          </select>
        </div>
        <button class="newupdateSearchBtn mt-2">Search</button>
      </div>

      <div class="newupdateFilters" data-type="plot-land" style="display:none;">
        <div class="newupdateFilterOptions">
          
          {{-- ✅ Property Type as Checkboxes --}}
          <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
            style="max-height:100px; overflow-y:auto; width: 150px;">
            <label class="fw-bold mb-1">Property Type</label>
            <div id="sub_sub_category_items">
              @foreach($buyFilters['types'] as $v)
                <div class="form-check">
                  <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                    id="subsub_{{ $v->id }}" value="{{ $v->id }}">
                  <label class="form-check-label" for="subsub_{{ $v->id }}">
                    {{ $v->sub_sub_category_name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            @foreach ($plotFilters['budgets'] as $budget)
              <option value="{{ $budget['query'] }}">{{ $budget['label'] }}</option>
            @endforeach
          </select>

          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            @foreach ($plotFilters['posted_by'] as $poster)
              <option value="{{ strtolower($poster) }}">{{ $poster }}</option>
            @endforeach
          </select>
        </div>
        <button class="newupdateSearchBtn mt-2">Search</button>
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
      <div class=" popular-city-scroll">
        @if(count($popular_cities) > 0)
          @foreach($popular_cities as $popular_city)
            <div class="popular-card-image">
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

  @php
    $city_id = Cache::get('location-id');

    $propertiesSellCommercial = Helper::getPropertiesByCategoryAndSubcategory('Sell', 'ALL COMMERCIAL', $city_id);
    $propertiesSellResidential = Helper::getPropertiesByCategoryAndSubcategory('Sell', 'ALL RESIDENTIAL', $city_id);

    $propertiesRentCommercial = Helper::getPropertiesByCategoryAndSubcategory('Rent', 'ALL COMMERCIAL', $city_id);
    $propertiesRentResidential = Helper::getPropertiesByCategoryAndSubcategory('Rent', 'ALL RESIDENTIAL', $city_id);

    $exculsiveProperties = Helper::getPropertiesByCategory('Exclusive Launch', $city_id);
    $business_list = Helper::getAllBusinessListings();

    $sellSubs = Helper::getSubSubcategoriesByCategoryName('Sell');
    $sellResidentil = $sellSubs['residential'];
    $sellCommercial = $sellSubs['commercial'];

    $rentSubs = Helper::getSubSubcategoriesByCategoryName('Rent');
    $rentResidentil = $rentSubs['residential'];
    $rentCommercial = $rentSubs['commercial'];

    // Filter tabs to only show those with properties
    $sellResidentilFiltered = $sellResidentil->filter(function ($subSubcat) use ($propertiesSellResidential) {
      return $propertiesSellResidential->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $sellCommercialFiltered = $sellCommercial->filter(function ($subSubcat) use ($propertiesSellCommercial) {
      return $propertiesSellCommercial->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $rentResidentilFiltered = $rentResidentil->filter(function ($subSubcat) use ($propertiesRentResidential) {
      return $propertiesRentResidential->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $rentCommercialFiltered = $rentCommercial->filter(function ($subSubcat) use ($propertiesRentCommercial) {
      return $propertiesRentCommercial->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $projects = Helper::getTrendingProjectsByCity($city_id);
    $featured_projects = Helper::getFeaturedProjectsByCity($city_id);
  @endphp


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
                                style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                              {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                            </p>

                            <div class="d-flex justify-content-between">
                              <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                              <p class="m-0 small">
                                <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                              </p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                              <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                                {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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

  <!-- exculsive launched projects section -->
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
        @foreach($exculsiveProperties as $key => $value)
          <!-- Property Card 1 -->
          <div class="col-lg-4 mb-3">
            <div class="newdesign-project-main">
              <!--<a href="#">-->
              <div class="newdesign-image-proj">
                <a href="{{route('property_detail', ['title' => $value->slug])}}">
                  <img
                    src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;'}}"
                    class="img-fluid" alt="Property 1">
                </a>
                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
              </div>
              <div class="newdesign-info-proj">
                <div class="d-flex justify-content-between">
                  <h4 class="newdesign-proj-name"> <a
                      href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a></h4>
                  <span class="newdesign-proj-category">Villa</span>
                </div>
                <span class="newdesign-apart-name"> {{ \Illuminate\Support\Str::limit($value->description, 100) }}</span>
                <hr>
                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> {{ $value->getCity->name }},
                  {{ $value->getState->name }}</span>

                <div class="newdesign-proj-price">
                  <span><i class="fas fa-rupee-sign"></i>{{\App\Helpers\Helper::formatIndianPrice($value->price)}}</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="newdesign-proj-owner"><strong>Builder:</strong><br>
                    {{ $value->getUser->firstname ?? '' ?? 'Green Homes Ltd.'}}</span>
                  <span class="newdesign-proj-owner"><strong>Posted:</strong><br>
                    {{ optional($value->created_at)->format('d M Y') }}</span>
                </div>
              </div>
              <!--</a>-->
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Sell Commercial projects section -->
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
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          @foreach ($sellCommercialFiltered as $subSubcat)
            <button type="button" class="property-tab" data-filter="{{ $subSubcat->sub_sub_category_name }}">
              {{ $subSubcat->sub_sub_category_name }}</button>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesSellCommercial as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="{{ $value->getCategoryHierarchyName() }}">
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
                            style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                          {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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

  <!-- business lists section -->
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
              @foreach ($business_list as $list)
                <div class="swiper-slide">
                  <div class="directory-card-main d-flex flex-column">
                    <div class="directory-logo">
                      <img
                        src="{{isset($list->logo) ? asset('storage/' . $list->logo) : "https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"}}"
                        class="img-fluid" alt="Company Logo 1">
                    </div>
                    <div class="verified-seal">
                      <div class="top-veri">
                        <img src="{{ asset('images') }}/verify.png" alt="verified">
                        <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                      </div>
                    </div>
                    <div class="directory-info">
                      <h4 class="directory-company-name">{{ $list->business_name }}</h4>
                      <hr>

                      <div class="cat-btn">
                        <button class="category-name-btn">{{ $list->category->category_name ?? '' }}</button>
                        <p class="m-0"><i class="fa-solid fa-eye"></i> 197</p>
                      </div>
                      <div class="horizontal-line"></div>
                      <div class="d-flex justify-content-between">
                        <div class="dir-left">
                          <h5>Established Year</h5>
                          <p>{{  $list->established_year }}</p>
                        </div>
                        <div class="ver-line"></div>
                        <div class="dir-left">
                          <h5>Location</h5>
                          <p>{{ $list->city }}, {{ $list->state }}</p>
                        </div>
                      </div>

                      <div class="horizontal-line"></div>

                      <p class="directory-description"> {{ \Illuminate\Support\Str::limit($list->introduction, 120) }}</p>
                      <div class="directory-buttons">
                        <div class="d-flex align-items-center">
                          <p class="m-0" style="font-size:14px;"><strong>Member
                              Since:</strong><br>{{ optional($list->created_at)->format('d M Y') }}</p>
                        </div>
                        <button class="btn btn-sm btn-primary">Contact Now</button>
                        <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                        <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

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

  <!-- Sell Residential projects section -->
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
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          @foreach ($sellResidentilFiltered as $subSubcat)
            <button type="button" class="property-tab" data-filter="{{ $subSubcat->sub_sub_category_name }}">
              {{ $subSubcat->sub_sub_category_name }}</button>
          @endforeach

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesSellResidential as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="{{ $value->getCategoryHierarchyName() }}">
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
                            style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                          {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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

  <!-- Rent Commercial projects section -->
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
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          @foreach ($rentCommercialFiltered as $subSubcat)
            <button type="button" class="property-tab" data-filter="{{ $subSubcat->sub_sub_category_name }}">
              {{ $subSubcat->sub_sub_category_name }}</button>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesRentCommercial as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="{{ $value->getCategoryHierarchyName() }}">
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
                            style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                          {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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

  <!-- Rent Residential projects section -->
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
        <div class="tabs-btns">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          @foreach ($rentResidentilFiltered as $subSubcat)
            <button type="button" class="property-tab" data-filter="{{ $subSubcat->sub_sub_category_name }}">
              {{ $subSubcat->sub_sub_category_name }}
            </button>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              @foreach($propertiesRentResidential as $key => $value)
                <div class="swiper-slide">
                  <div class=" property-card" data-type="{{ $value->getCategoryHierarchyName() }}">
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
                            style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                          {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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
        <button class="new-tab-btn active" data-tab="tab1">IT / ITES</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab2">Call Center/ BPO</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab3">Corporate Businesses</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab4">Coaching Center</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Bank</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">ATM</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Pathology</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Clinic </button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Finance</button>
      </div>

      @php
        $businessTabs = [
          'IT & Softwares',
          'call-center',
          'Corporate Businesses',
          'coaching-center',
          'bank',
          'atm',
          'pathology',
          'Clinic',
          'finance'
        ];
      @endphp
      <!-- RIGHT SIDE: Image Sections -->
      <div class="new-right-slider">
        @foreach ($businessTabs as $index => $tabName)
          @php
            $businessProperties = Helper::getBusinessProperties($city_id ?? null, $tabName);
          @endphp
          <div class="new-tab-content {{ $loop->first ? 'active' : '' }}" id="tab{{ $index + 1 }}">
            <div class="new-slider-container">
              @forelse ($businessProperties as $value)
                    <div class="new-slide">
                      <div class="newdesign-project-main">
                        <div class="newdesign-image-proj">
                          <a href="{{ route('property_detail', ['title' => $value->slug]) }}">
                            <img src="{{ isset($value->PropertyGallery[0]->image_path)
                ? asset($value->PropertyGallery[0]->image_path)
                : 'https://static.squareyards.com/resources/images/mumbai/project-image/default.jpg' }}"
                              class="img-fluid" alt="Property 1">
                          </a>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        </div>
                        <div class="newdesign-info-proj">
                          <div class="d-flex justify-content-between">
                            <h4 class="newdesign-proj-name">
                              <a href="{{ route('property_detail', ['title' => $value->slug]) }}">
                                {{ $value->title }}
                              </a>
                            </h4>
                            <span class="newdesign-proj-category">
                              {{ $value->SubSubCategory->sub_sub_category_name ?? 'Commercial' }}
                            </span>
                          </div>
                          <span class="newdesign-apart-name">
                            {{ \Illuminate\Support\Str::limit($value->description, 100) }}
                          </span>
                          <hr>
                          <span class="newdesign-apart-adress">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $value->getCity->name ?? '' }}, {{ $value->getState->name ?? '' }}
                          </span>

                          <div class="newdesign-proj-price">
                            <span>
                              <i class="fas fa-rupee-sign"></i>
                              {{ \App\Helpers\Helper::formatIndianPrice($value->price) }}
                            </span>
                          </div>

                          <div class="d-flex justify-content-between">
                            <span class="newdesign-proj-owner"><strong>Builder:</strong><br>
                              {{ $value->getUser->firstname ?? 'Green Homes Ltd.' }}
                            </span>
                            <span class="newdesign-proj-owner"><strong>Posted:</strong><br>
                              {{ optional($value->created_at)->format('d M Y') }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
              @empty

              @endforelse
            </div>
          </div>
        @endforeach
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
                    <div class=" property-card">
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
                              style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                            {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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
                  <div class=" property-card">
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
                            style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                          {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? ''}}</p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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
                    <div class=" property-card">
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
                              style=" height:30px;">{{ $value->getCategoryHierarchyName() }}</p>
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
                            {{ \Illuminate\Support\Str::limit($value->description, 85) }}
                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"><strong>Owner:</strong><br>{{ $value->getUser->firstname ?? '' }}</p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br>{{ optional($value->created_at)->format('d M Y') }}
                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              {{\App\Helpers\Helper::formatIndianPrice($value->price)}}</h6>
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

  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function () {
      $('#citySelect').select2({
        placeholder: 'Select City',
        allowClear: true,
        ajax: {
          url: '/api/cities/search',  // You will create this route in Laravel
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              query: params.term // search term from user
            };
          },
          processResults: function (data) {
            // Convert your cities data to Select2 format
            return {
              results: data.map(city => ({ id: city.id, text: city.name }))
            };
          },
          cache: true
        },
        minimumInputLength: 1 // Start searching after typing 1 char
      });
    });

  </script>

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
    const searchInput = document.querySelector('.newupdateSearchInput');
    const filterBlocks = document.querySelectorAll('.newupdateFilters');

    // Switch tabs
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const type = tab.getAttribute('data-type');
        searchBar.setAttribute('data-type', type);

        filterBlocks.forEach(f => f.style.display = 'none');
        const activeFilter = document.querySelector(`.newupdateFilters[data-type="${type}"]`);
        if (activeFilter) activeFilter.style.display = 'block';

        let placeholder = '';
        switch (type) {
          case 'buy': placeholder = 'Search by Project, Locality, or Builder'; break;
          case 'rental': placeholder = 'Search by Location, Apartment, or PG'; break;
          case 'pg-hostels': placeholder = 'Search by PG Name or Locality'; break;
          case 'exculsive-launch': placeholder = 'Search by Project or Builder'; break;
          case 'plot-land': placeholder = 'Search by Area or Plot Type'; break;
          default: placeholder = 'Search properties...';
        }
        searchInput.placeholder = placeholder;
      });
    });

    // Search button click
    // Search button click
    document.querySelectorAll('.newupdateSearchBtn').forEach(btn => {
      btn.addEventListener('click', function () {
        const activeType = document.querySelector('.newupdateTab.active').getAttribute('data-type');
        const location = document.querySelector('.newupdateSearchBar select').value;
        const searchQuery = document.querySelector('.newupdateSearchInput').value;

        const activeFilters = document.querySelector(`.newupdateFilters[data-type="${activeType}"]`);
        const selects = activeFilters.querySelectorAll('select');

        let params = new URLSearchParams();
        params.append('type', activeType);
        if (location) params.append('city', location);
        if (searchQuery) params.append('search', searchQuery);

        // Loop through all select dropdowns
        selects.forEach(select => {
          if (select.value) {
            params.append(select.id, select.value);
          }
        });

        // ✅ Collect all checked property type checkboxes
        const checkedBoxes = activeFilters.querySelectorAll('.sub-sub-checkbox:checked');
        if (checkedBoxes.length > 0) {
          const values = Array.from(checkedBoxes).map(cb => cb.value);
          params.append('sub_sub_category_id', values.join(',')); // comma-separated list
        }

        // Redirect to backend route with all filters
        window.location.href = "{{ route('listing.list') }}" + "?" + params.toString();
      });
    });


    // Show default buy filters
    document.querySelector(`.newupdateFilters[data-type="buy"]`).style.display = 'block';
  </script>

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper('.directory-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1, // 📱 Mobile: 1 card
        },
        768: {
          slidesPerView: 2, // Tablet: 2 cards
        },
        992: {
          slidesPerView: 3, // Desktop: 3 cards
        },
        1200: {
          slidesPerView: 4, // Large Desktop: 4 cards
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