<section class="sidebar-section">
    <div class="row">
        <div class="col-sm-12">
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
              <div class="p-details">
                <h4>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4>
               </div>
        </div>
        <div class="col-sm-12">
			<div class="sidebar-menu">
			    <nav class="navbar navbar-expand-lg navbar-sd-sidebar">
			        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSidebar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			            <span class="navbar-mob"><i class="fas fa-bars"></i></span>
			        </button>
			        
			        <div class="collapse navbar-collapse nav-side" id="navbarSidebar">
			            <ul class="navbar-nav">
			                <li class="nav-item">
			                    <a href="{{url('agent/dashboard')}}" class="nav-link active">Dashboard <span class="sr-only">(current)</span></a>
			                </li>
			                <li class="nav-item">
			                    <a href="{{url('agent/profile')}}" class="nav-link">Profile Settings</a>
			                </li>
							<li class="nav-item">
			                    <a href="{{url('agent/properties')}}" class="nav-link">My Properties</a>
			                </li>
			                <li class="nav-item">
			                    <a href="{{route('create_property')}}" class="nav-link">Submit New Property</a>
			                </li>
							
			                <li class="nav-item">
                                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ url('agent/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>

			                </li>
			            </ul>
			        </div>
			    </nav>
			</div>
        </div>
        <div class="col-sm-12">
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
                <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
                </p>
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
                <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
                </p>
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