

<?php $__env->startSection('title'); ?>
Manage Job Requests
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
                        <li class="breadcrumb-item">Jobs</li>
                        <li class="breadcrumb-item active">Job Requests</li>
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
                                            <th>Job Title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Resume</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr id="<?php echo e($req->id); ?>">
                                            <td><?php echo e($k+1); ?></td>
                                            <td><?php echo e($req->job->heading ?? 'N/A'); ?></td>
                                            <td><?php echo e($req->name); ?></td>
                                            <td><?php echo e($req->email); ?></td>
                                            <td><?php echo e($req->mobile_number); ?></td>

                                            <td>
                                                <a href="<?php echo e(asset('storage/'.$req->resume)); ?>" target="_blank">
                                                    View Resume
                                                </a>
                                            </td>

                                            <td><?php echo e($req->created_at->format('d M Y')); ?></td>

                                            <td>
                                                <ul class="action">
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#delete-request"
                                                           onclick="$('#delete_request #id').val(<?php echo e($req->id); ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8">No records found</td>
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



<div class="modal" id="view-details">
    <div class="modal-dialog">
        <div class="modal-content">

            <center>
                <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </center>

            <div class="modal-header">
                <h4 class="modal-title">Job Request Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p><strong>Name:</strong> <span id="view-name"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Mobile:</strong> <span id="view-mobile"></span></p>
                <p><strong>Resume:</strong> <span id="view-resume"></span></p>
            </div>

        </div>
    </div>
</div>



<div class="modal" id="delete-request">
    <div class="modal-dialog">
        <div class="modal-content">

            <center>
                <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </center>

            <div class="modal-header">
                <h4 class="modal-title">Delete Request</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form id="delete_request" name="delete_request">
                    <center>Are you sure you want to delete this?</center>

                    <div class="form-action row mt-3">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary btn-delete" type="submit">Delete</button>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id">
                    <?php echo e(csrf_field()); ?>

                </form>

            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script>
$(".btn-delete").on('click', function(e){
    e.preventDefault();
    var id = $("#delete_request #id").val();
    $(".loading").show();

    $.ajax({
        url: "<?php echo e(route('admin.deleteJobRequest')); ?>",
        method: "POST",
        data: $("#delete_request").serialize(),

        success: function(response){
            var res = JSON.parse(response);

            if(res.status == 200){
                toastr.success(res.message);
                $("#delete-request").modal("hide");
                $("#" + id).remove();
            } else {
                toastr.error(res.message);
            }
        },

        error: function(){
            toastr.error("An error occurred");
        },

        complete: function(){
            $(".loading").hide();
        }
    });
});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/job/requests.blade.php ENDPATH**/ ?>