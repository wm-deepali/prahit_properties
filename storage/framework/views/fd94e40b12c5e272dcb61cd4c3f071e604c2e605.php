
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php $__env->startSection('title'); ?>
	<title><?php echo e($property_detail->title); ?> - <?php echo e(config('app.name')); ?></title>
	<style type="text/css">
		.rendered-form {
			margin-left: 15px;
		}
	</style>
<?php $__env->stopSection(); ?>

<style>
	.related-agents {
		position: sticky;
		top: 20px;
		padding: 20px;
		background: white;
		border-radius: 12px;
		box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
	}


	.agent-card {
		border: none;
		overflow: hidden;
		transition: transform 0.3s ease;
		margin-bottom: 20px;
	}

	.agent-card:hover {
		transform: translateY(-5px);
	}

	.newdesign-image-agent {
		position: relative;
	}

	.newdesign-image-agent img {
		width: 100%;
		height: 200px;
		object-fit: cover;
	}

	.newdesign-verified-seal {
		position: absolute;
		top: 10px;
		right: 10px;
		background: #28a745;
		color: white;
		padding: 5px 10px;
		border-radius: 10px;
		font-size: 0.9rem;
	}

	.newdesign-info-agent {
		padding: 15px;
	}

	.newdesign-info-agent .newdesign-proj-name {
		font-size: 1.3rem;
		margin-bottom: 5px;
		font-family: 'Arial', sans-serif;
	}

	.newdesign-info-agent .newdesign-apart-name {
		font-size: 0.95rem;
		color: #666;
		margin-bottom: 10px;
	}

	.newdesign-info-agent hr {
		margin: 10px 0;
		border: 0;
		border-top: 1px solid #eee;
	}

	.newdesign-info-agent .newdesign-apart-adress {
		font-size: 0.9rem;
		color: #888;
		display: block;
		margin-bottom: 10px;
	}

	.newdesign-info-agent .newdesign-proj-owner {
		font-size: 0.9rem;
		color: #666;
	}

	.newdesign-info-agent .view-profile-btn {
		background: #007bff;
		color: white;
		border: none;
		padding: 8px 15px;
		border-radius: 20px;
		font-size: 0.9rem;
		display: block;
		width: 100%;
		text-align: center;
		margin-top: 10px;
		transition: background 0.3s ease;
	}

	.newdesign-info-agent .view-profile-btn:hover {
		background: #0056b3;
	}

	.bg-gradient-primary {
		background: linear-gradient(135deg, #e63946, #c1121f) !important;
	}

	.border-purple {
		border-color: #9c27b0 !important;
	}

	.shadow-xl {
		box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15) !important;
	}

	.detail-box {
		transition: all 0.3s ease;
		min-height: 90px;
	}

	.detail-box:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
	}

	@media (max-width: 768px) {
		.display-6 {
			font-size: 1.2rem !important;
		}

		.price-box {
			min-width: 220px;
			font-size: 1.5rem !important;
		}

		.property-overview-section .card {
			border-radius: 16px;
		}
	}

	.bg-gradient-primary {
		background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
	}

	.hover-lift {
		transition: all 0.35s ease;
	}

	.hover-lift:hover {
		transform: translateY(-10px);
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
	}

	.icon-box {
		width: 60px;
		height: 60px;
		background: rgba(255, 255, 255, 0.8);
		border-radius: 16px;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
	}

	.fs-12 {
		font-size: 12px;
		letter-spacing: 1px;
	}

	.shadow-xl {
		box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
	}

	@media (max-width: 768px) {
		.spec-item {
			flex-direction: column;
			text-align: center;
		}

		.icon-box {
			margin-bottom: 15px;
			margin-right: 0 !important;
		}
	}

	.info-item {
		padding: 10px 0;
		border-bottom: 1px dashed #dee2e6 !important;
	}

	.info-label {
		font-size: 14px;
		color: #6c757d;
		margin-bottom: 4px;
		font-weight: 500;
	}

	.info-value {
		font-size: 16px;
		color: #212529;
	}

	.info-item:last-child {
		border-bottom: none;
	}

	/* Section header ke liye thoda spacing */
	#additional-info>.row>div>h4 {
		color: #2c3e50;
		font-size: 18px;
		font-weight: 600;
		border-bottom: 2px solid #f39c12;
		padding-bottom: 8px;
		margin-bottom: 20px;
	}
</style>

<?php $__env->startSection('content'); ?>
	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>PropertyDetail</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">PropertyDetail</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="property-detail-section">
		<div class="container">

			<div class="row">
				<div class="col-sm-12">
					<!-- PREMIUM PROPERTY OVERVIEW SECTION - 2025 DESIGN -->
					<div class="property-overview-section mb-5">
						<div class="card border-0 shadow-lg overflow-hidden"
							style="border-radius: 10px; background: linear-gradient(145deg, #ffffff, #f8f9ff);">

							<!-- Top Hero Area with Background Image Overlay -->
							<div class="position-relative">
								<div
									style="height: 300px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.5)), 
										url('<?php echo e(isset($property_detail->PropertyGallery[0]) ? asset($property_detail->PropertyGallery[0]->image_path) : asset('default-property.jpg')); ?>') center/cover no-repeat;">
								</div>

								<!-- Floating Content Card on Top of Image -->
								<div class="position-absolute bottom-0 start-0 end-0 p-2 p-md-5"
									style="transform: translateY(50%);">
									<div class="container">
										<div class="bg-white rounded-4 shadow-xl p-4 p-lg-5"
											style="border: 1px solid #e0e6ff;">
											<div class="row align-items-center g-4">

												<!-- Title + Location + Verified -->
												<div class="col-lg-8">
													<div class="property-title gap-3 mb-3">
														<h1 class="display-6 fw-bold mb-0 text-dark">
															<?php echo e($property_detail->title); ?>

														</h1>
														<?php if($property_detail->verified_tag === 'Yes'): ?>
															<span
																class="badge bg-success fs-6 px-4 py-2 rounded-pill shadow-sm">
																<i class="fas fa-check-circle me-1"></i> Verified
															</span>
														<?php endif; ?>
													</div>

													<div class="property-title gap-4 text-muted fs-5">
														<div class="d-flex align-items-center gap-2">
															<i class="fas fa-map-marker-alt text-danger"></i>
															<span class="fw-600">
																<?php echo e($property_detail->getCity?->name ?? ''); ?>,
																<?php echo e($property_detail->getState?->name ?? ''); ?>

																<?php if($property_detail->Location): ?>
																	• <?php echo e($property_detail->Location->location); ?>

																<?php endif; ?>
															</span>
														</div>
														<div class="d-flex align-items-center gap-2">
															<i class="fas fa-eye text-primary"></i>
															<span><?php echo e(number_format($property_detail->total_views)); ?>

																Views</span>
														</div>
													</div>
												</div>

												<!-- Price Section -->
												<div class="col-lg-4 text-lg-end">
													<div class="price-box bg-gradient-primary text-white p-4 rounded-3 shadow-lg d-inline-block"
														style="background: linear-gradient(135deg, #e63946, #c1121f); ">
														<div class="fs-1 fw-bold mb-1">
															₹
															<?php echo e(isset($property_detail->price) ? \App\Helpers\Helper::formatIndianPrice($property_detail->price) : 'Call for Price'); ?>

														</div>
														<div id="price-negotiable" class="fs-5 fw-bold text-warning"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Bottom Details Section -->
							<div class="pt-5 px-4 px-lg-5 pb-4" style="margin-top: 120px;">
								<div class="row g-4">

									<?php
    $defaultImage = $property_detail->PropertyGallery->where('is_default', 1)->first();
    $mainImage = $defaultImage
        ? asset($defaultImage->image_path)
        : ($property_detail->PropertyGallery->first()
            ? asset($property_detail->PropertyGallery->first()->image_path)
            : asset('default.jpg'));
?>

									<!-- Left: Main Image -->
									<div class="col-md-4 gallery-img-section">
    <div class="position-relative rounded-4 overflow-hidden shadow-lg">

        
        <a href="<?php echo e($mainImage); ?>" data-lightbox="property-gallery">
            <img src="<?php echo e($mainImage); ?>"
                 class="img-fluid w-100"
                 style="height: 320px; object-fit: cover; cursor:pointer;"
                 alt="Property">
        </a>

        
        <div class="position-absolute top-0 end-0 m-3">
            <span class="badge bg-dark px-3 py-2 fs-6">
                <i class="fas fa-camera"></i>
                <?php echo e($property_detail->PropertyGallery->count()); ?> Photos
            </span>
        </div>
    </div>

    
    <?php $__currentLoopData = $property_detail->PropertyGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(asset($gallery->image_path)); ?>"
           data-lightbox="property-gallery"
           data-title="Property Image"
           style="display:none;">
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="col-md-8">
		<?php echo $__env->make($detailSection, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- Action Buttons -->
	 <div class="mt-4 pt-3 border-top">
    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">

        
        <button type="button"
                class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm"
                id="scrollToEnquiry">
            <i class="fas fa-paper-plane"></i> Send Enquiry
        </button>

        
        <button id="wishlistButton"
                class="btn btn-outline-danger btn-lg px-4 rounded-pill shadow-sm"
                data-submission="<?php echo e($property_detail->id); ?>">
            <?php echo $isInWishlist
                ? '<i class="fas fa-heart"></i> Added to Wishlist'
                : '<i class="far fa-heart"></i> Add to Wishlist'; ?>

        </button>

    </div>
</div>
</div>
								

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-8">
				

					<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Details</h3>
						</div>

						<!-- ULTRA PREMIUM ADDITIONAL DETAILS - 2025 DESIGN -->
						<div class="additional-details-section mb-5">
							<div class="bg-white rounded-4  overflow-hidden border border-light">
								<div class="px-5 py-4 bg-gradient-primary text-white">
									<h3 class="mb-0 fs-4 fw-bold">
										<i class="fas fa-sliders-h me-3"></i> Key Property Specifications
									</h3>
								</div>

								<div class="p-4 p-lg-5">
									<div class="row g-4">
										<!-- No Data Fallback -->
										<?php if(!$property_detail->additional_info): ?>
											<div class="col-12 text-center py-5">
												<i class="fas fa-info-circle text-primary fs-1 mb-3"></i>
												<p class="text-muted fs-5">Additional specifications: No additional
													specifications available</p>
											</div>
										<?php endif; ?>

										<!-- Original form-rendered additional info -->
										<div id="additional-info"></div>

										
									</div>
								</div>
							</div>
						</div>



					</div>

						<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Gallery</h3>
						</div>

						<div class="property-gallery">
							<div class="row gap-2">

								
								<?php $__currentLoopData = $property_detail->PropertyGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-sm-3">
										<a href="#">
											<img src="<?php echo e(url('/') . '/' . $v->image_path); ?>" class="img-fluid">
										</a>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								
								<?php if(!empty($property_detail->property_video)): ?>
									<div class="col-sm-12 mt-3">
										<video class="w-100" controls>
											<source src="<?php echo e(url($property_detail->property_video)); ?>" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								<?php endif; ?>

							</div>
						</div>
					</div>
					
							<?php if(count($amenities) > 0): ?>
						<div class="card property-widgets">
							<div class="property-title">
								<h3>Amenities Detail</h3>
							</div>
							<div class="property-amenities">
								<div class="row">
									<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-sm-2">
											<div class="amenities-main">
												<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" class="img-fluid">
												<h3><?php echo e($amenity->name); ?></h3>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>


					<div class="card property-widgets">
    <div class="property-title">
        <h3>Location Detail</h3>
    </div>

    <div class="property-location p-3">

        
        <div class="row">
            <div class="col-sm-12">
                <div id="propertyMap"
                     style="width:100%; height:400px; border-radius: 12px; margin-bottom: 15px;">
                </div>

                <input type="hidden" id="latitude" name="latitude"
                       value="<?php echo e($property_detail->latitude); ?>">
                <input type="hidden" id="longitude" name="longitude"
                       value="<?php echo e($property_detail->longitude); ?>">
            </div>
        </div>

        
        <div class="mt-3 p-3 bg-light rounded-3">
            <h6 class="fw-bold mb-2">
                <i class="fas fa-map-marked-alt text-danger"></i> Address
            </h6>

            <p class="mb-1">
                <?php echo e($property_detail->address); ?>

            </p>

            <?php if($property_detail->landmark): ?>
                <p class="mb-1 text-muted">
                    <strong>Landmark:</strong> <?php echo e($property_detail->landmark); ?>

                </p>
            <?php endif; ?>

            <p class="mb-0 text-muted">
                <?php echo e($property_detail->getCity?->name); ?>,
                <?php echo e($property_detail->getState?->name); ?>

                – <?php echo e($property_detail->pincode); ?>

            </p>
        </div>

        
        <?php if($property_detail->latitude && $property_detail->longitude): ?>
            <a href="https://www.google.com/maps?q=<?php echo e($property_detail->latitude); ?>,<?php echo e($property_detail->longitude); ?>"
               target="_blank"
               class="btn btn-outline-primary w-100 mt-3 rounded-pill">
                <i class="fas fa-directions"></i> Get Directions
            </a>
        <?php endif; ?>

    

    </div>
</div>

				</div>

				<div class="col-sm-4">
					<div class="card property-widgets">
						<div class="property-title">
							<h3>
								Send Enquiry
							</h3>
						</div>
						<div class="property-contact" id="enquiry-section">

							<form id="enquiryForm">
								<?php echo csrf_field(); ?>
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="hidden" name="property_id" value="<?php echo e($property_detail->id); ?>">
										<label class="label-control">Name</label>
										<input type="text" class="text-control" placeholder="Enter Name" name="name"
											value="<?php echo e(Auth::check() ? Auth::user()->firstname : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="text-control" placeholder="Enter Email" name="email"
											value="<?php echo e(Auth::check() ? Auth::user()->email : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Mobile No.</label>
										<input type="number" class="text-control" placeholder="Enter Mobile No." min="1"
											value="<?php echo e(Auth::check() ? Auth::user()->mobile_number : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> name="mobile_number" required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Interested In</label>
										<select class="text-control" name="interested_in" required>
											<option value=""> Select </option>
											<option value="1">Site Visit</option>
											<option value="2">Immediate Purchase</option>
											<option value="3">Home Loan</option>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12 text-center">
										<button type="submit" class="btn btn-submit" id="sendEnquiryBtn" <?php if(auth()->check() && $property_detail->user_id === auth()->id()): ?> disabled <?php endif; ?>>
											Send Enquiry
										</button>

										<p>By sending a request., you accept our Terms of Use and Privacy Policy</p>
									</div>
								</div>
							</form>
						</div>
					</div>

									
<div class="card property-widgets mt-3">
    <div class="property-title">
        <h3>Report / Ownership</h3>
    </div>

    <div class="p-3">
        
        <button type="button"
                class="btn btn-outline-primary w-100 mb-2 rounded-pill"
                onclick="claim('<?php echo e($property_detail->id); ?>')">
            <i class="fas fa-shield-alt"></i> Claim This Listing
        </button>

        
        <button type="button"
                class="btn btn-outline-warning w-100 rounded-pill"
                data-bs-toggle="modal"
                data-bs-target="#feedback-complaint">
            <i class="fas fa-comment-dots"></i> Feedback / Complaint
        </button>
    </div>
</div>

					<div class="related-agents">
						<div class="agent-card mb-3 border">
							<div class="newdesign-image-agent">
								<?php
									$section = isset($property_user->profileSection);
									$logo = isset($section->logo)
										? asset('storage/' . $section->logo)
										: asset('storage/' . $property_user->avatar);
								?>
								<img src="<?php echo e($logo); ?>" alt="Agent" class="agent-avatar">
								<span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i>
									<?php if($property_user->premium_seller === 'Yes'): ?>
										Premium
									<?php else: ?>
										Verified
									<?php endif; ?>
								</span>
							</div>
							<div class="newdesign-info-agent">
								<div class="d-flex justify-content-between">
									<h4 class="newdesign-proj-name">
										<?php echo e($property_user->firstname); ?> <?php echo e($property_user->lastname); ?>

									</h4>
									<span class="newdesign-proj-category">
										<?php echo e($property_user->role ?? 'Agent'); ?>

									</span>
								</div>
								<span class="newdesign-apart-name">
									<?php echo Str::limit(
		preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode(optional($property_user->profileSection)->description ?? 'No description available')))),
		100
	); ?>

								</span>
								<hr>
								<span class="newdesign-apart-adress">
									<i class="fa-solid fa-location-dot"></i>
									<?php echo e($property_user->getCity->name ?? 'N/A'); ?>,
									<?php echo e($property_user->getState->name ?? ''); ?>

								</span>
								<div class="d-flex justify-content-between">
									<span
										class="newdesign-proj-owner"><strong>Company:</strong><br><?php echo e(optional($property_user->profileSection)->business_name ?? 'N/A'); ?></span>
									<span
										class="newdesign-proj-owner"><strong>Experience:</strong><br><?php echo e(optional($property_user->profileSection)->years_experience ?? 0); ?>

										yrs</span>
								</div>
								<a href="<?php echo e(route('profile.page', ['slug' => Str::slug($property_user->firstname)])); ?>"
									class="view-profile-btn">
									View Profile
								</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<input type="hidden" id="form-json" value="<?php echo e($property_detail->additional_info); ?>">
	<!-- Modal -->

	<!-- Feedback / Complaint Modal -->
	<div class="modal fade custom-modal" id="feedback-complaint" tabindex="-1" role="dialog" aria-labelledby="feedbackModal"
		aria-hidden="true">
		<div class="modal-dialog w-450" role="document">
			<div class="modal-content">
				<button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<div class="top-design">
					<img src="<?php echo e(url('/public/images/top-designs.png')); ?>" class="img-fluid">
				</div>

				<div class="modal-body">
					<div class="modal-main">
						<div class="row login-heads">
							<div class="col-sm-12">
								<h3 class="heads-login">Feedback / Complaint</h3>
								<span class="allrequired">All fields are required</span>
							</div>
						</div>

						<div class="modal-form">
							<form id="feedbackForm" method="post" action="<?php echo e(url('master/property/feedback/create')); ?>">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="property_id" value="<?php echo e($property_detail->id); ?>">
								<input type="hidden" name="otp_verified" id="otpVerified" value="0">

								<!-- Mobile Number -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Mobile Number</label>
										<input type="text" name="mobile_number" id="feedbackMobile" class="text-control"
											placeholder="Enter mobile number" required>
										<button type="button" id="feedbackSendOtp" class="btn btn-sm btn-warning mt-2">Send
											OTP</button>
									</div>
								</div>
								<!-- OTP Input -->
								<div class="form-group row" id="feedbackOtpDiv" style="display:none;">
									<div class="col-sm-12">
										<label class="label-control">Enter OTP</label>
										<input type="text" id="feedbackOtpCode" class="text-control"
											placeholder="Enter OTP">
										<button type="button" id="feedbackVerifyOtp"
											class="btn btn-sm btn-success mt-2">Verify OTP</button>
										<p class="mt-1"><a href="#" id="feedbackResendOtp">Resend OTP</a></p>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Email (Optional)</label>
										<input type="email" name="email" id="feedbackEmail" class="text-control"
											placeholder="Enter your email">
									</div>
								</div>

								<!-- Listing correctness -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Are the details of the listing correct?</label>
										<select class="text-control" id="listingcorrect" name="is_detail_correct" required>
											<option value="">Select</option>
											<option value="1">Yes</option>
											<option value="2">No</option>
											<option value="3">Not Reachable</option>
										</select>
									</div>
								</div>

								<!-- Incorrect listing -->
								<div class="form-group row fakelisting" style="display: none;">
									<div class="col-sm-12">
										<label class="label-control">Ohh!! What wasn't correct in the listing?</label>
										<ul class="no_listfeed">
											<li><label><input type="checkbox" name="complaint[]" value="1"> Property
													Sold/Rented Out</label></li>
											<li><label><input type="checkbox" name="complaint[]" value="2"> Fake/Incorrect
													Photos</label></li>
											<li><label><input type="checkbox" name="complaint[]" value="3"> Incorrect
													Location/Address</label></li>
											<li><label><input type="checkbox" name="complaint[]" value="4"> Broker property
													as Owner</label></li>
											<li><label><input type="checkbox" name="complaint[]" value="5"> Others*
													(Floor,Amenities,Furnished)</label></li>
											<li><label><input type="checkbox" name="complaint[]" value="6"> Incorrect
													Price</label></li>
										</ul>
									</div>
								</div>

								<!-- Not reachable -->
								<div class="form-group row notreachable" style="display: none;">
									<div class="col-sm-12">
										<label class="label-control">Uh_Oh! What was wrong?</label>
										<ul class="no_listfeed">
											<li><label><input type="checkbox" name="agent_not_reachable_type[]" value="1">
													Wrong or Invalid Number</label></li>
											<li><label><input type="checkbox" name="agent_not_reachable_type[]" value="2">
													Switched off / Not Reachable</label></li>
										</ul>
									</div>
								</div>

								<!-- Feedback textarea -->
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Share your experience</label>
										<textarea cols="4" rows="2" class="text-control" name="feedback"
											required></textarea>
									</div>
								</div>

								<!-- Submit -->
								<div class="form-group row">
									<div class="col-sm-12 text-center">
										<button type="submit" class="btn btn-send w-100">Submit <i
												class="fas fa-chevron-circle-right"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal-foo text-center">
					<p>By sending a request, you accept our Terms of Use and Privacy Policy</p>
				</div>
			</div>
		</div>
	</div>



	<!-- OTP Verification Modal -->
	<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-4">
				<div class="modal-header border-0">
					<h5 class="modal-title" id="otpModalLabel">Verify Mobile Number</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<div id="otpStep1">
						<label>Enter your mobile number</label>
						<input type="number" id="otpMobile" class="form-control mb-3" placeholder="Enter mobile number">
						<button type="button" id="sendOtpBtn" class="btn btn-primary w-100">Send OTP</button>
					</div>

					<div id="otpStep2" style="display: none;">
						<label>Enter OTP</label>
						<input type="number" id="otpCode" class="form-control mb-3" placeholder="Enter OTP">
						<button type="button" id="verifyOtpBtn" class="btn btn-success w-100">Verify OTP</button>
						<p class="text-center mt-2">
							Didn’t receive OTP? <a href="#" id="resendOtp">Resend</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

<script type="text/javascript">

$(document).ready(function () {

    const formData = $('#form-json').val();
    if (!formData) return;

    /* =============================
     * SECTION ORDER
     * ============================= */
    const SECTION_ORDER = [
        'property area detail',
        'price detail',
        'building detail',
        'property info',
        'furnishing status',
        'facilities',
        'other info',
        'leasing detail'
    ];

    /* =============================
     * HELPERS
     * ============================= */
    function stripHtml(html) {
        const d = document.createElement("DIV");
        d.innerHTML = html;
        return d.textContent || d.innerText || "";
    }

    function normalize(label) {
        return stripHtml(label).toLowerCase().replace(/\s+/g, ' ').trim();
    }

    function formatIndianPrice(num) {
        const n = parseFloat(num);
        if (isNaN(n)) return num;
        return '₹ ' + n.toLocaleString('en-IN');
    }

 /* =============================
 * AREA → UNIT MAP (UPDATED)
 * ============================= */
const areaUnitMap = {
    "land area": "land area unit",
    "super area": "super area unit",
    "carpet area": "carpet area unit",
    "builtup area": "builtup area unit",
    "built-up area": "built-up area unit",
    "covered area": "covered area unit",
    "plot area": "plot area unit",
    "plot length": "plot length unit",
    "plot breadth": "plot breadth unit",
    "width of the road plot facing": "width unit"
};


    let json;
    try {
        json = JSON.parse(formData);
    } catch (e) {
        $('#additional-info').html('<p class="text-muted">Additional information not available</p>');
        return;
    }

    /* =============================
     * STORE UNITS
     * ============================= */
    const tempUnitValues = {};
    json.forEach(field => {
        if (!field.label || !field.userData) return;
        const key = normalize(field.label);

        Object.entries(areaUnitMap).forEach(([areaKey, unitKey]) => {
            if (key === unitKey && field.userData[0]) {
                tempUnitValues[areaKey] = field.userData[0];
            }
        });
    });

    /* =============================
     * GROUP BY SECTION
     * ============================= */
    const sections = {};
    let currentSection = null;
    let priceNegotiableValue = null; // ✅ RESTORED

    json.forEach(field => {

        if (field.type === 'header') {
            currentSection = normalize(field.label);
            sections[currentSection] = [];
            return;
        }

        if (!currentSection || !field.userData || !field.userData.length) return;
        if (!field.userData.some(v => v && !v.toLowerCase().includes('select'))) return;

        let value = 'N/A';

        if (field.type === 'radio-group' || field.type === 'select') {
            const selected = field.userData[0];
            if (field.values) {
                const opt = field.values.find(v => v.value === selected || v.label === selected);
                if (opt && !opt.label.toLowerCase().includes('select')) {
                    value = opt.label;
                }
            } else {
                value = selected;
            }
        }
        else if (field.type === 'checkbox-group') {
            value = field.userData.join(', ');
        }
        else {
            value = field.userData.join(', ');
        }

        const label = stripHtml(field.label);
        const key = normalize(label);

        /* Append unit */
        if (areaUnitMap[key] && tempUnitValues[key]) {
            value += ' ' + tempUnitValues[key];
        }

        /* Skip unit-only rows */
        if (Object.values(areaUnitMap).includes(key)) return;

        /* Capture Price Negotiable */
        if (key === 'price negotiable') {
            priceNegotiableValue = value;
        }

        /* Format price */
        if (
            key.includes('price') ||
            key.includes('amount') ||
            key.includes('rent') ||
            key.includes('charge')
        ) {
            value = formatIndianPrice(value);
        }

        sections[currentSection].push({ label, value });
    });

    /* =============================
     * RENDER
     * ============================= */
    let html = '<div class="row">';

    SECTION_ORDER.forEach(section => {

        if (!sections[section] || !sections[section].length) return;

        html += `
            <div class="col-sm-12 mb-2 mt-4">
                <h4 style="color:#2c8c56;font-size:24px;font-weight:700;
                margin-bottom:10px;border-bottom:2px solid #e38e32;padding-bottom:8px;">
                    ${section.replace(/\b\w/g, l => l.toUpperCase())}
                </h4>
            </div>
        `;

        sections[section].forEach(item => {
            html += `
                <div class="col-sm-6">
                    <div class="info-item">
                        <div class="info-label">${item.label}</div>
                        <div class="info-value fw-bold text-dark">${item.value}</div>
                    </div>
                </div>
            `;
        });

        
        /* ✅ DESCRIPTION AFTER FURNISHING STATUS */
        if (section === 'furnishing status') {
            const description = <?php echo json_encode($property_detail->description, 15, 512) ?>;
            if (description) {
                html += `
                    <div class="col-sm-12 mb-2 mt-4">
                        <h4 style="color:#2c8c56;font-size:24px;font-weight:700;
                        margin-bottom:10px;border-bottom:2px solid #e38e32;padding-bottom:8px;">
                            Property Description
                        </h4>
                        <div class="bg-light p-4 rounded">
                            <p class="mb-0">${description}</p>
                        </div>
                    </div>
                `;
            }
        }
    });

    html += '</div>';
    $('#additional-info').html(html);

    /* Optional legacy support */
    if (priceNegotiableValue && priceNegotiableValue.toLowerCase() !== 'no') {
        $('#price-negotiable').text('Price Negotiable : ' + priceNegotiableValue);
    }

});


		function createMap(lat, lng) {
			var map = L.map('propertyMap').setView([lat, lng], 16);
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '&copy; OpenStreetMap contributors'
			}).addTo(map);

			var marker = L.marker([lat, lng], { draggable: true }).addTo(map);
			document.getElementById('latitude').value = lat;
			document.getElementById('longitude').value = lng;

			marker.on('dragend', function (e) {
				var p = e.target.getLatLng();
				document.getElementById('latitude').value = p.lat;
				document.getElementById('longitude').value = p.lng;
			});

			map.on('click', function (e) {
				marker.setLatLng(e.latlng);
				document.getElementById('latitude').value = e.latlng.lat;
				document.getElementById('longitude').value = e.latlng.lng;
			});
		}

		<?php if(!empty($property_detail->latitude) && !empty($property_detail->longitude)): ?>
			// Property has saved lat/lng; use those
			createMap(<?php echo e($property_detail->latitude); ?>, <?php echo e($property_detail->longitude); ?>);
		<?php else: ?>
																																																																																													if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (pos) {
					createMap(pos.coords.latitude, pos.coords.longitude);
				}, function () {
					createMap(28.6139, 77.2090); // fallback: Delhi
				});
			} else {
				createMap(28.6139, 77.2090);
			}
		<?php endif; ?>


		document.addEventListener('DOMContentLoaded', function () {
			var wishlistBtn = document.getElementById('wishlistButton');
			if (wishlistBtn) {
				wishlistBtn.addEventListener('click', function () {
					var button = this;
					var submissionId = button.getAttribute('data-submission');

					<?php if(!Auth::user()): ?>
						Swal.fire({
							icon: 'info',
							title: 'Login Required',
							text: 'Please login to manage your wishlist.',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK'
						});
						return;
					<?php endif; ?>

					fetch("<?php echo e(route('wishlist.toggle')); ?>", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
						},
						body: JSON.stringify({ property_id: submissionId })
					}).then(response => response.json())
						.then(data => {
							if (data.added) {
								button.textContent = '❤️ Added to Wishlist';
								Swal.fire({
									icon: 'success',
									title: 'Added!',
									text: 'Property added to your wishlist.',
									timer: 1500,
									showConfirmButton: false
								});
							} else {
								button.textContent = '♡ Add to Wishlist';
								Swal.fire({
									icon: 'info',
									title: 'Removed',
									text: 'Property removed from your wishlist.',
									timer: 1500,
									showConfirmButton: false
								});
							}
						}).catch(() => {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Could not update wishlist. Please try again.',
								confirmButtonColor: '#d33'
							});
						});
				});
			}

		});

		$(".loading").css('display', 'none');
	
		document.addEventListener("DOMContentLoaded", function () {
			const enquiryForm = document.querySelector(".property-contact form");
			const sendEnquiryBtn = document.getElementById("sendEnquiryBtn");

			// only trigger OTP if user not logged in
			<?php if(!Auth::check()): ?>
				sendEnquiryBtn.addEventListener("click", function (e) {
					e.preventDefault(); // ✅ stops page reload
					const mobile = enquiryForm.querySelector('input[name="mobile_number"]').value.trim();
					if (!mobile) {
						Swal.fire({
							icon: 'warning',
							title: 'Mobile Number Required',
							text: 'Please enter your mobile number before continuing.',
						});
						return;
					}
					// open OTP modal
					$('#otpModal').modal('show');
					document.getElementById("otpMobile").value = mobile;

				});
			<?php else: ?>
				// logged in → submit directly
				sendEnquiryBtn.addEventListener("click", function () {
					let formData = new FormData(enquiryForm); // ✅ use existing variable
					submitEnquiry(formData);
				});
			<?php endif; ?>

			// Send OTP
			document.getElementById("sendOtpBtn").addEventListener("click", function () {
				const mobile_number = document.getElementById("otpMobile").value.trim();
				if (!mobile_number) {
					Swal.fire({
						icon: 'warning',
						title: 'Missing Mobile Number',
						text: 'Please enter a mobile number to send OTP.',
					});
					return;
				}

				fetch("<?php echo e(route('agent.send-otp')); ?>", {
					method: "POST",
					headers: {
						"X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
						"Content-Type": "application/json"
					},
					body: JSON.stringify({ mobile_number })
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							Swal.fire({
								icon: 'info',
								title: 'OTP Sent!',
								text: 'We have sent a 4-digit OTP to your mobile number.',
								confirmButtonColor: '#ffc107'
							});
							document.getElementById("otpStep1").style.display = "none";
							document.getElementById("otpStep2").style.display = "block";
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Failed to Send OTP',
								text: data.message || "Failed to send OTP",
							});
						}
					});
			});

			// Verify OTP
			document.getElementById("verifyOtpBtn").addEventListener("click", function (e) {
				e.preventDefault();

				let formData = new FormData(document.getElementById('enquiryForm'));
				formData.append('otp', document.getElementById('otpCode').value);

				submitEnquiry(formData);
			});
			// Resend OTP
			document.getElementById("resendOtp").addEventListener("click", function (e) {
				e.preventDefault();
				document.getElementById("sendOtpBtn").click();
			});


			// ✅ Common function for submitting final enquiry
			function submitEnquiry(formData) {
				fetch("<?php echo e(route('enquery.agent_enquiry')); ?>", {
					method: "POST",
					headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
					body: formData
				})
					.then(res => res.json())
					.then(data => {

						if (data.success === true || data.success === "true") {
							console.log('Response from server:', data);
							$('#otpModal').modal('hide');

							document.getElementById('enquiryForm').reset();

							Swal.fire({
								icon: 'success',
								title: 'Enquiry Sent!',
								text: 'Your enquiry has been sent successfully!',
								confirmButtonColor: '#ffc107'
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Invalid OTP',
								text: data.message || 'Please enter the correct OTP.',
							});
						}
					})
					.catch(() => {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Error sending enquiry. Please try again later.',
						});
					});
			}
		});

		document.getElementById('scrollToEnquiry')?.addEventListener('click', function () {
    const target = document.getElementById('enquiry-section');
    if (target) {
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
        target.classList.add('shadow-lg');
        setTimeout(() => target.classList.remove('shadow-lg'), 1200);
    }
});

		$(document).ready(function () {
			// Show/hide listing options
			$('#listingcorrect').change(function () {
				const val = $(this).val();
				$('.fakelisting, .notreachable').hide();
				if (val === '2') $('.fakelisting').show();
				if (val === '3') $('.notreachable').show();
			});

			// Send OTP
			$('#feedbackSendOtp').click(function () {
				const mobile = $('#feedbackMobile').val().trim();
				if (!mobile) {
					Swal.fire('Warning', 'Please enter mobile number', 'warning');
					return;
				}

				fetch("<?php echo e(route('feedback.send-otp')); ?>", {
					method: "POST",
					headers: { "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>", "Content-Type": "application/json" },
					body: JSON.stringify({ mobile_number: mobile })
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							Swal.fire('OTP Sent', 'OTP sent to your mobile number', 'info');
							$('#feedbackOtpDiv').show();
						} else {
							Swal.fire('Error', data.message || 'Failed to send OTP', 'error');
						}
					});
			});

			// Verify OTP
			$('#feedbackVerifyOtp').click(function () {
				const mobile = $('#feedbackMobile').val().trim();
				const otp = $('#feedbackOtpCode').val().trim();

				if (!otp) {
					Swal.fire('Warning', 'Please enter OTP', 'warning');
					return;
				}

				fetch("<?php echo e(route('feedback.verify-otp')); ?>", {
					method: "POST",
					headers: { "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>", "Content-Type": "application/json" },
					body: JSON.stringify({ mobile_number: mobile, otp: otp })
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							Swal.fire('Verified', 'OTP verified successfully', 'success');
							$('#otpVerified').val('1'); // mark OTP as verified
						} else {
							Swal.fire('Error', data.message || 'Invalid OTP', 'error');
						}
					});
			});

			$('#feedbackResendOtp').click(function (e) {
				e.preventDefault();
				$('#feedbackSendOtp').click();
			});

			// Feedback Submission
			$('#feedbackForm').submit(function (e) {
				e.preventDefault();

				if ($('#otpVerified').val() != '1') {
					Swal.fire('Warning', 'Please verify your mobile number via OTP', 'warning');
					return;
				}

				const form = $(this);
				const formData = new FormData(this);

				fetch(form.attr('action'), {
					method: 'POST',
					headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
					body: formData
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							Swal.fire('Success', 'Feedback submitted successfully', 'success');
							form[0].reset();
							$('#feedbackOtpDiv').hide();
							$('#otpVerified').val('0');
							$('.fakelisting, .notreachable').hide();
							$('#feedback-complaint').modal('hide');
						} else {
							Swal.fire('Error', data.message || 'Failed to submit feedback', 'error');
						}
					})
					.catch(() => Swal.fire('Error', 'Something went wrong', 'error'));
			});
		});
	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_detail.blade.php ENDPATH**/ ?>