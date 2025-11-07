

<?php $__env->startSection('title'); ?>
  Manage Business Enquiries
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
            <h3 class="content-header-title">Business Enquiries</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Manage Enquiries</li>
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
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>Business Detail</th>
                        <th>Enquirer Detail</th>
                        <th>Message</th>
                        <th>Added By (User)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($enquiries->count() > 0): ?>
                        <?php $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr id="enquiry-<?php echo e($enquiry->id); ?>">
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($enquiry->created_at->format('d M Y, h:i A')); ?></td>
                             <td>
                              <?php echo e($enquiry->business->business_name ?? 'N/A'); ?><br>
                              <?php echo e($enquiry->business->category->category_name  ?? ''); ?><br>
                              <?php echo e($enquiry->business->subCategories->pluck('sub_category_name')->implode(', ')  ?? ''); ?>

                            </td>
                             <td>
                              <?php echo e($enquiry->name ?? 'N/A'); ?><br>
                              <?php echo e($enquiry->email ?? 'N/A'); ?><br>
                              <?php echo e($enquiry->mobile ?? 'N/A'); ?>

                            </td>
                            <td><?php echo e(Str::limit($enquiry->message, 60)); ?></td>
                            <td><?php echo e($enquiry->user->firstname ?? 'Guest'); ?> <?php echo e($enquiry->user->lastname ?? ''); ?></td>
                            <td>
                              <button class="btn btn-danger btn-sm btn-delete-enquiry" data-id="<?php echo e($enquiry->id); ?>">
                                <i class="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="9" class="text-center">No enquiries found</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <div class="mt-3">
                  <?php echo e($enquiries->links('pagination::bootstrap-4')); ?>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <div class="modal" id="delete-enquiry">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
        </center>

        <div class="modal-header">
          <h4 class="modal-title">Delete Enquiry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form id="delete_enquiry_form">
            <div class="form-group row">
              <center>Are you sure you want to delete this enquiry?</center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete-confirm" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="delete_enquiry_id" />
            <?php echo e(csrf_field()); ?>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(document).ready(function() {

    // Open delete modal
    $(document).on('click', '.btn-delete-enquiry', function() {
        var id = $(this).data('id');
        $('#delete_enquiry_id').val(id);
        $('#delete-enquiry').modal('show');
    });

    // Handle delete
    $('#delete_enquiry_form').on('submit', function(e) {
        e.preventDefault();
        var id = $('#delete_enquiry_id').val();

        $.ajax({
            url: '<?php echo e(route("admin.directory-enquiries.destroy", ":id")); ?>'.replace(':id', id),
            type: "DELETE",
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                     location.reload();
                    $('#delete-enquiry').modal('hide');
                    $('#enquiry-' + id).remove();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('An error occurred.');
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/directory-enquiries/index.blade.php ENDPATH**/ ?>