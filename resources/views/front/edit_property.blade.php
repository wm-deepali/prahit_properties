@extends('layouts.front.app')

@section('title')
	<title>Edit Property</title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
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
@section('content')

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="form-group col-sm-12">
					<h3>Post Property</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Edit Property</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>


	<form method="post" action="{{ url('update/property') }}" id="create-property" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="id" value="{{ $property->id }}">
		<section class="postproperty-section">
			<div class="container">
				<div class="row">
					<input type="hidden" name="from" value="{{ app('request')->input('from') }}">
					<div class="col-sm-8">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Property Descriptions</h3>

								<div class="row">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="text-control populate_categories" name="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type);">
											@foreach($category as $k => $v)
												<option value="{{$v->id}}" {{$property->category_id == $v->id ? "selected" : ""}}>
													{{$v->category_name}}
												</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											onchange="fetch_subsubcategories(this.value, fetch_form_type);">
											<option value="">Select Category</option>
											@foreach($sub_categories as $k => $v)
												<option value="{{$v->id}}" {{$property->sub_category_id == $v->id ? "selected" : ""}}>
													{{$v->sub_category_name}}
												</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="text-control populate_subsubcategories" name="sub_sub_category_id"
											id="sub_sub_category_id" onchange="fetch_form_type();">
											<option value="">Select Property Type</option>
											@foreach($sub_sub_categories as $k => $v)
												<option value="{{$v->id}}" {{$property->sub_sub_category_id == $v->id ? "selected" : ""}}>
													{{$v->sub_sub_category_name}}
												</option>
											@endforeach
										</select>
									</div>
								
									<div class="form-group col-sm-12">
										<label class="label-control">Title </label>
										<input type="text" class="text-control" name="title"
											placeholder="Enter Property Name" value="{{$property->title}}" required />
									</div>
								
									<div class="form-group col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description"
											required> {{$property->description}}</textarea>
									</div>
								</div>

								<div id="fb-render"></div>

								<div id="amenitiesField" style="display:none;">
									<h4 class="form-section-h">Amenities</h4>
									<div class="row">
										@foreach($amenities as $amenity)
											<div class="col-sm-3">
												<img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
												<p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}"
														@if(in_array($amenity->id, explode(',', $property->amenities))) checked
														@endif> {{ $amenity->name }}</p>
											</div>
										@endforeach
									</div>
								</div>

								<h4 class="form-section-h">Property Location</h4>
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">State </label>
										<select class="form-control" name="state" id="state" required="">
											<option value="">Select State </option>
											@foreach($states as $state)
												@if($property->state_id == $state->id)
													<option value="{{ $state->id }}" selected="">{{ $state->name }}</option>
												@else
													<option value="{{ $state->id }}">{{ $state->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">City </label>
										<select class="form-control" name="city" id="city" required="">
											@foreach($cities as $city)
												@if($property->city_id == $city->id)
													<option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
												@else
													<option value="{{ $city->id }}">{{ $city->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">Location </label>
										<select class="text-control" name="location_id" id="location_id" required="">
											@foreach($locations as $location)
												@if($property->location_id == $location->id)
													<option value="{{ $location->id }}" selected="">{{ $location->location }}
													</option>
												@else
													<option value="{{ $location->id }}">{{ $location->location }}</option>
												@endif
											@endforeach
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
    <div class="form-group col-sm-6">
        <label class="label-control">Landmark</label>
        <input type="text"
               class="text-control"
               name="landmark"
               value="{{ $property->landmark }}"
               placeholder="Enter nearby landmark">
    </div>

    <div class="form-group col-sm-6">
        <label class="label-control">Pin Code</label>
        <input type="text"
               class="text-control"
               name="pincode"
               value="{{ $property->pincode }}"
               maxlength="6"
               pattern="[0-9]{6}"
               placeholder="Enter 6-digit pin code">
    </div>
</div>

								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="text-control" placeholder="Enter Address" id="address"
											name="address" value="{{ $property->address }}" required />
									</div>
								</div>

								<div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
								<input type="hidden" name="latitude" id="latitude">
								<input type="hidden" name="longitude" id="longitude">

								<h3>Uploaded Photos</h3>

<div class="row">
@foreach($property_images as $img)
    <div class="col-sm-2 text-center mb-3">

        <div style="
            border: {{ $img->is_default ? '2px solid #0d6efd' : '1px solid #ddd' }};
            padding: 6px;
            border-radius: 6px;
        ">
            <img src="{{ asset($img->image_path) }}"
                 class="img-fluid rounded"
                 style="height:100px; object-fit:cover;">
        </div>

        <div class="form-check mt-1">
            <input class="form-check-input"
                   type="radio"
                   name="default_image_id"
                   value="{{ $img->id }}"
                   {{ $img->is_default ? 'checked' : '' }}>
            <label class="form-check-label small">Default</label>
        </div>

        <i class="fa fa-trash text-danger mt-1"
           style="cursor:pointer;"
           onclick="deleteGalleryPhoto('{{ $img->id }}')"></i>

    </div>
@endforeach

</div>


							<h3>Property Photos</h3>

<div class="row">
    <div class="col-sm-12">

        <div class="photo-upload-card">

            {{-- Upload Button --}}
            <label class="photo-upload-btn">
                <input type="file" id="fileInput" multiple accept="image/*" hidden>
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Click or drag photos here</span>
                <small class="text-muted">
                    JPG / PNG only • Max {{ $photos_per_listing }} photos
                </small>
            </label>

            {{-- Preview Grid --}}
            <div id="previewContainer" class="photo-preview-grid mt-3"></div>

        </div>

    </div>
</div>

								<input type="hidden" name="default_image_id" id="default_image_id">
<input type="hidden" name="default_image_index" id="default_image_index">

								@if($video_upload === 'Yes')
									<h3>Property Video</h3>
									<div class="form-group row">
										<div class="form-group col-sm-12">
											@if(!empty($property->property_video))
												<video width="100%" height="240" controls style="margin-bottom: 10px;">
													<source src="{{ url($property->property_video) }}" type="video/mp4">
													Your browser does not support the video tag.
												</video>
												<br>
											@endif
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
								@endif

								
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
										<input type="text" class="text-control" placeholder="Enter First Name"
											id="firstname" name="firstname"
											value="{{ $property->owner_firstname ?? Auth::user()->firstname }}" required />
									</div>

									<div class="form-group col-sm-6">
										<label class="label-control">Last Name</label>
										<input type="text" class="text-control" placeholder="Enter Last Name" id="lastname"
											name="lastname"
											value="{{ $property->owner_lastname ?? Auth::user()->lastname }}" required />
									</div>
								</div>

								<div class="form-group row">
									<div class="form-group col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="text-control email" placeholder="Enter Email" id="email"
											name="email" value="{{ $property->owner_email ?? Auth::user()->email }}"
											required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-8">
										<label class="label-control">Mobile No.</label>
										<div class="d-flex" style="gap:10px;">

											<input type="number" class="text-control mobile_number"
												placeholder="Enter Mobile No." id="mobile_number" name="mobile_number"
												value="{{ $property->owner_mobile ?? Auth::user()->mobile_number }}"
												data-original="{{ $property->owner_mobile ?? Auth::user()->mobile_number }}"
												required />

											<!-- OTP Button -->
											<button type="button" id="otp_btn" class="btn btn-primary"
												style="display:none;white-space:nowrap;">Send OTP</button>

										</div>

										<!-- OTP Input (Hidden Initially) -->
										<div id="otp_input_wrapper" style="margin-top:10px; display:none;">
											<input type="text" id="otp_input" name="otp_code" class="text-control"
												placeholder="Enter OTP" />
										</div>

									</div>
								</div>


							</div>

							<input type="hidden" name="form_json" id="form_json">
							<input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
						</div>
					</div>



					<div class="form-group col-sm-12 mt-4 text-center">
						<button class="btn btn-postproperty" type="button" onclick="createProperty()">Update Property <i
								class="fas fa-chevron-circle-right"></i></button>
					</div>

				</div>
			</div>
		</section>
		@csrf
	</form>
@endsection

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const mobileInput = document.getElementById("mobile_number");
			const otpBtn = document.getElementById("otp_btn");
			const otpInputWrapper = document.getElementById("otp_input_wrapper");

			const originalNumber = mobileInput.dataset.original ?? "";

			otpBtn.style.display = "none";
			otpInputWrapper.style.display = "none";

			mobileInput.addEventListener("input", function () {
				const current = mobileInput.value;

				// Case 1: Number unchanged → hide OTP
				if (current === originalNumber) {
					otpBtn.style.display = "none";
					otpInputWrapper.style.display = "none";
					return;
				}

				// Case 2: Less than 10 digits → hide OTP
				if (current.length < 10) {
					otpBtn.style.display = "none";
					otpInputWrapper.style.display = "none";
					return;
				}

				// Case 3: Valid 10-digit AND changed → show button
				if (current.length === 10) {
					otpBtn.style.display = "inline-block";
				}
			});

			// Show OTP Input when button clicked
			otpBtn.addEventListener("click", function () {
				otpInputWrapper.style.display = "block";
			});
		});
	</script>


	<script type="text/javascript">

		$(function () {
			fetch_form_type();

			@if(!empty($property->SubSubCategory))
				console.log('here');
				toggleSubSubCategoryFields(@json($property->SubSubCategory));
			@endif
								});


		let selectedFiles = []; // new files user selects
		const maxPhotos = {{ $photos_per_listing ?? 10 }}; // from backend (limit)
		const existingPhotos = {{ $property_images->count() }}; // current photos already uploaded

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
            div.className = 'text-center position-relative m-2';

            div.innerHTML = `
                <div style="border:1px solid #ddd;padding:6px;border-radius:6px;">
                    <img src="${e.target.result}"
                         style="height:100px;width:100px;object-fit:cover;"
                         class="rounded">
                </div>

                <div class="form-check mt-1">
                    <input class="form-check-input new-default-radio"
                           type="radio"
                           name="new_default_image"
                           value="${index}">
                    <label class="form-check-label small">Default</label>
                </div>

                <button type="button"
                        class="btn btn-sm btn-danger"
                        style="position:absolute;top:0;right:0;"
                        onclick="removeImage(${index})">&times;</button>
            `;

            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('change', function (e) {
    // If new image default selected
    if (e.target.classList.contains('new-default-radio')) {
        document.getElementById('default_image_index').value = e.target.value;

        // 🔥 IMPORTANT: clear existing default selection
        document.querySelectorAll('input[name="default_image_id"]').forEach(r => r.checked = false);
        document.getElementById('default_image_id').value = '';
    }

    // If existing image default selected
    if (e.target.name === 'default_image_id') {
        document.getElementById('default_image_id').value = e.target.value;

        // 🔥 IMPORTANT: clear new default index
        document.getElementById('default_image_index').value = '';
    }
});


		function removeImage(index) {
			selectedFiles.splice(index, 1);
			renderPreviews();
		}

		@if(!empty($property->latitude) && !empty($property->longitude))
			createMap({{ $property->latitude }}, {{ $property->longitude }});
		@else
			// Construct address string from state, city, location
			let address = '';
																															  @if(!empty($property->location)) address += '{{ $property->location->location }}'; @endif
			@if(!empty($property->city)) address += ', {{ $property->city->name }}'; @endif
			@if(!empty($property->state)) address += ', {{ $property->state->name }}'; @endif

																															  if (address) {
				fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
					.then(res => res.json())
					.then(data => {
						if (data.length > 0) {
							let lat = data[0].lat;
							let lng = data[0].lon;
							createMap(lat, lng);
						} else {
							// fallback if geocoding fails
							createMap(28.6139, 77.2090); // Delhi
						}
					}).catch(() => {
						createMap(28.6139, 77.2090);
					});
			} else {
				createMap(28.6139, 77.2090); // fallback
			}
		@endif


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

		//-------------------- Get city By state --------------------//
		$('#state').on('change', function () {
			var state_id = this.value;
			$("#city").html('');
			$.ajax({
				url: "{{route('front.getCities')}}",
				type: "POST",
				data: {
					state_id: state_id,
					_token: '{{csrf_token()}}',
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
				url: "{{route('front.getLocations')}}",
				type: "POST",
				data: {
					city_id: city_id,
					_token: '{{csrf_token()}}',
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
							url: '{{ url('delete/property/images') }}',
							method: "POST",
							data: {
								"_token": "{{ csrf_token() }}",
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
			// var route = "{{route('admin.sub_category.fetch_subcategories_by_cat_id', ['id' => ':id'])}}";
			var route = "{{ url('get/sub-categories') }}/" + id  // var route = route.replace(':id', id);
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
			var route = "{{ url('get/sub-sub-categories') }}/" + id;

			$.ajax({
				url: route,
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
					if (response.subsubcategories && response.subsubcategories.length > 0) {
						cachedSubSubCategories = response.subsubcategories || [];

						$.each(response.subsubcategories, function (i, subsub) {
							let selected = ({{$property->sub_category_id ?? 0}} == subsub.id) ? "selected" : "";
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
					amenities_toggle: false,
				});
				return;
			}

			var selectedData = cachedSubSubCategories.find(function (subsub) {
				return subsub.id == selectedId;
			});



			if (selectedData) {
				toggleSubSubCategoryFields({
					amenities_toggle: selectedData.amenities_toggle
				});
			} else {
				// No matching sub sub category found, hide fields
				toggleSubSubCategoryFields({
					amenities_toggle: false
				});
			}

		});


		// This function is called when subsubcategory changes or after loading toggles
		function toggleSubSubCategoryFields(toggles) {
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

			var route = "{{ url('category/related-form') }}";
			$.ajax({
				url: route,
				method: 'post',
				data: {
					"_token": "{{ csrf_token() }}",
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
							'{{ $property->category_id }}' == response.category_id ||
							'{{ $property->sub_category_id }}' == response.sub_category_id ||
							'{{ $property->sub_sub_category_id }}' == response.sub_sub_category_id
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
				url: "{{route('front.getSubLocations')}}",
				type: "POST",
				data: {
					location_id: location_id,
					_token: '{{csrf_token()}}',
				},
				dataType: 'json',
				success: function (result) {
					$('#sub_location_id').empty();
					$.each(result, function (key, location) {
						$("#sub_location_id").append('<option value="' + location.id + '">' + location.sub_location_name + '</option>');
					});
					// reselect existing values from property
					var selectedIds = "{{ $property->sub_location_id ?? '' }}";
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
				@guest
					formData.append('is_visitor', true);
				@endguest

																																										// console.log(obj)
																																										if (jQuery.isEmptyObject(obj)) {
					returnIfInvalid();
				}

				// console.log(isValid);
				if (isValid) {
					$.ajax({
						url: "{{config('app.api_url') . '/property'}}",
						method: "POST",
						data: formData,
						datatype: 'json',
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function (request) {
							$(".addproperty").attr('disabled', true);
							@auth
								request.setRequestHeader('auth-token', '{{Auth::user()->auth_token}}');
							@endauth
																																													},
						success: function (response) {
							// var response = JSON.parse(response);
							if (response.responseCode === 200) {
								toastr.success(response.message)
								$("#create_property_form").trigger('reset');
								@guest
									//          	setTimeout(function() {
									// window.location.href = "{{route('admin.properties.index')}}";
									//          	}, 1000);
								@endguest
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

			// Basic Field Validations
			let title = $('#title').val();
			let category = $('#category_id').val();
			let sub_category = $('#sub_category_id').val();
			let status = $('#status').val();
			let description = $('#description').val();
			let address = $('#address').val();
			let location_id = $('#location_id').val();
			let sub_location_id = $('#sub_location_id').val();

			if (title == '') {
				$('#title').focus();
				toastr.warning('Title field must be required.');
				return false;
			}

	

			if (category == '') {
				$('#category_id').focus();
				toastr.warning('Property Available For field must be required.');
				return false;
			}

			if (sub_category == '') {
				$('#sub_category_id').focus();
				toastr.warning('Category field must be required.');
				return false;
			}

			if (status == '') {
				$('#status').focus();
				toastr.warning('Status field must be required.');
				return false;
			}

			if (description == '') {
				$('#description').focus();
				toastr.warning('Description field must be required.');
				return false;
			}

			if (address == '') {
				$('#address').focus();
				toastr.warning('Address field must be required.');
				return false;
			}

			if (location_id == '') {
				$('#location_id').focus();
				toastr.warning('Location id field must be required.');
				return false;
			}

			if (sub_location_id == '') {
				$('#sub_location_id').focus();
				toastr.warning('Sub Location id field must be required.');
				return false;
			}


			// ✔️ OTP Validation
			let mobileInput = document.getElementById("mobile_number");
			let originalMobile = mobileInput.dataset.original ?? "";
			let currentMobile = mobileInput.value;
			let otpBoxVisible = $("#otp_input_wrapper").is(":visible");
			let otpCode = $("#otp_input").val();

			// If mobile changed → OTP must be entered
			if (currentMobile != originalMobile) {

				if (currentMobile.length < 10) {
					toastr.error("Enter valid 10-digit mobile number.");
					return false;
				}

				if (!otpBoxVisible) {
					toastr.error("Please click Send OTP.");
					return false;
				}

				if (otpCode === "" || otpCode.length < 4) {
					toastr.error("Please enter valid OTP.");
					return false;
				}
			}


			// ✔️ Dynamic form data (additional info form_json)
			let data = $('#add').formRender('userData');
			if (!data) {
				toastr.error('Additional details form must be required. Contact admin.');
				return false;
			}

			$("#form_json").val(JSON.stringify(data));


			// ✔️ Submit Form Using Fetch + FormData
			const form = document.getElementById('create-property');
			const formData = new FormData(form);

			// Add Gallery Images
			selectedFiles.forEach((file, i) => {
				formData.append('gallery_images_file[]', file);
			});

			fetch("{{ url('update/property') }}", {
				method: "POST",
				body: formData
			})
				.then(res => res.json())
				.then(response => {
					if (response.success) {
						toastr.success(response.message);
						setTimeout(() => {
							window.location.href = response.redirect_url;
						}, 1000);
					} else {
						// Check if validation errors exist
						if (response.errors) {
							// Combine all errors into a single string
							const allErrors = Object.values(response.errors).flat().join('<br>');
							toastr.error(allErrors);
						} else {
							toastr.error(response.message || 'Something went wrong.');
						}
					}
				})
				.catch(err => toastr.error('Server error!'));
		}

	</script>
@endsection