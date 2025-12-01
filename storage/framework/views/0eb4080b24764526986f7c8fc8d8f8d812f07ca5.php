
<?php $__env->startSection('title'); ?>
	<title>Welcome</title>
<?php $__env->stopSection(); ?>
<style>
	#aboutDescription.collapsed {
		max-height: 500px;
		/* Controls how much is visible (adjust) */
		overflow: hidden;
		position: relative;
	}

	#aboutDescription.collapsed::after {
		content: "";
		position: absolute;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 80px;
		background: linear-gradient(to bottom, transparent, white);
	}
</style>

<?php $__env->startSection('content'); ?>

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>About Us</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
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
								<img src="<?php echo e(asset('')); ?>images/bg-shape.png" class="img-fluid" alt="Images">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="about-one-content">
							<div class="section-title">
								<span class="sp-span">ABOUT US</span>
								<h2><?php echo e($about->heading); ?></h2>
								<div class="about-description-wrapper">
									<div id="aboutDescription" class="collapsed">
										<?php echo $about->description; ?>

									</div>

									<?php if(strlen(strip_tags($about->description)) > 953): ?>
										<div class="about-btn">
											<a href="javascript:void(0)" id="readMoreBtn" class="btn btn-readmore">
												Read More
											</a>
										</div>
									<?php endif; ?>
								</div>

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
								<span class="sp-span">Bhawan Bhoomi - Your Property, Your Platform.</span>
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
	<script>
		document.getElementById('readMoreBtn')?.addEventListener('click', function () {
			document.getElementById('aboutDescription').classList.remove('collapsed');
			this.style.display = 'none';
		});

	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/about_us.blade.php ENDPATH**/ ?>