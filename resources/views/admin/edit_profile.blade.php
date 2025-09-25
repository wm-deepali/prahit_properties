@extends('layouts.app')

@section('title')
Edit Profile
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">My Account</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">My Account</li>
                        <li class="breadcrumb-item active">Update Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-main-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form id="edit_profile_form" name="edit_profile_form" class="form-body" method="post" action="{{route('admin.update_edit_profile')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Profile</h4>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <img src="{{url('/').'/'.Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="img-fluid img-stud-pro">
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="file" name="avatar_file" class="text-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="label label-control">First Name</label>
                                                <input type="text" class="text-control" name="firstname" placeholder="Enter First Name" value="{{Auth::user()->firstname}}"  />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label label-control">Last Name</label>
                                                <input type="text" class="text-control" name="lastname" placeholder="Enter Last Name" value="{{Auth::user()->lastname}}"  />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="label label-control">Company Name</label>
                                                <input type="text" class="text-control" name="company_name" placeholder="Enter Company Name" value="{{ Auth::user()->company_name }}"  />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="label label-control">Email</label>
                                                <input type="text" class="text-control" name="email" value="{{Auth::user()->email}}" placeholder="Enter Email"  />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label label-control">Mobile No.</label>
                                                <input type="number" class="text-control" name="mobile_number" value="{{Auth::user()->mobile_number}}" placeholder="Enter Mobile No."  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Profile</button>
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-body">														
                                <form id="edit_security_form" name="edit_security_form" method="post" action="{{route('admin.update_password')}}">

                                    <h4 class="form-section-h">Login Security</h4>

    <!--                                 <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Login ID <span class="required">*</span></label>
                                            <input type="text" class="text-control" placeholder="Enter Login ID">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">New Password <span class="required">*</span></label>
                                            <input type="password" name="password" class="text-control" placeholder="Enter New Password" required />
                                            <span>Leave Blank if you don't want to change.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Re-enter Password <span class="required">*</span></label>
                                            <input type="password" name="new_password" class="text-control" placeholder="Re-enter Password" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn-w100 btn btn-dark">Update Changes</button>
                                        </div>
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')

<script type="text/javascript">
$(function() {
    $("#edit_profile_form").validate();
    $("#edit_security_form").validate();
});
</script>

@endsection