

<?php $__env->startSection('title'); ?>
<title>Contact Us</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Contact Us</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
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
				<?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $info->icon; ?>

					<h2><?php echo e($info->title); ?></h2>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php echo $info->address; ?>

						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p>Phone : <?php echo e($info->mobile_number); ?></p>
							<p>Email : <?php echo e($info->email); ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
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
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ante nisi, feugiat vel leo eget, dictum.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8 col-sm-12">
					<div class="contact-form">
						<form method="post" action="<?php echo e(route('contactus.sendUserQuery')); ?>" id="send-query">
						<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-lg-6 col-sm-6">
									<div class="form-group">
										<input type="text" name="name" id="name" class="form-control" placeholder="Name" onclick="removeAlert('alert-name')">
										<div class="help-block with-errors" id="alert-name"></div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6">
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control" placeholder="Email" onclick="removeAlert('alert-email')">
										<div class="help-block with-errors" id="alert-email"></div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6">
									<div class="form-group">
										<input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone" onclick="removeAlert('alert-phone_number')">
										<div class="help-block with-errors" id="alert-phone_number"></div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6">
									<div class="form-group">
										<input type="text" name="msg_subject" id="msg_subject" class="form-control" placeholder="Your Subject" onclick="removeAlert('alert-subject')">
										<div class="help-block with-errors" id="alert-subject"></div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Your Message" onclick="removeAlert('alert-message')"></textarea>
										<div class="help-block with-errors" id="alert-message"></div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<label>
											<input type="checkbox"> I Accept <a href="#">Terms &amp; Conditions</a> And <a href="privacy-policy.php">Privacy Policy.</a>
										</label>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 text-center">
									<button type="button" class="btn btn-sendmsg" onclick="sendQuery()">Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="contact-three-part">
		<iframe src="<?php echo e($map_link->description); ?>" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
	function sendQuery() {
		var name = $('#name').val();
		var email = $('#email').val();
		var phone_number = $('#phone_number').val();
		var msg_subject = $('#msg_subject').val();
		var message = $('#message').val();
		if(name == '') {
			document.getElementById('alert-name').innerHTML = 'Name field must be required.';
			document.getElementById('alert-name').style.color = 'red';
			return false;
		}
		if(email == '') {
			document.getElementById('alert-email').innerHTML = 'Email field must be required.';
			document.getElementById('alert-email').style.color = 'red';
			return false;
		}
		if(!this.validateEmail(email)) {
			document.getElementById('alert-email').innerHTML = 'Invalid email formate, please enter correctly.';
			document.getElementById('alert-email').style.color = 'red';
			return false;
		}
		if(phone_number == '') {
			document.getElementById('alert-phone_number').innerHTML = 'Mobile Number field must be required.';
			document.getElementById('alert-phone_number').style.color = 'red';
			return false;
		}
		if(!this.validatePhone(phone_number)) {
			document.getElementById('alert-phone_number').innerHTML = 'Invalid mobile number formate, please enter correctly.';
			document.getElementById('alert-phone_number').style.color = 'red';
			return false;
		}
		if(msg_subject == '') {
			document.getElementById('alert-subject').innerHTML = 'Subject field must be required.';
			document.getElementById('alert-subject').style.color = 'red';
			return false;
		}
		if(message == '') {
			document.getElementById('alert-message').innerHTML = 'Message field must be required.';
			document.getElementById('alert-message').style.color = 'red';
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/front/contact_us.blade.php ENDPATH**/ ?>