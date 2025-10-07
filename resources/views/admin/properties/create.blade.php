@extends('layouts.app')

@section('title')
  Create Properties
@endsection


@section('content')

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="loading">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <form class="form-body" id="create_property_form" name="create_property_form"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Property Description &amp; Price</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-8">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name" required />
                    </div>
                    <!-- <div class="col-sm-4">
                              <label class="label-control">Type </label>
                              <select class="text-control" name="type_id" required />
                              <option value="">Select Type</option>
                              <option value="1">Commercial</option>
                              <option value="2">Agricultural</option>
                              <option value="3">Industrial</option>
                              <option value="4">Free Hold</option>
                            </select>
                          </div> -->
                    <div class="col-sm-4">
                      <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                      <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price" required />
                    </div>
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_subsubcategories)">
                        @if(count($category) < 1)
                          <option value="">No records found</option>
                        @else
                          @foreach($category as $k => $v)
                            <option value="{{$v->id}}">{{$v->category_name}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control populate_subcategories" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value, fetch_form_type)" required>
                        <option value="">Select Category</option>
                      </select>
                    </div>

                    <div class="col-sm-4">
                      <label class="label-control">Property Type</label>
                      <select class="text-control populate_subsubcategories" name="sub_sub_category_id"
                        id="sub_sub_category_id" onchange="fetch_form_type();">
                        <option value="">Select Property Type</option>
                      </select>
                    </div>

                    <!-- <div class="col-sm-3">
                            <label class="label-control">Status</label>
                            <select class="text-control" name="construction_age" >
                              <option value="0">Ready to Move</option>
                              <option value="1">Under Construction</option>
                            </select>
                          </div> -->
                  </div>


                  <div class="form-row">

                    {{-- Price Label --}}
                    @php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="priceLabelField" class="form-group {{ $col }}">
                      <label class="label-control d-flex">Price Label</label>

                      @if($price_labels->first()->input_format == 'checkbox')
                        @foreach($price_labels as $label)
                          <label>
                            <input type="checkbox" class="price_checkbox" value="{{ $label->id }}"
                              data-second-input="{{ $label->second_input }}"
                              data-second-label="{{ $label->second_input_label }}" name="price_label[]" {{ in_array($label->id, old('price_label', [])) ? 'checked' : '' }}>
                            {{ $label->name }}
                          </label>
                        @endforeach
                      @else
                        <select class="form-control" name="price_label" id="price_label">
                          @foreach($price_labels as $label)
                            <option value="{{ $label->id }}" data-second-input="{{ $label->second_input }}"
                              data-second-label="{{ $label->second_input_label }}" {{ old('price_label') == $label->id ? 'selected' : '' }}>
                              {{ $label->name }}
                            </option>
                          @endforeach
                        </select>
                      @endif

                      {{-- Second Input (Date) --}}
                      <div class="mt-2" id="price_label_second_container" style="display:none;">
                        <label id="price_label_second_label"></label>
                        <input type="date" name="price_label_second" class="form-control"
                          value="{{ old('price_label_second') }}">
                      </div>
                    </div>

                    {{-- Property Status --}}
                    @php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="propertyStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Property Status</label>

                      @if($property_statuses->first()->input_format == 'checkbox')
                        @foreach($property_statuses as $status)
                          <label>
                            <input type="checkbox" class="property_checkbox" value="{{ $status->id }}"
                              data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" name="property_status[]" {{ in_array($status->id, old('property_status', [])) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <select class="form-control" name="property_status" id="property_status">
                          @foreach($property_statuses as $status)
                            <option value="{{ $status->id }}" data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" {{ old('property_status') == $status->id ? 'selected' : '' }}>
                              {{ $status->name }}
                            </option>
                          @endforeach
                        </select>
                      @endif

                      <div class="mt-2" id="property_status_second_container" style="display:none;">
                        <label id="property_status_second_label"></label>
                        <input type="date" name="property_status_second" class="form-control"
                          value="{{ old('property_status_second') }}">
                      </div>
                    </div>

                    {{-- Registration Status --}}
                    @php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="registrationStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Registration Status</label>

                      @if($registration_statuses->first()->input_format == 'checkbox')
                        @foreach($registration_statuses as $status)
                          <label>
                            <input type="checkbox" class="registration_checkbox" value="{{ $status->id }}"
                              data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" name="registration_status[]" {{ in_array($status->id, old('registration_status', [])) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <select class="form-control" name="registration_status" id="registration_status">
                          @foreach($registration_statuses as $status)
                            <option value="{{ $status->id }}" data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" {{ old('registration_status') == $status->id ? 'selected' : '' }}>
                              {{ $status->name }}
                            </option>
                          @endforeach
                        </select>
                      @endif

                      <div class="mt-2" id="registration_status_second_container" style="display:none;">
                        <label id="registration_status_second_label"></label>
                        <input type="date" name="registration_status_second" class="form-control"
                          value="{{ old('registration_status_second') }}">
                      </div>
                    </div>

                    {{-- Furnishing Status --}}
                    @php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="furnishingStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Furnishing Status</label>

                      @if($furnishing_statuses->first()->input_format == 'checkbox')
                        @foreach($furnishing_statuses as $status)
                          <label>
                            <input type="checkbox" class="furnishing_checkbox" value="{{ $status->id }}"
                              data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" name="furnishing_status[]" {{ in_array($status->id, old('furnishing_status', [])) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <select class="form-control" name="furnishing_status" id="furnishing_status">
                          @foreach($furnishing_statuses as $status)
                            <option value="{{ $status->id }}" data-second-input="{{ $status->second_input }}"
                              data-second-label="{{ $status->second_input_label }}" {{ old('furnishing_status') == $status->id ? 'selected' : '' }}>
                              {{ $status->name }}
                            </option>
                          @endforeach
                        </select>
                      @endif

                      <div class="mt-2" id="furnishing_status_second_container" style="display:none;">
                        <label id="furnishing_status_second_label"></label>
                        <input type="date" name="furnishing_status_second" class="form-control"
                          value="{{ old('furnishing_status_second') }}">
                      </div>
                    </div>

                  </div>



                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description"></textarea>
                    </div>
                  </div>

                  <div id="amenitiesField">

                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row">
                      @foreach($amenities as $amenity)
                        <div class="col-sm-3">
                          <img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
                          <p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}"> {{ $amenity->name }}</p>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Location</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">State </label>
                      <select class="form-control" name="state" id="state" required="">
                        <option value="">Select State </option>
                        @foreach($states as $state)
                          <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">City </label>
                      <select class="form-control" name="city" id="city" required="">

                      </select>
                    </div>
                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">Location </label>
                      <select class="text-control" name="location_id[]" id="location_id" multiple="" required="">

                      </select>

                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location </label>
                      <input type="text" class="text-control" name="sub_location_name" id="sub_location_name"
                        placeholder="Enter Sub Location" />
                    </div>

                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="{{ old('address') }}" required />
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Images</h4>

                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">Featured Image </label>
                      <input type="file" class="text-control" name="feature_image_file" required />
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Gallery Images (Multiple) </label>
                      <input type="file" class="text-control" name="gallery_images_file[]" multiple />
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Additional Information</h4>
                  <div id="fb-render"></div>
                  <input type="hidden" name="additional_info" id="form_json">
                  <div class="form-group-f row add_formtype">
                    <?php /*
                       @foreach($form_type as $f=>$v)
                         @foreach($v->formtypesfields as $a=>$b)
                           @foreach($b->subfeatures as $s=>$f)
                             <div class="col-sm-4">

                               <div class="input-group1">
                                 @if($f->features->input_type === "1")
                                   <label class="label-control">{{$f->sub_feature_name}}<input class="text-control-s dynamic_forms" type="checkbox" name="feature[]" placeholder="{{$f->sub_feature_name}}" data-sub-feature-id="{{$f->id}}" value="{{$f->id}}" /> </label>
                                 @elseif ($f->features->input_type === "2")
                                   <input class="text-control-s dynamic_forms" type="number" name="feature[]" placeholder="{{$f->sub_feature_name}}" data-sub-feature-id="{{$f->id}}" />
                                 @elseif ($f->features->input_type === "3")
                                   <input class="text-control-s dynamic_forms" type="radio" name="feature[]" placeholder="{{$f->sub_feature_name}}"data-sub-feature-id="{{$f->id}}" />
                                 @elseif ($f->features->input_type === "4")
                                   <textarea class="text-control" name="feature[]" data-sub-feature-id="{{$f->id}}" />
                                   </textarea>
                                 @elseif ($f->features->input_type === "5")
      <!--                              <select class="text-control">
                                   </select> -->
                                 @endif
                               </div>

                             </div>
                           @endforeach
                         @endforeach
                       @endforeach
                       */
                            ?>
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-primary addproperty" type="submit" disabled>Add Property</button>
                    </div>
                  </div>

                  <input type="hidden" id="formtype_id" name="formtype_id" />

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

    $(function () {
      $(".populate_categories,  .populate_locations").change();

      $(".add_formtype").empty().append(
        `<center class='m0-auto'> Please select sub category </center>`
      );

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

    $('#location_id').on('change', function () {
      var location_id = $('#location_id').val();
      $("#sub_location_id").html('');
      $.ajax({
        url: "{{route('front.getSubLocations')}}",
        type: "POST",
        data: {
          location_id: location_id,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function (result) {
          $('#sub_location_id').html('<option value="">Select Location</option>');
          $.each(result, function (key, location) {
            $("#sub_location_id").append('<option value="' + location.id + '" >' + location.sub_location_name + '</option>');
          });
        }
      });
    });

    function returnIfInvalid() {
      alert('Atleast one feature should be checked!');
      return true;
    }

    $("#create_property_form").submit(function (e) {
      var data = $('#fb-render').formRender('userData');
      if (!data) {
        toastr.error('Additional details form must be required, please select another category or contact to admin.');
        return false;
      } else {
        document.getElementById('form_json').value = JSON.stringify(data);
      }
      var formData = new FormData(this);
      // var obj = {};
      // $(".dynamic_forms").each(function(x,y) {
      //  // console.log(y);
      //  var input_type = $(this).attr('data-input-type');
      //  let objKey = $(this).attr('data-sub-feature-id').replace(/\ /g,'');
      //  let objVal = $(this).val();
      //  if(input_type == "1" ) {
      //    if($(this).is(':checked')) {
      //      obj[objKey] = objVal;       
      //    }
      //  } else if(input_type == "3" ) {
      //    if(objVal != "") {
      //      obj[objKey] = objVal;       
      //    }
      //  } else if(input_type == "5" ) {
      //    if(objVal != "") {
      //      console.log(objVal)
      //      obj[objKey] = objVal;       
      //    }
      //  } else {
      //    obj[objKey] = objVal;       
      //  }
      // });
      // formData.append('listing_features', JSON.stringify(obj));

      // if(jQuery.isEmptyObject(obj)) returnIfInvalid();

      e.preventDefault();
      $(this).validate({
        submitHandler: function (form) {
          $.ajax({
            // url: "{{route('admin.properties.store')}}",
            url: "{{config('app.api_url')}}/property",
            method: "POST",
            data: formData,
            datatype: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function (request) {
              $(".addproperty").attr('disabled', true);
              request.setRequestHeader('auth-token', "{{Auth::user()->auth_token}}");
            },
            success: function (response) {
              // var response = JSON.parse(response);
              if (response.responseCode === 200) {
                toastr.success(response.message)
                $("#create_property_form").trigger('reset');
                console.log(response);
                var id = response.data.listing.id;
                setTimeout(function () {
                  window.location.href = "{{url('master/preview/property')}}/" + id;
                }, 1000);
              } else if (response.responseCode === 400) {
                toastr.error(response.message)
              } else {
                toastr.error('An error occured')
              }
            },
            error: function (response) {
              response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
            },
            complete: function () {
              // $(".addproperty").attr('disabled', false);
            }
          })
        }
      });
    })


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
              $(".populate_subcategories").append(
                `<option> Select </option>`
              );
              $.each(subcategories, function (x, y) {
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

    var cachedSubSubCategories = {};
    function fetch_subsubcategories(id, callback) {
      $('#sub_sub_category_id').html('<option value="">Loading...</option>');
      var route = "{{ url('get/sub-sub-categories') }}/" + id
      $.ajax({
        url: route, // Change this to your route
        method: 'GET',
        success: function (response) {
          $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');

          if (response.subsubcategories && response.subsubcategories.length) {
            cachedSubSubCategories = response.subsubcategories || [];

            $.each(response.subsubcategories, function (i, subsub) {
              $('#sub_sub_category_id').append('<option value="' + subsub.id + '">' + subsub.sub_sub_category_name + '</option>');
            });
          } else {
            $('#sub_sub_category_id').append('<option value="">No property type found</option>');
          }
        },
        error: function () {
          $('#sub_sub_category_id').html('<option value="">Error loading</option>');
        }
      });
    }


    $('#sub_sub_category_id').on('change', function () {
      var selectedId = $(this).val();

      if (!selectedId) {
        // Optionally hide those toggle fields if no sub sub category selected
        toggleSubSubCategoryFields({
          price_label_toggle: false,
          property_status_toggle: false,
          registration_status_toggle: false,
          furnishing_status_toggle: false,
          amenities_toggle: false,
        });
        return;
      }

      var selectedData = cachedSubSubCategories.find(function (subsub) {
        return subsub.id == selectedId;
      });



      if (selectedData) {
        toggleSubSubCategoryFields({
          price_label_toggle: selectedData.price_label_toggle,
          property_status_toggle: selectedData.property_status_toggle,
          registration_status_toggle: selectedData.registration_status_toggle,
          furnishing_status_toggle: selectedData.furnishing_status_toggle,
          amenities_toggle: selectedData.amenities_toggle
        });
      } else {
        // No matching sub sub category found, hide fields
        toggleSubSubCategoryFields({
          price_label_toggle: false,
          property_status_toggle: false,
          registration_status_toggle: false,
          furnishing_status_toggle: false,
          amenities_toggle: false
        });
      }


    });


    // This function is called when subsubcategory changes or after loading toggles
    function toggleSubSubCategoryFields(toggles) {

      if (toggles.price_label_toggle == 'yes') {
        $('#priceLabelField').show();
      } else {
        $('#priceLabelField').hide();
      }

      if (toggles.property_status_toggle == 'yes') {
        $('#propertyStatusField').show();
      } else {
        $('#propertyStatusField').hide();
      }

      if (toggles.registration_status_toggle == 'yes') {
        $('#registrationStatusField').show();
      } else {
        $('#registrationStatusField').hide();
      }

      if (toggles.furnishing_status_toggle == 'yes') {
        $('#furnishingStatusField').show();
      } else {
        $('#furnishingStatusField').hide();
      }

      if (toggles.amenities_toggle == 'yes') {
        $('#amenitiesField').show();
      } else {
        $('#amenitiesField').hide();
      }

    }


    function fetch_form_type() {

      var cat = $(".populate_categories option:selected").val();
      var subcat = $(".populate_subcategories option:selected").val();
      var route = "{{ url('category/related-form') }}";
      $.ajax({
        url: route,
        method: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          'category': cat,
          'sub_category': subcat
        },
        beforeSend: function () {
          $(".addproperty").attr('disabled', true);
          $(".add_formtype").empty();
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          if (response != 0) {
            document.getElementById('fb-render').innerHTML = '';
            console.log(response);
            var formData = response.form_data;
            var formRenderOptions = { formData };
            frInstance = $('#fb-render').formRender(formRenderOptions);
          } else {
            document.getElementById('fb-render').innerHTML = '';
            toastr.error('No Any Form Found');
          }
        },
        error: function (response) {
          toastr.error('An error occured');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          $(".addproperty").attr('disabled', false);
        }
      })
    }


    function fetch_sublocations(id) {
      var route = "{{route('admin.fetch_sublocations', ['id' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          // $(".addproperty").attr('disabled', true);
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            $(".populate_sublocations").empty();
            var sublocations = response.data.SubLocation;
            if (!jQuery.isEmptyObject(sublocations)) {
              $.each(sublocations, function (x, y) {
                $(".populate_sublocations").append(
                  `<option value=${y.id}> ${y.sub_location_name} </option>`
                );
              })
            } else {
              $(".populate_sublocations").append(
                `<option value=''> Please add a sub location </option>`
              );
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching sub locations');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          // $(".addproperty").attr('disabled', false);
        }
      })
    }

    function handleSecondInput(selectId, containerId, checkboxClass) {
      const select = document.getElementById(selectId);
      const container = document.getElementById(containerId);
      const label = container.querySelector('label');

      if (select) {
        function toggle() {
          const option = select.selectedOptions[0];
          const show = option.dataset.secondInput === 'yes';
          label.textContent = option.dataset.secondLabel || '';
          container.style.display = show ? 'block' : 'none';
        }
        select.addEventListener('change', toggle);
        toggle(); // initialize
      }

      if (checkboxClass) {
        const checkboxes = document.querySelectorAll(checkboxClass);
        function toggleCheckbox() {
          let show = false;
          let lbl = '';
          checkboxes.forEach(cb => {
            if (cb.checked && cb.dataset.secondInput === 'yes') {
              show = true;
              lbl = cb.dataset.secondLabel;
            }
          });
          label.textContent = lbl;
          container.style.display = show ? 'block' : 'none';
        }
        checkboxes.forEach(cb => cb.addEventListener('change', toggleCheckbox));
        toggleCheckbox(); // initialize
      }
    }

    // Price Label
    handleSecondInput('price_label', 'price_label_second_container', '.price_checkbox');
    // Property Status
    handleSecondInput('property_status', 'property_status_second_container', '.property_checkbox');
    // Registration Status
    handleSecondInput('registration_status', 'registration_status_second_container', '.registration_checkbox');
    // Furnishing Status
    handleSecondInput('furnishing_status', 'furnishing_status_second_container', '.furnishing_checkbox');

  </script>
@endsection