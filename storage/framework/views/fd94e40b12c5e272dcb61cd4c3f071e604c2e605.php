
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
					<div class="card property-widgets">
						<div class="property-main-top">
							<div class="property-top">
								<div class="row">
									<div class="col-sm-7">
										<h3 class="property-title">
											<?php echo e($property_detail->title); ?>

											<?php if($property_detail->verified_tag === 'Yes'): ?>
												<span class="badge bg-success ms-2">
													<i class="bi bi-patch-check-fill"></i> Verified
												</span>
											<?php endif; ?>
										</h3>
										<div class="loc-id-detail">
											<ul>
												<li>
													<i class="fas fa-map-marker-alt"></i>
													<?php echo e($property_detail->getCity ? $property_detail->getCity->name : ''); ?><?php echo e($property_detail->getState ? ', ' . $property_detail->getState->name : ''); ?>

												</li>
											</ul>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="price-detail">
											<h3><i class="fas fa-rupee-sign"></i> <span class="property_price">
													<?php echo e(isset($property_detail->price) ? \App\Helpers\Helper::formatIndianPrice($property_detail->price) : ''); ?>

												</span> </h3>
											<span id="price-negotiable"></span>
										</div>
									</div>
								</div>
							</div>
							<hr />
							<div class="property-featured-details">
								<div class="row">
									<div class="col-sm-4">
										<div class="property-main-img">
											<img src="<?php echo e(isset($property_detail->PropertyGallery[0]) ? url('/') . '/' . $property_detail->PropertyGallery[0]->image_path : ''); ?>"
												class="img-fluid">
										</div>
									</div>
									<div class="col-sm-8">
										<div class="property-featured-det">
											<div class="row">
												<!-- Category -->
												<?php if($property_detail->Category): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Property Available For</div>
														<div class="detail-field-value">
															<?php echo e($property_detail->Category->category_name); ?>

														</div>
													</div>
												<?php endif; ?>
												<!-- Sub Category -->
												<?php if($property_detail->SubCategory): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Category</div>
														<div class="detail-field-value">
															<?php echo e($property_detail->SubCategory->sub_category_name); ?>

														</div>
													</div>
												<?php endif; ?>
												<!-- Sub Sub Category -->
												<?php if($property_detail->SubSubCategory): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Property Type</div>
														<div class="detail-field-value">
															<?php echo e($property_detail->SubSubCategory->sub_sub_category_name); ?>

														</div>
													</div>
												<?php endif; ?>
												<!-- State -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">State</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->getState ? $property_detail->getState->name : 'N/A'); ?>

													</div>
												</div>
												<!-- City -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">City</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->getCity ? $property_detail->getCity->name : 'N/A'); ?>

													</div>
												</div>
												<!-- Location -->
												<?php if($property_detail->Location): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Location</div>
														<div class="detail-field-value">
															<?php echo e($property_detail->Location->location); ?>

														</div>
													</div>
												<?php endif; ?>
												<!-- Sub Location -->
												<?php if($property_detail->sub_location_id): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Sub Location</div>
														<div class="detail-field-value">
															<?php echo e(\App\SubLocations::find($property_detail->sub_location_id)->sub_location_name ?? 'N/A'); ?>

														</div>
													</div>
												<?php endif; ?>
												
												<?php if($property_user): ?>
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Posted By</div>
														<div class="detail-field-value">
															<?php echo e($property_user->firstname); ?>

															<?php echo e($property_user->lastname); ?>

															(<?php echo e(ucfirst($property_user->role ?? 'User')); ?>)
														</div>
													</div>
												<?php endif; ?>
												
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">Published Date</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->published_date ?? 'Not Published'); ?>

													</div>
												</div>
												<!-- Total Views -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">Total Views</div>
													<div class="detail-field-value">
														<?php echo e(number_format($property_detail->total_views)); ?>

													</div>
												</div>
											</div>
										</div>

										<div class="property-featured-btn">
											<ul>
												<li>
													<button type="button" class="btn btn-outline"
														onclick="claim('<?php echo e($property_detail->id); ?>')">
														Claim Listing
													</button>
												</li>
												<li>
													<button type="button" class="btn btn-outline" data-toggle="modal"
														data-target="#feedback-complaint">
														Feedback / Complaint
													</button>
												</li>
												<li>
													<button id="wishlistButton"
														class="btn btn-outline purchase-wishlist-btn"
														data-submission="<?php echo e($property_detail->id); ?>">
														<?php echo $isInWishlist ? '❤️ Added to Wishlist' : '♡ Add to Wishlist'; ?>

													</button>
												</li>
											</ul>
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
							<h3>Property Gallery</h3>
						</div>

						<div class="property-gallery">
							<div class="row">

								
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

					



					<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Description</h3>
						</div>
						<div class="property-description">
							<div class="row">
								<div class="col-sm-12">
									<p> <?php echo e(isset($property_detail->description) ? $property_detail->description : ''); ?> </p>
								</div>
							</div>
						</div>
					</div>

					<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Location</h3>
						</div>
						<div class="property-location">
							<div class="row">
								<div class="col-sm-12">
									<div id="propertyMap"
										style="width:100%; height:400px; border-radius: 8px; margin-bottom: 10px;"></div>
									<input type="hidden" id="latitude" name="latitude"
										value="<?php echo e($property_detail->latitude); ?>">
									<input type="hidden" id="longitude" name="longitude"
										value="<?php echo e($property_detail->longitude); ?>">
								</div>
							</div>
						</div>
					</div>

					<?php if(count($amenities) > 0): ?>
						<div class="card property-widgets">
							<div class="property-title">
								<h3>Property Amenities</h3>
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
							<h3>Property Additional Details</h3>
						</div>

						<div class="property-additional-details">
							<div class="row">
								<!-- Price Label -->
								<?php if($property_detail->price_label): ?>
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Price Label</div>
										<div class="detail-field-value">
											<?php echo e($property_detail->getPriceLabels($property_detail->price_label) ?? 'N/A'); ?>

											<?php if($property_detail->price_label_second): ?>
												<div class="mt-2">
													<strong><?php echo e(optional($property_detail->getPriceLabelObj())->second_input_label ?? 'Date'); ?>:</strong>
													<span><?php echo e($property_detail->price_label_second); ?></span>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<!-- Property Status -->
								<?php if($property_detail->property_status): ?>
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Property Status</div>
										<div class="detail-field-value">
											<?php echo e($property_detail->getPropertyStatuses($property_detail->property_status) ?? 'N/A'); ?>

											<?php if($property_detail->property_status_second): ?>
												<div class="mt-2">
													<strong><?php echo e(optional($property_detail->getPropertyStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
													<span><?php echo e($property_detail->property_status_second); ?></span>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<!-- Registration Status -->
								<?php if($property_detail->registration_status): ?>
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Registration Status</div>
										<div class="detail-field-value">
											<?php echo e($property_detail->getRegistrationStatuses($property_detail->registration_status) ?? 'N/A'); ?>

											<?php if($property_detail->registration_status_second): ?>
												<div class="mt-2">
													<strong><?php echo e(optional($property_detail->getRegistrationStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
													<span><?php echo e($property_detail->registration_status_second); ?></span>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<!-- Furnishing Status -->
								<?php if($property_detail->furnishing_status): ?>
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Furnishing Status</div>
										<div class="detail-field-value">
											<?php echo e($property_detail->getFurnishingStatuses($property_detail->furnishing_status) ?? 'N/A'); ?>

											<?php if($property_detail->furnishing_status_second): ?>
												<div class="mt-2">
													<strong><?php echo e(optional($property_detail->getFurnishingStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
													<span><?php echo e($property_detail->furnishing_status_second); ?></span>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Original form-rendered additional info -->
						<div id="additional-info"></div>
					</div>

				</div>

				<div class="col-sm-4">
					<div class="card property-widgets">
						<div class="property-title">
							<h3>
								Contact
							</h3>
						</div>
						<div class="property-contact">
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

					<div class="related-agents">
						<div class="agent-card mb-3 border">
							<div class="newdesign-image-agent">
								<?php
									$section = $property_user->profileSection;
									$logo = isset($section->logo)
										? asset('storage/' . $section->logo)
										: $property_user->avatar;
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
	<div id="viewCategoryInfo" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade custom-modal" id="feedback-complaint" tabindex="-1" role="dialog" aria-labelledby="register"
		aria-hidden="true">
		<div class="modal-dialog w-450" role="document">
			<div class="modal-content">
				<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<div class="top-design">
					<img src="<?php echo e(url('/public/images/top-designs.png')); ?>" class="img-fluid">
				</div>

				<center class="loading">
					<img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." style="height: 30px;" class="loading" />
				</center>

				<div class="modal-body">
					<div class="modal-main">
						<div class="row login-heads">
							<div class="col-sm-12">
								<h3 class="heads-login">Feedback / Complaint</h3>
								<span class="allrequired">All field are required</span>
							</div>
						</div>
						<div class="modal-form">
							<form method="post" action="<?php echo e(url('master/property/feedback/create')); ?>">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="property_id" value="<?php echo e($property_detail->id); ?>">
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

								<div class="form-group row fakelisting" style="display: none;">
									<div class="col-sm-12">
										<label class="label-control">Ohh!! What wasn't correct in the listing?</label>
										<ul class="no_listfeed" name="feedback">
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

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">That's Good! How about sharing your experience with
											us.</label>
										<textarea cols="4" rows="2" class="text-control" name="feedback"></textarea>
									</div>
								</div>

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

		function normalizeLabel(label) {
			return label
				.replace(/&nbsp;/g, ' ')
				.replace(/\s+/g, ' ')
				.replace(/-/g, ' ')
				.replace(/_/g, ' ')
				.trim()
				.toLowerCase();
		}

		function formatIndianPriceJS(num) {
			num = parseFloat(num);
			if (isNaN(num)) return num;

			return num.toLocaleString('en-IN');
		}

		// Helper function to strip HTML tags
		function stripHtml(html) {
			var tmp = document.createElement("DIV");
			tmp.innerHTML = html;
			return tmp.textContent || tmp.innerText || "";
		}

		$(document).ready(function () {
			var formData = $('#form-json').val();

			// Helper function to strip HTML tags from labels
			function stripHtml(html) {
				var tmp = document.createElement("DIV");
				tmp.innerHTML = html;
				return tmp.textContent || tmp.innerText || "";
			}

			// Normalize label for matching keys consistently
			function normalizeLabel(label) {
				return label.toLowerCase().replace(/\s+/g, ' ').trim();
			}

			// Format Indian price display function example placeholder
			function formatIndianPriceJS(value) {
				// Add your formatting logic here, e.g. commas for thousands
				return value;
			}

			if (formData) {
				try {
					var json_data = JSON.parse(formData);
					var outputHTML = '<div class="row">';
					var priceNegotiableValue = null;

					// Map for normalized area labels to their unit fields
					var areaUnitMap = {
						"built-up area": "built-up area unit",
						"carpet area": "carpet area unit",
						"super area": "super area unit",
						"plot area": "plot area unit"
					};

					var tempUnitValues = {};

					// First pass: store units in tempUnitValues
					json_data.forEach(function (field) {
						var label = field.label ? stripHtml(field.label) : '';
						var normalizedLabel = normalizeLabel(label);

						if (Object.values(areaUnitMap).includes(normalizedLabel)) {
							if (field.userData && field.userData.length > 0) {
								tempUnitValues[normalizedLabel] = field.userData[0];
							}
						}
					});

					// Second pass: render fields appending unit to area fields
					json_data.forEach(function (field) {
						if (field.type === 'header' || field.type === 'paragraph') {
							if (field.label) {
								outputHTML += '<div class="col-sm-12 mb-3"><h4 style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 10px; border-bottom: 2px solid #e38e32; padding-bottom: 8px;">' + stripHtml(field.label) + '</h4></div>';
							}
							return;
						}

						var originalLabel = field.label ? stripHtml(field.label) : 'N/A';
						var label = originalLabel;
						var value = 'N/A';

						if (field.userData && field.userData.length > 0) {
							var hasValue = field.userData.some(function (item) {
								return item !== '' && item !== null && item !== undefined;
							});

							if (hasValue) {
								if (field.type === 'radio-group' || field.type === 'select') {
									var selectedValue = field.userData[0];
									if (field.values) {
										var selectedOption = field.values.find(function (v) {
											return v.value === selectedValue;
										});
										value = selectedOption ? selectedOption.label : selectedValue;
									}
								} else if (field.type === 'checkbox-group') {
									value = field.userData.join(", ");
								} else {
									value = field.userData.join(", ");
								}
							}
						}

						var key = normalizeLabel(label);

						// Append unit for area fields using saved unit value
						if (areaUnitMap[key]) {
							var unitKey = areaUnitMap[key];
							if (tempUnitValues[unitKey]) {
								value += " " + tempUnitValues[unitKey];
							}
						}

						// Skip rendering fields that are the UNIT labels
						if (Object.values(areaUnitMap).includes(key)) {
							return; // skip unit fields from output
						}

						// Handle price negotiable separately
						if (key === "price negotiable") {
							priceNegotiableValue = value;
						}

						// Format expected price display
						if (key === "expected price") {
							value = formatIndianPriceJS(value);
						}

						outputHTML += '<div class="col-sm-6 col-md-6 mb-3">';
						outputHTML += '  <div class="detail-field-label">' + label + '</div>';
						outputHTML += '  <div class="detail-field-value">' + value + '</div>';
						outputHTML += '</div>';
					});

					outputHTML += '</div>';
					$('#additional-info').html(outputHTML);

					var finalText = "";
					if (priceNegotiableValue && priceNegotiableValue.toLowerCase() !== "no") {
						finalText = "Price Negotiable : " + priceNegotiableValue;
					}
					$("#price-negotiable").text(finalText);

				} catch (e) {
					console.error('Error parsing JSON:', e);
					$('#additional-info').html('<p style="color: #999;">Additional information not available</p>');
				}
			}
		});

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
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_detail.blade.php ENDPATH**/ ?>