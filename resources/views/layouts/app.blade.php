<!doctype html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>@yield('title')</title>

    @include('layouts.app_css')

    @yield('css')

</head>

<body>
    <header>
        <div class="top-bar">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-top">
                    <a class="navbar-brand" href="{{config('app.url')}}"><img src="{{ asset('images/admin-logo.png')}}"
                            class="img-fluid"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @auth
                                        <span><img src="{{ asset('storage') }}/{{ Auth::user()->avatar }}"
                                                class="img-fliud"></span>
                                        {{Auth::user()->firstname}}
                                    @endauth
                                    @guest
                                        <span><img src="{{URL::asset('images/usr.png')}}" class="img-fliud"></span>
                                    @endguest
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.edit_profile')}}">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="middle-bar">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-middle"
                        aria-controls="navbar-middle" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar-middle">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('admin.dashboard')}}"><i
                                        class="fas fa-tachometer-alt"></i> Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bars"></i> Master
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.category.index')}}">Manage Property
                                        Available For</a>
                                    <a class="dropdown-item" href="{{route('admin.sub-category.index')}}">Manage
                                        Category</a>
                                    <a class="dropdown-item" href="{{route('admin.sub-sub-category.index')}}">Manage
                                        Property Type</a>
                                    <!--<a class="dropdown-item" href="{{route('admin.features.index')}}">Manage Features</a>-->
                                    <a class="dropdown-item" href="{{route('admin.manageStates')}}">Manage States</a>
                                    <a class="dropdown-item" href="{{route('admin.manageCities', 'all')}}">Manage
                                        City</a>
                                    <a class="dropdown-item" href="{{route('admin.locations.index')}}">Manage
                                        Locations</a>
                                    <!--<a class="dropdown-item" href="{{url('master/manage/sub-locations')}}">Manage Sub Locations</a>-->
                                    <a class="dropdown-item" href="{{route('admin.formtype.index')}}">Manage Form
                                        Type</a>
                                    <a class="dropdown-item" href="{{route('admin.manageSummonsReasons')}}">Summons
                                        Reasons</a>
                                    <a class="dropdown-item" href="{{route('admin.manageAmenities')}}">Manage
                                        Amenities</a>
                                    <a class="dropdown-item" href="{{route('admin.email-template.index')}}">Email
                                        Template Settings</a>
                                    <a class="dropdown-item" href="{{route('admin.manageClaims')}}">Manage Claims</a>
                                    <a class="dropdown-item" href="{{route('admin.price-labels.index')}}">Manage Price
                                        Labels</a>
                                    <a class="dropdown-item" href="{{route('admin.property-statuses.index')}}">Manage
                                        Property Status</a>
                                    <a class="dropdown-item"
                                        href="{{route('admin.registration-statuses.index')}}">Manage Registration
                                        Status</a>
                                    <a class="dropdown-item" href="{{route('admin.furnishing-statuses.index')}}">Manage
                                        Furnishing Status</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-users"></i> Users
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.owners.index')}}">All Owners</a>
                                    <a class="dropdown-item" href="{{url('master/manage/builders')}}">All Builders</a>
                                    <a class="dropdown-item" href="{{url('master/manage/agent')}}">All Agents</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-building"></i> Property
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.pendinPropertyList')}}">Pending
                                        Properties</a>
                                    <a class="dropdown-item" href="{{route('admin.manageApprovedProperties')}}">Approved
                                        Properties</a>
                                    <a class="dropdown-item"
                                        href="{{route('admin.managePublishedProperties')}}">Published Properties</a>
                                    <a class="dropdown-item"
                                        href="{{route('admin.manageCancelledProperties')}}">Cancelled & Rejected
                                        Properties</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-pencil-alt"></i> Enquiries
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.manage-enquiries.index')}}"> Property
                                        Enquiries</a>
                                    <a class="dropdown-item" href="{{url('master/property/feedback')}}"> Feedbacks</a>
                                    <a class="dropdown-item" href="{{route('admin.manage-complaints.index')}}"> Property
                                        Complaints</a>
                                    <a class="dropdown-item" href="{{route('admin.manageSupportQuery')}}"> Support
                                        Center</a>
                                    <a class="dropdown-item" href="{{route('admin.manageComplaints')}}"> Complaints</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i> General Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.sms_config')}}">SMS Integration</a>
                                    <a class="dropdown-item" href="{{route('admin.payment-gateway.index')}}">Payment
                                        Gateway</a>
                                    <a class="dropdown-item" href="{{route('admin.email-integration.index')}}">Email
                                        Integration</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i> Web Directory
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{route('admin.web-directory-category.index')}}">Manage Category</a>
                                    <a class="dropdown-item"
                                        href="{{route('admin.web-directory-sub-category.index')}}">Manage Sub
                                        Category</a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.business-listing.index') }}">Business Listing</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i> Home Page Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('manage/front/content')}}">Manage Front
                                        Sections</a>
                                    <a class="dropdown-item" href="{{route('manageAboutContent')}}">About Us</a>
                                    <a class="dropdown-item" href="{{route('manageVisionMission')}}">Vision &
                                        Mission</a>
                                    <a class="dropdown-item" href="{{route('manageTerms')}}">Term & Conditions</a>
                                    <a class="dropdown-item" href="{{route('managePolicy')}}">Privecy Policy</a>
                                    <a class="dropdown-item" href="{{route('admin.manageContactInfo')}}">Contact Us</a>
                                    <a class="dropdown-item"
                                        href="{{route('admin.manageTestimonial')}}">Testimonials</a>
                                    <a class="dropdown-item" href="{{route('admin.manageSafetyHealth')}}">Safety
                                        Health</a>
                                    <a class="dropdown-item" href="{{route('admin.manageCarrerWithUs')}}">Career With
                                        Us</a>
                                    <a class="dropdown-item" href="{{route('admin.popular.cities')}}">Manage Popular
                                        Cities</a>
                                    <a class="dropdown-item" href="{{route('admin.manageFeatureContent')}}">Manage
                                        Feature Content</a>
                                    <a class="dropdown-item" href="{{route('admin.manageHelpContent')}}">Manage Help
                                        Content</a>
                                    <a class="dropdown-item" href="{{route('admin.manageSocialMedia')}}">Manage Social
                                        Media</a>
                                    <a class="dropdown-item" href="{{route('admin.manageFooterContent')}}">Manage Footer
                                        Content</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i> Jobs
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.manageJobCategories')}}">Manage Job
                                        Category</a>
                                    <a class="dropdown-item" href="{{route('admin.manageJobTechnologies')}}">Manage
                                        Technologies</a>
                                    <a class="dropdown-item" href="{{route('admin.manageJobs')}}">Manage Jobs</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i> Content Management
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('admin.manageBlogCategories')}}">Manage Blog
                                        Category</a>
                                    <a class="dropdown-item" href="{{route('admin.manageBlogs')}}">Manage Blogs</a>

                                     <a class="dropdown-item" href="{{route('admin.faq-categories.index')}}">Manage Faq
                                        Category</a>
                                    <a class="dropdown-item" href="{{route('admin.faqs.index')}}">Manage Faqs</a>
                                
                                    <a class="dropdown-item" href="{{ route('admin.client-reels.index') }}">Client Reels</a>
                                </div>
                            </li>

                            <!--                             <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cog"></i> Ads Management
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a href="master-click-impressions.php" class="dropdown-item"> Master Click/Impressions</a>
                                     <a href="{{route('admin.manage-ads.create')}}" class="dropdown-item"> Add Ads</a>
                                     <a href="{{route('admin.manage-ads.index')}}" class="dropdown-item"> Manage Ads</a>
                                     <a href="{{route('admin.manage-audience.index')}}" class="dropdown-item"> Ads Audience</a>
                                </div>
                            </li>
 -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="new_loader" id="new_loader">Loading&#8230;</div>
    @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')

    <footer>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020 {{config('app.name')}} | All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>

@include('layouts.app_js')
<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
@if(session('success'))
    <script type="text/javascript">
        toastr.success('{{ session('success') }}')
    </script>
@endif
@if(session('error'))
    <script type="text/javascript">
        toastr.error('{{ session('error') }}')
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('js')