<?php $__env->startSection('title'); ?>
    <title>Welcome</title>
<?php $__env->stopSection(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    .listing-page-card {
        display: flex;
        background: #ffffff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        margin-bottom: 16px;
    }

    .image-section {
        position: relative;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .image-count {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .property-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .content-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        /*justify-content: space-between;*/
        background: #f3f3f32e;
        padding: 10px;
    }

    .listing-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .listing-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        flex: 1;
    }

    .listing-price {
        background: #e38e32;
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        margin-left: 8px;
    }

    .listing-actions {
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
    }

    .action-btn i {
        color: #666;
    }

    .listing-features {
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
    }

    .feature-icon {
        font-size: 15px;
        margin-bottom: 4px;
        color: #e38e32;
    }

    .feature-label {
        font-size: 12px;
        color: #666;
    }

    .feature-value {
        font-size: 10px;
        font-weight: 600;
        color: #333;
    }

    .listing-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .listing-owner-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
    }

    .owner-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e38e32;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .listing-buttons {
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
    }

    .society-btn {
        flex: 1;
        background: #ffffff;
        color: #e38e32;
        border: 1px solid #e38e32;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }

    .price-text {
        width: 100%;
        height: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: #f3f3f32e;
        padding-left: 15px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .price-text h2 {
        font-size: 22px;
    }

    .listing-filter {
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

    .listing-filter h2 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 7px 0;
        color: #000;
        text-transform: uppercase;

    }

    .listing-filter .reset-btn {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 12px;
    }

    .listing-filter .reset-btn button {
        background: none;
        border: none;
        color: #a855f7;
        font-size: 14px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .listing-filter .range-group {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .listing-filter .range-group select {
        width: 100%;
        padding: 4px 8px;
        border: 1px solid #ededed;
        border-radius: 4px;
        font-size: 14px;
        background: #ffffff;
        color: gray;
        /*appearance: none;*/
    }

    .listing-filter .building-type {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .listing-filter .building-type button {
        flex: 1;
        padding: 4px 8px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .listing-filter .building-type .active {
        background: #111827;
        color: white;
    }

    .listing-filter .property-type,
    .listing-filter .bedrooms,
    .listing-filter .localities,
    .listing-filter .furnishing-status {
        margin-bottom: 16px;
    }

    .listing-filter .property-type button,
    .listing-filter .bedrooms button,
    .listing-filter .furnishing-status button {
        display: flex;
        align-items: center;
        width: fit-content;
        padding: 4px 8px;
        /*margin-bottom: 8px;*/
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #fff;
        font-size: 14px;
        cursor: pointer;
        gap: 2px;
        color: gray;
    }

    .listing-filter .property-type button input[type="checkbox"],
    .listing-filter .bedrooms button input[type="checkbox"],
    .listing-filter .furnishing-status button input[type="checkbox"] {
        margin-right: 8px;
    }

    .listing-filter .property-type button.checked,
    .listing-filter .bedrooms button.checked,
    .listing-filter .furnishing-status button.checked {
        background: #f3e8ff;
        border-color: #a855f7;
    }

    .listing-filter .property-type button.checked input[type="checkbox"]:after,
    .listing-filter .bedrooms button.checked input[type="checkbox"]:after,
    .listing-filter .furnishing-status button.checked input[type="checkbox"]:after {
        content: '✓';
        color: #a855f7;
        font-size: 12px;
        position: absolute;
        margin-left: 2px;
    }

    .listing-filter .localities .search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .listing-filter .localities button {
        display: block;
        width: 100%;
        padding: 8px;
        margin-bottom: 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #f9fafb;
        text-align: left;
        font-size: 14px;
        cursor: pointer;
    }

    .property-type-button {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .property-type-button button {
        width: fit-content;
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
        /*appearance: none;*/
        cursor: pointer;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: rgb(51 51 51 / 10%) !important;
        border: 0;
        opacity: .25;
    }

    .filter-selected-section {
        width: 700px;
        background: #ffffff;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #f9f9f9;
        /*box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);*/

        color: #333;
        /*margin-bottom: 16px;*/
        display: flex;
        align-items: center;
        position: relative;
    }

    .filter-options-container {
        display: flex;
        gap: 10px;
        overflow-x: hidden;
        flex-grow: 1;
        padding: 0 10px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        background: #f9fafb;
        font-size: 14px;
        cursor: pointer;
        white-space: nowrap;
    }

    .filter-option input[type="checkbox"] {
        margin-right: 8px;
    }

    .filter-option.checked {
        background: #f3e8ff;
        border-color: #a855f7;
    }

    .filter-option.checked input[type="checkbox"]:after {
        content: '✓';
        color: #a855f7;
        font-size: 12px;
        position: absolute;
        margin-left: 2px;
    }

    .nav-arrow {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 8px;
        color: #6b7280;
        transition: color 0.3s;
    }

    .nav-arrow:hover {
        color: #a855f7;
    }

    .left-arrow {
        margin-right: 10px;
    }

    .right-arrow {
        margin-left: 10px;
    }

    /* Hide scrollbar but allow scrolling */
    .filter-options-container::-webkit-scrollbar {
        display: none;
    }

    .top-search-section {
        background: #efefef;
        /*border-radius: 12px;*/
        padding: 16px;
        /*box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);*/

        color: #333;
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
        /*margin-bottom: 12px;*/
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
        /* Extra padding for icon and mic */
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
    }

    .filter-btn:hover {
        background: #f3e8ff;
        border-color: #a855f7;
    }
</style>

<?php $__env->startSection('content'); ?>

    <section style="background:#f9f9f9;">
        <div class="top-search-section">
            <div class="d-flex align-item-center justify-content-center gap-3">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search Anything" value="<?php echo e(request('search')); ?>">

                    <i class="fas fa-microphone mic-icon"></i>
                </div>
                <div class="filter-buttons">
                    <span class="filter-label">Search By</span>
                    <button class="filter-btn">Travel Time</button>
                    <button class="filter-btn">Near by Metro Station</button>
                    <button class="filter-btn">Near Me Properties</button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="listing-page">
                    <div class="listing-page-left">
                        <div class="listing-filter">
                            <div class="reset-btn d-flex justify-content-between align-item-center">
                                <h2 style="font-size:20px;">Filters</h2>
                                <button>Reset</button>
                            </div>
                            <hr>
                            <!-- <div class="property-type d-flex flex-column">
                                        <h2>Apply Filter</h2>
                                        <div class="property-type-button">
                                            <button><input type="checkbox" checked> Ready to move</button>
                                            <button><input type="checkbox" checked> Apartment</button>
                                            <button><input type="checkbox" checked> Villa</button>
                                        </div>
                                    </div>
                                    <hr> -->

                            <div class="budget">
                                <h2>Budget</h2>
                                <div class="range-group">
                                    <select id="budget_min" name="budget_min">
                                        <option value="">Min</option>
                                        <option value="5000" <?php echo e(request('budget_min') == 5000 ? 'selected' : ''); ?>>₹5,000
                                        </option>
                                        <option value="10000" <?php echo e(request('budget_min') == 10000 ? 'selected' : ''); ?>>₹10,000
                                        </option>
                                        <option value="25000" <?php echo e(request('budget_min') == 25000 ? 'selected' : ''); ?>>₹25,000
                                        </option>
                                        <option value="50000" <?php echo e(request('budget_min') == 50000 ? 'selected' : ''); ?>>₹50,000
                                        </option>
                                        <option value="100000" <?php echo e(request('budget_min') == 100000 ? 'selected' : ''); ?>>₹1 Lakh
                                        </option>
                                        <option value="500000" <?php echo e(request('budget_min') == 500000 ? 'selected' : ''); ?>>₹5 Lakh
                                        </option>
                                        <option value="1000000" <?php echo e(request('budget_min') == 1000000 ? 'selected' : ''); ?>>₹10
                                            Lakh</option>
                                        <option value="2500000" <?php echo e(request('budget_min') == 2500000 ? 'selected' : ''); ?>>₹25
                                            Lakh</option>
                                        <option value="5000000" <?php echo e(request('budget_min') == 5000000 ? 'selected' : ''); ?>>₹50
                                            Lakh</option>
                                        <option value="10000000" <?php echo e(request('budget_min') == 10000000 ? 'selected' : ''); ?>>₹1
                                            Cr</option>
                                        <option value="30000000" <?php echo e(request('budget_min') == 30000000 ? 'selected' : ''); ?>>₹3
                                            Cr</option>
                                        <option value="50000000" <?php echo e(request('budget_min') == 50000000 ? 'selected' : ''); ?>>₹5
                                            Cr</option>
                                    </select>

                                    <select id="budget_max" name="budget_max">
                                        <option value="">Max</option>
                                        <option value="10000" <?php echo e(request('budget_max') == 10000 ? 'selected' : ''); ?>>₹10,000
                                        </option>
                                        <option value="25000" <?php echo e(request('budget_max') == 25000 ? 'selected' : ''); ?>>₹25,000
                                        </option>
                                        <option value="50000" <?php echo e(request('budget_max') == 50000 ? 'selected' : ''); ?>>₹50,000
                                        </option>
                                        <option value="100000" <?php echo e(request('budget_max') == 100000 ? 'selected' : ''); ?>>₹1 Lakh
                                        </option>
                                        <option value="500000" <?php echo e(request('budget_max') == 500000 ? 'selected' : ''); ?>>₹5 Lakh
                                        </option>
                                        <option value="1000000" <?php echo e(request('budget_max') == 1000000 ? 'selected' : ''); ?>>₹10
                                            Lakh</option>
                                        <option value="2500000" <?php echo e(request('budget_max') == 2500000 ? 'selected' : ''); ?>>₹25
                                            Lakh</option>
                                        <option value="5000000" <?php echo e(request('budget_max') == 5000000 ? 'selected' : ''); ?>>₹50
                                            Lakh</option>
                                        <option value="10000000" <?php echo e(request('budget_max') == 10000000 ? 'selected' : ''); ?>>₹1
                                            Cr</option>
                                        <option value="30000000" <?php echo e(request('budget_max') == 30000000 ? 'selected' : ''); ?>>₹3
                                            Cr</option>
                                        <option value="50000000" <?php echo e(request('budget_max') == 50000000 ? 'selected' : ''); ?>>₹5
                                            Cr</option>
                                        <option value="100000000" <?php echo e(request('budget_max') == 100000000 ? 'selected' : ''); ?>>
                                            ₹10 Cr+</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="size">
                                <h2>Size</h2>
                                <div class="range-group">
                                    <select id="size_min" name="size_min">
                                        <option value="">Min</option>
                                        <option value="100" <?php echo e(request('size_min') == 100 ? 'selected' : ''); ?>>100 sqft
                                        </option>
                                        <option value="250" <?php echo e(request('size_min') == 250 ? 'selected' : ''); ?>>250 sqft
                                        </option>
                                        <option value="500" <?php echo e(request('size_min') == 500 ? 'selected' : ''); ?>>500 sqft
                                        </option>
                                        <option value="750" <?php echo e(request('size_min') == 750 ? 'selected' : ''); ?>>750 sqft
                                        </option>
                                        <option value="1000" <?php echo e(request('size_min') == 1000 ? 'selected' : ''); ?>>1,000 sqft
                                        </option>
                                        <option value="1500" <?php echo e(request('size_min') == 1500 ? 'selected' : ''); ?>>1,500 sqft
                                        </option>
                                        <option value="2000" <?php echo e(request('size_min') == 2000 ? 'selected' : ''); ?>>2,000 sqft
                                        </option>
                                        <option value="2500" <?php echo e(request('size_min') == 2500 ? 'selected' : ''); ?>>2,500 sqft
                                        </option>
                                        <option value="3000" <?php echo e(request('size_min') == 3000 ? 'selected' : ''); ?>>3,000 sqft
                                        </option>
                                        <option value="4000" <?php echo e(request('size_min') == 4000 ? 'selected' : ''); ?>>4,000 sqft
                                        </option>
                                        <option value="5000" <?php echo e(request('size_min') == 5000 ? 'selected' : ''); ?>>5,000 sqft
                                        </option>
                                        <option value="10000" <?php echo e(request('size_min') == 10000 ? 'selected' : ''); ?>>10,000 sqft
                                        </option>
                                        <option value="20000" <?php echo e(request('size_min') == 20000 ? 'selected' : ''); ?>>20,000 sqft
                                        </option>
                                    </select>

                                    <select id="size_max" name="size_max">
                                        <option value="">Max</option>
                                        <option value="500" <?php echo e(request('size_max') == 500 ? 'selected' : ''); ?>>500 sqft
                                        </option>
                                        <option value="750" <?php echo e(request('size_max') == 750 ? 'selected' : ''); ?>>750 sqft
                                        </option>
                                        <option value="1000" <?php echo e(request('size_max') == 1000 ? 'selected' : ''); ?>>1,000 sqft
                                        </option>
                                        <option value="1500" <?php echo e(request('size_max') == 1500 ? 'selected' : ''); ?>>1,500 sqft
                                        </option>
                                        <option value="2000" <?php echo e(request('size_max') == 2000 ? 'selected' : ''); ?>>2,000 sqft
                                        </option>
                                        <option value="2500" <?php echo e(request('size_max') == 2500 ? 'selected' : ''); ?>>2,500 sqft
                                        </option>
                                        <option value="3000" <?php echo e(request('size_max') == 3000 ? 'selected' : ''); ?>>3,000 sqft
                                        </option>
                                        <option value="4000" <?php echo e(request('size_max') == 4000 ? 'selected' : ''); ?>>4,000 sqft
                                        </option>
                                        <option value="5000" <?php echo e(request('size_max') == 5000 ? 'selected' : ''); ?>>5,000 sqft
                                        </option>
                                        <option value="10000" <?php echo e(request('size_max') == 10000 ? 'selected' : ''); ?>>10,000 sqft
                                        </option>
                                        <option value="20000" <?php echo e(request('size_max') == 20000 ? 'selected' : ''); ?>>20,000 sqft
                                        </option>
                                        <option value="50000" <?php echo e(request('size_max') == 50000 ? 'selected' : ''); ?>>50,000
                                            sqft+</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <!-- Building Type Buttons -->
                            <div class="building-type d-flex flex-column">
                                <h2>Building Type</h2>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button type="button" class="sub-category-btn" data-id="<?php echo e($subcat->id); ?>">
                                            <?php echo e($subcat->sub_category_name); ?>

                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <hr>
                            <!-- Property Type Checkboxes -->
                            <div class="property-type d-flex flex-column">
                                <h2>Property Type</h2>
                                <div class="property-type-button">
                                    <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ptype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button>
                                            <input type="checkbox" class="sub-sub-category-checkbox" data-id="<?php echo e($ptype->id); ?>">
                                            <?php echo e($ptype->sub_sub_category_name); ?>

                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>


                            <hr>
                            <div class="bedrooms property-type d-flex flex-column">
                                <h2>Bedrooms</h2>
                                <div class="property-type-button">
                                    <button><input type="checkbox"> 1 BHK</button>
                                    <button><input type="checkbox"> 1 RK</button>
                                    <button><input type="checkbox"> 1.5 BHK</button>
                                    <button><input type="checkbox" checked> 2 BHK</button>
                                    <button><input type="checkbox"> 2.5 BHK</button>
                                    <button><input type="checkbox"> 3 BHK</button>
                                    <button><input type="checkbox"> 3.5 BHK</button>
                                    <button><input type="checkbox"> 4 BHK</button>
                                    <button><input type="checkbox"> 5 BHK</button>
                                    <button><input type="checkbox"> 6 BHK</button>
                                    <button><input type="checkbox"> 6+ BHK</button>
                                </div>
                            </div>
                            <hr>
                            <div class="localities">
                                <h2>Localities</h2>
                                <input type="text" class="search-input" placeholder="Search">
                                <button>Potheri</button>
                                <button>Kelambakkam</button>
                                <button>Siruseri</button>
                                <button>Kalavakkam</button>
                                <button>Vandalur</button>
                                <button>Manapakkam</button>
                                <button>Redhills</button>
                            </div>
                            <hr>
                            <div class="furnishing-status">
                                <h2>Furnishing Status</h2>
                                <div class="property-type-button d-flex flex-wrap gap-2">
                                    <?php
                                        $furnishingStatuses = \App\Models\FurnishingStatus::where('status', 'active')->get();
                                    ?>

                                    <?php $__currentLoopData = $furnishingStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button>
                                            <input type="checkbox" class="furnishing-Status-checkbox" value="<?php echo e($status->id); ?>">
                                            <?php echo e($status->name); ?>

                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <hr>
                            <div class="furnishing-status">
                                <h2>Property Status</h2>
                                <div class="property-type-button d-flex flex-wrap gap-2">
                                    <?php
                                        $propertyStatuses = \App\Models\PropertyStatus::where('status', 'active')->get();
                                    ?>

                                    <?php $__currentLoopData = $propertyStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button>
                                            <input type="checkbox" class="property-Status-checkbox" value="<?php echo e($status->id); ?>">
                                            <?php echo e($status->name); ?>

                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <div class="d-flex flex-column ">
                                    <h2 style="margin:0px;">Verified properties</h2>
                                    <p class="m-0 mt-1" style="font-size:10px;"><span
                                            style="background:green;border-radius:2px;padding:2px 6px;color:#fff;margin-top:3px;">Verified</span>
                                        By Bhawan Bhoomi</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">

                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <div class="d-flex flex-column ">
                                    <h2 style="margin:0px;">Properties with photos</h2>

                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">

                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <div class="d-flex flex-column ">
                                    <h2 style="margin:0px;">Properties with Video</h2>

                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">

                                </div>
                            </div>
                            <hr>
                            <div class="furnishing-status">
                                <h2>Age of Property</h2>
                                <div class="property-type-button">
                                    <button><input type="checkbox"> 0-1 year old</button>
                                    <button><input type="checkbox"> 1-5 year old</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listing-page-right">
                        <div class="right-sorting">
                            <div class="search-title mb-2">
                                <strong>Search Results:</strong>
                                <?php if(request()->filled('search')): ?>
                                    <?php echo e(request('search')); ?> in
                                <?php endif; ?>
                                <?php if(request()->filled('city')): ?>
                                    <?php
                                        $city = App\City::find(request('city'));
                                        echo $city ? $city->name : '';
                                    ?>
                                <?php endif; ?>
                                <?php if(request()->filled('type')): ?>
                                    - <?php echo e(ucfirst(request('type'))); ?> Properties
                                <?php endif; ?>
                                <?php if(request()->filled('sub_sub_category_id')): ?>
                                    <?php
                                        $propertyTypes = explode(',', request('sub_sub_category_id'));
                                        $typeNames = App\SubSubCategory::whereIn('id', $propertyTypes)->pluck('sub_sub_category_name')->toArray();
                                        if (count($typeNames) > 0) {
                                            echo ' - ' . implode(', ', $typeNames);
                                        }
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="sorting-options">
                                <select>
                                    <option value="">Sort by: Default</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="size-low">Size: Low to High</option>
                                    <option value="size-high">Size: High to Low</option>
                                </select>
                            </div>
                        </div>
                        <?php if(isset($properties)): ?>
                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="listing-page-card">
                                    <div class="image-section">
                                        <div class="image-count">1 Photo</div>
                                        <img src="<?php echo e(isset($property->PropertyGallery[0]->image_path) ? asset('') . $property->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'); ?>"
                                            alt="Industrial worker" class="property-image">
                                        <div class="price-text">
                                            <h2 class="m-0">₹<?php echo e(\App\Helpers\Helper::formatIndianPrice($property->price ?? 0)); ?></h2>
                                            <p class="m-0">See other charges</p>
                                        </div>
                                    </div>
                                    <div class="content-section">
                                        <div>
                                            <div class="listing-header">
                                                <h1 class="listing-title">
                                                    <a href="<?php echo e(route('property_detail', ['title' => $property->slug])); ?>"
                                                        style="text-decoration: none; color: inherit;">
                                                        <?php echo e($property->title ?? ''); ?>

                                                    </a>
                                                </h1>
                                                <div class="listing-actions">
                                                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                                                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                                                    <button class="action-btn" title="More"><i
                                                            class="fas fa-ellipsis-h"></i></button>
                                                </div>
                                                <!--<div class="listing-price">₹16,000</div>-->
                                            </div>

                                            <div class="listing-features">
                                                <div class="feature-item">
                                                    <i class="fas fa-home feature-icon"></i>
                                                    <span class="feature-value">Unfurnished</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-bath feature-icon"></i>
                                                    <span class="feature-value">2</span>
                                                    <span class="feature-label">Bathrooms</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-calendar-check feature-icon"></i>
                                                    <span class="feature-value">Immediately</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-expand-arrows-alt feature-icon"></i>
                                                    <span class="feature-value">950 sqft</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-layer-group feature-icon"></i>
                                                    <span class="feature-value">1 out of 1</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-user-friends feature-icon"></i>
                                                    <span class="feature-value">Bachelors</span>
                                                </div>
                                            </div>
                                            <div class="listing-description">
                                                <?php echo e(\Illuminate\Support\Str::limit($property->description, 50)); ?>

                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div class="listing-owner-info mb-2">
                                                    <div class="owner-avatar">RA</div>
                                                    <span><strong>Owner:</strong> <?php echo e($property->getUser->firstname ?? ''); ?></span>
                                                </div>
                                                <div class="listing-owner-info mb-2">

                                                    <span><strong>Posted on:</strong>
                                                        <?php echo e(optional($property->created_at)->format('d M Y')); ?></span>
                                                </div>
                                                <div class="listing-owner-info mb-2">

                                                    <span><strong><i class="fa-solid fa-eye"></i></strong> 1289</span>
                                                </div>


                                            </div>

                                            <div class="listing-buttons">
                                                <button class="contact-btn">Contact Owner</button>
                                                <button class="society-btn">Ask Society Name</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="d-flex justify-content-center">
                            <?php echo e($properties->links()); ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        // Scroll Section Function
        function scrollSection(distance) {
            const container = document.querySelector('.filter-options-container');
            if (container) container.scrollLeft += distance;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);

            // ----- Initialize Sub Category Buttons -----
            const subCategoryIds = params.get('sub_category_id');
            if (subCategoryIds) {
                subCategoryIds.split(',').forEach(id => {
                    const btn = document.querySelector(`.sub-category-btn[data-id='${id}']`);
                    if (btn) btn.classList.add('active');
                });
            }

            // ----- Initialize Property Type Checkboxes -----
            const propertyTypeIds = params.get('sub_sub_category_id');
            if (propertyTypeIds) {
                propertyTypeIds.split(',').forEach(id => {
                    const cb = document.querySelector(`.sub-sub-category-checkbox[data-id='${id}']`);
                    if (cb) cb.checked = true;
                });
            }

            // ----- Initialize Budget & Size Inputs -----
            ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(field => {
                const el = document.getElementById(field);
                if (el && params.get(field)) el.value = params.get(field);
            });

            // ----- Initialize Search Input -----
            const searchInput = document.querySelector('.search-input');
            if (searchInput && params.get('search')) searchInput.value = params.get('search');

            // Initialize Furnishing Status checkboxes
            const furnishingIds = params.get('furnishing_status');
            if (furnishingIds) {
                furnishingIds.split(',').forEach(id => {
                    const cb = document.querySelector(`.furnishing-Status-checkbox[value='${id}']`);
                    if (cb) cb.checked = true;
                });
            }

            // Initialize Property Status checkboxes
            const propertyIds = params.get('property_status');
            if (propertyIds) {
                propertyIds.split(',').forEach(id => {
                    const cb = document.querySelector(`.property-Status-checkbox[value='${id}']`);
                    if (cb) cb.checked = true;
                });
            }

        });

        // ----- Update Filters Function -----
        function updateFilters() {
            const params = new URLSearchParams(window.location.search);

            // Search Input
            const searchVal = document.querySelector('.search-input')?.value?.trim();
            if (searchVal) params.set('search', searchVal);
            else params.delete('search');

            // Budget & Size
            ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(id => {
                const val = document.getElementById(id)?.value;
                if (val) params.set(id, val);
                else params.delete(id);
            });

            // Sub-category Buttons
            const subCatIds = Array.from(document.querySelectorAll('.sub-category-btn.active'))
                .map(btn => btn.dataset.id);
            if (subCatIds.length) params.set('sub_category_id', subCatIds.join(','));
            else params.delete('sub_category_id');

            // Property Type Checkboxes
            const propertyTypeIds = Array.from(document.querySelectorAll('.sub-sub-category-checkbox:checked'))
                .map(cb => cb.dataset.id);
            params.set('sub_sub_category_id', propertyTypeIds.join(',')); // keep empty if none selected


            // Furnishing Status
            const furnishingIds = Array.from(document.querySelectorAll('.furnishing-Status-checkbox:checked'))
                .map(cb => cb.value);
            if (furnishingIds.length) params.set('furnishing_status', furnishingIds.join(','));
            else params.delete('furnishing_status');

            // Property Status
            const propertyIds = Array.from(document.querySelectorAll('.property-Status-checkbox:checked'))
                .map(cb => cb.value);
            if (propertyIds.length) params.set('property_status', propertyIds.join(','));
            else params.delete('property_status');

            // Redirect with updated params
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        // ----- Event Listeners -----

        // Search input Enter
        document.querySelector('.search-input')?.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') updateFilters();
        });

        // Budget & Size changes
        ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(id => {
            document.getElementById(id)?.addEventListener('change', updateFilters);
        });

        // Sub-category button toggle
        document.querySelectorAll('.sub-category-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.classList.toggle('active');
                updateFilters();
            });
        });

        // Property type, bedrooms, furnishing, property status checkboxes
        document.querySelectorAll('.sub-sub-category-checkbox')
            .forEach(cb => cb.addEventListener('change', updateFilters));

        document.querySelectorAll('.furnishing-Status-checkbox, .property-Status-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
                updateFilters();
            });
        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/listing-list.blade.php ENDPATH**/ ?>