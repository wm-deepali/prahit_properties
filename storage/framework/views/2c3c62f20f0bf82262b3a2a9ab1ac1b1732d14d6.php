

<?php $__env->startSection('title'); ?>
Manage Email Templates
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
          <a href="<?php echo e(route('admin.email-template.create')); ?>"><button class="btn btn-primary btn-save"><i class="fas fa-plus"></i> Add Template</button></a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Email Templates</li>
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
                      <th>Title Image</th>
                      <th>Title</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($templates) && count($templates) > 0): ?>
                      <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($template->created_at); ?></td>
                              <td>
                                <?php if(isset($template->image) && Storage::exists($template->image)): ?>
                                  <img src="<?php echo e(asset('storage')); ?>/<?php echo e($template->image); ?>" style="height: 50px;">
                                <?php else: ?>
                                  'N/A'
                                <?php endif; ?>
                              </td>
                              <td><?php echo e($template->title); ?></td>
                              <td><?php echo e($template->subject); ?></td>
                              <td><?php echo e($template->status); ?></td>
                              <td class="text-center btn-group-sm">
                                <ul class="action">
                                  <li><a href="<?php echo e(route('admin.email-template.edit', $template->id)); ?>"><i class="fas fa-pencil-alt"></i></a></li>
                                  <?php if($template->status == "active"): ?>
                                    <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($template->id); ?>')"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                                  <?php else: ?>
                                    <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($template->id); ?>')"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                                  <?php endif; ?>
                                </ul>
                              </td>
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


<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<script type="text/javascript">
  function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chaneg Status This Template.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '<?php echo e(route('admin.change-email-template-status')); ?>',
            method: "post",
            data:{
              _token:'<?php echo e(csrf_token()); ?>',
              'id'  : id
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/email_template/index.blade.php ENDPATH**/ ?>