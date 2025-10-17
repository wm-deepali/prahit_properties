

<?php $__env->startSection('title'); ?>
Update Blog
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Blog</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Update Blog</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="<?php echo e(route('admin.updateBlog')); ?>" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Blog</h4>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Blog Category</label>
                                        <select class="form-control" name="blog_category" required="">
                                            <option value="">Select Category</option>
                                            <?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($blog_category->id); ?>" <?php echo e($picked->category_id == $blog_category->id ? 'selected' : ''); ?>>
                                                    <?php echo e($blog_category->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="<?php echo e($picked->heading); ?>" required="">
                                    </div>

                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Image</label>
                                        <input type="file" class="text-control" name="image" onchange="loadFile(event)">
                                        <img src="<?php echo e(asset('storage/' . $picked->image)); ?>" id="output" style="height: 80px;">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Image Alt Text</label>
                                        <input type="text" class="text-control" name="image_alt" placeholder="Enter image alt text" value="<?php echo e($picked->image_alt); ?>" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Blog Description</label>
                                        <textarea name="description" required=""><?php echo e($picked->description); ?></textarea>
                                    </div>
                                </div>

                                <h4 class="form-section-h mt-3">SEO Meta Data</h4>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Title</label>
                                        <input type="text" class="text-control" name="meta_title" placeholder="Enter Meta Title" value="<?php echo e($picked->meta_title); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Keywords</label>
                                        <input type="text" class="text-control" name="meta_keywords" placeholder="Enter Meta Keywords" value="<?php echo e($picked->meta_keywords); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Description</label>
                                        <textarea name="meta_description" class="text-control" placeholder="Enter Meta Description"><?php echo e($picked->meta_description); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Blog</button>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?php echo e($picked->id); ?>" />
                                <?php echo csrf_field(); ?>
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
    CKEDITOR.replace('description');

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/blog/update_blog.blade.php ENDPATH**/ ?>