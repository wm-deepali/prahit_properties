@extends('layouts.front.app')
@section('title')
<title>Summons Notice</title>
@endsection

@section('content')
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Summons Notice</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Summons Notice</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="summons-notice">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="contact-two-content">
					<div class="section-title text-center">
						<span class="sp-span">Only for Law Enforcement Agencies</span>
						<h2>Complaint / Status Form</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8 col-sm-12">
				<div class="complaint-form">
					<form method="post" action="{{ route('front.sendSummonsNotice') }}" id="send-query" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<div class="form-group">
									<label class="label-control">Name</label>
									<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" onkeyup="removeAlert('alert-name')">
									<div class="help-block with-errors" id="alert-name"></div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="form-group">
									<label class="label-control">Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" onkeyup="removeAlert('alert-email')">
									<div class="help-block with-errors" id="alert-email"></div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="form-group">
									<label class="label-control">Mobile No.</label>
									<input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile No." onkeyup="removeAlert('alert-phone_number')">
									<div class="help-block with-errors" id="alert-phone_number"></div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="form-group">
									<label class="label-control">Page which you are reporting against</label>
									<input type="text" class="form-control" name="link" id="link" placeholder="Enter Link (URL)" onkeyup="removeAlert('alert-link')">
									<div class="help-block with-errors" id="alert-link"></div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label class="label-control">Please tell us the reason for your complaint/concern. Choose an option which most closely matches with your concern. If you are unsure which option to choose, please select the last option. Thanks</label>
									<div class="d-block">
										<ul>
											@foreach($reasons as $r => $reason)
											<li>
												<label><input type="checkbox" name="reason[]" value="{{ $reason->id }}"> {!! $reason->reason !!}</label>
											</li>
											@endforeach
											<li>
												<label><input type="checkbox" name="other" id="other" onclick="showOtherCommentBox()"> Other <input type="text" class="form-control" placeholder="Other" name="other_reason" id="other_reason" style="display: none;" onkeyup="removeAlert('alert-other')"></label>
												<div class="help-block with-errors" id="alert-other"></div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label class="label-control">Please describe your complaint/concern in detail</label>
									<textarea name="message" class="form-control" name="message" id="message" cols="30" rows="8" placeholder="Your Message" onkeyup="removeAlert('alert-message')"></textarea>
									<div class="help-block with-errors" id="alert-message"></div>
								</div>
							</div>
							
							<div class="col-lg-12 col-sm-12">
								<div class="form-group">
									<label class="label-control">Please upload any supporting document(s) pertaining to the issue you are reporting</label>
									<input type="file" name="file" class="form-control">
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label> <input type="checkbox"> I Accept <a href="#">Terms &amp; Conditions</a> And <a href="privacy-policy.php">Privacy Policy.</a> </label>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 text-center">
								<button type="button" class="btn btn-sendmsg" onclick="sendComplaint()">Submit Complaint</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('js')
<script type="text/javascript">
	function sendComplaint() {
		var name = $('#name').val();
		var email = $('#email').val();
		var phone_number = $('#phone_number').val();
		var link = $('#link').val();
		var message = $('#message').val();
		if(name == '') {
			document.getElementById('alert-name').innerHTML = 'Name field must be required.';
			document.getElementById('alert-name').style.color = 'red';
			document.getElementById("name").focus();
			return false;
		}
		if(email == '') {
			document.getElementById('alert-email').innerHTML = 'Email field must be required.';
			document.getElementById('alert-email').style.color = 'red';
			document.getElementById("email").focus();
			return false;
		}
		if(!this.validateEmail(email)) {
			document.getElementById('alert-email').innerHTML = 'Invalid email formate, please enter correctly.';
			document.getElementById('alert-email').style.color = 'red';
			document.getElementById("email").focus();
			return false;
		}
		if(phone_number == '') {
			document.getElementById('alert-phone_number').innerHTML = 'Mobile Number field must be required.';
			document.getElementById('alert-phone_number').style.color = 'red';
			document.getElementById("phone_number").focus();
			return false;
		}
		if(!this.validatePhone(phone_number)) {
			document.getElementById('alert-phone_number').innerHTML = 'Invalid mobile number formate, please enter correctly.';
			document.getElementById('alert-phone_number').style.color = 'red';
			document.getElementById("phone_number").focus();
			return false;
		}

		var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
		if(link) {
			if(!regex .test(link)) {
			    document.getElementById('alert-link').innerHTML = 'Please enter valid URL.';
				document.getElementById('alert-link').style.color = 'red';
				document.getElementById("link").focus();
			    return false;
			}
		}

		var other = document.getElementById('other');
		if(other.checked == true) {
			var other_reason = $('#other_reason').val();
			if(other_reason == '') {
				document.getElementById('alert-other').innerHTML = 'Other reason field must be required.';
				document.getElementById('alert-other').style.color = 'red';
				document.getElementById("other_reason").focus();
				return false;
			}
		}
		
		if(message == '') {
			document.getElementById('alert-message').innerHTML = 'Message field must be required.';
			document.getElementById('alert-message').style.color = 'red';
			document.getElementById("message").focus();
			return false;
		}
		document.getElementById("send-query").submit();
	}

	function validateEmail(email) { //Validates the email address
	    var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return emailRegex.test(email);
	}

	function validatePhone(phone) { //Validates the phone number
	    var phoneRegex = /^(\+91-|\+91|0)?\d{10}$/; // Change this regex based on requirement
	    return phoneRegex.test(phone);
	}

	function removeAlert(id) {
		document.getElementById(id).innerHTML = '';
	}

	function showOtherCommentBox() {
		var other = document.getElementById('other');
		if(other.checked == true) {
			document.getElementById('other_reason').style.display = 'block';
		}else {
			document.getElementById('other_reason').style.display = 'none';
		}
	}
</script>
@endsection