@extends('layouts.front.app')

@section('title')
	<title>Preview Property</title>
@endsection

@section('content')

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="form-group col-sm-12">
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
					<div class="form-group col-sm-12">
						<div class="card property-left-widgets">
							<div class="form-sep">
								<h3>Preview Property Description &amp; Price</h3>

								<div class="row">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="form-control populate_categories" name="category_id"
											onchange="fetch_subcategories(this.value, fetch_form_type);" disabled="">
											@foreach($category as $k => $v)
												<option value="{{$v->id}}" {{$property->category_id == $v->id ? "selected" : ""}}>
													{{$v->category_name}}
												</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Category</label>
										<select class="form-control populate_subcategories" id="sub_category_id"
											name="sub_category_id"
											onchange="fetch_subsubcategories(this.value, fetch_form_type);" required
											disabled="">
											<option value="">Select Category</option>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label class="label-control">Property Type</label>
										<select class="form-control populate_subsubcategories" name="sub_sub_category_id"
											id="sub_sub_category_id" onchange="fetch_form_type();" disabled="">
											<option value="">Select Property Type</option>
										</select>
									</div>

								</div>

								<div class="row">
									<div class="form-group col-sm-8">
										<label class="label-control">Title </label>
										<input type="text" class="form-control" name="title"
											placeholder="Enter Property Name" value="{{$property->title}}" required
											readonly="" />
									</div>

									<div class="form-group col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="form-control" name="price" min="0"
											placeholder="Enter Price" value="{{$property->price}}" required readonly="" />
									</div>
								</div>
								<div class="form-row">

									{{-- Price Label --}}
									@php $col = ($price_labels->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
									<div id="priceLabelField" class="form-group {{ $col }}" style="display:none;">
										<label class="label-control d-flex">Price Label</label>
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
									@php $col = ($property_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
									<div id="propertyStatusField" class="form-group {{ $col }}" style="display:none;">
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
									@php $col = ($registration_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
									<div id="registrationStatusField" class="form-group {{ $col }}" style="display:none;">
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
									@php $col = ($furnishing_statuses->first()->input_format == 'checkbox') ? 'col-12' : 'col-md-4'; @endphp
									<div id="furnishingStatusField" class="form-group {{ $col }}" style="display:none;">
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

								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="form-control" rows="2" cols="4" name="description" required
											readonly=""> {{$property->description}}</textarea>
									</div>
								</div>

								<div id="amenitiesField" style="display: none;">
									<h4 class="form-section-h">Amenities</h4>
									<div class="row">
										@foreach($amenities as $amenity)
											<div class="col-sm-3">
												<img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
												<p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}"
														disabled="" @if(in_array($amenity->id, explode(',', $property->amenities))) checked @endif>
													{{ $amenity->name }}</p>
											</div>
										@endforeach
									</div>
								</div>

								<h4 class="form-section-h">Property Location</h4>
								<div class="row">
									<div class="form-group col-sm-6">
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
									<div class="form-group col-sm-6">
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
								<div class="row">
									<div class="form-group col-sm-6">
										<label class="label-control">Location </label>
										<select class="form-control" name="location_id" id="location_id" required=""
											disabled="">
											@foreach($locations as $location)
												@if($property->location_id == $location->id)
													<option value="{{ $location->id }}" selected="">{{ $location->location }}
													</option>
												@else
													<option value="{{ $location->id }}">{{ $location->location }}</option>
												@endif
											@endforeach
										</select>

									</div>
									<div class="form-group col-sm-6">
										<label class="label-control">Sub Location </label>
										<input type="text" class="form-control" name="sub_location_display"
											id="sub_location_display"
											value="{{ $property->sub_location_id ? $property->getSubLocations($property->sub_location_id) : '' }}"
											disabled />
									</div>

								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label class="label-control">Address </label>
										<input type="text" class="form-control" placeholder="Enter Address" id="address"
											name="address" value="{{ $property->address }}" required readonly="" />
									</div>
								</div>

								<div id="propertyMap" style="width:100%; height:300px;margin-bottom:10px"></div>
								<input type="hidden" value="{{ $property->latitude }}" name="latitude" id="latitude">
								<input type="hidden" value="{{ $property->longitude }}" name="longitude" id="longitude">

								<h3>Uploaded Photos</h3>
								<div class="form-group dropzone row">
									<!-- <div class="loading_4">
											<img src="{{url('/') . '/images/loading.gif'}}" alt="Loading.." class="loading_4" />
										</div> -->
									@foreach($property_images as $k => $v)
										<div class="col-sm-2">
											<img src="{{url('/') . '/' . $v->image_path}}" style="height: 100px;"
												class="img-fluid">
										</div>
									@endforeach
								</div>
								<h4 class="form-section-h">Property Additional Information</h4>

								<!-- <center class="loading">
										<img src="{{url('images/loading.gif')}}" alt="Loading.." class="loading" />
									</center> -->
								<div id="fb-render"></div>
							</div>
						</div>
					</div>

					<input type="hidden" name="form_json" id="form_json">
					<input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
					<div class="form-group col-sm-12 mt-4 text-center">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	</script>
	<script type="text/javascript">

		@if(!empty($property->latitude) && !empty($property->longitude))
	
			// Initialize map with property coordinates
			createMap({{ $property->latitude }}, {{ $property->longitude }});
		@else
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


		$(function () {
			fetch_subcategories('{{$property->category_id}}', function () {
				$(".populate_subcategories").val('{{$property->sub_category_id}}');
				fetch_form_type();
				fetch_subsubcategories('{{$property->sub_category_id}}', function () {
					$(".populate_subsubcategories").val('{{$property->sub_sub_category_id}}');
					fetch_form_type();
				});
			});

			$(".property_use_for").hide();

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
							console.log('here');

							$.each(subcategories, function (x, y) {
								if ('{{ $property->sub_category_id ?? 0}}' == y.id)
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

		var cachedSubSubCategories = {}; // Object to store sub sub categories keyed by subcategory ID

		function fetch_subsubcategories(id, callback) {
			$('#sub_sub_category_id').html('<option value="">Loading...</option>');
			var route = "{{ url('get/sub-sub-categories') }}/" + id;

			$.ajax({
				url: route,
				method: 'GET',
				success: function (response) {
					$('#sub_sub_category_id').empty().append('<option value="">Select Property Type</option>');
					if (response.subsubcategories && response.subsubcategories.length) {
						cachedSubSubCategories = response.subsubcategories;

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


		// 🔹 Auto-load on page load if editing
		$(document).ready(function () {
			let preselectedSubCategory = "{{ $property->sub_category_id }}";
			let preselectedSubSubCategory = "{{ $property->sub_sub_category_id }}";

			if (preselectedSubCategory) {
				fetch_subsubcategories(preselectedSubCategory, preselectedSubSubCategory);
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



		function fetch_form_type() {

			var cat = $(".populate_categories option:selected").val();
			var subcat = $(".populate_subcategories option:selected").val();
			var listing_id = $("#id").val();

			if (cat == "") {
				clearFormType(true);
				return true;
			}


			// var route = "{{route('admin.fetch_form_type')}}/?cat="+cat+"&subcat="+subcat+"&edit=0&listing_id="+listing_id;
			var route = "{{config('app.api_url')}}/fetch_form_type/?cat=" + cat + "&subcat=" + subcat + "&edit=0&listing_id=" + listing_id;
			$.ajax({
				url: route,
				method: 'get',
				beforeSend: function () {
					// $(".updateproperty").attr('disabled', true);
					$(".loading").css('display', 'block');
				},
				success: function (response) {
					// var response = JSON.parse(response);
					$("#formtype_id").val('')
					if (response.responseCode === 200) {
						var responseData = response.data.FormType;
						var listing = response.data.Property;
						var property_subfeatures = [];
						if (responseData.length > 0) {
							clearFormType();
							// form type
							$.each(responseData, function (x, y) {
								// console.log(y)
								// console.log('formtype_id=>',y.formtype_id)
								$("#formtype_id").val(y.formtype_id)


								switch (y.input_type) {
									case "1":
										// console.log('sub_feature_enabled =>', b.sub_feature_enabled, 'sub_features =>', sub_features.id)
										// console.log('sub_f_id =>',y.sub_f_id);
										$(".add_formtype").append(
											`
										  <div class='form-group col-sm-4'>
										  <label> 
										  <input type='checkbox' class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value="checked"  name=${y.sub_feature_slug}  />
										  ${y.sub_feature_name} 
										  </label>
										  </div>
										  `
										);
										break;

									case "2":
										$(".add_formtype").append(
											`
										  <div class='form-group col-sm-4'>
										  <label> 
										  <input type='text'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}   />
										  ${y.sub_feature_name} 
										  </label>
										  </div>
										  `
										);
										break;

									case "3":
										$(".add_formtype").append(
											`
										  <div class='form-group col-sm-4'>
										  <label> 
										  <input type='radio'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value='on' name='radio[]'  />
										  ${y.sub_feature_name} 
										  </label>
										  </div>
										  `
										);
										break;

									case "4":
										$(".add_formtype").append(
											`
										  <div class='form-group col-sm-4'>
										  <label> 
										  <textarea class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}></textarea>
										  ${y.sub_feature_name} 
										  </label>
										  </div>
										  `
										);
										break;

									case "5":
										$(".add_formtype").append(
											`
										  <div class='form-group col-sm-4'>
										  <label> 
										  ${y.sub_feature_name} 
										  <select>
										  <option value='' class='form-control dynamic_forms' data-sub-feature-id=${y.sub_f_id} name=${y.sub_feature_slug} data-input-type=${y.input_type}>
										  Select
										  </option>
										  </select>
										  </label>
										  </div>
										  `
										);
										break;


								}

							}); // end $.each

							$.each(listing, function (c, d) {
								// property_subfeatures.push(y.sub_feature_id);

								console.log(d);
								$(".dynamic_forms").each(function (a, b) {
									var input_val = Number($(this).attr('data-sub-feature-id'));
									if (input_val == d.sub_feature_id) {
										$(this).attr('checked', true);
										$(this).val(d.feature_value)
									}
									// if(property_subfeatures.includes(input_val)) {
									//  $(this).attr('checked', true);
									// }
								});

							});



						} else {
							clearFormType(true);
						}
					}
				},
				error: function (response) {
					toastr.error('An error occured');
				},
				complete: function () {
					$(".loading").css('display', 'none');
					$(".updateproperty").attr('disabled', false);
				}
			})
		}


	</script>
@endsection