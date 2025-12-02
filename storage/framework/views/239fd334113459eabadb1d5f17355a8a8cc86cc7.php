

<?php $__env->startSection('title'); ?>
  <title>Welcome to Bhawan Bhoomi</title>
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
  .newupdateContainer {
    text-align: center;
    padding: 50px 60px;
    /*max-width: 900px;*/
    width: 100%;
    min-height: 650px;
    margin: auto;
    background: linear-gradient(135deg,
        /* Angle of the gradient */
        #ffda9e,
        /* Soft Pastel Orange (e.g., Apricot) */
        #a6e3e0,
        /* Soft Pastel Blue/Cyan (e.g., Pale Aqua) */
        #b2f7b2
        /* Soft Pastel Green (e.g., Mint Green) */
      );
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .banner-top-content h1 {
    font-size: 46px;
    font-weight: 700;
  }


  .newupdateSearchContainer {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: #333;
    width: 70%;

  }

  .newupdateTabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  .newupdateTab {
    background: none;
    border: none;
    color: #2d2d5c;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s;
  }

  .newupdateTab.active {
    border-bottom: 2px solid #00cc88;
  }

  .newupdateTab:hover {
    border-bottom: 2px solid #3d3d7c;
  }

  .newupdateSearchBar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    background: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
  }

  .newupdateDropdown {
    padding: 10px !important;
    border: 1px solid #ccc !important;
    border-radius: 5px !important;
    font-size: 14px !important;
    width: 150px !important;
    appearance: none;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%23666" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
    background-size: 12px;
  }

  .newupdateSearchInput {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
  }

  .newupdateSearchIcon,
  .newupdateMicIcon {
    background: #00cc8817;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #00cc88;
    padding: 5px;
    border-radius: 50%;
    padding: 10px;
  }

  .newupdateFilters {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .newupdateSearchBtn {
    background-color: #00cc88;
    border: none;
    color: #fff;
    padding: 10px 60px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
  }

  .newupdateSearchBtn:hover {
    background-color: #00aa70;
  }

  .newupdateSecondarySearch {
    text-align: center;
  }

  .newupdateSecondaryBtn {
    background-color: #2d2d5c;
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
  }

  .newupdateSecondaryBtn:hover {
    background-color: #3d3d7c;
  }

  .property-tab {
    border: 1px solid #e38e32;
    background: #fff;
    color: #e38e32;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .property-tab:hover {
    background: #e38e32;
    color: #fff;
    transform: translateY(-1px);
  }

  .property-tab.active {
    background: #e38e32;
    color: #fff;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
  }

  /*.newdesign-verified-seal {*/
  /*  position: absolute;*/
  /*  top: 10px;*/
  /*  left: 10px;*/
  /*  background: #198754;*/
  /*  color: #fff;*/
  /*  padding: 4px 8px;*/
  /*  font-size: 13px;*/
  /*  border-radius: 20px;*/
  /*}*/
  .property-card {
    transition: all 0.3s ease;
  }

  .property-card.hide {
    display: none !important;
  }

  .newdesign-project-main {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.3s ease;
  }

  .newdesign-project-main:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  .newupdateFilterOptions {
    display: grid;
    gap: 10px;

  }

  .form-check {
    text-align: left;
    position: relative;
    display: block;
    padding-left: 2.25rem;
  }
</style>
<style>
  .filter-item select {
    background: #fff;
    border: 1px solid #ddd;
    font-size: 14px;
    appearance: auto;
  }

  .city-item {
    cursor: pointer;
    transition: background 0.2s;
  }

  .city-item:hover {
    background: #f2f2f2;
  }

  .new-slider-container {
    display: flex;
    /* Align slides horizontally */
    gap: 15px;
    /* Space between slides */
    overflow-x: auto;
    /* Enable horizontal scroll */
    scroll-behavior: smooth;
    /* Smooth scrolling */
    -webkit-overflow-scrolling: touch;
    /* Smooth scrolling on mobile */
    padding-bottom: 10px;
    /* Optional padding for scrollbar */
  }

  .new-slide {
    flex: 0 0 auto;
    /* Prevent shrinking, allow scrolling */
    width: 280px;
    /* Adjust width of each slide */
    scroll-snap-align: start;
    /* Optional: snap to start */
  }

  /* Optional: scrollbar styling */
  .new-slider-container::-webkit-scrollbar {
    height: 6px;
  }

  .new-slider-container::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
  }
</style>
<?php $__env->startSection('content'); ?>
  <?php
    // Get all front contents keyed by slug
    $allContents = App\Models\FrontContent::all()->keyBy('slug');

    // List of all required slugs
    $slugs = [
      'Banner',
      'Hand-Picked',
      'Trending-Projects',
      'Latest-Properties',
      'Featured-Property',
      'Exclusive-Launch',
      'Commercial-Property-for-Sale',
      'Commercial-Property-for-Rent',
      'Residential-Property-for-Sale',
      'Residential-Property-for-Rent',
      'Web-Directory',
      'Property-by-Business-Type',
      'Reels',
      'Testimonials'
    ];

    // Dynamic variable assignment by converting slug to snake_case variable name
    foreach ($slugs as $slug) {
      // Convert slug to snake_case (e.g., 'Exclusive-Launch' → 'exclusive_launch')
      $varName = strtolower(str_replace('-', '_', $slug));
      // Assign variable dynamically with null fallback if not found
      ${$varName} = $allContents->get($slug) ?? null;
    }

    $popular_cities_content = App\PopularCity::where('slug', 'heading')->first();
    $popular_cities = App\PopularCity::where('slug', 'city')->get();


    use App\Helpers\Helper;
    $buyFilters = Helper::getBuyFilterData();
    $rentalFilters = Helper::getRentalFilterData();
    $pgFilters = Helper::getPgHostelFilterData();
    $exclusiveFilters = Helper::getExclusiveLaunchFilterData(); // create this in Helper
    $plotFilters = Helper::getPlotLandFilterData();
    $cities = App\PopularCity::where('slug', 'city')->get();
  ?>

  <div class="newupdateContainer">
    <div class="banner-top-content">
      <h1 class="banner-top-content" style=" ">
        <?php echo e($banner ? $banner->heading : 'Gateway to Verified Properties Across India'); ?>

      </h1>
      <p class="banner-discription" style="width:80%;margin:auto; padding-bottom:30px;">
        <?php echo e($banner ? $banner->title : 'Discover thousands of verified properties, exclusive builder projects, and trusted service providers all in one place. Connect, explore, and make informed decisions with Bhawan Bhoomi – your reliable real estate partner.'); ?>

      </p>
      <p class="banner-discription-mobile" style="width:100%;margin:auto; padding-bottom:30px;">
        Discover verified properties and trusted real estate projects with Bhawan Bhoomi.


      </p>
    </div>

    <div class="newupdateSearchContainer">
      <div class="newupdateTabs">
        <button class="newupdateTab active" data-type="buy">Buy</button>
        <button class="newupdateTab" data-type="rental">Rental</button>
        <button class="newupdateTab" data-type="pg-hostels">PG / Hostels</button>
        <button class="newupdateTab" data-type="exculsive-launch">Exclusive Launch</button>
        <button class="newupdateTab" data-type="plot-land">Plot & Land</button>
      </div>

      <div class="newupdateSearchBar" data-type="buy">


        <div class="newupdateFilterOptions">
          <select class="newupdateDropdown" id="citySelect" style="padding: 10px;">
            <option value="">Select City</option>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($city->getCity->id); ?>"><?php echo e($city->getCity->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <input type="text" placeholder="Search by Project, Locality, or Builder" class="newupdateSearchInput">
        <button id='location-detect' class="newupdateSearchIcon"><i class="fa-solid fa-location-crosshairs"></i></button>
        <button class="newupdateSearchBtn">Search</button>


        <!--<i class="fa-solid fa-filter"></i>-->
      </div>

      <div class="newupdateSearchBarmobile" data-type="buy">
        <input type="text" placeholder="Search by Project, Locality, or Builder" class="newupdateSearchInput">
        <button class="newupdateSearchIcon mobile-view" data-bs-toggle="offcanvas" href="#offcanvasExample"
          role="button"><img src="<?php echo e(asset('images/filter (1).png')); ?>" alt="" style="width:30px; ">
      </div>


      <!-- Filter Offcanvas -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="filterMenuLabel"
        style="width: 320px;">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-semibold" id="filterMenuLabel">Filters</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body" style="background:#f9f9f9; text-align: left;">

          <!-- Location Filter -->
          <div class="filter-item border-bottom py-2 mb-3" style="text-align: left;">
            <h6 class="fw-semibold mb-0 d-flex justify-content-between align-items-center" data-bs-toggle="offcanvas"
              data-bs-target="#locationCanvas" aria-controls="locationCanvas" style="cursor:pointer;">
              <span>
                <i class="fas fa-map-marker-alt text-danger"></i>
                Location
              </span>
              <img src="<?php echo e(asset('images/arrow.png')); ?>" alt="" width="20px;">
            </h6>

            <div id="selectedCityDisplay" class="mt-2 p-2 bg-light rounded" style="display:none;">
              <small class="text-muted">Selected City:</small><br>
              <strong id="selectedCityName"></strong>
              <i class="fas fa-times-circle text-danger float-end" id="clearCitySelection" style="cursor:pointer;"></i>
            </div>
          </div>

          <!-- Dynamic Filters Based on Active Tab -->
          <div id="mobileFilterContent" style="text-align: left;">
            <!-- Content will be dynamically inserted here -->
          </div>

          <button class="btn btn-dark w-100 mt-3" id="mobileApplyFilters">Apply Filters</button>
        </div>
      </div>

      <!-- Location Sub Offcanvas -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="locationCanvas" aria-labelledby="locationCanvasLabel"
        style="width: 320px;">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-semibold" id="locationCanvasLabel">
            <i class="fa-solid fa-arrow-left me-2" data-bs-dismiss="offcanvas" aria-label="Close"
              style="cursor:pointer;"></i>
            Select Location
          </h5>
        </div>

        <div class="offcanvas-body" style="background:#fff;">
          <div class="search-bar mb-3">
            <input type="text" id="locationSearch" class="form-control" placeholder="Search city or state..." />
          </div>

          <div id="locationList">
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="city-item py-2 border-bottom" data-city-id="<?php echo e($city->getCity->id); ?>"
                data-city-name="<?php echo e($city->getCity->name); ?>">
                <?php echo e($city->getCity->name); ?>

              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div id="noCityFound" class="text-center text-muted mt-4" style="display:none;">No city found</div>
        </div>
      </div>




      
      <div class="newupdateFilters" data-type="buy">
        <div class="row">
          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100 sub_category_items" id="sub_category_id">
              <option value="">Property Category</option>
              <?php $__currentLoopData = $buyFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
              style="max-height:150px; overflow-y:auto;">
              <label class="text-left mb-1" id="propertyTypeLabelBuy">Property Type</label>
              <div id="sub_sub_category_items" class="propertyTypeBuy collapse">
                <?php $__currentLoopData = $buyFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="form-check" data-category="<?php echo e($type->sub_category_id); ?>">
                    <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                      id="subsub_<?php echo e($type->id); ?>" value="<?php echo e($type->id); ?>">
                    <label class="form-check-label" for="subsub_<?php echo e($type->id); ?>">
                      <?php echo e($type->sub_sub_category_name); ?>

                    </label>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>


          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100" id="budget">
              <option value="">Budget</option>
              <?php $__currentLoopData = $buyFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100" id="user_role">
              <option value="">Posted By</option>
              <?php $__currentLoopData = $buyFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>


        <!--<button class="newupdateSearchBtn mt-4">Search</button>-->
      </div>


      
      <div class="newupdateFilters" data-type="rental" style="display:none;">
        <div class="row">

          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100 sub_category_items" id="sub_category_id">
              <option value="">Property Category</option>
              <?php $__currentLoopData = $rentalFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
              style="max-height:150px; overflow-y:auto;">
              <label class="text-left mb-1" id="propertyTypeLabelRental">Property Type</label>
              <div id="sub_sub_category_items" class="propertyTypeRental collapse">
                <?php $__currentLoopData = $rentalFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="form-check" data-category="<?php echo e($v->sub_category_id); ?>">
                    <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                      id="subsub_<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>">
                    <label class="form-check-label" for="subsub_<?php echo e($v->id); ?>">
                      <?php echo e($v->sub_sub_category_name); ?>

                    </label>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>

          

          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100" id="budget">
              <option value="">Budget</option>
              <?php $__currentLoopData = $rentalFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-sm-3" style="padding-left:5px;padding-right:5px;">
            <select class="newupdateDropdown w-100" id="user_role">
              <option value="">Posted By</option>
              <?php $__currentLoopData = $rentalFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>


        <!--<button class="newupdateSearchBtn mt-2">Search</button>-->
      </div>

      
      <div class="newupdateFilters" data-type="pg-hostels" style="display:none;">
        <div class="newupdateFilterOptions1 d-flex gap-2">
          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            <?php $__currentLoopData = $pgFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

          <select class="newupdateDropdown" id="pg_availavle_for">
            <option value="">Available For</option>
            <?php $__currentLoopData = $pgFilters['available_for']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(strtolower($option)); ?>"><?php echo e($option); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            <?php $__currentLoopData = $pgFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <!--<button class="newupdateSearchBtn mt-2">Search</button>-->
      </div>

      
      <div class="newupdateFilters" data-type="exculsive-launch" style="display:none;">
        <div class="newupdateFilterOptions1 d-flex gap-2">
          <select class="newupdateDropdown sub_category_items" id="sub_category_id">
            <option value="">Sub Category</option>
            <?php $__currentLoopData = $exclusiveFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

          <!-- <select class="newupdateDropdown" id="sub_sub_category_id"  multiple>
                                                                    <option value="">Property Type</option>
                                                                    <?php $__currentLoopData = $exclusiveFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                      <option value="<?php echo e($type->id); ?>"><?php echo e($type->sub_sub_category_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  </select> -->

          <select class="newupdateDropdown" id="budget">
            <option value="">Budget</option>
            <?php $__currentLoopData = $exclusiveFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>



          <select class="newupdateDropdown" id="user_role">
            <option value="">Posted By</option>
            <?php $__currentLoopData = $exclusiveFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <!--<button class="newupdateSearchBtn mt-2">Search</button>-->
      </div>

      <div class="newupdateFilters" data-type="plot-land" style="display:none;">
        <div class="d-flex justify-content-center" style="gap:20px;">
          <div class="">
            <div class="newupdateFilterOptions property-type-checkbox-group border rounded p-2"
              style="max-height:150px; overflow-y:auto; width: 250px;">
              <label class="fw-bold mb-1">Property Type</label>
              <div id="sub_sub_category_items">
                <?php $__currentLoopData = $plotFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="form-check">
                    <input class="form-check-input sub-sub-checkbox" type="checkbox" name="sub_sub_category_ids[]"
                      id="subsub_<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>">
                    <label class="form-check-label" for="subsub_<?php echo e($v->id); ?>">
                      <?php echo e($v->sub_sub_category_name); ?>

                    </label>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

          </div>

          <div class="newupdateFilterOptions">

            


            <select class="newupdateDropdown" id="budget">
              <option value="">Budget</option>
              <?php $__currentLoopData = $plotFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select class="newupdateDropdown" id="user_role">
              <option value="">Posted By</option>
              <?php $__currentLoopData = $plotFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>


        <!--<button class="newupdateSearchBtn mt-2">Search</button>-->
      </div>

    </div>
  </div>


  <section class="property-popular-cities">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4><?php echo e($popular_cities_content->heading); ?></h4>
          </div>
        </div>
      </div>
      <div class=" popular-city-scroll">
        <?php if(count($popular_cities) > 0): ?>
          <?php $__currentLoopData = $popular_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular_city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="popular-card-image">
              <div class="city-main text-center">
                <?php
                  $get_city = App\City::find($popular_city->city_id);
                ?>
                <a href="<?php echo e(url('/')); ?>/<?php echo e($get_city->name); ?>">
                  <div class="thumb"> <img class="img-fluid" src="<?php echo e(asset('storage')); ?>/<?php echo e($popular_city->image); ?>"
                      alt="pc1.png"> </div>
                  <div class="details">
                    <h4><?php echo e($popular_city->getCity ? $popular_city->getCity->name : ''); ?></h4>
                    <p><?php echo e($popular_city->getPropertyCount($popular_city->city_id)); ?> Properties</p>
                  </div>
                </a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <h5>No Any Popular Cities Found.</h5>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php
    $city_id = Cache::get('location-id');

    $propertiesSellCommercial = Helper::getPropertiesByCategoryAndSubcategory('Sell', 35, $city_id);
    $propertiesSellResidential = Helper::getPropertiesByCategoryAndSubcategory('Sell', 34, $city_id);

    $propertiesRentCommercial = Helper::getPropertiesByCategoryAndSubcategory('Rent', 37, $city_id);
    $propertiesRentResidential = Helper::getPropertiesByCategoryAndSubcategory('Rent', 38, $city_id);


    $exculsiveProperties = Helper::getPropertiesByCategory('Exclusive Launch', $city_id);
    $business_list = Helper::getAllBusinessListings();

    $sellSubs = Helper::getSubSubcategoriesByCategoryName('Sell');
    $sellResidentil = $sellSubs['residential'];
    $sellCommercial = $sellSubs['commercial'];

    $rentSubs = Helper::getSubSubcategoriesByCategoryName('Rent');
    $rentResidentil = $rentSubs['residential'];
    $rentCommercial = $rentSubs['commercial'];

    // Filter tabs to only show those with properties
    $sellResidentilFiltered = $sellResidentil->filter(function ($subSubcat) use ($propertiesSellResidential) {
      return $propertiesSellResidential->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $sellCommercialFiltered = $sellCommercial->filter(function ($subSubcat) use ($propertiesSellCommercial) {
      return $propertiesSellCommercial->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $rentResidentilFiltered = $rentResidentil->filter(function ($subSubcat) use ($propertiesRentResidential) {
      return $propertiesRentResidential->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $rentCommercialFiltered = $rentCommercial->filter(function ($subSubcat) use ($propertiesRentCommercial) {
      return $propertiesRentCommercial->where('sub_sub_category_id', $subSubcat->id)->isNotEmpty();
    });

    $projects = Helper::getTrendingProjectsByCity($city_id);
    $featured_projects = Helper::getFeaturedProjectsByCity($city_id);
  ?>


  <!-- hand picked projects section -->
  <section class="property-home-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4><?php echo e($hand_picked ? $hand_picked->heading : ''); ?></h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php if(isset($listings)): ?>
                <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(in_array($value->id, explode(',', $hand_picked->ids))): ?>
                    <div class="swiper-slide">
                      <div class=" property-card" data-type="office">
                        <div class="newdesign-project-main shadow-sm">
                          <div class="newdesign-image-proj position-relative">
                            <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                                    ">
                              <img
                                src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                                alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                            </a>
                            <?php if($value->verified_tag === 'Yes'): ?>
                              <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                            <?php endif; ?>
                          </div>
                          <div class="newdesign-info-proj p-3">
                            <div class="d-flex justify-content-between align-items-start">
                              <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                                    "><?php echo e($value->title); ?></a>
                              </h5>

                            </div>
                            <hr class="" style="margin-bottom:10px; margin-top:10px;">
                            <div class="d-flex justify-content-between align-items-center">
                              <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                                style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                              <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                              <p class="share-now m-0">
                                <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                                  onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                              </p>


                            </div>

                            <div class="horizontal-line mt-2"></div>
                            <div class="d-flex justify-content-between align-items-center">

                              <p class="small text-secondary mb-2 mt-2">
                                <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                                <?php echo e($value->getState->name); ?>

                              </p>
                              <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                            </div>

                            <div class="horizontal-line"></div>
                            <p class="small text-muted mb-2 mt-2">
                              <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                              <p class="m-0 small"> <strong>Owner:</strong><br> <a
                                  href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                                  <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                              <p class="m-0 small">
                                <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                              </p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                              <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                                <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                              <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                                Now</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- exculsive launched projects section -->
  <section class="newdesign-property-topprojects">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="newdesign-section-title">
            <h4><?php echo e($exclusive_launch->heading ?? 'Recently Launched'); ?></h4>
            <p>
              <?php echo e($exclusive_launch->title ?? 'Explore our latest properties fresh on the market.Find your dream home today!'); ?>

            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <?php $__currentLoopData = $exculsiveProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <!-- Property Card 1 -->
          <div class="col-lg-4 mb-3">
            <div class="newdesign-project-main">
              <!--<a href="#">-->
              <div class="newdesign-image-proj">
                <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                  ">
                  <img
                    src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;'); ?>"
                    class="img-fluid" alt="Property 1">
                </a>
                <?php if($value->verified_tag === 'Yes'): ?>
                  <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                <?php endif; ?>
              </div>
              <div class="newdesign-info-proj">
                <div class="d-flex justify-content-between">
                  <h4 class="newdesign-proj-name"> <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                  "><?php echo e($value->title); ?></a></h4>
                  <!--<span class="newdesign-proj-category">Villa</span>-->
                </div>
                <hr class="" style="margin-bottom:10px; margin-top:10px;">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                    style=" height:30px;">Villa</p>
                  <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                  <p class="share-now m-0">
                    <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                      onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                  </p>


                </div>
                <div class="horizontal-line mt-2 mb-2"></div>
                <span class="newdesign-apart-name"> <?php echo e(\Illuminate\Support\Str::limit($value->description, 100)); ?></span>
                <hr>
                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> <?php echo e($value->getCity->name); ?>,
                  <?php echo e($value->getState->name); ?></span>

                <div class="newdesign-proj-price">
                  <span><i class="fas fa-rupee-sign"></i><?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></span>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="newdesign-proj-owner"><strong>Builder:</strong><br>
                    <a href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                      <?php echo e($value->getUser->firstname ?? ''); ?>

                    </a>
                  </span>
                  <span class="newdesign-proj-owner"><strong>Posted:</strong><br>
                    <?php echo e(optional($value->created_at)->format('d M Y')); ?></span>
                </div>
              </div>
              <!--</a>-->
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  <!-- Sell Commercial projects section -->
  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2"><?php echo e($commercial_property_for_sale->heading ?? 'Commercial Properties for Sale'); ?></h4>
        <p class="text-muted mb-0">
          <?php echo e($commercial_property_for_sale->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'); ?>

        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <?php $__currentLoopData = $sellCommercialFiltered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" class="property-tab" data-filter="<?php echo e($subSubcat->sub_sub_category_name); ?>">
              <?php echo e($subSubcat->sub_sub_category_name); ?></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $propertiesSellCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class=" property-card" data-type="<?php echo e($value->getCategoryHierarchyName()); ?>">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        ">
                          <img
                            src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <?php if($value->verified_tag === 'Yes'): ?>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        <?php endif; ?>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        "><?php echo e($value->title); ?></a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0">
                            <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                              onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                          </p>


                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                            <?php echo e($value->getState->name); ?>

                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"> <strong>Owner:</strong><br> <a
                              href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                              <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                          <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                            Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- business lists section -->
  <section class="newdesign-directory" style="background:#fff;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="newdesign-section-title">
            <h4><?php echo e($web_directory->heading ?? 'Directory'); ?></h4>
            <p>
              <?php echo e($web_directory->title ?? 'Explore top companies and their services. Connect with the best in the industry!'); ?>

            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $business_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class="directory-card-main d-flex flex-column">
                    <div class="directory-logo">
                      <a href="<?php echo e(route('business.details', ['id' => $list->id, 'slug' => $list->slug])); ?>">
                        <img
                          src="<?php echo e(isset($list->logo) ? asset('storage/' . $list->logo) : "https://mir-s3-cdn-cf.behance.net/project_modules/fs/3ede59114115331.603532078a563.jpg"); ?>"
                          class="img-fluid" alt="Company Logo 1">
                      </a>
                    </div>

                    <div class="verified-seal">
                      <div class="top-veri">
                        <?php if($list->premium_badge === "Yes"): ?>
                          <span class="premium-list">Premium</span>
                        <?php elseif($list->verified_badge === "Yes"): ?>
                          <img src="<?php echo e(asset('images/verify.png')); ?>" alt="verified">
                        <?php endif; ?>

                        <p class="share-now"><i class="fa-solid fa-share-nodes"></i></p>
                      </div>
                    </div>



                    <div class="directory-info">

                      <h4 class="directory-company-name"><a
                          href="<?php echo e(route('business.details', ['id' => $list->id, 'slug' => $list->slug])); ?>"
                          style="font-size:20px;text-align:center;white-space:wrap;"><?php echo e($list->business_name); ?></a></h4>
                      <hr>


                      <div class="cat-btn">
                        <?php
                          $catWords = explode(' ', $list->category->category_name ?? '');
                          $shortCat = count($catWords) > 4 ? implode(' ', array_slice($catWords, 0, 4)) . '...' : ($list->category->category_name ?? '');
                        ?>

                        <button class="category-name-btn"><?php echo e($shortCat); ?></button>
                        <p class="m-0"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                      </div>
                      <div class="horizontal-line"></div>
                      <div class="d-flex justify-content-between align-items-center p-2">
                        <div class="dir-left">
                          <h5 class="m-0">Established Year</h5>
                          <p class="m-0"><?php echo e($list->established_year); ?></p>
                        </div>
                        <div class="ver-line"></div>
                        <div class="dir-left">
                          <h5 class="m-0">Location</h5>
                          <p class="m-0"><?php echo e($list->city); ?>, <?php echo e($list->state); ?></p>
                        </div>
                      </div>

                      <div class="horizontal-line"></div>

                      <p class="directory-description"> <?php echo e(\Illuminate\Support\Str::limit($list->introduction, 120)); ?></p>
                      <div class="directory-buttons">
                        <div class="d-flex align-items-center">
                          <p class="m-0" style="font-size:14px;"><strong>Member
                              Since:</strong><br><?php echo e(optional($list->created_at)->format('d M Y')); ?></p>
                        </div>
                        <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact Now</button>
                        <!--<button class="btn btn-sm btn-secondary">Views</button>-->

                        <!--<button class="btn btn-sm btn-info">Share Now</button>-->
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <!--<div class="swiper-button-prev"></div>-->
            <!--<div class="swiper-button-next"></div>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sell Residential projects section -->
  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2"><?php echo e($residential_property_for_sale->heading ?? 'Residential Properties for Sale'); ?></h4>
        <p class="text-muted mb-0">
          <?php echo e($residential_property_for_sale->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'); ?>

        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <?php $__currentLoopData = $sellResidentilFiltered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" class="property-tab" data-filter="<?php echo e($subSubcat->sub_sub_category_name); ?>">
              <?php echo e($subSubcat->sub_sub_category_name); ?></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $propertiesSellResidential; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class=" property-card" data-type="<?php echo e($value->getCategoryHierarchyName()); ?>">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        ">
                          <img
                            src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <?php if($value->verified_tag === 'Yes'): ?>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        <?php endif; ?>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        "><?php echo e($value->title); ?></a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0">
                            <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                              onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                          </p>


                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                            <?php echo e($value->getState->name); ?>

                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"> <strong>Owner:</strong><br> <a
                              href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                              <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                          <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                            Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Rent Commercial projects section -->
  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2"><?php echo e($commercial_property_for_rent->heading ?? 'Commercial Properties for Rent'); ?></h4>
        <p class="text-muted mb-0">
          <?php echo e($commercial_property_for_rent->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'); ?>

        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns ">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <?php $__currentLoopData = $rentCommercialFiltered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" class="property-tab" data-filter="<?php echo e($subSubcat->sub_sub_category_name); ?>">
              <?php echo e($subSubcat->sub_sub_category_name); ?></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $propertiesRentCommercial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class=" property-card" data-type="<?php echo e($value->getCategoryHierarchyName()); ?>">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        ">
                          <img
                            src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <?php if($value->verified_tag === 'Yes'): ?>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        <?php endif; ?>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        "><?php echo e($value->title); ?></a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0">
                            <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                              onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                          </p>


                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                            <?php echo e($value->getState->name); ?>

                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"> <strong>Owner:</strong><br> <a
                              href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                              <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                          <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                            Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Rent Residential projects section -->
  <section class="newdesign-property-topprojects py-5" style="background:#fff;">
    <div class="container">
      <!-- Heading -->
      <div class="text-center mb-4">
        <h4 class="fw-bold mb-2"><?php echo e($residential_property_for_rent->heading ?? 'Residential Properties for Rent'); ?></h4>
        <p class="text-muted mb-0">
          <?php echo e($residential_property_for_rent->title ?? 'Explore properties by category — Office Space, Shops & Showrooms, Godowns & Warehouse, Lands & Plots.'); ?>

        </p>
      </div>

      <!-- Tabs -->
      <div class="tabs-wrap mb-4 text-center">
        <div class="tabs-btns">
          <button type="button" class="property-tab active" data-filter="all">All</button>
          <?php $__currentLoopData = $rentResidentilFiltered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" class="property-tab" data-filter="<?php echo e($subSubcat->sub_sub_category_name); ?>">
              <?php echo e($subSubcat->sub_sub_category_name); ?>

            </button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $propertiesRentResidential; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class=" property-card" data-type="<?php echo e($value->getCategoryHierarchyName()); ?>">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        ">
                          <img
                            src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <?php if($value->verified_tag === 'Yes'): ?>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        <?php endif; ?>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        "><?php echo e($value->title); ?></a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0">
                            <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                              onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                          </p>


                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                            <?php echo e($value->getState->name); ?>

                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"> <strong>Owner:</strong><br> <a
                              href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                              <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                          <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                            Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

          </div>
        </div>
      </div>
    </div>
  </section>


  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4 class="text-center"><?php echo e($latest_properties ? $latest_properties->heading : ''); ?></h4>
            <p class="text-center"><?php echo e($latest_properties ? $latest_properties->title : ''); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="new-card-section">

    <div class="new-main-card">
      <!-- LEFT SIDE: Tabs -->
      <div class="new-left-tabs">
        <button class="new-tab-btn active" data-tab="tab1">IT / ITES</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab2">Call Center/ BPO</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab3">Corporate Businesses</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab4">Coaching Center</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Bank</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">ATM</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Pathology</button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Clinic </button>
        <hr />
        <button class="new-tab-btn" data-tab="tab5">Finance</button>
      </div>

      <?php
        $businessTabs = [
          'IT & Softwares',
          'call-center',
          'Corporate Businesses',
          'coaching-center',
          'bank',
          'atm',
          'pathology',
          'Clinic',
          'finance'
        ];
      ?>
      <!-- RIGHT SIDE: Image Sections -->
      <div class="new-right-slider">
        <?php $__currentLoopData = $businessTabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tabName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $businessProperties = Helper::getBusinessProperties($city_id ?? null, $tabName);
          ?>
          <div class="new-tab-content <?php echo e($loop->first ? 'active' : ''); ?>" id="tab<?php echo e($index + 1); ?>">
            <div class="new-slider-container">
              <?php $__empty_1 = true; $__currentLoopData = $businessProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="new-slide">
                      <div class="newdesign-project-main">
                        <div class="newdesign-image-proj">
                          <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>">
                            <img src="<?php echo e(isset($value->PropertyGallery[0]->image_path)
                ? asset($value->PropertyGallery[0]->image_path)
                : 'https://static.squareyards.com/resources/images/mumbai/project-image/default.jpg'); ?>"
                              class="img-fluid" alt="Property 1">
                          </a>
                          <?php if($value->verified_tag === 'Yes'): ?>
                            <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                          <?php endif; ?>
                        </div>
                        <div class="newdesign-info-proj">

                          <div class="d-flex justify-content-between">
                            <h4 class="newdesign-proj-name">
                              <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>">
                                <?php echo e($value->title); ?>

                              </a>
                            </h4>
                            <!--<span class="newdesign-proj-category">-->
                            <!--  <?php echo e($value->SubSubCategory->sub_sub_category_name ?? 'Commercial'); ?>-->
                            <!--</span>-->
                          </div>
                          <hr class="" style="margin-bottom:10px; margin-top:10px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                              style=" height:30px;"><?php echo e($value->SubSubCategory->sub_sub_category_name ?? 'Commercial'); ?></p>
                            <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                            <p class="share-now m-0">
                              <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                                onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                            </p>


                          </div>
                          <div class="horizontal-line mt-2 mb-2"></div>
                          <span class="newdesign-apart-name">
                            <?php echo e(\Illuminate\Support\Str::limit($value->description, 100)); ?>

                          </span>
                          <hr>
                          <span class="newdesign-apart-adress">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo e($value->getCity->name ?? ''); ?>, <?php echo e($value->getState->name ?? ''); ?>

                          </span>

                          <div class="newdesign-proj-price">
                            <span>
                              <i class="fas fa-rupee-sign"></i>
                              <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?>

                            </span>
                          </div>

                          <div class="d-flex justify-content-between">
                            <span class="newdesign-proj-owner"><strong>Builder:</strong><br>
                              <a href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                                <?php echo e($value->getUser->firstname ?? ''); ?>

                              </a>
                            </span>
                            <span class="newdesign-proj-owner"><strong>Posted:</strong><br>
                              <?php echo e(optional($value->created_at)->format('d M Y')); ?>

                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

    </div>
  </section>


  <!-- reels section -->
  <section class="testimonial-reels-section py-5 bg-light">
    <div class="container">
      <?php
        use App\Models\ClientReel;
        $reels = ClientReel::all();
      ?>

      <h2 class="sec__title mb-3 text-center">Reels</h2>
      <p class="sec__desc text-center">
        Explore a range of digital assets ready to buy or sell
      </p>

      <div class="row g-4 justify-content-center">
        <?php $__currentLoopData = $reels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-3 col-sm-6">
            <div class="reel-card">

              
              <?php if($reel->reel_type === 'youtube' && $reel->youtube_url): ?>
                <?php
                  parse_str(parse_url($reel->youtube_url, PHP_URL_QUERY), $ytParams);
                  $ytEmbed = isset($ytParams['v']) ? 'https://www.youtube.com/embed/' . $ytParams['v'] : $reel->youtube_url;
                ?>
                <iframe width="100%" height="100%" src="<?php echo e($ytEmbed); ?>" title="YouTube video" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>

              <?php elseif($reel->reel_type === 'facebook' && $reel->facebook_url): ?>
                <iframe width="100%" height="100%" src="<?php echo e($reel->facebook_url); ?>" title="Facebook video" frameborder="0"
                  allowfullscreen></iframe>

              <?php elseif($reel->reel_type === 'upload' && $reel->video_file): ?>
                <video controls loop muted autoplay playsinline width="100%" height="100%">
                  <source src="<?php echo e(asset('storage/' . $reel->video_file)); ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>

              <?php else: ?>
                <p class="text-muted text-center">No preview available</p>
              <?php endif; ?>

            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>


  <!-- trending property section -->
  <?php if(count($projects) > 0): ?>
    <section class="property-topprojects">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title section-left">
              <h4><?php echo e($trending_projects ? $trending_projects->heading : ''); ?></h4>
              <p><?php echo e($trending_projects ? $trending_projects->title : ''); ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="swiper directory-slider pt-3 pb-3">
              <div class="swiper-wrapper">
                <!-- Directory Card 1 -->
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide">
                    <div class=" property-card">
                      <div class="newdesign-project-main shadow-sm">
                        <div class="newdesign-image-proj position-relative">
                          <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                      ">
                            <img
                              src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                              alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                          </a>
                          <?php if($value->verified_tag === 'Yes'): ?>
                            <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                          <?php endif; ?>
                        </div>
                        <div class="newdesign-info-proj p-3">
                          <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                      "><?php echo e($value->title); ?></a>
                            </h5>

                          </div>
                          <hr class="" style="margin-bottom:10px; margin-top:10px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                              style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                            <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                            <p class="share-now m-0">
                              <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                                onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                            </p>


                          </div>

                          <div class="horizontal-line mt-2"></div>
                          <div class="d-flex justify-content-between align-items-center">

                            <p class="small text-secondary mb-2 mt-2">
                              <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                              <?php echo e($value->getState->name); ?>

                            </p>
                            <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                          </div>

                          <div class="horizontal-line"></div>
                          <p class="small text-muted mb-2 mt-2">
                            <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"> <strong>Owner:</strong><br> <a
                                href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                                <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                            <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                              Now</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- features section -->
  <section class="home-features">
    <div class="features-overlay">
      <div class="container">
        <div class="row">
          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
              <div class="feature"> <img src="<?php echo e(asset('storage')); ?>/<?php echo e($feature->image); ?>" alt="Map" class="img-fluid">
                <h3 class="feature__title"><?php echo e($feature->heading); ?></h3>
                <p class="feature__desc"> <?php echo $feature->description; ?> </p>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </section>

  <!-- latest property section -->
  <section class="property-home-list">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4><?php echo e($latest_properties ? $latest_properties->heading : ''); ?></h4>
            <p><?php echo e($latest_properties ? $latest_properties->title : ''); ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="swiper directory-slider pt-3 pb-3">
            <div class="swiper-wrapper">
              <!-- Directory Card 1 -->
              <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <div class=" property-card">
                    <div class="newdesign-project-main shadow-sm">
                      <div class="newdesign-image-proj position-relative">
                        <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        ">
                          <img
                            src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                            alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                        </a>
                        <?php if($value->verified_tag === 'Yes'): ?>
                          <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                        <?php endif; ?>
                      </div>
                      <div class="newdesign-info-proj p-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                        "><?php echo e($value->title); ?></a>
                          </h5>

                        </div>
                        <hr class="" style="margin-bottom:10px; margin-top:10px;">
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                            style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                          <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                          <p class="share-now m-0">
                            <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                              onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                          </p>


                        </div>

                        <div class="horizontal-line mt-2"></div>
                        <div class="d-flex justify-content-between align-items-center">

                          <p class="small text-secondary mb-2 mt-2">
                            <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                            <?php echo e($value->getState->name); ?>

                          </p>
                          <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                        </div>

                        <div class="horizontal-line"></div>
                        <p class="small text-muted mb-2 mt-2">
                          <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                        </p>

                        <div class="d-flex justify-content-between">
                          <p class="m-0 small"><strong>Owner:</strong><br><?php echo e($value->getUser->firstname ?? ''); ?></p>
                          <p class="m-0 small">
                            <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                          </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                            <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                          <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                            Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- featured property section -->
  <?php if(count($featured_projects) > 0): ?>
    <section class="featured-sold-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title section-center">
              <h4><?php echo e($featured_property ? $featured_property->heading : ''); ?></h4>
              <p><?php echo e($featured_property ? $featured_property->title : ''); ?>

              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="swiper directory-slider pt-3 pb-3">
              <div class="swiper-wrapper">
                <!-- Directory Card 1 -->
                <?php $__currentLoopData = $featured_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide">
                    <div class=" property-card">
                      <div class="newdesign-project-main shadow-sm">
                        <div class="newdesign-image-proj position-relative">
                          <a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                      ">
                            <img
                              src="<?php echo e(isset($value->PropertyGallery[0]->image_path) ? asset('') . $value->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80'); ?>"
                              alt="Office 1" class="img-fluid rounded-top" style="cursor: pointer;">
                          </a>
                          <?php if($value->verified_tag === 'Yes'): ?>
                            <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                          <?php endif; ?>
                        </div>
                        <div class="newdesign-info-proj p-3">
                          <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-semibold mb-1" style="font-size:18px;cursor: pointer;"><a href="<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>

                                                      "><?php echo e($value->title); ?></a>
                            </h5>

                          </div>
                          <hr class="" style="margin-bottom:10px; margin-top:10px;">
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="badge bg-primary-subtle text-primary m-0 d-flex justify-content-center align-items-center"
                              style=" height:30px;"><?php echo e($value->getCategoryHierarchyName()); ?></p>
                            <!--<p class="m-0" style="font-size:14px;"><strong>Publish:</strong> 26 Aug 2023</p>-->
                            <p class="share-now m-0">
                              <i class="fa-solid fa-share-nodes" style="font-size:18px; cursor:pointer;"
                                onclick="shareProperty('<?php echo e(route('property_detail', ['id' => $value->id, 'slug' => $value->slug])); ?>', '<?php echo e($value->title); ?>')"></i>
                            </p>


                          </div>

                          <div class="horizontal-line mt-2"></div>
                          <div class="d-flex justify-content-between align-items-center">

                            <p class="small text-secondary mb-2 mt-2">
                              <i class="fa-solid fa-location-dot"></i><?php echo e($value->getCity->name); ?> ,
                              <?php echo e($value->getState->name); ?>

                            </p>
                            <p class="m-0 small"><i class="fa-solid fa-eye"></i> <?php echo e($value->total_views ?? 0); ?></p>
                          </div>

                          <div class="horizontal-line"></div>
                          <p class="small text-muted mb-2 mt-2">
                            <?php echo e(\Illuminate\Support\Str::limit($value->description, 85)); ?>

                          </p>

                          <div class="d-flex justify-content-between">
                            <p class="m-0 small"> <strong>Owner:</strong><br> <a
                                href="<?php echo e(route('profile.page', ['slug' => Str::slug($value->getUser->firstname ?? '')])); ?>">
                                <?php echo e($value->getUser->firstname ?? ''); ?> </a> </p>
                            <p class="m-0 small">
                              <strong>Posted:</strong><br><?php echo e(optional($value->created_at)->format('d M Y')); ?>

                            </p>
                          </div>
                          <hr>
                          <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-dark mt-2"><i class="fas fa-rupee-sign"></i>
                              <?php echo e(\App\Helpers\Helper::formatIndianPrice($value->price)); ?></h6>
                            <button class="btn btn-sm btn-primary" onclick="contactOwner(<?php echo e($value->id); ?>)">Contact
                              Now</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- testimonial section -->
  <section class="testimonial-section">
    <h2 class="testimonial-heading"><?php echo e($testimonials->heading ?? 'What Our Clients Say'); ?></h2>
    <p><?php echo e($testimonials->title ?? ''); ?></p>
    <div class="testimonial-slider pt-4 pb-4">
      <div class="testimonial-container">
        <!-- Testimonial 1 -->
        <?php if(isset($testimonial)): ?>
          <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $testimoniall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="testimonial-card">
              <div class="testimonial-profile">
                <img src="<?php echo e(asset('storage')); ?>/<?php echo e($testimoniall->image); ?>" alt="Client 1">
              </div>
              <div class="testimonial-content">
                <p class="testimonial-text">
                  <?php echo e($testimoniall->description); ?>

                </p>
                <div class="testimonial-stars">
                  ★★★★★
                </div>
                <h4 class="testimonial-name"><?php echo e($testimoniall->name); ?></h4>
                <p class="testimonial-role"><?php echo e($testimoniall->designation); ?></p>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

      </div>
    </div>
    <div class="col-sm-12 text-center mt-3">
      <button class="btn btn-feedback" type="button" data-target="#send-feedback" data-toggle="modal">Send
        Feedback</button>
    </div>
  </section>

  <!-- send feedback modal -->
  <div class="modal fade custom-modal" id="send-feedback" tabindex="-1" role="dialog" aria-labelledby="register"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <div class="top-design">
          <img src="<?php echo e(asset('images/top-designs.png')); ?>" class="img-fluid">
        </div>
        <div class="modal-body">
          <div class="modal-main">
            <div class="row login-heads">
              <div class="col-sm-12">
                <h3 class="heads-login">Send Feedback</h3>
                <span class="allrequired">All field are required</span>
              </div>
            </div>
            <div class="modal-form">
              <form method="post" action="<?php echo e(route('front.createTestimonial')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="label-control">Profile Picture</label>
                    <input type="file" class="text-control" name="image" required />
                  </div>
                  <div class="col-sm-6">
                    <label class="label-control">Name</label>
                    <input type="text" class="text-control" name="name" placeholder="Enter Name" required />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6">
                    <label class="label-control">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" class="text-control" required="">
                  </div>
                  <div class="col-sm-6">
                    <label class="label-control">Mobile No.</label>
                    <input type="number" class="text-control" name="mobile_number" placeholder="Enter Mobile No."
                      required="">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Designation</label>
                    <input type="text" class="text-control" name="designation" placeholder="Enter Designation" required />
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Feedback</label>
                    <textarea class="text-control" rows="4" cols="2" name="description" placeholder="Your Feedback here.."
                      required=""></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-send w-100">Send Feedback <i
                        class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- contact us section -->
  <section class="need-help-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title section-center">
            <h4><?php echo e($help_content->heading); ?></h4>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mobile-share">
        <div class="col-md-4">
          <div class="help-box box-1">
            <?php echo $help_content->content_one; ?>

            <a class="btn btn-startweb" href="https://wa.me/919451591515" target="_blank">
              Start Chat
            </a>

          </div>
        </div>
        <div class="col-md-4">
          <div class="help-box box-2">
            <?php echo $help_content->content_two; ?>

          </div>
        </div>
        <div class="col-md-4">
          <div class="help-box box-3">
            <?php echo $help_content->content_three; ?>

            <a class="btn btn-startweb" href="<?php echo e(route('front.faq')); ?>">
              View FAQ
            </a>

          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
    $app_content = App\FooterContent::where('slug', 'app')->first();
  ?>
<?php $__env->stopSection(); ?>

<!-- Hidden inputs to store latitude & longitude -->
<input type="hidden" id="latitude" name="latitude">
<input type="hidden" id="longitude" name="longitude">

<!-- Contact Business Modal -->
<div class="modal fade" id="contactOwnerModal" tabindex="-1" aria-labelledby="contactBusinessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="contactBusinessLabel">Contact Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="contactOwnerForm">
          <?php echo csrf_field(); ?>
          <input type="hidden" id="property_id" name="property_id">

          <!-- Step 1 -->
          <div class="step1">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name"
                value="<?php echo e(auth()->user()->firstname ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                value="<?php echo e(auth()->user()->email ?? ''); ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Mobile No.</label>
              <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                value="<?php echo e(auth()->user()->mobile_number ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Interested In</label>
              <select class="form-control" name="interested_in" id='interested_in' required>
                <option value=""> Select </option>
                <option value="1">Site Visit</option>
                <option value="2">Immediate Purchase</option>
                <option value="3">Home Loan</option>
              </select>
            </div>

            <button type="button" id="sendEnquiryBtn" class="btn btn-warning w-100">
              Send Enquiry <i class="fas fa-paper-plane ms-1"></i>
            </button>
          </div>

          <!-- Step 2: OTP Verification -->
          <div class="step2" style="display:none;">
            <div class="mb-3 text-center">
              <p class="fw-bold mb-2">Enter OTP sent to your mobile number</p>
              <input type="text" id="otp" class="form-control text-center" maxlength="4" placeholder="Enter 4-digit OTP"
                required>
            </div>
            <button type="button" id="verifyOtpBtn" class="btn btn-success w-100">Verify & Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $__env->startSection('js'); ?>


  <script>
    function detectLocation() {
      // Prefer browser geolocation
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // You now have precise coords; you can reverse-geocode to city if needed
            console.log('Browser location:', lat, lng);
          },
          (error) => {
            console.warn('Geolocation failed, falling back to IP:', error);
            fallbackIpLocation();
          },
          { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
      } else {
        // Fallback if geolocation not supported
        fallbackIpLocation();
      }
    }

    async function fallbackIpLocation() {
      try {
        const res = await fetch('https://ipapi.co/json/');
        const data = await res.json();

        const city = data.city || '';
        const lat = data.latitude || '';
        const lng = data.longitude || '';

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        const citySelect = document.querySelector('.newupdateSearchBar select');
        if (citySelect && city) {
          let found = false;
          for (let option of citySelect.options) {
            if (option.text.toLowerCase() === city.toLowerCase()) {
              option.selected = true;
              found = true;
              break;
            }
          }
          if (!found) {
            const newOption = new Option(city, city);
            citySelect.add(newOption, 0);
            newOption.selected = true;
          }
        }

        console.log('IP-based location:', city, lat, lng);
      } catch (err) {
        console.warn('IP-based location failed:', err);
      }
    }

    // Run on page load
    detectLocation();

  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let currentActiveTab = 'buy'; // Default active tab
      let selectedCityId = null;
      let selectedCityName = null;

      // Track active tab changes
      document.querySelectorAll('.newupdateTab').forEach(function (tab) {
        tab.addEventListener('click', function () {
          currentActiveTab = this.getAttribute('data-type');
        });
      });

      // When filter button is clicked, load appropriate filters into offcanvas
      const filterButton = document.querySelector('.newupdateSearchIcon.mobile-view');
      if (filterButton) {
        filterButton.addEventListener('click', function () {
          loadMobileFilters(currentActiveTab);
        });
      }

      // City selection from locationCanvas
      document.querySelectorAll('#locationList .city-item').forEach(function (cityItem) {
        cityItem.addEventListener('click', function () {
          selectedCityId = this.getAttribute('data-city-id');
          selectedCityName = this.getAttribute('data-city-name');

          // Update display
          document.getElementById('selectedCityName').textContent = selectedCityName;
          document.getElementById('selectedCityDisplay').style.display = 'block';

          // Close locationCanvas - Simple method without getInstance
          const locationCanvasEl = document.getElementById('locationCanvas');
          const closeBtn = locationCanvasEl.querySelector('.btn-close, .fa-arrow-left');
          if (closeBtn) {
            closeBtn.click();
          }
        });
      });

      // Clear city selection
      const clearButton = document.getElementById('clearCitySelection');
      if (clearButton) {
        clearButton.addEventListener('click', function () {
          selectedCityId = null;
          selectedCityName = null;
          document.getElementById('selectedCityDisplay').style.display = 'none';
        });
      }

      // Search functionality for cities
      const locationSearch = document.getElementById('locationSearch');
      if (locationSearch) {
        locationSearch.addEventListener('input', function () {
          const searchValue = this.value.toLowerCase();
          const cities = document.querySelectorAll('#locationList .city-item');
          let anyMatch = false;

          cities.forEach(city => {
            if (city.textContent.toLowerCase().includes(searchValue)) {
              city.style.display = 'block';
              anyMatch = true;
            } else {
              city.style.display = 'none';
            }
          });

          const noCityFound = document.getElementById('noCityFound');
          if (noCityFound) {
            noCityFound.style.display = anyMatch ? 'none' : 'block';
          }
        });
      }

      function loadMobileFilters(tabType) {
        const mobileFilterContent = document.getElementById('mobileFilterContent');
        if (!mobileFilterContent) return;

        // Clear previous content
        mobileFilterContent.innerHTML = '';

        switch (tabType) {
          case 'buy':
            mobileFilterContent.innerHTML = `
                                                  <!-- Property Category -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Property Category</h6>
                                                      <select class="form-select sub_category_items" id="mobile_sub_category_id">
                                                          <option value="">Select Category</option>
                                                          <?php $__currentLoopData = $buyFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Property Type -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Property Type</h6>
                                                      <div class="property-type-checkboxes" style="max-height:150px; padding-left:10px; overflow-y:auto;">
                                                          <?php $__currentLoopData = $buyFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="form-check" data-category="<?php echo e($type->sub_category_id); ?>">
                                                                <input class="form-check-input mobile-sub-sub-checkbox" type="checkbox" 
                                                                       name="mobile_sub_sub_category_ids[]"
                                                                       id="mobile_subsub_<?php echo e($type->id); ?>" value="<?php echo e($type->id); ?>">
                                                                <label class="form-check-label" for="mobile_subsub_<?php echo e($type->id); ?>">
                                                                    <?php echo e($type->sub_sub_category_name); ?>

                                                                </label>
                                                            </div>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </div>
                                                  </div>

                                                  <!-- Budget -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Budget</h6>
                                                      <select class="form-select" id="mobile_budget">
                                                          <option value="">Select Budget</option>
                                                          <?php $__currentLoopData = $buyFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Posted By -->
                                                  <div class="filter-item py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Posted By</h6>
                                                      <select class="form-select" id="mobile_user_role">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $buyFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>
                                              `;
            break;

          case 'rental':
            mobileFilterContent.innerHTML = `
                                                  <!-- Property Category -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Property Category</h6>
                                                      <select class="form-select sub_category_items" id="mobile_sub_category_id">
                                                          <option value="">Select Category</option>
                                                          <?php $__currentLoopData = $rentalFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Property Type -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Property Type</h6>
                                                      <div class="property-type-checkboxes" style="max-height:150px;padding-left:10px; overflow-y:auto;">
                                                          <?php $__currentLoopData = $rentalFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="form-check" data-category="<?php echo e($v->sub_category_id); ?>">
                                                                <input class="form-check-input mobile-sub-sub-checkbox" type="checkbox" 
                                                                       name="mobile_sub_sub_category_ids[]"
                                                                       id="mobile_subsub_<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>">
                                                                <label class="form-check-label" for="mobile_subsub_<?php echo e($v->id); ?>">
                                                                    <?php echo e($v->sub_sub_category_name); ?>

                                                                </label>
                                                            </div>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </div>
                                                  </div>

                                                  <!-- Budget -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Budget</h6>
                                                      <select class="form-select" id="mobile_budget">
                                                          <option value="">Select Budget</option>
                                                          <?php $__currentLoopData = $rentalFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Posted By -->
                                                  <div class="filter-item py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Posted By</h6>
                                                      <select class="form-select" id="mobile_user_role">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $rentalFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>
                                              `;
            break;

          case 'pg-hostels':
            mobileFilterContent.innerHTML = `
                                                  <!-- Budget -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Budget</h6>
                                                      <select class="form-select" id="mobile_budget">
                                                          <option value="">Select Budget</option>
                                                          <?php $__currentLoopData = $pgFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Available For -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Available For</h6>
                                                      <select class="form-select" id="mobile_pg_availavle_for">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $pgFilters['available_for']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($option)); ?>"><?php echo e($option); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Posted By -->
                                                  <div class="filter-item py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Posted By</h6>
                                                      <select class="form-select" id="mobile_user_role">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $pgFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>
                                              `;
            break;

          case 'exculsive-launch':
            mobileFilterContent.innerHTML = `
                                                  <!-- Sub Category -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Sub Category</h6>
                                                      <select class="form-select sub_category_items" id="mobile_sub_category_id">
                                                          <option value="">Select Category</option>
                                                          <?php $__currentLoopData = $exclusiveFilters['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->sub_category_name); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Budget -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Budget</h6>
                                                      <select class="form-select" id="mobile_budget">
                                                          <option value="">Select Budget</option>
                                                          <?php $__currentLoopData = $exclusiveFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Posted By -->
                                                  <div class="filter-item py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Posted By</h6>
                                                      <select class="form-select" id="mobile_user_role">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $exclusiveFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>
                                              `;
            break;

          case 'plot-land':
            mobileFilterContent.innerHTML = `
                                                  <!-- Property Type -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Property Type</h6>
                                                      <div class="property-type-checkboxes" style="max-height:150px;padding-left:10px; overflow-y:auto;">
                                                          <?php $__currentLoopData = $plotFilters['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input mobile-sub-sub-checkbox" type="checkbox" 
                                                                       name="mobile_sub_sub_category_ids[]"
                                                                       id="mobile_subsub_<?php echo e($v->id); ?>" value="<?php echo e($v->id); ?>">
                                                                <label class="form-check-label" for="mobile_subsub_<?php echo e($v->id); ?>">
                                                                    <?php echo e($v->sub_sub_category_name); ?>

                                                                </label>
                                                            </div>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </div>
                                                  </div>

                                                  <!-- Budget -->
                                                  <div class="filter-item border-bottom py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Budget</h6>
                                                      <select class="form-select" id="mobile_budget">
                                                          <option value="">Select Budget</option>
                                                          <?php $__currentLoopData = $plotFilters['budgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($budget['query']); ?>"><?php echo e($budget['label']); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>

                                                  <!-- Posted By -->
                                                  <div class="filter-item py-2 mb-3">
                                                      <h6 class="fw-semibold mb-2">Posted By</h6>
                                                      <select class="form-select" id="mobile_user_role">
                                                          <option value="">Select</option>
                                                          <?php $__currentLoopData = $plotFilters['posted_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e(strtolower($poster)); ?>"><?php echo e($poster); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                  </div>
                                              `;
            break;
        }

        // After loading content, add event listener for category changes (for Buy/Rental)
        if (tabType === 'buy' || tabType === 'rental') {
          setupPropertyTypeFiltering();
        }
      }

      // Filter property types based on selected category
      function setupPropertyTypeFiltering() {
        const categorySelect = document.getElementById('mobile_sub_category_id');
        if (categorySelect) {
          categorySelect.addEventListener('change', function () {
            const selectedCategory = this.value;
            const checkboxes = document.querySelectorAll('.mobile-sub-sub-checkbox');

            checkboxes.forEach(function (checkbox) {
              const parent = checkbox.closest('.form-check');
              const categoryAttr = parent.getAttribute('data-category');

              if (selectedCategory === '' || categoryAttr === selectedCategory) {
                parent.style.display = 'block';
              } else {
                parent.style.display = 'none';
                checkbox.checked = false;
              }
            });
          });
        }
      }

      // Handle Apply Filters button
      const applyButton = document.getElementById('mobileApplyFilters');
      if (applyButton) {
        applyButton.addEventListener('click', function () {
          const activeType = currentActiveTab;
          const location = selectedCityId;
          const searchInput = document.querySelector('.newupdateSearchBarmobile .newupdateSearchInput');
          const searchQuery = searchInput ? searchInput.value : '';

          // Get filter selects based on active type
          const subCategory = document.getElementById('mobile_sub_category_id')?.value || '';
          const budget = document.getElementById('mobile_budget')?.value || '';
          const userRole = document.getElementById('mobile_user_role')?.value || '';
          const pgAvailableFor = document.getElementById('mobile_pg_availavle_for')?.value || '';

          // Build URLSearchParams
          let params = new URLSearchParams();

          // Add type
          params.append('type', activeType);

          // Add location (city)
          if (location) {
            params.append('city', location);
          }

          // Add search query
          if (searchQuery) {
            params.append('search', searchQuery);
          }

          // Add sub_category_id
          if (subCategory) {
            params.append('sub_category_id', subCategory);
          }

          // Add budget
          if (budget) {
            params.append('budget', budget);
          }

          // Add user_role
          if (userRole) {
            params.append('user_role', userRole);
          }

          // Add PG available for
          if (pgAvailableFor) {
            params.append('pg_availavle_for', pgAvailableFor);
          }

          // Collect checked property types
          const checkedBoxes = document.querySelectorAll('.mobile-sub-sub-checkbox:checked');
          if (checkedBoxes.length > 0) {
            const values = Array.from(checkedBoxes).map(cb => cb.value);
            params.append('sub_sub_category_id', values.join(','));
          }

          // Redirect to listing.list route
          window.location.href = "<?php echo e(route('listing.list')); ?>?" + params.toString();
        });
      }
    });
  </script>

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function () {

      $('.sub_category_items').change(function () {
        const selectedCategory = $(this).val();
        const $container = $(this).closest('.newupdateFilters').find('.form-check'); // target checkboxes in the same tab

        console.log(selectedCategory);

        $container.each(function () {
          const typeCategory = $(this).data('category');

          if (selectedCategory === "" || typeCategory == selectedCategory) {
            $(this).show();
          } else {
            $(this).hide();
            $(this).find('input').prop('checked', false);
          }
        });

        // Expand the collapse if necessary
        if (selectedCategory) {
          $(this).closest('.newupdateFilters').find('.propertyTypeBuy').collapse('show');
        } else {
          $(this).closest('.newupdateFilters').find('.propertyTypeBuy').collapse('hide');
        }
      });



    });

  </script>

  <!-- JS -->
  <script>
    document.querySelectorAll('.property-tab').forEach(tab => {
      tab.addEventListener('click', function () {
        document.querySelectorAll('.property-tab').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');
        document.querySelectorAll('.property-card').forEach(card => {
          if (filter === 'all' || card.getAttribute('data-type') === filter) {
            card.classList.remove('hide');
          } else {
            card.classList.add('hide');
          }
        });
      });
    });
  </script>
  <script>
    (function () {
      const buttons = document.querySelectorAll('.tabs-btns .btn');
      const cards = document.querySelectorAll('.property-card');


      function setActiveButton(activeBtn) {
        buttons.forEach(b => b.classList.remove('active'));
        activeBtn.classList.add('active');
      }


      function filterCards(type) {
        cards.forEach(card => {
          const t = card.getAttribute('data-type');
          if (type === 'all' || t === type) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      }


      buttons.forEach(btn => {
        btn.addEventListener('click', function () {
          const type = this.getAttribute('data-filter');
          setActiveButton(this);
          filterCards(type);
        });
      });


      // initial state - show all
      filterCards('all');


    })();
  </script>

  <script>

    const tabs = document.querySelectorAll('.newupdateTab');
    const searchBar = document.querySelector('.newupdateSearchBar');
    const searchInput = document.querySelector('.newupdateSearchInput');
    const filterBlocks = document.querySelectorAll('.newupdateFilters');

    // Switch tabs
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const type = tab.getAttribute('data-type');
        searchBar.setAttribute('data-type', type);

        filterBlocks.forEach(f => f.style.display = 'none');
        const activeFilter = document.querySelector(`.newupdateFilters[data-type="${type}"]`);
        if (activeFilter) activeFilter.style.display = 'block';

        let placeholder = '';
        switch (type) {
          case 'buy': placeholder = 'Search by Project, Locality, or Builder'; break;
          case 'rental': placeholder = 'Search by Location, Apartment, or PG'; break;
          case 'pg-hostels': placeholder = 'Search by PG Name or Locality'; break;
          case 'exculsive-launch': placeholder = 'Search by Project or Builder'; break;
          case 'plot-land': placeholder = 'Search by Area or Plot Type'; break;
          default: placeholder = 'Search properties...';
        }
        searchInput.placeholder = placeholder;
      });
    });

    // Search button click
    document.querySelectorAll('.newupdateSearchBtn').forEach(btn => {
      btn.addEventListener('click', function () {
        const activeType = document.querySelector('.newupdateTab.active').getAttribute('data-type') ?? 'buy';

        const location = document.querySelector('.newupdateSearchBar select').value;
        const searchQuery = document.querySelector('.newupdateSearchInput').value;

        const activeFilters = document.querySelector(`.newupdateFilters[data-type="${activeType}"]`);
        const selects = activeFilters.querySelectorAll('select');

        let params = new URLSearchParams();
        params.append('type', activeType);
        if (location) params.append('city', location);
        if (searchQuery) params.append('search', searchQuery);

        // Loop through all select dropdowns
        selects.forEach(select => {
          if (select.value) {
            params.append(select.id, select.value);
          }
        });

        // ✅ Collect all checked property type checkboxes
        const checkedBoxes = activeFilters.querySelectorAll('.sub-sub-checkbox:checked');
        if (checkedBoxes.length > 0) {
          const values = Array.from(checkedBoxes).map(cb => cb.value);
          params.append('sub_sub_category_id', values.join(',')); // comma-separated list
        }

        // Redirect to backend route with all filters
        window.location.href = "<?php echo e(route('listing.list')); ?>" + "?" + params.toString();
      });
    });

    // Search button click
    document.getElementById('location-detect').addEventListener('click', function () {
      const activeType = document.querySelector('.newupdateTab.active').getAttribute('data-type') ?? 'buy';

      const location = document.querySelector('.newupdateSearchBar select').value;
      const searchQuery = document.querySelector('.newupdateSearchInput').value;

      const activeFilters = document.querySelector(`.newupdateFilters[data-type="${activeType}"]`);
      const selects = activeFilters.querySelectorAll('select');

      let params = new URLSearchParams();
      params.append('type', activeType);
      if (location) params.append('city', location);
      if (searchQuery) params.append('search', searchQuery);

      // Loop through all select dropdowns
      selects.forEach(select => {
        if (select.value) {
          params.append(select.id, select.value);
        }
      });

      // Collect all checked property type checkboxes
      const checkedBoxes = activeFilters.querySelectorAll('.sub-sub-checkbox:checked');
      if (checkedBoxes.length > 0) {
        const values = Array.from(checkedBoxes).map(cb => cb.value);
        params.append('sub_sub_category_id', values.join(',')); // comma-separated list
      }

      // Add latitude and longitude from hidden inputs
      const lat = document.getElementById('latitude').value;
      const lng = document.getElementById('longitude').value;
      if (lat && lng) {
        params.append('latitude', lat);
        params.append('longitude', lng);
      }

      // Redirect to backend route with all filters
      window.location.href = "<?php echo e(route('listing.list')); ?>" + "?" + params.toString();
    });


    // Show default buy filters
    document.querySelector(`.newupdateFilters[data-type="buy"]`).style.display = 'block';

  </script>

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper('.directory-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1, // 📱 Mobile: 1 card
        },
        768: {
          slidesPerView: 2, // Tablet: 2 cards
        },
        992: {
          slidesPerView: 3, // Desktop: 3 cards
        },
        1200: {
          slidesPerView: 4, // Large Desktop: 4 cards
        },
      },
    });
  </script>

  <script>
    // Tab switching
    const newTabButtons = document.querySelectorAll(".new-tab-btn");
    const newTabContents = document.querySelectorAll(".new-tab-content");

    newTabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        newTabButtons.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        const target = btn.getAttribute("data-tab");
        newTabContents.forEach((content) => {
          content.classList.toggle("active", content.id === target);
        });
      });
    });


    // Infinite Auto Slide
    // setInterval(() => {
    //   document.querySelectorAll(".new-slider-container").forEach((container) => {
    //     container.appendChild(container.firstElementChild);
    //   });
    // }, 2500);

    // Infinite Auto Slide for Testimonials
    setInterval(() => {
      const container = document.querySelector(".testimonial-container");
      container.appendChild(container.firstElementChild);
    }, 3500);

  </script>

  <script type="text/javascript">
    $(document).ready(function () {
      // Toggle collapse when clicking on the "Property Type" label
      $('#propertyTypeLabelRental').click(function () {
        $('.propertyTypeRental').collapse('toggle');
      });
    });
    $(document).ready(function () {
      // Toggle collapse when clicking on the "Property Type" label
      $('#propertyTypeLabelBuy').click(function () {
        $('.propertyTypeBuy').collapse('toggle');
      });
    });
    $("#search_property").validate();
  </script>
  <script>
    document.getElementById("locationSearch").addEventListener("input", function () {
      const searchValue = this.value.toLowerCase();
      const cities = document.querySelectorAll("#locationList .city-item");
      let anyMatch = false;

      cities.forEach(city => {
        if (city.textContent.toLowerCase().includes(searchValue)) {
          city.style.display = "block";
          anyMatch = true;
        } else {
          city.style.display = "none";
        }
      });

      document.getElementById("noCityFound").style.display = anyMatch ? "none" : "block";
    });
  </script>
  <script>
    function shareProperty(url, title) {
      if (navigator.share) {
        navigator.share({
          title: title,
          url: url
        }).then(() => {
          console.log('Shared successfully');
        }).catch((error) => {
          console.log('Error sharing:', error);
        });
      } else {
        alert('Your browser does not support the share feature. Copy the link: ' + url);
      }
    }
    const isAuthenticated = <?php echo e(auth()->check() ? 'true' : 'false'); ?>;
    function contactOwner(propertyId) {
      document.getElementById('property_id').value = propertyId;
      document.getElementById('interested_in').value = '';
      document.querySelector('.step1').style.display = 'block';
      document.querySelector('.step2').style.display = 'none';

      $('#contactOwnerModal').modal('show');

    }
    // Step 1: Send enquiry (or trigger OTP for guests)
    document.getElementById('sendEnquiryBtn').addEventListener('click', function (e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('contactOwnerForm'));

      // ✅ If logged in → directly submit enquiry
      if (isAuthenticated) {
        submitEnquiry(formData);
        return;
      }

      // 🚀 Guest user → send OTP first
      fetch("<?php echo e(route('agent.send-otp')); ?>", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'info',
              title: 'OTP Sent!',
              text: 'We have sent a 4-digit OTP to your mobile number.',
              confirmButtonColor: '#ffc107'
            });

            document.querySelector('.step1').style.display = 'none';
            document.querySelector('.step2').style.display = 'block';
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message || 'Failed to send OTP. Try again.',
            });
          }
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Unable to send OTP. Please try again later.',
          });
        });
    });

    // Step 2: Verify OTP (guests only)
    document.getElementById('verifyOtpBtn').addEventListener('click', function (e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('contactOwnerForm'));
      formData.append('otp', document.getElementById('otp').value);

      submitEnquiry(formData);
    });

    // ✅ Common function for submitting final enquiry
    function submitEnquiry(formData) {
      fetch("<?php echo e(route('enquery.agent_enquiry')); ?>", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          console.log('Response from server:', data);

          if (data.success === true || data.success === "true") {
            $('#contactOwnerModal').modal('hide');

            document.getElementById('contactOwnerForm').reset();
            document.querySelector('.step1').style.display = 'block';
            document.querySelector('.step2').style.display = 'none';

            Swal.fire({
              icon: 'success',
              title: 'Enquiry Sent!',
              text: 'Your enquiry has been sent successfully!',
              confirmButtonColor: '#ffc107'
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Invalid OTP',
              text: data.message || 'Please enter the correct OTP.',
            });
          }
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error sending enquiry. Please try again later.',
          });
        });
    }

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/home.blade.php ENDPATH**/ ?>