

<?php $__env->startSection('title'); ?>
Contact Us
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Contact Info</h3>
                    <button class="btn btn-primary btn-save" data-target="#add-contactinfo" data-toggle="modal"><i class="fas fa-plus"></i> Add Address</button>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Contact Info</li>
                        <li class="breadcrumb-item active">Contact Info</li>
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
                            <form method="post" action="<?php echo e(route('updateAboutContent')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <label>Map Link</label>
                                <input type="hidden" name="id" value="<?php echo e($map_link->id); ?>">
                                <input type="hidden" name="heading" value="Map Link">
                                <textarea name="description" class="form-control"><?php echo e($map_link->description); ?></textarea>
                                <div class="form-action row">
                                    <div class="col-sm-12 text-center" style="margin-top: 20px;">
                                      <button class="btn btn-primary btn-add" type="submit">Update Map Link</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-main-body">
  <div class="container">
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
                      <th>Icon</th>
                      <th>Title</th>
                      <th>Address</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i + 1); ?></td>
                            <td><?php echo $info->icon; ?></td>
                            <td><?php echo e($info->title); ?></td>
                            <td><?php echo $info->address; ?></td>
                            <td><?php echo e($info->email); ?></td>
                            <td><?php echo e($info->mobile_number); ?></td>
                            <td>
                                <ul class="action">
                                  <li><a href="#" onclick="fetchData(<?php echo e($info->id); ?>);"><i class="fas fa-pencil-alt"></i></a></li>
                                  <li><a href="#" data-toggle="modal" data-target="#delete-category" onclick="$('#delete_category #id').val(<?php echo e($info->id); ?>)"><i class="fas fa-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<div class="modal" id="add-contactinfo">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Contact Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?php echo e(route('admin.createContactInfo')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Icon</label>
              <input type="text" class="text-control" name="icon" placeholder="Enter Fa Fa Icon Code Here" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Title</label>
              <input type="text" class="text-control" name="title" placeholder="Enter Title" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Email</label>
              <input type="text" class="text-control" name="email" placeholder="Enter Email" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Mobile Number</label>
              <input type="text" class="text-control" name="mobile_number" placeholder="Enter Mobile Number" required />
            </div>
            <div class="col-sm-12">
                <label class="label-control">Address</label>
                <textarea name="address" class="form-control" required=""></textarea>
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Address</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="update-contactinfo">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Contact Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?php echo e(route('admin.updateContactInfo')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group row">
            <div class="col-sm-12">
              <input type="hidden" name="id" id="up_id">
              <label class="label-control">Icon</label>
              <input type="text" class="text-control" name="icon" id="up_icon" placeholder="Enter Fa Fa Icon Code Here" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Title</label>
              <input type="text" class="text-control" name="title" id="up_title" placeholder="Enter Title" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Email</label>
              <input type="text" class="text-control" name="email" id="up_email" placeholder="Enter Email" required />
            </div>
            <div class="col-sm-12">
              <label class="label-control">Mobile Number</label>
              <input type="text" class="text-control" name="mobile_number" id="up_mobile_number" placeholder="Enter Mobile Number" required />
            </div>
            <div class="col-sm-12">
                <label class="label-control">Address</label>
                <textarea name="address" class="form-control" id="up_address" required=""></textarea>
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Update Address</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="delete-category" class="delete-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_category" name="delete_category">
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

    function fetchData(id){
        var route = "<?php echo e(route('admin.getContactInfo', ':id')); ?>";
        var route = route.replace(":id", id);
        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              console.log(response);
              document.getElementById('up_id').value = response.data.picked.id;
              document.getElementById('up_icon').value = response.data.picked.icon;
              document.getElementById('up_title').value = response.data.picked.title;
              document.getElementById('up_email').value = response.data.picked.email;
              document.getElementById('up_address').value = response.data.picked.address;
              document.getElementById('up_mobile_number').value = response.data.picked.mobile_number;
              $("#update-contactinfo").modal('show');
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
            $(".loading").css('display', 'none');
          },
          error: function(response) {
            toastr.error('An error occured');
            $(".loading").css('display', 'none');
          }
        });
    }

    $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "<?php echo e(route('admin.deleteContactInfo', ['id' => ':id'])); ?>";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_category").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-category").modal('hide');
            delete_row(id);
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
        },
        error: function(response) {
            toastr.error('An error occured.')
        },
        complete: function() {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/contact/manage_contact.blade.php ENDPATH**/ ?>