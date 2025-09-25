

<?php $__env->startSection('title'); ?>
	<title><?php echo e($property_detail->title); ?> - <?php echo e(config('app.name')); ?></title>
	<style type="text/css">
		.rendered-form {
			margin-left: 15px;
		}
	</style>
<?php $__env->stopSection(); ?>

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
										<h3> <?php echo e($property_detail->title); ?></h3>
										<div class="loc-id-detail">
											<ul>
												<li><i class="fas fa-map-marker"></i>
													<?php echo e(isset($property_detail->location->location) ? $property_detail->location->location : ''); ?>

												</li>
												<li><i class="fas fa-home"></i> 248239</li>
											</ul>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="price-detail">
											<h3><i class="fas fa-rupee-sign"></i> <span class="property_price">
													<?php echo e(isset($property_detail->price) ? number_format($property_detail->price) : ''); ?>

												</span> </h3>
											<a href="#property-othercharges"><i class="fas fa-info-circle"></i> Other
												Charges</a>
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
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">Property Type</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->property_types ? $property_detail->property_types->type : ''); ?>

													</div>
												</div>

												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">State</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->get_state ? $property_detail->get_state->name : ''); ?>

													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">City</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->get_city ? $property_detail->get_city->name : ''); ?>

													</div>
												</div>

												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">Address</div>
													<div class="detail-field-value"><?php echo e($property_detail->address); ?></div>
												</div>
												<div class="col-sm-12 col-md-12 col-xs-6">
													<div class="detail-field-label">Price Label</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->getPriceLabels($property_detail->price_label) ?? 'N/A'); ?>

														<?php if($property_detail->price_label_second): ?>
															<div>
																<strong><?php echo e(optional($property_detail->getPriceLabelObj())->second_input_label ?? 'Date'); ?>:</strong>
																<span><?php echo e($property_detail->price_label_second); ?></span>
															</div>
														<?php endif; ?>
													</div>
												</div>

												<div class="col-sm-12 col-md-12 col-xs-6">
													<div class="detail-field-label">Property Status</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->property_status ? $property_detail->getPropertyStatuses($property_detail->property_status) : 'N/A'); ?>

														<?php if($property_detail->property_status_second): ?>
															<div>
																<strong><?php echo e(optional($property_detail->getPropertyStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
																<span><?php echo e($property_detail->property_status_second); ?></span>
															</div>
														<?php endif; ?>
													</div>
												</div>

												<div class="col-sm-12 col-md-12 col-xs-6">
													<div class="detail-field-label">Registration Status</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->registration_status ? $property_detail->getRegistrationStatuses($property_detail->registration_status) : 'N/A'); ?>

														<?php if($property_detail->registration_status_second): ?>
															<div>
																<strong><?php echo e(optional($property_detail->getRegistrationStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
																<span><?php echo e($property_detail->registration_status_second); ?></span>
															</div>
														<?php endif; ?>
													</div>
												</div>

												<div class="col-sm-12 col-md-12 col-xs-6">
													<div class="detail-field-label">Furnishing Status</div>
													<div class="detail-field-value">
														<?php echo e($property_detail->furnishing_status ? $property_detail->getFurnishingStatuses($property_detail->furnishing_status) : 'N/A'); ?>

														<?php if($property_detail->furnishing_status_second): ?>
															<div>
																<strong><?php echo e(optional($property_detail->getFurnishingStatusObj())->second_input_label ?? 'Date'); ?>:</strong>
																<span><?php echo e($property_detail->furnishing_status_second); ?></span>
															</div>
														<?php endif; ?>
													</div>
												</div>


											</div>
										</div>


										<div class="property-featured-btn">
											<ul>
												<li><button type="button" class="btn btn-fill" data-toggle="modal"
														data-target="#contact-agent"
														onclick='window.active_listing_id = "<?php echo e($property_detail->id); ?>"'>Contact
														Agent</button>
												</li>
												<li><button type="button" class="btn btn-outline"
														onclick="claim('<?php echo e($property_detail->id); ?>')">Claim Listing</button>
												</li>
												<li><button type="button" class="btn btn-outline" data-toggle="modal"
														data-target="#feedback-complaint">Feedback / Complaint</button>
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
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14237.956091373446!2d80.9541594!3d26.8562!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfb5cc225b2f58aa2!2sWeb%20Mingo%20IT%20Solutions%20Pvt.%20Ltd.%20-%20Website%20Designing%20%26%20Digital%20Marketing%20Company!5e0!3m2!1sen!2sin!4v1591787359000!5m2!1sen!2sin"
										width="100%" height="200px" frameborder="0" style="border:0;" allowfullscreen=""
										aria-hidden="false" tabindex="0"></iframe>
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
						<div id="additional-info"></div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card property-widgets">
						<div class="property-title">
							<h3>Contact Agent</h3>
						</div>
						<div class="property-contact">
							<form method="post" action="<?php echo e(url('send/enquery')); ?>">
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
										<button class="btn btn-submit" type="submit">Send Enquiry</button>
										<p>By sending a request., you accept our Terms of Use and Privacy Policy</p>
									</div>
								</div>
							</form>
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
													(Floor,Amenities,Furnished</label></li>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<script type="text/javascript">
		$(".loading").css('display', 'none');
		$(document).ready(function () {
			setTimeout(function () {
				var formData = $('#form-json').val();
				var json_data = JSON.parse(formData);
				console.log(json_data);
				var formRenderOptions = { formData };
				frInstance = $('#additional-info').formRender(formRenderOptions);
				$("#additional-info :input").prop("disabled", true);
			}, 2000);
		});
	</script>
	<script type="text/javascript">
		$("#contact_agent_form").validate({
			rules: {
				mobile_number: {
					number: true,
					minlength: 10,
					maxlength: 10,
				}
			},
			submitHandler: function () {
				var formData = $("#contact_agent_form").serializeArray();
				formData.push({ name: 'property_id', value: "<?php echo e($property_detail->id); ?>" });

				$.ajax({
					url: "<?php echo e(config('app.api_url') . '/property/agent_enquiry'); ?>",
					method: 'post',
					data: formData,
					beforeSend: function () {
						$(".loading").css('display', 'block');
					},
					success: function (response) {
						if (response.responseCode === 200) {
							toastr.success('Enquiry sent successfully')
							$("#contact_agent_form").trigger('reset');
						} else {
							toastr.error(response.message);
						}
					},
					error: function (response) {
						toastr.error('An error occured');
					},
					complete: function () {
						$(".loading").css('display', 'none');
					}
				})

			}
		});


		// 


		// $("#feedback_form").validate({
		// 	// rules:{
		// 	// 	mobile_number:{
		// 	// 		number:true,
		// 	// 		minlength:10,
		// 	// 		maxlength:10,
		// 	// 	}
		// 	// },
		// 	submitHandler:function() {
		// 		var formData = $("#feedback_form").serializeArray();
		// 		formData.push({name: 'property_id', value:"<?php echo e($property_detail->id); ?>"});

		// 		$.ajax({
		// 			url: "<?php echo e(config('app.api_url') . '/property/feedback'); ?>",
		// 			method:'post',
		// 			data: formData,
		// 			beforeSend:function(){
		// 				$(".loading").css('display','block');
		// 			},
		// 			success:function(response){
		// 				if(response.responseCode === 200) {
		// 					toastr.success('Feedback submitted successfully')
		// 					$("#feedback_form").trigger('reset');
		// 				} else {
		// 					toastr.error(response.message);
		// 				}
		// 			}, 
		// 			error:function(response) {
		// 				var response = JSON.parse(response.responseText);
		// 				response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
		// 			},
		// 			complete:function(){
		// 				$(".modal").modal('hide');
		// 				$(".loading").css('display','none');
		// 			}
		// 		})

		// 	}
		// });

		unit_price('property_price', $(".property_price").text());

		<?php if(auth()->guard()->check()): ?>
			mask_label('mask_email', 'Email', '<?php echo e(Auth::user()->email); ?>');
			mask_label('mask_number', 'Mobile Number:', '<?php echo e(Auth::user()->mobile_number); ?>');
		<?php endif; ?>
	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_detail.blade.php ENDPATH**/ ?>