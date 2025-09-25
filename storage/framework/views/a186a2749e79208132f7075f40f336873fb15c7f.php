<?php $__env->startSection('title'); ?>
Manage Payment Gateway
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
            <li class="breadcrumb-item">Payment Gateway</li>
            <li class="breadcrumb-item active">Manage Payment Gateway</li>
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
                      <th>Payment Gateway</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($payment_gateway)): ?>
                      <tr>
                        <td>1</td>
                        <td><?php echo e($payment_gateway->merchant); ?></td>
                        <td>Active</td>
                        <td>
                          <ul class="action">
                            <li><a href="#" data-target="#edit-pg" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a></li>
                            <li><a href="#"><i class="fas fa-times"></i></a></li>
                            <li><a href="#"><i class="fas fa-trash"></i></a></li>
                          </ul>
                        </td>
                      </tr>
                    <?php else: ?>
                      <tr>
                        <td colspan="4"> No records found </td>
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

<div class="modal" id="edit-pg">
  <div class="modal-dialog">
    <div class="modal-content">

      <center>
                  <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Payment Gateway</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


        <!-- Modal body -->
        <div class="modal-body">
          <form id="payment_gateway_form" name="payment_gateway_form">
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">Mode</label>
                <select class="text-control" name="mode" required >
                  <option value="">Select Mode</option>
                  <option value="1" <?php echo e($payment_gateway->mode == "1" ? "selected" : ""); ?>>Live</option>
                  <option value="0" <?php echo e($payment_gateway->mode == "0" ? "selected" : ""); ?>>Sandbox</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="label-control">Auth Header</label>
                <input type="text" class="text-control" name="auth_header" placeholder="Enter Auth Header" value="<?php echo e($payment_gateway->auth_header); ?>" required />
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">Merchant Key</label>
                <input type="text" class="text-control" name="merchant_key" placeholder="Enter Merchant Key" value="<?php echo e($payment_gateway->merchant_key); ?>" required />
              </div>
              <div class="col-sm-6">
                <label class="label-control">Merchant Salt</label>
                <input type="text" class="text-control" name="merchant_salt" placeholder="Enter Merchant Salt" value="<?php echo e($payment_gateway->merchant_salt); ?>" required />
              </div>
            </div>
            
            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-update" type="submit">Update</button>
              </div>
            </div>
            <?php echo csrf_field(); ?>
          </form>
        </div>


    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<script type="text/javascript">
$(function() {
    $("#payment_gateway_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('admin.payment-gateway.update', '1')); ?>",
          method: "PATCH",
          data: $("#payment_gateway_form").serialize(),
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-new/resources/views/admin/payment_gateway/index.blade.php ENDPATH**/ ?>