

<?php $__env->startSection('title'); ?>
<title>Testimonials</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section"> 
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Testimonials</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Testimonials</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="testimonial-section-page">
	<div class="testimonial-one-part">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<div class="testi-con">
						<?php echo $picked->heading; ?>

						<p><?php echo $picked->description; ?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testi-img">
						<img src="<?php echo e(asset('storage')); ?>/<?php echo e($picked->images); ?>" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="testimonial-two-part">
		<div class="container">
			<div class="row">
				<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-4">
						<article class="quote-modern">
							<div class="quote-modern-inner">
								<time class="quote-modern-time" datetime="2020">March 15, 2020</time>
								<div class="quote-modern-main">
									<p><?php echo e($testimonial->description); ?></p>
								</div>
								<div class="quote-modern-meta-outer"><img class="quote-modern-avatar" src="<?php echo e(asset('storage')); ?>/<?php echo e($testimonial->image); ?>" alt="" width="57" height="57">
									<div class="quote-modern-meta">
										<h4 class="quote-modern-cite"><?php echo e($testimonial->name); ?></h4>
										<p class="quote-modern-position"><?php echo e($testimonial->designation); ?></p>
									</div>
								</div>
							</div>
						</article>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/testimonial.blade.php ENDPATH**/ ?>