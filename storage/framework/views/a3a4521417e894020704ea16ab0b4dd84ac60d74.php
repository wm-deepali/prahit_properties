<?php $__env->startSection('title'); ?>
<title>Dashboard</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>My Account</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Account</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="owner-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            	<?php echo $__env->make('front.agent.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-sm-9">
                <div class="main-area-dash">
                    <h3 class="head-tit">Dashboard</h3>
                    <section class="dashboard-area">
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/agent/dashboard.blade.php ENDPATH**/ ?>