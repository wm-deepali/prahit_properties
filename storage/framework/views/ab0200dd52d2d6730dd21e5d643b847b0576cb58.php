

<?php $__env->startSection('title'); ?>
Manage Enquiries
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
          <h3 class="content-header-title">Enquiries</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
            <li class="breadcrumb-item active">Support Center</li>
          </ol>
<!--       <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter" aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
 -->        </div>
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
                <table class="table table-bordered table-fitems" id="enquiries">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

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

<!-- Modal -->
<div id="admin-reply" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Reply</h3>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="post" action="<?php echo e(route('admin.replySupportQuery')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
              <label>Email</label>
              <input type="hidden" name="id" id="query-id">
              <input type="text" class="form-control" name="email" id="view-email" readonly="" required="">
            </div>
            <div class="row" style="margin-top: 20px;">
              <label>Message</label>
              <textarea class="form-control" cols="5" name="message" required=""></textarea>
            </div>
            <div class="form-action row" style="margin-top:20px;">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="admin-reply-answer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Answer</h3>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <p id="view-admin-reply"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>

<script type="text/javascript">

  //-------------------- Manage pending lead listing ----------------------//
  $(function () {
      var table = $('#enquiries').DataTable({
          processing: true,
          serverSide: true,
          render: true,
          searching: true,
          ajax: "<?php echo e(route('admin.manageSupportQueryDatatable')); ?>",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'mobile_number', name: 'mobile_number'},
              {data: 'subject', name: 'subject'},
              {data: 'message', name: 'message'},
              {data: 'action', name: 'action'}
          ],
      });
  });

  function adminReply(id) {
    $.ajax({
      url:"<?php echo e(route('admin.getSupportCenterData')); ?>",
      type: 'post',
      dataType: "json",
      data: {
         _token: '<?php echo e(csrf_token()); ?>',
         id: id
      },
      success: function( data ) {
        document.getElementById('query-id').value = data.id;
        document.getElementById('view-email').value = data.email;
        $('#admin-reply').modal('show');
      }
    });
  }

  function viewReply(id) {
    $.ajax({
      url:"<?php echo e(route('admin.getSupportCenterData')); ?>",
      type: 'post',
      dataType: "json",
      data: {
         _token: '<?php echo e(csrf_token()); ?>',
         id: id
      },
      success: function( data ) {
        document.getElementById('view-admin-reply').innerHTML = data.reply;
        $('#admin-reply-answer').modal('show');
      }
    });
  }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/enquiries/support_center.blade.php ENDPATH**/ ?>