@extends('layouts.app')

@section('title')
  Preview Properties
@endsection

@section('content')

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <a href="{{ url('master/properties/' . base64_encode($id) . '/edit') }}?from=preview"><button
              class="btn btn-primary">Edit Property</button></a>
          <div class="card">
            <div class="loading">
              <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </div>
            <div class="card-body">
              <div class="card-block">
                <form class="form-body" id="update_property_form" name="update_property_form"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Preview Property Description</h4>

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_form_type);" disabled="">
                        @foreach($category as $k => $v)
                          <option value="{{$v->id}}" {{$property->category_id == $v->id ? "selected" : ""}}>
                            {{$v->category_name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control populate_subcategories" id="sub_category_id" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value, fetch_form_type);" required disabled="">
                        <option value="">Select Category</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Property Type</label>
                      <select class="text-control populate_subsubcategories" name="sub_sub_category_id"
                        id="sub_sub_category_id" onchange="fetch_form_type();" disabled="">
                        <option value="">Select Property Type</option>
                      </select>
                    </div>

                    <div class="col-sm-12">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name"
                        value="{{$property->title}}" required readonly="" />
                    </div>

                   
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description" required
                        readonly=""> {{$property->description}}</textarea>
                    </div>
                  </div>

                  <div id="fb-render"></div>
                  <div class="row">
                    <input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
                  </div>

                  <div id="amenitiesField" style="display: none;">
                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row">
                      @foreach($amenities as $amenity)
                        <div class="col-sm-3">
                          <img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
                          <p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}" disabled=""
                              @if(in_array($amenity->id, explode(',', $property->amenities))) checked @endif>
                            {{ $amenity->name }}</p>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Location</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">State </label>
                      <select class="form-control" name="state" id="state" required="" disabled="">
                        <option value="">Select State </option>
                        @foreach($states as $state)
                          @if($property->state_id == $state->id)
                            <option value="{{ $state->id }}" selected="">{{ $state->name }}</option>
                          @else
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">City </label>
                      <select class="form-control" name="city" id="city" required="" disabled="">
                        @foreach($cities as $city)
                          @if($property->city_id == $city->id)
                            <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                          @else
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">Location </label>
                      <select class="text-control" name="location_id" id="location_id" required="" disabled="">
                        @foreach($locations as $location)
                          @if($property->location_id == $location->id)
                            <option value="{{ $location->id }}" selected="">{{ $location->location }}</option>
                          @else
                            <option value="{{ $location->id }}">{{ $location->location }}</option>
                          @endif
                        @endforeach
                      </select>

                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location </label>
                      <input type="text" class="text-control" name="sub_location_display" id="sub_location_display"
                        value="{{ $property->sub_location_id ? $property->getSubLocations($property->sub_location_id) : '' }}"
                        disabled />
                    </div>

                  </div>
                  	<div class="form-group-f row">
    <div class="form-group col-sm-6">
        <label class="label-control">Landmark</label>
        <input type="text"
               class="form-control"
               value="{{ $property->landmark }}"
               readonly>
    </div>

    <div class="form-group col-sm-6">
        <label class="label-control">Pin Code</label>
        <input type="text"
               class="form-control"
               value="{{ $property->pincode }}"
               readonly>
    </div>
                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="{{ $property->address }}" required readonly="" />
                    </div>
                  </div>

                  <div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
                  <input type="hidden" value="{{ $property->latitude }}" name="latitude" id="latitude">
                  <input type="hidden" value="{{ $property->longitude }}" name="longitude" id="longitude">
                  

                  <h4 class="form-section-h">Property Photos</h4>

<div class="row g-3">

  @forelse($property->PropertyGallery as $img)

    <div class="col-sm-3">
      <div class="position-relative text-center p-2 rounded"
           style="
             border: {{ $img->is_default ? '2px solid #0d6efd' : '1px solid #ddd' }};
             background:#fff;
           ">

        {{-- Default Badge --}}
        @if($img->is_default)
          <span class="badge bg-primary position-absolute"
                style="top:6px;left:6px;">
            Default
          </span>
        @endif

        <a href="{{ asset($img->image_path) }}" target="_blank">
          <img src="{{ asset($img->image_path) }}"
               class="img-fluid rounded"
               style="height:180px;width:100%;object-fit:cover;">
        </a>

      </div>
    </div>

  @empty
    <div class="col-sm-12">
      <p class="text-danger">No property images uploaded.</p>
    </div>
  @endforelse

</div>


	@if(!empty($property->property_video))
									<h3 class="mt-4">Property Video</h3>
									<div class="form-group">
										<video width="320" height="240" controls>
											<source src="{{ url($property->property_video) }}" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								@endif
                
                  <div class="form-group-f row">
                    <div class="col-sm-12 text-center">
                      <a href="{{ url('post/property/final') }}/{{ base64_encode($id) }}"><button class="btn btn-primary"
                          type="button">Next</button></a>
                    </div>
                  </div>

                  <input type="hidden" id="id" name="id" value="{{$property->id}}" />
                  <input type="hidden" id="formtype_id" name="formtype_id" value="{{$property->formtype_id}}" />
                  {{csrf_field()}}
                </form>
              </div>
            </div>
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

    @if(!empty($property->latitude) && !empty($property->longitude))

      // Initialize map with property coordinates
      createMap({{ $property->latitude }}, {{ $property->longitude }});
    @else
              // Otherwise use browser geolocation or default
              if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (pos) {
          createMap(pos.coords.latitude, pos.coords.longitude);
        }, function () {
          createMap(28.6139, 77.2090); // fallback Delhi
        });
      } else {
        createMap(28.6139, 77.2090);
      }
    @endif


    function createMap(lat, lng) {
      var map = L.map('propertyMap').setView([lat, lng], 16);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      var marker = L.marker([lat, lng], { draggable: true }).addTo(map);
      document.getElementById('latitude').value = lat;
      document.getElementById('longitude').value = lng;

      marker.on('dragend', function (e) {
        var p = e.target.getLatLng();
        document.getElementById('latitude').value = p.lat;
        document.getElementById('longitude').value = p.lng;
      });

      map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
      });
    }


    $(function () {
      fetch_subcategories('{{$property->category_id}}', function () {
        $(".populate_subcategories").val('{{$property->sub_category_id}}');
        fetch_form_type();
        fetch_subsubcategories('{{$property->sub_category_id}}', function () {
          $(".populate_subsubcategories").val('{{$property->sub_sub_category_id}}');
          fetch_form_type();
        });
      });

      $(".property_use_for").hide();

      setTimeout(function () {
        document.getElementById('fb-render').innerHTML = '';
        var formData = $('#save_json').val();
        var formRenderOptions = { formData };
        frInstance = $('#fb-render').formRender(formRenderOptions);
      }, 1000);

      setTimeout(function () {
        var formData = $('#save_json').val();
        var json_data = JSON.parse(formData);
        console.log(json_data);
        var formRenderOptions = { formData };
        frInstance = $('#fb-render').formRender(formRenderOptions);
        $("#fb-render :input").prop("disabled", true);
      }, 2000);
    });


    //-------------------- Get city By state --------------------//
    $('#state').on('change', function () {
      var state_id = this.value;
      $("#city").html('');
      $.ajax({
        url: "{{route('front.getCities')}}",
        type: "POST",
        data: {
          state_id: state_id,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function (result) {
          $('#city').html('<option value="">Select City</option>');
          $.each(result, function (key, city) {
            $("#city").append('<option value="' + city.id + '" >' + city.name + '</option>');
          });
        }
      });
    });

    //-------------------- Get city By state --------------------//
    $('#city').on('change', function () {
      var city_id = this.value;
      $("#location_id").html('');
      $.ajax({
        url: "{{route('front.getLocations')}}",
        type: "POST",
        data: {
          city_id: city_id,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function (result) {
          $('#location_id').html('<option value="">Select Location</option>');
          $.each(result, function (key, location) {
            $("#location_id").append('<option value="' + location.id + '" >' + location.location + '</option>');
          });
        }
      });
    });



    function fetch_subcategories(id, callback) {
      var route = "{{ url('get/sub-categories') }}/" + id
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".addproperty").attr('disabled', true);
          $(".add_formtype").empty();
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          // var response = JSON.parse(response);
          if (response.status === 200) {
            $(".populate_subcategories").empty();
            var subcategories = response.subcategories;
            if (subcategories.length > 0) {
              console.log('here');

              $.each(subcategories, function (x, y) {
                if ('{{ $property->sub_category_id ?? 0}}' == y.id)
                  $(".populate_subcategories").append(
                    `<option value=${y.id} selected> ${y.sub_category_name} </option>`
                  );
                else
                  $(".populate_subcategories").append(
                    `<option value=${y.id}> ${y.sub_category_name} </option>`
                  );
              });
            } else {
              $(".populate_subcategories").append(
                `<option value=''> Please add a sub category </option>`
              );
            }
            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching subcategories');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          // $(".addproperty").attr('disabled', false);
        }
      })
    }

    var cachedSubSubCategories = {}; // Object to store sub sub categories keyed by subcategory ID

    function fetch_subsubcategories(id, callback) {
      $('#sub_sub_category_id').html('<option value="">Loading...</option>');
      var route = "{{ url('get/sub-sub-categories') }}/" + id;

      $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
          $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
          if (response.subsubcategories && response.subsubcategories.length) {
            cachedSubSubCategories = response.subsubcategories;

            $.each(response.subsubcategories, function (i, subsub) {
              let selected = ({{$property->sub_category_id ?? 0}} == subsub.id) ? "selected" : "";
              $('#sub_sub_category_id').append(
                '<option value="' + subsub.id + '" ' + selected + '>' + subsub.sub_sub_category_name + '</option>'
              );
            });

          } else {
            $('#sub_sub_category_id').append('<option value="">No property type found</option>');
          }

          if (callback) {
            callback();
          }

        },
        error: function () {
          $('#sub_sub_category_id').html('<option value="">Error loading</option>');
        }
      });
    }


    // 🔹 Auto-load on page load if editing
    $(document).ready(function () {
      let preselectedSubCategory = "{{ $property->sub_category_id }}";
      let preselectedSubSubCategory = "{{ $property->sub_sub_category_id }}";

      if (preselectedSubCategory) {
        fetch_subsubcategories(preselectedSubCategory, preselectedSubSubCategory);
      }

    });



    // This function is called when subsubcategory changes or after loading toggles
    function toggleSubSubCategoryFields(selectedId) {

      var selectedData = cachedSubSubCategories.find(function (subsub) {
        return subsub.id == selectedId;
      });

      if (selectedData.amenities_toggle == 'yes') {
        $('#amenitiesField').show();
      } else {
        $('#amenitiesField').hide();
      }
    }



    function fetch_form_type() {

      var cat = $(".populate_categories option:selected").val();
      var subcat = $(".populate_subcategories option:selected").val();
      var listing_id = $("#id").val();

      if (cat == "") {
        clearFormType(true);
        return true;
      }


      // var route = "{{route('admin.fetch_form_type')}}/?cat="+cat+"&subcat="+subcat+"&edit=0&listing_id="+listing_id;
      var route = "{{config('app.api_url')}}/fetch_form_type/?cat=" + cat + "&subcat=" + subcat + "&edit=0&listing_id=" + listing_id;
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          // $(".updateproperty").attr('disabled', true);
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          // var response = JSON.parse(response);
          $("#formtype_id").val('')
          if (response.responseCode === 200) {
            var responseData = response.data.FormType;
            var listing = response.data.Property;
            var property_subfeatures = [];
            if (responseData.length > 0) {
              clearFormType();
              // form type
              $.each(responseData, function (x, y) {
                // console.log(y)
                // console.log('formtype_id=>',y.formtype_id)
                $("#formtype_id").val(y.formtype_id)


                switch (y.input_type) {
                  case "1":
                    // console.log('sub_feature_enabled =>', b.sub_feature_enabled, 'sub_features =>', sub_features.id)
                    // console.log('sub_f_id =>',y.sub_f_id);
                    $(".add_formtype").append(
                      `
                                <div class='col-sm-4'>
                                <label> 
                                <input type='checkbox' class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value="checked"  name=${y.sub_feature_slug}  />
                                ${y.sub_feature_name} 
                                </label>
                                </div>
                                `
                    );
                    break;

                  case "2":
                    $(".add_formtype").append(
                      `
                                <div class='col-sm-4'>
                                <label> 
                                <input type='text'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}   />
                                ${y.sub_feature_name} 
                                </label>
                                </div>
                                `
                    );
                    break;

                  case "3":
                    $(".add_formtype").append(
                      `
                                <div class='col-sm-4'>
                                <label> 
                                <input type='radio'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value='on' name='radio[]'  />
                                ${y.sub_feature_name} 
                                </label>
                                </div>
                                `
                    );
                    break;

                  case "4":
                    $(".add_formtype").append(
                      `
                                <div class='col-sm-4'>
                                <label> 
                                <textarea class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}></textarea>
                                ${y.sub_feature_name} 
                                </label>
                                </div>
                                `
                    );
                    break;

                  case "5":
                    $(".add_formtype").append(
                      `
                                <div class='col-sm-4'>
                                <label> 
                                ${y.sub_feature_name} 
                                <select>
                                <option value='' class='text-control dynamic_forms' data-sub-feature-id=${y.sub_f_id} name=${y.sub_feature_slug} data-input-type=${y.input_type}>
                                Select
                                </option>
                                </select>
                                </label>
                                </div>
                                `
                    );
                    break;


                }

              }); // end $.each

              $.each(listing, function (c, d) {
                // property_subfeatures.push(y.sub_feature_id);

                console.log(d);
                $(".dynamic_forms").each(function (a, b) {
                  var input_val = Number($(this).attr('data-sub-feature-id'));
                  if (input_val == d.sub_feature_id) {
                    $(this).attr('checked', true);
                    $(this).val(d.feature_value)
                  }
                  // if(property_subfeatures.includes(input_val)) {
                  //  $(this).attr('checked', true);
                  // }
                });

              });



            } else {
              clearFormType(true);
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          $(".updateproperty").attr('disabled', false);
        }
      })
    }

  </script>
@endsection