

<?php $__env->startSection('title'); ?>
Edit Price Label
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
            <li class="breadcrumb-item active">Edit Price Label</li>
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
        <div class="main-card mb-3 card">
          <div class="card-header">Edit Price Label</div>
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="<?php echo e(route('admin.price-labels.update', $priceLabel->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Label Name</label>
                            <input type="text" class="form-control" placeholder="Enter Label Name" name="label_name" value="<?php echo e($priceLabel->name); ?>" required>
                        </div> 
                        <div class="col-md-6">
                            <label class="label-control">Input Type</label>
                            <select class="form-control" name="input_type" required>
                                <option value="">Select Input Type</option>
                                <option value="dropdown" <?php echo e($priceLabel->input_format == 'dropdown' ? 'selected' : ''); ?>>Dropdown</option>
                                <option value="checkbox" <?php echo e($priceLabel->input_format == 'checkbox' ? 'selected' : ''); ?>>Checkbox</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Requires Second Input?</label>
                            <select class="form-control" name="second_input" id="second_input">
                                <option value="no" <?php echo e($priceLabel->second_input == 0 ? 'selected' : ''); ?>>No</option>
                                <option value="yes" <?php echo e($priceLabel->second_input == 1 ? 'selected' : ''); ?>>Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="second_input_label_div" style="display: <?php echo e($priceLabel->second_input == 1 ? 'block' : 'none'); ?>;">
                            <label class="label-control">Second Input Label</label>
                            <input type="text" class="form-control" placeholder="Enter Second Input Label" name="second_input_label" value="<?php echo e($priceLabel->second_input_label); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Price Label</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    // Show/hide second input label based on selection
    document.getElementById('second_input').addEventListener('change', function() {
        let div = document.getElementById('second_input_label_div');
        if(this.value == '1'){
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/price-label/edit.blade.php ENDPATH**/ ?>