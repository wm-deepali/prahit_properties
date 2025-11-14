@extends('layouts.front.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('title')
	<title>{{$property_detail->title}} - {{config('app.name')}}</title>
	<style type="text/css">
		.rendered-form {
			margin-left: 15px;
		}
	</style>
@endsection

@section('content')

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>PropertyDetail</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
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
										<h3 class="property-title">
											{{ $property_detail->title }}

											@if($property_detail->verified_tag === 'Yes')
												<span class="badge bg-success ms-2">
													<i class="bi bi-patch-check-fill"></i> Verified
												</span>
											@endif
										</h3>

										<div class="loc-id-detail">
											<ul>
												{{-- Remove location/sub-location from here - showing in featured details
												below --}}
												<li>
													<i class="fas fa-map-marker-alt"></i>
													{{ $property_detail->getCity ? $property_detail->getCity->name : '' }}{{ $property_detail->getState ? ', ' . $property_detail->getState->name : '' }}
												</li>
											</ul>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="price-detail">
											<h3><i class="fas fa-rupee-sign"></i> <span class="property_price">
													{{isset($property_detail->price) ? \App\Helpers\Helper::formatIndianPrice($property_detail->price) : ''}}
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
											<img src="{{isset($property_detail->PropertyGallery[0]) ? url('/') . '/' . $property_detail->PropertyGallery[0]->image_path : ''}}"
												class="img-fluid">
										</div>
									</div>

									<div class="col-sm-8">
										<div class="property-featured-det">
											<div class="row">

												<!-- Category -->
												@if($property_detail->Category)
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Property Available For</div>
														<div class="detail-field-value">
															{{ $property_detail->Category->category_name }}
														</div>
													</div>
												@endif

												<!-- Sub Category -->
												@if($property_detail->SubCategory)
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Category</div>
														<div class="detail-field-value">
															{{ $property_detail->SubCategory->sub_category_name }}
														</div>
													</div>
												@endif

												<!-- Sub Sub Category -->
												@if($property_detail->SubSubCategory)
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Property Type</div>
														<div class="detail-field-value">
															{{ $property_detail->SubSubCategory->sub_sub_category_name }}
														</div>
													</div>
												@endif

												<!-- State -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">State</div>
													<div class="detail-field-value">
														{{ $property_detail->getState ? $property_detail->getState->name : 'N/A' }}
													</div>
												</div>

												<!-- City -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">City</div>
													<div class="detail-field-value">
														{{ $property_detail->getCity ? $property_detail->getCity->name : 'N/A' }}
													</div>
												</div>

												<!-- Location -->
												@if($property_detail->Location)
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Location</div>
														<div class="detail-field-value">
															{{ $property_detail->Location->location }}
														</div>
													</div>
												@endif

												<!-- Sub Location -->
												@if($property_detail->sub_location_id)
													<div class="col-sm-6 col-md-6 col-xs-6">
														<div class="detail-field-label">Sub Location</div>
														<div class="detail-field-value">
															{{ \App\SubLocations::find($property_detail->sub_location_id)->sub_location_name ?? 'N/A' }}
														</div>
													</div>
												@endif

												<!-- Address -->
												<div class="col-sm-6 col-md-6 col-xs-6">
													<div class="detail-field-label">Address</div>
													<div class="detail-field-value">{{ $property_detail->address ?? 'N/A' }}
													</div>
												</div>

											</div>
										</div>

										<div class="property-featured-btn">
											<ul>
												<!-- <li>
																							<button class="btn btn-fill" type="button" data-toggle="modal"
																								data-target="#contact-agent"
																								onclick='window.active_listing_id = "{{$property_detail->id}}"'
																								@if(auth()->check() && $property_detail->user_id === auth()->id())
																								disabled @endif>
																								Contact Agent
																							</button>

																						</li> -->
												<li>
													<button type="button" class="btn btn-outline"
														onclick="claim('{{ $property_detail->id }}')">
														Claim Listing
													</button>
												</li>
												<li>
													<button type="button" class="btn btn-outline" data-toggle="modal"
														data-target="#feedback-complaint">
														Feedback / Complaint
													</button>
												</li>
												<li>
													<button id="wishlistButton"
														class="btn btn-outline purchase-wishlist-btn"
														data-submission="{{ $property_detail->id }}">
														{!! $isInWishlist ? '❤️ Added to Wishlist' : '♡ Add to Wishlist' !!}
													</button>
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
								@foreach($property_detail->PropertyGallery as $k => $v)
									<div class="col-sm-3">
										<a href="#">
											<img src="{{url('/') . '/' . $v->image_path}}" class="img-fluid">
										</a>
									</div>
								@endforeach
							</div>
						</div>
					</div>

					@if(!empty($property_detail->property_video))
						<div class="card property-widgets">
							<div class="property-title">
								<h3>Property Video</h3>
							</div>
							<div class="property-gallery">
								<div class="row">
									<video class="w-100" controls>
										<source src="{{ url($property_detail->property_video) }}" type="video/mp4">
										Your browser does not support the video tag.
									</video>
								</div>
							</div>
						</div>
					@endif

					<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Description</h3>
						</div>
						<div class="property-description">
							<div class="row">
								<div class="col-sm-12">
									<p> {{isset($property_detail->description) ? $property_detail->description : ''}} </p>
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
									<div id="propertyMap"
										style="width:100%; height:400px; border-radius: 8px; margin-bottom: 10px;"></div>
									<input type="hidden" id="latitude" name="latitude"
										value="{{ $property_detail->latitude }}">
									<input type="hidden" id="longitude" name="longitude"
										value="{{ $property_detail->longitude }}">
								</div>
							</div>
						</div>
					</div>

					@if(count($amenities) > 0)
						<div class="card property-widgets">
							<div class="property-title">
								<h3>Property Amenities</h3>
							</div>
							<div class="property-amenities">
								<div class="row">
									@foreach($amenities as $amenity)
										<div class="col-sm-2">
											<div class="amenities-main">
												<img src="{{ asset('storage') }}/{{ $amenity->icon }}" class="img-fluid">
												<h3>{{ $amenity->name }}</h3>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					@endif

					<div class="card property-widgets">
						<div class="property-title">
							<h3>Property Additional Details</h3>
						</div>

						<div class="property-additional-details">
							<div class="row">
								<!-- Price Label -->
								@if($property_detail->price_label)
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Price Label</div>
										<div class="detail-field-value">
											{{ $property_detail->getPriceLabels($property_detail->price_label) ?? 'N/A' }}
											@if($property_detail->price_label_second)
												<div class="mt-2">
													<strong>{{ optional($property_detail->getPriceLabelObj())->second_input_label ?? 'Date' }}:</strong>
													<span>{{ $property_detail->price_label_second }}</span>
												</div>
											@endif
										</div>
									</div>
								@endif

								<!-- Property Status -->
								@if($property_detail->property_status)
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Property Status</div>
										<div class="detail-field-value">
											{{ $property_detail->getPropertyStatuses($property_detail->property_status) ?? 'N/A' }}
											@if($property_detail->property_status_second)
												<div class="mt-2">
													<strong>{{ optional($property_detail->getPropertyStatusObj())->second_input_label ?? 'Date' }}:</strong>
													<span>{{ $property_detail->property_status_second }}</span>
												</div>
											@endif
										</div>
									</div>
								@endif

								<!-- Registration Status -->
								@if($property_detail->registration_status)
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Registration Status</div>
										<div class="detail-field-value">
											{{ $property_detail->getRegistrationStatuses($property_detail->registration_status) ?? 'N/A' }}
											@if($property_detail->registration_status_second)
												<div class="mt-2">
													<strong>{{ optional($property_detail->getRegistrationStatusObj())->second_input_label ?? 'Date' }}:</strong>
													<span>{{ $property_detail->registration_status_second }}</span>
												</div>
											@endif
										</div>
									</div>
								@endif

								<!-- Furnishing Status -->
								@if($property_detail->furnishing_status)
									<div class="col-sm-6 col-md-6 mb-3">
										<div class="detail-field-label">Furnishing Status</div>
										<div class="detail-field-value">
											{{ $property_detail->getFurnishingStatuses($property_detail->furnishing_status) ?? 'N/A' }}
											@if($property_detail->furnishing_status_second)
												<div class="mt-2">
													<strong>{{ optional($property_detail->getFurnishingStatusObj())->second_input_label ?? 'Date' }}:</strong>
													<span>{{ $property_detail->furnishing_status_second }}</span>
												</div>
											@endif
										</div>
									</div>
								@endif
							</div>
						</div>

						<!-- Original form-rendered additional info -->
						<div id="additional-info"></div>
					</div>

				</div>

				<div class="col-sm-4">
					<div class="card property-widgets">
						<div class="property-title">
							<h3>
								Contact
								@if($property_user->premium_seller === 'Yes')
									<span class="badge bg-success ms-2">
										<i class="bi bi-patch-check-fill"></i> Preminum Seller
									</span>
								@endif
							</h3>
						</div>
						<div class="property-contact">
							<form id="enquiryForm">
								@csrf
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="hidden" name="property_id" value="{{ $property_detail->id }}">
										<label class="label-control">Name</label>
										<input type="text" class="text-control" placeholder="Enter Name" name="name"
											value="{{Auth::check() ? Auth::user()->firstname : ''}}" {{Auth::check() ? "readonly" : "" }} required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Email</label>
										<input type="email" class="text-control" placeholder="Enter Email" name="email"
											value="{{Auth::check() ? Auth::user()->email : ''}}" {{Auth::check() ? "readonly" : "" }} required />
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<label class="label-control">Mobile No.</label>
										<input type="number" class="text-control" placeholder="Enter Mobile No." min="1"
											value="{{Auth::check() ? Auth::user()->mobile_number : ''}}" {{Auth::check() ? "readonly" : "" }} name="mobile_number" required />
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
										<button type="submit" class="btn btn-submit" id="sendEnquiryBtn" @if(auth()->check() && $property_detail->user_id === auth()->id()) disabled @endif>
											Send Enquiry
										</button>

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
	<input type="hidden" id="form-json" value="{{ $property_detail->additional_info }}">
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
					<img src="{{url('/public/images/top-designs.png')}}" class="img-fluid">
				</div>

				<center class="loading">
					<img src="{{url('/images/loading.gif')}}" alt="Loading.." style="height: 30px;" class="loading" />
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
							<form method="post" action="{{ url('master/property/feedback/create') }}">
								@csrf
								<input type="hidden" name="property_id" value="{{ $property_detail->id }}">
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
													(Floor,Amenities,Furnished)</label></li>
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

	<!-- OTP Verification Modal -->
	<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-4">
				<div class="modal-header border-0">
					<h5 class="modal-title" id="otpModalLabel">Verify Mobile Number</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<div id="otpStep1">
						<label>Enter your mobile number</label>
						<input type="number" id="otpMobile" class="form-control mb-3" placeholder="Enter mobile number">
						<button type="button" id="sendOtpBtn" class="btn btn-primary w-100">Send OTP</button>
					</div>

					<div id="otpStep2" style="display: none;">
						<label>Enter OTP</label>
						<input type="number" id="otpCode" class="form-control mb-3" placeholder="Enter OTP">
						<button type="button" id="verifyOtpBtn" class="btn btn-success w-100">Verify OTP</button>
						<p class="text-center mt-2">
							Didn’t receive OTP? <a href="#" id="resendOtp">Resend</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection


@section('js')
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<script type="text/javascript">

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

		@if(!empty($property_detail->latitude) && !empty($property_detail->longitude))
			// Property has saved lat/lng; use those
			createMap({{ $property_detail->latitude }}, {{ $property_detail->longitude }});
		@else
																																			// Use browser geolocation or default
																																			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (pos) {
					createMap(pos.coords.latitude, pos.coords.longitude);
				}, function () {
					createMap(28.6139, 77.2090); // fallback: Delhi
				});
			} else {
				createMap(28.6139, 77.2090);
			}
		@endif


		document.addEventListener('DOMContentLoaded', function () {
			var wishlistBtn = document.getElementById('wishlistButton');
			if (wishlistBtn) {
				wishlistBtn.addEventListener('click', function () {
					var button = this;
					var submissionId = button.getAttribute('data-submission');

					@if(!Auth::user())
						Swal.fire({
							icon: 'info',
							title: 'Login Required',
							text: 'Please login to manage your wishlist.',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK'
						});
						return;
					@endif

					fetch("{{ route('wishlist.toggle') }}", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						body: JSON.stringify({ property_id: submissionId })
					}).then(response => response.json())
						.then(data => {
							if (data.added) {
								button.textContent = '❤️ Added to Wishlist';
								Swal.fire({
									icon: 'success',
									title: 'Added!',
									text: 'Property added to your wishlist.',
									timer: 1500,
									showConfirmButton: false
								});
							} else {
								button.textContent = '♡ Add to Wishlist';
								Swal.fire({
									icon: 'info',
									title: 'Removed',
									text: 'Property removed from your wishlist.',
									timer: 1500,
									showConfirmButton: false
								});
							}
						}).catch(() => {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Could not update wishlist. Please try again.',
								confirmButtonColor: '#d33'
							});
						});
				});
			}

		});

		$(".loading").css('display', 'none');

		$(document).ready(function () {
			var formData = $('#form-json').val();

			if (formData) {
				try {
					var json_data = JSON.parse(formData);
					var outputHTML = '<div class="row">';

					json_data.forEach(function (field) {
						// Skip headers and paragraphs (but show them as section titles)
						if (field.type === 'header' || field.type === 'paragraph') {
							if (field.label) {
								outputHTML += '<div class="col-sm-12 mb-3"><h4 style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 10px; border-bottom: 2px solid #e38e32; padding-bottom: 8px;">' + stripHtml(field.label) + '</h4></div>';
							}
							return;
						}

						var label = field.label ? stripHtml(field.label) : 'N/A';
						var value = 'Not Provided';

						// Get userData (selected/entered values)
						if (field.userData && field.userData.length > 0) {
							// Check if userData has actual values
							var hasValue = field.userData.some(function (item) {
								return item !== '' && item !== null && item !== undefined;
							});

							if (hasValue) {
								if (field.type === 'radio-group' || field.type === 'select') {
									// Find the label for selected value
									var selectedValue = field.userData[0];
									if (field.values) {
										var selectedOption = field.values.find(function (v) {
											return v.value === selectedValue || v.selected === true;
										});
										value = selectedOption ? selectedOption.label : selectedValue;
									}
								} else if (field.type === 'checkbox-group') {
									// ✅ Handle multiple checkbox values
									var selectedValues = [];
									field.userData.forEach(function (userValue) {
										if (userValue !== '' && userValue !== null) {
											// Find label for each checked value
											if (field.values) {
												var option = field.values.find(function (v) {
													return v.value === userValue;
												});
												selectedValues.push(option ? option.label : userValue);
											} else {
												selectedValues.push(userValue);
											}
										}
									});
									// Join with bullets or commas
									value = selectedValues.length > 0 ? selectedValues.join(', ') : 'Not Provided';
								} else {
									// ✅ Handle text/number with potential multiple values
									var filteredValues = field.userData.filter(function (item) {
										return item !== '' && item !== null && item !== undefined;
									});
									value = filteredValues.length > 0 ? filteredValues.join(', ') : 'Not Provided';
								}
							}
						}

						// Display ALL fields
						outputHTML += '<div class="col-sm-6 col-md-6 mb-3">';
						outputHTML += '  <div class="detail-field-label">' + label + '</div>';
						outputHTML += '  <div class="detail-field-value">' + value + '</div>';
						outputHTML += '</div>';
					});

					outputHTML += '</div>';
					$('#additional-info').html(outputHTML);
				} catch (e) {
					console.error('Error parsing JSON:', e);
					$('#additional-info').html('<p style="color: #999;">Additional information not available</p>');
				}
			}
		});

		// Helper function to strip HTML tags
		function stripHtml(html) {
			var tmp = document.createElement("DIV");
			tmp.innerHTML = html;
			return tmp.textContent || tmp.innerText || "";
		}


		document.addEventListener("DOMContentLoaded", function () {
			const enquiryForm = document.querySelector(".property-contact form");
			const sendEnquiryBtn = document.getElementById("sendEnquiryBtn");

			// only trigger OTP if user not logged in
			@if(!Auth::check())
				sendEnquiryBtn.addEventListener("click", function (e) {
					e.preventDefault(); // ✅ stops page reload
					const mobile = enquiryForm.querySelector('input[name="mobile_number"]').value.trim();
					if (!mobile) {
						Swal.fire({
							icon: 'warning',
							title: 'Mobile Number Required',
							text: 'Please enter your mobile number before continuing.',
						});
						return;
					}
					// open OTP modal
					$('#otpModal').modal('show');
					document.getElementById("otpMobile").value = mobile;

				});
			@else
				// logged in → submit directly
				sendEnquiryBtn.addEventListener("click", function () {
					let formData = new FormData(enquiryForm); // ✅ use existing variable
					submitEnquiry(formData);
				});
			@endif

			// Send OTP
			document.getElementById("sendOtpBtn").addEventListener("click", function () {
				const mobile_number = document.getElementById("otpMobile").value.trim();
				if (!mobile_number) {
					Swal.fire({
						icon: 'warning',
						title: 'Missing Mobile Number',
						text: 'Please enter a mobile number to send OTP.',
					});
					return;
				}

				fetch("{{ route('agent.send-otp') }}", {
					method: "POST",
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}",
						"Content-Type": "application/json"
					},
					body: JSON.stringify({ mobile_number })
				})
					.then(res => res.json())
					.then(data => {
						if (data.success) {
							Swal.fire({
								icon: 'info',
								title: 'OTP Sent!',
								text: 'We have sent a 4-digit OTP to your mobile number.',
								confirmButtonColor: '#ffc107'
							});
							document.getElementById("otpStep1").style.display = "none";
							document.getElementById("otpStep2").style.display = "block";
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Failed to Send OTP',
								text: data.message || "Failed to send OTP",
							});
						}
					});
			});

			// Verify OTP
			document.getElementById("verifyOtpBtn").addEventListener("click", function (e) {
				e.preventDefault();

				let formData = new FormData(document.getElementById('enquiryForm'));
				formData.append('otp', document.getElementById('otpCode').value);

				submitEnquiry(formData);
			});
			// Resend OTP
			document.getElementById("resendOtp").addEventListener("click", function (e) {
				e.preventDefault();
				document.getElementById("sendOtpBtn").click();
			});


			// ✅ Common function for submitting final enquiry
			function submitEnquiry(formData) {
				fetch("{{ route('enquery.agent_enquiry') }}", {
					method: "POST",
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
					body: formData
				})
					.then(res => res.json())
					.then(data => {

						if (data.success === true || data.success === "true") {
							console.log('Response from server:', data);
							$('#otpModal').modal('hide');

							document.getElementById('enquiryForm').reset();

							Swal.fire({
								icon: 'success',
								title: 'Enquiry Sent!',
								text: 'Your enquiry has been sent successfully!',
								confirmButtonColor: '#ffc107'
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Invalid OTP',
								text: data.message || 'Please enter the correct OTP.',
							});
						}
					})
					.catch(() => {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Error sending enquiry. Please try again later.',
						});
					});
			}
		});
	</script>
@endsection