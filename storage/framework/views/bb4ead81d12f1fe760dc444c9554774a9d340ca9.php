<?php $__env->startSection('title'); ?>
<title>My Properties</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>My Properties</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">My Properties</li>
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
				<?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="col-sm-9">
				<div class="main-area-dash">
					<h3 class="head-tit">Properties</h3>
					<section class="dashboard-area account-my-properties">
						<div class="row">
							<div class="col-sm-12">
								<?php if(count($properties) > 0): ?>
									<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="single-listing">
											<div class="media">
												<img class="mr-3 img-fluid" src="<?php echo e(asset('')); ?><?php echo e($v->PropertyGallery[0]->image_path); ?>" alt="Title">
												<div class="media-body">
													<h1 class="property-title"><a href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>"><?php echo e($v->title); ?></a></h1>
													<h3 class="property-price"><i class="fas fa-rupee-sign"></i> <?php echo e($v->price); ?></h3>
													<h3 class="property-listed">Listing in <a href="#"><?php echo e($v->category->category_name); ?></a> </h3>
													<div class="property-buttons">
														<ul>
															<li><a href="<?php echo e(url('update/property')); ?>/<?php echo e($v->id); ?>" title="Edit Property"><i class="fas fa-pencil-alt"></i></a>
															</li>
															<li><a  href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>" title="View Property"><i class="fas fa-eye"></i></a>
															</li>
															<li><a style="cursor: pointer;" title="Delete Property" onclick="deleteProperty('<?php echo e($v->id); ?>')"><i class="fas fa-trash"></i></a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?> 
									<div class=""> No records found </div>
								<?php endif; ?>
							</div>



						</div>

<!-- 						<div class="row">
							<div class="col-sm-12">
								<div class="pagination justify-content-center">
									<nav aria-label="Page navigation example">
										<ul class="pagination justify-content-center">
											<li class="page-item disabled">
												<a class="page-link" href="#" tabindex="-1">Previous</a>
											</li>
											<li class="page-item"><a class="page-link" href="#">1</a>
											</li>
											<li class="page-item active"><a class="page-link" href="#">2</a>
											</li>
											<li class="page-item"><a class="page-link" href="#">3</a>
											</li>
											<li class="page-item">
												<a class="page-link" href="#">Next</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div> -->
					</section>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function deleteProperty(id) {
		swal({
                title: "Are you sure?",
                text: "Delete this Property",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method:'post',
                    url   : "<?php echo e(route('property.delete')); ?>",
                    data  : {
                    "_token": "<?php echo e(csrf_token()); ?>",
                        'id'    : id
                    },
                    success: function(data){
                    	toastr.success(data);
                        setTimeout( function () {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/agent/properties.blade.php ENDPATH**/ ?>