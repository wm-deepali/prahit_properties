@extends('layouts.front.app')
<style>
    button[type="submit"] {
        cursor: pointer !important;
    }
</style>
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card p-4 shadow">
                    <h3 class="mb-3">OTP Verification</h3>
                    <form id="otp_form" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}">
                        <div class="mb-3">
                            <label>Enter OTP</label>
                            <input type="number" id="otp" name="otp" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $("#otp_form").validate({
            submitHandler: function () {

                let btn = $("#otp_form button[type='submit']");
                btn.prop("disabled", true).text("Please wait...");

                $.ajax({
                    url: "{{ route('verify_otp_ajax') }}",
                    method: "POST",
                    data: {
                        _token: $('input[name="_token"]').val(),
                        otp: $("#otp").val(),
                        user_id: $("input[name='user_id']").val(),
                        is_register: true
                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.message);

                            // Redirect after OTP verification
                            let redirectUrl = "{{ request()->query('redirect', '/user/dashboard') }}";
                            window.location.href = redirectUrl;
                        } else {
                            toastr.error(response.message);
                            $("#otp_form").trigger('reset');
                            btn.prop("disabled", false).text("Verify OTP"); // enable back on error
                        }
                    },
                    error: function (xhr) {
                        var response = JSON.parse(xhr.responseText);
                        response.message ? toastr.error(response.message) : toastr.error('An error occured')
                        btn.prop("disabled", false).text("Verify OTP"); // enable back on error
                    }
                });
            }
        });

    </script>
@endsection