

<?php $__env->startSection('title'); ?>
Manage Email Settings
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
          <h3 class="content-header-title">General Setting</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Email API</li>
            <li class="breadcrumb-item active">Manage Email Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content-main-body">
  <div class="container-fluid">
    <?php if(count($errors) > 0 ): ?>
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
                  <form method="post" action="<?php echo e(route('admin.email-integration.update', $email_settings->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                      <h4 class="form-section-h">Manage Settings</h4>
                      <div class="row">
                          <div class="col-sm-4">
                              <label>MAIL DRIVER</label>
                              <input type="text" name="driver" class="form-control" value="<?php echo e($email_settings->driver); ?>" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL HOST</label>
                              <input type="text" name="host" class="form-control" value="<?php echo e($email_settings->host); ?>" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL PORT</label>
                              <input type="text" name="port" class="form-control" value="<?php echo e($email_settings->port); ?>" required="">
                          </div>
                      </div>
                      <div class="row" style="margin-top: 20px;">
                          <div class="col-sm-4">
                              <label>MAIL USERNAME</label>
                              <input type="text" name="username" class="form-control" value="<?php echo e($email_settings->user_name); ?>" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL PASSWORD</label>
                              <input type="text" name="password" class="form-control" value="<?php echo e($email_settings->password); ?>" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL ENCRYPTION</label>
                              <input type="text" name="encryption" class="form-control" value="<?php echo e($email_settings->encryption); ?>" required="">
                          </div>
                      </div>
                      <div class="row" style="margin-top: 20px;">
                          <div class="col-sm-4">
                              <label>MAIL FROM ADDRESS</label>
                              <input type="text" name="from_address" class="form-control" value="<?php echo e($email_settings->form_address); ?>" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL FROM NAME</label>
                              <input type="text" name="from_name" class="form-control" value="<?php echo e($email_settings->form_name); ?>" required="">
                          </div>
                      </div>
                      <div class="form-group row" style="margin-top: 20px;">
                          <div class="col-sm-12 text-center">
                              <button type="submit" class="btn btn-dark">Update Settings</button>
                          </div>
                      </div>
                  </form>
                </div>
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
$(function() {
    $("#email_integration_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('admin.email-integration.update', '1')); ?>",
          method: "PATCH",
          data: $("#email_integration_form").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
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
            // console.log(response)
            toastr.error('An error occured');
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });

});



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/email_integration/index.blade.php ENDPATH**/ ?>