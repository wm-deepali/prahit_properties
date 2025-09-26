

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
            <li class="breadcrumb-item active">Manage SMS API</li>
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
              <form method="post" action="<?php echo e(route('admin.update_sms_config')); ?>">
              	<input type="hidden" name="id" value="<?php echo e($smsconfig->id); ?>">
				<div class="form-group row">
					<div class="col-sm-6">
						<label class="label-control">Sender ID (6 Characters only)</label>
						<input type="text" class="text-control" name="sender_id" placeholder="Enter Sender ID" value="<?php echo e(isset($smsconfig->sender_id) ? $smsconfig->sender_id : ''); ?>" required />
					</div> 
					<div class="col-sm-6">
						<label class="label-control">Auth Key</label>
						<input type="text" class="text-control" name="hash_key" placeholder="Enter Hash Key" value="<?php echo e(isset($smsconfig->hash_key) ? $smsconfig->hash_key : ''); ?>" required />
					</div> 
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<label class="label-control">Route</label>
						<input type="text" class="text-control" name="route" placeholder="Enter Route" value="<?php echo e(isset($smsconfig->route) ? $smsconfig->route : ''); ?>" required />
					</div> 
					<div class="col-sm-6">
						<label class="label-control">Country Code</label>
						<input type="text" class="text-control" name="country_code" placeholder="Enter Country Code" value="<?php echo e(isset($smsconfig->country_code) ? $smsconfig->country_code : ''); ?>" required />
					</div> 
				</div>
				<div class="form-group row" style="margin-top: 20px;">
	                <div class="col-sm-12 text-center">
	                    <button type="submit" class="btn btn-dark">Update Settings</button>
	                </div>
	            </div>
			</div>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/sms_config/edit.blade.php ENDPATH**/ ?>