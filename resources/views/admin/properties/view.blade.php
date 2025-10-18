@extends('layouts.app')

@section('title')
  Manage Properties
@endsection

@section('content')

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <div class="loading">
              <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </div>
            <h3 class="content-header-title">Property</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Property</li>
              <li class="breadcrumb-item active">Manage Property</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content-main-body">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="card-block">
            <h4 class="form-section-h">Property Description & Price</h4>
            <div class="row mb-3">
              <div class="col-sm-4">
                <label class="content-label">Property Available For</label>
                <h5 class="content-h">{{ $data->Category ? $data->Category->category_name : 'N/A' }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Property Category</label>
                <h5 class="content-h">{{ $data->SubCategory ? $data->SubCategory->sub_category_name : 'N/A' }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Property Type</label>
                <h5 class="content-h">{{ $data->SubSubCategory ? $data->SubSubCategory->sub_sub_category_name : 'N/A' }}
                </h5>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4">
                <label class="content-label">Unique Id</label>
                <h5 class="content-h">{{ $data->listing_id }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Title</label>
                <h5 class="content-h">{{ $data->title }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Slug</label>
                <h5 class="content-h">{{ $data->slug }}</h5>
              </div>
            </div>
            <div class="row mb-3">
              <!-- <div class="col-sm-4">
                <label class="content-label">Property Type</label>
                <h5 class="content-h">{{ $data->PropertyTypes ? $data->PropertyTypes->type : 'N/A' }}</h5>
              </div> -->
              <div class="col-sm-4">
                <label class="content-label">Price</label>
                <h5 class="content-h">₹{{\App\Helpers\Helper::formatIndianPrice($data->price)}}</h5>
              </div>

              {{-- Price Label --}}
              <div class="col-sm-4">
                <label class="content-label">Price Label</label>
                <h5 class="content-h">
                  {{ $data->price_label ? $data->getPriceLabels($data->price_label) : 'N/A' }}
                </h5>
                @if(!empty($data->price_label_second))
                  <div>
                    <strong>{{ optional($data->getPriceLabelObj())->second_input_label ?? 'Date' }}:</strong>
                    <span>{{ $data->price_label_second }}</span>
                  </div>
                @endif
              </div>

              {{-- Property Status --}}
              <div class="col-sm-4">
                <label class="content-label">Property Status</label>
                <h5 class="content-h">
                  {{ $data->property_status ? $data->getPropertyStatuses($data->property_status) : 'N/A' }}
                </h5>
                @if(!empty($data->property_status_second))
                  <div>
                    <strong>{{ optional($data->getPropertyStatusObj())->second_input_label ?? 'Date' }}:</strong>
                    <span>{{ $data->property_status_second }}</span>
                  </div>
                @endif
              </div>

              {{-- Registration Status --}}
              <div class="col-sm-4">
                <label class="content-label">Registration Status</label>
                <h5 class="content-h">
                  {{ $data->registration_status ? $data->getRegistrationStatuses($data->registration_status) : 'N/A' }}
                </h5>
                @if(!empty($data->registration_status_second))
                  <div>
                    <strong>{{ optional($data->getRegistrationStatusObj())->second_input_label ?? 'Date' }}:</strong>
                    <span>{{ $data->registration_status_second }}</span>
                  </div>
                @endif
              </div>

              {{-- Furnishing Status --}}
              <div class="col-sm-3">
                <label class="content-label">Furnishing Status</label>
                <h5 class="content-h">
                  {{ $data->furnishing_status ? $data->getFurnishingStatuses($data->furnishing_status) : 'N/A' }}
                </h5>
                @if(!empty($data->furnishing_status_second))
                  <div>
                    <strong>{{ optional($data->getFurnishingStatusObj())->second_input_label ?? 'Date' }}:</strong>
                    <span>{{ $data->furnishing_status_second }}</span>
                  </div>
                @endif
              </div>

              <!-- <div class="col-sm-4">
                <label class="content-label">Price Label</label>
                <h5 class="content-h">
                  @if(in_array(1, explode(',', $data->price_label)))
                  All Inclusive Price,
                  @endif
                  @if(in_array(2, explode(',', $data->price_label)))
                  Tax Charges Included,
                  @endif
                  @if(in_array(3, explode(',', $data->price_label)))
                  Price Negotiable
                  @endif
                  </h5>
                </div> -->
            </div>
            <h4 class="form-section-h">Property Location</h4>


            <div class="row mb-3">
              <div class="col-sm-4">
                <label class="content-label">State</label>
                <h5 class="content-h">{{ $data->getState->name }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">City</label>
                <h5 class="content-h">{{ $data->getCity->name }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Address</label>
                <h5 class="content-h">{{ $data->address }}</h5>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4">
                <label class="content-label">Location</label>
                <h5 class="content-h">{{ $data->getLocations($data->location_id) }}</h5>
              </div>
              <div class="col-sm-4">
                <label class="content-label">Sub Location</label>
                <h5 class="content-h">
                  {{ $data->sub_location_name  ?? 'N/A' }}
                </h5>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <label class="content-label">Description</label>
                <h5 class="content-h">{{ $data->description }}</h5>
              </div>
            </div>
            @if(count($amenities) > 0)

              <h4 class="form-section-h">Property Amenities</h4>

              <div class="row mb-3">
                @foreach($amenities as $amenity)
                  <div class="col-sm-2">
                    <div class="amenities-main-ad">
                      <img src="{{ asset('storage') }}/{{ $amenity->icon }}" class="img-fluid">
                      <h3>{{ $amenity->name }}</h3>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

            <h4 class="form-section-h">Property Images</h4>

            <div class="row mb-3">
              @if(count($data->PropertyGallery) > 0)
                @foreach($data->PropertyGallery as $value)
                  <div class="col-sm-3">
                    <a href="{{ asset('') }}/{{ $value->image_path }}" target="_blank">
                      <img src="{{ asset('') }}/{{ $value->image_path }}" alt="Property Images" class="img-fluid"
                        style="height: 100px;"></a>
                  </div>
                @endforeach
              @else
                <h5 style="color: red;">No Any Images Found.</h5>
              @endif
            </div>

            <h4 class="form-section-h">Property Additional Information</h4>
            <input type="hidden" name="save_json" id="save_json" value="{{ $data->additional_info }}">

            <div id="fb-render"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('js')
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
  <script type="text/javascript">
    $(function () {
      document.getElementById('fb-render').innerHTML = '';
      var formData = $('#save_json').val();
      var formRenderOptions = { formData };
      frInstance = $('#fb-render').formRender(formRenderOptions);
    });
  </script>
@endsection