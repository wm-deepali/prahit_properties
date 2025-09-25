

<?php $__env->startSection('title'); ?>
Update Jobs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Jobs</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Jobs</li>
                        <li class="breadcrumb-item active">Update Jobs</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="<?php echo e(route('admin.updateJob')); ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo e($picked->id); ?>">
                                <h4 class="form-section-h">Post Job</h4>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Job Category</label>
                                        <select class="form-control" name="job_category" required="">
                                            <option value="">Select Category</option>
                                            <?php $__currentLoopData = $job_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($picked->category_id == $job_category->id): ?>
                                                    <option value="<?php echo e($job_category->id); ?>" selected=""><?php echo e($job_category->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($job_category->id); ?>"><?php echo e($job_category->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="<?php echo e($picked->heading); ?>" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Tag Line</label>
                                        <input type="text" class="text-control" name="tag_line" placeholder="Enter Job Tag Line"  value="<?php echo e($picked->tag_line); ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Country</label>
                                        <select class="form-control" name="country" required="">
                                            <option value="">Select Country</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($picked->country == $country->id): ?>
                                                    <option value="<?php echo e($country->id); ?>" selected=""><?php echo e($country->name); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">State</label>
                                        <input type="text" class="text-control" name="state" placeholder="Enter State" value="<?php echo e($picked->state); ?>" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">City</label>
                                        <input type="text" class="text-control" name="city" placeholder="Enter City" value="<?php echo e($picked->state); ?>" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Skills</label>
                                        <select class="form-control" name="skills[]" multiple="" required="">
                                            <?php if(count($technologies) > 0): ?>
                                                <?php $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array($technology->id, explode(',', $picked->skills))): ?>
                                                        <option value="<?php echo e($technology->id); ?>" selected=""><?php echo e($technology->name); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($technology->id); ?>"><?php echo e($technology->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <option value="">No any category found.</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Job Requirements</label>
                                        <textarea name="requirements" required=""><?php echo e($picked->requirements); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Job Description</label>
                                        <textarea name="description" required=""><?php echo e($picked->description); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Job</button>
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
    CKEDITOR.replace( 'requirements' );
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/job/edit_job.blade.php ENDPATH**/ ?>