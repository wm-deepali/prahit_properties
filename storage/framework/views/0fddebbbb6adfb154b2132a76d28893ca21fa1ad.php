

<?php $__env->startSection('title'); ?>
View Form
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
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">View Form</li>
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
            <div class="card-block" id="fb-render">
            </div>
          </div>
        </div>
      </div>
      <center><a href="<?php echo e(url('master/formtype')); ?>"><button type="button" class="btn btn-info">Back</button></a></center>
    </div>
  </div>
</section>
<input type="hidden" name="save_json" id="save_json" value="<?php echo e($data->form_data); ?>">ce
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<script type="text/javascript">
  $(function() {
    document.getElementById('fb-render').innerHTML = '';
    var formData = $('#save_json').val();
    var formRenderOptions = {formData};
    frInstance = $('#fb-render').formRender(formRenderOptions);
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/formtype/view.blade.php ENDPATH**/ ?>