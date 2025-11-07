

<?php $__env->startSection('title'); ?>
  Manage Business Listing Reviews
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
            <h3 class="content-header-title">Business Listing Reviews</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
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
                        <th>Sr. No.</th>
                        <th>Business Detail</th>
                        <th>Reviewer Detail</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Added By (User)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($reviews) && count($reviews) > 0): ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr id="review-<?php echo e($review->id); ?>">
                            <td><?php echo e($key + 1); ?></td>
                            <td>
                              <?php echo e($review->businessListing->business_name ?? 'N/A'); ?><br>
                              <?php echo e($review->businessListing->category->category_name  ?? ''); ?><br>
                              <?php echo e($review->businessListing->subCategories->pluck('sub_category_name')->implode(', ')  ?? ''); ?>

                            </td>
                            <td>
                              <?php echo e($review->name ?? 'N/A'); ?><br>
                              <?php echo e($review->email ?? 'N/A'); ?><br>
                              <?php echo e($review->phone ?? 'N/A'); ?>

                            </td>
                            <td><?php echo e($review->rating ?? 'N/A'); ?>/5</td>
                            <td><?php echo e(Str::limit($review->comment, 50)); ?></td>
                            <td><?php echo e($review->created_at ? $review->created_at->format('d M Y') : 'N/A'); ?></td>
                            <td><?php echo e($review->user->firstname ?? 'Guest'); ?> <?php echo e($review->user->lastname ?? ''); ?></td>
                            <td>
                              <button class="btn btn-info btn-sm btn-view" data-id="<?php echo e($review->id); ?>">
                                <i class="fa fa-eye"></i>
                              </button>
                              <button class="btn btn-danger btn-sm btn-delete" data-id="<?php echo e($review->id); ?>">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="9" class="text-center">No reviews found</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>

                  <div class="mt-3">
                    <?php echo e($reviews->links()); ?>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <div class="modal fade" id="viewReviewModal" tabindex="-1" role="dialog" aria-labelledby="viewReviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Review Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <label><strong>Business Name:</strong></label>
              <p class="business_name"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Reviewer Name:</strong></label>
              <p class="reviewer_name"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Email:</strong></label>
              <p class="review_email"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Phone:</strong></label>
              <p class="review_phone"></p>
            </div>
            <div class="col-sm-12">
              <label><strong>Rating:</strong></label>
              <p class="review_rating"></p>
            </div>
            <div class="col-sm-12">
              <label><strong>Comment:</strong></label>
              <p class="review_comment"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to delete this review?</p>
          <button type="button" class="btn btn-danger btn-confirm-delete">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" id="delete_review_id" />
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
    $(document).ready(function () {

      // Open View Modal
      $(".btn-view").on('click', function () {
        var id = $(this).data('id');
        $.ajax({
          url: '<?php echo e(route("admin.business-listing-reviews.show", ":id")); ?>'.replace(':id', id),
          method: 'GET',
          beforeSend: function () { $(".loading").show(); },
          success: function (response) {
            $(".loading").hide();
            $(".business_name").text(response.data.business_listing?.business_name ?? 'N/A');
            $(".reviewer_name").text(response.data.name ?? 'N/A');
            $(".review_email").text(response.data.email ?? 'N/A');
            $(".review_phone").text(response.data.phone ?? 'N/A');
            $(".review_rating").text(response.data.rating + '/5');
            $(".review_comment").text(response.data.comment ?? 'N/A');
            $("#viewReviewModal").modal('show');
          },
          error: function () {
            $(".loading").hide();
            toastr.error("Unable to fetch review details.");
          }
        });
      });

      // Open Delete Modal
      $(".btn-delete").on('click', function () {
        var id = $(this).data('id');
        $("#delete_review_id").val(id);
        $("#deleteReviewModal").modal('show');
      });

      // Confirm Delete
      $(".btn-confirm-delete").on('click', function () {
        var id = $("#delete_review_id").val();

        $.ajax({
          url: '<?php echo e(route("admin.business-listing-reviews.destroy", ":id")); ?>'.replace(':id', id),
          method: 'POST',
          data: { _token: '<?php echo e(csrf_token()); ?>', _method: 'DELETE' },
          success: function (response) {
            if (response.status === 200) {
              toastr.success(response.message);
              location.reload();
              $("#deleteReviewModal").modal('hide');
              $("#review-" + id).remove();
            } else {
              toastr.error(response.message);
            }
          },
          error: function () {
            toastr.error('An error occurred while deleting the review.');
          }
        });
      });

    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/business-listing-reviews/index.blade.php ENDPATH**/ ?>