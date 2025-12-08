@extends('layouts.front.app')

@section('title')
	<title>Contact Us</title>
@endsection

@section('content')

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>Contact Us</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-us-page">
		<div class="contact-one-part">
			<div class="container">
				<div class="row">
					@foreach($infos as $info)
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! $info->icon !!}
							<h2>{{ $info->title }}</h2>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! $info->address !!}
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p>Phone : {{ $info->mobile_number }}</p>
									<p>Email : {{ $info->email }}</p>
								</div>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>

		<div class="contact-two-part">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="contact-two-content">
							<div class="section-title text-center">
								<span class="sp-span">CONTACT</span>
								<h2>Keep in Touch</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ante nisi, feugiat vel
									leo eget, dictum.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-md-8 col-sm-12">
						<div class="contact-form">
							<form method="post" action="{{ route('contactus.sendUserQuery') }}" id="send-query">
								@csrf
								<div class="row">
									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" name="name" id="name" class="form-control" placeholder="Name"
												onclick="removeAlert('alert-name')">
											<div class="help-block with-errors" id="alert-name"></div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="email" name="email" id="email" class="form-control"
												placeholder="Email" onclick="removeAlert('alert-email')">
											<div class="help-block with-errors" id="alert-email"></div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" name="phone_number" id="phone_number" class="form-control"
												placeholder="Phone" onclick="removeAlert('alert-phone_number')">
											<div class="help-block with-errors" id="alert-phone_number"></div>
										</div>
									</div>

									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" name="msg_subject" id="msg_subject" class="form-control"
												placeholder="Your Subject" onclick="removeAlert('alert-subject')">
											<div class="help-block with-errors" id="alert-subject"></div>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<textarea name="message" class="form-control" id="message" cols="30" rows="8"
												placeholder="Your Message"
												onclick="removeAlert('alert-message')"></textarea>
											<div class="help-block with-errors" id="alert-message"></div>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>
												<input type="checkbox" id="terms"> I Accept
												<a href="{{ route('front.termCondition') }}">Terms & Conditions</a> And
												<a href="/privacy-policy">Privacy Policy.</a>
											</label>
											<div class="help-block with-errors" id="alert-terms"></div>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 text-center">
										<button type="button" class="btn btn-sendmsg" onclick="sendQuery()">Send
											Message</button>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="contact-three-part">
			<iframe src="{{ $map_link->description }}" width="100%" height="350" style="border:0;" allowfullscreen=""
				loading="lazy"></iframe>
		</div>
	</section>

@endsection

@section('js')
	<script type="text/javascript">

		function validateEmail(email) {
			var emailRegex = /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+.)+([a-zA-Z0-9]{2,4})+$/;
			return emailRegex.test(email);
		}

		function validatePhone(phone) {
			var phoneRegex = /^(\+91-|\+91|0)?\d{10}$/;
			return phoneRegex.test(phone);
		}

		function removeAlert(id) {
			document.getElementById(id).innerHTML = '';
		}

		function sendQuery() {

			let name = $('#name').val().trim();
			let email = $('#email').val().trim();
			let phone = $('#phone_number').val().trim();
			let subject = $('#msg_subject').val().trim();
			let message = $('#message').val().trim();
			let terms = document.getElementById('terms').checked;

			if (name === '') {
				$('#alert-name').text('Name field is required.').css('color', 'red');
				return false;
			}

			if (email === '') {
				$('#alert-email').text('Email field is required.').css('color', 'red');
				return false;
			}
			if (!validateEmail(email)) {
				$('#alert-email').text('Invalid email format.').css('color', 'red');
				return false;
			}

			if (phone === '') {
				$('#alert-phone_number').text('Mobile number is required.').css('color', 'red');
				return false;
			}
			if (!validatePhone(phone)) {
				$('#alert-phone_number').text('Invalid mobile number.').css('color', 'red');
				return false;
			}

			if (subject === '') {
				$('#alert-subject').text('Subject is required.').css('color', 'red');
				return false;
			}

			if (message === '') {
				$('#alert-message').text('Message is required.').css('color', 'red');
				return false;
			}

			if (!terms) {
				$('#alert-terms').text('You must accept Terms & Conditions.').css('color', 'red');
				return false;
			}

			document.getElementById("send-query").submit();
		}

	</script>
@endsection