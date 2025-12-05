@extends('layouts.front.app')

@section('content')
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
            min-height: 450px;
            position: relative;
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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            z-index: 2;
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
            margin-top: 10px;
            cursor: pointer;
            /* 👈 add this */
        }

        .back-login {
            cursor: pointer;
            color: #ff6600;
        }
    </style>

    <div class="login-wrapper">
        <div class="row g-0">

            <!-- LEFT SIDE -->
            <div class="col-lg-6 login-left">
                <div class="left-content">
                    <h2>Reset Password</h2>
                    <p>Don't worry, it happens! <br> Reset your password securely using OTP.</p>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-6 p-4">

                <h3 class="mb-1">Forgot Password</h3>
                <small>All fields are required</small>

                <form id="forgot_form">
                    @csrf

                    <!-- STEP 1 -->
                    <div id="step_1" class="mt-3">
                        <label>Registered Mobile No.</label>
                        <input type="text" name="mobile_number" class="text-control" required
                            placeholder="Enter Mobile Number">
                        <button type="button" class="btn-send" onclick="sendForgotOtp()">Send OTP</button>
                    </div>

                    <!-- STEP 2 -->
                    <div id="step_2" style="display:none;" class="mt-3">

                        <label>Enter OTP</label>
                        <input type="number" name="otp" class="text-control" required placeholder="Enter OTP">

                        <label class="mt-2">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="text-control" required>

                        <label class="mt-2">Confirm Password</label>
                        <input type="password" name="confirm_password" class="text-control" equalTo="#new_password"
                            required>

                        <input type="hidden" name="user_id" id="user_id">

                        <button type="submit" class="btn-send">Reset Password</button>
                    </div>

                    <!-- BACK TO LOGIN -->
                    <div class="text-center mt-3">
                        <a href="{{ route('user.login') }}" class="back-login">← Back to Login</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function sendForgotOtp() {
            let btn = $(".btn-send");

            btn.prop("disabled", true).text("Please wait...");

            $.ajax({
                url: "{{ route('forgot.password.sendOtp') }}",
                method: "POST",
                data: $("#forgot_form").serialize(),
                success: function (res) {
                    if (res.status == 200 || res.status === true) {
                        toastr.success(res.message);
                        $("#user_id").val(res.user_id);
                        $("#step_1").hide();
                        $("#step_2").show();
                    } else {
                        toastr.error(res.message);
                        btn.prop("disabled", false).text("Send OTP"); // enable again only on error
                    }
                },
                error: function () {
                    var response = JSON.parse(xhr.responseText);
                    response.message ? toastr.error(response.message) : toastr.error('An error occured');
                    btn.prop("disabled", false).text("Send OTP"); // enable again only on error
                }
            });
        }


        $("#forgot_form").validate({
            rules: {
                new_password: { minlength: 8 },
                confirm_password: { equalTo: "#new_password" }
            },
            submitHandler: function () {

                let submitBtn = $("#step_2 .btn-send"); // button of step 2 only
                submitBtn.prop("disabled", true).text("Please wait...");

                $.ajax({
                    url: "{{ route('verify_otp_ajax') }}",
                    method: "POST",
                    data: $("#forgot_form").serialize(),
                    success: function (res) {
                        if (res.status == true) {
                            toastr.success(res.message);
                            window.location.href = "/user/login";
                        } else {
                            toastr.error(res.message);
                            submitBtn.prop("disabled", false).text("Reset Password");
                        }
                    },
                    error: function (xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        response.message ? toastr.error(response.message) : toastr.error('An error occured');
                        submitBtn.prop("disabled", false).text("Reset Password");
                    }
                })
            }
        });
    </script>
@endsection