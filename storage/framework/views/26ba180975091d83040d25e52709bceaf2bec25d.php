

<?php $__env->startSection('title'); ?>
<title>Term & Conditions</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo e($term->heading); ?></h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Terms &amp; Condtions</li>
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
				<h2><strong><?php echo e($term->heading); ?></strong></h2>
				<?php echo $term->description; ?>

			</div>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/terms.blade.php ENDPATH**/ ?>