<?php $__env->startSection('title'); ?>
	<title>Blog Detail</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Blog</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Blog Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="blog-detail-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="blog-main">
					<div class="blog-heading">
						<h1><a href=""><?php echo e($blog_detail->heading); ?></a></h1>
						<div class="blog-cat">
							<span><?php echo e($blog_detail->getBlogCategory->name); ?></span>
							<span><i class="fas fa-clock"></i> <?php echo e(date('d M Y', strtotime($blog_detail->created_at))); ?></span>
						</div>
						<div class="blog-img">
							<img src="<?php echo e(asset('storage')); ?>/<?php echo e($blog_detail->image); ?>" class="img-fluid">
						</div>

						<div class="blog-content">
							<p><?php echo $blog_detail->description; ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="blog-sidebar">
					<div class="blog-sidebar-widgets">
						<div class="blog-detail-wrap">
							<div class="blog-detail-wrap-header">
								<h4>Related Blogs</h4>
							</div>
							<div class="blog-detail-wrap-body">
								<ul class="blog-post">
									<?php $__currentLoopData = $related_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n_blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li>
											<div class="blog-li">
												<div class="blog-img"><a href="blog-detail.php"><img alt="" src="<?php echo e(asset('storage')); ?>/<?php echo e($n_blog->image); ?>" class="img-fluid"></a>
												</div>
												<div class="blog-cont">
													<h6><a href="<?php echo e(route('front.blogDetail', $n_blog->id)); ?>"><?php echo e($n_blog->heading); ?></a></h6>
													<p><?php echo \Illuminate\Support\Str::limit($n_blog->description, 100, '...'); ?></p>
												</div>
											</div>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/blog-detail.blade.php ENDPATH**/ ?>