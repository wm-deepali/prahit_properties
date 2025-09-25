
<?php $__env->startSection('title'); ?>
	<title>Welcome</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>About Us</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">About Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
 
<section class="about-us-page">
	<div class="container">
		<div class="about-one-part">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="about-one-img">
						<img src="<?php echo e(asset('storage/')); ?>/<?php echo e($about->images); ?>" class="img-fluid">
						<div class="about-shape">
							<img src="<?php echo e(asset('')); ?>/images/bg-shape.png" class="img-fluid" alt="Images">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="about-one-content">
						<div class="section-title">
							<span class="sp-span">ABOUT US</span>
							<h2><?php echo e($about->heading); ?></h2>
							<p>
								<?php echo $about->description; ?>

							</p>
						</div>
						<div class="about-btn">
							<a href="#" class="btn btn-readmore">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="about-two-part">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="about-two-content">
						<div class="section-title">
							<span class="sp-span">Our Vision &amp; Mission</span>
							<h2><?php echo e($vision->heading); ?></h2>
							<p>
								<?php echo $vision->description; ?>

							</p>
							<div class="mission-vision">
								<div class="row">
									<?php $__currentLoopData = $keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-md-6">
										<h3><?php echo e($key->heading); ?></h3>
										<p><?php echo $key->description; ?></p>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-two-img">
						<img src="<?php echo e(asset('storage/')); ?>/<?php echo e($vision->images); ?>" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/about_us.blade.php ENDPATH**/ ?>