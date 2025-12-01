
<?php $__env->startSection('title'); ?>
  Callback Requests
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="content-header">
          <h3 class="content-header-title">Callback Requests</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Callback Requests</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-main-body">
  <div class="container-fluid">
    <?php if(session('success')): ?>
      <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems" id="callback_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date & Time</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($k + 1); ?></td>
                      <td><?php echo e(\Carbon\Carbon::parse($req->created_at)->timezone('Asia/Kolkata')->format('d.m.Y h:i A')); ?></td>
                      <td><?php echo e($req->name); ?></td>
                      <td><?php echo e($req->email); ?></td>
                      <td><?php echo e($req->mobile_number); ?></td>
                      <td><?php echo e($req->message); ?></td>
                      <td>
                        <a href="javascript:void(0);" onclick="deleteRequest('<?php echo e($req->id); ?>')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                      <td colspan="7">No callback requests found</td>
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
<script>
function deleteRequest(id) {
  swal.fire({
    title: "Are you sure?",
    text: "Delete this callback request?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '<?php echo e(url("master/callback-requests")); ?>/' + id,
        type: 'POST',
        data: {_token: '<?php echo e(csrf_token()); ?>'},
        success: function(res) {
          toastr.success('Request deleted successfully');
          location.reload();
        },
        error: function(err) {
          toastr.error('Something went wrong');
        }
      });
    }
  });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/callback_requests/index.blade.php ENDPATH**/ ?>