

<?php $__env->startSection('title'); ?>
Manage Jobs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <a href="<?php echo e(route('admin.createJobView')); ?>"><button class="btn btn-primary btn-save"><i class="fas fa-plus"></i> Add Job</button></a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Job</li>
            <li class="breadcrumb-item active">Manage Jobs</li>
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
                      <th>Category</th>
                      <th>Heading</th>
                      <th>Tag Line</th>
                      <th>Skills</th>
                      <th>Country</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($jobs) && count($jobs) > 0): ?>
                      <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($v->id); ?>">
                          <td><?php echo e($k+1); ?></td>
                          <td><?php echo e($v->getJobCategory->name); ?></td>
                          <td><?php echo e($v->heading); ?></td>
                          <td><?php echo e($v->tag_line); ?></td>
                          <td><?php echo e($v->getSkills($v->skills)); ?></td>
                          <td><?php echo e($v->getCountry->name); ?></td>
                          <td><?php echo e($v->state); ?></td>
                          <td><?php echo e($v->city); ?></td>
                          <td>
                            <?php if($v->status == "Yes"): ?>
                              Active
                            <?php else: ?> 
                              Inactive
                            <?php endif; ?>
                          </td>
                          <td><ul class="action">
                              <?php if($v->status == 'Yes'): ?>
                                <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($v->id); ?>')"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                              <?php else: ?>
                                <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($v->id); ?>')"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                              <?php endif; ?>
                              <li><a href="#" onclick="fetchData(<?php echo e($v->id); ?>);"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                              <li><a href="<?php echo e(route('admin.editJob', $v->id)); ?>"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#" data-toggle="modal" data-target="#delete-category" onclick="$('#delete_category #id').val(<?php echo e($v->id); ?>)"><i class="fas fa-trash"></i></a></li>
                            </ul></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                      <tr>
                        <td colspan="5"> No records found </td>
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

<div class="modal" id="view-reasons">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reasons</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div>
          <center><h3>Description</h3></center>
          <p id="view-description"></p>
        </div>
        <div>
          <center><h3>Requirments</h3></center>
          <p id="view-requirments"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="delete-category" class="delete-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Job</h4>
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

  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "<?php echo e(route('admin.deleteJob', ['id' => ':id'])); ?>";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "get",
        data: $("#delete_category").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-category").modal('hide');
            delete_row(id);
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

function fetchData(id){
    var route = "<?php echo e(route('admin.jobInfo', ':id')); ?>";
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
          document.getElementById('view-description').innerHTML = response.data.picked.description;
          document.getElementById('view-requirments').innerHTML = response.data.picked.requirements;
          $("#view-reasons").modal('show');
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

function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chnage Status Of This Job.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '<?php echo e(route('admin.jobChangeStatus')); ?>',
            method: "POST",
            data: {
              "_token": "<?php echo e(csrf_token()); ?>",
              'id'    : id
            },
            beforeSend:function() {
              $(".loading").css('display', 'block');
            },
            success: function(response) {
              swal('', response, 'success');
              setTimeout(function() {
                location.reload();
              }, 1000);
            },
            error: function(response) {
              $(".loading").css('display', 'none');
              swal('', response, 'error');
            },
            complete: function() {
              $(".loading").css('display', 'none');
            }
          })
      }
    });
    
  }

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/job/manage_jobs.blade.php ENDPATH**/ ?>