

<?php $__env->startSection('title'); ?>
  Edit Properties
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="loading">
              <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </div>

            <div class="card-body">
              <div class="card-block">
                <form class="form-body" id="update_property_form" name="update_property_form"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Property Description &amp; Price</h4>
                  <input type="hidden" name="from" id="from" value="<?php echo e(app('request')->input('from')); ?>">

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_form_type);">
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($v->id); ?>" <?php echo e($property->category_id == $v->id ? "selected" : ""); ?>>
                            <?php echo e($v->category_name); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-8">
                      <label class="label-control">Title </label>
                      <input type="text" class="text-control" name="title" placeholder="Enter Property Name"
                        value="<?php echo e($property->title); ?>" required />
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                      <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price"
                        value="<?php echo e($property->price); ?>" required />
                    </div>
                  </div>

                  <div class="form-row">
                    
                    <?php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="priceLabelField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control d-flex">Price Label</label>
                      <?php if($price_labels->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" name="price_label[]" value="<?php echo e($label->id); ?>" <?php echo e(in_array($label->id, explode(',', $property->price_label ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($label->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select name="price_label" class="form-control">
                          <option value="">Select</option>
                          <?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($label->id); ?>" <?php echo e($property->price_label == $label->id ? 'selected' : ''); ?>>
                              <?php echo e($label->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <?php if(!empty($property->price_label_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($price_labels->firstWhere('id', $property->price_label))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" name="price_label_second"
                            value="<?php echo e($property->price_label_second); ?>">
                        </div>
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
                            <input type="checkbox" name="property_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->property_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select name="property_status" class="form-control">
                          <option value="">Select</option>
                          <?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" <?php echo e($property->property_status == $status->id ? 'selected' : ''); ?>>
                              <?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <?php if(!empty($property->property_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($property_statuses->firstWhere('id', $property->property_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" name="property_status_second"
                            value="<?php echo e($property->property_status_second); ?>">
                        </div>
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
                            <input type="checkbox" name="registration_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->registration_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select name="registration_status" class="form-control">
                          <option value="">Select</option>
                          <?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" <?php echo e($property->registration_status == $status->id ? 'selected' : ''); ?>><?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <?php if(!empty($property->registration_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($registration_statuses->firstWhere('id', $property->registration_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" name="registration_status_second"
                            value="<?php echo e($property->registration_status_second); ?>">
                        </div>
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
                            <input type="checkbox" name="furnishing_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->furnishing_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <select name="furnishing_status" class="form-control">
                          <option value="">Select</option>
                          <?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" <?php echo e($property->furnishing_status == $status->id ? 'selected' : ''); ?>><?php echo e($status->name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      <?php endif; ?>

                      <?php if(!empty($property->furnishing_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" name="furnishing_status_second"
                            value="<?php echo e($property->furnishing_status_second); ?>">
                        </div>
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
                      <textarea class="text-control" rows="2" cols="4" name="description"
                        required> <?php echo e($property->description); ?></textarea>
                    </div>
                  </div>

                  <div id="amenitiesField" style="display:none;">
                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row">
                      <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3">
                          <img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
                          <p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>" <?php if(in_array($amenity->id, explode(',', $property->amenities))): ?> checked <?php endif; ?>> <?php echo e($amenity->name); ?></p>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Location</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">State </label>
                      <select class="form-control" name="state" id="state" required="">
                        <option value="">Select State </option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($property->state_id == $state->id): ?>
                            <option value="<?php echo e($state->id); ?>" selected=""><?php echo e($state->name); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">City </label>
                      <select class="form-control" name="city" id="city" required="">
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($property->city_id == $city->id): ?>
                            <option value="<?php echo e($city->id); ?>" selected=""><?php echo e($city->name); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">Location </label>
                      <select class="text-control" name="location_id" id="location_id" required="">
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($property->location_id == $location->id): ?>
                            <option value="<?php echo e($location->id); ?>" selected=""><?php echo e($location->location); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($location->id); ?>"><?php echo e($location->location); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="<?php echo e($property->address); ?>" required />
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Images</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">Featured Image </label>
                      <input type="file" class="text-control" name="feature_image_file" />
                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Gallery Images (Multiple) </label>
                      <input type="file" class="text-control" name="gallery_images_file[]" />
                    </div>
                  </div>
                  <div class="row form-group-f">
                    <?php if(count($property->PropertyGallery) > 0): ?>
                      <?php $__currentLoopData = $property->PropertyGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-2">
                          <div class="prop-img-d">
                            <a href="<?php echo e(asset('')); ?>/<?php echo e($value->image_path); ?>" target="_blank"><img
                                src="<?php echo e(asset('')); ?>/<?php echo e($value->image_path); ?>" alt="Property Images" class="img-fluid"></a>
                            <span onclick="deleteGalleryPhoto('<?php echo e($value->id); ?>')"><i class="fa fa-trash"
                                aria-hidden="true"></i></span>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <h5 style="color: brown;">No Any Images Found.</h5>
                    <?php endif; ?>
                  </div>
                  <h4 class="form-section-h">Property Additional Information</h4>

                  <center class="loading">
                    <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" />
                  </center>
                  <div id="fb-render"></div>
                  <div class="row">
                    <input type="hidden" name="save_json" id="save_json" value="<?php echo e($property->additional_info); ?>">
                    <input type="hidden" name="additional_info" id="form_json">
                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-primary updateproperty" type="submit">Update Property</button>
                    </div>
                  </div>

                  <input type="hidden" id="id" name="id" value="<?php echo e($property->id); ?>" />
                  <input type="hidden" id="formtype_id" name="formtype_id" value="<?php echo e($property->formtype_id); ?>" />
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

    $(function () {
      fetch_subcategories('<?php echo e($property->category_id); ?>', function () {
        $(".populate_subcategories").val('<?php echo e($property->sub_category_id); ?>');
        fetch_form_type();
        fetch_subsubcategories('<?php echo e($property->sub_category_id); ?>', function () {
          $(".populate_subsubcategories").val('<?php echo e($property->sub_sub_category_id); ?>');
          fetch_form_type();
        });
      });

      $(".property_use_for").hide();



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

        $.ajax({
          url: "<?php echo e(route('admin.properties.update_property')); ?>",
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
              toastr.success(response.message);
              var from = $('#from').val();
              if (from == 'preview') {
                var id = response.data.listing.id;
                window.location.href = "<?php echo e(url('master/preview/property')); ?>/" + id;
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
      // var route = "<?php echo e(route('admin.sub_category.fetch_subcategories_by_cat_id', ['id' => ':id'])); ?>";
      var route = "<?php echo e(url('get/sub-categories')); ?>/" + id  // var route = route.replace(':id', id);
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
      var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + id;

      $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
          $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
          if (response.subsubcategories && response.subsubcategories.length > 0) {
            cachedSubSubCategories = response.subsubcategories || [];

            $.each(response.subsubcategories, function (i, subsub) {
              let selected = (<?php echo e($property->sub_category_id ?? 0); ?> == subsub.id) ? "selected" : "";
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

            if (
              '<?php echo e($property->category_id); ?>' == response.category_id ||
              '<?php echo e($property->sub_category_id); ?>' == response.sub_category_id ||
              '<?php echo e($property->sub_sub_category_id); ?>' == response.sub_sub_category_id
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

    function deleteGalleryPhoto(id) {
      swal({
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
              url: '<?php echo e(url('delete/property/images')); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
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
          // reselect existing values from property
          var selectedIds = "<?php echo e($property->sub_location_id ?? ''); ?>";
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/properties/edit.blade.php ENDPATH**/ ?>