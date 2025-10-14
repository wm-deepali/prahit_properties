

<?php $__env->startSection('title'); ?>
  Web Directory Sub Category
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <style type="text/css">
    /*.table-fitems tbody tr td:nth-child(2) {
            width: 60%;
        }*/
    .checkbox {
      pointer-events: none !important;
    }
  </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <style type="text/css">
    .table-fitems tbody tr td:nth-child(2) {
      width: 60%;
    }
  </style>
  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Web Directory</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Add Web Sub Category</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content-main-body">
    <div class="container-fluid">
      <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <ul class="p-0 m-0" style="list-style: none;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <form class="form-body" method="post" action="<?php echo e(url('master/web-directory-sub-category')); ?>">
                  <?php echo csrf_field(); ?>
                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control" name="category_id" id="category_id" required="">
                        <?php if(isset($categories)): ?>
                          <option value="">Select Category</option>
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" cat-name="<?php echo e($value->category_name); ?>"> <?php echo e($value->category_name); ?>

                            </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                          <option value=""> No records found </option>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Sub Category</label>
                      <input type="text" placeholder="Enter Sub Category Name" id="sub_category_name" class="text-control"
                        onkeyup="autoFilledSlug()" name="sub_category_name" required />
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Sub Category Slug</label>
                      <input type="text" placeholder="Enter Sub Category Slug" id="sub_category_slug" class="text-control"
                        name="sub_category_slug" required />
                    </div>
                  </div>

                  <h4 class="form-section-h">Assigned To Property Category</h4>

                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="property_category_id"
                        onchange="fetch_subcategories(this.value, fetch_subsubcategories)" required="">
                        <?php if(count($category) < 1): ?>
                          <option value="">No records found</option>
                        <?php else: ?>
                          <option value="">Select Category</option>
                          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Property Category</label>
                      <select class="text-control populate_subcategories" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value)" required>
                        <option value="">Select Sub Category</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Property Type</label>
                      <div id="sub_sub_category_list" class="border rounded p-2"
                        style="max-height: 200px; overflow-y: auto;">
                        <p class="text-muted m-0">Select a property subcategory first</p>
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-primary" type="submit">Add Sub Category</button>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    $(function () {
      $("#add_form_types").validate({
        submitHandler: function () {
          var sel_category_ids = [];
          $('.categories:checkbox:checked').each(function (i) {
            sel_category_ids[i] = $(this).val();
          });

          if (sel_category_ids.length < 1) {
            $('.populate_subcategories').empty().append('<option value="">Select</option>');
          }

          $.ajax({
            url: "<?php echo e(route('admin.formtype.store')); ?>",
            method: "POST",
            data: $("#add_form_types").serialize(),
            beforeSend: function () {
              $(".loading").css('display', 'block');
              $(".btn-add").attr('disabled', true);
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                // setTimeout(function() {
                //   window.location.href = "<?php echo e(route('admin.formtype.index')); ?>";
                // }, 1000);
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              toastr.error('An error occured')
            },
            complete: function () {
              $(".loading").css('display', 'none');
              $(".btn-add").attr('disabled', false);
            }
          })
        }
      });

      $(".text").on('keyup', function () {
        var this_val = $(this).val();
        if (this_val != "") {
          $(this).parents('.tr:first').find('input:checkbox').attr("checked", "checked");
        } else {
          $(this).parents('.tr:first').find('input:checkbox').attr("checked", false);
        }
      });

    });


    function loadSubcategories() {

      var sel_category_ids = [];
      $('.categories:checkbox:checked').each(function (i) {
        sel_category_ids[i] = $(this).val();
      });

      if (sel_category_ids.length < 1) {
        $('.populate_subcategories').empty().append('<option value="">Select</option>');
        return true;
      }

      var route = "<?php echo e(route('admin.sub_category.fetch_multiple_subcategories_by_cat_id')); ?>/?id=" + sel_category_ids.join(',');

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function () {
          $(".loading").css('display', 'block');
          $(".categories").attr('disabled', true);
          // $(".populate_subcategories option").each(function(x,y) {
          //   if(!y.value.includes(sel_category_ids)) {
          //     $(this).remove();
          //   }
          // });
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            // $(".populate_subcategories option").empty();

            var subcategories = response.data.SubCategory;
            if (subcategories.length > 0) {
              $(".populate_subcategories").empty().append("<option value=''> Select </option>");
              $.each(subcategories, function (x, y) {
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
        error: function (response) {
          toastr.error('An error occured');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          $(".categories").attr('disabled', false);
        }
      })
    }


    function fetch_subcategories(id, callback) {
      var route = "<?php echo e(config('app.api_url')); ?>/fetch_subcategories_by_cat_id/" + id
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
          if (response.responseCode === 200) {
            $(".populate_subcategories").empty();
            var subcategories = response.data.SubCategory;
            if (subcategories.length > 0) {
              $(".populate_subcategories").append(
                `<option value=""> Select </option>`
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

    function fetch_subsubcategories(id, callback) {
      var route = "<?php echo e(config('app.api_url')); ?>/fetch_subsubcategories_by_subcat_id/" + id
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
          if (response.responseCode === 200) {
            $(".populate_subsubcategories").empty();
            var subcategories = response.data.SubSubCategory;
            if (subcategories.length > 0) {
              $(".populate_subsubcategories").append(
                `<option value=""> Select </option>`
              );
              $.each(subcategories, function (x, y) {
                $(".populate_subsubcategories").append(
                  `<option value=${y.id}> ${y.sub_sub_category_name} </option>`
                );
              });
            } else {
              $(".populate_subsubcategories").append(
                `<option value=''> Please add a sub sub category </option>`
              );
            }
            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching subsubcategories');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          // $(".addproperty").attr('disabled', false);
        }
      })
    }

    function fetch_subsubcategories(id, callback) {
      var route = "<?php echo e(config('app.api_url')); ?>/fetch_subsubcategories_by_subcat_id/" + id;

      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".loading").css('display', 'block');
          $("#sub_sub_category_list").html('<p class="text-muted m-0">Loading...</p>');
        },
        success: function (response) {
          if (response.responseCode === 200) {
            var container = $("#sub_sub_category_list");
            container.empty();

            var subcategories = response.data.SubSubCategory;
            if (subcategories.length > 0) {
              $.each(subcategories, function (index, item) {
                container.append(`
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="sub_sub_category_ids[]" 
                           value="${item.id}" 
                           id="subsub_${item.id}">
                    <label class="form-check-label" for="subsub_${item.id}">
                      ${item.sub_sub_category_name}
                    </label>
                  </div>
                `);
              });
            } else {
              container.html('<p class="text-muted m-0">No Sub Sub Categories found</p>');
            }

            if (callback) callback();
          } else {
            $("#sub_sub_category_list").html('<p class="text-danger m-0">Error loading data</p>');
          }
        },
        error: function () {
          $("#sub_sub_category_list").html('<p class="text-danger m-0">An error occurred</p>');
        },
        complete: function () {
          $(".loading").css('display', 'none');
        }
      });
    }


    function autoFilledSlug() {
      var e = document.getElementById("category_id");
      var option = e.options[e.selectedIndex];
      var category = option.getAttribute("cat-name");
      var sub_cat_name = $('#sub_category_name').val();
      var text1 = category.split(/\s/).join('');
      var text2 = sub_cat_name.split(/\s/).join('');
      document.getElementById('sub_category_slug').value = text1.toLowerCase() + '-' + text2.toLowerCase();
      console.log(text1);
      console.log(text2);
    }

  </script>


  <?php if(count($categories) < 1): ?>
    <script type="text/javascript">
      $("#add_form_types").empty().append("<center class='m0-auto'>Please create categories to continue. </center>");  
    </script>

  <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/web_directory/sub_categories/add.blade.php ENDPATH**/ ?>