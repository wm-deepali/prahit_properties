<!doctype html>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <?php echo $__env->make('layouts.app_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>

    </head>
    <body>
    <header>
        <div class="top-bar">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-top">
                    <a class="navbar-brand" href="<?php echo e(config('app.url')); ?>"><img src="<?php echo e(asset('images/admin-logo.png')); ?>" class="img-fluid"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if(auth()->guard()->check()): ?>
                                        <span><img src="<?php echo e(asset('storage')); ?>/<?php echo e(Auth::user()->avatar); ?>" class="img-fliud"></span> 
                                        <?php echo e(Auth::user()->firstname); ?>

                                    <?php endif; ?>
                                    <?php if(auth()->guard()->guest()): ?>
                                        <span><img src="<?php echo e(URL::asset('images/usr.png')); ?>" class="img-fliud"></span> 
                                    <?php endif; ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.edit_profile')); ?>">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

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
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-middle" aria-controls="navbar-middle" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbar-middle">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            </li>
							<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="fas fa-bars"></i> Master
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.category.index')); ?>">Manage Property Available For</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.sub-category.index')); ?>">Manage Category</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.sub-sub-category.index')); ?>">Manage Property Type</a>
                                    <!--<a class="dropdown-item" href="<?php echo e(route('admin.features.index')); ?>">Manage Features</a>-->
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageStates')); ?>">Manage States</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageCities', 'all')); ?>">Manage City</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.locations.index')); ?>">Manage Locations</a>
                                    <!--<a class="dropdown-item" href="<?php echo e(url('master/manage/sub-locations')); ?>">Manage Sub Locations</a>-->
                                    <a class="dropdown-item" href="<?php echo e(route('admin.formtype.index')); ?>">Manage Form Type</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageSummonsReasons')); ?>">Summons Reasons</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageAmenities')); ?>">Manage Amenities</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.email-template.index')); ?>">Email Template Settings</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageClaims')); ?>">Manage Claims</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.price-labels.index')); ?>">Manage Price Labels</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.property-statuses.index')); ?>">Manage Property Status</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.registration-statuses.index')); ?>">Manage Registration Status</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.furnishing-statuses.index')); ?>">Manage Furnishing Status</a>
                                </div>
                            </li>
							
							<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-users"></i> Users
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.owners.index')); ?>">All Owners</a>
                                    <a class="dropdown-item" href="<?php echo e(url('master/manage/builders')); ?>">All Builders</a>
                                    <a class="dropdown-item" href="<?php echo e(url('master/manage/agent')); ?>">All Agents</a>
                                </div>
                            </li>
							
							<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="far fa-building"></i> Property
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.pendinPropertyList')); ?>">Pending Properties</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageApprovedProperties')); ?>">Approved Properties</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.managePublishedProperties')); ?>">Published Properties</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageCancelledProperties')); ?>">Cancelled & Rejected Properties</a>
                                </div>
                            </li>
							<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-pencil-alt"></i> Enquiries
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manage-enquiries.index')); ?>"> Property Enquiries</a>
                                    <a class="dropdown-item" href="<?php echo e(url('master/property/feedback')); ?>"> Feedbacks</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manage-complaints.index')); ?>"> Property Complaints</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageSupportQuery')); ?>"> Support Center</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageComplaints')); ?>"> Complaints</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cogs"></i> General Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.sms_config')); ?>">SMS Integration</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.payment-gateway.index')); ?>">Payment Gateway</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.email-integration.index')); ?>">Email Integration</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cog"></i> Web Directory
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.web-directory-category.index')); ?>">Manage Category</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.web-directory-sub-category.index')); ?>">Manage Category</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cogs"></i> Home Page Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(url('manage/front/content')); ?>">Manage Front Sections</a>
                                    <a class="dropdown-item" href="<?php echo e(route('manageAboutContent')); ?>">About Us</a>
                                    <a class="dropdown-item" href="<?php echo e(route('manageVisionMission')); ?>">Vision & Mission</a>
                                    <a class="dropdown-item" href="<?php echo e(route('manageTerms')); ?>">Term & Conditions</a>
                                    <a class="dropdown-item" href="<?php echo e(route('managePolicy')); ?>">Privecy Policy</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageContactInfo')); ?>">Contact Us</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageTestimonial')); ?>">Testimonials</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageSafetyHealth')); ?>">Safety Health</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageCarrerWithUs')); ?>">Career With Us</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.popular.cities')); ?>">Manage Popular Cities</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageFeatureContent')); ?>">Manage Feature Content</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageHelpContent')); ?>">Manage Help Content</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageSocialMedia')); ?>">Manage Social Media</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageFooterContent')); ?>">Manage Footer Content</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cogs"></i> Jobs
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageJobCategories')); ?>">Manage Job Category</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageJobTechnologies')); ?>">Manage Technologies</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageJobs')); ?>">Manage Jobs</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cogs"></i> Blog
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageBlogCategories')); ?>">Manage Blog Category</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.manageBlogs')); ?>">Manage Blogs</a>
                                </div>
                            </li>

<!--                             <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-cog"></i> Ads Management
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a href="master-click-impressions.php" class="dropdown-item"> Master Click/Impressions</a>
                                     <a href="<?php echo e(route('admin.manage-ads.create')); ?>" class="dropdown-item"> Add Ads</a>
                                     <a href="<?php echo e(route('admin.manage-ads.index')); ?>" class="dropdown-item"> Manage Ads</a>
                                     <a href="<?php echo e(route('admin.manage-audience.index')); ?>" class="dropdown-item"> Ads Audience</a>
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

<footer>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020 <?php echo e(config('app.name')); ?> | All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php echo $__env->make('layouts.app_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
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

<?php echo $__env->yieldContent('js'); ?>    <?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/layouts/app.blade.php ENDPATH**/ ?>