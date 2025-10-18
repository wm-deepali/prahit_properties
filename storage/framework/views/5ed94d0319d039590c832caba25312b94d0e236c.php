<!DOCTYPE html>
<html lang="en">

<head>
  <?php echo $__env->yieldContent('title'); ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <?php echo e(csrf_field()); ?>

  <?php echo $__env->make('layouts.front.app_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <style type="text/css">
    .modal_loading {
      height: 30px;
    }

    .main-header .nav-link {
      transition: color 0.2s ease-in-out;
    }

    .main-header .nav-link:hover {
      color: #E93014 !important;
    }

    .main-header .btn:hover {
      opacity: 0.9;
    }

    .top-menu-header {
      width: 100%;
      display: flex;
      justify-content: space-between;
      justify-content: center;
      background: #f9f9f9;
    }

    .bb-top-menu-header {
      background: #f9f9f9;
      border-bottom: 1px solid #ddd;
      font-family: "Segoe UI", sans-serif;
      position: relative;
      z-index: 50;
    }

    .bb-nav {
      display: flex;
      justify-content: center;
    }

    .bb-nav-list {
      display: flex;
      list-style: none;
      gap: 20px;
      padding: 10px 0;
      margin-bottom: 0px;
    }

    .bb-nav-item {
      position: relative;
    }

    .bb-nav-link {
      text-decoration: none;
      color: #222;
      font-weight: 600;
      padding: 8px 12px;
      display: inline-block;
      transition: color 0.2s;
    }

    .bb-nav-link:hover {
      color: #c00;
    }

    /* ======= Dropdown ======= */
    /*.bb-dropdown {*/
    /*  position: absolute;*/
    /*  top: 100%;*/

    /*  min-width: 750px;*/
    /*  background: #fff;*/
    /*  border: 1px solid #ddd;*/
    /*  border-radius: 8px;*/
    /*  box-shadow: 0 5px 25px rgba(0,0,0,0.15);*/
    /*  display: none;*/
    /*  flex-direction: row;*/
    /*  opacity: 0;*/
    /*  transition: opacity 0.2s ease-in-out;*/
    /*}*/
    .bb-dropdown {
      position: absolute;
      top: 100%;
      min-width: 750px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);

      display: none;
      flex-direction: row;
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
      z-index: 9999;

      /* Default left-align */
      left: 0;
    }

    .bb-dropdown.centered {
      left: 50%;
      transform: translateX(-50%);
    }

    .bb-dropdown.show-left {
      right: 0;
      left: auto;
      transform: none;
    }



    .bb-nav-item:hover>.bb-dropdown {
      display: flex;
      opacity: 1;
    }

    /* Adjust dropdown so it doesn’t go off-screen */
    .bb-dropdown.show-left {
      right: 0;
      left: auto;
    }

    /* ======= Left Tabs ======= */
    .bb-tabs {
      width: 190px;
      border-right: 1px solid #eee;
      background: #fafafa;
      display: flex;
      flex-direction: column;
    }

    .bb-tab {
      padding: 12px 15px;
      font-weight: 500;
      color: #444;
      cursor: pointer;
      border-left: 3px solid transparent;
      transition: all 0.2s;
    }

    .bb-tab:hover {
      background: #f5f5f5;
    }

    .bb-tab.active {
      background: #fff;
      border-left: 3px solid #c00;
      color: #c00;
    }

    /* ======= Right Content ======= */
    .bb-tab-content {
      flex: 1;
      padding: 20px 25px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .bb-tab-pane {
      display: none;
    }

    .bb-tab-pane.active {
      display: block;
    }

    .tab-content-top-header {
      display: flex;
      gap: 25px;
    }

    .tab-content-section {
      flex: 1;
    }

    .tab-titles {
      white-space: nowrap;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #222;
    }

    .d-flex.flex-column a {
      white-space: nowrap;
      display: block;
      font-size: 13px;
      color: #555;
      text-decoration: none;
      margin: 3px 0;
    }

    .d-flex.flex-column a:hover {
      color: #c00;
    }

    .image-tab img {
      max-width: 180px;
      border-radius: 8px;
      object-fit: cover;
    }

    /*  .search-box-city input::placeholder {*/
    /*  color: #888;*/
    /*  font-size: 0.95rem;*/
    /*}*/

    /*.search-box-city input:focus {*/
    /*  background: #fff;*/
    /*  box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);*/
    /*}*/

    /*.search-box-city form {*/
    /*  transition: all 0.2s ease-in-out;*/
    /*}*/

    /*.search-box-city form:hover {*/
    /*  background: #fff;*/
    /*}*/
    .dropdown:hover .dropdown-menu {
      display: block;
      position: absolute;
      left: -60px;
    }

    .dropdown-menu {
      display: none;
    }

    /* Ensure dropdown stays open on hover */
    .dropdown:hover>.dropdown-toggle[aria-expanded="false"] {
      background-color: #f8f9fa;
    }

    /* Style for My Dashboard button */
    .dropdown-item.btn {
      padding: 8px 16px;
      margin: 5px 0;
      text-decoration: none;
    }

    /* Custom Dropdown Styling */
    .custom-dropdown {
      position: relative;
      z-index: 1050;
    }

    .custom-dropdown .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: auto;
      left: -100px !important;
      min-width: 200px;
      padding: 0;
      border: none;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      transform: translateX(0) !important;
      will-change: transform;
    }

    .custom-dropdown:hover .dropdown-menu {
      display: block;
    }

    .custom-dropdown .dropdown-toggle {
      background-color: transparent;
      border: none;
    }

    .custom-dropdown:hover .dropdown-toggle[aria-expanded="false"] {
      background-color: #f8f9fa;
      border-radius: 5px;
    }

    /* Support Dropdown Specific Styling */
    .custom-dropdown.support-dropdown .dropdown-menu {
      padding: 0;
    }

    .custom-dropdown.support-dropdown .dropdown-item-text {
      padding: 15px;
      text-align: center;
      background-color: #fff;
      border-radius: 5px;
    }

    .custom-dropdown.support-dropdown .dropdown-item-text h6 {
      font-size: 16px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .custom-dropdown.support-dropdown .dropdown-item-text button {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      font-size: 12px;
      padding: 5px 10px;
      border-color: #6c757d;
      color: #6c757d;
    }

    .custom-dropdown.support-dropdown .dropdown-item-text button:last-child {
      margin-bottom: 0;
    }

    .custom-dropdown.support-dropdown .dropdown-item-text button:hover {
      background-color: #e9ecef;
      border-color: #5a6268;
      color: #5a6268;
    }

    /* User Dropdown Specific Styling */
    .custom-dropdown.user-dropdown .dropdown-menu {
      padding: 20px;
      max-height: 500px;
      overflow-y: auto;
    }

    .custom-dropdown.user-dropdown .dropdown-item {
      padding: 8px 16px;
    }

    .custom-dropdown.user-dropdown .dropdown-item.btn {
      margin: 5px 0;
      text-decoration: none;
      background-color: #e38e32;
      border: none;
      color: #fff;
      border-radius: 5px;
      text-align: center;
    }

    .custom-dropdown.user-dropdown .dropdown-item.btn:hover {
      background-color: #d87a2a;
    }

    .custom-dropdown.user-dropdown .dropdown-divider {
      margin: 5px 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 576px) {
      .custom-dropdown .dropdown-menu {
        right: auto;
        left: auto;
        transform: none !important;
      }
    }

    /* Auto-adjust for right overflow */
    .custom-dropdown .dropdown-menu {
      visibility: hidden;
      /* Hide initially for calculation */
    }

    .custom-dropdown:hover .dropdown-menu {
      visibility: visible;
      /* Show on hover */
    }
  </style>
  <style>
    .offcanvas {
      /*  width: 300px !important;*/
      /*  background-color: #f8f9fa;*/
      /*}*/

      .offcanvas-header {
        background-color: #f9f9f9;
        border-bottom: 1px solid gray;
        /*color: #fff;*/
      }

      /*.offcanvas-title {*/
      /*  font-size: 1.25rem;*/
      /*  font-weight: 600;*/
      /*}*/

      .accordion-button {
        font-size: 1.1rem;
        font-weight: 500;
        background-color: #fff;
        color: #333;
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
      }

      .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #007bff;
      }

      .sub-accordion {
        font-size: 1rem;
        font-weight: 400;
        padding-left: 30px;
        background-color: #f1f3f5;
      }

      .sub-accordion:not(.collapsed) {
        background-color: #dee2e6;
      }

      .accordion-body {
        padding: 10px 20px;
      }

      .menu-section {
        margin-bottom: 20px;
      }

      .menu-section h4 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #007bff;
        margin-bottom: 10px;
      }

      .menu-section ul li {
        margin-bottom: 8px;
      }

      .menu-section ul li a {
        color: #333;
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.2s;
      }

      .menu-section ul li a:hover {
        color: #007bff;
      }

      .accordion-button::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
      }

      .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23007bff'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        transform: rotate(-180deg);
      }
  </style>

</head>

<body>
  <!-- Include jQuery and Bootstrap JS if not already included -->

  <div class="mobile-view">
    <div class="d-flex justify-content-between align-item-center p-2">
      <div class="d-flex align-items-center">
        <a class="navbar-brand me-3" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(asset('images/logoicon.png')); ?>" alt="Logo" style="height:55px;">
        </a>
      </div>

      <h3 class="m-0 d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
        aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-bars"></i></h3>
    </div>


  </div>


  <header class="main-header py-2 shadow-sm bg-white desktop-view">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- 🏠 Logo & Location -->
      <div class="d-flex align-items-center">
        <a class="navbar-brand me-3" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(asset('images/logoicon.png')); ?>" alt="Logo" style="height:55px;">
        </a>
      </div>

      <!-- ✨ Right Side Buttons -->
      <div class="d-flex align-items-center gap-3" style="width:auto;gap:20px;">
        <div class="location-navigate">
          <a href="javascript:void(0)" data-bs-toggle="modal" onclick="viewMoreCities()"
            class="btn btn-outline-dark fw-semibold">
            <i class="fas fa-map-marker-alt text-danger me-1"></i>
            <?php echo e(Cache::get('location-name') ?? 'Select City'); ?>

          </a>
        </div>

        <!-- 🏗️ Post Property -->
        <a href="<?php echo e(route('create_property')); ?>" class="btn text-white fw-semibold px-3 py-1 rounded-3"
          style="background:#e38e32; height:38px;">
          <i class="fas fa-pencil-alt me-1"></i> Post Property <span class="badge bg-warning text-dark ms-1">Free</span>
        </a>

        <!-- ☎️ Support -->
        <div class="dropdown custom-dropdown support-dropdown">
          <a href="#" class="btn btn-outline-dark fw-semibold" data-bs-toggle="dropdown" aria-expanded="false"
            style="height:38px; display:flex; align-items:center;">
            <i class="fas fa-headset"></i>
          </a>
          <ul class="dropdown-menu" style="left:-30px;">
            <li>
              <div class="dropdown-item-text">
                <h6 class="mb-1 text-start">CONTACT US</h6>

                <hr>
                <a href="" class=" mb-2 w-100 text-start"
                  style="font-size: 16px;margin-bottom:15px;text-decoration:none; ">
                  <span style="font-size: 11px; ">Work Hours | 9:30 AM to 6:30 PM</span><br>
                  <i class="fas fa-phone-alt me-2"></i> +91 9451591515
                </a>
                <hr>
                <button type="button" onclick="window.location='<?php echo e(route('front.contactUs')); ?>'"
                  class="btn btn-outline-secondary btn-sm w-100" style="font-size: 14px;">
                  <i class="fas fa-phone-alt me-2"></i> Request A Callback
                </button>

              </div>
            </li>
          </ul>
        </div>


        <!---->

        <?php if(auth()->guard()->check()): ?>
          <?php if(\Auth::user()->role == 'owner'): ?>
            <li>
              <a href="<?php echo e(url('user/dashboard')); ?>" class="btn btn-outline-dark fw-semibold" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="far fa-user-circle fs-4 me-1" style="font-size:18px;"></i>
                <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>

              </a>
            </li>
          <?php elseif(\Auth::user()->role == 'builder'): ?>

            <li>
              <a href="<?php echo e(url('builder/dashboard')); ?>" class="btn btn-outline-dark fw-semibold" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="far fa-user-circle fs-4 me-1" style="font-size:18px;"></i>
                <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>

              </a>
            </li>

          <?php elseif(\Auth::user()->role == 'agent'): ?>

            <li>
              <a href="<?php echo e(url('agent/dashboard')); ?>" class="btn btn-outline-dark fw-semibold" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="far fa-user-circle fs-4 me-1" style="font-size:18px;"></i>
                <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>

              </a>
            </li>

          <?php endif; ?>

        <?php endif; ?>
        <?php if(auth()->guard()->guest()): ?>
          <li style="list-style:none;"><a class="btn btn-outline-dark fw-semibold" href="#" data-target="#signin"
              data-toggle="modal"><i class="far fa-user"></i> Sign In</a></li>
        <?php endif; ?>
      </div>
    </div>

    <!-- 🌐 Mobile Menu -->
    <div class="d-lg-none bg-light py-2 border-top">
      <div class="container">
        <div class="d-flex justify-content-around">
          <a href="#" class="text-dark small">Buyers</a>
          <a href="#" class="text-dark small">Sellers</a>
          <a href="#" class="text-dark small">Owners</a>
          <a href="#" class="text-dark small">Agents</a>
          <a href="#" class="text-dark small">Builders</a>
        </div>
      </div>
    </div>
  </header>

  <?php
    use App\Helpers\Helper;
    $sellSubs = Helper::getSubSubcategoriesByCategoryName('Sell');
    $sellResidentil = $sellSubs['residential'];
    $sellCommercial = $sellSubs['commercial'];

    $rentSubs = Helper::getSubSubcategoriesByCategoryName('Sell');
    $rentResidentil = $rentSubs['residential'];
    $rentCommercial = $rentSubs['commercial'];

    $sellBudgets = [
      ['label' => 'Under 50 Lakh', 'query' => ['budget' => 'under-50-lakh']],
      ['label' => '50 Lakh - 1 CR', 'query' => ['budget' => '50-lakh-1-cr']],
      ['label' => '1 CR - 3 CR', 'query' => ['budget' => '1-cr-3-cr']],
      ['label' => '3 CR - 5 CR', 'query' => ['budget' => '3-cr-5-cr']],
      ['label' => '5 CR & Above', 'query' => ['budget' => 'above-5-cr']],
    ];

    $rentBudgets = [
      ['label' => 'Under 10K', 'query' => ['budget' => 'under-10k']],
      ['label' => '10,000 - 25,000', 'query' => ['budget' => '10k-25k']],
      ['label' => '25001 - 35,000', 'query' => ['budget' => '25k1-35k']],
      ['label' => '35,001 - 50,000', 'query' => ['budget' => '35k1-50k']],
      ['label' => '50,000 & Above', 'query' => ['budget' => 'above-50k']],
    ];

    use App\WebDirectoryCategory;
    use App\Properties;
    use App\Category;

    // Fetch categories with subcategories
    $webDirectoryCategories = WebDirectoryCategory::with('subcategories')->get();

    $exclusiveCategory = Category::where('category_name', 'Exclusive Launch')->first();

    // Get Residential and Commercial subcategories
    $subCategories = $exclusiveCategory ? $exclusiveCategory->Subcategory()->get() : collect();

  ?>


  <div class="bb-top-menu-header">
    <nav class="bb-nav">
      <ul class="bb-nav-list">
        <li class="bb-nav-item">
          <a href="#" class="bb-nav-link">For Buyers</a>
          <div class="bb-dropdown">
            <div class="bb-tabs">
              <div class="bb-tab active" data-tab="buyers-tab1">Residentials</div>
              <div class="bb-tab" data-tab="buyers-tab2">Commercial</div>
              <div class="bb-tab" data-tab="buyers-tab4">New Launch</div>
              <div class="bb-tab" data-tab="buyers-tab3">Popular Services</div>
            </div>
            <div class="bb-tab-content">
              <div class="bb-tab-pane active" id="buyers-tab1">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Properties</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $sellResidentil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>">
                          <?php echo e($subSubcat->sub_sub_category_name); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>

                  <div class="tab-content-section">
                    <h4 class="tab-titles">Budget</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                          href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 34], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Popular Choices</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'user_role' => 'owner'])); ?>">Owner
                        Properties</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'status' => 'verified'])); ?>">Verified
                        Properties</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Ready to Move'])); ?>">Ready
                        to
                        Move</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Possession Soon'])); ?>">Possession
                        Soon</a>
                      <a href="#">Immediate Available</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'furnishing_status' => 'Full Furnished'])); ?>">Full
                        Furnished</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'sort' => 'new-launch'])); ?>">New
                        Launch</a>
                    </div>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>

              <div class="bb-tab-pane" id="buyers-tab2">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Properties</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $sellCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>">
                          <?php echo e($subSubcat->sub_sub_category_name); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Budget</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                          href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 35], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Popular Choices</h4>

                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'user_role' => 'owner'])); ?>">Owner
                        Properties</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'status' => 'verified'])); ?>">Verified
                        Properties</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'property_status' => 'Ready to Move'])); ?>">Ready
                        to
                        Move</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'property_status' => 'Possession Soon'])); ?>">Possession
                        Soon</a>
                      <a href="#">Immediate Available</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'furnishing_status' => 'Full Furnished'])); ?>">Fully
                        Furnished</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'sort' => 'new-launch'])); ?>">New
                        Launch</a>
                    </div>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>

              <div class="bb-tab-pane" id="buyers-tab4">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">New Launch</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 34])); ?>">Residential Projects</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 35])); ?>">Commercial Projects</a>
                      <a href="<?php echo e(route('listing.list', ['sub_sub_category_ids' => '18,25,27'])); ?>">Land & Plots</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Budget</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                          href="<?php echo e(route('listing.list', array_merge(['category_id' => 22], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Popular Choices</h4>

                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'sort' => 'new-launch'])); ?>">New
                        Launch</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Under Construction'])); ?>">Under
                        Construction</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Ready to Move'])); ?>">Ready
                        to
                        Move</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Possession Soon'])); ?>">Possession
                        Soon</a>
                      <a href="#">OC Received</a>
                      <a href="#">RERA Registered</a>
                    </div>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>

              <div class="bb-tab-pane" id="buyers-tab3">
                <div class="tab-content-top-header">

                  <?php $__currentLoopData = $webDirectoryCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      // Only take popular subcategories
                      $popularSubs = $category->subcategories->where('is_popular', 1);
                      $showLimit = 5; // Number of subcategories to show initially
                    ?>

                    <?php if($popularSubs->count() > 0): ?>
                      <div class="tab-content-section">
                        <h4 class="tab-titles"><?php echo e($category->category_name); ?></h4>
                        <div class="d-flex flex-column">
                          <?php $__currentLoopData = $popularSubs->take($showLimit); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('directory.list', ['subcategory' => $sub->id])); ?>">
                              <?php echo e($sub->sub_category_name); ?>

                            </a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          <?php if($popularSubs->count() > $showLimit): ?>
                            <div class="more-subcategories" style="display:none;">
                              <?php $__currentLoopData = $popularSubs->slice($showLimit); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('directory.list', ['subcategory' => $sub->id])); ?>">
                                  <?php echo e($sub->sub_category_name); ?>

                                </a>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <a href="javascript:void(0);" class="view-more"
                              onclick="this.previousElementSibling.style.display='block'; this.style.display='none';">
                              View More
                            </a>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>


            </div>
          </div>
        </li>

        <li class="bb-nav-item">
          <a href="#" class="bb-nav-link">For Sellers</a>
          <div class="bb-dropdown">
            <div class="bb-tabs">
              <div class="bb-tab active" data-tab="sellers-tab1">Owners</div>
              <div class="bb-tab" data-tab="sellers-tab2">Agents</div>
              <div class="bb-tab" data-tab="sellers-tab3">Builders</div>
              <div class="bb-tab" data-tab="sellers-tab4">Service Providers</div>
            </div>
            <div class="bb-tab-content">
              <div class="bb-tab-pane active" id="sellers-tab1">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Services</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('create_property')); ?>">Post Property</a>
                      <a href="#">Join BB Prime</a>
                      <a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                        <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                        Dashboard
                      </a>
                      <a href="#">Enquiries</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Important Links</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('front.faq')); ?>">FAQ</a>
                      <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Contact Us</h4>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
              <div class="bb-tab-pane" id="sellers-tab2">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Services</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('create_property')); ?>">Post Property</a>
                      <a href="#">Join BB Prime</a>
                      <a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                        <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                        Dashboard
                      </a>

                      <a href="#">Enquiries</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Important Links</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('front.faq')); ?>">FAQ</a>
                      <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Contact Us</h4>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
              <div class="bb-tab-pane" id="sellers-tab3">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Services</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('create_property')); ?>">Post Property</a>
                      <a href="#">Join BB Prime</a>
                      <a href="">Dashboard</a>
                      <a href="#">Enquiries</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Important Links</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('front.faq')); ?>">FAQ</a>
                      <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Contact Us</h4>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
              <div class="bb-tab-pane" id="sellers-tab4">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Start Selling</h4>
                    <div class="d-flex flex-column">
                      <a href="#">List Your Service</a>
                      <a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                        <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                        Dashboard
                      </a>

                      <a href="#">Check Enquiries</a>
                      <a href="#">Join BB Prime</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Important Links</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('front.faq')); ?>">FAQ</a>
                      <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Contact Us</h4>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="bb-nav-item">
          <a href="#" class="bb-nav-link">For Rent</a>
          <div class="bb-dropdown">
            <div class="bb-tabs">
              <div class="bb-tab active" data-tab="rent-tab1">Residential</div>
              <div class="bb-tab" data-tab="rent-tab2">Commercial</div>
              <div class="bb-tab" data-tab="rent-tab3">Popular Services</div>
            </div>
            <div class="bb-tab-content">
              <div class="bb-tab-pane active" id="rent-tab1">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Properties</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $rentResidentil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>">
                          <?php echo e($subSubcat->sub_sub_category_name); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Budget</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $rentBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a
                          href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 38], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Popular Choise</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 38, 'user_role' => 'owner'])); ?>">Owner
                        Properties</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 38, 'status' => 'verified'])); ?>">Verified
                        Properties</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 38, 'property_status' => 'Ready to Move'])); ?>">Ready
                        to
                        Move</a>
                      <a href="#">Immediate Available</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 38, 'furnishing_status' => 'Full Furnished'])); ?>">Full
                        Furnished</a>
                    </div>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
              <div class="bb-tab-pane" id="rent-tab2">
                <div class="tab-content-top-header">
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Properties</h4>
                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $rentCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>">
                          <?php echo e($subSubcat->sub_sub_category_name); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Budget</h4>


                    <div class="d-flex flex-column">
                      <?php $__currentLoopData = $rentBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 37], $budget['query']))); ?>">
                          <?php echo e($budget['label']); ?>

                        </a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                  </div>
                  <div class="tab-content-section">
                    <h4 class="tab-titles">Popular Choise</h4>
                    <div class="d-flex flex-column">
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 37, 'user_role' => 'owner'])); ?>">Owner
                        Properties</a>
                      <a href="<?php echo e(route('listing.list', ['sub_category_id' => 37, 'status' => 'verified'])); ?>">Verified
                        Properties</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 37, 'property_status' => 'Ready to Move'])); ?>">Ready
                        to
                        Move</a>
                      <a href="#">Immediate Available</a>
                      <a
                        href="<?php echo e(route('listing.list', ['sub_category_id' => 37, 'furnishing_status' => 'Full Furnished'])); ?>">Full
                        Furnished</a>
                    </div>
                  </div>
                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
              <div class="bb-tab-pane" id="rent-tab3">
                <div class="tab-content-top-header">

                  <?php $__currentLoopData = $webDirectoryCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      // Only take popular subcategories
                      $popularSubs = $category->subcategories->where('is_popular', 1);
                      $showLimit = 5; // Number of subcategories to show initially
                    ?>

                    <?php if($popularSubs->count() > 0): ?>
                      <div class="tab-content-section">
                        <h4 class="tab-titles"><?php echo e($category->category_name); ?></h4>
                        <div class="d-flex flex-column">
                          <?php $__currentLoopData = $popularSubs->take($showLimit); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('directory.list', ['subcategory' => $sub->id])); ?>">
                              <?php echo e($sub->sub_category_name); ?>

                            </a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          <?php if($popularSubs->count() > $showLimit): ?>
                            <div class="more-subcategories" style="display:none;">
                              <?php $__currentLoopData = $popularSubs->slice($showLimit); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('directory.list', ['subcategory' => $sub->id])); ?>">
                                  <?php echo e($sub->sub_category_name); ?>

                                </a>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <a href="javascript:void(0);" class="view-more"
                              onclick="this.previousElementSibling.style.display='block'; this.style.display='none';">
                              View More
                            </a>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <div class="image-tab">
                    <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>


        <li class="bb-nav-item">
          <a href="#" class="bb-nav-link">Directory & Services</a>
          <div class="bb-dropdown">
            <div class="bb-tabs">
              <?php $__currentLoopData = $webDirectoryCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bb-tab <?php echo e($index == 0 ? 'active' : ''); ?>" data-tab="tab<?php echo e($category->id); ?>">
                  <?php echo e($category->category_name); ?>

                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="bb-tab-content">
              <?php $__currentLoopData = $webDirectoryCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bb-tab-pane <?php echo e($index == 0 ? 'active' : ''); ?>" id="tab<?php echo e($category->id); ?>">
                  <div class="tab-content-top-header">
                    <div class="tab-content-section">
                      <h4 class="tab-titles">Sub Categories</h4>
                      <div class="d-flex flex-column">
                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <a href="<?php echo e(route('directory.list', ['subcategory' => $sub->id])); ?>">
                            <?php echo e($sub->sub_category_name); ?>

                          </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                    <div class="image-tab">
                      <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png">
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </li>


        <?php if($subCategories->count()): ?>
          <li class="bb-nav-item">
            <a href="#" class="bb-nav-link">Exclusive Launch</a>
            <div class="bb-dropdown">
              <div class="bb-tabs">
                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="bb-tab <?php echo e($index == 0 ? 'active' : ''); ?>" data-tab="exclusive-tab<?php echo e($subCat->id); ?>">
                    <?php echo e($subCat->sub_category_name); ?>

                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <div class="bb-tab-content">
                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="bb-tab-pane <?php echo e($index == 0 ? 'active' : ''); ?>" id="exclusive-tab<?php echo e($subCat->id); ?>">
                    <div class="tab-content-top-header">
                      <div class="tab-content-section">
                        <h4 class="tab-titles">Projects</h4>
                        <div class="d-flex flex-column">
                          <?php
                            // Get all properties in this subcategory
                            $properties = Properties::where('category_id', $exclusiveCategory->id)
                              ->where('sub_category_id', $subCat->id)
                              ->where('approval', 'Approved')
                              ->where('publish_status', 'Publish')
                              ->get();
                          ?>

                          <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('property.show', $property->id)); ?>">
                              <?php echo e($property->title); ?>

                            </a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span class="text-muted">No properties available</span>
                          <?php endif; ?>
                        </div>
                      </div>

                      <div class="tab-content-section">
                        <h4 class="tab-titles">Budget</h4>
                        <div class="d-flex flex-column">
                          <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a
                              href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => $subCat->id], $budget['query']))); ?>">
                              <?php echo e($budget['label']); ?>

                            </a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>

                      <div class="image-tab">
                        <img src="https://www.99acres.com/universalapp/img/hp_ppf_banner.png"
                          alt="<?php echo e($subCat->sub_category_name); ?>">
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </li>
        <?php endif; ?>

      </ul>
    </nav>
  </div>


  <!-- Offcanvas Menu -->
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <div class="accordion" id="mobileMenuAccordion">
        <!-- For Buyers -->
        <div class="accordion-item border-0">
          <h2 class="accordion-header" id="buyersHeading">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#buyersCollapse"
              aria-expanded="true" aria-controls="buyersCollapse">
              For Buyers
            </button>
          </h2>
          <div id="buyersCollapse" class="accordion-collapse collapse show" aria-labelledby="buyersHeading"
            data-bs-parent="#mobileMenuAccordion">
            <div class="accordion-body p-0">
              <div class="accordion" id="buyersSubAccordion">
                <!-- Residential -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="buyersResidentialHeading">
                    <button class="accordion-button sub-accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#buyersResidentialCollapse" aria-expanded="true"
                      aria-controls="buyersResidentialCollapse">
                      Residential
                    </button>
                  </h3>
                  <div id="buyersResidentialCollapse" class="accordion-collapse collapse show"
                    aria-labelledby="buyersResidentialHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $sellResidentil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>"><?php echo e($subSubcat->sub_sub_category_name); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 34], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'user_role' => 'owner'])); ?>">Owner
                              Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Ready to Move'])); ?>">Ready
                              to Move</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Possession Soon'])); ?>">Possession
                              Soon</a></li>
                          <li><a href="#">Immediate Available</a></li>
                          <li><a href="#">Fully Furnished</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'sort' => 'new-launch'])); ?>">New
                              Launch</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Commercial -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="buyersCommercialHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#buyersCommercialCollapse" aria-expanded="false"
                      aria-controls="buyersCommercialCollapse">
                      Commercial
                    </button>
                  </h3>
                  <div id="buyersCommercialCollapse" class="accordion-collapse collapse"
                    aria-labelledby="buyersCommercialHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $sellCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>"><?php echo e($subSubcat->sub_sub_category_name); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 35], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'user_role' => 'owner'])); ?>">Owner
                              Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'property_status' => 'Ready to Move'])); ?>">Ready
                              to Move</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'property_status' => 'Possession Soon'])); ?>">Possession
                              Soon</a></li>
                          <li><a href="#">Immediate Available</a></li>
                          <li><a href="#">Fully Furnished</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 35, 'sort' => 'new-launch'])); ?>">New
                              Launch</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- New Launch -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="buyersNewLaunchHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#buyersNewLaunchCollapse" aria-expanded="false"
                      aria-controls="buyersNewLaunchCollapse">
                      New Launch
                    </button>
                  </h3>
                  <div id="buyersNewLaunchCollapse" class="accordion-collapse collapse"
                    aria-labelledby="buyersNewLaunchHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>New Launch</h4>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo e(route('listing.list', ['sub_category_id' => 34])); ?>">Residential Projects</a>
                          </li>
                          <li><a href="<?php echo e(route('listing.list', ['sub_category_id' => 35])); ?>">Commercial Projects</a>
                          </li>
                          <li><a href="<?php echo e(route('listing.list', ['sub_sub_category_ids' => '18,25,27'])); ?>">Land &
                              Plots</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $sellBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', array_merge(['category_id' => 22], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'sort' => 'new-launch'])); ?>">New
                              Launch</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Under Construction'])); ?>">Under
                              Construction</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Ready to Move'])); ?>">Ready
                              to Move</a></li>
                          <li><a
                              href="<?php echo e(route('listing.list', ['sub_category_id' => 34, 'property_status' => 'Possession Soon'])); ?>">Possession
                              Soon</a></li>
                          <li><a href="#">OC Received</a></li>
                          <li><a href="#">RERA Registered</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Popular Services -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="buyersPopularServicesHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#buyersPopularServicesCollapse" aria-expanded="false"
                      aria-controls="buyersPopularServicesCollapse">
                      Popular Services
                    </button>
                  </h3>
                  <div id="buyersPopularServicesCollapse" class="accordion-collapse collapse"
                    aria-labelledby="buyersPopularServicesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Most Viewed</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Locations</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Owner Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- For Sellers -->
        <div class="accordion-item border-0">
          <h2 class="accordion-header" id="sellersHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#sellersCollapse" aria-expanded="false" aria-controls="sellersCollapse">
              For Sellers
            </button>
          </h2>
          <div id="sellersCollapse" class="accordion-collapse collapse" aria-labelledby="sellersHeading"
            data-bs-parent="#mobileMenuAccordion">
            <div class="accordion-body p-0">
              <div class="accordion" id="sellersSubAccordion">
                <!-- Owners -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="sellersOwnersHeading">
                    <button class="accordion-button sub-accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#sellersOwnersCollapse" aria-expanded="true"
                      aria-controls="sellersOwnersCollapse">
                      Owners
                    </button>
                  </h3>
                  <div id="sellersOwnersCollapse" class="accordion-collapse collapse show"
                    aria-labelledby="sellersOwnersHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Services</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Post Property</a></li>
                          <li><a href="#">Join BB Prime</a></li>
                          <li><a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                              <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                              Dashboard
                            </a>
                          </li>
                          <li><a href="#">Enquiries</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
                          <li> <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Agents -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="sellersAgentsHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#sellersAgentsCollapse" aria-expanded="false"
                      aria-controls="sellersAgentsCollapse">
                      Agents
                    </button>
                  </h3>
                  <div id="sellersAgentsCollapse" class="accordion-collapse collapse"
                    aria-labelledby="sellersAgentsHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Services</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Post Property</a></li>
                          <li><a href="#">Join BB Prime</a></li>
                          <li><a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                              <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                              Dashboard
                            </a>
                          </li>
                          <li><a href="#">Enquiries</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
                          <li> <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Builders -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="sellersBuildersHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#sellersBuildersCollapse" aria-expanded="false"
                      aria-controls="sellersBuildersCollapse">
                      Builders
                    </button>
                  </h3>
                  <div id="sellersBuildersCollapse" class="accordion-collapse collapse"
                    aria-labelledby="sellersBuildersHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Services</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Post Property</a></li>
                          <li><a href="#">Join BB Prime</a></li>
                          <li><a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                              <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                              Dashboard
                            </a>
                          </li>
                          <li><a href="#">Enquiries</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
                          <li> <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Service Providers -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="sellersServiceProvidersHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#sellersServiceProvidersCollapse" aria-expanded="false"
                      aria-controls="sellersServiceProvidersCollapse">
                      Service Providers
                    </button>
                  </h3>
                  <div id="sellersServiceProvidersCollapse" class="accordion-collapse collapse"
                    aria-labelledby="sellersServiceProvidersHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Start Selling</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">List Your Service</a></li>
                          <li><a href="<?php echo e(auth()->check() ? route('user.dashboard') : 'javascript:void(0)'); ?>"
                              <?php if (! (auth()->check())): ?> onclick="openSigninModal()" <?php endif; ?>>
                              Dashboard
                            </a>
                          </li>
                          <li><a href="#">Check Enquiries</a></li>
                          <li><a href="#">Join BB Prime</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Important Links</h4>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
                          <li> <a href="<?php echo e(route('front.blog')); ?>">Articles & Blogs</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- For Rent -->
        <div class="accordion-item border-0">
          <h2 class="accordion-header" id="rentHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#rentCollapse" aria-expanded="false" aria-controls="rentCollapse">
              For Rent
            </button>
          </h2>
          <div id="rentCollapse" class="accordion-collapse collapse" aria-labelledby="rentHeading"
            data-bs-parent="#mobileMenuAccordion">
            <div class="accordion-body p-0">
              <div class="accordion" id="rentSubAccordion">
                <!-- Residential -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="rentResidentialHeading">
                    <button class="accordion-button sub-accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#rentResidentialCollapse" aria-expanded="true"
                      aria-controls="rentResidentialCollapse">
                      Residential
                    </button>
                  </h3>
                  <div id="rentResidentialCollapse" class="accordion-collapse collapse show"
                    aria-labelledby="rentResidentialHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $rentResidentil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>"><?php echo e($subSubcat->sub_sub_category_name); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $rentBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 38], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Ready to Move</a></li>
                          <li><a href="#">Immediate Available</a></li>
                          <li><a href="#">Fully Furnished</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Commercial -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="rentCommercialHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#rentCommercialCollapse" aria-expanded="false"
                      aria-controls="rentCommercialCollapse">
                      Commercial
                    </button>
                  </h3>
                  <div id="rentCommercialCollapse" class="accordion-collapse collapse"
                    aria-labelledby="rentCommercialHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $rentCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', ['sub_sub_category_id' => $subSubcat->id])); ?>"><?php echo e($subSubcat->sub_sub_category_name); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $rentBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a
                                href="<?php echo e(route('listing.list', array_merge(['sub_category_id' => 37], $budget['query']))); ?>"><?php echo e($budget['label']); ?></a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Ready to Move</a></li>
                          <li><a href="#">Immediate Available</a></li>
                          <li><a href="#">Fully Furnished</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Popular Services -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="rentPopularServicesHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#rentPopularServicesCollapse" aria-expanded="false"
                      aria-controls="rentPopularServicesCollapse">
                      Popular Services
                    </button>
                  </h3>
                  <div id="rentPopularServicesCollapse" class="accordion-collapse collapse"
                    aria-labelledby="rentPopularServicesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Budget</h4>
                        <ul class="list-unstyled">
                          <?php $__currentLoopData = $rentBudgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('listing.list', $budget['query'])); ?>"><?php echo e($budget['label']); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <div class="menu-section">
                        <h4>Popular Choices</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Ready to Move</a></li>
                          <li><a href="#">Immediate Available</a></li>
                          <li><a href="#">Fully Furnished</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Directory & Services -->
        <div class="accordion-item border-0">
          <h2 class="accordion-header" id="directoryHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#directoryCollapse" aria-expanded="false" aria-controls="directoryCollapse">
              Directory & Services
            </button>
          </h2>
          <div id="directoryCollapse" class="accordion-collapse collapse" aria-labelledby="directoryHeading"
            data-bs-parent="#mobileMenuAccordion">
            <div class="accordion-body p-0">
              <div class="accordion" id="directorySubAccordion">
                <!-- Popular Choices -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="directoryPopularChoicesHeading">
                    <button class="accordion-button sub-accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#directoryPopularChoicesCollapse" aria-expanded="true"
                      aria-controls="directoryPopularChoicesCollapse">
                      Popular Choices
                    </button>
                  </h3>
                  <div id="directoryPopularChoicesCollapse" class="accordion-collapse collapse show"
                    aria-labelledby="directoryPopularChoicesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Property Types -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="directoryPropertyTypesHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#directoryPropertyTypesCollapse" aria-expanded="false"
                      aria-controls="directoryPropertyTypesCollapse">
                      Property Types
                    </button>
                  </h3>
                  <div id="directoryPropertyTypesCollapse" class="accordion-collapse collapse"
                    aria-labelledby="directoryPropertyTypesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Budget -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="directoryBudgetHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#directoryBudgetCollapse" aria-expanded="false"
                      aria-controls="directoryBudgetCollapse">
                      Budget
                    </button>
                  </h3>
                  <div id="directoryBudgetCollapse" class="accordion-collapse collapse"
                    aria-labelledby="directoryBudgetHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Explore -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="directoryExploreHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#directoryExploreCollapse" aria-expanded="false"
                      aria-controls="directoryExploreCollapse">
                      Explore
                    </button>
                  </h3>
                  <div id="directoryExploreCollapse" class="accordion-collapse collapse"
                    aria-labelledby="directoryExploreHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Exclusive Launch -->
        <div class="accordion-item border-0">
          <h2 class="accordion-header" id="exclusiveLaunchHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#exclusiveLaunchCollapse" aria-expanded="false" aria-controls="exclusiveLaunchCollapse">
              Exclusive Launch
            </button>
          </h2>
          <div id="exclusiveLaunchCollapse" class="accordion-collapse collapse" aria-labelledby="exclusiveLaunchHeading"
            data-bs-parent="#mobileMenuAccordion">
            <div class="accordion-body p-0">
              <div class="accordion" id="exclusiveLaunchSubAccordion">
                <!-- Popular Choices -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="exclusivePopularChoicesHeading">
                    <button class="accordion-button sub-accordion" type="button" data-bs-toggle="collapse"
                      data-bs-target="#exclusivePopularChoicesCollapse" aria-expanded="true"
                      aria-controls="exclusivePopularChoicesCollapse">
                      Popular Choices
                    </button>
                  </h3>
                  <div id="exclusivePopularChoicesCollapse" class="accordion-collapse collapse show"
                    aria-labelledby="exclusivePopularChoicesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Property Types -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="exclusivePropertyTypesHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#exclusivePropertyTypesCollapse" aria-expanded="false"
                      aria-controls="exclusivePropertyTypesCollapse">
                      Property Types
                    </button>
                  </h3>
                  <div id="exclusivePropertyTypesCollapse" class="accordion-collapse collapse"
                    aria-labelledby="exclusivePropertyTypesHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Budget -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="exclusiveBudgetHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#exclusiveBudgetCollapse" aria-expanded="false"
                      aria-controls="exclusiveBudgetCollapse">
                      Budget
                    </button>
                  </h3>
                  <div id="exclusiveBudgetCollapse" class="accordion-collapse collapse"
                    aria-labelledby="exclusiveBudgetHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Explore -->
                <div class="accordion-item border-0">
                  <h3 class="accordion-header" id="exclusiveExploreHeading">
                    <button class="accordion-button sub-accordion collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#exclusiveExploreCollapse" aria-expanded="false"
                      aria-controls="exclusiveExploreCollapse">
                      Explore
                    </button>
                  </h3>
                  <div id="exclusiveExploreCollapse" class="accordion-collapse collapse"
                    aria-labelledby="exclusiveExploreHeading">
                    <div class="accordion-body">
                      <div class="menu-section">
                        <h4>Properties</h4>
                        <ul class="list-unstyled">
                          <li><a href="#">Owner Properties</a></li>
                          <li><a href="#">Verified Properties</a></li>
                          <li><a href="#">Furnished Homes</a></li>
                          <li><a href="#">Bachelor Friendly</a></li>
                          <li><a href="#">Immediately Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Custom CSS -->


  <!-- JavaScript for Bootstrap (Ensure Bootstrap JS is included) -->
  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

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

  <?php if(count($errors) > 0): ?>
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


  <div class="modal fade custom-modal" id="contact-agent" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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
                    <input type="text" class="text-control" placeholder="Enter Name" name="name"
                      value="<?php echo e(Auth::check() ? Auth::user()->firstname : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?>

                      required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Email</label>
                    <input type="email" class="text-control" placeholder="Enter Email" name="email"
                      value="<?php echo e(Auth::check() ? Auth::user()->email : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?>

                      required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Mobile No.</label>
                    <input type="number" class="text-control" placeholder="Enter Mobile No." name="mobile_number"
                      value="<?php echo e(Auth::check() ? Auth::user()->mobile_number : ''); ?>" <?php echo e(Auth::check() ? "readonly" : ""); ?>

                      required />
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
                    <button type="submit" class="btn btn-send w-100">Send Enquiry <i
                        class="fas fa-chevron-circle-right"></i></button>
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

  <div class="modal fade custom-modal" id="claim-listing" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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
                    <a class="nav-link active" id="verifybyemail-tab" data-toggle="tab" href="#verifybyemail" role="tab"
                      aria-controls="verifybyemail" aria-selected="true" onclick="resetField('email')">Verify with
                      Email</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="verifybycontact-tab" data-toggle="tab" href="#verifybycontact" role="tab"
                      aria-controls="verifybycontact" aria-selected="false" onclick="resetField('mobile')">Verify with
                      Contact</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="verifybyemail" role="tabpanel"
                    aria-labelledby="verifybyemail-tab">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label class="label-control mask_email"> </label>
                        <input type="email" id="verify_by_email" class="text-control"
                          placeholder="Enter Email for Verify" name="email" required />
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="verifybycontact" role="tabpanel" aria-labelledby="verifybycontact-tab">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label class="label-control mask_number">Mobile No. (87xxxxxxxx)</label>

                        <input type="number" id="verify_by_phone" class="text-control"
                          placeholder="Enter Mobile No. for Verify" name="mobile_number" required />

                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-send w-100 claim_listing_btn" onclick="claimListing();">Send
                        OTP <i class="fas fa-chevron-circle-right"></i></button>
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

  <div class="modal fade custom-modal" id="verifyemail" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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
                  <input type="number" id="verify_otp" class="text-control" name="otp" placeholder="Enter OTP"
                    required />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-send w-100 claim_listing_btn"
                    onclick="verifyOTPForClaim();">Claim Your Listing <i
                      class="fas fa-chevron-circle-right"></i></button>
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

  <div class="modal fade custom-modal" id="signin" tabindex="-1" role="dialog" aria-labelledby="signin"
    aria-hidden="true">
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
                <div class="custom-mode-l"
                  style="position: relative; height: 100%; min-height: 400px; background-image: url('https://img.freepik.com/free-photo/construction-concept-with-engineering-tools_1150-17809.jpg'); background-size: cover; background-position: center; border-radius: 10px; overflow: hidden;display: flex;align-items: center; justify-content: center;">
                  <div
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                  </div>
                  <div
                    style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center; justify-content: center; color: white; text-align: center; padding: 20px;">
                    <div>
                      <a href="#">
                        <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 15px; color: #fff;">
                          ParhitProperty</h3>
                      </a>
                      <!--<img src="<?php echo e(asset('')); ?>images/house.png" class="img-fluid" style="max-width: 150px; margin-bottom: 15px;">-->
                      <p style="font-size: 1.2rem; line-height: 1.6; color: #f0f0f0;">Find the best matches for
                        you<br />Make the most of high seller scores<br />Experience a joyful journey</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row login-heads">
                  <div class="col-sm-12">
                    <h3 class="heads-login">Login</h3>
                    <span class="allrequired">All field are required</span>
                  </div>
                </div>
                <!--<center class="modal_loading">-->
                <!--    <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="loading" style="height: 30px;" />-->
                <!--</center>-->
                <div class="modal-form">
                  <div class="google-signin">
                    <img src="<?php echo e(asset('images/google.png')); ?>" style="height: 20px;" />
                    <p>Signin with Google</p>

                  </div>
                  <div class="devide-or">
                    <div class="horz-line"> </div>
                    <h4>OR</h4>
                    <div class="horz-line"> </div>

                  </div>
                  <form id="login_form" name="login_form">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label class="label-control">Email / Mobile No.</label>
                        <input type="text" class="text-control" placeholder="Enter Email / Mobile No." name="email"
                          id="login-email" required />
                        <span class="loginwotp" id="login-type-otp"><a style="cursor: pointer;"
                            onclick="loginType('otp')">Login with OTP</a></span>
                        <span class="loginwotp" id="login-type-password"><a style="cursor: pointer;"
                            onclick="loginType('password')">Login with Password</a></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12" id="view-password">
                        <label class="label-control">Password</label>
                        <input type="password" class="text-control" placeholder="Enter Password" id="password"
                          name="password" required />
                        <a href="#" data-target="#forgot-password" data-toggle="modal" data-dismiss="modal"
                          class="forgotpass">Forgot Password ?</a>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12" id="view-otp">
                        <label class="label-control">OTP</label>
                        <input type="number" class="text-control" placeholder="Enter OTP" id="otp" name="otp"
                          required />
                        <a href="#" data-target="#forgot-password" data-toggle="modal" data-dismiss="modal"
                          class="forgotpass">Forgot Password ?</a>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 text-center" id="check-login">
                        <button type="submit" class="btn btn-send w-100">Login <i
                            class="fas fa-chevron-circle-right"></i></button>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 text-center" id="check-otp">
                        <button type="button" class="btn btn-send w-100" onclick="sendLoginOtp()">Send OTP <i
                            class="fas fa-chevron-circle-right"></i></button>
                      </div>
                    </div>
                    <?php echo csrf_field(); ?>
                  </form>
                  <!--<div class="form-group row">-->
                  <!--    <div class="col-sm-12">-->
                  <!--        <span class="or-span">OR</span>-->
                  <!--    </div>-->
                  <!--    <div class="col-sm-6 mt-2">-->
                  <!--        <a href="<?php echo e(url('login')); ?>/facebook">-->
                  <!--            <img src="<?php echo e(asset('')); ?>images/loginwithfb.png" class="img-fluid">-->
                  <!--        </a>-->
                  <!--    </div>-->
                  <!--    <div class="col-sm-6 mt-2">-->
                  <!--        <a href="<?php echo e(url('login')); ?>/google">-->
                  <!--            <img src="<?php echo e(asset('')); ?>images/loginwithg.png" class="img-fluid">-->
                  <!--        </a>-->
                  <!--    </div>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-foo text-center">
          <p>Don't have account? <a href="#" data-target="#register" data-toggle="modal" data-dismiss="modal">Create an
              Account</a></p>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade custom-modal" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="signin"
    aria-hidden="true">
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
                    <input type="number" class="text-control" placeholder="Enter Registered Mobile No."
                      name="mobile_number" required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-send w-100">Proceed to OTP <i
                        class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-foo text-center">
          <p>New User? <a href="#" data-target="#register" data-toggle="modal" data-dismiss="modal">Register
              Now</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade custom-modal" id="register" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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

                  <p>Find the best matches for you<br /> Make the most of high seller
                    scores<br />Experience a joyful journey</p>
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
                          <li><label><input type="radio" checked name="owner_type" value="1">
                              Owner</label></li>
                          <li><label><input type="radio" name="owner_type" value="2">
                              Builder</label></li>
                          <li><label><input type="radio" name="owner_type" value="3">
                              Agent</label></li>
                        </ul>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="label-control">First Name</label>
                        <input type="text" class="text-control" placeholder="First Name" name="firstname" required />
                      </div>
                      <div class="col-sm-6">
                        <label class="label-control">Last Name</label>
                        <input type="text" class="text-control" placeholder="Last Name" name="lastname" required />
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="label-control">Email</label>
                        <input type="text" class="text-control" placeholder="Enter Email" name="email" required />
                      </div>
                      <div class="col-sm-6">
                        <label class="label-control">Mobile No.</label>
                        <input type="number" class="text-control" placeholder="Enter Mobile No." name="mobile_number"
                          required />
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="label-control">State</label>
                        <select class="text-control" name="state_id"
                          onchange="loadCities(this.value, 'register_modal_city_id');" required>
                          <?php
                            $states = \App\State::all();
                          ?>
                          <?php if(count($states) < 1): ?>
                            <option value="">No records found</option>
                          <?php else: ?>
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <input type="password" class="text-control" placeholder="Enter Password" id="reg_password"
                          name="password" required />
                      </div>
                      <div class="col-sm-6">
                        <label class="label-control">Confirm Password</label>
                        <input type="password" class="text-control" placeholder="Re-enter Password"
                          name="confirm_password" required />
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-send w-100">Proceed to OTP <i
                            class="fas fa-chevron-circle-right"></i></button>
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
          <p>Already Registered? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Login
              Now</a>
          </p>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade custom-modal" id="otpmodal" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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
                    <button type="submit" class="btn btn-send w-100">Proceed to OTP <i
                        class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-foo text-center">
          <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend
              OTP</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade custom-modal" id="forgototp" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
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
                    <input type="password" class="text-control" placeholder="Enter New Password" id="new_password"
                      name="new_password" required />
                  </div>
                  <div class="col-sm-6">
                    <label class="label-control">Re-Enter Password</label>
                    <input type="password" class="text-control" placeholder="Re-enter Password"
                      name="confirm_new_password" id="confirm_new_password" required />
                  </div>
                </div>

                <input type="hidden" name="user_id" class="user_id" />

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-send w-100">Reset Password <i
                        class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-foo text-center">
          <p>Not Received? <a href="#" data-target="#signin" data-toggle="modal" data-dismiss="modal">Resend
              OTP</a>
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
              <li><a href="<?php echo e(route('front.faq')); ?>">FAQ</a></li>
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
                $media = App\SocialMedia::first();
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
            <hr />
            <p class="disclaimer-p">Disclaimer: <?php echo e($footer_content->description); ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p>Copyright &copy; 2025, Bhawan Bhoomi. All Right Reserved | Design &amp; Developed By <a href="#">Web
                Mingo IT Solutions Pvt. Ltd.</a>
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

  function openSigninModal() {
    // Example: if using Bootstrap modal
    $('#signin').modal('show');

    // Or if using a custom modal system
    // document.getElementById('signinModal').classList.add('open');
  }


  $(document).ready(function () {
    // Fallback to close modal if needed (from previous context)
    $('.close').on('click', function () {
      $('#location-list').modal('hide');
    });

    // Ensure dropdowns work on hover and adjust position
    $('.dropdown').hover(
      function () {
        const $dropdown = $(this).find('.dropdown-menu');
        $dropdown.stop(true, true).fadeIn(200);
        $(this).find('.dropdown-toggle').attr('aria-expanded', 'true');

        // Adjust position if overflowing
        const dropdownWidth = $dropdown.outerWidth();
        const toggleOffset = $(this).offset();
        const viewportWidth = $(window).width();

        if (toggleOffset.left + dropdownWidth > viewportWidth) {
          $dropdown.removeClass('dropdown-menu-end').addClass('dropdown-menu-start').css({
            right: 'auto',
            left: 0
          });
        }
      },
      function () {
        $(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
        $(this).find('.dropdown-toggle').attr('aria-expanded', 'false');
      }
    );
  });
</script>

<script>
  // TAB SWITCHING
  document.querySelectorAll(".bb-dropdown").forEach(dropdown => {
    const tabs = dropdown.querySelectorAll(".bb-tab");
    const panes = dropdown.querySelectorAll(".bb-tab-pane");

    tabs.forEach(tab => {
      tab.addEventListener("mouseenter", () => {
        tabs.forEach(t => t.classList.remove("active"));
        panes.forEach(p => p.classList.remove("active"));

        tab.classList.add("active");
        const target = dropdown.querySelector("#" + tab.dataset.tab);
        if (target) target.classList.add("active");
      });
    });
  });

  document.querySelectorAll(".bb-nav-item").forEach(item => {
    item.addEventListener("mouseenter", () => {
      const dropdown = item.querySelector(".bb-dropdown");
      if (!dropdown) return;

      // Reset
      dropdown.classList.remove("show-left", "centered");

      const rect = dropdown.getBoundingClientRect();
      const rightSpace = window.innerWidth - rect.left - dropdown.offsetWidth;

      // If menu item is roughly center of the screen, center the dropdown
      const itemRect = item.getBoundingClientRect();
      const itemCenter = itemRect.left + itemRect.width / 2;
      if (itemCenter > window.innerWidth / 3 && itemCenter < (window.innerWidth * 2) / 3) {
        dropdown.classList.add("centered");
      }
      // If overflow on right, align left to right
      else if (rightSpace < 10) {
        dropdown.classList.add("show-left");
      }
      // Otherwise default left-align (no class needed)
    });
  });


  // PREVENT DROPDOWN OVERFLOW (auto left align)
  //   document.querySelectorAll(".bb-nav-item").forEach(item => {
  //     item.addEventListener("mouseenter", () => {
  //       const dropdown = item.querySelector(".bb-dropdown");
  //       if (!dropdown) return;

  //       const rect = dropdown.getBoundingClientRect();
  //       dropdown.classList.remove("show-left");

  //       const rightSpace = window.innerWidth - (item.getBoundingClientRect().left + dropdown.offsetWidth);
  //       if (rightSpace < 10) {
  //         dropdown.classList.add("show-left");
  //       }
  //     });
  //   });
</script>
<script type="text/javascript">
  $(".modal_loading").css('display', 'none');

  $("#login_form").validate({
    submitHandler: function () {
      $.ajax({
        url: "<?php echo e(route('login_ajax')); ?>",
        method: "POST",
        data: $("#login_form").serialize(),
        beforeSend: function () {
          $(".btn-send").attr('disabled', true);
          $(".modal_loading").css('display', 'block');
        },
        success: function (response) {
          // console.log(response);
          // toastr.success('abc')
          // var response = JSON.parse(response);
          if (response.status === 200) {
            toastr.success(response.message)
            // $(".modal").modal('hide');
            if (response.role === 'owner') {
              window.location = "<?php echo e(url('user/dashboard')); ?>"
            } else if (response.role === 'builder') {
              window.location = "<?php echo e(url('builder/dashboard')); ?>"
            } else if (response.role === 'agent') {
              window.location = "<?php echo e(url('agent/dashboard')); ?>"
            }
          } else if (response.status === 400) {
            toastr.error(response.message)
            $("#login_form #password").val('');
          }
        },
        error: function (response) {
          toastr.error('An error occured')
        },
        complete: function () {
          $(".modal_loading").css('display', 'none');
          $(".btn-send").attr('disabled', false);
          // $("form").trigger('reset');
        }
      })
    }
  });


  $("#forgot_password_form").validate({
    submitHandler: function () {
      $.ajax({
        url: "<?php echo e(config('app.api_url') . '/forgot-password'); ?>",
        method: "POST",
        data: $("#forgot_password_form").serialize(),
        beforeSend: function () {
          console.log($("#forgot_password_form").serialize());
          $(".btn-send").attr('disabled', true);
          $(".modal_loading").css('display', 'block');
        },
        success: function (response) {
          console.log(response);
          // toastr.success('abc')
          // var response = JSON.parse(response);
          if (response.responseCode === 200) {
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
        error: function (xhr, status, error) {
          var response = JSON.parse(xhr.responseText);
          response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete: function () {
          $(".modal_loading").css('display', 'none');
          $(".btn-send").attr('disabled', false);
          $("form").trigger('reset');
        }
      })
    }
  });


  $("#verify_otp_password").validate({
    rules: {
      new_password: {
        minlength: 8
      },
      confirm_new_password: {
        equalTo: "#new_password"
      }
    },
    submitHandler: function () {
      $.ajax({
        url: "<?php echo e(config('app.api_url') . '/verify-otp'); ?>",
        method: "POST",
        data: $("#verify_otp_password").serialize(),
        beforeSend: function () {
          $(".btn-send").attr('disabled', true);
          $(".modal_loading").css('display', 'block');
        },
        success: function (response) {
          // console.log(response);
          // toastr.success('abc')
          // var response = JSON.parse(response);
          if (response.responseCode === 200) {
            toastr.success(response.message)
            $(".modal").modal('hide');
            // reloadPage();
          } else if (response.responseCode === 400) {
            toastr.error(response.message)
            $("#verify_otp_password").trigger('reset');
          }
        },
        error: function (xhr, status, error) {
          var response = JSON.parse(xhr.responseText);
          response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete: function () {
          $(".modal_loading").css('display', 'none');
          $(".btn-send").attr('disabled', false);
          $("form").trigger('reset');
        }
      })
    }
  });

  $("#register_form").validate({
    rules: {
      password: {
        required: true,
        minlength: 8
      },
      confirm_password: {
        required: true,
        equalTo: "#reg_password",
        minlength: 8
      },
      mobile_number: {
        minlength: 10,
        maxlength: 10,
        required: true,
        digits: true
      }

    },

    submitHandler: function () {
      $.ajax({
        url: "<?php echo e(config('app.api_url') . '/register'); ?>",
        method: "POST",
        data: $("#register_form").serialize(),
        beforeSend: function () {
          $(".btn-send").attr('disabled', true);
          $(".modal_loading").css('display', 'block');
        },
        success: function (response) {
          // console.log(response);
          // toastr.success('abc')
          // var response = JSON.parse(response);
          if (response.responseCode === 200) {
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
        error: function (xhr, status, error) {
          var response = JSON.parse(xhr.responseText);
          response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete: function () {
          $(".modal_loading").css('display', 'none');
          $(".btn-send").attr('disabled', false);
          // $("form").trigger('reset');
        }
      })
    }
  });


  $("#otp_form").validate({
    submitHandler: function () {
      $.ajax({
        url: "<?php echo e(config('app.api_url') . '/verify-otp'); ?>",
        method: "POST",
        data: {
          "_token": $('input[name="_token"]').val(),
          "otp": $("#otp_form #otp").val(),
          "user_id": $("#otp_form .user_id").val(),
          "is_register": true
        },
        beforeSend: function () {
          $(".btn-send").attr('disabled', true);
          $(".modal_loading").css('display', 'block');
        },
        success: function (response) {
          // console.log(response);
          // toastr.success('abc')
          // var response = JSON.parse(response);
          if (response.responseCode === 200) {
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
        error: function (xhr) {
          var response = JSON.parse(xhr.responseText);
          response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured')
        },
        complete: function () {
          $(".modal_loading").css('display', 'none');
          $(".btn-send").attr('disabled', false);
        }
      })
    }
  });



  function loadCities(state_id, element_id) {
    // if(empty(state_id)) return true;

    var route = "<?php echo e(config('app.api_url')); ?>/cities_states/" + state_id;
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
        if (response.responseCode === 200) {
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

  function viewMoreCities() {
    $(".loading").css('display', 'none');
    $.ajax({
      url: "<?php echo e(url('home/get/all/cities')); ?>?state_id=<?php echo e(Cache::get('state-id')); ?>",
      method: "GET",
      beforeSend: function () {
        $(".modal_loading").css('display', 'block');
      },
      success: function (cities) {
        $('#render-cities-modal').empty();
        $('#render-cities-modal').append(cities);
        setTimeout(function () {
          $('#location-list').modal('show');
        }, 1000);
      },
      error: function (response) {
        $(".modal_loading").css('display', 'none');
        swal('', response, 'error');
      },
      complete: function () {
        $(".modal_loading").css('display', 'none');
      }
    })
  }

  document.getElementById('view-otp').style.display = 'none';
  document.getElementById('login-type-password').style.display = 'none';
  document.getElementById('check-otp').style.display = 'none';

  function faceBookSignup() {
    var getSelectedValue = document.querySelector('input[name="owner_type"]:checked');
    if (getSelectedValue != null) {
      window.location.href = '<?php echo e(url('signup')); ?>/facebook?role=' + getSelectedValue.value;
    }
  }

  function googleSignup() {
    var getSelectedValue = document.querySelector('input[name="owner_type"]:checked');
    if (getSelectedValue != null) {
      window.location.href = '<?php echo e(url('signup')); ?>/google?role=' + getSelectedValue.value;
    }
  }

  function loginType(type) {
    if (type == 'otp') {
      document.getElementById('view-otp').style.display = 'block';
      document.getElementById('login-type-otp').style.display = 'none';
      document.getElementById('view-password').style.display = 'none';
      document.getElementById('login-type-password').style.display = 'block';
      document.getElementById('check-otp').style.display = 'block';
      document.getElementById('check-login').style.display = 'none';
    } else {
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
    if (email == '') {
      swal('', 'Email or mobile number field must be required', 'warning');
      return false;
    }
    $.ajax({
      url: '<?php echo e(url('login/send/otp')); ?>',
      method: "POST",
      data: {
        '_token': '<?php echo e(csrf_token()); ?>',
        'email': email
      },
      beforeSend: function () {
        $(".modal_loading").css('display', 'block');
      },
      success: function (data) {
        if (data.status == 200) {
          swal('', data.msg, 'success');
        } else {
          swal('', data.msg, 'warning');
        }
        document.getElementById('check-login').style.display = 'block';
        document.getElementById('check-otp').style.display = 'none';
      },
      error: function (response) {
        $(".modal_loading").css('display', 'none');
        swal('', response, 'error');
      },
      complete: function () {
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

<?php echo $__env->yieldContent('js'); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/layouts/front/app.blade.php ENDPATH**/ ?>