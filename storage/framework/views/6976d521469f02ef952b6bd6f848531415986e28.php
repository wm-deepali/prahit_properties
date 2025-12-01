

<?php $__env->startSection('title'); ?>
  Manage Business Listings
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
            <h3 class="content-header-title">Web Directory</h3>
            <a class="btn btn-primary btn-save" href="<?php echo e(route('admin.business-listing.create')); ?>">
              <i class="fas fa-plus"></i> Add New Business
            </a>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Manage Business Listings</li>
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

                <div class="card-body">
                  <div class="card-block">

                    
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#published" role="tab">Published</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#unpublished" role="tab">Unpublished</a>
                      </li>
                    </ul>

                    <div class="tab-content mt-3">
                      
                      <div class="tab-pane fade show active" id="published" role="tabpanel">
                        <div class="table-responsive">
                          <table class="table table-bordered table-fitems">
                            <thead>
                              <tr>
                                <th>Sr. No.</th>
                                <th>Date & Time</th>
                                <th>Business Name</th>
                                <th>Contact Detail</th>
                                <th>Membership Type</th>
                                <th>Category Info</th>
                                <th>Property Category</th>
                                <th>Property Subcategory</th>
                                <th>Property Types</th>
                                <th>Total Views</th>
                                <th>Total Enquiries</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(isset($publishedBusinesses) && count($publishedBusinesses) > 0): ?>
                                <?php $__currentLoopData = $publishedBusinesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php echo $__env->make('admin.business-listing.business-table', ['b' => $b, 'c' => $c], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="13" class="text-center">No records found</td>
                                </tr>
                              <?php endif; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      
                      <div class="tab-pane fade" id="unpublished" role="tabpanel">
                        <div class="table-responsive">
                          <table class="table table-bordered table-fitems">
                            <thead>
                              <tr>
                                <th>Sr. No.</th>
                                <th>Date & Time</th>
                                <th>Business Name</th>
                                <th>Contact Detail</th>
                                <th>Membership Type</th>
                                <th>Category Info</th>
                                <th>Property Category</th>
                                <th>Property Subcategory</th>
                                <th>Property Types</th>
                                <th>Total Views</th>
                                <th>Total Enquiries</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(isset($unpublishedBusinesses) && count($unpublishedBusinesses) > 0): ?>
                                <?php $__currentLoopData = $unpublishedBusinesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php echo $__env->make('admin.business-listing.business-table', ['b' => $b, 'c' => $c], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="13" class="text-center">No records found</td>
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
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <div class="modal" id="delete-business">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
        </center>

        <div class="modal-header">
          <h4 class="modal-title">Delete Business</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form id="delete_business" name="delete_business">
            <div class="form-group row">
              <center>Are you sure you want to delete this?</center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="id" />
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

   $(".btn-delete").on('click', function (e) {
    e.preventDefault();
    $(".loading_2").show();
    $(".btn-delete").prop('disabled', true);

    var id = $("#delete_business #id").val();

    $.ajax({
        url: '<?php echo e(route("admin.business-listing.ajaxDelete", ":id")); ?>'.replace(':id', id),
        type: 'POST',
        data: {
            _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function(response) {
            if (response.status === 200) {
                toastr.success(response.message);
                $("#delete-business").modal('hide');
                $("#" + id).remove();
            } else {
                toastr.error(response.message);
            }
        },
        error: function() {
            toastr.error('An error occurred.');
        },
        complete: function() {
            $(".loading_2").hide();
            $(".btn-delete").prop('disabled', false);
        }
    });
});

    // Toggle business status
    $(".btn-toggle-status").on('click', function (e) {
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var status = btn.data('status');

        $.ajax({
            url: '<?php echo e(route("admin.business-listing.toggleStatus", ":id")); ?>'.replace(':id', id), // Custom POST route
            method: "POST",
            data: {
                is_published: status,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                    location.reload(); // reload table
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/business-listing/index.blade.php ENDPATH**/ ?>