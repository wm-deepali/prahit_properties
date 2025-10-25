@extends('layouts.front.app')

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
										<h3> {{$property_detail->title}}</h3>
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
												<li>
													<button type="button" class="btn btn-fill" data-toggle="modal"
														data-target="#contact-agent"
														onclick='window.active_listing_id = "{{$property_detail->id}}"'>
														Contact Agent
													</button>
												</li>
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
									@php
										// Build full address for map
										$mapAddress = [];

										if ($property_detail->address) {
											$mapAddress[] = $property_detail->address;
										}

										if ($property_detail->Location) {
											$mapAddress[] = $property_detail->Location->location;
										}

										if ($property_detail->getCity) {
											$mapAddress[] = $property_detail->getCity->name;
										}

										if ($property_detail->getState) {
											$mapAddress[] = $property_detail->getState->name;
										}

										$fullAddress = implode(', ', array_filter($mapAddress));
										$encodedAddress = urlencode($fullAddress);
									@endphp

									@if($fullAddress)
										<iframe src="https://www.google.com/maps?q={{ $encodedAddress }}&output=embed"
											width="100%" height="400px" frameborder="0" style="border:0; border-radius: 8px;"
											allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
										</iframe>
									@else
										<div
											style="padding: 60px; text-align: center; background: #f5f5f5; border-radius: 8px;">
											<i class="fas fa-map-marker-alt"
												style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
											<p style="color: #999; margin: 0;">Location information not available</p>
										</div>
									@endif
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
							<h3>Contact Agent</h3>
						</div>
						<div class="property-contact">
							<form method="post" action="{{ url('send/enquery') }}">
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
										<button class="btn btn-submit" type="submit">Send Enquiry</button>
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
													(Floor,Amenities,Furnished</label></li>
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
@endsection


@section('js')
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<script type="text/javascript">
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
	</script>


	<script type="text/javascript">
		$("#contact_agent_form").validate({
			rules: {
				mobile_number: {
					number: true,
					minlength: 10,
					maxlength: 10,
				}
			},
			submitHandler: function () {
				var formData = $("#contact_agent_form").serializeArray();
				formData.push({ name: 'property_id', value: "{{$property_detail->id}}" });

				$.ajax({
					url: "{{config('app.api_url') . '/property/agent_enquiry'}}",
					method: 'post',
					data: formData,
					beforeSend: function () {
						$(".loading").css('display', 'block');
					},
					success: function (response) {
						if (response.responseCode === 200) {
							toastr.success('Enquiry sent successfully')
							$("#contact_agent_form").trigger('reset');
						} else {
							toastr.error(response.message);
						}
					},
					error: function (response) {
						toastr.error('An error occured');
					},
					complete: function () {
						$(".loading").css('display', 'none');
					}
				})

			}
		});


		// 


		// $("#feedback_form").validate({
		// 	// rules:{
		// 	// 	mobile_number:{
		// 	// 		number:true,
		// 	// 		minlength:10,
		// 	// 		maxlength:10,
		// 	// 	}
		// 	// },
		// 	submitHandler:function() {
		// 		var formData = $("#feedback_form").serializeArray();
		// 		formData.push({name: 'property_id', value:"{{$property_detail->id}}"});

		// 		$.ajax({
		// 			url: "{{config('app.api_url') . '/property/feedback'}}",
		// 			method:'post',
		// 			data: formData,
		// 			beforeSend:function(){
		// 				$(".loading").css('display','block');
		// 			},
		// 			success:function(response){
		// 				if(response.responseCode === 200) {
		// 					toastr.success('Feedback submitted successfully')
		// 					$("#feedback_form").trigger('reset');
		// 				} else {
		// 					toastr.error(response.message);
		// 				}
		// 			}, 
		// 			error:function(response) {
		// 				var response = JSON.parse(response.responseText);
		// 				response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
		// 			},
		// 			complete:function(){
		// 				$(".modal").modal('hide');
		// 				$(".loading").css('display','none');
		// 			}
		// 		})

		// 	}
		// });

		unit_price('property_price', $(".property_price").text());

		@auth
			mask_label('mask_email', 'Email', '{{Auth::user()->email}}');
			mask_label('mask_number', 'Mobile Number:', '{{Auth::user()->mobile_number}}');
		@endauth
	</script>

@endsection