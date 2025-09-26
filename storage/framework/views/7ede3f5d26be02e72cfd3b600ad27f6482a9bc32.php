

<?php $__env->startSection('title'); ?>
	<title>Post Property</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>Post Property</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Post Property</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<form method="post" action="<?php echo e(url('front/create-property')); ?>" id="create-property" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<section class="postproperty-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Property Description &amp; Price</h3>
								<div class="form-group row">
									<div class="col-sm-8">
										<label class="label-control">Property Title</label>
										<input type="text" class="text-control" placeholder="Title" name="title" id="title"
											value="<?php echo e(old('title')); ?>" required />
									</div>
									<div class="col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="text-control" placeholder="Enter Price" name="price"
											id="price" value="<?php echo e(old('price')); ?>" required />
									</div>
									<!-- <div class="col-sm-4">
																			<label class="label-control">Type</label>
																			<select class="text-control" name="type_id" id="type_id" required>
																				<option value="">Select Type</option>
																				<?php if(old('type_id') == 1): ?>
																					<option value="1" selected="">Commercial</option>
																					<option value="2">Agricultural</option>
																					<option value="3">Industrial</option>
																					<option value="4">Free Hold</option>
																				<?php elseif(old('type_id') == 2): ?>
																					<option value="1">Commercial</option>
																					<option value="2" selected="">Agricultural</option>
																					<option value="3">Industrial</option>
																					<option value="4">Free Hold</option>
																				<?php elseif(old('type_id') == 3): ?>
																					<option value="1">Commercial</option>
																					<option value="2">Agricultural</option>
																					<option value="3" selected="">Industrial</option>
																					<option value="4">Free Hold</option>
																				<?php elseif(old('type_id') == 4): ?>
																					<option value="1">Commercial</option>
																					<option value="2">Agricultural</option>
																					<option value="3">Industrial</option>
																					<option value="4" selected="">Free Hold</option>
																				<?php else: ?>
																					<option value="1">Commercial</option>
																					<option value="2">Agricultural</option>
																					<option value="3">Industrial</option>
																					<option value="4">Free Hold</option>
																				<?php endif; ?>
																			</select>
																		</div> -->
								</div>

								<div class="form-row">

									
									<?php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="priceLabelField" class="form-group <?php echo e($col); ?>">
										<label class="label-control">Price Label</label>

										<?php if($price_labels->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" class="price_checkbox" value="<?php echo e($label->id); ?>"
														data-second-input="<?php echo e($label->second_input); ?>"
														data-second-label="<?php echo e($label->second_input_label); ?>" name="price_label[]" <?php echo e(in_array($label->id, old('price_label', [])) ? 'checked' : ''); ?>>
													<?php echo e($label->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select class="form-control" name="price_label" id="price_label">
												<?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($label->id); ?>" data-second-input="<?php echo e($label->second_input); ?>"
														data-second-label="<?php echo e($label->second_input_label); ?>" <?php echo e(old('price_label') == $label->id ? 'selected' : ''); ?>>
														<?php echo e($label->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										
										<div class="mt-2" id="price_label_second_container" style="display:none;">
											<label id="price_label_second_label"></label>
											<input type="date" name="price_label_second" class="form-control"
												value="<?php echo e(old('price_label_second')); ?>">
										</div>
									</div>

									
									<?php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="propertyStatusField" class="form-group <?php echo e($col); ?>">
										<label class="label-control">Property Status</label>

										<?php if($property_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" class="property_checkbox" value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>"
														name="property_status[]" <?php echo e(in_array($status->id, old('property_status', [])) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select class="form-control" name="property_status" id="property_status">
												<?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('property_status') == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<div class="mt-2" id="property_status_second_container" style="display:none;">
											<label id="property_status_second_label"></label>
											<input type="date" name="property_status_second" class="form-control"
												value="<?php echo e(old('property_status_second')); ?>">
										</div>
									</div>

									
									<?php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="registrationStatusField" class="form-group <?php echo e($col); ?>">
										<label class="label-control">Registration Status</label>

										<?php if($registration_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" class="registration_checkbox" value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>"
														name="registration_status[]" <?php echo e(in_array($status->id, old('registration_status', [])) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select class="form-control" name="registration_status" id="registration_status">
												<?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('registration_status') == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<div class="mt-2" id="registration_status_second_container" style="display:none;">
											<label id="registration_status_second_label"></label>
											<input type="date" name="registration_status_second" class="form-control"
												value="<?php echo e(old('registration_status_second')); ?>">
										</div>
									</div>

									
									<?php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="furnishingStatusField" class="form-group <?php echo e($col); ?>">
										<label class="label-control">Furnishing Status</label>

										<?php if($furnishing_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" class="furnishing_checkbox" value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>"
														name="furnishing_status[]" <?php echo e(in_array($status->id, old('furnishing_status', [])) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select class="form-control" name="furnishing_status" id="furnishing_status">
												<?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>"
														data-second-input="<?php echo e($status->second_input); ?>"
														data-second-label="<?php echo e($status->second_input_label); ?>" <?php echo e(old('furnishing_status') == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<div class="mt-2" id="furnishing_status_second_container" style="display:none;">
											<label id="furnishing_status_second_label"></label>
											<input type="date" name="furnishing_status_second" class="form-control"
												value="<?php echo e(old('furnishing_status_second')); ?>">
										</div>
									</div>

								</div>


								<div class="form-group row">
									<div class="col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="text-control populate_categories" name="category_id" id="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type)" required="">
											<?php if(count($category) < 1): ?>
												<option value="">No records found</option>
											<?php else: ?>
												<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>

									</div>
									<div class="col-sm-4">
										<label class="label-control">Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											id="sub_category_id" onchange="fetch_form_type()" required>
											<option value="">Select Category</option>
										</select>

									</div>

									<div class="col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="text-control populate_subsubcategories" name="sub_sub_category_id"
											id="sub_sub_category_id" onchange="fetch_form_type();">
											<option value="">Select Property Type</option>
										</select>
									</div>

								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description" id="description"
											required=""><?php echo e(old('description')); ?></textarea>
									</div>
								</div>

								<h3>Amenities</h3>
								<div class="form-group row">
									<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-sm-3">
											<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
											<p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>">
												<?php echo e($amenity->name); ?></p>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>

								<h3>Property Location</h3>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">State </label>
										<select class="form-control" name="state" id="state" required="">
											<option value="">Select State </option>
											<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="col-sm-6">
										<label class="label-control">City </label>
										<select class="form-control" name="city" id="city" required="">

										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">Location </label>
										<select class="text-control populate_locations" name="location_id[]"
											id="location_id" multiple="" required="">

										</select>

									</div>
									<div class="col-sm-6">
										<label class="label-control">Sub Location </label>
										<select class="text-control" name="sub_location_id[]" id="sub_location_id"
											multiple="" required>
											<option value="">Select Sub Location</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="text-control" placeholder="Enter Address" id="address"
											name="address" value="<?php echo e(old('address')); ?>" required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<iframe
											src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14237.956091373446!2d80.9541594!3d26.8562!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfb5cc225b2f58aa2!2sWeb%20Mingo%20IT%20Solutions%20Pvt.%20Ltd.%20-%20Website%20Designing%20%26%20Digital%20Marketing%20Company!5e0!3m2!1sen!2sin!4v1590990421763!5m2!1sen!2sin"
											width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen=""
											aria-hidden="false" tabindex="0"></iframe>
									</div>
								</div>


								<h3>Property Photos</h3>
								<div class="form-group row">
									<div class="col-sm-12">
										<div class="dropzone">
											<input type="file" id="file" name="gallery_images_file[]" multiple required />
										</div>
									</div>
								</div>

								<h4 class="form-section-h">Property Additional Information</h4>

								<center class="loading">
									<img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" />
								</center>
								<div id="fb-render"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card property-right-widgets">
							<div class="form-sep">
								<center class="loading_2">
									<img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading_2" />
								</center>
								<h3>Contact Information</h3>
								<div class="form-group mb-0 row">
									<div class="col-sm-12">
										<label class="label-control">Ownership Type</label>
										<ul class="ownertype">
											<?php if(\Auth::user()): ?>
												<?php if(\Auth::user()->role == 'owner'): ?>
													<li><label><input type="radio" name="owner_type" value="1" checked="" />
															Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php elseif(\Auth::user()->role == 'builder'): ?>
													<li><label><input type="radio" name="owner_type" value="1" /> Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" checked="" />
															Builder</label></li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php elseif(\Auth::user()->role == 'agent'): ?>
													<li><label><input type="radio" name="owner_type" value="1" /> Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" checked="" />
															Agent</label></li>
												<?php else: ?>
													<li><label><input type="radio" name="owner_type" value="1" checked="" />
															Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php endif; ?>
											<?php else: ?>
												<?php if(old('owner_type') == 1): ?>
													<li><label><input type="radio" name="owner_type" value="1" checked="" />
															Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php elseif(old('owner_type') == 2): ?>
													<li><label><input type="radio" name="owner_type" value="1" /> Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" checked="" />
															Builder</label></li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php elseif(old('owner_type') == 3): ?>
													<li><label><input type="radio" name="owner_type" value="1" /> Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" checked="" />
															Agent</label></li>
												<?php else: ?>
													<li><label><input type="radio" name="owner_type" value="1" checked="" />
															Owner</label></li>
													<li><label><input type="radio" name="owner_type" value="2" /> Builder</label>
													</li>
													<li><label><input type="radio" name="owner_type" value="3" /> Agent</label></li>
												<?php endif; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">First Name</label>
										<input type="text" class="text-control " placeholder="Enter First Name"
											id="firstname" name="firstname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->firstname); ?><?php else: ?><?php echo e(old('firstname')); ?><?php endif; ?>"
											required="" />
									</div>
									<div class="col-sm-6">
										<label class="label-control">Last Name</label>
										<input type="text" class="text-control " placeholder="Enter Last Name" id="lastname"
											name="lastname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->lastname); ?><?php else: ?><?php echo e(old('lastname')); ?><?php endif; ?>"
											required="" />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="text-control email" placeholder="Enter Email" id="email"
											name="email"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>"
											required="" />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-8">
										<label class="label-control">Mobile No.</label>
										<div class="d-flex">
											<div>
												<input type="number" class="text-control mobile_number"
													placeholder="Enter Mobile No."
													value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->mobile_number); ?><?php else: ?><?php echo e(old('mobile_number')); ?><?php endif; ?>"
													id="mobile_number" name="mobile_number" required />
											</div>
											&nbsp;
											<div style="align-self: center;">
												<button type="button" class="btn btn-sm btn-success"
													onclick="send_otp(this);"><i class="fas fa-check"></i></button>
											</div>
										</div>
										<span>You'll receive an OTP.</span>
									</div>
									<div class="col-sm-4">
										<label class="label-control">OTP</label>
										<input type="text" class="text-control" placeholder="Enter OTP" id="contact_otp"
											name="otp" value="<?php echo e(old('otp')); ?>" required />
									</div>
								</div>
								<div class="loading_3">
									<img src="<?php echo e(url('/') . '/images/loading.gif'); ?>" alt="Loading.." class="loading_3" />
								</div>
								<?php if(!\Auth::user()): ?>
									<div class="form-group row">
										<div class="col-sm-6">
											<label class="label-control">State</label>
											<select class="form-control" name="state_id" id="state_id"
												onchange="loadCities(this.value, 'register_page_city_id');" required="">
												<option value="">Select</option>
												<?php if(count($states) < 1): ?>
													<option value="">No records found</option>
												<?php else: ?>
													<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												<?php endif; ?>
											</select>
										</div>
										<div class="col-sm-6">
											<label class="label-control">City</label>
											<select class="form-control populate_cities" id="register_page_city_id"
												name="city_id" required="">
												<option>Select City</option>
											</select>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<input type="hidden" name="form_json" id="form_json">
						</div>
					</div>


					<div class="col-sm-12 mt-4 text-center">
						<div class="loading_4">
							<img src="<?php echo e(url('/') . '/images/loading.gif'); ?>" alt="Loading.." class="loading_4" />
						</div>
						<button class="btn btn-postproperty" type="button" onclick="createProperty()">Post Property <i
								class="fas fa-chevron-circle-right"></i></button>
					</div>

				</div>
			</div>
		</section>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<script type="text/javascript">

		$(function () {
			$(".loading_2").css('display', 'none');
			$(".loading_3").css('display', 'none');
			$(".loading_4").css('display', 'none');
			$(".populate_categories,  .populate_locations").change();

			$(".add_formtype").empty().append(
				`<center class='m0-auto'> Please select category </center>`
			);

			// Dropzone.autoDiscover = false;
			// jQuery(document).ready(function() {

			//   $(".dropzone").dropzone({
			//     url: "/file/post"
			//   });

			// });
		});

		//-------------------- Get city By state --------------------//
		$('#state').on('change', function () {
			var state_id = this.value;
			$("#city").html('');
			$.ajax({
				url: "<?php echo e(route('front.getCities')); ?>",
				type: "POST",
				data: {
					state_id: state_id,
					_token: '<?php echo e(csrf_token()); ?>',
				},
				dataType: 'json',
				success: function (result) {
					$('#city').html('<option value="">Select City</option>');
					$.each(result, function (key, city) {
						$("#city").append('<option value="' + city.id + '" >' + city.name + '</option>');
					});
				}
			});
		});

		//-------------------- Get city By state --------------------//
		$('#city').on('change', function () {
			var city_id = this.value;
			$("#location_id").html('');
			$.ajax({
				url: "<?php echo e(route('front.getLocations')); ?>",
				type: "POST",
				data: {
					city_id: city_id,
					_token: '<?php echo e(csrf_token()); ?>',
				},
				dataType: 'json',
				success: function (result) {
					$('#location_id').html('<option value="">Select Location</option>');
					$.each(result, function (key, location) {
						$("#location_id").append('<option value="' + location.id + '" >' + location.location + '</option>');
					});
				}
			});
		});

		$('#location_id').on('change', function () {
			var location_id = $('#location_id').val();
			$("#sub_location_id").html('');
			$.ajax({
				url: "<?php echo e(route('front.getSubLocations')); ?>",
				type: "POST",
				data: {
					location_id: location_id,
					_token: '<?php echo e(csrf_token()); ?>',
				},
				dataType: 'json',
				success: function (result) {
					$('#sub_location_id').html('<option value="">Select Location</option>');
					$.each(result, function (key, location) {
						$("#sub_location_id").append('<option value="' + location.id + '" >' + location.sub_location_name + '</option>');
					});
				}
			});
		});

		function send_otp(element) {

			var email = $(".email").val();
			var mobile_number = $(".mobile_number").val();
			$.ajax({
				url: "<?php echo e(config('app.api_url') . '/property/create_visitor_otp'); ?>",
				method: "POST",
				data: {
					"_token": $("input[name='_token']").val(),
					"mobile_number": mobile_number,
					"email": email
				},
				beforeSend: function () {
					$(".loading_2").css('display', 'block');
					$(element).addClass('disabled');
				},
				success: function (response) {
					response.success == 'true' ? toastr.success(response.message) : toastr.error('An error occured');
				},
				error: function (response) {
					var response = JSON.parse(response.responseText);
					response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
				},
				complete: function () {
					$(".loading_2").css('display', 'none');
					$(element).removeClass('disabled');
				}

			})
		}

		var frInstance;
		function fetch_subcategories(id, callback) {
			var route = "<?php echo e(url('get/sub-categories')); ?>/" + id
			$.ajax({
				url: route,
				method: 'get',
				beforeSend: function () {
					$(".addproperty").attr('disabled', true);
					$(".add_formtype").empty();
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					// var response = JSON.parse(response);
					if (response.status === 200) {
						$(".populate_subcategories").empty().append(`<option value=''>Select category </option>`);
						var subcategories = response.subcategories;
						if (subcategories.length > 0) {
							$.each(subcategories, function (x, y) {
								$(".populate_subcategories").append(
									`<option value=${y.id}> ${y.sub_category_name} </option>`
								);
							});
						} else {
							$(".populate_subcategories").append(
								`<option value=''> Please add a category </option>`
							);
						}
						if (callback) {
							callback();
						}
					}
				},
				error: function (response) {
					toastr.error('An error occured while fetching subcategories');
				},
				complete: function () {
					$(".loading").css('display', 'none');
					// $(".addproperty").attr('disabled', false);
				}
			})
		}

		var cachedSubSubCategories = {}; // Object to store sub sub categories keyed by subcategory ID

		$('#sub_category_id').on('change', function () {
			var subcategoryId = $(this).val();
			$('#sub_sub_category_id').html('<option value="">Loading...</option>');
			var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + subcategoryId
			$.ajax({
				url: route, // Change this to your route
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
					console.log(response, 'response');

					if (response.subsubcategories && response.subsubcategories.length) {
						cachedSubSubCategories = response.subsubcategories || [];

						$.each(response.subsubcategories, function (i, subsub) {
							$('#sub_sub_category_id').append('<option value="' + subsub.id + '">' + subsub.sub_sub_category_name + '</option>');
						});
					} else {
						$('#sub_sub_category_id').append('<option value="">No property type found</option>');
					}
				},
				error: function () {
					$('#sub_sub_category_id').html('<option value="">Error loading</option>');
				}
			});
		});


		$('#sub_sub_category_id').on('change', function () {
			var selectedId = $(this).val();

			if (!selectedId) {
				// Optionally hide those toggle fields if no sub sub category selected
				toggleSubSubCategoryFields({
					price_label_toggle: false,
					property_status_toggle: false,
					registration_status_toggle: false,
					furnishing_status_toggle: false
				});
				return;
			}

var selectedData = cachedSubSubCategories.find(function(subsub) {
    return subsub.id == selectedId;
});



if (selectedData) {
    toggleSubSubCategoryFields({
        price_label_toggle: selectedData.price_label_toggle,
        property_status_toggle: selectedData.property_status_toggle,
        registration_status_toggle: selectedData.registration_status_toggle,
        furnishing_status_toggle: selectedData.furnishing_status_toggle
    });
} else {
    // No matching sub sub category found, hide fields
    toggleSubSubCategoryFields({
        price_label_toggle: false,
        property_status_toggle: false,
        registration_status_toggle: false,
        furnishing_status_toggle: false
    });
}

	
		});


		// This function is called when subsubcategory changes or after loading toggles
		function toggleSubSubCategoryFields(toggles) {
			
			if (toggles.price_label_toggle == 'yes') {
				$('#priceLabelField').show();
			} else {
				$('#priceLabelField').hide();
			}

			if (toggles.property_status_toggle == 'yes') {
				$('#propertyStatusField').show();
			} else {
				$('#propertyStatusField').hide();
			}

			if (toggles.registration_status_toggle == 'yes') {
				$('#registrationStatusField').show();
			} else {
				$('#registrationStatusField').hide();
			}

			if (toggles.furnishing_status_toggle == 'yes') {
				$('#furnishingStatusField').show();
			} else {
				$('#furnishingStatusField').hide();
			}
		}


		function fetch_form_type() {
			var cat = $(".populate_categories option:selected").val();
			var subcat = $(".populate_subcategories option:selected").val();

			// if(subcat=="") {
			// 	clearFormType(true);
			// 	return true;
			// }

			var route = "<?php echo e(url('category/related-form')); ?>";
			$.ajax({
				url: route,
				method: 'post',
				data: {
					"_token": "<?php echo e(csrf_token()); ?>",
					'category': cat,
					'sub_category': subcat,
				},
				beforeSend: function () {
					$(".addproperty").attr('disabled', true);
					$(".add_formtype").empty();
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					if (response != 0) {
						document.getElementById('fb-render').innerHTML = '';
						var formData = response.form_data;
						var formRenderOptions = { formData };
						frInstance = $('#fb-render').formRender(formRenderOptions);
					} else {
						document.getElementById('fb-render').innerHTML = '';
						toastr.error('No Any Form Found');
					}
				},
				error: function (response) {
					toastr.error('An error occured');
				},
				complete: function () {
					$(".loading").css('display', 'none');
					$(".addproperty").attr('disabled', false);
				}
			})
		}


		function fetch_sublocations(id) {
			var route = "<?php echo e(config('app.api_url')); ?>/fetch_sublocations/" + id;

			$.ajax({
				url: route,
				method: 'get',
				beforeSend: function () {
					// $(".addproperty").attr('disabled', true);
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					// var response = JSON.parse(response);
					if (response.responseCode === 200) {
						$(".populate_sublocations").empty();
						var sublocations = response.data.SubLocation;
						if (!jQuery.isEmptyObject(sublocations)) {
							$.each(sublocations, function (x, y) {
								$(".populate_sublocations").append(
									`<option value=${y.id}> ${y.sub_location_name} </option>`
								);
							})
						} else {
							$(".populate_sublocations").append(
								`<option value=''> Please add a sub location </option>`
							);
						}
					}
				},
				error: function (response) {
					toastr.error('An error occured while fetching sub locations');
				},
				complete: function () {
					$(".loading").css('display', 'none');
					// $(".addproperty").attr('disabled', false);
				}
			})
		}

		function returnIfInvalid() {
			toastr.error('Atleast one feature should be checked!');
			return true;
		}



		jQuery.validator.addMethod("restrict_special_chars", function (value, element) {
			if (value.length == 0 && value == "") {
				return true;
			}
			if (/[a-zA-Z0-9-]$/.test(value)) {
				return true;  // FAIL validation when REGEX matches
			} else {
				return false;   // PASS validation otherwise
			};
		}, 'Special characters not allowed. Please try again.');

		// $(this).validate();
		$("#create_property_form").validate({
			rules: {
				title: {
					restrict_special_chars: true
				},
				price: {
					minlength: 1,
					maxlength: 10
				}
			},

			submitHandler: function (e) {

				// console.log(this.form);
				var formData = new FormData(document.getElementById("create_property_form"));
				var obj = {};
				// console.log('aa');
				var isValid = false;
				$(".input").each(function (x, y) {
					// console.log(y);
					if ($(this).attr('data-input-type')) {
						var input_type = $(this).attr('data-input-type');
						let objKey = $(this).attr('data-sub-feature-id').replace(/\ /g, '');
						let objVal = $(this).val();
						if (input_type == "1") {
							if ($(this).is(':checked')) {
								obj[objKey] = objVal;
								isValid = true;
							}
						} else if (input_type == "3") {
							if ($(this).is(':checked')) {
								if (objVal != "") {
									obj[objKey] = objVal;
									isValid = true;
								}
							}
						} else if (input_type == "2") {
							if (objVal != "") {
								// console.log(objVal)
								obj[objKey] = objVal;
								isValid = true;
							}
						} else {
							obj[objKey] = objVal;
							// isValid = true;			
						}
					}
				});
				formData.append('listing_features', JSON.stringify(obj));
				<?php if(auth()->guard()->guest()): ?>
					formData.append('is_visitor', true);
				<?php endif; ?>

												// console.log(obj)
												if (jQuery.isEmptyObject(obj)) {
					returnIfInvalid();
				}

				// console.log(isValid);
				if (isValid) {
					$.ajax({
						url: "<?php echo e(config('app.api_url') . '/property'); ?>",
						method: "POST",
						data: formData,
						datatype: 'json',
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function (request) {
							$(".addproperty").attr('disabled', true);
							$(".loading_4").css('display', 'block');
							<?php if(auth()->guard()->check()): ?>
								request.setRequestHeader('auth-token', '<?php echo e(Auth::user()->auth_token); ?>');
							<?php endif; ?>
															},
						success: function (response) {
							// var response = JSON.parse(response);
							if (response.responseCode === 200) {
								toastr.success(response.message)
								$("#create_property_form").trigger('reset');
								<?php if(auth()->guard()->guest()): ?>
									//          	setTimeout(function() {
									// window.location.href = "<?php echo e(route('admin.properties.index')); ?>";
									//          	}, 1000);
								<?php endif; ?>
																	} else if (response.responseCode === 400) {
								toastr.error(response.message)
							} else {
								toastr.error('An error occured')
							}
						},
						error: function (xhr) {
							var response = JSON.parse(xhr.responseText);
							response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
						},
						complete: function () {
							formData = {};
							$(".loading_4").css('display', 'none');
							// $(".addproperty").attr('disabled', false);
						}
					})
				}

				return false;

			}
		});

		jQuery(function ($) {
			getUserDataBtn.addEventListener(
				"click",
				() => {
					window.alert(window.JSON.stringify($(fbRender).formRender("userData")));
				},
				false
			);
		});

		function createProperty() {
			var title = $('#title').val();
			// var type = $('#type_id').val();
			var price = $('#price').val();
			if (title == '') {
				$('#title').focus();
				toastr.warning('Title field must be required.')
				return false;
			}
			// if (type == '') {
			// 	$('#type_id').focus();
			// 	toastr.warning('Type field must be required.')
			// 	return false;
			// }
			if (price == '') {
				$('#price').focus();
				toastr.warning('Price field must be required.')
				return false;
			}
			var label = $("input[name=price_label]").val();
			// if(!label) {
			// 	$('#price_label').focus();
			// 	toastr.warning('Price label field must be required.')
			// 	return false;
			// }
			var category = $('#category_id').val();
			var sub_category = $('#sub_category_id').val();
			var status = $('#status').val();
			if (category == '') {
				$('#category_id').focus();
				toastr.warning('Property Available For field must be required.')
				return false;
			}
			if (sub_category == '') {
				$('#sub_category_id').focus();
				toastr.warning('Category field must be required.')
				return false;
			}
			if (status == '') {
				$('#status').focus();
				toastr.warning('Status field must be required.')
				return false;
			}
			var description = $('#description').val();
			var address = $('#address').val();
			var location_id = $('#location_id').val();
			var sub_location_id = $('#sub_location_id').val();
			var file = $('#file').val();
			if (description == '') {
				$('#description').focus();
				toastr.warning('Description field must be required.')
				return false;
			}
			if (address == '') {
				$('#address').focus();
				toastr.warning('Address field must be required.')
				return false;
			}
			if (location_id == '') {
				$('#location_id').focus();
				toastr.warning('Location id field must be required.')
				return false;
			}
			if (sub_location_id == '') {
				$('#sub_location_id').focus();
				toastr.warning('Sub Location id field must be required.')
				return false;
			}
			if (file == '') {
				$('#file').focus();
				toastr.warning('Photos field must be required.')
				return false;
			}
			var ownertype = $("input[name=owner_type]").val();
			if (!ownertype) {
				toastr.warning('Qwnership type field must be required.')
				return false;
			}
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var email = $('#email').val();
			var mobile_number = $('#mobile_number').val();
			var contact_otp = $('#contact_otp').val();
			var state_id = $('#state_id').val();
			var register_page_city_id = $('#register_page_city_id').val();
			if (firstname == '') {
				$('#firstname').focus();
				toastr.warning('First name field must be required.')
				return false;
			}
			if (lastname == '') {
				$('#lastname').focus();
				toastr.warning('Last name field must be required.')
				return false;
			}
			if (email == '') {
				$('#email').focus();
				toastr.warning('Email field must be required.')
				return false;
			}
			if (mobile_number == '') {
				$('#mobile_number').focus();
				toastr.warning('Mobile Number field must be required.')
				return false;
			}
			if (contact_otp == '') {
				$('#contact_otp').focus();
				toastr.warning('Otp field must be required.')
				return false;
			}
			if (state_id == '') {
				$('#state_id').focus();
				toastr.warning('State field must be required.')
				return false;
			}
			if (register_page_city_id == '') {
				$('#register_page_city_id').focus();
				toastr.warning('City field must be required.')
				return false;
			}
			var data = $('#fb-render').formRender('userData');
			if (!data) {
				toastr.error('Additional details form must be required, please select another category or contact to admin.');
			} else {
				document.getElementById('form_json').value = JSON.stringify(data);
				document.getElementById('create-property').submit();
			}
		}


	
	

	function handleSecondInput(selectId, containerId, checkboxClass) {
	const select = document.getElementById(selectId);
	const container = document.getElementById(containerId);
	const label = container.querySelector('label');

	if(select) {
	function toggle() {
	const option = select.selectedOptions[0];
	const show = option.dataset.secondInput === 'yes';
	label.textContent = option.dataset.secondLabel || '';
	container.style.display = show ? 'block' : 'none';
	}
	select.addEventListener('change', toggle);
	toggle(); // initialize
	}

	if(checkboxClass) {
	const checkboxes = document.querySelectorAll(checkboxClass);
	function toggleCheckbox() {
	let show = false;
	let lbl = '';
	checkboxes.forEach(cb => {
	if(cb.checked && cb.dataset.secondInput === 'yes') {
	show = true;
	lbl = cb.dataset.secondLabel;
	}
	});
	label.textContent = lbl;
	container.style.display = show ? 'block' : 'none';
	}
	checkboxes.forEach(cb => cb.addEventListener('change', toggleCheckbox));
	toggleCheckbox(); // initialize
	}
	}

		// Price Label
		handleSecondInput('price_label', 'price_label_second_container', '.price_checkbox');
		// Property Status
		handleSecondInput('property_status', 'property_status_second_container', '.property_checkbox');
		// Registration Status
		handleSecondInput('registration_status', 'registration_status_second_container', '.registration_checkbox');
		// Furnishing Status
		handleSecondInput('furnishing_status', 'furnishing_status_second_container', '.furnishing_checkbox');
	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/create_property.blade.php ENDPATH**/ ?>