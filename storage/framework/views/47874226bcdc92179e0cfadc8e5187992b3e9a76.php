

<?php $__env->startSection('title'); ?>
	<title>Edit Property</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="form-group col-sm-12">
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

								<div class="row">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="text-control populate_categories" name="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type);">
											<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($v->id); ?>" <?php echo e($property->category_id == $v->id ? "selected" : ""); ?>>
													<?php echo e($v->category_name); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											onchange="fetch_subsubcategories(this.value, fetch_form_type);">
											<option value="">Select Category</option>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="text-control populate_subsubcategories" name="sub_sub_category_id"
											id="sub_sub_category_id" onchange="fetch_form_type();">
											<option value="">Select Property Type</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-8">
										<label class="label-control">Title </label>
										<input type="text" class="text-control" name="title"
											placeholder="Enter Property Name" value="<?php echo e($property->title); ?>" required />
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="text-control" name="price" min="0"
											placeholder="Enter Price" value="<?php echo e($property->price); ?>" required />
									</div>
								</div>

								<div class="form-row">
									
									<?php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="priceLabelField" class="form-group <?php echo e($col); ?>" style="display:none;">
										<label class="label-control d-flex">Price Label</label>
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

										
										<div class="mt-2" id="price_label_second_container" style="display:none;">
											<label id="price_label_second_label" class="label-control"></label>
											<input type="date" name="price_label_second" class="form-control"
												value="<?php echo e(old('price_label_second')); ?>">
										</div>

									</div>


									
									<?php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="propertyStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
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

										<div class="mt-2" id="property_status_second_container" style="display:none;">
											<label id="property_status_second_label" class="label-control"></label>
											<input type="date" name="property_status_second" class="form-control"
												value="<?php echo e(old('property_status_second')); ?>">
										</div>

									</div>


									
									<?php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="registrationStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
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
													<option value="<?php echo e($status->id); ?>" <?php echo e($property->registration_status == $status->id ? 'selected' : ''); ?>><?php echo e($status->name); ?>

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

										<div class="mt-2" id="registration_status_second_container" style="display:none;">
											<label id="registration_status_second_label" class="label-control"></label>
											<input type="date" name="registration_status_second" class="form-control"
												value="<?php echo e(old('registration_status_second')); ?>">
										</div>

									</div>


									
									<?php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; ?>
									<div id="furnishingStatusField" class="form-group <?php echo e($col); ?>" style="display:none;">
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
													<option value="<?php echo e($status->id); ?>" <?php echo e($property->furnishing_status == $status->id ? 'selected' : ''); ?>><?php echo e($status->name); ?>

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

										<div class="mt-2" id="furnishing_status_second_container" style="display:none;">
											<label id="furnishing_status_second_label" class="label-control"></label>
											<input type="date" name="furnishing_status_second" class="form-control"
												value="<?php echo e(old('furnishing_status_second')); ?>">
										</div>

									</div>

								</div>

								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description"
											required> <?php echo e($property->description); ?></textarea>
									</div>
								</div>

								<div id="amenitiesField" style="display:none;">
									<h4 class="form-section-h">Amenities</h4>
									<div class="row">
										<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-sm-3">
												<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
												<p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>"
														<?php if(in_array($amenity->id, explode(',', $property->amenities))): ?> checked
														<?php endif; ?>> <?php echo e($amenity->name); ?></p>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>

								<h4 class="form-section-h">Property Location</h4>
								<div class="row">
									<div class="form-group col-sm-6">
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
									<div class="form-group col-sm-6">
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
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">Location </label>
										<select class="text-control" name="location_id" id="location_id" required="">
											<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($property->location_id == $location->id): ?>
													<option value="<?php echo e($location->id); ?>" selected=""><?php echo e($location->location); ?>

													</option>
												<?php else: ?>
													<option value="<?php echo e($location->id); ?>"><?php echo e($location->location); ?></option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<option value="other">Others</option>
										</select>

										<div id="custom-location-container" style="display:none; margin-top:10px;">
											<input type="text" class="text-control" name="custom_location_input" accept=""
												id="custom_location_input" placeholder="Enter new location" />
										</div>

									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">Sub Location</label>
										<select class="text-control" name="sub_location_id[]" id="sub_location_id" multiple>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="text-control" placeholder="Enter Address" id="address"
											name="address" value="<?php echo e($property->address); ?>" required />
									</div>
								</div>

								<div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
								<input type="hidden" name="latitude" id="latitude">
								<input type="hidden" name="longitude" id="longitude">

								<h3>Uploaded Photos</h3>
								<div class="form-group dropzone row">
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
								<div class="row">
									<div class="form-group col-sm-12 ">
										<div class="dropzone">
											<input type="file" id="fileInput" multiple accept="image/*">
											<div id="previewContainer" class="mt-2 d-flex flex-wrap gap-2"></div>
										</div>
										<small class="text-muted">Max allowed photos: <?php echo e($photos_per_listing); ?></small>

									</div>
								</div>

								<?php if($video_upload === 'Yes'): ?>
									<h3>Property Video</h3>
									<div class="form-group row">
										<div class="form-group col-sm-12">
											<?php if(!empty($property->property_video)): ?>
												<video width="100%" height="240" controls style="margin-bottom: 10px;">
													<source src="<?php echo e(url($property->property_video)); ?>" type="video/mp4">
													Your browser does not support the video tag.
												</video>
												<br>
											<?php endif; ?>
											<input type="file" name="property_video" accept="video/*" class="form-control">
										</div>
									</div>
								<?php endif; ?>

								<h4 class="form-section-h">Property Additional Information</h4>
								<div id="fb-render"></div>
							</div>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<div class="card property-right-widgets">
							<div class="form-sep">
								<h3>Contact Information</h3>

								<div class="form-group row">
									<div class="form-group col-sm-6">
										<label class="label-control">First Name</label>
										<input type="text" class="text-control " placeholder="Enter First Name"
											id="firstname" name="firstname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->firstname); ?><?php else: ?><?php echo e(old('firstname')); ?><?php endif; ?>"
											required="" readonly="" />
									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">Last Name</label>
										<input type="text" class="text-control " placeholder="Enter Last Name" id="lastname"
											name="lastname"
											value="<?php if(\Auth::user()): ?><?php echo e(\Auth::user()->lastname); ?><?php else: ?><?php echo e(old('lastname')); ?><?php endif; ?>"
											required="" readonly="" />
									</div>
								</div>

								<div class="form-group row">
									<div class="form-group col-sm-12">
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
							</div>
							<input type="hidden" name="form_json" id="form_json">
							<input type="hidden" name="save_json" id="save_json" value="<?php echo e($property->additional_info); ?>">
						</div>
					</div>


					<div class="form-group col-sm-12 mt-4 text-center">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<script type="text/javascript">
		let selectedFiles = []; // new files user selects
		const maxPhotos = <?php echo e($photos_per_listing ?? 10); ?>; // from backend (limit)
		const existingPhotos = <?php echo e($property_images->count()); ?>; // current photos already uploaded

		document.getElementById('fileInput').addEventListener('change', function (event) {
			const newFiles = Array.from(event.target.files);

			// 🧩 Calculate total count including already uploaded ones
			const totalUploaded = existingPhotos + selectedFiles.length + newFiles.length;

			if (maxPhotos > 0 && totalUploaded > maxPhotos) {
				const remaining = maxPhotos - (existingPhotos + selectedFiles.length);
				alert(`You can only upload ${remaining > 0 ? remaining : 0} more photo(s).`);
				event.target.value = ''; // reset input
				return;
			}

			selectedFiles.push(...newFiles);
			renderPreviews();

			// reset input so same file can be reselected later
			event.target.value = '';
		});

		function renderPreviews() {
			const container = document.getElementById('previewContainer');
			container.innerHTML = '';

			selectedFiles.forEach((file, index) => {
				const reader = new FileReader();
				reader.onload = (e) => {
					const div = document.createElement('div');
					div.classList.add('position-relative', 'm-1');
					div.innerHTML = `
								<img src="${e.target.result}" class="rounded border" width="100" height="100">
								<button type="button" class="btn btn-sm btn-danger" 
									style="position:absolute;top:0;right:0;" 
									onclick="removeImage(${index})">&times;</button>
							`;
					container.appendChild(div);
				};
				reader.readAsDataURL(file);
			});
		}

		function removeImage(index) {
			selectedFiles.splice(index, 1);
			renderPreviews();
		}

		<?php if(!empty($property->latitude) && !empty($property->longitude)): ?>

			// Initialize map with property coordinates
			createMap(<?php echo e($property->latitude); ?>, <?php echo e($property->longitude); ?>);
		<?php else: ?>
																									// Otherwise use browser geolocation or default
																									if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (pos) {
					createMap(pos.coords.latitude, pos.coords.longitude);
				}, function () {
					createMap(28.6139, 77.2090); // fallback Delhi
				});
			} else {
				createMap(28.6139, 77.2090);
			}
		<?php endif; ?>


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

		$(function () {
			$(".populate_categories,  .populate_locations").change();

			$(".add_formtype").empty().append(
				`<center class='m0-auto'> Please select category </center>`
			);

			fetch_subcategories('<?php echo e($property->category_id); ?>', function () {
				$(".populate_subcategories").val('<?php echo e($property->sub_category_id); ?>');
				fetch_form_type();
				fetch_subsubcategories('<?php echo e($property->sub_category_id); ?>', function () {
					$(".populate_subsubcategories").val('<?php echo e($property->sub_sub_category_id); ?>');
					fetch_form_type();
				});
			});


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

					// Append the "Others" option at the end
					$('#location_id').append('<option value="other">Others</option>');
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
								$(".btn-delete").attr('disabled', false);
							}
						})
					}
				});
		}


		//-------------------- Get sub categories By category --------------------//
		function fetch_subcategories(id, callback) {
			// var route = "<?php echo e(route('admin.sub_category.fetch_subcategories_by_cat_id', ['id' => ':id'])); ?>";
			var route = "<?php echo e(url('get/sub-categories')); ?>/" + id  // var route = route.replace(':id', id);
			$.ajax({
				url: route,
				method: 'get',
				beforeSend: function () {
					$(".updateproperty").attr('disabled', true);
					$(".location").css('display', 'block');
				},
				success: function (response) {
					// var response = JSON.parse(response);
					if (response.status === 200) {
						$(".populate_subcategories").empty();
						var subcategories = response.subcategories;
						if (subcategories.length > 0) {
							$.each(subcategories, function (x, y) {
								$(".populate_subcategories").append(
									`<option> Select </option>`
								);
								$(".populate_subcategories").append(
									`<option value=${y.id}> ${y.sub_category_name} </option>`
								);
							});
						} else {
							$(".populate_subcategories").append(
								`<option value=''> No records found </option>`
							);
						}
						if (callback) {
							callback();
						}
					}
				},
				error: function (response) {
					toastr.error('An error occured while fetching sub categories');
				},
				complete: function () {
					$(".location").css('display', 'none');
					$(".updateproperty").attr('disabled', false);
				}
			})
		}


		//-------------------- Get sub sub categories By sub category --------------------//
		var cachedSubSubCategories = {};
		function fetch_subsubcategories(id, callback) {
			$('#sub_sub_category_id').html('<option value="">Loading...</option>');
			var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + id;

			$.ajax({
				url: route,
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
					if (response.subsubcategories && response.subsubcategories.length > 0) {
						cachedSubSubCategories = response.subsubcategories || [];

						$.each(response.subsubcategories, function (i, subsub) {
							let selected = (<?php echo e($property->sub_category_id ?? 0); ?> == subsub.id) ? "selected" : "";
							$('#sub_sub_category_id').append(
								'<option value="' + subsub.id + '" ' + selected + '>' + subsub.sub_sub_category_name + '</option>'
							);
						});

					} else {
						$('#sub_sub_category_id').append('<option value="">No property type found</option>');
					}


					if (callback) {
						callback();
					}

				},
				error: function () {
					$('#sub_sub_category_id').html('<option value="">Error loading</option>');
				}
			});
		}


		$('#sub_sub_category_id').on('change', function () {
			var selectedId = $(this).val();

			if (!selectedId) {
				// Optionally hide those toggle fields if no sub sub category selected
				toggleSubSubCategoryFields({
					price_label_toggle: false,
					property_status_toggle: false,
					registration_status_toggle: false,
					furnishing_status_toggle: false,
					amenities_toggle: false,
				});
				return;
			}

			var selectedData = cachedSubSubCategories.find(function (subsub) {
				return subsub.id == selectedId;
			});



			if (selectedData) {
				toggleSubSubCategoryFields({
					price_label_toggle: selectedData.price_label_toggle,
					property_status_toggle: selectedData.property_status_toggle,
					registration_status_toggle: selectedData.registration_status_toggle,
					furnishing_status_toggle: selectedData.furnishing_status_toggle,
					amenities_toggle: selectedData.amenities_toggle
				});
			} else {
				// No matching sub sub category found, hide fields
				toggleSubSubCategoryFields({
					price_label_toggle: false,
					property_status_toggle: false,
					registration_status_toggle: false,
					furnishing_status_toggle: false,
					amenities_toggle: false
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

			if (toggles.amenities_toggle == 'yes') {
				$('#amenitiesField').show();
			} else {
				$('#amenitiesField').hide();
			}

		}


		function fetch_form_type() {
			var cat = $(".populate_categories option:selected").val();
			var subcat = $(".populate_subcategories option:selected").val();
			var subsubcat = $(".populate_subsubcategories option:selected").val();

			var route = "<?php echo e(url('category/related-form')); ?>";
			$.ajax({
				url: route,
				method: 'post',
				data: {
					"_token": "<?php echo e(csrf_token()); ?>",
					'category': cat,
					'sub_category': subcat,
					'sub_sub_category': subsubcat,
				},
				beforeSend: function () {
					$(".addproperty").attr('disabled', true);
					$(".add_formtype").empty();
				},
				success: function (response) {
					if (response != 0) {

						if (
							'<?php echo e($property->category_id); ?>' == response.category_id ||
							'<?php echo e($property->sub_category_id); ?>' == response.sub_category_id ||
							'<?php echo e($property->sub_sub_category_id); ?>' == response.sub_sub_category_id
						) {
							document.getElementById('fb-render').innerHTML = '';
							var formData = $('#save_json').val();
							var formRenderOptions = { formData };
							frInstance = $('#fb-render').formRender(formRenderOptions);

						} else {
							document.getElementById('fb-render').innerHTML = '';
							var formData = response.form_data;
							var formRenderOptions = { formData };
							frInstance = $('#fb-render').formRender(formRenderOptions);
						}

					} else {
						document.getElementById('fb-render').innerHTML = '';
						// toastr.error('No Any Form Found');
					}
				},
				error: function (response) {
					toastr.error('An error occured');
				},
				complete: function () {
					$(".addproperty").attr('disabled', false);
				}
			})
		}



		function handleSecondInput(selectId, containerId, checkboxClass) {
			const select = document.getElementById(selectId);
			const container = document.getElementById(containerId);
			const label = container.querySelector('label');

			if (select) {
				function toggle() {
					const option = select.selectedOptions[0];
					const show = option.dataset.secondInput === 'yes';
					label.textContent = option.dataset.secondLabel || '';
					container.style.display = show ? 'block' : 'none';
				}
				select.addEventListener('change', toggle);
				toggle(); // initialize
			}

			if (checkboxClass) {
				const checkboxes = document.querySelectorAll(checkboxClass);
				function toggleCheckbox() {
					let show = false;
					let lbl = '';
					checkboxes.forEach(cb => {
						if (cb.checked && cb.dataset.secondInput === 'yes') {
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

		$('#location_id').on('change', function () {
			// toggle new location input
			if ($(this).val() && $(this).val() === 'other') {
				$('#custom-location-container').show();
			} else {
				$('#custom-location-container').hide();
			}
			// load sub locations for selected location
			var location_id = $('#location_id').val();
			if (!location_id || location_id === 'other') { $('#sub_location_id').empty().trigger('change'); return; }
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
					$('#sub_location_id').empty();
					$.each(result, function (key, location) {
						$("#sub_location_id").append('<option value="' + location.id + '">' + location.sub_location_name + '</option>');
					});
					// reselect existing values from property
					var selectedIds = "<?php echo e($property->sub_location_id ?? ''); ?>";
					console.log(selectedIds, 'ids');

					if (selectedIds) {
						var arr = selectedIds.split(',');
						$('#sub_location_id').val(arr).trigger('change');
					}
				}
			});
		});
		// Initialize Sub Location select2 with tagging
		function initEditSubLocationSelect2() {
			$('#sub_location_id').select2({
				tags: true,
				width: '100%',
				placeholder: 'Select or add sub locations',
				closeOnSelect: false,
				createTag: function (params) {
					var term = $.trim(params.term);
					if (term === '') { return null; }
					return { id: term, text: term, isNew: true };
				}
			});
		}
		initEditSubLocationSelect2();

		// On load: trigger city->locations and preload sublocations
		$(document).ready(function () {
			var locId = $('#location_id').val();
			if (locId) { $('#location_id').trigger('change'); }
		});



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

			var data = $('#add').formRender('userData');
			if (!data) {
				toastr.error('Additional details form must be required, please select another category or contact to admin.');
			} else {
				document.getElementById('form_json').value = JSON.stringify(data);
				const form = document.getElementById('create-property');
				const formData = new FormData(form);

				// Append all selected images
				selectedFiles.forEach((file, i) => {
					formData.append('gallery_images_file[]', file);
				});

				// Example AJAX submit (replace with your actual logic)
				fetch("<?php echo e(url('update/property')); ?>", {
					method: "POST",
					body: formData
				})
					.then(res => res.json())
					.then(response => {
						if (response.success) {
							toastr.success(response.message);
							// Redirect to preview page after short delay
							setTimeout(() => {
								window.location.href = response.redirect_url;
							}, 1000);
						} else {
							toastr.error(response.message || 'Something went wrong.');
						}
					})
					.catch(err => toastr.error('Server error!'));
			}
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/edit_property.blade.php ENDPATH**/ ?>