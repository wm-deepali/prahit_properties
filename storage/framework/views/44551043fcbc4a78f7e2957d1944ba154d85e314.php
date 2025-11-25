<?php $__env->startSection('title'); ?>
	<title>Career With Us</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Career With Us</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Career With Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="career-with-us">
	<div class="career-one-part">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="career-content">
						<h2><?php echo e($picked->heading_more); ?></h2>
						<p><?php echo $picked->sub_description; ?></p>
						<a href="#open-positions">Open Positions</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="career-img">
						<img src="<?php echo e(asset('storage')); ?>/<?php echo e($picked->images); ?>" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="career-two-part">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="sec-title">
						<h2><?php echo e($picked->heading); ?></h2>
						<p><?php echo $picked->description; ?></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="open-positions">
			<div class="container">
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="open-designation">
						<h3><?php echo e($category->name); ?></h3>
						<div class="row">
							<?php $__currentLoopData = $category->getRealatedJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-sm-4">
									<div class="position-main">
										<a href="<?php echo e(route('front.jobdetail', $job->id)); ?>">
											<?php echo e($job->heading); ?> <span><?php echo e($job->tag_line); ?></span>
										</a>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/career-with-us.blade.php ENDPATH**/ ?>