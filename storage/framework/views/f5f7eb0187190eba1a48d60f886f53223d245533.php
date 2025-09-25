<?php $__env->startSection('title'); ?>
	<title>Blogs</title>
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
						<li class="breadcrumb-item active" aria-current="page">Blog</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="blog-page">
	<div class="blog-featured">
		<div class="container">
			<?php if(count($featured) > 0): ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="blog-section-title">
							<h2>Featured Posts</h2>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="owl-carousel featured-blog">
							<?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="blog-main">
									<div class="blog-img">
										<img src="<?php echo e(asset('storage')); ?>/<?php echo e($feature->image); ?>" class="img-fluid">
									</div>
									<div class="blog-cat">
										<span><?php echo e($feature->getBlogCategory->name); ?></span>
										<span><i class="fas fa-clock"></i> <?php echo e(date('d M Y', strtotime($feature->created_at))); ?></span>
									</div>
									<div class="blog-heading">
										<h1><a href="<?php echo e(route('front.blogDetail', $feature->id)); ?>"><?php echo e($feature->heading); ?></a></h1>
										<p><?php echo \Illuminate\Support\Str::limit($feature->description, 100, '...'); ?></p>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php $__currentLoopData = $blog_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="blog-section-title">
							<h2><?php echo e($blog_category->name); ?></h2>
						</div>
					</div>
				</div>

				<div class="row">
					<?php $__currentLoopData = $blog_category->getRelatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-3">
							<div class="blog-main mb-5">
								<div class="blog-img">
									<img src="<?php echo e(asset('storage')); ?>/<?php echo e($blog->image); ?>" class="img-fluid">
								</div>
								<div class="blog-cat">
									<span><?php echo e($blog->getBlogCategory->name); ?></span>
									<span><i class="fas fa-clock"></i> <?php echo e(date('d M Y', strtotime($blog->created_at))); ?></span>
								</div>
								<div class="blog-heading">
									<h1><a href="<?php echo e(route('front.blogDetail', $blog->id)); ?>"><?php echo e($blog->heading); ?></a></h1>
									<p><?php echo \Illuminate\Support\Str::limit($blog->description, 100, '...'); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/blog.blade.php ENDPATH**/ ?>