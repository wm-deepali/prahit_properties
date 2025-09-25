<?php $__env->startSection('title'); ?>
<title>Safety Guide</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo e($picked->heading); ?></h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Safety Guide</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="policy-page">
	<div class="container"> 
		<div class="row">
			<div class="col-sm-12">
				<?php echo $picked->description; ?>

			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/safety-guide.blade.php ENDPATH**/ ?>