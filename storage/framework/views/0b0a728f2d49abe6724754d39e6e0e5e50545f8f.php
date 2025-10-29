<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .sidebar-section {
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
        background-color: #f8f9fa;
        padding: 15px;
    }

    .sidebar-menu .nav-link {
        color: #333;
        padding: 10px 15px;
    }

    .sidebar-menu .nav-link:hover {
        background-color: #007bff;
        color: #fff !important;
        border-radius: 5px;
    }

    .sidebar-menu .collapse ul {
        padding-left: 20px;
    }

    .sidebar-menu .collapse .nav-link {
        padding: 5px 15px;
        font-size: 0.9rem;
    }
</style>
<style>
    .mobile-sidebar {
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar-link {
        background: #fff;
        padding: 10px 15px;
        border-radius: 8px;
        color: #333;
        font-weight: 500;
        text-decoration: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease-in-out;
    }

    .sidebar-link:hover {
        background: #007bff;
        color: #fff !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .sidebar-link.active {
        background: #007bff;
        color: #fff !important;
    }

    .submenu {
        background: #f1f4f8;
        border-radius: 6px;
        margin-top: 6px;
        transition: all 0.3s;
    }

    .submenu-link {
        display: block;
        color: #555;
        font-size: 0.95rem;
        padding: 6px 0;
        text-decoration: none;
    }

    .submenu-link:hover {
        color: #007bff;
        font-weight: 600;
    }
</style>
<section class="sidebar-section">
    <div class="row">

        <div class="profile-section">
            <div class="profile-image">
                <div class="pro-user">
                    <?php
                        $avatar = "";

                        if (!file_exists(Auth::user()->avatar)) {
                            $avatar = asset('images/usr.png');
                        } else {
                            $avatar = url(Auth::user()->avatar);
                        }
                    ?>

                    <img src="<?php echo e($avatar); ?>" alt="Profile Picture" id="change_avatar" class="img-fluid">
                    <form id="avatar-form" name="avatar-form" enctype="multipart/form-data">
                        <div class="p-image">
                            <i class="fas fa-pencil-alt upload-button" id="buttonid"></i>
                            <input class="file-upload" type="file" id="fileid" name="avatar_file" accept="image/*"
                                onchange="previewImage(this)" style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="user-info d-flex flex-column">
                <p style="font-weight:600;"> <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?></p>
                <p><?php echo e(Auth::user()->email); ?> <?php if(\Auth::user()->is_verified == 1): ?> <a class="verify-btn-s"><i
                class="fa fa-check-circle"></i></a> <?php else: ?> <a style="cursor: pointer;"
                                onclick="verifyEmail()" class="verify-btn-s"> <img src="<?php echo e(asset('images')); ?>/verify.png"
                            alt="verified" width="15px;"></a> <?php endif; ?></p>
                <p><?php echo e(Auth::user()->mobile_number); ?> <?php if(\Auth::user()->mobile_verified == 1): ?> <a class="verify-btn-s"><i
                class="fa fa-check-circle"></i></a> <?php else: ?> <a style="cursor: pointer;"
                                onclick="verifyMobileNumber()" class="verify-btn-s"> <img src="<?php echo e(asset('images')); ?>/verify.png"
                            width="15px;" alt="verified"></a> <?php endif; ?></p>

            </div>

        </div>
        <div class="col-sm-12 d-flex ">
            
            
        </div>
        <div class="col-sm-12 mt-3">
            <div class="sidebar-menu">
                <nav class="navbar navbar-expand-lg navbar-sd-sidebar">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSidebar"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-mob"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse nav-side" id="navbarSidebar">
                        <ul class="navbar-nav">
                            <li class="nav-item" style="color:#000;">
                                <a href="<?php echo e(url('user/dashboard')); ?>"
                                    class="nav-link <?php echo e(Request::is('user/dashboard') ? 'active' : ''); ?>"
                                    style="color:#000;">
                                    Dashboard
                                </a>
                            </li>
                            <!-- Setting Menu -->
                            <?php
                                $isSettingActive = request()->is('user/profile')
                                    || request()->is('user/my-activities')
                                    || in_array(request('tab'), ['profile', 'security']);
                            ?>

                            <li class="nav-item">
                                <a class="nav-link <?php echo e($isSettingActive ? '' : 'collapsed'); ?>" href="#"
                                    data-toggle="collapse" data-target="#settingMenu"
                                    aria-expanded="<?php echo e($isSettingActive ? 'true' : 'false'); ?>"
                                    aria-controls="settingMenu">
                                    Setting
                                </a>
                                <div class="collapse <?php echo e($isSettingActive ? 'show' : ''); ?>" id="settingMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/profile?tab=profile')); ?>"
                                                class="nav-link <?php echo e(request('tab') === 'profile' ? 'active' : ''); ?>">
                                                Profile
                                            </a>

                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/profile?tab=security')); ?>"
                                                class="nav-link <?php echo e(request('tab') === 'security' ? 'active' : ''); ?>">
                                                Change Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/my-activities')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/my-activities') ? 'active' : ''); ?>">
                                                My Activities
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Property Menu -->
                            <?php
                                $isPropertyActive = Request::is('user/properties*') ||
                                    Request::is('user/all-inquries') ||
                                     Request::is('user/sent-inquries') ||
                                    Request::is('user/my-wishlist');
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($isPropertyActive ? '' : 'collapsed'); ?>" href="#"
                                    data-toggle="collapse" data-target="#propertyMenu"
                                    aria-expanded="<?php echo e($isPropertyActive ? 'true' : 'false'); ?>"
                                    aria-controls="propertyMenu">
                                    Property
                                </a>
                                <div class="collapse <?php echo e($isPropertyActive ? 'show' : ''); ?>" id="propertyMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/properties')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/properties*') ? 'active' : ''); ?>">
                                                My Properties
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/all-inquries')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/all-inquries') ? 'active' : ''); ?>">
                                                Received Inquiries
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/sent-inquries')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/sent-inquries') ? 'active' : ''); ?>">
                                                Sent Inquiries
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/my-wishlist')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/my-wishlist') ? 'active' : ''); ?>">
                                                My Wishlist
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Price & Subscriptions Menu -->
                            <?php
                                $isPriceActive = Request::is('user/current-subscriptions') ||
                                    Request::is('user/payments-invoice') ||
                                    Request::is('user/pricing');
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($isPriceActive ? '' : 'collapsed'); ?>" href="#"
                                    data-toggle="collapse" data-target="#priceMenu"
                                    aria-expanded="<?php echo e($isPriceActive ? 'true' : 'false'); ?>" aria-controls="priceMenu">
                                    Price & Subscriptions
                                </a>
                                <div class="collapse <?php echo e($isPriceActive ? 'show' : ''); ?>" id="priceMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/current-subscriptions')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/current-subscriptions') ? 'active' : ''); ?>">
                                                Current Subscriptions
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/payments-invoice')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/payments-invoice') ? 'active' : ''); ?>">
                                                Payments & Invoice
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('user/pricing')); ?>"
                                                class="nav-link <?php echo e(Request::is('user/pricing') ? 'active' : ''); ?>">
                                                Pricing
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="<?php echo e(url('user/logout')); ?>" method="POST"
                                    style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="email-verify" tabindex="-1" role="dialog" aria-labelledby="email-verify"
        aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="top-design">
                    <img src="<?php echo e(asset('images/top-designs.png/')); ?>" class="img-fluid">
                </div>
                <form action="<?php echo e(url('user/email-mobile/verify/otp')); ?>?type=email" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-main">
                            <div class="row login-heads">
                                <div class="col-sm-12">
                                    <h3 class="heads-login">Email Verification</h3>
                                    <span class="allrequired">All field are required</span>
                                </div>
                            </div>
                            <?php if(session()->has('otp-success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('otp-success')); ?>

                                </div>
                            <?php endif; ?>
                            <div class="modal-form">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label-control">Enter OTP</label>
                                        <input type="number" name="otp" class="text-control" placeholder="Enter OTP"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Verify Now <i
                                                class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend
                            OTP</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade custom-modal" id="mob-verify" tabindex="-1" role="dialog" aria-labelledby="mob-verify"
        aria-hidden="true">
        <div class="modal-dialog w-450" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="top-design">
                    <img src="<?php echo e(asset('images/top-designs.png/')); ?>" class="img-fluid">
                </div>
                <form action="<?php echo e(url('user/email-mobile/verify/otp')); ?>?type=mobile" method="post">
                    <?php echo csrf_field(); ?>
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
                                        <input type="number" name="otp" class="text-control" placeholder="Enter OTP"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-send w-100">Verify Now <i
                                                class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-foo text-center">
                    <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend
                            OTP</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $(document).ready(function () {
        // Jab koi menu click ho
        $('.nav-link[data-toggle="collapse"]').on('click', function (e) {
            var $this = $(this);
            var target = $this.data('target'); // target collapse ka ID

            // Agar same menu already open hai
            if ($(target).hasClass('show')) {
                $(target).collapse('hide'); // to close it
            } else {
                // Baaki sab band kar do
                $('.collapse.show').collapse('hide');
                // aur ye wala open karo
                $(target).collapse('show');
            }
        });
    });



    function verifyEmail() {
        swal({
            title: "Are you sure?",
            text: "Verify This Email.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $(".loading_2").show();
                $(".btn-delete").attr('disabled', true);
                $.ajax({
                    url: '<?php echo e(url('user/verify/email')); ?>',
                    method: "GET",
                    success: function (response) {
                        toastr.success(response);
                        $('#email-verify').modal('show');
                    },
                    error: function () {
                        toastr.error('An error occurred.');
                    },
                    complete: function () {
                        $(".loading_2").hide();
                        $(".btn-delete").attr('disabled', false);
                    }
                });
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
        }).then((willDelete) => {
            if (willDelete) {
                $(".loading_2").show();
                $(".btn-delete").attr('disabled', true);
                $.ajax({
                    url: '<?php echo e(url('user/verify/mobile')); ?>',
                    method: "GET",
                    success: function (response) {
                        toastr.success(response);
                        $('#mob-verify').modal('show');
                    },
                    error: function () {
                        toastr.error('An error occurred.');
                    },
                    complete: function () {
                        $(".loading_2").hide();
                        $(".btn-delete").attr('disabled', false);
                    }
                });
            }
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const collapses = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapses.forEach(item => {
            item.addEventListener("click", function () {
                const target = document.querySelector(this.getAttribute("href"));
                if (target.classList.contains("show")) {
                    target.classList.remove("show");
                } else {
                    document.querySelectorAll(".submenu.show").forEach(openMenu => openMenu.classList.remove("show"));
                    target.classList.add("show");
                }
            });
        });
    });
</script><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/sidebar.blade.php ENDPATH**/ ?>