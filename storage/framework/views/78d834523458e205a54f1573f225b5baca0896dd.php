

<?php $__env->startSection('title'); ?>
Manage Job Category
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
          <button class="btn btn-primary btn-save" data-target="#add-category" data-toggle="modal"><i class="fas fa-plus"></i> Add Category</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Job</li>
            <li class="breadcrumb-item active">Manage Job Category</li>
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
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($categories) && count($categories) > 0): ?>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($v->id); ?>">
                          <td><?php echo e($k+1); ?></td>
                          <td><?php echo e($v->name); ?></td>
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
                              <li><a href="#" onclick="fetchData(<?php echo e($v->id); ?>);"><i class="fas fa-pencil-alt"></i></a></li>
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

<div class="modal" id="add-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?php echo e(route('admin.storeJobCategories')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Category</label>
              <input type="text" class="text-control" name="category_name" placeholder="Enter Category Name" onchange="populate_slug('add_category_slug', this);" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" name="category_meta_title" placeholder="Enter Meta Title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" name="category_meta_description" placeholder="Enter Meta Description" required /></textarea>
            </div>
        <div class="col-sm-12">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" name="category_keywords" placeholder="Enter Meta Keywords" required /></textarea>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Category</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal update_category_modal" id="update-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="<?php echo e(route('admin.updateJobCategories')); ?>">
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Category</label>
              <input type="text" class="text-control" placeholder="Enter Category Name" id="category_name" name="category_name" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" id="category_meta_title" name="category_meta_title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" id="category_meta_description" name="category_meta_description" required /></textarea>
            </div>
        <div class="col-sm-12">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" placeholder="Enter Meta Keywords" id="category_keywords" name="category_keywords" required /></textarea>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Category</button>
            </div>
          </div>

          <input type="hidden" id="category_id" name="category_id" value="" />
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
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
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
$(function() {
    jQuery.validator.addMethod("restrict_special_chars", function(value, element) {
        if(value.length == 0 && value == "") {
          return true;
        }
        if (/[a-zA-Z0-9-]$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, 'Special characters not allowed. Please try again.');


    $("#update_category").validate({
      rules:{
        category_slug:{
          restrict_special_chars: true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('admin.category.update', ['category' => 1])); ?>",
          method: "PATCH",
          data: $("#update_category").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            document.getElementById('new_loader').style.display = 'block';
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
            $(".update_category_modal").modal('hide');
            $(".btn-update").attr('disabled', false);
            document.getElementById('new_loader').style.display = 'none';
          }
        })
      }
    });
});


  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "<?php echo e(route('admin.deleteJobCategories', ['id' => ':id'])); ?>";
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

  var route = "<?php echo e(route('admin.getCategoryInfo', ':id')); ?>";
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
              $(".update_category_modal #category_id").val(response.data.picked.id)
              $(".update_category_modal #category_name").val(response.data.picked.name)
              $(".update_category_modal #category_meta_title").val(response.data.picked.meta_title)
              $(".update_category_modal #category_meta_description").val(response.data.picked.meta_description)
              $(".update_category_modal #category_keywords").val(response.data.picked.meta_keywords)
              $(".update_category_modal").modal('show');
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
        text: "Chnage Status Of This Category.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '<?php echo e(route('admin.changeStatusJobCategories')); ?>',
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-new/resources/views/admin/job/manage_job_category.blade.php ENDPATH**/ ?>