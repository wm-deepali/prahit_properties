

<?php $__env->startSection('title'); ?>
Edit Form
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style type="text/css">
/*.table-fitems tbody tr td:nth-child(2) {
    width: 60%;
}*/
.checkbox{
  pointer-events: none !important;
}

</style>
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
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Edit Form</li>
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
              <form method="post" action="" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-sm-4">
                    <input type="hidden" id="id" value="<?php echo e($data->id); ?>">
                    <label class="label-control">Form Name</label>
                    <input type="text" class="text-control" placeholder="Enter Form Name" name="form_name" id="form_name" value="<?php echo e($data->name); ?>" required />
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Assign to Property Available For:</label>
                    <div class="d-block">
                      <select class="form-control" name="assigned_to[]" id="category_data" onchange="loadSubcategories();">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($v->id); ?>" <?php if(in_array($v->id, explode(',', $data->category_id))): ?>
                            selected
                            <?php endif; ?>><?php echo e($v->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                      </select>
                    
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Cateogry:</label>
                    <div class="d-block">
                      <select class="text-control populate_subcategories" onchange="check_availability()" name="sub_category_id" id="sub_category_ids">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($v->id); ?>" <?php if(in_array($v->id, explode(',', $data->sub_category_id))): ?>
                            selected
                            <?php endif; ?>><?php echo e($v->sub_category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <i class="fa fa-info-circle"></i> 
                            Click on or drag and drop components onto the main panel to build your form content.
                        </div>

                        <div id="build-wrap" class="fb-editor"></div>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <div class="btn-wrap"><button class="btn btn-primary btn-add"  type="button" id="getData">Update Form</button></div>
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
<script type="text/javascript">

</script>
<input type="hidden" id="json_data" value="<?php echo e($data->form_data); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>
   jQuery(function($) {
      var json_data = $('#json_data').val();
      var fbEditor = document.getElementById('build-wrap');
      var formBuilder = $(fbEditor).formBuilder();
      
      var formData = json_data;
      formBuilder.promise.then(function(fb) {
        console.log(formData);
        formBuilder.actions.setData(formData);
      });

        document.getElementById("getData").addEventListener("click", function() {
          var id = $('#id').val();
          var form_name = $('#form_name').val();
          var category_data = $('#category_data').val();
          var sub_category_ids = $('#sub_category_ids').val();
          if(id == '') {
            swal('', 'Something Happned Wrong', 'error');
            return false;
          }
          if(form_name == '') {
            swal('', 'Form name field must be required', 'warning');
            return false;
          }
          if(category_data == '') {
            swal('', 'Cateogry field must be required', 'warning');
            return false;
          }
          var form_json = formBuilder.formData;
          console.log(form_json);
          if(form_json == null) {
            swal('', 'Invalid Form Formate, Please Refresh Page & Create Agian.', 'error');
            return false;
          }
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '<?php echo e(url('master/custom/form/update')); ?>',
            method: "POST",
            data: {
              "_token": "<?php echo e(csrf_token()); ?>",
              'id'            : id,
              'name'          : form_name,
              'categories'    : category_data,
              'subcategories' : sub_category_ids,
              'form_data'     : form_json
            },
            success: function(response) {
              var response = JSON.parse(response);
              if(response.status === 200) {
                toastr.success(response.message)
                setTimeout(function() {
                   window.location = "<?php echo e(route('admin.formtype.index')); ?>"
                }, 2000);
              } else if (response.status === 500) {
                toastr.error(response.message)
              }
              },
            error: function(response) {
              toastr.error('An error occured.')
            },
            complete: function() {
              $(".loading_2").css('display', 'none');
              $(".btn-delete").attr('disabled', false);
            }
          })
        });
      });
  
  function loadSubcategories() {
    var sel_category_ids= $('#category_data').val();

    if(sel_category_ids.length<1) {
      $('.populate_subcategories').empty().append('<option value="">Select</option>');
      return true;
    }

    var route = "<?php echo e(route('admin.sub_category.fetch_multiple_subcategories_by_cat_id')); ?>/?id="+sel_category_ids;

    $.ajax({
      url: route,
      method:"GET",
      beforeSend:function() {
        $(".loading").css('display','block');
        $(".categories").attr('disabled', true);
              // $(".populate_subcategories option").each(function(x,y) {
              //   if(!y.value.includes(sel_category_ids)) {
              //     $(this).remove();
              //   }
              // });
      },
      success: function(response) {
        var response = JSON.parse(response);
        if(response.status === 200) {
              // $(".populate_subcategories option").empty();

          var subcategories = response.data.SubCategory;
            if(subcategories.length>0) {
              $(".populate_subcategories").empty().append("<option value=''> Select </option>");
              $.each(subcategories, function(x,y) {
                $(".populate_subcategories").append(
                  `<option value=${y.id}> ${y.sub_category_name} </option>`
                );
              });
              // $(".populate_subcategories option[value='']").remove();
            } else {
              $(".populate_subcategories").empty();
                  $(".populate_subcategories").append(
                    `<option value=''> No record found </option>`
                  );
            }
        } else {
          toastr.error('An error occured');
        }
      },
      error:function(response) {
        toastr.error('An error occured');
      },
      complete:function() {
        $(".loading").css('display','none');
        $(".categories").attr('disabled', false);
      }
    })
}

function check_availability() { 

  var cats_id = $(".categories:checkbox:checked").map(function(x,y) {
    return y.value
  }).toArray();

  var sub_cats_id = $(".populate_subcategories option:selected").map(function(x,y) {
    if(y.value) return y.value
  }).toArray();

  if(cats_id.length < 1 || sub_cats_id.length < 1) return true;

  var route = "<?php echo e(route('admin.category_to_formtype_availablity', ['cat_id' => ':cat_id', 'sub_cat_id' => ':sub_cat_id'])); ?>";
  var route = route.replace(':cat_id', cats_id);
  var route = route.replace(':sub_cat_id', sub_cats_id);

  $.ajax({
    url:route,
    method: 'get',
    success:function(response) {
      var response = JSON.parse(response);
      if(response.status === 400) {
        toastr.error(response.message)
        $(".btn-add").attr('disabled', true);
      } else {
        $(".btn-add").attr('disabled', false);
      }
    },
    error:function(response) {
      toastr.error('An error occured.')
    }
  })

}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/formtype/form_edit.blade.php ENDPATH**/ ?>