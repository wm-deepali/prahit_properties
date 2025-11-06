
<?php $__env->startSection('title'); ?>
    <title>Directory Listing</title>
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .directory-card {
        display: flex;
        background: #ffffff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        margin-bottom: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .directory-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .logo-section {
        position: relative;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .company-logo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .content-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f3f3f32e;
        padding: 10px;
    }

    .directory-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .company-name {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        flex: 1;
        color: #1a202c;
    }

    .directory-actions {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
    }

    .action-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s;
    }

    .action-btn i {
        color: #666;
    }

    .action-btn:hover i {
        color: #e38e32;
    }

    .directory-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 12px;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .feature-item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 8px;
        background: #f8f9fa;
        border-radius: 6px;
        transition: background 0.2s;
    }

    .feature-item:hover {
        background: #edf2f7;
    }

    .feature-icon {
        font-size: 15px;
        margin-bottom: 4px;
        color: #e38e32;
    }

    .feature-label {
        font-size: 12px;
        color: #718096;
    }

    .feature-value {
        font-size: 10px;
        font-weight: 600;
        color: #2d3748;
    }

    .short-content {
        font-size: 14px;
        color: #718096;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .directory-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #718096;
    }

    .directory-buttons {
        display: flex;
        gap: 8px;
    }

    .contact-btn {
        flex: 1;
        background: #e38e32;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .contact-btn:hover {
        background: #d97706;
    }

    .detail-btn {
        flex: 1;
        background: #ffffff;
        color: #e38e32;
        border: 1px solid #e38e32;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .detail-btn:hover {
        background: #fff5f5;
        color: #d97706;
    }

    .directory-filter {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        position: sticky;
        top: 20px;
    }

    .directory-filter h2 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 7px 0;
        color: #000;
        text-transform: uppercase;
    }

    .directory-filter .reset-btn {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 12px;
    }

    .directory-filter .reset-btn button {
        background: none;
        border: none;
        color: #a855f7;
        font-size: 14px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .directory-filter .category-group {
        margin-bottom: 16px;
    }

    .directory-filter .category-button {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .directory-filter .category-button button {
        width: fit-content;
        padding: 4px 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #fff;
        font-size: 14px;
        cursor: pointer;
        gap: 2px;
        color: gray;
    }

    .directory-filter .rating-group {
        margin-bottom: 16px;
    }

    .directory-filter .rating-button {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .directory-filter .rating-button button {
        width: 100%;
        padding: 4px 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #fff;
        font-size: 14px;
        cursor: pointer;
        color: gray;
        text-align: start;
    }

    .right-sorting {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        margin-bottom: 16px;
    }

    .right-sorting .search-title {
        font-size: 16px;
        font-weight: 600;
        color: #6b7280;
    }

    .right-sorting .sorting-options {
        display: flex;
        gap: 8px;
    }

    .right-sorting .sorting-options select {
        padding: 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 14px;
        background: #f9fafb;
        cursor: pointer;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: rgb(51 51 51 / 10%) !important;
        border: 0;
        opacity: .25;
    }

    .top-search-section {
        background: #efefef;
        padding: 16px;
        margin-bottom: 16px;
        position: sticky;
        top: 0;
        z-index: 10;
        width: 100%;
    }

    .search-container {
        width: 50%;
        display: flex;
        align-items: center;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        color: #6b7280;
        font-size: 16px;
    }

    .search-input {
        width: 100%;
        padding: 8px 40px 8px 40px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 14px;
        background: #f9fafb;
        appearance: none;
        cursor: text;
    }

    .search-input:focus {
        outline: none;
        border-color: #a855f7;
        box-shadow: 0 0 0 2px rgba(168, 85, 247, 0.2);
    }

    .mic-icon {
        position: absolute;
        right: 12px;
        color: #6b7280;
        font-size: 16px;
        cursor: pointer;
    }

    .filter-buttons {
        width: 40%;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-label {
        font-size: 14px;
        color: #6b7280;
        margin-right: 10px;
        white-space: nowrap;
    }


    .filter-btn {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #f9fafb;
        font-size: 14px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .filter-btn:hover {
        background: #f3e8ff;
        border-color: #a855f7;
    }

    .filter-btn.active {
        background: #e38e32;
        color: white;
        border-color: #e38e32;
    }

    .filter-btn i {
        margin-right: 4px;
        font-size: 13px;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
    }

    .listing-page-left {
        flex: 0 0 300px;
        max-width: 300px;
        margin-right: 16px;
    }

    /*.listing-page-right {*/
    /*    flex: 1;*/
    /*    overflow-y: auto;*/
    /*    max-height: calc(100vh - 100px);*/
    /*}*/
    .category-group {

        width: 100%;
        padding: 10px;
        background: #fff;

    }

    .category-group h2 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 7px 0;
        color: #000;
        text-transform: uppercase;
    }

    .category-list {
        /*border: 1px solid #d1d5db;*/
        border-radius: 3px;
        display: flex;
        flex-direction: column;
        /*gap: 10px;*/
        width: 100%;
    }

    .category-wrapper {
        width: 100%;
    }

    .category-item {
        padding: 8px 12px;
        border-bottom: 1px solid #d1d5db;
        /*border-radius: 4px;*/
        background: #f9f9f9;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        color: gray;
        transition: background-color 0.2s, color 0.2s;
        width: 100%;
        /*text-align: center;*/
        margin: 0px;
    }

    .category-item.active {
        background-color: #e38e32;
        color: white;
    }

    .subcategory-section {
        margin-top: 10px;
        width: 100%;
        padding: 0 10px;
    }

    .separator {
        border: 0;
        height: 1px;
        background: #d1d5db;
        margin: 10px 0;
    }

    .subcategory-list {
        padding-left: 20px;
    }

    .subcategory-list p {
        margin: 0px 0;
        font-size: 14px;
        color: #333;
        cursor: pointer;
        padding: 8px 12px;
        border-bottom: 1px solid #d1d5db;
        /*border-radius: 4px;*/
        background: #fff;
        width: 100%;
        /*text-align: center;*/
    }

    .subcategory-list p.active {
        font-weight: 600;
        background-color: #f7f6f5;
        color: #6e6e6e;
        border-color: #d97706;

    }

    .sort-btn {
        width: 100%;
        background: #f8f9fa40;
        border: 1px solid #ddd;
        color: #333;
        font-weight: 500;
        border-radius: 8px;
        padding: 10px;
        text-align: left;
        transition: all 0.2s ease;
    }

    .sort-btn:hover {
        background: #e9f2ff;
        border-color: #007bff;
        color: #007bff;
    }

    .sort-btn.active {
        background: orange;
        color: #fff;
        border-color: orange;
    }

    .offcanvas-body {
        padding: 15px;
    }

    .accordion-button {
        background: #f7f9fc;
        color: #0d1b3e;
        font-weight: 600;
        border-radius: 8px !important;
        box-shadow: none;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e6f0ff;
        color: #0056d2;
    }

    .accordion-body {
        padding-left: 20px;
        padding-bottom: 10px;
    }

    .accordion-body label {
        font-size: 14px;
        color: #333;
        display: block;
        margin-bottom: 6px;
    }

    .accordion-body input[type="checkbox"] {
        accent-color: #0056d2;
    }

    #offcanvasBottom {
        height: 50vh !important;
        /* makes drawer taller */
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
</style>

<?php $__env->startSection('content'); ?>
    <section style="background:#f9f9f9;">
        <div class="top-search-section">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search Anything"
                        value="<?php echo e(request('search')); ?>">
                    <i class="fas fa-microphone mic-icon"></i>
                </div>
                <div class="filter-buttons">
                    <span class="filter-label">Quick Filters:</span>
                    <button class="filter-btn <?php echo e(request('verified') == 'true' ? 'active' : ''); ?>" data-filter="verified"
                        onclick="applyQuickFilter('verified')">
                        <i class="fas fa-check-circle"></i> Verified
                    </button>

                    <button class="filter-btn <?php echo e(request('premium') == 'true' ? 'active' : ''); ?>" data-filter="premium"
                        onclick="applyQuickFilter('premium')">
                        <i class="fas fa-crown"></i> Premium
                    </button>

                    <button class="filter-btn <?php echo e(request('sort') == 'rating-high' ? 'active' : ''); ?>"
                        data-filter="top_rated" onclick="applyQuickFilter('top_rated')">
                        <i class="fas fa-star"></i> Top Rated
                    </button>

                    <button class="filter-btn <?php echo e(request('sort') == 'views-high' ? 'active' : ''); ?>"
                        data-filter="most_viewed" onclick="applyQuickFilter('most_viewed')">
                        <i class="fas fa-fire"></i> Popular
                    </button>
                </div>
            </div>
        </div>

        <div class="filter-inmobile">
            <!-- <div class="ver-line"></div> -->
            <div class="filter-text" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                aria-controls="offcanvasBottom">
                <p class="m-0"><i class="fa-solid fa-sort"></i> Short By</p>
            </div>
            <div class="ver-line"></div>
            <div class="filter-text">
                <p class="m-0" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"><i
                        class="fa-solid fa-sliders"></i> Filter</p>
            </div>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="filterMenuLabel"
            style="width: 320px;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-semibold" id="filterMenuLabel"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body" style="background:#f9f9f9; text-align: left;">
                <div class="directory-filter">
                    <div class="reset-btn d-flex justify-content-between align-items-center">
                        <h2 style="font-size:20px;">Filters</h2>
                        <button onclick="resetFilters()">Reset</button>
                    </div>
                    <hr>
                    <div class="category-group">
                        <h2>Categories</h2>
                        <hr>
                        <div class="category-list">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="category-wrapper">
                                    <p class="category-item" data-category-id="<?php echo e($category->id); ?>"
                                        onclick="toggleCategory(this, '<?php echo e($category->category_name); ?>', <?php echo e($category->id); ?>)">
                                        <?php echo e($category->category_name); ?>

                                    </p>
                                    <div class="subcategory-section" style="display: none;">
                                        <div class="subcategory-list">
                                            <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <p data-subcategory-id="<?php echo e($subCat->id); ?>"
                                                    onclick="selectSubCategory(this, <?php echo e($category->id); ?>, <?php echo e($subCat->id); ?>)">
                                                    <?php echo e($subCat->sub_category_name); ?>

                                                </p>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="rating-group">
                        <h2>Ratings</h2>
                        <div class="rating-button">
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="rating" value="5">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <i class="fas fa-star"></i><i class="fas fa-star"></i> 5 Stars
                            </button>
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="rating" value="4">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <i class="fas fa-star"></i><i class="far fa-star"></i> 4 Stars & Above
                            </button>
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="rating" value="3">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <i class="far fa-star"></i><i class="far fa-star"></i> 3 Stars & Above
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="category-group">
                        <h2>Apply Filter</h2>
                        <div class="category-button">
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="verified" value="true">
                                Verified Sellers
                            </button>
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="premium" value="true">
                                Premium Sellers
                            </button>
                            <button>
                                <input type="checkbox" class="filter-checkbox" name="most_rated" value="true">
                                Most Rated
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Sort By</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body" style="min-height: 300px;">
                <div class="sorting-options" style="display: flex; flex-direction: column; gap: 12px;">
                    <!--<span style="font-weight: 600; color: #0d1b3e;">Sort by:</span>-->
                    <button class="sort-btn" data-value="rating-high">Rating: High to Low</button>
                    <button class="sort-btn" data-value="views-high">Views:
                        High to Low</button>
                    <button class="sort-btn" data-value="established-old">Established
                        Year: Oldest First</button>
                    <button class="sort-btn" data-value="member-old">Member
                        Since: Oldest First</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="listing-page">
                    <div class="listing-page-left">
                        <div class="directory-filter">
                            <div class="reset-btn d-flex justify-content-between align-items-center">
                                <h2 style="font-size:20px;">Filters</h2>
                                <button onclick="resetFilters()">Reset</button>
                            </div>
                            <hr>
                            <div class="category-group">
                                <h2>Categories</h2>
                                <hr>
                                <div class="category-list">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="category-wrapper">
                                            <p class="category-item" data-category-id="<?php echo e($category->id); ?>"
                                                onclick="toggleCategory(this, '<?php echo e($category->category_name); ?>', <?php echo e($category->id); ?>)">
                                                <?php echo e($category->category_name); ?>

                                            </p>
                                            <div class="subcategory-section" style="display: none;">
                                                <div class="subcategory-list">
                                                    <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p data-subcategory-id="<?php echo e($subCat->id); ?>"
                                                            onclick="selectSubCategory(this, <?php echo e($category->id); ?>, <?php echo e($subCat->id); ?>)">
                                                            <?php echo e($subCat->sub_category_name); ?>

                                                        </p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="rating-group">
                                <h2>Ratings</h2>
                                <div class="rating-button">
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="rating" value="5">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i> 5 Stars
                                    </button>
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="rating" value="4">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i><i class="far fa-star"></i> 4 Stars & Above
                                    </button>
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="rating" value="3">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        <i class="far fa-star"></i><i class="far fa-star"></i> 3 Stars & Above
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="category-group">
                                <h2>Apply Filter</h2>
                                <div class="category-button">
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="verified" value="true">
                                        Verified Sellers
                                    </button>
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="premium" value="true">
                                        Premium Sellers
                                    </button>
                                    <button>
                                        <input type="checkbox" class="filter-checkbox" name="most_rated" value="true">
                                        Most Rated
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="listing-page-right">
                        <div class="right-sorting">
                            <div class="search-title mb-2">
                                <strong>Directory Listing:</strong> Business Companies (<?php echo e($list->total()); ?> Results)
                            </div>
                            <div class="sorting-options">
                                <select id="sortSelect">
                                    <option value="default" <?php echo e(request('sort') == 'default' ? 'selected' : ''); ?>>Sort by:
                                        Default</option>
                                    <option value="rating-high" <?php echo e(request('sort') == 'rating-high' ? 'selected' : ''); ?>>
                                        Rating: High to Low</option>
                                    <option value="views-high" <?php echo e(request('sort') == 'views-high' ? 'selected' : ''); ?>>Views:
                                        High to Low</option>
                                    <option value="established-old" <?php echo e(request('sort') == 'established-old' ? 'selected' : ''); ?>>Established Year: Oldest First</option>
                                    <option value="member-old" <?php echo e(request('sort') == 'member-old' ? 'selected' : ''); ?>>Member
                                        Since: Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div id="directory-cards">
                            <?php echo $__env->make('front.partials.directory-items', ['list' => $list], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            <?php echo e($list->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Business Modal -->
    <div class="modal fade" id="contactBusinessModal" tabindex="-1" aria-labelledby="contactBusinessLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="contactBusinessLabel">Contact Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="contactBusinessForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="business_id" name="business_id">

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
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    value="<?php echo e(auth()->user()->mobile_number ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3"
                                    placeholder="Write your message..." required></textarea>
                            </div>

                            <button type="button" id="sendEnquiryBtn" class="btn btn-warning w-100">
                                Send Enquiry <i class="fas fa-paper-plane ms-1"></i>
                            </button>
                        </div>

                        <!-- Step 2: OTP Verification -->
                        <div class="step2" style="display:none;">
                            <div class="mb-3 text-center">
                                <p class="fw-bold mb-2">Enter OTP sent to your mobile number</p>
                                <input type="text" id="otp" class="form-control text-center" maxlength="4"
                                    placeholder="Enter 4-digit OTP" required>
                            </div>
                            <button type="button" id="verifyOtpBtn" class="btn btn-success w-100">Verify & Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        let selectedCategory = null;
        let selectedSubCategory = null;
        let selectedRating = null;
        let selectedFilters = {
            verified: false,
            premium: false,
            most_rated: false
        };
        let selectedSort = "<?php echo e(request('sort') ?? 'default'); ?>"; // unified for desktop & mobile

        // ✅ Apply quick filters (Verified, Premium, etc.)
        function applyQuickFilter(filterType) {
            const params = new URLSearchParams(window.location.search);
            params.delete('verified');
            params.delete('premium');
            params.delete('sort');

            // Remove all active quick filter highlights (both desktop + mobile if exists)
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));

            switch (filterType) {
                case 'verified':
                    params.set('verified', 'true');
                    document.querySelectorAll('.filter-btn[data-filter="verified"]').forEach(btn => btn.classList.add('active'));
                    break;
                case 'premium':
                    params.set('premium', 'true');
                    document.querySelectorAll('.filter-btn[data-filter="premium"]').forEach(btn => btn.classList.add('active'));
                    break;
                case 'top_rated':
                    params.set('sort', 'rating-high');
                    document.querySelectorAll('.filter-btn[data-filter="top_rated"]').forEach(btn => btn.classList.add('active'));
                    break;
                case 'most_viewed':
                    params.set('sort', 'views-high');
                    document.querySelectorAll('.filter-btn[data-filter="most_viewed"]').forEach(btn => btn.classList.add('active'));
                    break;
            }

            fetchDirectoryResults("<?php echo e(route('directory.list')); ?>?" + params.toString());
        }

        // ✅ Toggle category and show subcategories
        function toggleCategory(element, categoryName, categoryId) {
            const categoryWrappers = document.querySelectorAll('.category-wrapper');
            const subcategorySection = element.nextElementSibling;

            categoryWrappers.forEach(wrapper => {
                const categoryItem = wrapper.querySelector('.category-item');
                categoryItem.classList.remove('active');
                wrapper.querySelector('.subcategory-section').style.display = 'none';
            });

            element.classList.add('active');
            selectedCategory = categoryId;
            selectedSubCategory = null;
            subcategorySection.style.display = 'block';
            applyFilters();
        }

        // ✅ Select subcategory
        function selectSubCategory(element, categoryId, subCategoryId) {
            const subcategoryItems = element.parentElement.querySelectorAll('p');
            subcategoryItems.forEach(item => item.classList.remove('active'));
            element.classList.add('active');

            selectedCategory = categoryId;
            selectedSubCategory = subCategoryId;
            applyFilters();
        }

        // ✅ Debounced search
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 500);
        });

        // ✅ Desktop Sort change
        document.getElementById('sortSelect').addEventListener('change', function () {
            selectedSort = this.value;
            applyFilters();
        });

        // ✅ Mobile sort buttons
        document.querySelectorAll('.sort-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedSort = this.getAttribute('data-value');
                applyFilters();

                // Close offcanvas after applying
                const offcanvasEl = document.getElementById('offcanvasBottom');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) bsOffcanvas.hide();
            });
        });

        // ✅ Rating / checkbox filters
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (this.name === 'rating') {
                    document.querySelectorAll('.filter-checkbox[name="rating"]').forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                    selectedRating = this.checked ? this.value : null;
                } else if (this.name === 'verified') {
                    selectedFilters.verified = this.checked;
                } else if (this.name === 'premium') {
                    selectedFilters.premium = this.checked;
                } else if (this.name === 'most_rated') {
                    selectedFilters.most_rated = this.checked;
                }
                applyFilters();
            });
        });

        // ✅ Central function to apply filters (AJAX)
        function applyFilters(pageUrl = "<?php echo e(route('directory.list')); ?>") {
            const params = new URLSearchParams();

            const searchValue = document.getElementById('searchInput').value;
            if (searchValue) params.append('search', searchValue);
            if (selectedCategory) params.append('category', selectedCategory);
            if (selectedSubCategory) params.append('subcategory', selectedSubCategory);
            if (selectedRating) params.append('rating', selectedRating);
            if (selectedFilters.verified) params.append('verified', 'true');
            if (selectedFilters.premium) params.append('premium', 'true');
            if (selectedFilters.most_rated) params.append('most_rated', 'true');
            if (selectedSort && selectedSort !== 'default') params.append('sort', selectedSort);

            fetchDirectoryResults(pageUrl + "?" + params.toString());
        }

        // ✅ AJAX fetch (for filters & pagination)
        function fetchDirectoryResults(url) {
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $('#directory-cards').html('<div class="text-center py-5">Loading...</div>');
                },
                success: function (data) {
                    $('#directory-cards').html(data);
                    window.history.replaceState({}, '', url);
                },
                error: function () {
                    $('#directory-cards').html('<div class="text-center text-danger py-5">Error loading listings.</div>');
                }
            });
        }

        // ✅ Pagination click (AJAX)
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            const pageUrl = $(this).attr('href');
            fetchDirectoryResults(pageUrl);
        });

        // ✅ Reset filters
        function resetFilters() {
            selectedCategory = null;
            selectedSubCategory = null;
            selectedRating = null;
            selectedFilters = { verified: false, premium: false, most_rated: false };
            selectedSort = 'default';
            window.history.replaceState({}, '', "<?php echo e(route('directory.list')); ?>");
            fetchDirectoryResults("<?php echo e(route('directory.list')); ?>");
        }

        // ✅ Set active states on page load
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');
            const subcategoryParam = urlParams.get('subcategory');
            const ratingParam = urlParams.get('rating');

            const desktopFilter = document.querySelector('.listing-page-left');
            const mobileFilter = document.getElementById('offcanvasExample');

            function activateCategoryAndSubcategory(scope) {
                if (!scope) return;
                if (categoryParam) {
                    const categoryEl = scope.querySelector(`[data-category-id="${categoryParam}"]`);
                    if (categoryEl) {
                        categoryEl.classList.add('active');
                        const subSec = categoryEl.nextElementSibling;
                        if (subSec) subSec.style.display = 'block';
                        selectedCategory = parseInt(categoryParam);
                    }
                }
                if (subcategoryParam) {
                    const subcategoryEl = scope.querySelector(`[data-subcategory-id="${subcategoryParam}"]`);
                    if (subcategoryEl) {
                        subcategoryEl.classList.add('active');
                        selectedSubCategory = parseInt(subcategoryParam);
                    }
                }
            }

            function activateFilters(scope) {
                if (!scope) return;
                if (ratingParam) {
                    const ratingCheckbox = scope.querySelector(`.filter-checkbox[name="rating"][value="${ratingParam}"]`);
                    if (ratingCheckbox) {
                        ratingCheckbox.checked = true;
                        selectedRating = ratingParam;
                    }
                }
                if (urlParams.get('verified') === 'true') {
                    const el = scope.querySelector('.filter-checkbox[name="verified"]');
                    if (el) el.checked = true;
                    selectedFilters.verified = true;
                }
                if (urlParams.get('premium') === 'true') {
                    const el = scope.querySelector('.filter-checkbox[name="premium"]');
                    if (el) el.checked = true;
                    selectedFilters.premium = true;
                }
                if (urlParams.get('most_rated') === 'true') {
                    const el = scope.querySelector('.filter-checkbox[name="most_rated"]');
                    if (el) el.checked = true;
                    selectedFilters.most_rated = true;
                }
            }

            // ✅ Apply to both desktop and mobile filters
            activateCategoryAndSubcategory(desktopFilter);
            activateCategoryAndSubcategory(mobileFilter);
            activateFilters(desktopFilter);
            activateFilters(mobileFilter);

            // ✅ Activate correct sort button in mobile
            if (selectedSort) {
                const btn = document.querySelector(`.sort-btn[data-value="${selectedSort}"]`);
                if (btn) btn.classList.add('active');
            }
        });


    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // ❤️ Wishlist toggle (instant + stable)
            $(document).on('click', '.wishlist-btn', function (e) {
                e.preventDefault();

                const btn = $(this);
                const businessId = btn.data('business-id');

                // Instant toggle on button (not icon)
                btn.toggleClass('text-danger');

                $.ajax({
                    url: "<?php echo e(route('business.wishlist.toggle')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        business_listing_id: businessId
                    },
                    success: function (res) {
                        // Set button color based on response
                        if (res.status === 'added') {
                            btn.addClass('text-danger');
                        } else if (res.status === 'removed') {
                            btn.removeClass('text-danger');
                        }
                    },
                    error: function () {
                        alert('Please login to use wishlist.');
                        // Revert button state on error
                        btn.toggleClass('text-danger');
                    }
                });
            });

            // 📤 Share button
            $(document).on('click', '.share-btn', function () {
                const companyId = $(this).data('id');
                const name = $(this).data('name');
                const shareUrl = "<?php echo e(url('/business-details')); ?>/" + companyId;

                if (navigator.share) {
                    navigator.share({
                        title: name,
                        text: `Check out ${name} on our directory!`,
                        url: shareUrl
                    }).catch(() => { });
                } else {
                    navigator.clipboard.writeText(shareUrl);
                    Swal.fire('Link Copied!', 'URL copied to clipboard.', 'success');
                }
            });

            // ⋯ More button → View details
            $(document).on('click', '.more-btn', function () {
                window.location.href = $(this).data('url');
            });

        });
    </script>


    <script>

        const isAuthenticated = <?php echo e(auth()->check() ? 'true' : 'false'); ?>;

        function contactBusiness(businessId) {
            document.getElementById('business_id').value = businessId;
            document.getElementById('message').value = '';
            document.querySelector('.step1').style.display = 'block';
            document.querySelector('.step2').style.display = 'none';

          $('#contactBusinessModal').modal('show');

        }


        // Step 1: Send enquiry (or trigger OTP for guests)
        document.getElementById('sendEnquiryBtn').addEventListener('click', function (e) {
            e.preventDefault();

            let formData = new FormData(document.getElementById('contactBusinessForm'));

            // ✅ If logged in → directly submit enquiry
            if (isAuthenticated) {
                submitEnquiry(formData);
                return;
            }

            // 🚀 Guest user → send OTP first
            fetch("<?php echo e(route('business.sendOtp')); ?>", {
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

            let formData = new FormData(document.getElementById('contactBusinessForm'));
            formData.append('otp', document.getElementById('otp').value);

            submitEnquiry(formData);
        });

        // ✅ Common function for submitting final enquiry
        function submitEnquiry(formData) {
            fetch("<?php echo e(route('business.enquiry')); ?>", {
                method: "POST",
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    console.log('Response from server:', data);

                    if (data.success === true || data.success === "true") {
                        $('#contactBusinessModal').modal('hide');

                        document.getElementById('contactBusinessForm').reset();
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
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/directory-listing.blade.php ENDPATH**/ ?>