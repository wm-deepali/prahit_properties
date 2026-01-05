@extends('layouts.front.app')

@section('title')
	<title>Preview Property</title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
								<h3>Preview Property Description</h3>

								<div class="row">
									<div class="form-group col-sm-4">
										<label class="label-control">Property Available For</label>
										<select class="form-control populate_categories" name="category_id" disabled="">
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
											name="sub_category_id" required disabled="">
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
										<select class="form-control populate_subsubcategories" name="sub_sub_category_id"
											disabled="">
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
										<input type="text" class="form-control" name="title"
											placeholder="Enter Property Name" value="{{$property->title}}" required
											readonly="" />
									</div>

									<!-- <div class="form-group col-sm-4">
										<label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
										<input type="number" class="form-control" name="price" min="0"
											placeholder="Enter Price" value="{{$property->price}}" required readonly="" />
									</div> -->
						
									<div class="form-group col-sm-12">
										<label class="label-control">Description</label>
										<textarea class="form-control" rows="2" cols="4" name="description" required
											readonly=""> {{$property->description}}</textarea>
									</div>
								</div>

								<div id="fb-render"></div>


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
    <div class="form-group col-sm-6">
        <label class="label-control">Landmark</label>
        <input type="text"
               class="form-control"
               value="{{ $property->landmark }}"
               readonly>
    </div>

    <div class="form-group col-sm-6">
        <label class="label-control">Pin Code</label>
        <input type="text"
               class="form-control"
               value="{{ $property->pincode }}"
               readonly>
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

            @if($img->is_default)
                <span class="badge bg-primary mt-1">Default</span>
            @endif

        </div>
    @endforeach
</div>

								@if(!empty($property->property_video))
									<h3 class="mt-4">Property Video</h3>
									<div class="form-group">
										<video width="320" height="240" controls>
											<source src="{{ url($property->property_video) }}" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								@endif

							
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

			@if(!empty($property->SubSubCategory))
				toggleSubSubCategoryFields(@json($property->SubSubCategory));
			@endif

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
@endsection