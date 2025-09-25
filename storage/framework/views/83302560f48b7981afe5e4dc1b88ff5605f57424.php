

<?php $__env->startSection('title'); ?>
Manage Safety Health
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section"> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h3>Safety Health</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Safety Health</li>
					</ol>
				</nav>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="<?php echo e(route('updateAboutContent')); ?>" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Content</h4>
                                <div class="form-group row">
                   
                                    <div class="col-sm-12">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="<?php echo e($picked->heading); ?>"  />
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/manage_safety_health.blade.php ENDPATH**/ ?>