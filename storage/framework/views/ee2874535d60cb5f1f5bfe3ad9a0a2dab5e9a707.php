<?php $__env->startSection('title'); ?>
  Create Properties
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="loading">
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <form class="form-body" id="create_property_form" name="create_property_form"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Property Description &amp; Price</h4>

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_subsubcategories)">
                        <?php if(count($category) < 1): ?>
                          <option value="">No records found</option>
                        <?php else: ?>
                          <option value="">-- Select --</option>
                          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control populate_subcategories" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value, fetch_form_type)">
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
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-8">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name" required />
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                      <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price" required />
                    </div>
                  </div>

                  <div class="form-row">

                    
                    <?php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="priceLabelField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control d-flex">Price Label</label>

                      <?php if($price_labels->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" class="price_checkbox" value="<?php echo e($label->id); ?>"
                              data-second-input="<?php echo e($label->second_input); ?>"
                              data-second-label="<?php echo e($label->second_input_label); ?>" name="price_label[]" <?php echo e(in_array($label->id, old('price_label', [])) ? 'checked' : ''); ?>>
                            <?php echo e($label->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select class="form-control" name="price_label" id="price_label">
                          <option value="" selected> -- Select-- </option>
                          <?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($label->id); ?>" data-second-input="<?php echo e($label->second_input); ?>"
                              data-second-label="<?php echo e($label->second_input_label); ?>" <?php echo e(old('price_label') == $label->id ? 'selected' : ''); ?>>
                              <?php echo e($label->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      
                      <div class="mt-2" id="price_label_second_container" style="display:none;">
                        <label id="price_label_second_label" class="label-control"></label>
                        <input type="date" name="price_label_second" class="form-control"
                          value="<?php echo e(old('price_label_second')); ?>">
                      </div>
                    </div>

                    
                    <?php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="propertyStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Property Status</label>

                      <?php if($property_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" class="property_checkbox" value="<?php echo e($status->id); ?>"
                              data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" name="property_status[]" <?php echo e(in_array($status->id, old('property_status', [])) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select class="form-control" name="property_status" id="property_status">
                          <option value="" selected> -- Select-- </option>
                          <?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('property_status') == $status->id ? 'selected' : ''); ?>>
                              <?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <div class="mt-2" id="property_status_second_container" style="display:none;">
                        <label id="property_status_second_label" class="label-control"></label>
                        <input type="date" name="property_status_second" class="form-control"
                          value="<?php echo e(old('property_status_second')); ?>">
                      </div>
                    </div>

                    
                    <?php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="registrationStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Registration Status</label>

                      <?php if($registration_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" class="registration_checkbox" value="<?php echo e($status->id); ?>"
                              data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" name="registration_status[]" <?php echo e(in_array($status->id, old('registration_status', [])) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select class="form-control" name="registration_status" id="registration_status">
                          <option value="" selected> -- Select-- </option>
                          <?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('registration_status') == $status->id ? 'selected' : ''); ?>>
                              <?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <div class="mt-2" id="registration_status_second_container" style="display:none;">
                        <label id="registration_status_second_label" class="label-control"></label>
                        <input type="date" name="registration_status_second" class="form-control"
                          value="<?php echo e(old('registration_status_second')); ?>">
                      </div>
                    </div>

                    
                    <?php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="furnishingStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Furnishing Status</label>

                      <?php if($furnishing_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" class="furnishing_checkbox" value="<?php echo e($status->id); ?>"
                              data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" name="furnishing_status[]" <?php echo e(in_array($status->id, old('furnishing_status', [])) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select class="form-control" name="furnishing_status" id="furnishing_status">
                          <option value="" selected> -- Select-- </option>
                          <?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" data-second-input="<?php echo e($status->second_input); ?>"
                              data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('furnishing_status') == $status->id ? 'selected' : ''); ?>>
                              <?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <div class="mt-2" id="furnishing_status_second_container" style="display:none;">
                        <label id="furnishing_status_second_label" class="label-control"></label>
                        <input type="date" name="furnishing_status_second" class="form-control"
                          value="<?php echo e(old('furnishing_status_second')); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description" required></textarea>
                    </div>
                  </div>

                  <div id="amenitiesField" style="display: none;">
                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row" id="amenitiesContainer">
                      <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3 amenity-item <?php echo e($index >= 8 ? 'd-none extra-amenity' : ''); ?>">
                          <img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
                          <p>
                            <input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>"> <?php echo e($amenity->name); ?>

                          </p>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if(count($amenities) > 8): ?>
                      <div class="text-center mt-2">
                        <button type="button" class="btn btn-sm btn-outline-primary" id="toggleAmenities">Show More</button>
                      </div>
                    <?php endif; ?>
                  </div>

                  <h4 class="form-section-h">Property Location</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">State </label>
                      <select class="form-control" name="state" id="state" required="">
                        <option value="">Select State </option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <select class="text-control" name="location_id" id="location_id" required>
                        <!-- dynamic options loaded here -->
                      </select>

                      <div id="custom-location-container" style="display:none; margin-top:10px;">
                        <input type="text" class="text-control" name="custom_location_input" accept=""
                          id="custom_location_input" placeholder="Enter new location" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location </label>
                      <select class="text-control" name="sub_location_id[]" id="sub_location_id" multiple required>
                        <!-- dynamic options loaded here -->
                      </select>
                    </div>

                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="<?php echo e(old('address')); ?>" required />
                    </div>
                  </div>

                  <div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">


                  <h3>Property Photos</h3>
                  <div class="row">
                    <div class="form-group col-sm-12 ">
                      <div class="dropzone">
                        <input type="file" id="fileInput" multiple accept="image/*">
                        <div id="previewContainer" class="mt-2 d-flex flex-wrap gap-2"></div>
                      </div>
                    </div>
                  </div>

                  <h3>Property Video</h3>
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label class="label-control">Upload Video</label>
                      <input type="file" class="form-control" name="property_video" accept="video/*">
                      <small class="text-muted">You can upload one property video (optional).</small>
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Additional Information</h4>
                  <div id="fb-render"></div>
                  <input type="hidden" name="additional_info" id="form_json">
                  <div class="form-group-f row add_formtype">
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-primary addproperty" type="submit" disabled>Add Property</button>
                    </div>
                  </div>

                  <input type="hidden" id="formtype_id" name="formtype_id" />

                  <?php echo e(csrf_field()); ?>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script type="text/javascript">

    let selectedFiles = []; // store selected files

    document.getElementById('fileInput').addEventListener('change', function (event) {
      const newFiles = Array.from(event.target.files);
      selectedFiles.push(...newFiles);
      renderPreviews();

      // clear file input so same file can be reselected later
      event.target.value = '';
    });

    function renderPreviews() {
      const container = document.getElementById('previewContainer');
      container.innerHTML = '';

      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
          const div = document.createElement('div');
          div.style.position = 'relative';
          div.innerHTML = `
                            <img src="${e.target.result}" class="rounded border" width="100" height="100">
                            <button type="button" class="btn btn-sm btn-danger" style="position:absolute;top:0;right:0;"
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


    // Center at user's current location if available
    let map, marker;

function createMap(lat, lng) {
  if(!map) {
    map = L.map('propertyMap').setView([lat, lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    marker = L.marker([lat, lng], { draggable: true }).addTo(map);
    marker.on('dragend', function (e) {
      let p = e.target.getLatLng();
      $('#latitude').val(p.lat);
      $('#longitude').val(p.lng);
    });

    map.on('click', function (e) {
      marker.setLatLng(e.latlng);
      $('#latitude').val(e.latlng.lat);
      $('#longitude').val(e.latlng.lng);
    });
  } else {
    map.setView([lat, lng], 16);
    marker.setLatLng([lat, lng]);
  }

  $('#latitude').val(lat);
  $('#longitude').val(lng);
}

function initializePropertyMap() {
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(pos) {
      createMap(pos.coords.latitude, pos.coords.longitude);
    }, function() {
      geocodeSelectedAddress();
    });
  } else {
    geocodeSelectedAddress();
  }
}

function geocodeSelectedAddress() {
  let state = $('#state option:selected').text();
  let city = $('#city option:selected').text();
  let location = $('#location_id option:selected').text();

  let addressParts = [];
  if(location && location !== 'Select Location') addressParts.push(location);
  if(city && city !== 'Select City') addressParts.push(city);
  if(state && state !== 'Select State') addressParts.push(state);

  let address = addressParts.join(', ');

  if(address) {
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
      .then(res => res.json())
      .then(data => {
        if(data.length > 0) {
          createMap(data[0].lat, data[0].lon);
        } else {
          createMap(28.6139, 77.2090); // fallback: Delhi
        }
      }).catch(() => {
        createMap(28.6139, 77.2090);
      });
  } else {
    createMap(28.6139, 77.2090);
  }
}

// Call on page load
initializePropertyMap();

// Update map if selects change
$('#state, #city, #location_id').on('change', function() {
  geocodeSelectedAddress();
});




    $(function () {
      $(".populate_categories,  .populate_locations").change();

      $(".add_formtype").empty().append(
        `<center class='m0-auto'> Please select Property Available For or Category </center>`
      );

    });

    document.getElementById('toggleAmenities')?.addEventListener('click', function () {
      const extras = document.querySelectorAll('.extra-amenity');
      const isHidden = extras[0].classList.contains('d-none');
      extras.forEach(el => el.classList.toggle('d-none'));
      this.textContent = isHidden ? 'Show Less' : 'Show More';
    });



    //-------------------- Get city By state --------------------//
    $('#state').on('change', function () {
      var state_id = this.value;
      $("#city").html('');
      $.ajax({
        url: "<?php echo e(route('front.getCities')); ?>",
        type: "POST",
        data: {
          state_id: state_id,
          _token: '<?php echo e(csrf_token()); ?>',
        },
        dataType: 'json',
        success: function (result) {
          $('#city').html('<option value="">Select City</option>');
          $.each(result, function (key, city) {
            $("#city").append('<option value="' + city.id + '">' + city.name + '</option>');
          });
        }
      });
    });

    //-------------------- Get locations By city --------------------//
    $('#city').on('change', function () {
      var city_id = this.value;
      $("#location_id").html('');
      $.ajax({
        url: "<?php echo e(route('front.getLocations')); ?>",
        type: "POST",
        data: {
          city_id: city_id,
          _token: '<?php echo e(csrf_token()); ?>',
        },
        dataType: 'json',
        success: function (result) {
          $('#location_id').html('<option value="">Select Location</option>');
          $.each(result, function (key, location) {
            $('#location_id').append('<option value="' + location.id + '">' + location.location + '</option>');
          });

          // Append the "Others" option at the end
          $('#location_id').append('<option value="other">Others</option>');
        }
      });
    });


    $('#location_id').on('change', function () {
      var location_id = $('#location_id').val();
      $("#sub_location_id").html('');
      $.ajax({
        url: "<?php echo e(route('front.getSubLocations')); ?>",
        type: "POST",
        data: {
          location_id: location_id,
          _token: '<?php echo e(csrf_token()); ?>',
        },
        dataType: 'json',
        success: function (result) {
          $('#sub_location_id').empty();
          $.each(result, function (key, location) {
            $("#sub_location_id").append('<option value="' + location.id + '">' + location.sub_location_name + '</option>');
          });

          // Refresh select2 options
          $('#sub_location_id').trigger('change.select2');
        }
      });
    });

    $("#create_property_form").validate({
      submitHandler: function (form) {

        // Update the hidden formbuilder field
        var data = $('#fb-render').formRender('userData');
        if (!data) {
          toastr.error('Additional details form must be required, please select another category or contact admin.');
          return false;
        }
        $('#form_json').val(JSON.stringify(data));

        // Create FormData here
        var formData = new FormData(form);
        selectedFiles.forEach(file => {
          formData.append('gallery_images_file[]', file);
        });

        $.ajax({
          url: "<?php echo e(config('app.api_url')); ?>/property",
          method: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function (request) {
            request.setRequestHeader('auth-token', "<?php echo e(Auth::user()->auth_token); ?>");
            $(".addproperty").attr('disabled', true);
          },
          success: function (response) {
            if (response.status == "success") {
              toastr.success(response.message);
              $("#create_property_form")[0].reset();
              setTimeout(function () {
                window.location.href = "<?php echo e(url('master/preview/property')); ?>/" + response.data.listing.id;
              }, 100);
            } else {
              toastr.error(response.message || 'An error occurred.');
            }
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              const errors = xhr.responseJSON.errors;
              Object.keys(errors).forEach(function (key) {
                const input = $('[name="' + key + '"]');
                input.addClass('is-invalid');
                toastr.error(errors[key][0]);
              });
            } else {
              toastr.error(xhr.responseJSON?.message || 'Unexpected error');
            }
          },
          complete: function () {
            $(".addproperty").attr('disabled', false);
          }
        });

      }
    });
    //-------------------- Get sub categories By category --------------------//
    function fetch_subcategories(id, callback) {
      var route = "<?php echo e(url('get/sub-categories')); ?>/" + id
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
                `<option value=''> Select </option>`
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
            fetch_form_type()
          }
        },
        error: function (response) {
          // toastr.error('An error occured while fetching subcategories');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          // $(".addproperty").attr('disabled', false);
        }
      })
    }

    //-------------------- Get sub sub categories By sub category --------------------//
    var cachedSubSubCategories = {};
    function fetch_subsubcategories(id, callback) {
      $('#sub_sub_category_id').html('<option value="">Loading...</option>');
      var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + id
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
          if (callback) {
            callback();
          }
        },
        error: function () {
          $('#sub_sub_category_id').html('<option value="">Error loading</option>');
        }
      });
    }


    //-------------------- Get custom form --------------------//
    function fetch_form_type() {
      var cat = $(".populate_categories option:selected").val();
      var subcat = $(".populate_subcategories option:selected").val();
      var subsubcat = $(".populate_subsubcategories option:selected").val();
      var route = "<?php echo e(url('category/related-form')); ?>";
      $.ajax({
        url: route,
        method: 'post',
        data: {
          "_token": "<?php echo e(csrf_token()); ?>",
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
            document.getElementById('fb-render').innerHTML = '';
            var formData = response.form_data;
            var formRenderOptions = { formData };
            frInstance = $('#fb-render').formRender(formRenderOptions);
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

    $('#location_id').on('change', function () {
      if ($(this).val() && $(this).val() === 'other') {
        $('#custom-location-container').show();
      } else {
        $('#custom-location-container').hide();
      }
    });

    // Initialize Select2 for Sub Location with tagging (add new)
    function initSubLocationSelect2() {
      $('#sub_location_id').select2({
        tags: true,
        width: '100%',
        placeholder: 'Select or add sub locations',
        closeOnSelect: false,
        createTag: function (params) {
          var term = $.trim(params.term);
          if (term === '') {
            return null;
          }
          return {
            id: term,
            text: term,
            isNew: true
          };
        }
      });
    }

    // Initialize on ready
    initSubLocationSelect2();

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/properties/create.blade.php ENDPATH**/ ?>