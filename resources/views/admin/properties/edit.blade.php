@extends('layouts.app')

@section('title')
  Edit Properties
@endsection

@section('content')

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="loading">
              <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </div>

            <div class="card-body">
              <div class="card-block">
                <form class="form-body" id="update_property_form" name="update_property_form"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Property Description &amp; Price</h4>
                  <input type="hidden" name="from" id="from" value="{{ app('request')->input('from') }}">

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_form_type);">
                        @foreach($category as $k => $v)
                          <option value="{{$v->id}}" {{$property->category_id == $v->id ? "selected" : ""}}>
                            {{$v->category_name}}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control populate_subcategories" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value, fetch_form_type);">
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

                    <div class="col-sm-12">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name"
                        value="{{$property->title}}" required />
                    </div>
                
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description"
                        required> {{$property->description}}</textarea>
                    </div>
                  </div>

              <div id="fb-render"></div>
              <div class="row">
                <input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
                <input type="hidden" name="additional_info" id="form_json">
              </div>

                  <div id="amenitiesField" style="display:none;">
                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row">
                      @foreach($amenities as $amenity)
                        <div class="col-sm-3">
                          <img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
                          <p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}" @if(in_array($amenity->id, explode(',', $property->amenities))) checked @endif> {{ $amenity->name }}</p>
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
                      <select class="form-control" name="city" id="city" required="">
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
                      <select class="text-control" name="location_id" id="location_id" required="">
                        @foreach($locations as $location)
                          @if($property->location_id == $location->id)
                            <option value="{{ $location->id }}" selected="">{{ $location->location }}</option>
                          @else
                            <option value="{{ $location->id }}">{{ $location->location }}</option>
                          @endif
                        @endforeach
                        <option value="other">Others</option>
                      </select>

                      <div id="custom-location-container" style="display:none; margin-top:10px;">
                        <input type="text" class="text-control" name="custom_location_input" accept=""
                          id="custom_location_input" placeholder="Enter new location" />
                      </div>

                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location</label>
                      <select class="text-control" name="sub_location_id[]" id="sub_location_id" multiple>
                      </select>
                    </div>
                  </div>

                  	<div class="form-group-f row">
    <div class="form-group col-sm-6">
        <label class="label-control">Landmark</label>
        <input type="text"
               class="text-control"
               name="landmark"
               value="{{ $property->landmark }}"
               placeholder="Enter nearby landmark">
    </div>

    <div class="form-group col-sm-6">
        <label class="label-control">Pin Code</label>
        <input type="text"
               class="text-control"
               name="pincode"
               value="{{ $property->pincode }}"
               maxlength="6"
               pattern="[0-9]{6}"
               placeholder="Enter 6-digit pin code">
    </div>
</div>

                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="{{ $property->address }}" required />
                    </div>
                  </div>

                  <div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">

                 
<h3>Property Photos</h3>

<div class="row g-3">

  {{-- ================= EXISTING IMAGES ================= --}}
  @foreach($property->PropertyGallery as $img)
    <div class="col-sm-2 text-center">

      <div class="position-relative p-2 rounded"
           style="border: {{ $img->is_default ? '2px solid #0d6efd' : '1px solid #ddd' }}">

        @if($img->is_default)
          <span class="badge bg-primary position-absolute"
                style="top:4px;left:4px;">Default</span>
        @endif

        <img src="{{ asset($img->image_path) }}"
             class="img-fluid rounded"
             style="height:100px;object-fit:cover;">

      </div>

      <div class="form-check mt-1">
        <input class="form-check-input existing-default-radio"
               type="radio"
               name="default_image_id"
               value="{{ $img->id }}"
               {{ $img->is_default ? 'checked' : '' }}>
        <label class="form-check-label small">Default</label>
      </div>

      <i class="fa fa-trash text-danger"
         style="cursor:pointer;"
         onclick="deleteGalleryPhoto('{{ $img->id }}')"></i>

    </div>
  @endforeach

</div>

<hr>

{{-- ================= NEW UPLOADS ================= --}}
<div class="row mt-3">
  <div class="col-sm-12">

    <div class="photo-upload-card"
         style="border:2px dashed #ddd;padding:15px;border-radius:6px;">

      <label class="photo-upload-btn" style="cursor:pointer;">
        <input type="file" id="fileInput" multiple accept="image/*" hidden>
        <strong>Click or drag to upload photos</strong>
      </label>

      <div id="previewContainer"
           class="d-flex flex-wrap gap-3 mt-3"></div>

    </div>

  </div>
</div>

{{-- Hidden inputs --}}
<input type="hidden" name="default_image_id" id="default_image_id">
<input type="hidden" name="default_image_index" id="default_image_index">



                  <h3>Property Video</h3>
                  <div class="form-group row">
                    <div class="form-group col-sm-12">
                      @if(!empty($property->property_video))
                        <video width="240" height="240" controls style="margin-bottom: 10px;">
                          <source src="{{ url($property->property_video) }}" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                        <br>
                      @endif
                      <input type="file" name="property_video" accept="video/*" class="form-control">
                    </div>
                  </div>

              </div>
            
              <div class="form-group-f row">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-primary updateproperty" type="submit">Update Property</button>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script type="text/javascript">

let selectedFiles = [];

document.getElementById('fileInput').addEventListener('change', function (e) {
  selectedFiles.push(...Array.from(e.target.files));
  renderPreviews();
  e.target.value = '';
});

function renderPreviews() {
  const container = document.getElementById('previewContainer');
  container.innerHTML = '';

  selectedFiles.forEach((file, index) => {
    const reader = new FileReader();
    reader.onload = e => {
      const div = document.createElement('div');
      div.className = 'position-relative text-center';

      div.innerHTML = `
        <img src="${e.target.result}"
             class="rounded border"
             style="height:100px;width:100px;object-fit:cover;">

        <div class="form-check mt-1">
          <input class="form-check-input new-default-radio"
                 type="radio"
                 name="new_default_image"
                 value="${index}">
          <label class="form-check-label small">Default</label>
        </div>

        <button type="button"
                class="btn btn-sm btn-danger"
                style="position:absolute;top:0;right:0;"
                onclick="removeImage(${index})">&times;</button>
      `;
      container.appendChild(div);
    };
    reader.readAsDataURL(file);
  });
}

function removeImage(index) {
  selectedFiles.splice(index, 1);
  renderPreviews();
}

/* ================= DEFAULT SWITCH LOGIC ================= */
document.addEventListener('change', function (e) {

  // New image selected as default
  if (e.target.classList.contains('new-default-radio')) {
    document.getElementById('default_image_index').value = e.target.value;
    document.getElementById('default_image_id').value = '';

    document.querySelectorAll('.existing-default-radio')
      .forEach(r => r.checked = false);
  }

  // Existing image selected as default
  if (e.target.classList.contains('existing-default-radio')) {
    document.getElementById('default_image_id').value = e.target.value;
    document.getElementById('default_image_index').value = '';

    document.querySelectorAll('.new-default-radio')
      .forEach(r => r.checked = false);
  }

});
    

    @if(!empty($property->latitude) && !empty($property->longitude))
      createMap({{ $property->latitude }}, {{ $property->longitude }});
    @else
      // Construct address string from state, city, location
      let address = '';
      @if(!empty($property->location)) address += '{{ $property->location->location }}'; @endif
      @if(!empty($property->city)) address += ', {{ $property->city->name }}'; @endif
      @if(!empty($property->state)) address += ', {{ $property->state->name }}'; @endif

      if (address) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
          .then(res => res.json())
          .then(data => {
            if (data.length > 0) {
              let lat = data[0].lat;
              let lng = data[0].lon;
              createMap(lat, lng);
            } else {
              // fallback if geocoding fails
              createMap(28.6139, 77.2090); // Delhi
            }
          }).catch(() => {
            createMap(28.6139, 77.2090);
          });
      } else {
        createMap(28.6139, 77.2090); // fallback
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

          // Append the "Others" option at the end
          $('#location_id').append('<option value="other">Others</option>');
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

        // Append all selected images
        selectedFiles.forEach((file, i) => {
          formData.append('gallery_images_file[]', file);
        });

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
            // var response = JSON.parse(response);
            if (response.status == 'success') {
              toastr.success(response.message);
              var from = $('#from').val();
              if (from == 'preview') {
                var id = response.data.listing.id;
                window.location.href = "{{url('master/preview/property')}}/" + id;
              } else {
                location.reload();
              }
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
          }
        })


      }
    });

    //-------------------- Get sub categories By category --------------------//
    function fetch_subcategories(id, callback) {
      // var route = "{{route('admin.sub_category.fetch_subcategories_by_cat_id', ['id' => ':id'])}}";
      var route = "{{ url('get/sub-categories') }}/" + id  // var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".updateproperty").attr('disabled', true);
          $(".location").css('display', 'block');
        },
        success: function (response) {
          // var response = JSON.parse(response);
          if (response.status === 200) {
            $(".populate_subcategories").empty();
            var subcategories = response.subcategories;
            if (subcategories.length > 0) {
              $.each(subcategories, function (x, y) {
                $(".populate_subcategories").append(
                  `<option> Select </option>`
                );
                $(".populate_subcategories").append(
                  `<option value=${y.id}> ${y.sub_category_name} </option>`
                );
              });
            } else {
              $(".populate_subcategories").append(
                `<option value=''> No records found </option>`
              );
            }
            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching sub categories');
        },
        complete: function () {
          $(".location").css('display', 'none');
          $(".updateproperty").attr('disabled', false);
        }
      })
    }


    //-------------------- Get sub sub categories By sub category --------------------//
    var cachedSubSubCategories = {};
    function fetch_subsubcategories(id, callback) {
      $('#sub_sub_category_id').html('<option value="">Loading...</option>');
      var route = "{{ url('get/sub-sub-categories') }}/" + id;

      $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
          $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
          if (response.subsubcategories && response.subsubcategories.length > 0) {
            cachedSubSubCategories = response.subsubcategories || [];

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


    $('#sub_sub_category_id').on('change', function () {
      var selectedId = $(this).val();

      if (!selectedId) {
        // Optionally hide those toggle fields if no sub sub category selected
        toggleSubSubCategoryFields({
          amenities_toggle: false,
        });
        return;
      }

      var selectedData = cachedSubSubCategories.find(function (subsub) {
        return subsub.id == selectedId;
      });



      if (selectedData) {
        toggleSubSubCategoryFields({
          amenities_toggle: selectedData.amenities_toggle
        });
      } else {
        // No matching sub sub category found, hide fields
        toggleSubSubCategoryFields({
          amenities_toggle: false
        });
      }

    });


    // This function is called when subsubcategory changes or after loading toggles
    function toggleSubSubCategoryFields(toggles) {
      if (toggles.amenities_toggle == 'yes') {
        $('#amenitiesField').show();
      } else {
        $('#amenitiesField').hide();
      }

    }


    function fetch_form_type() {
      var cat = $(".populate_categories option:selected").val();
      var subcat = $(".populate_subcategories option:selected").val();
      var subsubcat = $(".populate_subsubcategories option:selected").val();

      var route = "{{ url('category/related-form') }}";
      $.ajax({
        url: route,
        method: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          'category': cat,
          'sub_category': subcat,
          'sub_sub_category': subsubcat,
        },
        beforeSend: function () {
          $(".addproperty").attr('disabled', true);
          $(".add_formtype").empty();
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          if (response != 0) {

            if (
              '{{ $property->category_id }}' == response.category_id ||
              '{{ $property->sub_category_id }}' == response.sub_category_id ||
              '{{ $property->sub_sub_category_id }}' == response.sub_sub_category_id
            ) {
              document.getElementById('fb-render').innerHTML = '';
              var formData = $('#save_json').val();
              var formRenderOptions = { formData };
              frInstance = $('#fb-render').formRender(formRenderOptions);

            } else {
              document.getElementById('fb-render').innerHTML = '';
              var formData = response.form_data;
              var formRenderOptions = { formData };
              frInstance = $('#fb-render').formRender(formRenderOptions);
            }

          } else {
            document.getElementById('fb-render').innerHTML = '';
            // toastr.error('No Any Form Found');
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

    function deleteGalleryPhoto(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Delete This Image.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $(".loading_4").css('display', 'block');
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '{{ url('delete/property/images') }}',
              method: "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                'id': id
              },
              success: function (response) {
                toastr.success(response);
                setTimeout(function () {
                  location.reload();
                }, 2000);
              },
              error: function (response) {
                toastr.error('An error occured.')
              },
              complete: function () {
                $(".loading_4").css('display', 'none');
                $(".btn-delete").attr('disabled', false);
              }
            })
          }
        });
    }

    $('#location_id').on('change', function () {
      // toggle new location input
      if ($(this).val() && $(this).val() === 'other') {
        $('#custom-location-container').show();
      } else {
        $('#custom-location-container').hide();
      }
      // load sub locations for selected location
      var location_id = $('#location_id').val();
      if (!location_id || location_id === 'other') { $('#sub_location_id').empty().trigger('change'); return; }
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
          $('#sub_location_id').empty();
          $.each(result, function (key, location) {
            $("#sub_location_id").append('<option value="' + location.id + '">' + location.sub_location_name + '</option>');
          });
          // reselect existing values from property
          var selectedIds = "{{ $property->sub_location_id ?? '' }}";
          if (selectedIds) {
            var arr = selectedIds.split(',');
            $('#sub_location_id').val(arr).trigger('change');
          }
        }
      });
    });
    // Initialize Sub Location select2 with tagging
    function initEditSubLocationSelect2() {
      $('#sub_location_id').select2({
        tags: true,
        width: '100%',
        placeholder: 'Select or add sub locations',
        closeOnSelect: false,
        createTag: function (params) {
          var term = $.trim(params.term);
          if (term === '') { return null; }
          return { id: term, text: term, isNew: true };
        }
      });
    }
    initEditSubLocationSelect2();

    // On load: trigger city->locations and preload sublocations
    $(document).ready(function () {
      var locId = $('#location_id').val();
      if (locId) { $('#location_id').trigger('change'); }
    });

  </script>
@endsection