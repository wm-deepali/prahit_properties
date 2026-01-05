
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php $__env->startSection('title'); ?>
	<title>Post Property</title>
<?php $__env->stopSection(); ?>

<style>
	#otp_btn {
		min-width: 100px;
		font-size: 13px;
		font-weight: 600;
		border-radius: 4px;
		display: none;
	}

	#otp_input_wrapper {
		display: none;
	}
	.photo-upload-card {
    border: 2px dashed #dcdcdc;
    padding: 20px;
    border-radius: 8px;
    background: #fafafa;
}

.photo-upload-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 20px;
    border-radius: 6px;
    background: #fff;
    border: 1px solid #e5e5e5;
}

.photo-upload-btn i {
    font-size: 32px;
    color: #666;
    margin-bottom: 8px;
}

.photo-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
}

.photo-preview-grid .photo-item {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 6px;
    background: #fff;
    text-align: center;
}

.photo-preview-grid img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
}

.photo-item .remove-btn {
    position: absolute;
    top: 4px;
    right: 4px;
}

</style>

<?php $__env->startSection('content'); ?>
	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="form-group col-sm-12 ">
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
								<h3>Property Description</h3>

								
								<div class="row property-description">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="text-control populate_categories" name="category_id" id="category_id"
											onchange="fetch_subcategories(this.value, fetch_subsubcategories)" required="">
											<?php if(count($category) < 1): ?>
												<option value="">No records found</option>
											<?php else: ?>
												<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($v->id); ?>"><?php echo e($v->category_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>

									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											id="sub_category_id"
											onchange="fetch_subsubcategories(this.value, fetch_form_type)" required>
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

						
									<div class="form-group col-sm-12">
										<label class="label-control">Property Title</label>
										<input type="text" class="text-control" placeholder="Title" name="title" id="title"
											value="<?php echo e(old('title')); ?>" required />
									</div>
									<!-- <div class="form-group col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="text-control" placeholder="Enter Price" name="price"
											id="price" value="<?php echo e(old('price')); ?>" required />
									</div> -->

									<div class="form-group col-sm-12 ">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description" id="description"
											required=""><?php echo e(old('description')); ?></textarea>
									</div>
								</div>

					

								<div id="fb-render"></div>

								<div id="amenitiesField" style="display: none;">
									<h4 class="form-section-h">Amenities</h4>
									<div class="row" id="amenitiesContainer">
										<?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-sm-3 amenity-item <?php echo e($index >= 8 ? 'd-none extra-amenity' : ''); ?>">
												<img src="<?php echo e(asset('storage')); ?>/<?php echo e($amenity->icon); ?>" style="height: 30px;">
												<p>
													<input type="checkbox" name="amenity[]" value="<?php echo e($amenity->id); ?>">
													<?php echo e($amenity->name); ?>

												</p>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<?php if(count($amenities) > 8): ?>
										<div class="text-center mt-2">
											<button type="button" class="btn btn-sm btn-outline-primary"
												id="toggleAmenities">Show More</button>
										</div>
									<?php endif; ?>
								</div>

<h4 class="form-section-h">Property Location</h4>

<div class="property-location-wrapper">

    
    <div class="row">
        <div class="form-group col-sm-6">
            <label class="label-control">State</label>
            <select class="form-control" name="state" id="state" required>
                <option value="">Select State</option>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label class="label-control">City</label>
            <select class="form-control" name="city" id="city" required></select>
        </div>
    </div>

    
    <div class="row">
        <div class="form-group col-sm-6">
            <label class="label-control">Location</label>
            <select class="text-control" name="location_id" id="location_id" required></select>

            <div id="custom-location-container" style="display:none; margin-top:10px;">
                <input type="text"
                       class="text-control"
                       name="custom_location_input"
                       id="custom_location_input"
                       placeholder="Enter new location">
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label class="label-control">Sub Location</label>
            <select class="text-control"
                    name="sub_location_id[]"
                    id="sub_location_id"
                    multiple
                    required></select>
        </div>
    </div>

    
    <div class="row">
        <div class="form-group col-sm-6">
            <label class="label-control">Landmark</label>
            <input type="text"
                   class="text-control"
                   name="landmark"
                   id="landmark"
                   placeholder="Enter nearby landmark"
                   value="<?php echo e(old('landmark')); ?>">
        </div>

        <div class="form-group col-sm-6">
            <label class="label-control">Pin Code</label>
            <input type="text"
                   class="text-control"
                   name="pincode"
                   id="pincode"
                   placeholder="Enter 6-digit pin code"
                   maxlength="6"
                   pattern="[0-9]{6}"
                   value="<?php echo e(old('pincode')); ?>">
        </div>
    </div>

    
    <div class="row">
        <div class="form-group col-sm-12">
            <label class="label-control">Address</label>
            <input type="text"
                   class="text-control"
                   name="address"
                   id="address"
                   placeholder="Enter Address"
                   value="<?php echo e(old('address')); ?>"
                   required>
        </div>
    </div>

    
    <div class="row">
        <div class="col-sm-12">
            <div id="propertyMap" style="width:100%; height:300px; margin-bottom:10px;"></div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>
    </div>

</div>



								<h3>Property Photos</h3>

<div class="row">
    <div class="col-sm-12">

        <div class="photo-upload-card">

            <label class="photo-upload-btn">
                <input type="file" id="fileInput" multiple accept="image/*" hidden>
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Click to upload photos</span>
            </label>

            <small class="text-muted d-block mt-1">
                Max allowed photos: <?php echo e($photos_per_listing); ?>

            </small>

            <div id="previewContainer" class="photo-preview-grid mt-3"></div>

        </div>

    </div>
</div>

<input type="hidden" name="default_image_index" id="default_image_index" value="0">


								<?php if($video_upload === 'Yes'): ?>
									<h3>Property Video</h3>
									<div class="row">
										<div class="form-group col-sm-12">
											<label class="label-control">Upload Video</label>
											<input type="file" class="form-control" name="property_video" accept="video/*"
												id="property_video_input">
											<small class="text-muted">You can upload one property video (optional). Max size:
												20MB</small>
											<div id="video_error" class="text-danger mt-1"></div>
										</div>
									</div>

									<script>
										document.getElementById('property_video_input').addEventListener('change', function (e) {
											const file = e.target.files[0];
											const maxSizeMB = 20; // 20MB
											const maxSizeBytes = maxSizeMB * 1024 * 1024;
											const errorDiv = document.getElementById('video_error');

											if (file && file.size > maxSizeBytes) {
												errorDiv.textContent = `Video size exceeds ${maxSizeMB}MB. Please select a smaller file.`;
												e.target.value = ''; // Clear the input
											} else {
												errorDiv.textContent = '';
											}
										});
									</script>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<div class="card property-right-widgets">
							<div class="form-sep">
								<h3>Contact Information</h3>

								<!-- First + Last Name -->
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">First Name</label>
										<input type="text" class="text-control" placeholder="Enter First Name"
											id="firstname" name="firstname"
											value="<?php echo e(Auth::user()->firstname ?? old('firstname')); ?>" required />
									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">Last Name</label>
										<input type="text" class="text-control" placeholder="Enter Last Name" id="lastname"
											name="lastname" value="<?php echo e(Auth::user()->lastname ?? old('lastname')); ?>"
											required />
									</div>
								</div>

								<!-- Email -->
								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="form-control" name="email" id="email"
											placeholder="Your Email"
											value="<?php echo e(Auth::check() ? Auth::user()->email : old('email')); ?>" required>

									</div>
								</div>

								<div class="row">

									<!-- Mobile Number -->
									<div class="form-group col-sm-8">
										<label class="label-control">Mobile No.</label>

										<input type="number" class="form-control mobile_number"
											placeholder="Enter Mobile No." id="mobile_number" name="mobile_number" required
											value="<?php echo e(Auth::user()->mobile_number ?? old('mobile_number')); ?>"
											data-original="<?php echo e(Auth::user()->mobile_number ?? ''); ?>">

										<!-- OTP Button (SEPARATE, NOT APPENDED) -->
										<button type="button" id="otp_btn" class="btn btn-success mt-2"
											onclick="send_otp(this);" style="width: 100px; display:none;">
											Send OTP
										</button>
									</div>

									<!-- OTP Input -->
									<div class="form-group col-sm-4" id="otp_input_wrapper" style="display:none;">
										<label class="label-control">OTP</label>
										<input type="text" class="form-control" placeholder="Enter OTP" id="contact_otp"
											name="otp" value="<?php echo e(old('otp')); ?>">
									</div>

								</div>




							</div>

							<input type="hidden" name="form_json" id="form_json">
						</div>
					</div>

					<div class="form-group col-sm-12  mt-4 text-center">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


	
	<script type="text/javascript">


document.addEventListener("DOMContentLoaded", function () {
			const mobileInput = document.getElementById("mobile_number");
			const otpBtn = document.getElementById("otp_btn");
			const otpInputWrapper = document.getElementById("otp_input_wrapper");

			const originalNumber = mobileInput.dataset.original ?? "";
			const isVerified = <?php echo e(Auth::check() ? (Auth::user()->is_verified ? 'true' : 'false') : 'false'); ?>;

			// Hide both fields initially
			otpBtn.style.display = "none";
			otpInputWrapper.style.display = "none";

			function showOtpFields() {
				otpBtn.style.display = "inline-block";
				otpInputWrapper.style.display = "block";
			}

			function hideOtpFields() {
				otpBtn.style.display = "none";
				otpInputWrapper.style.display = "none";
			}

			// ---- CASE A: User NOT verified → ALWAYS show OTP ----
			if (!isVerified) {
				showOtpFields();
				return; // don't run change detection
			}

			// ---- CASE B: User IS verified → show only when number changes ----
			mobileInput.addEventListener("input", function () {
				const current = mobileInput.value.trim();

				// If unchanged or incomplete → hide
				if (current === originalNumber || current.length < 10) {
					hideOtpFields();
					return;
				}

				// If changed and 10 digits → show
				if (current.length === 10) {
					showOtpFields();
				}
			});
		});

		let selectedFiles = []; // store selected files
		const maxPhotos = <?php echo e($photos_per_listing ?? 0); ?>;

		document.getElementById('fileInput').addEventListener('change', function (event) {
			const newFiles = Array.from(event.target.files);

			// Merge old + new files, but limit total
			const totalFiles = selectedFiles.length + newFiles.length;
			if (maxPhotos > 0 && totalFiles > maxPhotos) {
				alert(`You can upload a maximum of ${maxPhotos} photos.`);
				return;
			}

			selectedFiles.push(...newFiles);
			renderPreviews();

			// clear file input so same file can be reselected later
			event.target.value = '';
		});

		function renderPreviews() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'photo-item';
            div.style.width = '120px';

            div.innerHTML = `
                <img src="${e.target.result}"
                     class="rounded mb-1"
                     width="100"
                     height="100"
                     style="object-fit:cover;">

                <div class="form-check">
                    <input class="form-check-input default-image-radio"
                           type="radio"
                           name="default_image_radio"
                           value="${index}"
                           ${index === 0 ? 'checked' : ''}>
                    <label class="form-check-label small">
                        Default
                    </label>
                </div>

               <button type="button"
        class="btn btn-sm btn-danger remove-btn"
        onclick="removeImage(${index})">&times;</button>

            `;

            container.appendChild(div);

            // auto set default index
            document.getElementById('default_image_index').value =
                document.querySelector('.default-image-radio:checked')?.value || 0;
        };
        reader.readAsDataURL(file);
    });
}

document.getElementById('previewContainer')
    .addEventListener('change', function (e) {
        if (e.target.classList.contains('default-image-radio')) {
            document.getElementById('default_image_index').value = e.target.value;
        }
    });


		function removeImage(index) {
			selectedFiles.splice(index, 1);
			renderPreviews();
		}

		// Center at user's current location if available
		let map, marker;

		function createMap(lat, lng) {
			if (!map) {
				map = L.map('propertyMap').setView([lat, lng], 16);
				L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; OpenStreetMap contributors'
				}).addTo(map);

				marker = L.marker([lat, lng], { draggable: true }).addTo(map);
				marker.on('dragend', function (e) {
					let p = e.target.getLatLng();
					$('#latitude').val(p.lat);
					$('#longitude').val(p.lng);
				});

				map.on('click', function (e) {
					marker.setLatLng(e.latlng);
					$('#latitude').val(e.latlng.lat);
					$('#longitude').val(e.latlng.lng);
				});
			} else {
				map.setView([lat, lng], 16);
				marker.setLatLng([lat, lng]);
			}

			$('#latitude').val(lat);
			$('#longitude').val(lng);
		}

		function initializePropertyMap() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (pos) {
					createMap(pos.coords.latitude, pos.coords.longitude);
				}, function () {
					geocodeSelectedAddress();
				});
			} else {
				geocodeSelectedAddress();
			}
		}

		function geocodeSelectedAddress() {
			let state = $('#state option:selected').text();
			let city = $('#city option:selected').text();
			let location = $('#location_id option:selected').text();

			let addressParts = [];
			if (location && location !== 'Select Location') addressParts.push(location);
			if (city && city !== 'Select City') addressParts.push(city);
			if (state && state !== 'Select State') addressParts.push(state);

			let address = addressParts.join(', ');

			if (address) {
				fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
					.then(res => res.json())
					.then(data => {
						if (data.length > 0) {
							createMap(data[0].lat, data[0].lon);
						} else {
							createMap(28.6139, 77.2090); // fallback: Delhi
						}
					}).catch(() => {
						createMap(28.6139, 77.2090);
					});
			} else {
				createMap(28.6139, 77.2090);
			}
		}

		// Call on page load
		initializePropertyMap();

		// Update map if selects change
		$('#state, #city, #location_id').on('change', function () {
			geocodeSelectedAddress();
		});

		$(function () {
			// Initialize on ready
			initSubLocationSelect2();
			$(".populate_categories,  .populate_locations").change();

			$(".add_formtype").empty().append(
				`<center class='m0-auto'> Please select category </center>`
			);

		});

		document.getElementById('toggleAmenities')?.addEventListener('click', function () {
			const extras = document.querySelectorAll('.extra-amenity');
			const isHidden = extras[0].classList.contains('d-none');
			extras.forEach(el => el.classList.toggle('d-none'));
			this.textContent = isHidden ? 'Show Less' : 'Show More';
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

		//-------------------- Get locations By city --------------------//
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
						$('#location_id').append('<option value="' + location.id + '">' + location.location + '</option>');
					});

					// Append the "Others" option at the end
					$('#location_id').append('<option value="other">Others</option>');
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
					$('#sub_location_id').empty();
					$.each(result, function (key, location) {
						$("#sub_location_id").append('<option value="' + location.id + '">' + location.sub_location_name + '</option>');
					});

					// Refresh select2 options
					$('#sub_location_id').trigger('change.select2');
				}
			});
		});

		function send_otp(element) {

			var email = $("#email").val();
			var mobile_number = $("#mobile_number").val();
			$.ajax({
				url: "<?php echo e(config('app.api_url') . '/property/create_visitor_otp'); ?>",
				method: "POST",
				data: {
					"_token": $("input[name='_token']").val(),
					"mobile_number": mobile_number,
					"email": email
				},
				beforeSend: function () {
					$(element).addClass('disabled');
				},
				success: function (response) {
					response.success == true ? toastr.success(response.message) : toastr.error('An error occured');
				},
				error: function (response) {
					var response = JSON.parse(response.responseText);
					response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
				},
				complete: function () {
					$(element).removeClass('disabled');
				}

			})
		}

		//-------------------- Get sub categories By category --------------------//
		var frInstance;
		function fetch_subcategories(id, callback) {
			var route = "<?php echo e(url('get/sub-categories')); ?>/" + id
			$.ajax({
				url: route,
				method: 'get',
				beforeSend: function () {
					$(".addproperty").attr('disabled', true);
					$(".add_formtype").empty();
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
						fetch_form_type();
					}
				},
				error: function (response) {
					toastr.error('An error occured while fetching subcategories');
				},
				complete: function () {
				}
			})
		}

		//-------------------- Get sub sub categories By sub category --------------------//
		var cachedSubSubCategories = {};
		function fetch_subsubcategories(id, callback) {
			$('#sub_sub_category_id').html('<option value="">Loading...</option>');
			var route = "<?php echo e(url('get/sub-sub-categories')); ?>/" + id
			$.ajax({
				url: route, // Change this to your route
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');

					if (response.subsubcategories && response.subsubcategories.length) {
						cachedSubSubCategories = response.subsubcategories || [];

						$.each(response.subsubcategories, function (i, subsub) {
							$('#sub_sub_category_id').append('<option value="' + subsub.id + '">' + subsub.sub_sub_category_name + '</option>');
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

		//-------------------- Get custom form --------------------//
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
						document.getElementById('fb-render').innerHTML = '';
						var formData = response.form_data;
						var formRenderOptions = { formData };
						frInstance = $('#fb-render').formRender(formRenderOptions);
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


		
		$('#location_id').on('change', function () {
			if ($(this).val() && $(this).val() === 'other') {

				$('#custom-location-container').show();
			} else {
				$('#custom-location-container').hide();
			}
		});

		// Initialize Select2 for Sub Location with tagging (add new)
		function initSubLocationSelect2() {
			$('#sub_location_id').select2({
				tags: true,
				width: '100%',
				placeholder: 'Select or add sub locations',
				closeOnSelect: false,
				createTag: function (params) {
					var term = $.trim(params.term);
					if (term === '') {
						return null;
					}
					return {
						id: term,
						text: term,
						isNew: true
					};
				}
			});
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



		function createProperty() {
			var title = $('#title').val();
			var description = $('#description').val();
			var address = $('#address').val();
			var location_id = $('#location_id').val();
			var sub_location_id = $('#sub_location_id').val();
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var email = $('#email').val();
			var mobile_number = $('#mobile_number').val();
			var contact_otp = $('#contact_otp').val();
			var state_id = $('#state').val();
			var register_page_city_id = $('#city').val();
			var category = $('#category_id').val();
			const isVerified = <?php echo json_encode(Auth::check() ? Auth::user()->is_verified : false, 15, 512) ?>;
			const originalNumber = $('#mobile_number').data('original') || "";

			if (!isVerified) {
				// User NOT verified → OTP must be validated always
				if (!contact_otp.trim()) {
					$('#contact_otp').focus();
					toastr.warning('OTP field is required for unverified users.');
					return false;
				}
			} else {
				// Verified user → OTP needed ONLY if number changed

				if (mobile_number != originalNumber) {
					if (!contact_otp.trim()) {
						$('#contact_otp').focus();
						toastr.warning('Since you changed your mobile number, OTP is required.');
						return false;
					}
				}
			}
			// -------------------------
			// BASIC VALIDATIONS
			// -------------------------
			if (!title.trim()) {
				$('#title').focus();
				toastr.warning('Title field must be required.');
				return false;
			}


			if (!category) {
				$('#category_id').focus();
				toastr.warning('Property Available For field must be required.');
				return false;
			}

			if (!description.trim()) {
				$('#description').focus();
				toastr.warning('Description field must be required.');
				return false;
			}

			if (!address.trim()) {
				$('#address').focus();
				toastr.warning('Address field must be required.');
				return false;
			}

			if (!location_id) {
				$('#location_id').focus();
				toastr.warning('Location is required.');
				return false;
			}

			if (!sub_location_id) {
				$('#sub_location_id').focus();
				toastr.warning('Sub-location is required.');
				return false;
			}

			// -------------------------
			// PERSONAL INFORMATION
			// -------------------------
			if (!firstname.trim()) {
				$('#firstname').focus();
				toastr.warning('First name is required.');
				return false;
			}
			if (!lastname.trim()) {
				$('#lastname').focus();
				toastr.warning('Last name is required.');
				return false;
			}

			const isLoggedIn = <?php echo json_encode(Auth::check(), 15, 512) ?>;

			if (!isLoggedIn) {
				if (email == '') {
					$('#email').focus();
					toastr.warning('Email is required.');
					return false;
				}
				if (mobile_number == '') {
					$('#mobile_number').focus();
					toastr.warning('Mobile number is required.');
					return false;
				}
				// Validate mobile number length
				if (mobile_number.length !== 10) {
					$('#mobile_number').focus();
					toastr.warning('Enter a valid 10-digit mobile number.');
					return false;
				}
			}
		


			// -------------------------
			// OTP VALIDATION LOGIC
			// -------------------------


			if (state_id == '') {
				$('#state').focus();
				toastr.warning('State field must be required.')
				return false;
			}
			if (register_page_city_id == '') {
				$('#city').focus();
				toastr.warning('City field must be required.')
				return false;
			}


			var data = $('#fb-render').formRender('userData');
			if (!data) {
				toastr.error('Additional details form must be required, please select another category or contact to admin.');
			} else {
				document.getElementById('form_json').value = JSON.stringify(data);

				const form = document.getElementById('create-property');
				const formData = new FormData(form);

				// ✅ Append all selected files to FormData
				selectedFiles.forEach(file => {
					formData.append('gallery_images_file[]', file);
				});

				// ✅ Submit via fetch (AJAX)
				fetch(form.action, {
					method: 'POST',
					body: formData,
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							toastr.success(data.message);
							setTimeout(() => {
								window.location.href = data.redirect_url;
							}, 1000);
						} else {
							// Check if validation errors exist
							if (data.errors) {
								// Combine all errors into a single string
								const allErrors = Object.values(data.errors).flat().join('<br>');
								toastr.error(allErrors);
							} else {
								toastr.error(data.message || 'Something went wrong.');
							}
						}
					})

					.catch(err => {
						console.error(err);
						toastr.error('Failed to submit property.');
					});

			}
		}

	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/create_property.blade.php ENDPATH**/ ?>