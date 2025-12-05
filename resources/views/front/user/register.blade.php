@extends('layouts.front.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4 shadow">
                    <h3 class="mb-3">Register Now</h3>
                    <form id="register_form" method="POST">
                        @csrf

                        <!-- Ownership Type -->
                        <div class="mb-3">
                            <label class="form-label">Ownership Type</label>
                            <div>
                                <label><input type="radio" name="owner_type" value="1" checked> Owner</label>
                                <label class="ms-3"><input type="radio" name="owner_type" value="2"> Builder</label>
                                <label class="ms-3"><input type="radio" name="owner_type" value="3"> Agent</label>
                                <label class="ms-3"><input type="radio" name="owner_type" value="4"> Service
                                    Provider</label>
                            </div>
                        </div>

                        <!-- Name Fields -->
                        <div class="row mb-3">
                            <div class="col">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control" required>
                            </div>
                        </div>

                        <!-- Email & Mobile -->
                        <div class="row mb-3">
                            <div class="col">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Mobile No.</label>
                                <input type="number" name="mobile_number" class="form-control" required>
                            </div>
                        </div>

                        <!-- State & City -->
                        <div class="row mb-3">
                            <div class="col">
                                <label>State</label>
                                <select class="form-control" name="state_id"
                                    onchange="loadCities(this.value, 'register_city_id');" required>
                                    @php
                                        $states = \App\State::where('country_id', 101)->get();
                                    @endphp
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>City</label>
                                <select class="form-control" id="register_city_id" name="city_id" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <div class="col">
                                <label>Password</label>
                                <input type="password" id="reg_password" name="password" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="register_button btn btn-primary w-100" style="cursor:pointer;">Proceed to OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        function loadCities(state_id, element_id) {
            // if(empty(state_id)) return true;

            var route = "{{config('app.api_url')}}/cities_states/" + state_id;
            $.ajax({
                url: route,
                method: "GET",
                beforeSend: function () {
                    $(".loading_3").css('display', 'block');
                    $(".btn-postproperty").attr('disabled', true);
                },
                success: function (response) {
                    // console.log(response);
                    // var response = JSON.parse(response);
                    if (response.status == true) {
                        var cities = response.data.Cities;
                        console.log(cities);
                        if (cities.length > 0) {
                            $(`#${element_id}`).empty();
                            $.each(cities, function (x, y) {
                                $(`#${element_id}`).append(
                                    `<option value=${y.id}>${y.name}</option>`
                                );
                            });
                        } else {
                            $(`#${element_id}`).append(
                                `<option value=''>No records found</option>`
                            );
                        }
                    }
                },
                error: function () {
                    toastr.error('An error occured')
                },
                complete: function () {
                    $(".loading_3").css('display', 'none');
                    $(".btn-postproperty").attr('disabled', false);
                }
            });

        }


        $("#register_form").validate({
            rules: {
                password: { required: true, minlength: 8 },
                confirm_password: { required: true, equalTo: "#reg_password", minlength: 8 },
                mobile_number: { required: true, digits: true, minlength: 10, maxlength: 10 }
            },
            submitHandler: function () {
                $.ajax({
                    url: "{{ route('register_ajax')}}",
                    method: "POST",
                    data: $("#register_form").serialize(),

                    beforeSend: function () {
                        // Disable button & change cursor
                        $(".register_button").attr("disabled", true)
                            .css("cursor", "not-allowed")
                            .text("Please wait...");
                    },

                    success: function (response) {
                        if (response.status) {
                            let redirectUrl = "{{ request()->query('redirect', '/user/dashboard') }}";
                            window.location.href = "/user/otp?user_id=" + response.data.id + "&redirect=" + redirectUrl;
                        } else {
                            toastr.error(response.message);
                        }
                    },

                    error: function (xhr) {
                        if (xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function (key, val) {
                                toastr.error(val[0]);
                            });
                        } else {
                            toastr.error('An error occurred');
                        }
                    },

                    complete: function () {
                        // Enable button back & restore cursor
                        $(".register_button").attr("disabled", false)
                            .css("cursor", "pointer")
                            .text("Proceed to OTP");
                    }
                });
            }
            });
    </script>
@endsection