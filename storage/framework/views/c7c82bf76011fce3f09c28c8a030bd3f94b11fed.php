<script src="<?php echo e(url('/').'/public/backend/js/jquery.js'); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/').'/public/backend/js/poppers.js'); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/').'/public/backend/js/bootstrap-4.js'); ?>" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>


<script src="<?php echo e(URL('public/js/toastr.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script src="<?php echo e(URL('public/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(URL('public/js/additional-methods.min.js')); ?>"></script>

<script src="<?php echo e(url('public/backend/js/custom.js')); ?>" type="text/javascript"></script>

<script type="text/javascript">
     toastr.options = {
        "closeButton": true,
        // "debug": false,
        // "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };  
    
    document.getElementById('new_loader').style.display = 'none';
</script>

<!-- toastr message -->
<?php $__currentLoopData = ['error','warning','success','info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(Session::has('alert-'.$key)): ?>
        <script>
            $(document).ready(function() {
                toastr.<?php echo e($key); ?>('<?php echo e(Session::get('alert-'.$key)); ?>');
            })
        </script>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/layouts/app_js.blade.php ENDPATH**/ ?>