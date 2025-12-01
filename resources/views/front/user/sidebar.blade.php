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
                    @php
                        $avatar = Auth::user()->avatar;

                        if ($avatar && Storage::disk('public')->exists($avatar)) {
                            // If file exists in storage
                            $avatar = asset('storage/' . $avatar);
                        } else {
                            // Default image
                            $avatar = asset('images/usr.png');
                        }
                    @endphp

                    <img src="{{$avatar}}" alt="Profile Picture" id="change_avatar" class="img-fluid">
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
                <p style="font-weight:600;">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                <p>{{Auth::user()->email}}
                    @if(\Auth::user()->is_verified == 1)
                        <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a>
                    @else
                        <a style="cursor: pointer;" onclick="verifyEmail()" class="verify-btn-s">
                            <img src="{{ asset('images') }}/verify.png" alt="verified" width="15px;">
                        </a>
                    @endif
                </p>
                <p>{{Auth::user()->mobile_number}}
                    @if(\Auth::user()->mobile_verified == 1)
                        <a class="verify-btn-s"><i class="fa fa-check-circle"></i></a>
                    @else
                        <a style="cursor: pointer;" onclick="verifyMobileNumber()" class="verify-btn-s">
                            <img src="{{ asset('images') }}/verify.png" width="15px;" alt="verified">
                        </a>
                    @endif
                </p>
            </div>
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
                                <a href="{{ url('user/dashboard') }}"
                                    class="nav-link {{ Request::is('user/dashboard') ? 'active' : '' }}"
                                    style="color:#000;">
                                    Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user/profile') || request()->is('user/my-activities') || request()->is('user/profile-section') || in_array(request('tab'), ['profile', 'security']) ? '' : 'collapsed' }}"
                                    href="#" data-toggle="collapse" data-target="#settingMenu"
                                    aria-expanded="{{ request()->is('user/profile') || request()->is('user/my-activities') || request()->is('user/profile-section') || in_array(request('tab'), ['profile', 'security']) ? 'true' : 'false' }}"
                                    aria-controls="settingMenu">
                                    Settings
                                </a>
                                <div class="collapse {{ request()->is('user/profile') || request()->is('user/my-activities') || request()->is('user/public-profile') || in_array(request('tab'), ['profile', 'security']) ? 'show' : '' }}"
                                    id="settingMenu">
                                    <ul class="nav flex-column ml-3">
                                        <li class="nav-item">
                                            <a href="{{ url('user/profile?tab=profile') }}"
                                                class="nav-link {{ request('tab') === 'profile' ? 'active' : '' }}">
                                                Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('user/profile?tab=security') }}"
                                                class="nav-link {{ request('tab') === 'security' ? 'active' : '' }}">
                                                Change Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('user/my-activities') }}"
                                                class="nav-link {{ Request::is('user/my-activities') ? 'active' : '' }}">
                                                My Activities
                                            </a>
                                        </li>

                                        {{-- ✅ Show only if user is Agent or Builder --}}
                                        @if(in_array(Auth::user()->role, ['agent', 'builder']))
                                            <li class="nav-item">
                                                <a href="{{ url('user/profile-section') }}"
                                                    class="nav-link {{ Request::is('user/profile-section') ? 'active' : '' }}">
                                                    Profile Section
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link collapsed {{ Request::is('user/agent-profile-reviews') || Request::is('user/sent-reviews') ? '' : 'collapsed' }}"
                                    href="#" data-toggle="collapse" data-target="#reviewsMenu"
                                    aria-expanded="{{ Request::is('user/agent-profile-reviews') || Request::is('user/sent-reviews') ? 'true' : 'false' }}"
                                    aria-controls="reviewsMenu">
                                    Reviews
                                </a>
                                <div class="collapse {{ Request::is('user/agent-profile-reviews') || Request::is('user/sent-reviews') ? 'show' : '' }}"
                                    id="reviewsMenu">
                                    <ul class="nav flex-column ml-3">
                                        {{-- ✅ Show Agent Profile Reviews only for Agents/Builders --}}
                                        @if(in_array(Auth::user()->role, ['agent', 'builder']))
                                            <li class="nav-item">
                                                <a href="{{ url('user/agent-profile-reviews') }}"
                                                    class="nav-link {{ Request::is('user/agent-profile-reviews') ? 'active' : '' }}">
                                                    Agent Profile Reviews
                                                </a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a href="{{ url('user/sent-reviews') }}"
                                                class="nav-link {{ Request::is('user/sent-reviews') ? 'active' : '' }}">
                                                My Sent Reviews
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <!-- Property or Services menu will be rendered here -->
                            <div id="dynamicMenu"></div>

                            <!-- Pricing & Subscriptions menu will be rendered here -->
                            <div id="dynamicPricingMenu"></div>

                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('user/logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Email Verification Modal -->
    <div class="modal fade custom-modal" id="email-verify" tabindex="-1" role="dialog" aria-labelledby="email-verify"
        aria-hidden="true">
        <!-- modal content here -->
    </div>

    <!-- Mobile Verification Modal -->
    <div class="modal fade custom-modal" id="mob-verify" tabindex="-1" role="dialog" aria-labelledby="mob-verify"
        aria-hidden="true">
        <!-- modal content here -->
    </div>
</section>

<script>
    // Utility to get query param
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Detect and store user_type
    let userType = getQueryParam('type') || localStorage.getItem('user_type') || 'property';
    if (getQueryParam('type')) {
        localStorage.setItem('user_type', userType);
    }

    // Render Property or Services menu according to user_type
    function renderSidebarMenu(userType) {
        const sectionLabel = (userType === 'service') ? 'Business' : 'Property';

        // Property/Services menu HTML
        const dynamicMenuHtml = `
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#${sectionLabel.toLowerCase()}Menu" aria-expanded="false" aria-controls="${sectionLabel.toLowerCase()}Menu">
                ${sectionLabel}
            </a>
            <div class="collapse" id="${sectionLabel.toLowerCase()}Menu">
                <ul class="nav flex-column ml-3">
                    ${userType === 'service' ? `
                        <li class="nav-item"><a href="/user/services" class="nav-link">My Business Listing</a></li>
                        <li class="nav-item"><a href="/user/all-services-inquiries" class="nav-link">Received Business Inquiries</a></li>
                        <li class="nav-item"><a href="/user/sent-services-inquiries" class="nav-link">Sent Business Inquiries</a></li>
                        <li class="nav-item"><a href="/user/my-service-wishlist" class="nav-link">My Business Wishlist</a></li>
                        <!-- ✅ Added Business Listing Reviews -->
                        <li class="nav-item"><a href="/user/business-listing-reviews" class="nav-link">Business Listing Reviews</a></li>
                        
                    ` : `
                        <li class="nav-item"><a href="/user/properties" class="nav-link">My Properties</a></li>
                        <li class="nav-item"><a href="/user/all-inquries" class="nav-link">Received Inquiries</a></li>
                        <li class="nav-item"><a href="/user/sent-inquries" class="nav-link">Sent Inquiries</a></li>
                        <li class="nav-item"><a href="/user/my-wishlist" class="nav-link">My Wishlist</a></li>
                        <li class="nav-item"><a href="/user/recent-viewed-properties" class="nav-link">Recently Viewed</a></li>
                    `}
                </ul>
            </div>
        </li>
    `;

        // Append query param for Pricing & Subscriptions URLs
        const queryParam = (userType === 'service') ? '?type=service' : '';

        const pricingMenuHtml = `
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#priceMenu" aria-expanded="false" aria-controls="priceMenu">
                Pricing & Subscriptions
            </a>
            <div class="collapse" id="priceMenu">
                <ul class="nav flex-column ml-3">
                    <li class="nav-item"><a href="/user/current-subscriptions${queryParam}" class="nav-link">Current Subscriptions</a></li>
                    <li class="nav-item"><a href="/user/payments-invoice${queryParam}" class="nav-link">Payments & Invoice</a></li>
                    <li class="nav-item"><a href="/user/pricing${queryParam}" class="nav-link">Pricing</a></li>
                </ul>
            </div>
        </li>
    `;

        document.getElementById('dynamicMenu').innerHTML = dynamicMenuHtml;
        document.getElementById('dynamicPricingMenu').innerHTML = pricingMenuHtml;

    }

    // Highlight active nav links and expand the appropriate submenus
    function setActiveAndCollapse() {
        const currentUrl = window.location.pathname + window.location.search;

        const navLinks = document.querySelectorAll('.navbar-nav a.nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');

            if (href && currentUrl.startsWith(href)) {
                link.classList.add('active');

                // Expand parent collapse div
                const collapseDiv = link.closest('.collapse');
                if (collapseDiv) {
                    collapseDiv.classList.add('show');
                    const toggleLink = document.querySelector(`a[data-toggle="collapse"][data-target="#${collapseDiv.id}"]`);
                    if (toggleLink) {
                        toggleLink.setAttribute('aria-expanded', 'true');
                        toggleLink.classList.remove('collapsed');
                    }
                }
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        renderSidebarMenu(userType);

        // Bootstrap collapse toggle handling
        $('.nav-link[data-toggle="collapse"]').on('click', function () {
            const target = $(this).data('target');
            if ($(target).hasClass('show')) {
                $(target).collapse('hide');
            } else {
                $('.collapse.show').collapse('hide');
                $(target).collapse('show');
            }
        });

        setActiveAndCollapse();
    });

    function verifyEmail() {
        swal.fire({
            title: "Are you sure?",
            text: "Verify This Email.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, verify",
            cancelButtonText: "Cancel",
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {

            if (result.isConfirmed) {
                $(".loading_2").show();
                $(".btn-delete").attr('disabled', true);

                $.ajax({
                    url: '{{ url('user/verify/email') }}',
                    method: "GET",
                    success: (response) => {
                        toastr.success(response);
                        $('#email-verify').modal('show');
                    },
                    error: () => {
                        toastr.error('An error occurred.');
                    },
                    complete: () => {
                        $(".loading_2").hide();
                        $(".btn-delete").attr('disabled', false);
                    }
                });
            }

        });
    }
    function verifyMobileNumber() {
        swal.fire({
            title: "Are you sure?",
            text: "Verify This Mobile Number.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, verify",
            cancelButtonText: "Cancel",
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {

            if (result.isConfirmed) {
                $(".loading_2").show();
                $(".btn-delete").attr('disabled', true);

                $.ajax({
                    url: '{{ url('user/verify/mobile') }}',
                    method: "GET",
                    success: (response) => {
                        toastr.success(response);
                        $('#mob-verify').modal('show');
                    },
                    error: () => {
                        toastr.error('An error occurred.');
                    },
                    complete: () => {
                        $(".loading_2").hide();
                        $(".btn-delete").attr('disabled', false);
                    }
                });
            }

        });
    }

</script>