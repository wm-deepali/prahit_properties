@extends('layouts.front.app')

@section('title')
	<title>Preview Property</title>
@endsection

@section('content')

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>Preview Property Content</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Preview Property</li>
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
					<div class="col-sm-12">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Preview Property Description &amp; Price</h3>
								<div class="form-group row">
									<div class="col-sm-8">
										<label class="label-control">Property Title</label>
										<input type="text" class="text-control" placeholder="Title" name="title" id="title"
											value="{{ $property->title }}" required readonly="" />
									</div>
									<div class="col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="text-control" placeholder="Enter Price" name="price"
											id="price" value="{{ $property->price }}" required readonly="" />
									</div>
									<!-- <div class="col-sm-4">
															<label class="label-control">Type</label>
															<select class="text-control" name="type_id" id="type_id" required disabled="">
																<option value="">Select Type</option>
																@if($property->type_id == 1)
																	<option value="1" selected="">Commercial</option>
																	<option value="2">Agricultural</option>
																	<option value="3">Industrial</option>
																	<option value="4">Free Hold</option>
																@elseif($property->type_id == 2)
																	<option value="1">Commercial</option>
																	<option value="2" selected="">Agricultural</option>
																	<option value="3">Industrial</option>
																	<option value="4">Free Hold</option>
																@elseif($property->type_id == 3)
																	<option value="1">Commercial</option>
																	<option value="2">Agricultural</option>
																	<option value="3" selected="">Industrial</option>
																	<option value="4">Free Hold</option>
																@elseif($property->type_id == 4)
																	<option value="1">Commercial</option>
																	<option value="2">Agricultural</option>
																	<option value="3">Industrial</option>
																	<option value="4" selected="">Free Hold</option>
																@else
																	<option value="1">Commercial</option>
																	<option value="2">Agricultural</option>
																	<option value="3">Industrial</option>
																	<option value="4">Free Hold</option>
																@endif
															</select>
														</div> -->
								</div>



								<div class="form-group row">
									<div class="col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="text-control populate_categories" name="category_id" id="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type)" required=""
											disabled="">
											@if(count($category) < 1)
												<option value="">No records found</option>
											@else
												@foreach($category as $k => $v)
													@if($property->category_id == $v->id)
														<option value="{{$v->id}}" selected="">{{$v->category_name}}</option>
													@else
														<option value="{{$v->id}}">{{$v->category_name}}</option>
													@endif
												@endforeach
											@endif
										</select>

									</div>
									<div class="col-sm-4">
										<label class="label-control">Category</label>
										<select class="text-control populate_subcategories" name="sub_category_id"
											id="sub_category_id" required disabled="">
											<option value="">Select Category</option>
										</select>

									</div>

									<div class="col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="text-control populate_subsubcategories" name="sub_sub_category_id"
											id="sub_sub_category_id" onchange="fetch_form_type();" disabled="">
											<option value="">Select Property Type</option>
										</select>
									</div>

								</div>


								<div class="form-row">

									{{-- Price Label --}}
									<div id="priceLabelField" class="form-group col-md-3">
										<label class="label-control">Price Label</label>
										@if($price_labels->first()->input_format == 'checkbox')
											@foreach($price_labels as $label)
												<label>
													<input type="checkbox" value="{{ $label->id }}" disabled {{ in_array($label->id, explode(',', $property->price_label ?? '')) ? 'checked' : '' }}>
													{{ $label->name }}
												</label>
											@endforeach
										@else
											<input type="text" class="form-control" readonly
												value="{{ optional($price_labels->firstWhere('id', $property->price_label))->name }}">
										@endif

										@if(!empty($property->price_label_second))
											<div class="mt-2">
												<label>
													{{ optional($price_labels->firstWhere('id', $property->price_label))->second_input_label ?? 'Date' }}
												</label>
												<input type="date" class="form-control" readonly
													value="{{ $property->price_label_second }}">
											</div>
										@endif
									</div>

									{{-- Property Status --}}
									<div id="propertyStatusField" class="form-group col-md-3">
										<label class="label-control">Property Status</label>
										@if($property_statuses->first()->input_format == 'checkbox')
											@foreach($property_statuses as $status)
												<label>
													<input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->property_status ?? '')) ? 'checked' : '' }}>
													{{ $status->name }}
												</label>
											@endforeach
										@else
											<input type="text" class="form-control" readonly
												value="{{ optional($property_statuses->firstWhere('id', $property->property_status))->name }}">
										@endif

										@if(!empty($property->property_status_second))
											<div class="mt-2">
												<label>
													{{ optional($property_statuses->firstWhere('id', $property->property_status))->second_input_label ?? 'Date' }}
												</label>
												<input type="date" class="form-control" readonly
													value="{{ $property->property_status_second }}">
											</div>
										@endif
									</div>

									{{-- Registration Status --}}
									<div id="registrationStatusField" class="form-group col-md-3">
										<label class="label-control">Registration Status</label>
										@if($registration_statuses->first()->input_format == 'checkbox')
											@foreach($registration_statuses as $status)
												<label>
													<input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->registration_status ?? '')) ? 'checked' : '' }}>
													{{ $status->name }}
												</label>
											@endforeach
										@else
											<input type="text" class="form-control" readonly
												value="{{ optional($registration_statuses->firstWhere('id', $property->registration_status))->name }}">
										@endif

										@if(!empty($property->registration_status_second))
											<div class="mt-2">
												<label>
													{{ optional($registration_statuses->firstWhere('id', $property->registration_status))->second_input_label ?? 'Date' }}
												</label>
												<input type="date" class="form-control" readonly
													value="{{ $property->registration_status_second }}">
											</div>
										@endif
									</div>

									{{-- Furnishing Status --}}
									<div id="furnishingStatusField" class="form-group col-md-3">
										<label class="label-control">Furnishing Status</label>
										@if($furnishing_statuses->first()->input_format == 'checkbox')
											@foreach($furnishing_statuses as $status)
												<label>
													<input type="checkbox" value="{{ $status->id }}" disabled {{ in_array($status->id, explode(',', $property->furnishing_status ?? '')) ? 'checked' : '' }}>
													{{ $status->name }}
												</label>
											@endforeach
										@else
											<input type="text" class="form-control" readonly
												value="{{ optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->name }}">
										@endif

										@if(!empty($property->furnishing_status_second))
											<div class="mt-2">
												<label>
													{{ optional($furnishing_statuses->firstWhere('id', $property->furnishing_status))->second_input_label ?? 'Date' }}
												</label>
												<input type="date" class="form-control" readonly
													value="{{ $property->furnishing_status_second }}">
											</div>
										@endif
									</div>

								</div>


								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="text-control" rows="2" cols="4" name="description" id="description"
											required="" disabled="">{{ $property->description }}</textarea>
									</div>
								</div>

								<div id="amenitiesField">
									<h3>Amenities</h3>
									<div class="form-group row">
										@foreach($amenities as $amenity)
											<div class="col-sm-3">
												<img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
												<p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}"
														disabled="" @if(in_array($amenity->id, explode(',', $property->amenities))) checked @endif> {{ $amenity->name }}</p>
											</div>
										@endforeach
									</div>
								</div>

								<h3>Property Location</h3>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">State </label>
										<select class="form-control" name="state" id="state" required="" disabled="">
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
									<div class="col-sm-6">
										<label class="label-control">City </label>
										<select class="form-control" name="city" id="city" required="" disabled="">
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
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="label-control">Location </label>
										<select class="text-control" name="location_id[]" id="location_id" multiple=""
											required="" disabled="">
											@foreach($locations as $location)
												@if(in_array($location->id, explode(',', $property->location_id)))
													<option value="{{ $location->id }}" selected="">{{ $location->location }}
													</option>
												@else
													<option value="{{ $location->id }}">{{ $location->location }}</option>
												@endif
											@endforeach
										</select>

									</div>
									<div class="col-sm-6">
										<label class="label-control">Sub Location </label>
										<input type="text" class="text-control" name="sub_location_name"
											id="sub_location_name" value="{{ $property->sub_location_name }}" disabled />
									</div>

								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="text-control" placeholder="Enter Address" id="address"
											name="address" value="{{ $property->address }}" required readonly="" />
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
										<img src="{{url('/') . '/images/loading.gif'}}" alt="Loading.." class="loading_4" />
									</div>
									@foreach($property_images as $k => $v)
										<div class="col-sm-2">
											<img src="{{url('/') . '/' . $v->image_path}}" style="height: 100px;"
												class="img-fluid">
										</div>
									@endforeach
								</div>
								<h4 class="form-section-h">Property Additional Information</h4>

								<center class="loading">
									<img src="{{url('images/loading.gif')}}" alt="Loading.." class="loading" />
								</center>
								<div id="fb-render"></div>
							</div>
						</div>
					</div>

					<input type="hidden" name="form_json" id="form_json">
					<input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
					<div class="col-sm-12 mt-4 text-center">
						<a href="{{ url('update/property') }}/{{ $id }}?from=preview"><button class="btn btn-postproperty"
								type="button">Edit Property</button></a>
						<a href="{{ url('post/property/final') }}/{{ base64_encode($property->id) }}"><button
								class="btn btn-postproperty" type="button">Next <i
									class="fas fa-chevron-circle-right"></i></button></a>
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
	<script type="text/javascript">

		$(function () {
			$(".loading_2").css('display', 'none');
			$(".loading_3").css('display', 'none');
			$(".loading_4").css('display', 'none');

			$(".populate_categories,  .populate_locations").change();

			$(".add_formtype").empty().append(
				`<center class='m0-auto'> Please select sub category </center>`
			);

			setTimeout(function () {
				var formData = $('#save_json').val();
				var json_data = JSON.parse(formData);
				var formRenderOptions = { formData };
				frInstance = $('#fb-render').formRender(formRenderOptions);
				$("#fb-render :input").prop("disabled", true);
			}, 2000);
		});

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
				}
			});
		});

		$('#location_id').on('change', function () {
			var location_id = $('#location_id').val();
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
				url: "{{config('app.api_url') . '/property/create_visitor_otp'}}",
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
			var route = "{{ url('get/sub-categories') }}/" + id
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
								if ('{{ $property->sub_category_id }}' == y.id)
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
			var subsubcat = $(".populate_subsubcategories option:selected").val();
			// if(subcat=="") {
			// 	clearFormType(true);
			// 	return true;
			// }

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
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					if (response != 0) {
						if ('{{ $property->category_id }}' == response.category_id) {
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


		var cachedSubSubCategories = {}; // Object to store sub sub categories keyed by subcategory ID

		function loadSubSubCategories(subcategoryId, selectedId = null) {
			$('#sub_sub_category_id').html('<option value="">Loading...</option>');
			var route = "{{ url('get/sub-sub-categories') }}/" + subcategoryId;

			$.ajax({
				url: route,
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
					if (response.subsubcategories && response.subsubcategories.length) {
						cachedSubSubCategories = response.subsubcategories || [];
						$.each(response.subsubcategories, function (i, subsub) {
							let selected = (selectedId == subsub.id) ? "selected" : "";
							$('#sub_sub_category_id').append(
								'<option value="' + subsub.id + '" ' + selected + '>' + subsub.sub_sub_category_name + '</option>'
							);
						});
						toggleSubSubCategoryFields(selectedId)
						fetch_form_type();
					} else {
						$('#sub_sub_category_id').append('<option value="">No property type found</option>');
					}
				},
				error: function () {
					$('#sub_sub_category_id').html('<option value="">Error loading</option>');
				}
			});
		}

		// 🔹 Auto-load on page load if editing
		$(document).ready(function () {
			let preselectedSubCategory = "{{ $property->sub_category_id }}";
			let preselectedSubSubCategory = "{{ $property->sub_sub_category_id }}";

			if (preselectedSubCategory) {
				loadSubSubCategories(preselectedSubCategory, preselectedSubSubCategory);
			}


		});



		// This function is called when subsubcategory changes or after loading toggles
		function toggleSubSubCategoryFields(selectedId) {

			var selectedData = cachedSubSubCategories.find(function (subsub) {
				return subsub.id == selectedId;
			});

			if (selectedData.price_label_toggle == 'yes') {
				$('#priceLabelField').show();
			} else {
				$('#priceLabelField').hide();
			}

			if (selectedData.property_status_toggle == 'yes') {
				$('#propertyStatusField').show();
			} else {
				$('#propertyStatusField').hide();
			}

			if (selectedData.registration_status_toggle == 'yes') {
				$('#registrationStatusField').show();
			} else {
				$('#registrationStatusField').hide();
			}

			if (selectedData.furnishing_status_toggle == 'yes') {
				$('#furnishingStatusField').show();
			} else {
				$('#furnishingStatusField').hide();
			}

			if (selectedData.amenities_toggle == 'yes') {
				$('#amenitiesField').show();
			} else {
				$('#amenitiesField').hide();
			}
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
							$(".loading_4").css('display', 'block');
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
	</script>
@endsection