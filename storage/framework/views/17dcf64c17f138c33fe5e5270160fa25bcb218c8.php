

<?php $__env->startSection('title'); ?>
  Manage Agent Reviews
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
            <h3 class="content-header-title">Agent Reviews</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Agents</li>
              <li class="breadcrumb-item active">Manage Reviews</li>
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
                        <th>Agent Name</th>
                        <th>Reviewer Detail</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Added By (User)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($reviews->count() > 0): ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr id="review-<?php echo e($review->id); ?>">
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($review->created_at->format('d M Y, h:i A')); ?></td>
                            <td>
                              <?php echo e($review->profileSection->user->firstname ?? 'N/A'); ?>

                              <?php echo e($review->profileSection->user->lastname ?? 'N/A'); ?><br>
                              <?php echo e($review->profileSection->business_name ?? ''); ?>

                            </td>
                            <td>
                              <?php echo e($review->name ?? 'N/A'); ?><br>
                              <?php echo e($review->email ?? 'N/A'); ?><br>
                              <?php echo e($review->phone ?? 'N/A'); ?>

                            </td>
                            <td>
                              <span class="badge badge-warning">
                                ★ <?php echo e(number_format($review->rating, 1)); ?>

                              </span>
                            </td>
                            <td><?php echo e(Str::limit($review->comment, 60)); ?></td>
                            <td><?php echo e($review->user->firstname ?? 'Guest'); ?> <?php echo e($review->user->lastname ?? ''); ?></td>
                            <td>
                              <button class="btn btn-danger btn-sm btn-delete-review" data-id="<?php echo e($review->id); ?>">
                                <i class="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="10" class="text-center">No reviews found</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <div class="mt-3">
                  <?php echo e($reviews->links('pagination::bootstrap-4')); ?>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <div class="modal" id="delete-review">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
        </center>

        <div class="modal-header">
          <h4 class="modal-title">Delete Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form id="delete_review_form">
            <div class="form-group row">
              <center>Are you sure you want to delete this review?</center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete-confirm" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="delete_review_id" />
            <?php echo e(csrf_field()); ?>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    $(document).ready(function () {

      // Open modal
      $(document).on('click', '.btn-delete-review', function () {
        var id = $(this).data('id');
        $('#delete_review_id').val(id);
        $('#delete-review').modal('show');
      });

      // Handle delete
      $('#delete_review_form').on('submit', function (e) {
        e.preventDefault();
        var id = $('#delete_review_id').val();

        $.ajax({
          url: '<?php echo e(route("admin.agent-profile-reviews.destroy", ":id")); ?>'.replace(':id', id),
          type: "DELETE",
          data: {
            _token: '<?php echo e(csrf_token()); ?>'
          },
          success: function (response) {
            if (response.status === 200) {
              toastr.success(response.message);
              location.reload();
              $('#delete-review').modal('hide');
              $('#review-' + id).remove();
            } else {
              toastr.error(response.message);
            }
          },
          error: function () {
            toastr.error('An error occurred.');
          }
        });
      });

    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/agent-reviews/index.blade.php ENDPATH**/ ?>