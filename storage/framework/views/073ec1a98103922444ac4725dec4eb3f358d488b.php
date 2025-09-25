<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldContent('title'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php echo e(csrf_field()); ?>

    <?php echo $__env->make('layouts.front.app_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style type="text/css">
        .modal_loading {
            height: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div class="top-bar">

            <div class="container"> 
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                            </button>
                        
                            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('images/logo.png')); ?>" class="img-fluid"></a>

                            <div class="location-navigate">
                                <a href="javascript:void(0)" data-toggle="modal" onclick="viewMoreCities()"><i class="fas fa-map-marker-alt"></i> <?php echo e(Cache::get('location-name')); ?></a>
                            </div>

                            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                <?php
                                    $categories = App\Category::limit(5)->get();
                                ?>
                                <ul class="navbar-nav m-auto mt-2 mt-lg-0">
                                    <?php if(count($categories) > 0): ?>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>/<?php echo e(Cache::get('location-name') ? Cache::get('location-name') : ''); ?>?category=<?php echo e(encrypt($category->id)); ?>"><?php echo e($category->category_name); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="form-inline my-2 my-lg-0">
                                    <ul class="side-btn">
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(\Auth::user()->role == 'owner'): ?>
                                                <li><a href="<?php echo e(url('user/dashboard')); ?>"><i class="far fa-user"></i> <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></a></li>
                                            <?php elseif(\Auth::user()->role == 'builder'): ?>
                                                <li><a href="<?php echo e(url('builder/dashboard')); ?>"><i class="far fa-user"></i> <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></a></li>
                                            <?php elseif(\Auth::user()->role == 'agent'): ?>
                                                <li><a href="<?php echo e(url('agent/dashboard')); ?>"><i class="far fa-user"></i> <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></a></li>
                                            <?php endif; ?>
                                            
                                        <?php endif; ?>
                                        <?php if(auth()->guard()->guest()): ?>
                                        <li><a href="#" data-target="#signin" data-toggle="modal"><i class="far fa-user"></i> Sign In</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo e(route('create_property')); ?>"><i class="fas fa-pencil-alt"></i> Post Property <span>FREE</span></a></li>

                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- <?php if(session('success')): ?>
      <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> <?php echo e(session('success')); ?> </strong>
      </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
      <div class="alert alert-danger alert-dismissable custom-danger-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> <?php echo e(session('error')); ?> </strong>
      </div>
    <?php endif; ?> -->
    
    <?php if(count($errors) > 0 ): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>


<div class="modal fade custom-modal" id="contact-agent" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
    <div class="modal-dialog w-450" role="document">
        <div class="modal-content">
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        
            <div class="top-design">
                <img src="<?php echo e(asset('images/top-designs.png/')); ?>" class="img-fluid">
            </div>

            <center class="loading">
                <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </center>

            <div class="modal-body">
                <div class="modal-main">
                    <div class="row login-heads">
                        <div class="col-sm-12">
                            <h3 class="heads-login">Contact Agent</h3>
                            <span class="allrequired">All field are required</span>
                        </div>
                    </div>
                    <div class="modal-form">
                        <form id="contact_agent_form_modal" name="contact_agent_form_modal">

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="label-control">Name</label>
                                    <input type="text" class="text-control" placeholder="Enter Name" name="name" value="<?php echo e(Auth::check() ? Auth::user()->firstname : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> required />
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="label-control">Email</label>
                                    <input type="email" class="text-control" placeholder="Enter Email" name="email" value="<?php echo e(Auth::check() ? Auth::user()->email : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> required />
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="label-control">Mobile No.</label>
                                    <input type="number" class="text-control" placeholder="Enter Mobile No." name="mobile_number" value="<?php echo e(Auth::check() ? Auth::user()->mobile_number : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?> required />
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="label-control">Interested In</label>
                                    <select class="text-control" name="interested_in" required>
                                        <option value=""> Select </option>
                                        <option value="1">Site Visit</option>
                                        <option value="2">Immediate Purchase</option>
                                        <option value="3">Home Loan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-send w-100">Send Enquiry <i class="fas fa-chevron-circle-right"></i></button>
                                </div>
                            </div>
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-foo text-center">
                <p>By sending a request, you accept our Terms of Use and Privacy Policy</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="claim-listing" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
    <div class="modal-dialog w-450" role="document">
        <div class="modal-content">
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        
            <div class="top-design">
                <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
            </div>

            <center class="loading">
                <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </center>

            <div class="modal-body">
                <div class="modal-main">
                    <div class="row login-heads">
                        <div class="col-sm-12">
                            <h3 class="heads-login">Claim Listing</h3>
                            <span class="allrequired">All field are required</span>
                        </div>
                    </div>
                    <div class="modal-form">
                        <input type="hidden" name="p_id" id="p_id">
                        <div class="claim-listin-tab">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                 <a class="nav-link active" id="verifybyemail-tab" data-toggle="tab" href="#verifybyemail" role="tab" aria-controls="verifybyemail" aria-selected="true" onclick="resetField('email')">Verify with Email</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="verifybycontact-tab" data-toggle="tab" href="#verifybycontact" role="tab" aria-controls="verifybycontact" aria-selected="false" onclick="resetField('mobile')">Verify with Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="verifybyemail" role="tabpanel" aria-labelledby="verifybyemail-tab">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="label-control mask_email"> </label>
                                                <input type="email" id="verify_by_email" class="text-control" placeholder="Enter Email for Verify" name="email" required />
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="verifybycontact" role="tabpanel" aria-labelledby="verifybycontact-tab">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="label-control mask_number">Mobile No. (87xxxxxxxx)</label>

                                                <input type="number" id="verify_by_phone" class="text-control" placeholder="Enter Mobile No. for Verify" name="mobile_number" required />

                                            </div>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="btn btn-send w-100 claim_listing_btn" onclick="claimListing();">Send OTP <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foo text-center">
                <p>By sending a request, you accept our Terms of Use and Privacy Policy</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="verifyemail" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
    <div class="modal-dialog w-450" role="document">
        <div class="modal-content">
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        
            <div class="top-design">
                <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
            </div>

            <center class="loading">
                <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" />
            </center>

            <div class="modal-body">
                <div class="modal-main">
                    <div class="row login-heads">
                        <div class="col-sm-12">
                            <h3 class="heads-login">OTP Verification</h3>
                            <span class="allrequired">All field are required</span>
                        </div>
                    </div>
                    <div class="modal-form">
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-12">
                                <label class="label-control">Enter OTP</label>
                                <input type="number" id="verify_otp" class="text-control" name="otp" placeholder="Enter OTP" required />
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-send w-100 claim_listing_btn" onclick="verifyOTPForClaim();">Claim Your Listing <i class="fas fa-chevron-circle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foo text-center">
                <p>Not Received? <a style="cursor: pointer;" onclick="resendOTP()">Resend OTP</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="signin" tabindex="-1" role="dialog" aria-labelledby="signin" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        


            <div class="top-design">
                <img src="<?php echo e(asset('')); ?>images/top-designs.png" class="img-fluid">
            </div>
            <div class="modal-body">
                <div class="modal-main">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="custom-mode-l">
                                <a href="#">
                                    <h3>ParhitProperty</h3>
                                </a>

                                <img src="<?php echo e(asset('')); ?>images/house.png" class="img-fluid">

                                <p>Find the best matches for you<br/> Make the most of high seller scores<br/>Experience a joyful journey</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">Login</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <center class="modal_loading">
                                <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" style="height: 30px;" />
                            </center>
                            <div class="modal-form">
                                <form id="login_form" name="login_form">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Email / Mobile No.</label>
                                            <input type="text" class="text-control" placeholder="Enter Email / Mobile No." name="email" id="login-email" required />
                                            <span class="loginwotp" id="login-type-otp"><a style="cursor: pointer;" onclick="loginType('otp')">Login with OTP</a></span>
                                            <span class="loginwotp" id="login-type-password"><a style="cursor: pointer;" onclick="loginType('password')">Login with Password</a></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12" id="view-password">
                                            <label class="label-control">Password</label>
                                            <input type="password" class="text-control" placeholder="Enter Password" id="password" name="password" required />
                                            <a href="#" data-target="#forgot-password" data-toggle="modal" data-dismiss="modal" class="forgotpass">Forgot Password ?</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12" id="view-otp">
                                            <label class="label-control">OTP</label>
                                            <input type="number" class="text-control" placeholder="Enter OTP" id="otp" name="otp" required />
                                            <a href="#" data-target="#forgot-password" data-toggle="modal" data-dismiss="modal" class="forgotpass">Forgot Password ?</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center" id="check-login">
                                            <button type="submit" class="btn btn-send w-100">Login <i class="fas fa-chevron-circle-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center" id="check-otp">
                                            <button type="button" class="btn btn-send w-100" onclick="sendLoginOtp()">Send OTP <i class="fas fa-chevron-circle-right"></i></button>
                                        </div>
                                    </div>
                                    <?php echo csrf_field(); ?>
                                </form>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <span class="or-span">OR</span>
                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <a href="<?php echo e(url('login')); ?>/facebook">
                                            <img src="<?php echo e(asset('')); ?>images/loginwithfb.png" class="img-fluid">
                                        </a>
                                    

                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <a href="<?php echo e(url('login')); ?>/google">
                                            <img src="<?php echo e(asset('')); ?>images/loginwithg.png" class="img-fluid">
                                        </a>
                                    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foo text-center">
                <p>Don't have account? <a href="#" data-target="#register" data-toggle="modal" data-dismiss="modal">Create an Account</a>
                </p>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade custom-modal" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="signin" aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            
                <div class="top-design">
                    <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
                </div>
                <div class="modal-body">
                    <div class="modal-main">
                        <center class="modal_loading">
                            <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="modal_loading" />
                        </center>
                        <div class="row login-heads">
                            <div class="col-sm-12">
                                <h3 class="heads-login">Reset Your Password</h3>
                                <span class="allrequired">All field are required</span>
                            </div>
                        </div>
                        <div class="modal-form">
                            <form id="forgot_password_form" name="forgot_password_form">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label-control">Registered Mobile No.</label>
                                        <input type="number" class="text-control" placeholder="Enter Registered Mobile No." name="mobile_number" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Proceed to OTP <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-foo text-center">
                    <p>New User? <a href="#" data-target="#register" data-toggle="modal" data-dismiss="modal">Register Now</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="register" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    
            <div class="top-design">
                <img src="<?php echo e(asset('')); ?>images/top-designs.png" class="img-fluid">
            </div>
            <div class="modal-body">
                <div class="modal-main">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="custom-mode-l">
                                <a href="#">
                                    <h3>ParhitProperty</h3>
                                </a>
                            


                                <img src="<?php echo e(asset('')); ?>images/house.png" class="img-fluid">

                                <p>Find the best matches for you<br/> Make the most of high seller scores<br/>Experience a joyful journey</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">Register Now</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <div class="modal-form">
                                <form id="register_form" name="register_form">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Ownership Type</label>
                                            <ul class="ownertype">
                                                <li><label><input type="radio" checked name="owner_type" value="1"> Owner</label></li>
                                                <li><label><input type="radio" name="owner_type" value="2"> Builder</label></li>
                                                <li><label><input type="radio" name="owner_type" value="3"> Agent</label></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="label-control">First Name</label>
                                            <input type="text" class="text-control" placeholder="First Name" name="firstname" required/>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label-control">Last Name</label>
                                            <input type="text" class="text-control" placeholder="Last Name" name="lastname" required/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="label-control">Email</label>
                                            <input type="text" class="text-control" placeholder="Enter Email" name="email" required />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label-control">Mobile No.</label>
                                            <input type="number" class="text-control" placeholder="Enter Mobile No." name="mobile_number" required />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="label-control">State</label>
                                            <select class="text-control" name="state_id" onchange="loadCities(this.value, 'register_modal_city_id');" required>
                                                <?php
                                                    $states = \App\State::all();
                                                ?>
                                                <?php if(count($states) < 1): ?>
                                                    <option value="">No records found</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label-control">City</label>
                                            <select class="text-control" id="register_modal_city_id" name="city_id" required>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="label-control">Password</label>
                                            <input type="password" class="text-control" placeholder="Enter Password" id="reg_password" name="password" required />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label-control">Confirm Password</label>
                                            <input type="password" class="text-control" placeholder="Re-enter Password" name="confirm_password" required />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit"  class="btn btn-send w-100">Proceed to OTP <i class="fas fa-chevron-circle-right"></i></button>
                                        </div>
                                    </div>

                                    <?php echo csrf_field(); ?>
                                </form>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <span class="or-span">Create Account Using</span>
                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <a style="cursor: pointer;" onclick="faceBookSignup()">
                                            <img src="<?php echo e(asset('')); ?>images/loginwithfb.png" class="img-fluid">
                                        </a>
                                    

                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <a style="cursor: pointer;" onclick="googleSignup()">
                                            <img src="<?php echo e(asset('')); ?>images/loginwithg.png" class="img-fluid">
                                        </a>
                                    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foo text-center">
                <p>Already Registered? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Login Now</a>
                </p>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade custom-modal" id="otpmodal" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            
                <div class="top-design">
                    <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
                </div>
                <div class="modal-body">
                    <div class="modal-main">
                        <center class="modal_loading">
                            <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="modal_loading" />
                        </center>
                        <form id="otp_form" name="otp_form">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">OTP Verification</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <div class="modal-form">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label-control">Enter OTP</label>
                                        <input type="number" class="text-control" placeholder="Enter OTP" id="otp" name="otp" required />
                                    </div>
                                </div>

                                <input type="hidden" class="user_id" name="user_id" />

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Proceed to OTP <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="forgototp" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            
                <div class="top-design">
                    <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
                </div>
                <div class="modal-body">
                    <div class="modal-main">
                        <form id="verify_otp_password" name="verify_otp_password">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">OTP Verification</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <div class="modal-form">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label-control">Enter OTP</label>
                                        <input type="number" class="text-control" placeholder="Enter OTP" name="otp" required />
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label-control">New Password</label>
                                        <input type="password" class="text-control" placeholder="Enter New Password" id="new_password" name="new_password" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label-control">Re-Enter Password</label>
                                        <input type="password" class="text-control" placeholder="Re-enter Password" name="confirm_new_password" id="confirm_new_password" required />
                                    </div>
                                </div>

                                <input type="hidden" name="user_id" class="user_id" />

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Reset Password <i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend OTP</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="render-cities-modal"></div>

    <footer> 
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href="<?php echo e(route('front.about')); ?>">About Us</a></li>
                            <li><a href="<?php echo e(route('front.termCondition')); ?>">Terms & Conditions</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="<?php echo e(route('front.privecyPolicy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo e(route('front.safetyHealth')); ?>">Safety Health</a></li>
                            <li><a href="<?php echo e(route('front.summonsNotice')); ?>">Summons Notice</a></li>
                            <li><a href="<?php echo e(route('front.blog')); ?>">Blog</a></li>
                            <li><a href="<?php echo e(route('front.careerWithUs')); ?>">Career With Us</a></li>
                            <li><a href="<?php echo e(route('front.testimonial')); ?>">Testimonials</a></li>
                            <li><a href="<?php echo e(route('front.contactUs')); ?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $footer_content = App\FooterContent::where('slug', 'footer')->first();
        ?>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="foo-left">
                            <div class="foo-logo">
                                <a href="<?php echo e(route('home')); ?>">
                                    <img src="<?php echo e(asset('images/logo-foo.png')); ?>" class="img-fluid">
                                </a>
                            
                                <p><?php echo e($footer_content->title); ?></p>
                            </div>
                            <?php
                                $media         = App\SocialMedia::first();
                            ?>
                            <div class="foo-social-app">
                                <ul>
                                    <li><a href="<?php echo e($media->facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="<?php echo e($media->twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li><a href="<?php echo e($media->insta); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li><a href="<?php echo e($media->youtube); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="foo-right">
                            <div class="foo-left-inner">
                                <h3>Real Estate in India </h3>
                                <ul>
                                    <li><a href="#">Property in Navi Mumbai</a>
                                    </li>
                                    <li><a href="#">Property in Banglore</a>
                                    </li>
                                    <li><a href="#">Property in Mumbai</a>
                                    </li>
                                    <li><a href="#">Property in Lucknow</a>
                                    </li>
                                    <li><a href="#">Property in Oberoi</a>
                                    </li>
                                    <li><a href="#">Property in Orissa</a>
                                    </li>
                                    <li><a href="#">Property in Surat</a>
                                    </li>
                                    <li><a href="#">Property in Chandigarh</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="foo-left-inner">
                                <h3>New Projects in India </h3>
                                <ul>
                                    <li><a href="#">New Projects in Navi Mumbai</a>
                                    </li>
                                    <li><a href="#">New Projects in Banglore</a>
                                    </li>
                                    <li><a href="#">New Projects in Mumbai</a>
                                    </li>
                                    <li><a href="#">New Projects in Lucknow</a>
                                    </li>
                                    <li><a href="#">New Projects in Oberoi</a>
                                    </li>
                                    <li><a href="#">New Projects in Orissa</a>
                                    </li>
                                    <li><a href="#">New Projects in Surat</a>
                                    </li>
                                    <li><a href="#">New Projects in Chandigarh</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <hr/>
                        <p class="disclaimer-p">Disclaimer: <?php echo e($footer_content->description); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Copyright &copy; 2020 Parhit Properties. All Right Reserved | Design &amp; Developed By <a href="#">Web Mingo IT Solutions Pvt. Ltd.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php echo $__env->make('layouts.front.app_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script type="text/javascript">
    $(".modal_loading").css('display','none');

    $("#login_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(route('login_ajax')); ?>",
          method: "POST",
          data: $("#login_form").serialize(),
          beforeSend:function() {
            $(".btn-send").attr('disabled', true);
            $(".modal_loading").css('display', 'block');
          },
          success: function(response) {
            // console.log(response);
            // toastr.success('abc')
            // var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              // $(".modal").modal('hide');
              if(response.role === 'owner') {
                 window.location = "<?php echo e(url('user/dashboard')); ?>"
              }else if(response.role === 'builder') {
                 window.location = "<?php echo e(url('builder/dashboard')); ?>"
              }else if(response.role === 'agent') {
                 window.location = "<?php echo e(url('agent/dashboard')); ?>"
              }
            } else if (response.status === 400) {
              toastr.error(response.message)
              $("#login_form #password").val('');
            }
          },
          error: function(response) {
            toastr.error('An error occured')
          },
          complete: function() {
            $(".modal_loading").css('display', 'none');
            $(".btn-send").attr('disabled', false);
            // $("form").trigger('reset');
          }
        })
      }
    });


    $("#forgot_password_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(config('app.api_url').'/forgot-password'); ?>",
          method: "POST",
          data: $("#forgot_password_form").serialize(),
          beforeSend:function() {
            console.log($("#forgot_password_form").serialize());
            $(".btn-send").attr('disabled', true);
            $(".modal_loading").css('display', 'block');
          },
          success: function(response) {
            console.log(response);
            // toastr.success('abc')
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
              $("#forgot_password_form #email").val('');
              toastr.success(response.message)
              $(".modal").modal('hide');
              $("#forgototp").modal('show');
              $("#verify_otp_password .user_id").val(response.data.User.id);
              // reloadPage();
            } else if (response.responseCode === 400) {
              toastr.error(response.message)
              $("#forgot_password_form #email").val('');
            }
          },
          error: function(xhr, status, error) {
            var response = JSON.parse(xhr.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
          },
          complete: function() {
            $(".modal_loading").css('display', 'none');
            $(".btn-send").attr('disabled', false);
            $("form").trigger('reset');
          }
        })
      }
    });


    $("#verify_otp_password").validate({
      rules:{
        new_password:{
            minlength:8
        },
        confirm_new_password:{
            equalTo:"#new_password"
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(config('app.api_url').'/verify-otp'); ?>",
          method: "POST",
          data: $("#verify_otp_password").serialize(),
          beforeSend:function() {
            $(".btn-send").attr('disabled', true);
            $(".modal_loading").css('display', 'block');
          },
          success: function(response) {
            // console.log(response);
            // toastr.success('abc')
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              // reloadPage();
            } else if (response.responseCode === 400) {
              toastr.error(response.message)
              $("#verify_otp_password").trigger('reset');
            }
          },
          error: function(xhr, status, error) {
            var response = JSON.parse(xhr.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
          },
          complete: function() {
            $(".modal_loading").css('display', 'none');
            $(".btn-send").attr('disabled', false);
            $("form").trigger('reset');
          }
        })
      }
    });

    $("#register_form").validate({
        rules:{
            password: {
                required:true,
                minlength:8
            },
            confirm_password:{
                required:true,
                equalTo:"#reg_password",
                minlength:8
            },
            mobile_number:{
                minlength:10,
                maxlength:10,
                required:true,
                digits:true
            }

        },

      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(config('app.api_url').'/register'); ?>",
          method: "POST",
          data: $("#register_form").serialize(),
          beforeSend:function() {
            $(".btn-send").attr('disabled', true);
            $(".modal_loading").css('display', 'block');
          },
          success: function(response) {
            // console.log(response);
            // toastr.success('abc')
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              $("#otpmodal").modal('show');
              $("#otp_form .user_id").val(response.data.User.id);
              // reloadPage();
            } else if (response.responseCode === 400) {
              toastr.error(response.message)
              $("#register_form").trigger('reset');
            }
          },
          error: function(xhr, status, error) {
            var response = JSON.parse(xhr.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
          },
          complete: function() {
            $(".modal_loading").css('display', 'none');
            $(".btn-send").attr('disabled', false);
            // $("form").trigger('reset');
          }
        })
      }
    });


    $("#otp_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "<?php echo e(config('app.api_url').'/verify-otp'); ?>",
          method: "POST",
          data: {
            "_token":$('input[name="_token"]').val(),
            "otp": $("#otp_form #otp").val(),
            "user_id": $("#otp_form .user_id").val(),
            "is_register":true
          },
          beforeSend:function() {
            $(".btn-send").attr('disabled', true);
            $(".modal_loading").css('display', 'block');
          },
          success: function(response) {
            // console.log(response);
            // toastr.success('abc')
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              // window.user_id = response.data.User.id;
              // console.log(response.data.User.id);
              reloadPage();
            } else if (response.responseCode === 400) {
              toastr.error(response.message)
              $("#otp_form").trigger('reset');
            }
          },
          error: function(xhr) {
            var response = JSON.parse(xhr.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured')
          },
          complete: function() {
            $(".modal_loading").css('display', 'none');
            $(".btn-send").attr('disabled', false);
          }
        })
      }
    });



function loadCities(state_id, element_id) {
    // if(empty(state_id)) return true;

    var route = "<?php echo e(config('app.api_url')); ?>/cities_states/"+state_id;
    $.ajax({
        url: route,
        method:"GET",
        beforeSend:function() {
            $(".loading_3").css('display','block');
            $(".btn-postproperty").attr('disabled', true);
        },
        success:function(response) {
            // console.log(response);
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
                var cities = response.data.Cities;
                console.log(cities);
                if(cities.length > 0) {
                    $(`#${element_id}`).empty();
                    $.each(cities, function(x,y) {
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
        error:function() {
            toastr.error('An error occured')
        },
        complete:function() {
            $(".loading_3").css('display','none');
            $(".btn-postproperty").attr('disabled', false);
        }
    });

}

function viewMoreCities() {
    $(".loading").css('display', 'none');
    $.ajax({
        url   : "<?php echo e(url('home/get/all/cities')); ?>?state_id=<?php echo e(Cache::get('state-id')); ?>",
        method: "GET",
        beforeSend:function() {
          $(".modal_loading").css('display', 'block');
        },
        success: function(cities) {
            $('#render-cities-modal').empty();
            $('#render-cities-modal').append(cities);
            setTimeout(function() {
                $('#location-list').modal('show');
            }, 1000);
        },
        error: function(response) {
          $(".modal_loading").css('display', 'none');
          swal('', response, 'error');
        },
        complete: function() {
          $(".modal_loading").css('display', 'none');
        }
    })
}

document.getElementById('view-otp').style.display = 'none';
document.getElementById('login-type-password').style.display = 'none';
document.getElementById('check-otp').style.display = 'none';

function faceBookSignup() {
    var getSelectedValue = document.querySelector( 'input[name="owner_type"]:checked');   
    if(getSelectedValue != null) { 
        window.location.href = '<?php echo e(url('signup')); ?>/facebook?role='+getSelectedValue.value;
    }  
}

function googleSignup() {
    var getSelectedValue = document.querySelector( 'input[name="owner_type"]:checked');   
    if(getSelectedValue != null) { 
        window.location.href = '<?php echo e(url('signup')); ?>/google?role='+getSelectedValue.value;
    }  
}

function loginType(type) {
    if(type == 'otp') {
        document.getElementById('view-otp').style.display = 'block';
        document.getElementById('login-type-otp').style.display = 'none';
        document.getElementById('view-password').style.display = 'none';
        document.getElementById('login-type-password').style.display = 'block';
        document.getElementById('check-otp').style.display = 'block';
        document.getElementById('check-login').style.display = 'none';
    }else {
        document.getElementById('view-otp').style.display = 'none';
        document.getElementById('login-type-otp').style.display = 'block';
        document.getElementById('view-password').style.display = 'block';
        document.getElementById('login-type-password').style.display = 'none';
        document.getElementById('check-otp').style.display = 'none';
        document.getElementById('check-login').style.display = 'block';
    }
}

function sendLoginOtp() {
    var email = $('#login-email').val();
    if(email == '') {
        swal('', 'Email or mobile number field must be required', 'warning');
        return false;
    }
    $.ajax({
        url: '<?php echo e(url('login/send/otp')); ?>',
        method: "POST",
        data: {
            '_token': '<?php echo e(csrf_token()); ?>',
            'email'  : email
        },
        beforeSend:function() {
          $(".modal_loading").css('display', 'block');
        },
        success: function(data) {
            if(data.status == 200){
                swal('', data.msg, 'success');
            }else {
                swal('', data.msg, 'warning');
            }
            document.getElementById('check-login').style.display = 'block';
            document.getElementById('check-otp').style.display = 'none';
        },
        error: function(response) {
          $(".modal_loading").css('display', 'none');
          swal('', response, 'error');
        },
        complete: function() {
          $(".modal_loading").css('display', 'none');
        }
    })
}

</script>
<?php echo $__env->make('layouts.app_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(session('success')): ?>
    <script type="text/javascript">
        toastr.success('<?php echo e(session('success')); ?>')
    </script>
<?php endif; ?>
<?php if(session('error')): ?>
    <script type="text/javascript">
        toastr.error('<?php echo e(session('error')); ?>')
    </script>
<?php endif; ?>

<?php echo $__env->yieldContent('js'); ?><?php /**PATH /home/parhitproperties/public_html/parhit-new/resources/views/layouts/front/app.blade.php ENDPATH**/ ?>