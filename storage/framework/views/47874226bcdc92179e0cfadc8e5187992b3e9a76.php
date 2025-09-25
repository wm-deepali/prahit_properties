

<?php $__env->startSection('title'); ?>
	<title>Edit Property</title>
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
							<li class="breadcrumb-item active" aria-current="page">Edit Property</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>


	<form method="post" action="<?php echo e(url('update/property')); ?>" id="create-property" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<input type="hidden" name="id" value="<?php echo e($property->id); ?>">
		<section class="postproperty-section">
			<div class="container">
				<div class="row">
					<input type="hidden" name="from" value="<?php echo e(app('request')->input('from')); ?>">
					<div class="col-sm-8">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Property Description &amp; Price</h3>
								<div class="form-group row">
									<div class="col-sm-8">
										<label class="label-control">Property Title</label>
										<input type="text" class="text-control" placeholder="Title" name="title" id="title"
											value="<?php echo e($property->title); ?>" required />
									</div>
									<!-- <div class="col-sm-4">
														<label class="label-control">Type</label>
														<select class="text-control" name="type_id" id="type_id" required>
															<option value="">Select Type</option>
															<?php if($property->type_id == 1): ?>
																<option value="1" selected="">Commercial</option>
																<option value="2">Agricultural</option>
																<option value="3">Industrial</option>
																<option value="4">Free Hold</option>
															<?php elseif($property->type_id == 2): ?>
																<option value="1">Commercial</option>
																<option value="2" selected="">Agricultural</option>
																<option value="3">Industrial</option>
																<option value="4">Free Hold</option>
															<?php elseif($property->type_id == 3): ?>
																<option value="1">Commercial</option>
																<option value="2">Agricultural</option>
																<option value="3" selected="">Industrial</option>
																<option value="4">Free Hold</option>
															<?php elseif($property->type_id == 4): ?>
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
									<div class="col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="text-control" placeholder="Enter Price" name="price"
											id="price" value="<?php echo e($property->price); ?>" required />
									</div>
								</div>


								<div class="form-row">

									
									<div class="form-group col-md-3">
										<label class="label-control">Price Label</label>
										<?php if($price_labels->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" name="price_label[]" value="<?php echo e($label->id); ?>" <?php echo e(in_array($label->id, explode(',', $property->price_label ?? '')) ? 'checked' : ''); ?>>
													<?php echo e($label->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select name="price_label" class="form-control">
												<option value="">Select</option>
												<?php $__currentLoopData = $price_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($label->id); ?>" <?php echo e($property->price_label == $label->id ? 'selected' : ''); ?>>
														<?php echo e($label->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<?php if(!empty($property->price_label_second)): ?>
											<div class="mt-2">
												<label>
													<?php echo e(optional($price_labels->firstWhere('id', $property->price_label))->second_input_label ?? 'Date'); ?>

												</label>
												<input type="date" class="form-control" name="price_label_second"
													value="<?php echo e($property->price_label_second); ?>">
											</div>
										<?php endif; ?>
									</div>


									
									<div class="form-group col-md-3">
										<label class="label-control">Property Status</label>
										<?php if($property_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" name="property_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->property_status ?? '')) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select name="property_status" class="form-control">
												<option value="">Select</option>
												<?php $__currentLoopData = $property_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>" <?php echo e($property->property_status == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<?php if(!empty($property->property_status_second)): ?>
											<div class="mt-2">
												<label>
													<?php echo e(optional($property_statuses->firstWhere('id', $property->property_status))->second_input_label ?? 'Date'); ?>

												</label>
												<input type="date" class="form-control" name="property_status_second"
													value="<?php echo e($property->property_status_second); ?>">
											</div>
										<?php endif; ?>
									</div>


									
									<div class="form-group col-md-3">
										<label class="label-control">Registration Status</label>
										<?php if($registration_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" name="registration_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->registration_status ?? '')) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select name="registration_status" class="form-control">
												<option value="">Select</option>
												<?php $__currentLoopData = $registration_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>" <?php echo e($property->registration_status == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<?php if(!empty($property->registration_status_second)): ?>
											<div class="mt-2">
												<label>
													<?php echo e(optional($registration_statuses->firstWhere('id', $property->registration_status))->second_input_label ?? 'Date'); ?>

												</label>
												<input type="date" class="form-control" name="registration_status_second"
													value="<?php echo e($property->registration_status_second); ?>">
											</div>
										<?php endif; ?>
									</div>


									
									<div class="form-group col-md-3">
										<label class="label-control">Furnishing Status</label>
										<?php if($furnishing_statuses->first()->input_format == 'checkbox'): ?>
											<?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<label>
													<input type="checkbox" name="furnishing_status[]" value="<?php echo e($status->id); ?>" <?php echo e(in_array($status->id, explode(',', $property->furnishing_status ?? '')) ? 'checked' : ''); ?>>
													<?php echo e($status->name); ?>

												</label>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<select name="furnishing_status" class="form-control">
												<option value="">Select</option>
												<?php $__currentLoopData = $furnishing_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($status->id); ?>" <?php echo e($property->furnishing_status == $status->id ? 'selected' : ''); ?>>
														<?php echo e($status->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										<?php endif; ?>

										<?php if(!empty($property->furnishing_status_second)): ?>
											<div class="mt-2">
												<label>
													<?php echo e(optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->second_input_label ?? 'Date'); ?>

												</label>
												<input type="date" class="form-control" name="furnishing_status_second"
													value="<?php echo e($property->furnishing_status_second); ?>">
											</div>
										<?php endif; ?>
									</div>

								</div>

								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">Category</label>
										<select class="text-control populate_categories" name="category_id" id="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type)" required="">
											<?php if(count($category) < 1): ?>
												<option value="">No records found</option>
											<?php else: ?>
												<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($property->category_id == $v->id): ?>
														<option value="<?php echo e($v->id); ?>" selected=""><?php echo e($v->category_name); ?></option>
													<?php else: ?>
														<option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
													<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>

									</div>
									<div class="col-sm-6">
										<label class="label-control">Sub Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											id="sub_category_id" required>
											<option value="">Select Sub Category</option>
										</select>

									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description" id="description"
											required=""><?php echo e($property->description); ?></textarea>
									</div>
								</div>

								<h3>Amenities</h3>
								<div class="form-group row">
									<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-sm-3">
											<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
											<p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>"
													<?php if(in_array($amenity->id, explode(',', $property->amenities))): ?> checked
													<?php endif; ?>> <?php echo e($amenity->name); ?></p>
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
												<?php if($property->state_id == $state->id): ?>
													<option value="<?php echo e($state->id); ?>" selected=""><?php echo e($state->name); ?></option>
												<?php else: ?>
													<option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="col-sm-6">
										<label class="label-control">City </label>
										<select class="form-control" name="city" id="city" required="">
											<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($property->city_id == $city->id): ?>
													<option value="<?php echo e($city->id); ?>" selected=""><?php echo e($city->name); ?></option>
												<?php else: ?>
													<option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">Location </label>
										<select class="text-control" name="location_id[]" id="location_id" multiple=""
											required="">
											<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if(in_array($location->id, explode(',', $property->location_id))): ?>
													<option value="<?php echo e($location->id); ?>" selected=""><?php echo e($location->location); ?>

													</option>
												<?php else: ?>
													<option value="<?php echo e($location->id); ?>"><?php echo e($location->location); ?></option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

									</div>
									<div class="col-sm-6">
										<label class="label-control">Sub Location </label>
										<select class="text-control" name="sub_location_id[]" id="sub_location_id"
											multiple="" required>
											<?php $__currentLoopData = $sub_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if(in_array($sub_location->id, explode(',', $property->sub_location_id))): ?>
													<option value="<?php echo e($sub_location->id); ?>" selected="">
														<?php echo e($sub_location->sub_location_name); ?>

													</option>
												<?php else: ?>
													<option value="<?php echo e($sub_location->id); ?>"><?php echo e($sub_location->sub_location_name); ?>

													</option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="text-control" placeholder="Enter Address" id="address"
											name="address" value="<?php echo e($property->address); ?>" required />
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

								<h3>Uploaded Photos</h3>
								<div class="form-group dropzone row">
									<div class="loading_4">
										<img src="<?php echo e(url('/') . '/images/loading.gif'); ?>" alt="Loading.." class="loading_4" />
									</div>
									<?php $__currentLoopData = $property_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-sm-2">
											<img src="<?php echo e(url('') . '/' . $v->image_path); ?>" style="height: 100px;"
												class="img-fluid">
											<br>
											<center>
												<i class="fa fa-trash" aria-hidden="true"
													style="cursor: pointer;color: red;font-size: 15px;"
													onclick="deleteGalleryPhoto('<?php echo e($v->id); ?>')"></i>
											</center>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<h3>Property Photos</h3>
								<div class="form-group row">
									<div class="col-sm-12">
										<div class="dropzone">
											<input type="file" id="file" name="gallery_images_file[]" multiple />
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
								<!-- 								<div class="form-group mb-0 row">
													<div class="col-sm-12">
														<label class="label-control">Ownership Type</label>
														<ul class="ownertype">
															<?php if(\Auth::user()->role == 'owner' || old('owner_type') == 1): ?>
																<li><label><input type="radio" name="owner_type" value="1" checked="" readonly="" /> Owner</label></li>
																<li><label><input type="radio" name="owner_type" value="2"  readonly=""/> Builder</label></li>
																<li><label><input type="radio" name="owner_type" value="3"  readonly=""/> Agent</label></li>
															<?php elseif(\Auth::user()->role == 'builder' || old('owner_type') == 2): ?>
																<li><label><input type="radio" name="owner_type" value="1" readonly=""/> Owner</label></li>
																<li><label><input type="radio" name="owner_type" value="2"  checked="" readonly=""/> Builder</label></li>
																<li><label><input type="radio" name="owner_type" value="3" readonly="" /> Agent</label></li>
															<?php elseif(\Auth::user()->role == 'agent' || old('owner_type') == 3): ?>
																<li><label><input type="radio" name="owner_type" value="1" readonly=""/> Owner</label></li>
																<li><label><input type="radio" name="owner_type" value="2"  readonly=""/> Builder</label></li>
																<li><label><input type="radio" name="owner_type" value="3"  checked="" readonly=""/> Agent</label></li>
															<?php else: ?>
																<li><label><input type="radio" name="owner_type" value="1" checked="" readonly=""/> Owner</label></li>
																<li><label><input type="radio" name="owner_type" value="2"  readonly=""/> Builder</label></li>
																<li><label><input type="radio" name="owner_type" value="3"  readonly=""/> Agent</label></li>
															<?php endif; ?>
														</ul>
													</div>
												</div> -->
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">First Name</label>
										<input type="text" class="text-control " placeholder="Enter First Name"
											id="firstname" name="firstname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->firstname); ?><?php else: ?><?php echo e(old('firstname')); ?><?php endif; ?>"
											required="" readonly="" />
									</div>
									<div class="col-sm-6">
										<label class="label-control">Last Name</label>
										<input type="text" class="text-control " placeholder="Enter Last Name" id="lastname"
											name="lastname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->lastname); ?><?php else: ?><?php echo e(old('lastname')); ?><?php endif; ?>"
											required="" readonly="" />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="text-control email" placeholder="Enter Email" id="email"
											name="email"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>"
											required="" readonly="" />
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
													id="mobile_number" name="mobile_number" required readonly="" />
											</div>
										</div>
									</div>
								</div>
								<div class="loading_3">
									<img src="<?php echo e(url('/') . '/images/loading.gif'); ?>" alt="Loading.." class="loading_3" />
								</div>
							</div>
							<input type="hidden" name="form_json" id="form_json">
							<input type="hidden" name="save_json" id="save_json" value="<?php echo e($property->additional_info); ?>">
						</div>
					</div>


					<div class="col-sm-12 mt-4 text-center">
						<button class="btn btn-postproperty" type="button" onclick="createProperty()">Update Property <i
								class="fas fa-chevron-circle-right"></i></button>
					</div>

				</div>
			</div>
		</section>
		<?php echo csrf_field(); ?>
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
				`<center class='m0-auto'> Please select sub category </center>`
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

		function deleteGalleryPhoto(id) {
			swal({
				title: "Are you sure?",
				text: "Delete This Image.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
				.then((willDelete) => {
					if (willDelete) {
						$(".loading_4").css('display', 'block');
						$(".btn-delete").attr('disabled', true);
						$.ajax({
							url: '<?php echo e(url('delete/property/images')); ?>',
							method: "POST",
							data: {
								"_token": "<?php echo e(csrf_token()); ?>",
								'id': id
							},
							success: function (response) {
								toastr.success(response);
								setTimeout(function () {
									location.reload();
								}, 2000);
							},
							error: function (response) {
								toastr.error('An error occured.')
							},
							complete: function () {
								$(".loading_4").css('display', 'none');
								$(".btn-delete").attr('disabled', false);
							}
						})
					}
				});
		}

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
					response.responseCode === 200 ? toastr.success(response.message) : toastr.error('An error occured');
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
						$(".populate_subcategories").empty();
						var subcategories = response.subcategories;
						if (subcategories.length > 0) {
							$.each(subcategories, function (x, y) {
								if ('<?php echo e($property->sub_category_id); ?>' == y.id)
									$(".populate_subcategories").append(
										`<option value=${y.id} selected> ${y.sub_category_name} </option>`
									);
								else
									$(".populate_subcategories").append(
										`<option value=${y.id}> ${y.sub_category_name} </option>`
									);
							});
						} else {
							$(".populate_subcategories").append(
								`<option value=''> Please add a sub category </option>`
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
					'sub_category': subcat
				},
				beforeSend: function () {
					$(".addproperty").attr('disabled', true);
					$(".add_formtype").empty();
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					if (response != 0) {
						if ('<?php echo e($property->category_id); ?>' == response.category_id) {
							document.getElementById('fb-render').innerHTML = '';
							var formData = $('#save_json').val();
							var formRenderOptions = { formData };
							frInstance = $('#fb-render').formRender(formRenderOptions);
						} else {
							document.getElementById('fb-render').innerHTML = '';
							console.log(response);
							var formData = response.form_data;
							var formRenderOptions = { formData };
							frInstance = $('#fb-render').formRender(formRenderOptions);
						}

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
								console.log(objKey);
								isValid = true;
							}
						} else if (input_type == "3") {
							if ($(this).is(':checked')) {
								if (objVal != "") {
									obj[objKey] = objVal;
									console.log(objKey);
									isValid = true;
								}
							}
						} else if (input_type == "2") {
							if (objVal != "") {
								// console.log(objVal)
								obj[objKey] = objVal;
								console.log(objKey);
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
			console.log(label);
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
				toastr.warning('Category field must be required.')
				return false;
			}
			if (sub_category == '') {
				$('#sub_category_id').focus();
				toastr.warning('Sub Category field must be required.')
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

			var data = $('#add').formRender('userData');
			if (!data) {
				toastr.error('Additional details form must be required, please select another category or contact to admin.');
			} else {
				document.getElementById('form_json').value = JSON.stringify(data);
				document.getElementById('create-property').submit();
			}
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/edit_property.blade.php ENDPATH**/ ?>