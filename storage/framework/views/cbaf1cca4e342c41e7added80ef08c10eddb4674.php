<?php $__env->startSection('title'); ?>
Manage Location
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container-fluid"> 
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Location</h3>
          <button class="btn btn-primary btn-save" data-target="#add-location" data-toggle="modal"><i class="fas fa-plus"></i> Add Location</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Location</li>
            <li class="breadcrumb-item active">Manage Location</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Location</th>
                      <th>Sub Locations</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($locations) && count($locations) > 0): ?>
                      <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($v->id); ?>">
                          <td><?php echo e($k+1); ?></td>
                          <td><?php echo e($v->getState->name); ?></td>
                          <td><?php echo e($v->Cities->name); ?></td>
                          <td><?php echo e($v->location); ?></td>
                          <td><a href="<?php echo e(route('admin.edit_sublocation', ['id' => base64_encode($v->id)])); ?>"><?php echo e($v->sub_locations_count); ?></td>
                          <td>
                            <?php if($v->status == "0"): ?>
                              Active
                            <?php else: ?> 
                              Inactive
                            <?php endif; ?>
                          </td>

                          <td>
                            <ul class="action">
                              <li><a href="<?php echo e(route('admin.edit_sublocation', ['id' => base64_encode($v->id)])); ?>" title="Manage Sub Locations"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                              <li><a href="#" onclick="fetchData(<?php echo e($v->id); ?>)"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#" data-toggle="modal" data-target="#delete-locations" onclick="$('#delete_locations #id').val(<?php echo e($v->id); ?>)"><i class="fas fa-trash"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                      <tr>
                        <td colspan="7"> No records found </td>
                      </tr> 
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal" id="add-location">
  <div class="modal-dialog">
    <div class="modal-content">

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Location</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="create_location" name="create_location">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">State</label>
              <select class="text-control populate_states" name="state_id" onchange="update_cities(this.value, (()=>{}))">
                <option value="">Select State</option>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="label-control">City</label>
              <select class="text-control populate_cities" name="city_id" required>
                <option></option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Location</label>
              <input type="text" class="text-control" placeholder="Enter Location Name" name="location" required />
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Location</button>
            </div>
          </div>

          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="edit-location">
  <div class="modal-dialog">
    <div class="modal-content">

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Location</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="update_locations" name="update_locations">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">State</label>
              <select class="text-control populate_states" name="state_id" onchange="update_cities(this.value, (()=>{}))">
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="label-control">City</label>
              <select class="text-control populate_cities" name="city_id">
                <option>Select City</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Location</label>
              <input type="text" class="text-control" placeholder="Enter Location Name" id="location" name="location" required />
            </div>
            <div class="col-sm-6">
              <label class="label-control">Status</label>
              <select class="text-control status" name="status" required>
                <option value="0">Active</option>
                <option value="1">Inactive</option>
              </select>
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Location</button>
            </div>
          </div>

          <input type="hidden" id="location_id" name="id" value="" />
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="delete-locations" class="delete-locations">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Location?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_locations" name="delete_locations">
          <div class="form-group row">
            <center> Are you sure you want to delete this? </center>
          </div>      

          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-delete" type="submit">Delete</button>
            </div>
          </div>  

          <input type="hidden" name="id" id="id" />
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script type="text/javascript">
$(function() {
window.cities = null;

    $("#create_location").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('admin.locations.store')); ?>",
          method: "POST",
          data: $("#create_location").serialize(),
          beforeSend:function() {
            $(".loading_2").css('display', 'block');
            $(".btn-add").attr('disabled', true);
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });


    $("#update_locations").validate({
      submitHandler:function() {
        var route = "<?php echo e(route('admin.locations.update', ['location' => ':id'])); ?>";
        var route = route.replace(':id', $("#location_id").val());
        $.ajax({
          url: route,
          method: "PATCH",
          data: $("#update_locations").serialize(),
          beforeSend: function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $("#edit-location").modal('hide');
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });

    $(".btn-delete").on('click', function(e) {
        e.preventDefault();
        document.getElementById('new_loader').style.display = 'block';
        $(".btn-delete").attr('disabled', true);

        var id = $("#delete_locations #id").val();
        var route = "<?php echo e(route('admin.locations.destroy', ['location' => ':id'])); ?>";
        var route = route.replace(':id', id);
        $.ajax({
          url: route,
          method: "DELETE",
          data: $("#delete_locations").serialize(),
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              delete_row(id);
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
              toastr.error('An error occured.');
              document.getElementById('new_loader').style.display = 'none';
          },
          complete: function() {
            $("#delete-locations").modal('hide');
            document.getElementById('new_loader').style.display = 'none';
            $(".btn-delete").attr('disabled', false);
          }
        })
    });


});

function fetchData(id){

            document.getElementById('new_loader').style.display = 'block';

            var route = "<?php echo e(route('admin.locations.show', ':id')); ?>";
            var route = route.replace(':id', id);

        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function function_name(argument) {
            // $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              $("#edit-location #location_id").val(response.data.Location.id);
              $("#update_locations .status").val(response.data.Location.status);
              $("#update_locations .status").val(response.data.Location.status);
              $("#edit-location .populate_states").val(response.data.Location.state_id);
              // $("#edit-location .populate_states").change();
              // console.log(response.data.Location.city);
              $("#edit-location .populate_cities").val(response.data.Location.city_id);
              $("#edit-location #location").val(response.data.Location.location)
              openModal('edit',response.data.Location.state_id, function() {
                $(".populate_cities").val(response.data.Location.city_id);
                $("#edit-location").modal('show');
              });
            } else if (response.status === 400) {
              toastr.error(response.message);
              
            }
            document.getElementById('new_loader').style.display = 'none';
          },
          error: function(response) {
            toastr.error('An error occured');
          },
          complete: function() {
            $(".loading").css('display', 'none');
          }
        });
}

function openModal(type, id= null, callback) {
  if(type == 'add') {
    update_cities(1,function() {
      $("#add-location").modal('show');
    });
  } else if(type == 'edit') {
    update_cities(id, callback);
  }
}



function load_all_cities(callback) {
}

function update_cities(sel_state_id, callback) {

  var route =  "<?php echo e(route('cities_states', ['id' => ':id'])); ?>";
  var route = route.replace(':id', sel_state_id);

  $(".populate_cities").empty();
  $.ajax({
    url: route,
    method: "GET",
    beforeSend:function() {
      $(".loading_2").css('display', 'block');
      $(".btn-update").attr('disabled', true);
    },
    success: function(response) {
      if(response) {
        var cities = response;
        $.each(cities, function(x,y) {
          $(".populate_cities").append(
            `
              <option value=${y.id}> ${y.name} </otion>
            `
          );
        });

      } else {
        toastr.error('Cities not found.')
      }
    },
    error: function(response) {
      toastr.error('An error occured');
    },
    complete: function() {
      $(".loading_2").css('display', 'none');
      $(".btn-update").attr('disabled', false);
      callback();
    }
  });

  // callback();
}


</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/locations/index.blade.php ENDPATH**/ ?>