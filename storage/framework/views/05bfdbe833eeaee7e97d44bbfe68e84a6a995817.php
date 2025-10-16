

<?php $__env->startSection('title'); ?>
Manage Footer Content
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
                        <li class="breadcrumb-item">Home Page Contents</li>
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
                            <form method="post" action="<?php echo e(url('manage/front/content')); ?>/<?php echo e($banner->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                                <h4 class="form-section-h">Manage Banner Content</h4>
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="<?php echo e(asset('storage')); ?>/<?php echo e($banner->image); ?>" target="_blank"><img src="<?php echo e(asset('storage')); ?>/<?php echo e($banner->image); ?>" style="height: 50px;margin: 22px 0px 0px 47px;"></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label label-control">Update Image</label>
                                                <input type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="<?php echo e($banner->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="<?php echo e($banner->title); ?>" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section Two -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="<?php echo e(url('manage/front/content')); ?>/<?php echo e($hand_picked->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                                <h4 class="form-section-h">Manage Hand Picked Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="<?php echo e($hand_picked->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Choose Properties</label>
                                        <select name="ids[]" class="form-control selectpicker" multiple required>
                                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($property->id); ?>" <?php if(in_array($property->id, explode(',', $hand_picked->ids))): ?> selected <?php endif; ?>><?php echo e($property->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Two -->
            <!-- Section Three -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="<?php echo e(url('manage/front/content')); ?>/<?php echo e($trending->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                                <h4 class="form-section-h">Manage Trending Projects</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="<?php echo e($trending->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="<?php echo e($trending->title); ?>" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Three -->
            <!-- Section Four -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="<?php echo e(url('manage/front/content')); ?>/<?php echo e($latest_property->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                                <h4 class="form-section-h">Manage Latest Properties Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="<?php echo e($latest_property->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="<?php echo e($latest_property->title); ?>" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Four -->
            <!-- Section Five -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="<?php echo e(url('manage/front/content')); ?>/<?php echo e($featured_property->id); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                                <h4 class="form-section-h">Manage Featured Property Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="<?php echo e($featured_property->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="<?php echo e($featured_property->title); ?>" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Five -->
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/manage-front-content.blade.php ENDPATH**/ ?>