

<?php $__env->startSection('title'); ?>
	<title>Preview Property</title>
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php $__env->startSection('content'); ?>

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="form-group col-sm-12">
					<h3>Preview Property Content</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Preview Property</li>
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
					<div class="form-group col-sm-12">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Preview Property Description</h3>

								<div class="row">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="form-control populate_categories" name="category_id" disabled="">
											<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($v->id); ?>" <?php echo e($property->category_id == $v->id ? "selected" : ""); ?>>
													<?php echo e($v->category_name); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Category</label>
										<select class="form-control populate_subcategories" id="sub_category_id"
											name="sub_category_id" required disabled="">
											<option value="">Select Category</option>
											<?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($v->id); ?>" <?php echo e($property->sub_category_id == $v->id ? "selected" : ""); ?>>
													<?php echo e($v->sub_category_name); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="form-control populate_subsubcategories" name="sub_sub_category_id"
											disabled="">
											<option value="">Select Property Type</option>
											<?php $__currentLoopData = $sub_sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($v->id); ?>" <?php echo e($property->sub_sub_category_id == $v->id ? "selected" : ""); ?>>
													<?php echo e($v->sub_sub_category_name); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>

									<div class="form-group col-sm-12">
										<label class="label-control">Title </label>
										<input type="text" class="form-control" name="title"
											placeholder="Enter Property Name" value="<?php echo e($property->title); ?>" required
											readonly="" />
									</div>

									<!-- <div class="form-group col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="form-control" name="price" min="0"
											placeholder="Enter Price" value="<?php echo e($property->price); ?>" required readonly="" />
									</div> -->
						
									<div class="form-group col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="form-control" rows="2" cols="4" name="description" required
											readonly=""> <?php echo e($property->description); ?></textarea>
									</div>
								</div>

								<div id="fb-render"></div>


								<div id="amenitiesField" style="display: none;">
									<h4 class="form-section-h">Amenities</h4>
									<div class="row">
										<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-sm-3">
												<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
												<p><input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>"
														disabled="" <?php if(in_array($amenity->id, explode(',', $property->amenities))): ?> checked <?php endif; ?>>
													<?php echo e($amenity->name); ?></p>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>

								<h4 class="form-section-h">Property Location</h4>
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">State </label>
										<select class="form-control" name="state" id="state" required="" disabled="">
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
										<select class="form-control" name="city" id="city" required="" disabled="">
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
										<select class="form-control" name="location_id" id="location_id" required=""
											disabled="">
											<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($property->location_id == $location->id): ?>
													<option value="<?php echo e($location->id); ?>" selected=""><?php echo e($location->location); ?>

													</option>
												<?php else: ?>
													<option value="<?php echo e($location->id); ?>"><?php echo e($location->location); ?></option>
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">Sub Location </label>
										<input type="text" class="form-control" name="sub_location_display"
											id="sub_location_display"
											value="<?php echo e($property->sub_location_id ? $property->getSubLocations($property->sub_location_id) : ''); ?>"
											disabled />
									</div>

								</div>
									<div class="row">
    <div class="form-group col-sm-6">
        <label class="label-control">Landmark</label>
        <input type="text"
               class="form-control"
               value="<?php echo e($property->landmark); ?>"
               readonly>
    </div>

    <div class="form-group col-sm-6">
        <label class="label-control">Pin Code</label>
        <input type="text"
               class="form-control"
               value="<?php echo e($property->pincode); ?>"
               readonly>
    </div>
</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="form-control" placeholder="Enter Address" id="address"
											name="address" value="<?php echo e($property->address); ?>" required readonly="" />
									</div>
								</div>
							


								<div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
								<input type="hidden" value="<?php echo e($property->latitude); ?>" name="latitude" id="latitude">
								<input type="hidden" value="<?php echo e($property->longitude); ?>" name="longitude" id="longitude">

								<h3>Uploaded Photos</h3>

<div class="row">
    <?php $__currentLoopData = $property_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-2 text-center mb-3">

            <div style="
                border: <?php echo e($img->is_default ? '2px solid #0d6efd' : '1px solid #ddd'); ?>;
                padding: 6px;
                border-radius: 6px;
            ">
                <img src="<?php echo e(asset($img->image_path)); ?>"
                     class="img-fluid rounded"
                     style="height:100px; object-fit:cover;">
            </div>

            <?php if($img->is_default): ?>
                <span class="badge bg-primary mt-1">Default</span>
            <?php endif; ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

								<?php if(!empty($property->property_video)): ?>
									<h3 class="mt-4">Property Video</h3>
									<div class="form-group">
										<video width="320" height="240" controls>
											<source src="<?php echo e(url($property->property_video)); ?>" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								<?php endif; ?>

							
							</div>
						</div>
					</div>

					<input type="hidden" name="form_json" id="form_json">
					<input type="hidden" name="save_json" id="save_json" value="<?php echo e($property->additional_info); ?>">
					<div class="form-group col-sm-12 mt-4 text-center">
						<a href="<?php echo e(url('update/property')); ?>/<?php echo e($id); ?>?from=preview"><button class="btn btn-postproperty"
								type="button">Edit Property</button></a>
						<a href="<?php echo e(url('post/property/final')); ?>/<?php echo e(base64_encode($property->id)); ?>"><button
								class="btn btn-postproperty" type="button">Next <i
									class="fas fa-chevron-circle-right"></i></button></a>
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
	</script>
	<script type="text/javascript">

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

			<?php if(!empty($property->SubSubCategory)): ?>
				toggleSubSubCategoryFields(<?php echo json_encode($property->SubSubCategory, 15, 512) ?>);
			<?php endif; ?>

			setTimeout(function () {
				document.getElementById('fb-render').innerHTML = '';
				var formData = $('#save_json').val();
				var formRenderOptions = { formData };
				frInstance = $('#fb-render').formRender(formRenderOptions);
			}, 1000);

			setTimeout(function () {
				var formData = $('#save_json').val();
				var json_data = JSON.parse(formData);
				console.log(json_data);
				var formRenderOptions = { formData };
				frInstance = $('#fb-render').formRender(formRenderOptions);
				$("#fb-render :input").prop("disabled", true);
			}, 2000);
		});



		// This function is called when subsubcategory changes or after loading toggles
		function toggleSubSubCategoryFields(selectedData) {
			if (selectedData.amenities_toggle == 'yes') {
				$('#amenitiesField').show();
			} else {
				$('#amenitiesField').hide();
			}
		}


	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/preview_property.blade.php ENDPATH**/ ?>