

<?php $__env->startSection('content'); ?>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">Client Reels</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-reel">Add Reel</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Client Reels</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="reel-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Author Image</th>
                        <th>Author Name</th>
                        <th>Designation</th>
                        <th>Reel Type</th>
                        <th>Reel Preview</th>
                        <th>Created At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $reels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                            <?php if($reel->author_image): ?>
                              <img src="<?php echo e(asset('storage/' . $reel->author_image)); ?>" alt="Author Image"
                                style="height: 60px; width:60px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                              <span class="text-muted">No Image</span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($reel->author_name); ?></td>
                          <td><?php echo e($reel->designation ?? '-'); ?></td>
                          <td><?php echo e(ucfirst($reel->reel_type)); ?></td>
                          <td>
                            <?php if($reel->reel_type === 'youtube' && $reel->youtube_url): ?>
                              <a href="<?php echo e($reel->youtube_url); ?>" target="_blank">YouTube Link</a>
                            <?php elseif($reel->reel_type === 'facebook' && $reel->facebook_url): ?>
                              <a href="<?php echo e($reel->facebook_url); ?>" target="_blank">Facebook Link</a>
                            <?php elseif($reel->reel_type === 'upload' && $reel->video_file): ?>
                              <video width="120" controls>
                                <source src="<?php echo e(asset('storage/' . $reel->video_file)); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>
                            <?php else: ?>
                              <span class="text-muted">N/A</span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($reel->created_at->format('d M Y, h:i A')); ?></td>
                          <td>
                            <ul class="list-inline">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-reel"
                                  data-id="<?php echo e($reel->id); ?>">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteReel(<?php echo e($reel->id); ?>)"
                                  class="btn btn-danger btn-sm">
                                  <i class="fa fa-trash"></i>
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="modal fade" id="reel-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function () {
      // Open add reel modal
      $(document).on('click', '#add-reel', function () {
        $.get("<?php echo e(route('admin.client-reels.create')); ?>", function (result) {
          if (result.success) {
            $('#reel-modal').html(result.html).modal('show');
          }
        });
      });

      // Open edit reel modal
      $(document).on('click', '.edit-reel', function () {
        let id = $(this).data('id');
        $.get(`<?php echo e(url('admin/client-reels')); ?>/${id}/edit`, function (result) {
          if (result.success) {
            $('#reel-modal').html(result.html).modal('show');
          }
        });
      });

      // CSRF setup
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });

      // Save reel
      $(document).on('click', '#add-clientreel-btn', function () {
        let btn = $(this);
        btn.prop('disabled', true);
        $('.validation-err').text('');

        let formData = new FormData($('#reel-form')[0]);

        $.ajax({
          url: '<?php echo e(route("admin.client-reels.store")); ?>',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.success) {
              Swal.fire('Success!', response.message, 'success');
              $('#reel-modal').modal('hide');
              setTimeout(() => location.reload(), 1000);
            } else {
              Swal.fire('Error', response.message || 'Failed to save.', 'error');
            }
            btn.prop('disabled', false);
          },
          error: function (xhr) {
            btn.prop('disabled', false);
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              for (let field in errors) {
                $('#' + field + '-err').text(errors[field][0]);
              }
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          }
        });
      });

      // Update reel
      $(document).on('click', '#update-clientreel-btn', function () {
        let btn = $(this);
        btn.prop('disabled', true);
        $('.validation-err').text('');

        let formData = new FormData($('#reel-edit-form')[0]);
        formData.append('_method', 'PUT');

        let reelId = btn.data('reel-id');

        $.ajax({
          url: `/admin/client-reels/${reelId}`,
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.success) {
              Swal.fire('Success!', response.message, 'success');
              $('#reel-modal').modal('hide');
              setTimeout(() => location.reload(), 1000);
            } else {
              Swal.fire('Error', response.message || 'Failed to update.', 'error');
            }
            btn.prop('disabled', false);
          },
          error: function (xhr) {
            btn.prop('disabled', false);
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              for (let field in errors) {
                $('#' + field + '-err').text(errors[field][0]);
              }
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          }
        });
      });

      // Delete reel
      window.deleteReel = function (id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You can't reverse this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: `<?php echo e(url('admin/client-reels')); ?>/${id}`,
              type: 'DELETE',
              success: function (res) {
                if (res.success) {
                  Swal.fire('Deleted!', '', 'success');
                  setTimeout(() => location.reload(), 500);
                } else {
                  Swal.fire('Error', res.message || 'Failed to delete', 'error');
                }
              }
            });
          }
        });
      }
    });
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/client_reels/index.blade.php ENDPATH**/ ?>