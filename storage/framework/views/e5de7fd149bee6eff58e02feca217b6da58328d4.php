

<?php $__env->startSection('title'); ?>
<title>Search Properties</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Property</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Property</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<?php
	$p   = app('request')->input('property');
	$t   = app('request')->input('type');
	$min = app('request')->input('min_price');
	$max = app('request')->input('max_price');
?>
<section class="property-listing-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="property-top-breadcrumb">
					<div class="row">
						<div class="col-sm-6">
							<div class="top-b-left">
								<span id="listing_count">Showing 1 - <?php echo e($properties->lastPage()); ?> of <?php echo e(count($properties)); ?></span> 
							</div>
						</div>
						<div class="col-sm-6 align-self-center">
							<div class="top-b-right">
								<div class="form-group row">
									<div class="col-sm-4 align-self-center">
										<div class="prop-view">
											<ul>
												<li><a title="Grid View" class="active"><i class="fas fa-th-large"></i> Grid</a></li>
												<li><a href="<?php echo e(url('search')); ?>?property=<?php echo e($p); ?>&type=<?php echo e($t); ?>&min_price=<?php echo e($min); ?>&max_price=<?php echo e($max); ?>"  title="List View"><i class="fas fa-list"></i> List</a></li>
											</ul>
										</div>
									</div>
									<div class="col-sm-8">
										<label class="label-control">Sort By</label>
										<select id="sort-filter" onchange="propertyFilter(null)">
											<option value="">Sort By...</option>
											<option value="price-old">Price ( Low to High )</option>
											<option value="price-high">Price ( High to Low )</option>
											<option value="old">Oldest to Newest</option>
											<option value="new">Newest to Oldest</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="property-listing-left">
					<div class="row" id="populate_properties">
						<div class="row">
							<?php if(count($properties) > 0): ?>
								<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-sm-4">
										<div class="listing-main-grid">
											<div class="row">
												<div class="col-md-12"><img src="<?php echo e(asset('')); ?>/<?php echo e($property->PropertyGallery[0]->image_path); ?>" class="img-fluid" alt=""> </div>

												<div class="col-md-12 prop-grid-m">
													<a href="<?php echo e(config('app.url')); ?>property/<?php echo e($property->slug); ?>"><h3><?php echo e($property->title); ?></h3></a>
													<h4><?php echo e($property->getCity ? $property->getCity->name : ''); ?> - <?php echo e($property->getState ? $property->getState->name : ''); ?></h4>
													<ul class="listing-featured-deta">
														<li>
															<i class="fas fa-rupee-sign"></i> <?php echo e($property->price); ?> <span></span>
														</li>
													</ul>
												</div>

												<div class="col-sm-12">
													<?php
														$dt = new DateTime($property->created_at);
														$tz = new DateTimeZone('Asia/Kolkata');
														$dt->setTimezone($tz);
														$dateTime = $dt->format('d M, Y');
													?>
													<div class="property-bottom">
														<div class="posted-detail">
															<span>Posted on <?php echo e($dateTime); ?></span>
														</div>
														<div class="list-enqu-btn">
															<ul>
																<li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#contact-agent"  onclick='window.active_listing_id = "<?php echo e($property->id); ?>"'><i class="fas fa-phone-alt"></i> Contact Agent</a> </li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<div class="col-sm-12">
									<div class="top-b-left">
										<h4>No any data found.</h4>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if(count($properties) > 0): ?>
					<div class="property-pagination">
						<nav aria-label="Page navigation example">
							<?php
								$p   = app('request')->input('property');
								$t   = app('request')->input('type');
								$min = app('request')->input('min_price');
								$max = app('request')->input('max_price');
							?>
							<ul class="pagination justify-content-center">
								<?php echo e($properties->appends(['property' => $p, 'type' => $t, 'min_price' => $min, 'max_price' => $max])->links()); ?>

							</ul>
						</nav>
					</div>
				<?php endif; ?>
			</div>
			
			<div class="col-sm-3">
				<div class="sidebar-listing">
					<div class="row">
						<div class="col-sm-12">
							<div class="filter-title">Filter by: <a href="javascript:void(0)" onclick="reset()"><i class="fas fa-sync"></i> RESET</a> </div>
						</div>
						<div class="col-sm-12">
							<center class="loading">
								<img src="<?php echo e(url('public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
							</center>
							<ul class="listing-filters">
								<li>
									<button data-toggle="collapse" data-target="#categories-sf" class="title-filter">Categories <i class="fas fa-chevron-down"></i></button>
									<input type="text" class="form-control filter-input" id="category-search" placeholder="Search Your Category" onkeyup="getCategories()">
									<ul class="checkbox-list collapse show" id="categories-sf">
										
									</ul>
								</li>
								<li>
									<button data-toggle="collapse" data-target="#locality-sf" class="title-filter">LOCALITY <i class="fas fa-chevron-down"></i></button>
									<input type="text" class="form-control filter-input" id="location-search" placeholder="Search Your Locality" onkeyup="getLocations()">
									<ul class="checkbox-list collapse show" id="locality-sf-less">
										
									</ul>
									<ul class="checkbox-list collapse show" id="locality-sf-more">
										
									</ul>
									<span class="show-more-filter" id="view-more" style="cursor: pointer;" onclick="showMore('more')"><i class="fas fa-plus"></i> VIEW MORE</span>
									<span class="show-more-filter" id="view-less" style="cursor: pointer;" onclick="showMore('less')"><i class="fas fa-minus" style="color: red;"></i> Hide</span>
								</li>
								
								<li>
									<button data-toggle="collapse" data-target="#locality-sf" class="title-filter">Property Type <i class="fas fa-chevron-down"></i></button>
									<ul class="checkbox-list collapse show" id="property-sf">
										
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade custom-modal" id="claim-listing" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
	<div class="modal-dialog w-450" role="document">
		<div class="modal-content">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
		
			<div class="top-design">
				<img src="images/top-designs.png" class="img-fluid">
			</div>
			<div class="modal-body">
				<div class="modal-main">
					<div class="row login-heads">
						<div class="col-sm-12">
							<h3 class="heads-login">Claim Listing</h3>
							<span class="allrequired">All field are required</span>
						</div>
					</div>
					<div class="modal-form">
						<div class="claim-listin-tab">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
  								<li class="nav-item">
   								 <a class="nav-link active" id="verifybyemail-tab" data-toggle="tab" href="#verifybyemail" role="tab" aria-controls="verifybyemail" aria-selected="true">Verify with Email</a>
 								</li>
  								<li class="nav-item">
    								<a class="nav-link" id="verifybycontact-tab" data-toggle="tab" href="#verifybycontact" role="tab" aria-controls="verifybycontact" aria-selected="false">Verify with Contact</a>
  								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
  								<div class="tab-pane fade show active" id="verifybyemail" role="tabpanel" aria-labelledby="verifybyemail-tab">
									<div class="form-group row">
										<div class="col-sm-12">
											<label class="label-control">Email (imxxxxxxxxx@gmail.com)</label>
											<input type="text" class="text-control" placeholder="Enter Email for Verify">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button type="button" data-target="#verifyemail" data-toggle="modal" data-dismiss="modal" class="btn btn-send w-100">Send OTP <i class="fas fa-chevron-circle-right"></i></button>
										</div>
									</div>
								</div>
  								<div class="tab-pane fade" id="verifybycontact" role="tabpanel" aria-labelledby="verifybycontact-tab">
									<div class="form-group row">
										<div class="col-sm-12">
											<label class="label-control">Mobile No. (87xxxxxxxx)</label>
											<input type="text" class="text-control" placeholder="Enter Mobile No. for Verify">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button type="button" data-target="#verifymobile" data-toggle="modal" data-dismiss="modal" class="btn btn-send w-100">Send OTP <i class="fas fa-chevron-circle-right"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-foo text-center">
				<p>By sending a request, you accept our Terms of Use and Privacy Policy</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade custom-modal" id="verifyemail" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
	<div class="modal-dialog w-450" role="document">
		<div class="modal-content">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
		
			<div class="top-design">
				<img src="images/top-designs.png" class="img-fluid">
			</div>
			<div class="modal-body">
				<div class="modal-main">
					<div class="row login-heads">
						<div class="col-sm-12">
							<h3 class="heads-login">OTP Verification</h3>
							<span class="allrequired">All field are required</span>
						</div>
					</div>
					<div class="modal-form">
						<div class="form-group row justify-content-center">
							<div class="col-sm-12">
								<label class="label-control">Enter OTP</label>
								<input type="number" class="text-control" placeholder="Enter OTP">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-send w-100">Claim Your Listing <i class="fas fa-chevron-circle-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-foo text-center">
				<p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade custom-modal" id="verifymobile" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
	<div class="modal-dialog w-450" role="document">
		<div class="modal-content">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
		
			<div class="top-design">
				<img src="images/top-designs.png" class="img-fluid">
			</div>
			<div class="modal-body">
				<div class="modal-main">
					<div class="row login-heads">
						<div class="col-sm-12">
							<h3 class="heads-login">OTP Verification</h3>
							<span class="allrequired">All field are required</span>
						</div>
					</div>
					<div class="modal-form">
						<div class="form-group row justify-content-center">
							<div class="col-sm-12">
								<label class="label-control">Enter OTP</label>
								<input type="number" class="text-control" placeholder="Enter OTP">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-send w-100">Claim Your Listing <i class="fas fa-chevron-circle-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-foo text-center">
				<p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
				</p>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script type="text/javascript">
	document.getElementById('view-less').style.display = 'none';
	document.getElementById('locality-sf-more').style.display = 'none';

	function reset() {
		getCategories();
		getLocations();
		getPropertyTypes();
		propertyFilter('all');
	}

	//-------------------- Get All Categories --------------------//
	getCategories();
	function getCategories() {
		setTimeout(function() {
			var data = $('#category-search').val();
			var search = data ? data : null;
			$(".loading").css('display', 'block');
		    $("#categories-sf").html('');
	        $.ajax({
	            url:"<?php echo e(route('getAllCategories')); ?>",
	            type: "POST",
	            data: {
	                search: search,
	                _token: '<?php echo e(csrf_token()); ?>',
	            },
	            dataType : 'json',
	            success: function(result){
	            	console.log(result);
	            	$("#categories-sf").html('');
	                $.each(result,function(key,category){
	                	$("#categories-sf").append('<li><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input category" name="category" id="category'+key+'" onclick="propertyFilter('+0+')" value="'+category.id+'"><label class="custom-control-label" for="category'+key+'">'+category.category_name+'</label></div></li>');
	                });
	            },
	            error: function(error) {
	            	getCategories();
	            },
	            complete: function() {
	            	$(".loading").css('display', 'none');
	            }
	        });
		}, 1000);
	}

	//-------------------- Get All Locations --------------------//
	getLocations();
	function getLocations() {
		setTimeout(function() {
			var data = $('#location-search').val();
			var search = data ? data : null;
			$(".loading").css('display', 'block');
		    $("#locality-sf-less").html('');
	        $.ajax({
	            url:"<?php echo e(route('getAllLocations')); ?>",
	            type: "POST",
	            data: {
	                search: search,
	                _token: '<?php echo e(csrf_token()); ?>',
	            },
	            dataType : 'json',
	            success: function(result){
	            	console.log(result);
	            	$("#locality-sf-less").html('');
	                $.each(result,function(l,location){
	                	if(l == 0 || l == 1) {
	                		$("#locality-sf-less").append('<li><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input locations" id="location-'+l+'" onclick="propertyFilter('+1+')" value="'+location.id+'"><label class="custom-control-label" for="location-'+l+'">'+location.location+'</label></div></li>');
	                	}
	                });
	                $("#locality-sf-more").html('');
	                $.each(result,function(m,location){
	                	$("#locality-sf-more").append('<li><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input locations" id="location'+m+'" onclick="propertyFilter('+1+')"  value="'+location.id+'"><label class="custom-control-label" for="location'+m+'">'+location.location+'</label></div></li>');
	                });
	            },
	            error: function(error) {
	            	getLocations();
	            },
	            complete: function() {
	            	$(".loading").css('display', 'none');
	            }
	        });
		}, 2000);
	}

	//-------------------- Get All Property Types --------------------//
	getPropertyTypes();
	function getPropertyTypes() {
		setTimeout(function() {
			var data = $('#location-search').val();
			var search = data ? data : null;
			$(".loading").css('display', 'block');
		    $("#property-sf").html('');
	        $.ajax({
	            url:"<?php echo e(route('getAllPropertyTypes')); ?>",
	            type: "POST",
	            data: {
	                search: search,
	                _token: '<?php echo e(csrf_token()); ?>',
	            },
	            dataType : 'json',
	            success: function(result){
	            	console.log(result);
	            	$("#property-sf").html('');
	                $.each(result,function(p,type){
	                	$("#property-sf").append('<li><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input types" id="property-type'+p+'" onclick="propertyFilter('+2+')" value="'+type.id+'"><label class="custom-control-label" for="property-type'+p+'">'+type.type+'</label></div></li>');
	                });
	            },
	            error: function(error) {
	            	getPropertyTypes();
	            },
	            complete: function() {
	            	$(".loading").css('display', 'none');
	            }
	        });
		}, 3000);
	}

	function showMore(key) {
		if(key == 'more') {
			document.getElementById('locality-sf-more').style.display = 'block';
			document.getElementById('locality-sf-less').style.display = 'none';
			document.getElementById('view-more').style.display = 'none';
			document.getElementById('view-less').style.display = 'block';
		}else if(key == 'less') {
			document.getElementById('locality-sf-more').style.display = 'none';
			document.getElementById('locality-sf-less').style.display = 'block';
			document.getElementById('view-more').style.display = 'block';
			document.getElementById('view-less').style.display = 'none';
		}

	}

	function propertyFilter(key) {
		console.log(key);
		var category  = [];
		var locations = [];
		var types     = [];
		var short_filter = $('#sort-filter').val();
		if(key == 0) {
			$('input:checkbox.locations').each(function () {
				this.checked = false;
			});
			$('input:checkbox.types').each(function () {
				this.checked = false;
			});

		}else if(key == 1) {
			$('input:checkbox.category').each(function () {
				this.checked = false;
			});
			$('input:checkbox.types').each(function () {
				this.checked = false;
			});

		}else if(key == 2) {
			$('input:checkbox.category').each(function () {
				this.checked = false;
			});
			$('input:checkbox.locations').each(function () {
				this.checked = false;
			});
		}
		if(key == 'all') {
		    $('input:checkbox.category').each(function () {
				this.checked = false;
			});
		    $('input:checkbox.locations').each(function () {
				this.checked = false;
			});
			$('input:checkbox.types').each(function () {
				this.checked = false;
			});
		}
		$('input:checkbox.category').each(function () {
			if(this.checked) {
				category.push($(this).val());
			}
		});
		$('input:checkbox.locations').each(function () {
			if(this.checked) {
				locations.push($(this).val());
			}
		});
		$('input:checkbox.types').each(function () {
			if(this.checked) {
				types.push($(this).val());
			}
		});
		
		$.ajax({
            url:"<?php echo e(route('propertyDataFilter')); ?>",
            type: "POST",
            data: {
                categories: category,
                locations : locations,
                types     : types,
                p:"<?php echo e($p); ?>",
                t:"<?php echo e($t); ?>",
                min:"<?php echo e($min); ?>",
                max:"<?php echo e($max); ?>",
                short_filter:short_filter,
                _token: '<?php echo e(csrf_token()); ?>',
            },
            dataType : 'json',
            beforeSend: function() {
            	$(".loading").css('display', 'block');
            },
            success: function(result){
                try {
		    		var listings = result.data;
		    		console.log(listings);
		    		if(listings.length > 0) {
						$("#populate_properties").empty();	   
		    			$("#listing_count").html(`Showing 1 - ${listings.length} of ${listings.length}`)
			    		$.each(listings, function(i,row) {
			    			if(row.property_gallery[0].image_path !== ''){
				    			image_path = "<?php echo e(config('app.url')); ?>"+"/public/"+row.property_gallery[0].image_path;
			    			} else {
				    			image_path = "https://dummyimage.com/hd1080";
			    			}
			    			let created_at = row.formatted_date;
			    			var city  = row.get_city ? row.get_city.name : '';
			    			var state = row.get_state ? row.get_state.name : '';
			    			var role  = row.get_user ? row.get_user.role : '';
			    			var company_name  = row.get_user ? row.get_user.company_name : '';
			    			var place = city +' - '+state;
			    			var ids = row.amenities;
			    			$("#populate_properties").append(
			    				`
			    				<div class="col-sm-4">
									<div class="listing-main-grid">
										<div class="row">
											<div class="col-md-12"><img src=${image_path} class="img-fluid" alt=""> </div>

											<div class="col-md-12 prop-grid-m">
												<a href="<?php echo e(config('app.url')); ?>property/${row.slug}"><h3>${row.title}</h3></a>
												<h4>${place}</h4>
												<ul class="listing-featured-deta">
													<li>
														<i class="fas fa-rupee-sign"></i> ${row.price} <span></span>
													</li>
												</ul>
											</div>

											<div class="col-sm-12">
												<div class="property-bottom">
													<div class="posted-detail">
														<span>Posted on ${created_at}</span>
													</div>
													<div class="list-enqu-btn">
														<ul>
															<li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#contact-agent"  onclick='window.active_listing_id = "${row.id}"'><i class="fas fa-phone-alt"></i> Contact Agent</a> </li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
			    				`
			    			);
			    		}); 

			    	} else {
			    		$("#populate_properties").empty();
		    			$("#listing_count").html(`Showing 0 of 0`)
			    		$("#populate_properties").append(`
			    			<center> No properties found! </center>
			    		`);
			    	}
			    } catch(err) {
			    	console.log(err);
			    	$(".loading").css('display', 'none');
			    }
            },
            error: function(error) {
            	console.log(error);
            	$(".loading").css('display', 'none');
            },
            complete: function() {
            	$(".loading").css('display', 'none');
            }
        });
	}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/search_grid.blade.php ENDPATH**/ ?>