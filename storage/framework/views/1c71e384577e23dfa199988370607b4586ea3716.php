

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card p-4 shadow">
                <h3 class="mb-3">OTP Verification</h3>
                <form id="otp_form" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e(request()->query('user_id')); ?>">
                    <div class="mb-3">
                        <label>Enter OTP</label>
                        <input type="number" id="otp" name="otp" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>

$("#otp_form").validate({
    submitHandler: function () {
        $.ajax({
            url: "<?php echo e(route('verify_otp_ajax')); ?>",
            method: "POST",
            data: {
                _token: $('input[name="_token"]').val(),
                otp: $("#otp").val(),
                user_id: $("input[name='user_id']").val(),
                is_register: true
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);

                    // Redirect after OTP verification
                    let redirectUrl = "<?php echo e(request()->query('redirect', '/user/dashboard')); ?>";
                    window.location.href = redirectUrl;
                } else {
                    toastr.error(response.message);
                    $("#otp_form").trigger('reset');
                }
            },
            error: function () {
                toastr.error('An error occurred');
            }
        });
    }
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/otp.blade.php ENDPATH**/ ?>