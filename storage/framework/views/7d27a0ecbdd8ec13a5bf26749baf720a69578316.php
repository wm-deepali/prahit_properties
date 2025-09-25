

<?php $__env->startSection('title'); ?>
Manage Furnishing statuses
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
          <a href="<?php echo e(route('admin.furnishing-statuses.create')); ?>">
            <button class="btn btn-primary btn-save">
              <i class="fas fa-plus"></i> Add Furnishing status
            </button>
          </a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Furnishing statuses</li>
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
                      <th>Date &amp; Time</th>
                      <th>Name</th>
                      <th>Input Format</th>
                      <th>Second Input</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($statuses) && count($statuses) > 0): ?>
                      <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($status->created_at); ?></td>
                              <td><?php echo e($status->name); ?></td>
                              <td><?php echo e(ucfirst($status->input_format)); ?></td>
                              <td>
                                <?php if($status->second_input == 'yes'): ?>
                                  Yes (<?php echo e($status->second_input_label); ?>)
                                <?php else: ?>
                                  No
                                <?php endif; ?>
                              </td>
                              <td><?php echo e(ucfirst($status->status)); ?></td>
                              <td class="text-center btn-group-sm">
                                <ul class="action">
                                  <li>
                                    <a href="<?php echo e(route('admin.furnishing-statuses.edit', $status->id)); ?>">
                                      <i class="fas fa-pencil-alt"></i>
                                    </a>
                                  </li>
                                  
                                  <li>
                                    <form action="<?php echo e(route('admin.furnishing-statuses.destroy', $status->id)); ?>" method="POST" style="display:inline;">
                                      <?php echo csrf_field(); ?>
                                      <?php echo method_field('DELETE'); ?>
                                      <button type="submit" class="btn btn-link p-0 m-0">
                                        <i class="fa fa-trash text-danger"></i>
                                      </button>
                                    </form>
                                  </li>
                                </ul>
                              </td>
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/furnishing-status/index.blade.php ENDPATH**/ ?>