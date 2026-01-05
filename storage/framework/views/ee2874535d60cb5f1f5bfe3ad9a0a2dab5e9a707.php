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
                  <h4 class="form-section-h">Property Description</h4>

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

                    <div class="col-sm-12">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name" required />
                    </div>
                   
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description" required></textarea>
                    </div>

                  </div>


                  <div id="fb-render"></div>
                  <input type="hidden" name="additional_info" id="form_json">


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
        <div class="form-group col-sm-6">
            <label class="label-control">Landmark</label>
            <input type="text"
                   class="text-control"
                   name="landmark"
                   id="landmark"
                   placeholder="Enter nearby landmark"
                   value="<?php echo e(old('landmark')); ?>">
        </div>

        <div class="form-group col-sm-6">
            <label class="label-control">Pin Code</label>
            <input type="text"
                   class="text-control"
                   name="pincode"
                   id="pincode"
                   placeholder="Enter 6-digit pin code"
                   maxlength="6"
                   pattern="[0-9]{6}"
                   value="<?php echo e(old('pincode')); ?>">
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
  <div class="col-sm-12">

    <div class="photo-upload-card" style="border:2px dashed #ddd;padding:15px;border-radius:6px;">

      <label class="photo-upload-btn" style="cursor:pointer;">
        <input type="file" id="fileInput" multiple accept="image/*" hidden>
        <strong>Click to upload photos</strong>
      </label>

      <div id="previewContainer" class="d-flex flex-wrap gap-3 mt-3"></div>

    </div>

  </div>
</div>

<input type="hidden" name="default_image_index" id="default_image_index" value="0">


                  <h3>Property Video</h3>
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label class="label-control">Upload Video</label>
                      <input type="file" class="form-control" name="property_video" accept="video/*">
                      <small class="text-muted">You can upload one property video (optional).</small>
                    </div>
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
      div.style.textAlign = 'center';

      div.innerHTML = `
        <img src="${e.target.result}" class="rounded border" width="100" height="100" style="object-fit:cover;">

        <div class="form-check mt-1">
          <input class="form-check-input default-radio"
                 type="radio"
                 name="default_image_radio"
                 value="${index}"
                 ${index === 0 ? 'checked' : ''}>
          <label class="form-check-label small">Default</label>
        </div>

        <button type="button"
                class="btn btn-sm btn-danger"
                style="position:absolute;top:0;right:0;"
                onclick="removeImage(${index})">&times;</button>
      `;

      container.appendChild(div);

      // auto-set default
      document.getElementById('default_image_index').value =
        document.querySelector('.default-radio:checked')?.value || 0;
    };
    reader.readAsDataURL(file);
  });
}

document.getElementById('previewContainer')
  .addEventListener('change', function (e) {
    if (e.target.classList.contains('default-radio')) {
      document.getElementById('default_image_index').value = e.target.value;
    }
  });

    function removeImage(index) {
      selectedFiles.splice(index, 1);
      renderPreviews();
    }


    // Center at user's current location if available
    let map, marker;

    function createMap(lat, lng) {
      if (!map) {
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
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (pos) {
          createMap(pos.coords.latitude, pos.coords.longitude);
        }, function () {
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
      if (location && location !== 'Select Location') addressParts.push(location);
      if (city && city !== 'Select City') addressParts.push(city);
      if (state && state !== 'Select State') addressParts.push(state);

      let address = addressParts.join(', ');

      if (address) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
          .then(res => res.json())
          .then(data => {
            if (data.length > 0) {
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
    $('#state, #city, #location_id').on('change', function () {
      geocodeSelectedAddress();
    });




    $(function () {
      $(".populate_categories,  .populate_locations").change();

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
          url: "<?php echo e(route('admin.properties.store')); ?>",
          method: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
        beforeSend: function () {
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