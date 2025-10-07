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
                  <h4 class="form-section-h">Preview Property Details</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-8">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name"
                        value="{{$property->title}}" required readonly="" />
                    </div>

                    <div class="col-sm-4">
                      <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                      <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price"
                        value="{{$property->price}}" required readonly="" />
                    </div>

                  </div>

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

                  </div>

                  <div class="form-row">

                    {{-- Price Label --}}
                    @php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="priceLabelField" class="form-group {{ $col }}">
                      <label class="label-control d-flex">Price Label</label>
                      @if($price_labels->first()->input_format == 'checkbox')
                        @foreach($price_labels as $label)
                          <label>
                            <input type="checkbox" value="{{ $label->id }}" disabled {{ in_array($label->id, explode(',', $property->price_label ?? '')) ? 'checked' : '' }}>
                            {{ $label->name }}
                          </label>
                        @endforeach
                      @else
                        <input type="text" class="form-control" readonly
                          value="{{ optional($price_labels->firstWhere('id', $property->price_label))->name }}">
                      @endif

                      @if(!empty($property->price_label_second))
                        <div class="mt-2">
                          <label>
                            {{ optional($price_labels->firstWhere('id', $property->price_label))->second_input_label ?? 'Date' }}
                          </label>
                          <input type="date" class="form-control" readonly value="{{ $property->price_label_second }}">
                        </div>
                      @endif
                    </div>

                    {{-- Property Status --}}
                    @php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="propertyStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Property Status</label>
                      @if($property_statuses->first()->input_format == 'checkbox')
                        @foreach($property_statuses as $status)
                          <label>
                            <input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->property_status ?? '')) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <input type="text" class="form-control" readonly
                          value="{{ optional($property_statuses->firstWhere('id', $property->property_status))->name }}">
                      @endif

                      @if(!empty($property->property_status_second))
                        <div class="mt-2">
                          <label>
                            {{ optional($property_statuses->firstWhere('id', $property->property_status))->second_input_label ?? 'Date' }}
                          </label>
                          <input type="date" class="form-control" readonly value="{{ $property->property_status_second }}">
                        </div>
                      @endif
                    </div>

                    {{-- Registration Status --}}
                    @php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="registrationStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Registration Status</label>
                      @if($registration_statuses->first()->input_format == 'checkbox')
                        @foreach($registration_statuses as $status)
                          <label>
                            <input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->registration_status ?? '')) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <input type="text" class="form-control" readonly
                          value="{{ optional($registration_statuses->firstWhere('id', $property->registration_status))->name }}">
                      @endif

                      @if(!empty($property->registration_status_second))
                        <div class="mt-2">
                          <label>
                            {{ optional($registration_statuses->firstWhere('id', $property->registration_status))->second_input_label ?? 'Date' }}
                          </label>
                          <input type="date" class="form-control" readonly
                            value="{{ $property->registration_status_second }}">
                        </div>
                      @endif
                    </div>

                    {{-- Furnishing Status --}}
                    @php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
                    <div id="furnishingStatusField" class="form-group {{ $col }}">
                      <label class="label-control">Furnishing Status</label>
                      @if($furnishing_statuses->first()->input_format == 'checkbox')
                        @foreach($furnishing_statuses as $status)
                          <label>
                            <input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->furnishing_status ?? '')) ? 'checked' : '' }}>
                            {{ $status->name }}
                          </label>
                        @endforeach
                      @else
                        <input type="text" class="form-control" readonly
                          value="{{ optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->name }}">
                      @endif

                      @if(!empty($property->furnishing_status_second))
                        <div class="mt-2">
                          <label>
                            {{ optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->second_input_label ?? 'Date' }}
                          </label>
                          <input type="date" class="form-control" readonly
                            value="{{ $property->furnishing_status_second }}">
                        </div>
                      @endif
                    </div>

                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description" required
                        readonly=""> {{$property->description}}</textarea>
                    </div>
                  </div>

                  <div id="amenitiesField">
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
                      <select class="text-control" name="location_id[]" id="location_id" multiple="" required=""
                        disabled="">
                        @foreach($locations as $location)
                          @if(in_array($location->id, explode(',', $property->location_id)))
                            <option value="{{ $location->id }}" selected="">{{ $location->location }}</option>
                          @else
                            <option value="{{ $location->id }}">{{ $location->location }}</option>
                          @endif
                        @endforeach
                      </select>

                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location </label>
                      <input type="text" class="text-control" name="sub_location_name" id="sub_location_name"
                        value="{{ $property->sub_location_name }}" disabled />
                    </div>

                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="{{ $property->address }}" required readonly="" />
                    </div>
                  </div>

                  <div class="row">
                    <h4 style="border-bottom-style: ridge;">Property Images</h4>
                  </div>
                  <div class="row">
                    @if(count($property->PropertyGallery) > 0)
                      @foreach($property->PropertyGallery as $value)
                        <div class="col-sm-3">
                          <a href="{{ asset('') }}/{{ $value->image_path }}" target="_blank"><img
                              src="{{ asset('') }}/{{ $value->image_path }}" alt="Property Images" style="height: 200px;"></a>
                        </div>
                      @endforeach
                    @else
                      <h5 style="color: brown;">No Any Images Found.</h5>
                    @endif
                  </div>
                  <div class="row">
                    <h4 style="border-bottom-style: ridge;">Property Additional Information</h4>
                  </div>
                  <div id="fb-render"></div>
                  <div class="row">
                    <input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
                  </div>

                  <div class="form-group-f row">
                    <?php /*
                      @foreach($form_type as $f=>$v)
                        @foreach($v->formtypesfields as $a=>$b)
                          @foreach($b->subfeatures as $s=>$f)
                            <div class="col-sm-4">
                              <label class="label-control">{{$f->sub_feature_name}}</label>
                              <div class="input-group">
                                @php
                                  $db_values = [];
                                @endphp

                                  @foreach($property->propertyfeatures as $a=>$b)
                                    @php
                                      array_push($db_values, $b->feature_value)
                                    @endphp
                                  @endforeach

                                @if($f->features->input_type === "1")
                                  @if(in_array($f->id, $db_values))
                                    <input class="text-control-s dynamic_forms" type="checkbox" name="feature[]" placeholder="{{$f->sub_feature_name}}" data-sub-feature-id="{{$f->id}}" value="{{$f->id}}" checked />
                                  @else 
                                    <input class="text-control-s dynamic_forms" type="checkbox" name="feature[]" placeholder="{{$f->sub_feature_name}}" data-sub-feature-id="{{$f->id}}" value="{{$f->id}}" />
                                  @endif

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
                                <br/>
                              </div>

                            </div>
                          @endforeach
                        @endforeach
                      @endforeach
                      */ ?>
                  </div>

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
    $(function () {

      fetch_subcategories('{{$property->category_id}}', function () {
        $(".populate_subcategories").val('{{$property->sub_category_id}}');
        fetch_subsubcategories('{{$property->sub_category_id}}', function () {
          $(".populate_subsubcategories").val('{{$property->sub_sub_category_id}}');
          fetch_form_type();
        });
      });
      fetch_sublocations('{{$property->location_id}}', function () {
        $(".populate_sublocations").val('{{$property->sub_location_id}}');
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



    $("#update_property_form").validate({
      submitHandler: function (form) {
        var data = $('#fb-render').formRender('userData');
        if (!data) {
          toastr.error('Additional details form must be required, please select another category or contact to admin.');
          return false;
        } else {
          document.getElementById('form_json').value = JSON.stringify(data);
        }
        var formData = new FormData(form);
        var obj = {};
        // // console.log(formData.formtype_id);
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
        //      if($(this).is(':checked')) {
        //        obj[objKey] = objVal;       
        //      }
        //    }
        //  } else if(input_type == "5" ) {
        //    if(objVal != "") {
        //      obj[objKey] = objVal;       
        //    }
        //  } else {
        //    obj[objKey] = objVal;       
        //  }
        // });
        // formData.append('listing_features', JSON.stringify(obj));

        // console.log(obj);
        // if(jQuery.isEmptyObject(obj)) {
        //  toastr.error('Atleast 1 feature must be selected.');
        //  return true;
        // }
        $.ajax({
          url: "{{route('admin.properties.update_property')}}",
          method: "POST",
          data: formData,
          datatype: 'json',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $(".updateproperty").attr('disabled', true);
          },
          success: function (response) {
            var response = JSON.parse(response);
            if (response.status === 200) {
              toastr.success(response.message)
              // $("#create_property_form").trigger('reset');
              //           setTimeout(function() {
              // window.location.href = "{{route('admin.properties.index')}}";
              //           }, 1000);
            } else if (response.status === 400) {
              toastr.error(response.message)
            } else {
              toastr.error('An error occured')
            }
          },
          error: function (response) {
            toastr.error('An error occured')
          },
          complete: function () {
            $(".updateproperty").attr('disabled', false);
            console.log(typeof (formData));
            console.log('formData=>', formData)
          }
        })


      }
    });

    // $("#update_property_form").validate({
    //  submitHandler:function(form) {
    //    var formData = new FormData(form);
    //    $.ajax({
    //      url: "{{route('admin.properties.update_property')}}",
    //      method: "POST",
    //      data: formData,
    //          cache: false,
    //          contentType: false,
    //          processData: false,
    //      beforeSend:function() {
    //        $(".updateproperty").attr('disabled', true);
    //      },
    //      success: function(response) {
    //        var response = JSON.parse(response);
    //        if(response.status === 200) {
    //          toastr.success(response.message)
    //          // window.location.href = "{{route('admin.properties.index')}}";
    //        } else if (response.status === 400) {
    //          toastr.error(response.message)
    //        }
    //      },
    //      error: function(response) {
    //        toastr.error('An error occured')
    //      },
    //      complete: function() {
    //        $(".updateproperty").attr('disabled', false);
    //      }
    //    })
    //  }
    // });


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
								if ('{{ $property->sub_category_id }}' == y.id)
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
              let selected = ({{$property->sub_category_id}} == subsub.id) ? "selected" : "";
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


    $('#sub_sub_category_id').html('<option value="">Loading...</option>');
    var route = "{{ url('get/sub-sub-categories') }}/" + subcategoryId;

    $.ajax({
      url: route,
      method: 'GET',
      success: function (response) {
        $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
        if (response.subsubcategories && response.subsubcategories.length) {
          cachedSubSubCategories = response.subsubcategories || [];
          $.each(response.subsubcategories, function (i, subsub) {
            let selected = (selectedId == subsub.id) ? "selected" : "";
            $('#sub_sub_category_id').append(
              '<option value="' + subsub.id + '" ' + selected + '>' + subsub.sub_sub_category_name + '</option>'
            );
          });
          toggleSubSubCategoryFields(selectedId)
        } else {
          $('#sub_sub_category_id').append('<option value="">No property type found</option>');
        }
      },
      error: function () {
        $('#sub_sub_category_id').html('<option value="">Error loading</option>');
      }
    });
      
    // This function is called when subsubcategory changes or after loading toggles
    function toggleSubSubCategoryFields(selectedId) {

      var selectedData = cachedSubSubCategories.find(function (subsub) {
        return subsub.id == selectedId;
      });

      if (selectedData.price_label_toggle == 'yes') {
        $('#priceLabelField').show();
      } else {
        $('#priceLabelField').hide();
      }

      if (selectedData.property_status_toggle == 'yes') {
        $('#propertyStatusField').show();
      } else {
        $('#propertyStatusField').hide();
      }

      if (selectedData.registration_status_toggle == 'yes') {
        $('#registrationStatusField').show();
      } else {
        $('#registrationStatusField').hide();
      }

      if (selectedData.furnishing_status_toggle == 'yes') {
        $('#furnishingStatusField').show();
      } else {
        $('#furnishingStatusField').hide();
      }

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

      if (subcat == "") {
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

    function fetch_sublocations(id, callback) {
      var route = "{{route('admin.fetch_sublocations', ['id' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".updateproperty").attr('disabled', true);
          $(".location").css('display', 'block');
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
              });

            } else {
              $(".populate_sublocations").append(
                `<option value=''> Please add a sub location </option>`
              );
            }

            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching sub locations');
        },
        complete: function () {
          $(".location").css('display', 'none');
          $(".updateproperty").attr('disabled', false);
        }
      })
    }

  </script>
@endsection