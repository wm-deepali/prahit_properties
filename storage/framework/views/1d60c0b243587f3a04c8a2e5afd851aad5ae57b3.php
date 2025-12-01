

<?php $__env->startSection('title'); ?>
	<title>My Profile</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3>Profile Settings</h3>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
							</li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">My Account</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>

	<section class="owner-section profile">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="col-sm-9">
					<div class="main-area-dash">
						<h3 class="head-tit">My Profile</h3>
						<section class="dashboard-area profile-tabs">
							<?php
								$activeTab = request('tab', 'profile'); // default: profile
							?>

							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link <?php echo e($activeTab == 'profile' ? 'active' : ''); ?>" id="myprofile-tab"
										data-toggle="pill" href="#myprofile" role="tab" aria-controls="myprofile"
										aria-selected="<?php echo e($activeTab == 'profile' ? 'true' : 'false'); ?>">
										My Profile
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link <?php echo e($activeTab == 'security' ? 'active' : ''); ?>"
										id="loginsecurity-tab" data-toggle="pill" href="#loginsecurity" role="tab"
										aria-controls="loginsecurity"
										aria-selected="<?php echo e($activeTab == 'security' ? 'true' : 'false'); ?>">
										Login &amp; Security
									</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade <?php echo e($activeTab == 'profile' ? 'show active' : ''); ?>" id="myprofile"
									role="tabpanel" aria-labelledby="myprofile-tab">
									<form id="my_profile_form" name="my_profile_form" method="post"
										action="<?php echo e(url('user/update_profile')); ?>">
										<div class="form-group row">
											<div class="col-sm-6">
												<label class="label-profile">First Name</label>
												<input type="text" class="profile-control" placeholder="Enter First Name"
													value="<?php echo e(Auth::user()->firstname); ?>" name="firstname" required />
											</div>
											<div class="col-sm-6">
												<label class="label-profile">Last Name</label>
												<input type="text" class="profile-control" placeholder="Enter Last Name"
													value="<?php echo e(Auth::user()->lastname); ?>" name="lastname" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-6">
												<label class="label-profile">Email</label>
												<input type="text" class="profile-control" placeholder="Enter Email"
													value="<?php echo e(Auth::user()->email); ?>" name="email" required />
											</div>
											<div class="col-sm-6">
												<label class="label-profile">Mobile No.</label>
												<input type="text" class="profile-control" placeholder="Enter Mobile No."
													value="<?php echo e(Auth::user()->mobile_number); ?>" name="mobile_number" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-12">
												<label class="label-profile">Address</label>
												<input type="text" class="profile-control" placeholder="Enter Address"
													value="<?php echo e(Auth::user()->address); ?>" name="address" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-6">
												<label class="label-profile">State</label>
												<select class="profile-control" id="state_id" name="state_id" required
													onchange="loadCities(this.value, 'populate_cities');">
													<?php if(count($states) < 1): ?>
														<option value="">No records found</option>
													<?php else: ?>
														<?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($v->id); ?>" <?php echo e($v->id == $user->state_id ? "selected" : ''); ?>><?php echo e($v->name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</select>
											</div>
											<div class="col-sm-6">
												<label class="label-profile">City</label>
												<select class="profile-control" id="populate_cities" name="city_id"
													required>
													<option value="">Select City</option>
													<option value="1"></option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="label-profile">Company Name</label>
												<input type="text" class="profile-control" placeholder="Enter Company Name"
													value="<?php echo e(Auth::user()->company_name); ?>" name="company_name" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-12 text-center">
												<button type="submit" class="btn btn-submit">Update Profile <i
														class="fas fa-chevron-circle-right"></i></button>
											</div>
										</div>
										<?php echo csrf_field(); ?>
									</form>
								</div>

								<div class="tab-pane fade <?php echo e($activeTab == 'security' ? 'show active' : ''); ?>"
									id="loginsecurity" role="tabpanel" aria-labelledby="loginsecurity-tab">
									<form id="security_form" name="security_form" method="post"
										action="<?php echo e(url('user/update_password')); ?>">
										<div class="form-group row">
											<div class="col-sm-6">
												<label class="label-profile">Old Password</label>
												<input type="password" class="profile-control" name="password"
													placeholder="Enter Old Password" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-6">
												<label class="label-profile">New Password</label>
												<input type="password" class="profile-control" id="new_password"
													name="new_password" placeholder="Enter New Password" required />
											</div>
											<div class="col-sm-6">
												<label class="label-profile">Re-Enter Password</label>
												<input type="password" class="profile-control" name="confirm_new_password"
													placeholder="Enter Re-enter Password" required />
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-12 text-center">
												<button type="submit" class="btn btn-submit">Update Security <i
														class="fas fa-chevron-circle-right"></i></button>
											</div>
										</div>
										<?php echo csrf_field(); ?>
									</form>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

	<script type="text/javascript">
		$(function () {
			// Load cities on page load
			loadCities($("#state_id").val(), 'populate_cities', function () {
				$("#populate_cities").val("<?php echo e($user->city_id); ?>");
			});

			// Handle tab change → update URL parameter (?tab=profile or ?tab=security)
			$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
				const targetId = $(e.target).attr('href').replace('#', '');
				const currentUrl = new URL(window.location.href);
				currentUrl.searchParams.set('tab', targetId);
				window.history.replaceState({}, '', currentUrl); // Update URL without reload
			});

			// Profile form validation
			$("#my_profile_form").validate({
				rules: {
					mobile_number: {
						minlength: 10,
						maxlength: 10
					}
				}
			});

			// AJAX for Security Form
			$("#security_form").submit(function (e) {
				e.preventDefault(); // prevent default form submission

				var form = $(this);
				var url = form.attr('action');
				var formData = form.serialize(); // collect form data

				$.ajax({
					url: url,
					type: 'POST',
					data: formData,
					beforeSend: function () {
						$(".btn-submit").attr('disabled', true);
					},
					success: function (response) {
						if (response.status === true) {
							swal("Success", response.message ?? "Password updated successfully!", "success");
							form[0].reset(); // reset form fields
						} else {
							swal("Error", response.message ?? "Something went wrong!", "error");
						}
					},
					error: function (xhr) {
						// Show exact validation errors
						var res = xhr.responseJSON;
						if (res && res.errors) {
							let messages = [];
							for (let field in res.errors) {
								messages.push(res.errors[field].join(', '));
							}
							swal("Validation Error", messages.join("\n"), "error");
						} else if (res && res.message) {
							swal("Error", res.message, "error");
						} else {
							swal("Error", "Something went wrong while updating password.", "error");
						}
					},
					complete: function () {
						$(".btn-submit").attr('disabled', false);
					}
				});
			});
		});

		function loadCities(state_id, element_id, callback = null) {
			if (!state_id) return;

			var route = "<?php echo e(config('app.api_url')); ?>/cities_states/" + state_id;

			$.ajax({
				url: route,
				method: "GET",
				beforeSend: function () {
					$(".btn-submit").attr('disabled', true);
				},
				success: function (response) {
					if (response.status === true) {
						var cities = response.data.Cities;
						const select = $(`#${element_id}`);
						select.empty();

						if (cities.length > 0) {
							$.each(cities, function (x, y) {
								select.append(`<option value="${y.id}">${y.name}</option>`);
							});
						} else {
							select.append(`<option value="">No records found</option>`);
						}

						if (callback) callback();
					}
				},
				error: function () {
					toastr.error('An error occurred');
				},
				complete: function () {
					$(".btn-submit").attr('disabled', false);
				}
			});
		}
	</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/profile.blade.php ENDPATH**/ ?>