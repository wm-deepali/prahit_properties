
<!--<style>-->
<!--.sidebar-section {-->
<!--    position: sticky;-->
<!--    top: 0;-->
<!--    height: 100vh;-->
<!--    overflow-y: auto;-->
<!--    background-color: #f8f9fa;-->
<!--    padding: 15px;-->
<!--}-->
<!--.sidebar-menu .nav-link {-->
<!--    color: #333;-->
<!--    padding: 10px 15px;-->
<!--}-->
<!--.sidebar-menu .nav-link:hover,-->
<!--.sidebar-menu .nav-link.active {-->
<!--    background-color: #007bff;-->
<!--    color: #fff;-->
<!--    border-radius: 5px;-->
<!--}-->
<!--.sidebar-menu .collapse ul {-->
<!--    padding-left: 20px;-->
<!--}-->
<!--.sidebar-menu .collapse .nav-link {-->
<!--    padding: 5px 15px;-->
<!--    font-size: 0.9rem;-->
<!--}-->
<!--</style>-->
<section class="sidebar-section">
    <div class="row">
        <div class="profile-section">
            <div class="profile-image">
                <div class="pro-user">
                @php
                    $avatar = "";

                    if(!file_exists(Auth::user()->avatar)) {
                        $avatar = asset('images/usr.png');
                    } else {
                        $avatar = url(Auth::user()->avatar);
                    }
                @endphp

                <img src="{{$avatar}}" alt="Profile Picture" id="change_avatar" class="img-fluid">
                <form id="avatar-form" name="avatar-form" enctype="multipart/form-data">
                  <div class="p-image">
                      <i class="fas fa-pencil-alt upload-button" id="buttonid"></i>
                      <input class="file-upload" type="file" id="fileid" name="avatar_file" accept="image/*" onchange="previewImage(this)" style="display: none;">
                  </div>
                </form>
              </div>
            </div>
            <div class="user-info d-flex flex-column">
                <p style="font-weight:600;"> {{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                <p>{{Auth::user()->email}} @if(\Auth::user()->is_verified == 1) <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a> @else <a style="cursor: pointer;" onclick="verifyEmail()" class="verify-btn-s"> <img src="{{ asset('images') }}/verify.png" alt="verified" width="15px;" ></a> @endif</p>
                <p>{{Auth::user()->mobile_number}} @if(\Auth::user()->mobile_verified == 1) <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a> @else <a style="cursor: pointer;" onclick="verifyMobileNumber()" class="verify-btn-s"> <img src="{{ asset('images') }}/verify.png" width="15px;" alt="verified" ></a> @endif</p>
                
            </div>
            
        </div>
        <div class="col-sm-12 d-flex ">
            {{-- <div class="pro-user">
                @php
                    $avatar = "";

                    if(!file_exists(Auth::user()->avatar)) {
                        $avatar = asset('images/usr.png');
                    } else {
                        $avatar = url(Auth::user()->avatar);
                    }
                @endphp

                <img src="{{$avatar}}" alt="Profile Picture" id="change_avatar" class="img-fluid">
                <form id="avatar-form" name="avatar-form" enctype="multipart/form-data">
                  <div class="p-image">
                      <i class="fas fa-pencil-alt upload-button" id="buttonid"></i>
                      <input class="file-upload" type="file" id="fileid" name="avatar_file" accept="image/*" onchange="previewImage(this)" style="display: none;">
                  </div>
                </form>
              </div> --}}
             {{-- <div class="p-details">
                <div class="other-st-detail">
                    <ul>
                        <li>
                            <label>Name</label>
                            <span>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
                        </li>
                        <li>
                            <label>Email</label>
                            <span>{{Auth::user()->email}} @if(\Auth::user()->is_verified == 1) <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a> @else <a style="cursor: pointer;" onclick="verifyEmail()" class="verify-btn-s">Verify</a> @endif</span>
                        </li>
                        <li>
                            <label>Mobile</label>
                            <span>{{Auth::user()->mobile_number}} @if(\Auth::user()->mobile_verified == 1) <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a> @else <a style="cursor: pointer;" onclick="verifyMobileNumber()" class="verify-btn-s">Verify</a> @endif</span>
                        </li>
                    </ul>
                </div>
            </div>--}}
        </div>
        <div class="col-sm-12 mt-3">
            <div class="sidebar-menu">
                <nav class="navbar navbar-expand-lg navbar-sd-sidebar">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSidebar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-mob"><i class="fas fa-bars"></i></span>
                    </button>
                    
                    <div class="collapse navbar-collapse nav-side" id="navbarSidebar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{url('user/dashboard')}}" class="nav-link active">Dashboard <span class="sr-only">(current)</span></a>
                            </li>
                            <!-- Setting Menu -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#settingMenu" aria-expanded="false" aria-controls="settingMenu">Setting</a>
                                <div class="collapse" id="settingMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="{{url('user/profile')}}" class="nav-link">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/change-password')}}" class="nav-link">Change Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/my-activities')}}" class="nav-link">My Activities</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Property Menu -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#propertyMenu" aria-expanded="false" aria-controls="propertyMenu">Property</a>
                                <div class="collapse" id="propertyMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="{{url('user/properties')}}" class="nav-link">My Properties</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/all-inquiries')}}" class="nav-link">All Inquiries</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/my-wishlist')}}" class="nav-link">My Wishlist</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Price & Subscriptions Menu -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#priceMenu" aria-expanded="false" aria-controls="priceMenu">Price & Subscriptions</a>
                                <div class="collapse" id="priceMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="{{url('user/current-subscriptions')}}" class="nav-link">Current Subscriptions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/payments-invoice')}}" class="nav-link">Payments & Invoice</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('user/pricing')}}" class="nav-link">Pricing</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('user/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="email-verify" tabindex="-1" role="dialog" aria-labelledby="email-verify" aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="top-design">
                    <img src="{{asset('images/top-designs.png/')}}" class="img-fluid">
                </div>
                <form action="{{ url('user/email-mobile/verify/otp') }}?type=email" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-main">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">Email Verification</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            @if(session()->has('otp-success'))
                                <div class="alert alert-success">
                                    {{ session()->get('otp-success') }}
                                </div>
                            @endif
                            <div class="modal-form">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label-control">Enter OTP</label>
                                        <input type="number" name="otp" class="text-control" placeholder="Enter OTP" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Verify Now <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="mob-verify" tabindex="-1" role="dialog" aria-labelledby="mob-verify" aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="top-design">
                    <img src="{{asset('images/top-designs.png/')}}" class="img-fluid">
                </div>
                <form action="{{ url('user/email-mobile/verify/otp') }}?type=mobile" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-main">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">Mobile No. Verification</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <div class="modal-form">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label-control">Enter OTP</label>
                                        <input type="number" name="otp" class="text-control" placeholder="Enter OTP" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Verify Now <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function verifyEmail() {
        swal({
            title: "Are you sure?",
            text: "Verify This Email.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              $(".loading_2").css('display', 'block');
              $(".btn-delete").attr('disabled', true);
              $.ajax({
                url: '{{ url('user/verify/email') }}',
                method: "GET",
                success: function(response) {
                  toastr.success(response)
                   $('#email-verify').modal('show');
                },
                error: function(response) {
                  toastr.error('An error occured.')
                },
                complete: function() {
                  $(".loading_2").css('display', 'none');
                  $(".btn-delete").attr('disabled', false);
                }
              })
          }
        });
    }

    function verifyMobileNumber() {
        swal({
            title: "Are you sure?",
            text: "Verify This Mobile Number.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              $(".loading_2").css('display', 'block');
              $(".btn-delete").attr('disabled', true);
              $.ajax({
                url: '{{ url('user/verify/mobile') }}',
                method: "GET",
                success: function(response) {
                  toastr.success(response)
                   $('#mob-verify').modal('show');
                },
                error: function(response) {
                  toastr.error('An error occured.')
                },
                complete: function() {
                  $(".loading_2").css('display', 'none');
                  $(".btn-delete").attr('disabled', false);
                }
              })
          }
        });
    }
</script>

