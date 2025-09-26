@extends('layouts.front.app')

@section('title')
  <title>Welcome</title>
@endsection

@section('content')
  @php
    $banner = App\Models\FrontContent::where('slug', 'Banner')->first();
    $hand_picked = App\Models\FrontContent::where('slug', 'Hand-Picked')->first();
    $trending = App\Models\FrontContent::where('slug', 'Trending-Projects')->first();
    $latest_property = App\Models\FrontContent::where('slug', 'Latest-Properties')->first();
    $featured_property = App\Models\FrontContent::where('slug', 'Featured-Property')->first();
  @endphp
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
  @php
    $popular_cities_content = App\PopularCity::where('slug', 'heading')->first();
    $popular_cities = App\PopularCity::where('slug', 'city')->get();
  @endphp
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
        @if(isset($listings))
          @foreach($listings as $key => $value)
            @if(in_array($value->id, explode(',', $hand_picked->ids)))
              <div class="col-sm-3">
                <div class="property-list-01">
                  <div class="property-img">
                    <a href="{{route('property_detail', ['title' => $value->slug])}}">
                      <img
                        src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : ''}}"
                        class="img-fluid"> <span
                        class="type-pro">{{isset($value->property_types->type) ? $value->property_types->type : ''}}</span><span
                        class="price-pro">Rs. {{number_format($value->price, 2)}}</span>
                    </a>
                  </div>
                  <div class="property-content">
                    <div class="property-title">
                      <h4><a href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a></h4>
                      <a href="#" class="property-address"> <i class="fas fa-map-marker"></i> {{$value->address}} </a>
                    </div>
                    <!-- <ul class="property-features">
                                                    <li>Area <span>440 sq ft</span></li>
                                                    <li>Bedrooms <span>2</span></li>
                                                    <li>Bathrooms <span>1</span></li>
                                                  </ul> -->
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        @endif

      </div>
    </div>
  </section>
  @php
    $city_id = Cache::get('location-id');
    $trending_projects = App\Properties::where('publish_status', 'Publish')->where('approval', '!=', 'Rejected')->where('trending', 'Yes')->where('status', '1')->where('city_id', $city_id)->orderBy('id', 'DESC')->get();
  @endphp
  @if(count($trending_projects) > 0)
    <section class="property-topprojects">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title section-left">
              <h4>{{ $trending ? $trending->heading : '' }}</h4>
              <p>{{ $trending ? $trending->title : '' }}</p>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($trending_projects as $trending)
            <div class="col-lg-4 mb-3">
              <div class="project-main">
                <a href="{{route('property_detail', ['title' => $trending->slug])}}">
                  <div class="image-proj">
                    <img
                      src="{{isset($trending->PropertyGallery[0]->image_path) ? asset('') . $trending->PropertyGallery[0]->image_path : ''}}"
                      class="img-fluid">
                  </div>

                  <div class="info-proj">
                    <h4 class="proj-name">{{ $trending->title }}</h4>
                    <span
                      class="apart-name">{{ \Illuminate\Support\Str::limit($trending->description, 100, $end = '...') }}</span>
                    <span class="apart-adress">{{ $trending->getState ? $trending->getState->name : '' }},
                      {{ $trending->getCity ? $trending->getCity->name : '' }},
                      {{ $trending->Location ? $trending->Location->name : '' }}, {{ $trending->address }}</span>
                    <div class="proj-price">
                      <span><i class="fas fa-rupee-sign"></i> {{ $trending->price }}</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
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
  <section class="property-home-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>{{ $latest_property ? $latest_property->heading : '' }}</h4>
            <p>{{ $latest_property ? $latest_property->title : '' }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        @if(isset($listings))
          @foreach($listings as $key => $value)

            <div class="col-sm-2">
              <div class="property-gridsm">
                <div class="property-img"><a href="{{route('property_detail', ['title' => $value->slug])}}"> <img
                      src="{{isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : ''}}"
                      class="img-fluid"> <span
                      class="type-pro">{{isset($value->property_types->type) ? $value->property_types->type : ''}}</span><span
                      class="price-pro">RRs. {{number_format($value->price, 2)}}</span> </a>
                </div>
                <div class="property-content">
                  <div class="property-title">
                    <h4><a href="{{route('property_detail', ['title' => $value->slug])}}">{{$value->title}}</a></h4>
                    <a href="#" class="property-address"> <i class="fas fa-map-marker"></i> {{$value->address}} </a>
                  </div>
                </div>
              </div>
            </div>

          @endforeach
        @endif
      </div>
    </div>
  </section>
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
          @foreach($featured_projects as $featured)
            <div class="col-lg-6 col-md-12">
              <div class="property-list-3">

                <div class="listing-img-wrapper">
                  <a href="{{route('property_detail', ['title' => $featured->slug])}}">
                    <img
                      src="{{isset($featured->PropertyGallery[0]->image_path) ? asset('') . $featured->PropertyGallery[0]->image_path : ''}}"
                      class="img-fluid mx-auto" alt="">
                  </a>

                </div>

                <div class="listing-content">
                  <div class="listing-detail-wrapper-box">
                    <div class="listing-detail-wrapper">
                      <div class="listing-short-detail">
                        <h4 class="listing-name"><a href="property-detail.php">{{ $featured->title }}</a></h4>
                        <div class="fr-can-rating">
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star"></i>
                          <span class="reviews_text">(42 Reviews)</span>
                        </div>
                        <span
                          class="prt-types sale">{{ \Illuminate\Support\Str::limit($featured->description, 100, $end = '...') }}</span>
                      </div>
                      <div class="list-price">
                        <h6 class="listing-card-info-price"><i class="fas fa-rupee-sign"></i>{{ $featured->price }}</h6>
                      </div>
                    </div>
                  </div>

                  <div class="listing-footer-wrapper">
                    <div class="listing-locate">
                      <span class="listing-location"><i
                          class="fas fa-map-marker-alt"></i>{{ $featured->getState ? $featured->getState->name : '' }},
                        {{ $featured->getCity ? $featured->getCity->name : '' }},
                        {{ $featured->Location ? $featured->Location->name : '' }}, {{ $featured->address }}</span>
                    </div>
                    <div class="listing-detail-btn">
                      <a href="{{route('property_detail', ['title' => $featured->slug])}}" class="more-btn">View</a>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
  <section class="client-reviews-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4>What People Says</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="people-says-owl-car owl-carousel" id="people-says-home">
            @if(isset($testimonials))
              @foreach($testimonials as $k => $testimonial)
                <div class="item">
                  <article class="quote-modern">
                    <div class="quote-modern-inner">
                      <time class="quote-modern-time"
                        datetime="2020">{{date("jS F, Y", strtotime($testimonial->created_at))}}</time>
                      <div class="quote-modern-main">
                        <p>{{ $testimonial->description }}</p>
                      </div>
                      <div class="quote-modern-meta-outer">
                        <img class="quote-modern-avatar" src="{{ asset('storage') }}/{{ $testimonial->image }}" alt=""
                          width="57" height="57" />
                        <div class="quote-modern-meta">
                          <h4 class="quote-modern-cite">{{ $testimonial->name }}</h4>
                          <p class="quote-modern-position">{{ $testimonial->designation }}</p>
                        </div>
                      </div>
                    </div>
                  </article>
                </div>
              @endforeach
            @endif
          </div>
        </div>

        <div class="col-sm-12 text-center mt-3">
          <button class="btn btn-feedback" type="button" data-target="#send-feedback" data-toggle="modal">Send
            Feedback</button>
        </div>
      </div>
    </div>
  </section>
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
  <section class="app-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 align-self-center">
          <div class="section-title">
            <h2>{{ $app_content->heading }}</h2>
            <p>{{ $app_content->title }}</p>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="d-flex">
                <div class="mr-3"><i class="fas fa-truck-loading app-xll"></i></div>
                <h6 class="text-app-prim">{{ $app_content->key_one }}</h6>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <div class="mr-3"><i class="fas fa-file-signature app-xll"></i></div>
                <h6 class="text-app-prim">{{ $app_content->key_two }}</h6>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <div class="mr-3"> <i class="far fa-comment-dots app-xll"></i></div>
                <h6 class="text-app-prim">{{ $app_content->key_three }}</h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="app-mobile"> <img src="{{ asset('storage') }}/{{ $app_content->image }}" class="img-fluid"> </div>
        </div>
      </div>
    </div>
  </section>

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


@endsection



@section('js')

  <script type="text/javascript">
    $("#search_property").validate();
  </script>

@endsection