<?php $__env->startSection('title'); ?>
Manage Sub Category
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
          <button class="btn btn-primary btn-save" data-target="#add-sub-category" data-toggle="modal"><i class="fas fa-plus"></i> Add Sub Category</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Sub Category</li>
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
                      <th>Sub Category</th>
                      <th>URL Slug</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($subcategories) && count($subcategories) > 0): ?>
                      <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c=>$t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($t->id); ?>">
                          <td><?php echo e($c+1); ?></td>
                          <td> <?php echo e($t->category->category_name); ?> </td>
                          <td> <?php echo e($t->sub_category_name); ?> </td>
                          <td> <?php echo e($t->sub_category_slug); ?> </td>
                          <td>
                            <?php if($t->status == "0"): ?>
                              Active
                            <?php else: ?> 
                              Inactive
                            <?php endif; ?>
                          </td>
                          <td><ul class="action">
                              <li><a href="#" onclick="fetchData(<?php echo e($t->id); ?>);"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#" data-toggle="modal" data-target="#delete-sub-category" onclick="$('#delete_sub_category #id').val(<?php echo e($t->id); ?>)"><i class="fas fa-trash"></i></a></li>
                            </ul></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6"> No records found </td>
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

<div class="modal" id="add-sub-category">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Sub Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="create_sub_category" name="create_sub_category">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Category</label>
              <select class="text-control" name="category_id">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($v->id); ?>"> <?php echo e($v->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

            </div>
          <div class="col-sm-6">
              <label class="label-control">Sub Category</label>
              <input type="text" class="text-control" placeholder="Enter Sub Category Name" name="sub_category_name" onchange="populate_slug('sub_category_slug', this);" required />
            </div>
          </div>
      
          <div class="form-group row">
          <div class="col-sm-6">
              <label class="label-control">Slug</label>
              <input type="text" class="text-control" placeholder="Enter Slug" id="sub_category_slug" name="sub_category_slug"  />
            </div>
            <div class="col-sm-6">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" name="sub_category_meta_title" required />
            </div>
          </div>
      
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" name="sub_category_meta_description" required /></textarea>
            </div>
        <div class="col-sm-6">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Keywords" name="sub_category_keywords" required></textarea>
            </div>
          </div>
      
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Sub Category</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal update_sub_category_modal" id="edit-sub-category">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Sub Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="update_sub_category" name="update_sub_category">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Category</label>
              <select class="text-control" id="category_id" name="category_id">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($v->id); ?>"> <?php echo e($v->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
         <div class="col-sm-6">
              <label class="label-control">Sub Category</label>
              <input type="text" class="text-control" placeholder="Enter Sub Category Name" id="sub_category_name" name="sub_category_name" onchange="populate_slug('edit_sub_category_slug', this);" required />
            </div>
          </div>
      
          <div class="form-group row">
          <div class="col-sm-6">
              <label class="label-control">Slug</label>
              <input type="text" class="text-control" placeholder="Enter Slug" id="edit_sub_category_slug" name="sub_category_slug"  />
            </div>
            <div class="col-sm-6">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" id="sub_category_meta_title" name="sub_category_meta_title" required />
            </div>
          </div>
      
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" id="sub_category_meta_description" name="sub_category_meta_description" required /></textarea>
            </div>
          <div class="col-sm-6">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Keywords" id="sub_category_keywords" name="sub_category_keywords" required></textarea>
            </div>
          </div>
      
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Sub Category</button>
            </div>
          </div>

          <input type="hidden" id="sub_category_id" name="sub_category_id" value="" />
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="delete-sub-category" class="delete-sub-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Sub Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_sub_category" name="delete_sub_category">
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

    $("#create_sub_category").validate({
      rules: {
        // sub_sub_category_slug: 'restrict_special_chars'
        sub_category_slug: {
          restrict_special_chars:true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('admin.sub-category.store')); ?>",
          method: "POST",
          data: $("#create_sub_category").serialize(),
          beforeSend:function() {
            $(".btn-add").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $("#add-sub-category").modal('hide');
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


    $("#update_sub_category").validate({
      rules: {
        // sub_sub_category_slug: 'restrict_special_chars'
        sub_category_slug: {
          restrict_special_chars:true
        }
      },
      submitHandler:function() {
        var id = $('#sub_category_id').val();
        $.ajax({
          method: "PATCH",
          url: "<?php echo e(url('master/sub-category')); ?>/"+id,
          data: $("#update_sub_category").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".update_sub_category_modal").modal('hide');
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
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });
});



  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);

      var id = $("#delete_sub_category #id").val();
      var route = "<?php echo e(route('admin.sub-category.destroy', ':id')); ?>";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_sub_category").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-sub-category").modal('hide');
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
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
  });


function fetchData(id){

  var route = "<?php echo e(route('admin.sub-category.show', ':id')); ?>";
  var route = route.replace(':id', id);

        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function function_name(argument) {
            document.getElementById('new_loader').style.display = 'block';
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              $(".update_sub_category_modal #category_id").val(response.data.SubCategory.category_id);
              $(".update_sub_category_modal #sub_category_id").val(response.data.SubCategory.id)
              $(".update_sub_category_modal #sub_category_name").val(response.data.SubCategory.sub_category_name)
              $(".update_sub_category_modal #edit_sub_category_slug").val(response.data.SubCategory.sub_category_slug)
              $(".update_sub_category_modal #sub_category_meta_title").val(response.data.SubCategory.sub_category_meta_title)
              $(".update_sub_category_modal #sub_category_meta_description").val(response.data.SubCategory.sub_category_meta_description)
              $(".update_sub_category_modal #sub_category_keywords").val(response.data.SubCategory.sub_category_keywords)
              $(".update_sub_category_modal #sub_category_keywords").val(response.data.SubCategory.sub_category_keywords)
              $(".update_sub_category_modal").modal('show');
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
            document.getElementById('new_loader').style.display = 'none';
          },
          error: function(response) {
            toastr.error('An error occured');
            document.getElementById('new_loader').style.display = 'none';
          }
        });
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-new/resources/views/admin/sub_categories/index.blade.php ENDPATH**/ ?>