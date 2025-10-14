

<?php $__env->startSection('title'); ?>
  Preview Properties
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <a href="<?php echo e(url('master/properties/' . base64_encode($id) . '/edit')); ?>?from=preview"><button
              class="btn btn-primary">Edit Property</button></a>
          <div class="card">
            <div class="loading">
              <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
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
                        value="<?php echo e($property->title); ?>" required readonly="" />
                    </div>

                    <div class="col-sm-4">
                      <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                      <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price"
                        value="<?php echo e($property->price); ?>" required readonly="" />
                    </div>

                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="category_id"
                        onchange="fetch_subcategories(this.value, fetch_form_type);" disabled="">
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($v->id); ?>" <?php echo e($property->category_id == $v->id ? "selected" : ""); ?>>
                            <?php echo e($v->category_name); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                    
                    <?php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="priceLabelField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control d-flex">Price Label</label>
                      <?php if($price_labels->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" value="<?php echo e($label->id); ?>" disabled <?php echo e(in_array($label->id, explode(',', $property->price_label ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($label->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <input type="text" class="form-control" readonly
                          value="<?php echo e(optional($price_labels->firstWhere('id', $property->price_label))->name); ?>">
                      <?php endif; ?>

                      <?php if(!empty($property->price_label_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($price_labels->firstWhere('id', $property->price_label))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" readonly value="<?php echo e($property->price_label_second); ?>">
                        </div>
                      <?php endif; ?>
                    </div>

                    
                    <?php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="propertyStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Property Status</label>
                      <?php if($property_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" value="<?php echo e($status->id); ?>" disabled <?php echo e(in_array($status->id, explode(',', $property->property_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <input type="text" class="form-control" readonly
                          value="<?php echo e(optional($property_statuses->firstWhere('id', $property->property_status))->name); ?>">
                      <?php endif; ?>

                      <?php if(!empty($property->property_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($property_statuses->firstWhere('id', $property->property_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" readonly value="<?php echo e($property->property_status_second); ?>">
                        </div>
                      <?php endif; ?>
                    </div>

                    
                    <?php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="registrationStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Registration Status</label>
                      <?php if($registration_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" value="<?php echo e($status->id); ?>" disabled <?php echo e(in_array($status->id, explode(',', $property->registration_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <input type="text" class="form-control" readonly
                          value="<?php echo e(optional($registration_statuses->firstWhere('id', $property->registration_status))->name); ?>">
                      <?php endif; ?>

                      <?php if(!empty($property->registration_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($registration_statuses->firstWhere('id', $property->registration_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" readonly
                            value="<?php echo e($property->registration_status_second); ?>">
                        </div>
                      <?php endif; ?>
                    </div>

                    
                    <?php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
                    <div id="furnishingStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
                      <label class="label-control">Furnishing Status</label>
                      <?php if($furnishing_statuses->first()->input_format == 'checkbox'): ?>
                        <?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <label>
                            <input type="checkbox" value="<?php echo e($status->id); ?>" disabled <?php echo e(in_array($status->id, explode(',', $property->furnishing_status ?? '')) ? 'checked' : ''); ?>>
                            <?php echo e($status->name); ?>

                          </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <input type="text" class="form-control" readonly
                          value="<?php echo e(optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->name); ?>">
                      <?php endif; ?>

                      <?php if(!empty($property->furnishing_status_second)): ?>
                        <div class="mt-2">
                          <label>
                            <?php echo e(optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->second_input_label ?? 'Date'); ?>

                          </label>
                          <input type="date" class="form-control" readonly
                            value="<?php echo e($property->furnishing_status_second); ?>">
                        </div>
                      <?php endif; ?>
                    </div>

                  </div>

                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Description</label>
                      <textarea class="text-control" rows="2" cols="4" name="description" required
                        readonly=""> <?php echo e($property->description); ?></textarea>
                    </div>
                  </div>

                  <div id="amenitiesField" style="display: none;">
                    <h4 class="form-section-h">Amenities</h4>
                    <div class="form-group-f row">
                      <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3">
                          <img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
                          <p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>" disabled=""
                              <?php if(in_array($amenity->id, explode(',', $property->amenities))): ?> checked <?php endif; ?>>
                            <?php echo e($amenity->name); ?></p>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>

                  <h4 class="form-section-h">Property Location</h4>
                  <div class="form-group-f row">
                    <div class="col-sm-6">
                      <label class="label-control">State </label>
                      <select class="form-control" name="state" id="state" required="" disabled="">
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
                      <select class="form-control" name="city" id="city" required="" disabled="">
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
                      <select class="text-control" name="location_id[]" id="location_id" multiple="" required=""
                        disabled="">
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(in_array($location->id, explode(',', $property->location_id))): ?>
                            <option value="<?php echo e($location->id); ?>" selected=""><?php echo e($location->location); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($location->id); ?>"><?php echo e($location->location); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>

                    </div>
                    <div class="col-sm-6">
                      <label class="label-control">Sub Location </label>
                      <input type="text" class="text-control" name="sub_location_name" id="sub_location_name"
                        value="<?php echo e($property->sub_location_name); ?>" disabled />
                    </div>

                  </div>
                  <div class="form-group-f row">
                    <div class="col-sm-12">
                      <label class="label-control">Address </label>
                      <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address"
                        value="<?php echo e($property->address); ?>" required readonly="" />
                    </div>
                  </div>

                  <div class="row">
                    <h4 style="border-bottom-style: ridge;">Property Images</h4>
                  </div>
                  <div class="row">
                    <?php if(count($property->PropertyGallery) > 0): ?>
                      <?php $__currentLoopData = $property->PropertyGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3">
                          <a href="<?php echo e(asset('')); ?>/<?php echo e($value->image_path); ?>" target="_blank"><img
                              src="<?php echo e(asset('')); ?>/<?php echo e($value->image_path); ?>" alt="Property Images" style="height: 200px;"></a>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <h5 style="color: brown;">No Any Images Found.</h5>
                    <?php endif; ?>
                  </div>
                  <div class="row">
                    <h4 style="border-bottom-style: ridge;">Property Additional Information</h4>
                  </div>
                  <div id="fb-render"></div>
                  <div class="row">
                    <input type="hidden" name="save_json" id="save_json" value="<?php echo e($property->additional_info); ?>">
                  </div>

                  <div class="form-group-f row">
                    <?php /*
                         @foreach($form_type as $f=>$v)
                           @foreach($v->formtypesfields as $a=>$b)
                             @foreach($b->subfeatures as $s=>$f)
                               <div class="col-sm-4">
                                 <label class="label-control">{{$f->sub_feature_name}}</label>
                                 <div class="input-group">
                                   <?php
                                     $db_values = [];
                                   ?>

                                     @foreach($property->propertyfeatures as $a=>$b)
                                       <?php
                                         array_push($db_values, $b->feature_value)
                                       ?>
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
                      <a href="<?php echo e(url('post/property/final')); ?>/<?php echo e(base64_encode($id)); ?>"><button class="btn btn-primary"
                          type="button">Next</button></a>
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
      fetch_sublocations('<?php echo e($property->location_id); ?>', function () {
        $(".populate_sublocations").val('<?php echo e($property->sub_location_id); ?>');
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
              toastr.success(response.message)
              // $("#create_property_form").trigger('reset');
              //           setTimeout(function() {
              // window.location.href = "<?php echo e(route('admin.properties.index')); ?>";
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
    //      url: "<?php echo e(route('admin.properties.update_property')); ?>",
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
    //          // window.location.href = "<?php echo e(route('admin.properties.index')); ?>";
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
              console.log('here');

              $.each(subcategories, function (x, y) {
                if ('<?php echo e($property->sub_category_id  ?? 0); ?>' == y.id)
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
      var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + id;

      $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
          $('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
          if (response.subsubcategories && response.subsubcategories.length) {
            cachedSubSubCategories = response.subsubcategories;

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


    // 🔹 Auto-load on page load if editing
    $(document).ready(function () {
      let preselectedSubCategory = "<?php echo e($property->sub_category_id); ?>";
      let preselectedSubSubCategory = "<?php echo e($property->sub_sub_category_id); ?>";

      if (preselectedSubCategory) {
        fetch_subsubcategories(preselectedSubCategory, preselectedSubSubCategory);
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

      if (cat == "") {
        clearFormType(true);
        return true;
      }


      // var route = "<?php echo e(route('admin.fetch_form_type')); ?>/?cat="+cat+"&subcat="+subcat+"&edit=0&listing_id="+listing_id;
      var route = "<?php echo e(config('app.api_url')); ?>/fetch_form_type/?cat=" + cat + "&subcat=" + subcat + "&edit=0&listing_id=" + listing_id;
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
      var route = "<?php echo e(route('admin.fetch_sublocations', ['id' => ':id'])); ?>";
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/properties/preview.blade.php ENDPATH**/ ?>