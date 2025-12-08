
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php $__env->startSection('content'); ?>

    <style>
        .login-wrapper {
            max-width: 950px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            background-image: url('https://img.freepik.com/free-photo/construction-concept-with-engineering-tools_1150-17809.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 450px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .left-content {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            padding: 20px;
        }

        .google-signin {
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            cursor: pointer;
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .google-signin:hover {
            background: #f6f6f6;
        }

        .text-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-send {
            background: #ff6600;
            color: #fff;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
    </style>

    <div class="login-wrapper">
        <div class="row g-0">

            <!-- LEFT SIDE -->
            <div class="col-lg-6 login-left">
                <div class="left-content">
                    <h2>Bhawan Bhoomi</h2>
                    <p>Helping you find the best properties across India.<br>Experience a joyful journey.</p>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-6 p-4">

                <h3 class="mb-1">Login</h3>
                <small>All fields are required</small>

                <!-- Google Login -->
                <!--<div class="google-signin my-3">-->
                <!--    <img src="<?php echo e(asset('images/google.png')); ?>" height="22">-->
                <!--    <p class="m-0">Sign in with Google</p>-->
                <!--</div>-->

                <!--<div class="devide-or d-flex align-items-center my-3">-->
                <!--    <div class="flex-grow-1 border-top"></div>-->
                <!--    <div class="px-2">OR</div>-->
                <!--    <div class="flex-grow-1 border-top"></div>-->
                <!--</div>-->

                <!-- LOGIN FORM -->
                <form id="login_form" class="my-3">

                    <?php echo csrf_field(); ?>

                    <label>Email / Mobile No.</label>
                    <input type="text" name="email" id="login-email" class="text-control"
                        placeholder="Enter Email / Mobile No." required>

                    <div class="d-flex justify-content-end">
                        <a onclick="loginType('otp')" id="login-type-otp" style="cursor:pointer;">Login with OTP</a>
                        <a onclick="loginType('password')" id="login-type-password" style="cursor:pointer; display:none;"
                            class="ms-3">Login with Password</a>
                    </div>

                    <!-- PASSWORD -->
                    <div id="view-password" class="mt-3">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="text-control" required>
                        <a href="<?php echo e(route('forgot.password')); ?>">Forgot Password?</a>
                    </div>

                    <!-- OTP -->
                    <div id="view-otp" class="mt-3" style="display:none;">
                        <label>OTP</label>
                        <input type="number" name="otp" id="otp" class="text-control" placeholder="Enter OTP">
                    </div>

                    <!-- LOGIN BUTTON -->
                    <div id="check-login" class="mt-4 text-center">
                        <button type="submit" class="btn-send">Login</button>
                    </div>

                    <!-- SEND OTP BUTTON -->
                    <div id="check-otp" class="mt-4 text-center" style="display:none;">
                        <button type="button" onclick="sendLoginOtp()" class="btn-send">Send OTP</button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="<?php echo e(route('user.register')); ?>">Create Account</a></p>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function loginType(type) {
            if (type === "otp") {
                $('#view-password').hide();
                $('#check-login').hide();
                $('#view-otp').hide();        // hide otp input at first
                $('#check-otp').show();       // show SEND OTP button only

                $('#login-type-otp').hide();
                $('#login-type-password').show();
            } else {
                $('#view-password').show();
                $('#check-login').show();
                $('#view-otp').hide();
                $('#check-otp').hide();

                $('#login-type-otp').show();
                $('#login-type-password').hide();
            }
        }

        function sendLoginOtp() {
            var email = $('#login-email').val();
            if (email === '') {
                Swal.fire('', 'Email or mobile number is required', 'warning');
                return;
            }

            $.ajax({
                url: '<?php echo e(url('login/send/otp')); ?>',
                method: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    email: email
                },
                beforeSend: function () {
                    $(".btn-send").attr('disabled', true);
                },
                success: function (data) {
                    if (data.status == 200) {
                        Swal.fire('', data.msg, 'success');

                        // After OTP sent → show OTP input + Login button
                        $('#view-otp').show();
                        $('#check-login').show();

                        // hide Send OTP button
                        $('#check-otp').hide();
                    } else {
                        Swal.fire('', data.msg, 'warning');
                    }
                },
                complete: function () {
                    $(".btn-send").attr('disabled', false);
                }
            });
        }

        $("#login_form").validate({
            submitHandler: function () {
                $.ajax({
                    url: "<?php echo e(route('login_ajax')); ?>",
                    method: "POST",
                    data: $("#login_form").serialize(),
                    beforeSend: function () {
                        $(".btn-send").attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.message);

                            let redirectAfterLogin = "<?php echo e($redirectUrl); ?>";
                            if (redirectAfterLogin) {
                                window.location.href = redirectAfterLogin;
                            } else {
                                window.location.href = '/user/dashboard';
                            }
                        } else if (response.status === 400) {
                            toastr.error(response.message)
                            $("#login_form #password").val('');
                        }
                    },  // ← this comma was missing 👈

                    error: function (xhr) {
                        var response = JSON.parse(xhr.responseText);
                        response.message ? toastr.error(response.message) : toastr.error('An error occured')
                    },
                    complete: function () {
                        $(".btn-send").attr('disabled', false);
                    }

                })
            }
        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/login.blade.php ENDPATH**/ ?>