<?php $__env->startSection('title'); ?>
	<title>Job Details</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Job Details</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Job Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="job-detail-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="job-heading">
					<h3><?php echo e($job->heading); ?></h3>
					<div class="job-category">
						<span><i class="fas fa-map-marker"></i> <?php echo e($job->state); ?>, <?php echo e($job->getCountry->name); ?></span>
					</div>
				</div>
				
				<div class="job-content">
					<p><?php echo $job->description; ?></p>
				</div>
				
				<div class="job-skills">
					<h3 class="h-heading">Skills</h3>
					<div class="skill-sets">
						<ul>
							<?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($skill->name); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
				
				<div class="job-tags">
					<h3 class="h-heading">Requirements</h3>
					<div class="tags-sets">
						<?php echo $job->requirements; ?>

					</div>
				</div>
				
				<div class="job-apply">
					<button class="btn btn-applyjob" type="button" data-target="#applyjob" data-toggle="modal" type="button">Apply For this Job</button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="job-apply-w100">
					<button class="btn btn-applyjob" data-target="#applyjob" data-toggle="modal" type="button">Apply For this Job</button>
				</div>
				
				<!-- <div class="share-job">
					<h3 class="h-heading">Share this Job</h3>
				</div> -->
				
				<div class="similar-job">
					<h3 class="h-heading">Similar Jobs</h3>
					<ul>
						<?php $__currentLoopData = $related_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li>
							<div class="position-main">
								<a href="<?php echo e(route('front.jobdetail', $related_job->id)); ?>">
									<?php echo e($related_job->heading); ?> <span><?php echo e($related_job->tag_line); ?></span>
								</a>
							</div>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade custom-modal" id="applyjob" tabindex="-1" role="dialog" aria-labelledby="applynow" aria-hidden="true">
	<div class="modal-dialog w-450" role="document">
		<div class="modal-content">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
		
			<div class="top-design">
				<img src="<?php echo e(asset('')); ?>/images/top-designs.png" class="img-fluid">
			</div>
			<div class="modal-body">
				<div class="modal-main">
					<div class="row login-heads">
						<div class="col-sm-12">
							<h3 class="heads-login">Apply Now</h3>
							<span class="allrequired">All field are required</span>
						</div>
					</div>
					<div class="modal-form">
						<form method="post" action="<?php echo e(route('front.sendJobRequest')); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Name</label>
									<input type="text" class="text-control" name="name" placeholder="Enter Name" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Email</label>
									<input type="text" class="text-control" name="email" placeholder="Enter Email" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Mobile No.</label>
									<input type="text" class="text-control" name="mobile_number" placeholder="Enter Mobile No." required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Applying For</label>
									<input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
									<input type="text" class="text-control" name="apply_for" value="<?php echo e($job->heading); ?>" readonly="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Attach CV/Resume</label>
									<input type="file" name="file" class="text-control" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12 text-center">
									<button type="submit" class="btn btn-send w-100">Apply Now <i class="fas fa-chevron-circle-right"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/job-detail.blade.php ENDPATH**/ ?>