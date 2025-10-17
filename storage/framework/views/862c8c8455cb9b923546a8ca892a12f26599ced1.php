

<?php $__env->startSection('title'); ?>
Social Media
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Home Page Settings</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Home Page Settings</li>
                        <li class="breadcrumb-item active">Update Social Media</li>
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
                            <form method="post" action="<?php echo e(route('admin.updateSocialMedia')); ?>" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Links</h4>
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo e($media->id); ?>">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Facebook</label>
                                        <input type="text" class="text-control" name="facebook" value="<?php echo e($media->facebook); ?>" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Twitter</label>
                                        <input type="text" class="text-control" name="twitter" value="<?php echo e($media->twitter); ?>" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Instagram</label>
                                        <input type="text" class="text-control" name="insta" value="<?php echo e($media->insta); ?>" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Youtube</label>
                                        <input type="text" class="text-control" name="youtube" value="<?php echo e($media->youtube); ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Links</button>
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
    CKEDITOR.replace( 'description_one' );
    CKEDITOR.replace( 'description_two' );
    CKEDITOR.replace( 'description_three' );
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/manage_social_media.blade.php ENDPATH**/ ?>