

<?php $__env->startSection('title'); ?>
Manage Career With us
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">About Us</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Career With us</li>
                        <li class="breadcrumb-item active">Manage Career With us</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="<?php echo e(route('admin.updateCareerWithUsContent')); ?>" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Content</h4>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <img src="<?php echo e(asset('storage/')); ?>/<?php echo e($picked->images); ?>" id="output"  class="img-fluid" style="width: 90px;">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="file" accept="image/*" name="images" onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="label label-control">Banner Heading</label>
                                        <input type="text" class="text-control" name="banner_heading" placeholder="Enter Heading" value="<?php echo e($picked->heading_more); ?>"  />
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label label-control">Banner Description</label>
                                        <textarea name="banner_description"><?php echo e($picked->sub_description); ?></textarea>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="<?php echo e($picked->heading); ?>"  />
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label label-control">Description</label>
                                        <textarea name="description"><?php echo e($picked->description); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Content</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo e($picked->id); ?>" />
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
    CKEDITOR.replace( 'banner_description' );
    CKEDITOR.replace( 'description' );

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/manage_career_with_us.blade.php ENDPATH**/ ?>