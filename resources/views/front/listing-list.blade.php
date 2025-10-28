@extends('layouts.front.app')
@section('title')
    <title>Welcome</title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .filter-btn.active {
        background: #f3e8ff;
        border-color: #a855f7;
    }

    .location-btn.active {
        background-color: #007bff !important;
        color: #fff;
    }

    #offcanvasBottom {
        height: 50vh !important;
        /* makes drawer taller */
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .sorting-options label {
        font-size: 15px;
        cursor: pointer;
    }

    .sorting-options input[type="checkbox"] {
        accent-color: #0d1b3e;
    }

    .accordion-button {
        background-color: #fff !important;
        color: #222;
        font-weight: 600;
        font-size: 15px;
        padding: 10px 12px;
    }

    .accordion-item {
        border: none !important;
        /*border-bottom: 1px solid #ddd;*/
    }

    .accordion-body {
        background: #f9f9f9;
        padding: 10px 5px 10px 15px;
    }

    .filter-checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 8px 12px;
        width: 100%;
        transition: all 0.2s ease;
    }

    .filter-option:hover {
        background: #e6f2ff;
        border-color: #007bff;
    }

    .filter-option input[type="checkbox"] {
        margin-right: 10px;
        transform: scale(1.1);
    }

    .filter-option label {
        margin: 0;
        font-size: 15px;
        color: #333;
        width: 100%;
        cursor: pointer;
    }

    .sub-category-btn {
        width: 100%;
        text-align: start;
        padding: 4px 10px;
        background: #ffffff;
        border: none;
    }

    .property-type-button button {
        width: 100%;
        text-align: start;
        padding: 4px 10px;
        background: #ffffff;
        border: none;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: orange !important;
    }

    .accordion-button:focus {
        z-index: 3;
        border-color: #fdfdfd;
        outline: 0;
        box-shadow: #fff !important;
    }
</style>
<style>
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
</style>
<style>
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
</style>

@section('content')

    <section style="background:#f9f9f9;">
        <div class="top-search-section">
            <div class="d-flex align-item-center justify-content-center gap-3">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search Anything" value="{{ request('search') }}">

                    <i class="fas fa-microphone mic-icon"></i>
                </div>
                <div class="filter-buttons">
                    <span class="filter-label">Search By</span>
                    <button type="button" class="filter-btn" data-filter="price_negotiable">Price Negotiable</button>
                    <button class="filter-btn" data-filter="security_available">Security Available</button>
                </div>
            </div>
        </div>
        <div class="filter-inmobile">
            <div class="filter-text" data-bs-toggle="offcanvas" href="#offcanvasExample3" role="button">
                <p class="m-0">Category</p>
            </div>
            <div class="ver-line"></div>
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




        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample3" aria-labelledby="filterMenuLabel"
            style="width: 320px;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-semibold" id="filterMenuLabel">Filter By Category</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body" style="background:#f9f9f9; text-align: left;">
                <div class="accordion" id="categoryAccordion">

                    <!-- Residential -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingResidential">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseResidential" aria-expanded="false"
                                aria-controls="collapseResidential">
                                Residential
                            </button>
                        </h2>
                        <div id="collapseResidential" class="accordion-collapse collapse"
                            aria-labelledby="headingResidential" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <label><input type="checkbox" name="residential[]" value="flat"> Flat /
                                    Apartment</label><br>
                                <label><input type="checkbox" name="residential[]" value="villa"> Villa</label><br>
                                <label><input type="checkbox" name="residential[]" value="house"> Independent
                                    House</label><br>
                                <label><input type="checkbox" name="residential[]" value="studio"> Studio Apartment</label>
                            </div>
                        </div>
                    </div>

                    <!-- Commercial -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCommercial">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCommercial" aria-expanded="false"
                                aria-controls="collapseCommercial">
                                Commercial
                            </button>
                        </h2>
                        <div id="collapseCommercial" class="accordion-collapse collapse" aria-labelledby="headingCommercial"
                            data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <label><input type="checkbox" name="commercial[]" value="office"> Office Space</label><br>
                                <label><input type="checkbox" name="commercial[]" value="shop"> Shop / Showroom</label><br>
                                <label><input type="checkbox" name="commercial[]" value="warehouse"> Warehouse /
                                    Godown</label><br>
                                <label><input type="checkbox" name="commercial[]" value="coworking"> Co-working
                                    Space</label>
                            </div>
                        </div>
                    </div>

                    <!-- Land & Plots -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLand">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseLand" aria-expanded="false" aria-controls="collapseLand">
                                Land & Plots
                            </button>
                        </h2>
                        <div id="collapseLand" class="accordion-collapse collapse" aria-labelledby="headingLand"
                            data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <label><input type="checkbox" name="land[]" value="residential-plot"> Residential
                                    Plot</label><br>
                                <label><input type="checkbox" name="land[]" value="commercial-plot"> Commercial
                                    Plot</label><br>
                                <label><input type="checkbox" name="land[]" value="industrial-plot"> Industrial
                                    Plot</label><br>
                                <label><input type="checkbox" name="land[]" value="agriculture-land"> Agricultural
                                    Land</label>
                            </div>
                        </div>
                    </div>

                    <!-- PG / Hostel -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPG">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePG" aria-expanded="false" aria-controls="collapsePG">
                                PG / Hostel
                            </button>
                        </h2>
                        <div id="collapsePG" class="accordion-collapse collapse" aria-labelledby="headingPG"
                            data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <label><input type="checkbox" name="pg[]" value="boys-pg"> Boys PG</label><br>
                                <label><input type="checkbox" name="pg[]" value="girls-pg"> Girls PG</label><br>
                                <label><input type="checkbox" name="pg[]" value="hostel"> Hostel</label><br>
                                <label><input type="checkbox" name="pg[]" value="shared-room"> Shared Room</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="filterMenuLabel"
            style="width: 320px;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-semibold" id="filterMenuLabel">Filters</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body" style="background:#f9f9f9; text-align: left;">

                <!-- Location Filter -->
                <div class="filter-item border-bottom py-2 mb-3" style="text-align: left;">
                    <h6 class="fw-semibold mb-0 d-flex justify-content-between align-items-center"
                        data-bs-toggle="offcanvas" data-bs-target="#locationCanvas" aria-controls="locationCanvas"
                        style="cursor:pointer;">
                        <span>
                            <i class="fas fa-map-marker-alt text-danger"></i>
                            Location
                        </span>
                        <img src="{{ asset('images/arrow.png') }}" alt="" width="20px;">
                    </h6>

                    <div id="selectedCityDisplay" class="mt-2 p-2 bg-light rounded" style="display:none;">
                        <small class="text-muted">Selected City:</small><br>
                        <strong id="selectedCityName"></strong>
                        <i class="fas fa-times-circle text-danger float-end" id="clearCitySelection"
                            style="cursor:pointer;"></i>
                    </div>
                </div>

                <div class="listing-filter">
                    <div class="reset-btn d-flex justify-content-between align-item-center">
                        <h2 style="font-size:20px;">Filters</h2>
                        <button type="button" id="resetFiltersmobile">Reset</button>
                    </div>
                    <hr>


                    <div class="budget">
                        <h2>Budget</h2>
                        <div class="range-group">
                            <select id="budget_min_mobile" name="budget_min">
                                <option value="">Min</option>
                                <option value="5000" {{ request('budget_min') == 5000 ? 'selected' : '' }}>₹5,000
                                </option>
                                <option value="10000" {{ request('budget_min') == 10000 ? 'selected' : '' }}>₹10,000
                                </option>
                                <option value="25000" {{ request('budget_min') == 25000 ? 'selected' : '' }}>₹25,000
                                </option>
                                <option value="50000" {{ request('budget_min') == 50000 ? 'selected' : '' }}>₹50,000
                                </option>
                                <option value="100000" {{ request('budget_min') == 100000 ? 'selected' : '' }}>₹1 Lakh
                                </option>
                                <option value="500000" {{ request('budget_min') == 500000 ? 'selected' : '' }}>₹5 Lakh
                                </option>
                                <option value="1000000" {{ request('budget_min') == 1000000 ? 'selected' : '' }}>₹10
                                    Lakh</option>
                                <option value="2500000" {{ request('budget_min') == 2500000 ? 'selected' : '' }}>₹25
                                    Lakh</option>
                                <option value="5000000" {{ request('budget_min') == 5000000 ? 'selected' : '' }}>₹50
                                    Lakh</option>
                                <option value="10000000" {{ request('budget_min') == 10000000 ? 'selected' : '' }}>₹1
                                    Cr</option>
                                <option value="30000000" {{ request('budget_min') == 30000000 ? 'selected' : '' }}>₹3
                                    Cr</option>
                                <option value="50000000" {{ request('budget_min') == 50000000 ? 'selected' : '' }}>₹5
                                    Cr</option>
                            </select>

                            <select id="budget_max_mobile" name="budget_max">
                                <option value="">Max</option>
                                <option value="10000" {{ request('budget_max') == 10000 ? 'selected' : '' }}>₹10,000
                                </option>
                                <option value="25000" {{ request('budget_max') == 25000 ? 'selected' : '' }}>₹25,000
                                </option>
                                <option value="50000" {{ request('budget_max') == 50000 ? 'selected' : '' }}>₹50,000
                                </option>
                                <option value="100000" {{ request('budget_max') == 100000 ? 'selected' : '' }}>₹1 Lakh
                                </option>
                                <option value="500000" {{ request('budget_max') == 500000 ? 'selected' : '' }}>₹5 Lakh
                                </option>
                                <option value="1000000" {{ request('budget_max') == 1000000 ? 'selected' : '' }}>₹10
                                    Lakh</option>
                                <option value="2500000" {{ request('budget_max') == 2500000 ? 'selected' : '' }}>₹25
                                    Lakh</option>
                                <option value="5000000" {{ request('budget_max') == 5000000 ? 'selected' : '' }}>₹50
                                    Lakh</option>
                                <option value="10000000" {{ request('budget_max') == 10000000 ? 'selected' : '' }}>₹1
                                    Cr</option>
                                <option value="30000000" {{ request('budget_max') == 30000000 ? 'selected' : '' }}>₹3
                                    Cr</option>
                                <option value="50000000" {{ request('budget_max') == 50000000 ? 'selected' : '' }}>₹5
                                    Cr</option>
                                <option value="100000000" {{ request('budget_max') == 100000000 ? 'selected' : '' }}>
                                    ₹10 Cr+</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="size">
                        <h2>Size</h2>
                        <div class="range-group">
                            <select id="size_min_mobile" name="size_min">
                                <option value="">Min</option>
                                <option value="100" {{ request('size_min') == 100 ? 'selected' : '' }}>100 sqft
                                </option>
                                <option value="250" {{ request('size_min') == 250 ? 'selected' : '' }}>250 sqft
                                </option>
                                <option value="500" {{ request('size_min') == 500 ? 'selected' : '' }}>500 sqft
                                </option>
                                <option value="750" {{ request('size_min') == 750 ? 'selected' : '' }}>750 sqft
                                </option>
                                <option value="1000" {{ request('size_min') == 1000 ? 'selected' : '' }}>1,000 sqft
                                </option>
                                <option value="1500" {{ request('size_min') == 1500 ? 'selected' : '' }}>1,500 sqft
                                </option>
                                <option value="2000" {{ request('size_min') == 2000 ? 'selected' : '' }}>2,000 sqft
                                </option>
                                <option value="2500" {{ request('size_min') == 2500 ? 'selected' : '' }}>2,500 sqft
                                </option>
                                <option value="3000" {{ request('size_min') == 3000 ? 'selected' : '' }}>3,000 sqft
                                </option>
                                <option value="4000" {{ request('size_min') == 4000 ? 'selected' : '' }}>4,000 sqft
                                </option>
                                <option value="5000" {{ request('size_min') == 5000 ? 'selected' : '' }}>5,000 sqft
                                </option>
                                <option value="10000" {{ request('size_min') == 10000 ? 'selected' : '' }}>10,000 sqft
                                </option>
                                <option value="20000" {{ request('size_min') == 20000 ? 'selected' : '' }}>20,000 sqft
                                </option>
                            </select>

                            <select id="size_max_mobile" name="size_max">
                                <option value="">Max</option>
                                <option value="500" {{ request('size_max') == 500 ? 'selected' : '' }}>500 sqft
                                </option>
                                <option value="750" {{ request('size_max') == 750 ? 'selected' : '' }}>750 sqft
                                </option>
                                <option value="1000" {{ request('size_max') == 1000 ? 'selected' : '' }}>1,000 sqft
                                </option>
                                <option value="1500" {{ request('size_max') == 1500 ? 'selected' : '' }}>1,500 sqft
                                </option>
                                <option value="2000" {{ request('size_max') == 2000 ? 'selected' : '' }}>2,000 sqft
                                </option>
                                <option value="2500" {{ request('size_max') == 2500 ? 'selected' : '' }}>2,500 sqft
                                </option>
                                <option value="3000" {{ request('size_max') == 3000 ? 'selected' : '' }}>3,000 sqft
                                </option>
                                <option value="4000" {{ request('size_max') == 4000 ? 'selected' : '' }}>4,000 sqft
                                </option>
                                <option value="5000" {{ request('size_max') == 5000 ? 'selected' : '' }}>5,000 sqft
                                </option>
                                <option value="10000" {{ request('size_max') == 10000 ? 'selected' : '' }}>10,000 sqft
                                </option>
                                <option value="20000" {{ request('size_max') == 20000 ? 'selected' : '' }}>20,000 sqft
                                </option>
                                <option value="50000" {{ request('size_max') == 50000 ? 'selected' : '' }}>50,000
                                    sqft+</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <!-- Building Type Buttons -->
                    <div class="accordion" id="filterAccordion">

                        <!-- Building Type -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBuilding">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseBuilding" aria-expanded="false"
                                    aria-controls="collapseBuilding">
                                    Building Type
                                </button>
                            </h2>
                            <div id="collapseBuilding" class="accordion-collapse collapse" aria-labelledby="headingBuilding"
                                data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($subcategories as $subcat)
                                            <button type="button" class="sub-category-btn" data-id="{{ $subcat->id }}">
                                                {{ $subcat->sub_category_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Property Type -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPropertyType">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePropertyType" aria-expanded="false"
                                    aria-controls="collapsePropertyType">
                                    Property Type
                                </button>
                            </h2>
                            <div id="collapsePropertyType" class="accordion-collapse collapse"
                                aria-labelledby="headingPropertyType" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <div class="property-type-button">
                                        @foreach($propertyTypes as $ptype)
                                            <button>
                                                <input type="checkbox" class="sub-sub-category-checkbox"
                                                    data-id="{{ $ptype->id }}">
                                                {{ $ptype->sub_sub_category_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bedrooms -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBedrooms">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseBedrooms" aria-expanded="false"
                                    aria-controls="collapseBedrooms">
                                    Bedrooms
                                </button>
                            </h2>
                            <div id="collapseBedrooms" class="accordion-collapse collapse" aria-labelledby="headingBedrooms"
                                data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <div class="property-type-button d-flex flex-wrap gap-2">
                                        @for($i = 1; $i <= 10; $i++)
                                            <button><input type="checkbox" class="bedroom-checkbox" value="{{ $i }}"> {{ $i }}
                                                BHK</button>
                                        @endfor
                                        <button><input type="checkbox" class="bedroom-checkbox" value="10+"> 10+
                                            BHK</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Furnishing Status -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFurnishing">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFurnishing" aria-expanded="false"
                                    aria-controls="collapseFurnishing">
                                    Furnishing Status
                                </button>
                            </h2>
                            <div id="collapseFurnishing" class="accordion-collapse collapse"
                                aria-labelledby="headingFurnishing" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <div class="property-type-button d-flex flex-wrap gap-2">
                                        @php
                                            $furnishingStatuses = \App\Models\FurnishingStatus::where('status', 'active')->get();
                                        @endphp
                                        @foreach($furnishingStatuses as $status)
                                            <button>
                                                <input type="checkbox" class="furnishing-Status-checkbox"
                                                    value="{{ $status->id }}">
                                                {{ $status->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Property Status -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPropertyStatus">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePropertyStatus" aria-expanded="false"
                                    aria-controls="collapsePropertyStatus">
                                    Property Status
                                </button>
                            </h2>
                            <div id="collapsePropertyStatus" class="accordion-collapse collapse"
                                aria-labelledby="headingPropertyStatus" data-bs-parent="#filterAccordion">
                                <div class="accordion-body">
                                    <div class="property-type-button d-flex flex-wrap gap-2">
                                        @php
                                            $propertyStatuses = \App\Models\PropertyStatus::where('status', 'active')->get();
                                        @endphp
                                        @foreach($propertyStatuses as $status)
                                            <button>
                                                <input type="checkbox" class="property-Status-checkbox"
                                                    value="{{ $status->id }}">
                                                {{ $status->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
                            <input class="form-check-input" type="checkbox" role="switch" id="verified_property_mobile">

                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-item-center">
                        <div class="d-flex flex-column ">
                            <h2 style="margin:0px;">Properties with photos</h2>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="with_photos_mobile">

                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-item-center">
                        <div class="d-flex flex-column ">
                            <h2 style="margin:0px;">Properties with Video</h2>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="with_videos_mobile">

                        </div>
                    </div>
                    <hr>

                </div>

                <button class="btn btn-dark w-100 mt-3" id="mobileApplyFilters">Apply Filters</button>
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

                    <button class="sort-btn" data-value="price-low">Price: Low to High</button>
                    <button class="sort-btn" data-value="price-high">Price: High to Low</button>
                    <button class="sort-btn" data-value="size-low">Size: Low to High</button>
                    <button class="sort-btn" data-value="size-high">Size: High to Low</button>
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
                                <button type="button" id="resetFilters">Reset</button>
                            </div>
                            <hr>


                            <div class="budget">
                                <h2>Budget</h2>
                                <div class="range-group">
                                    <select id="budget_min" name="budget_min">
                                        <option value="">Min</option>
                                        <option value="5000" {{ request('budget_min') == 5000 ? 'selected' : '' }}>₹5,000
                                        </option>
                                        <option value="10000" {{ request('budget_min') == 10000 ? 'selected' : '' }}>₹10,000
                                        </option>
                                        <option value="25000" {{ request('budget_min') == 25000 ? 'selected' : '' }}>₹25,000
                                        </option>
                                        <option value="50000" {{ request('budget_min') == 50000 ? 'selected' : '' }}>₹50,000
                                        </option>
                                        <option value="100000" {{ request('budget_min') == 100000 ? 'selected' : '' }}>₹1 Lakh
                                        </option>
                                        <option value="500000" {{ request('budget_min') == 500000 ? 'selected' : '' }}>₹5 Lakh
                                        </option>
                                        <option value="1000000" {{ request('budget_min') == 1000000 ? 'selected' : '' }}>₹10
                                            Lakh</option>
                                        <option value="2500000" {{ request('budget_min') == 2500000 ? 'selected' : '' }}>₹25
                                            Lakh</option>
                                        <option value="5000000" {{ request('budget_min') == 5000000 ? 'selected' : '' }}>₹50
                                            Lakh</option>
                                        <option value="10000000" {{ request('budget_min') == 10000000 ? 'selected' : '' }}>₹1
                                            Cr</option>
                                        <option value="30000000" {{ request('budget_min') == 30000000 ? 'selected' : '' }}>₹3
                                            Cr</option>
                                        <option value="50000000" {{ request('budget_min') == 50000000 ? 'selected' : '' }}>₹5
                                            Cr</option>
                                    </select>

                                    <select id="budget_max" name="budget_max">
                                        <option value="">Max</option>
                                        <option value="10000" {{ request('budget_max') == 10000 ? 'selected' : '' }}>₹10,000
                                        </option>
                                        <option value="25000" {{ request('budget_max') == 25000 ? 'selected' : '' }}>₹25,000
                                        </option>
                                        <option value="50000" {{ request('budget_max') == 50000 ? 'selected' : '' }}>₹50,000
                                        </option>
                                        <option value="100000" {{ request('budget_max') == 100000 ? 'selected' : '' }}>₹1 Lakh
                                        </option>
                                        <option value="500000" {{ request('budget_max') == 500000 ? 'selected' : '' }}>₹5 Lakh
                                        </option>
                                        <option value="1000000" {{ request('budget_max') == 1000000 ? 'selected' : '' }}>₹10
                                            Lakh</option>
                                        <option value="2500000" {{ request('budget_max') == 2500000 ? 'selected' : '' }}>₹25
                                            Lakh</option>
                                        <option value="5000000" {{ request('budget_max') == 5000000 ? 'selected' : '' }}>₹50
                                            Lakh</option>
                                        <option value="10000000" {{ request('budget_max') == 10000000 ? 'selected' : '' }}>₹1
                                            Cr</option>
                                        <option value="30000000" {{ request('budget_max') == 30000000 ? 'selected' : '' }}>₹3
                                            Cr</option>
                                        <option value="50000000" {{ request('budget_max') == 50000000 ? 'selected' : '' }}>₹5
                                            Cr</option>
                                        <option value="100000000" {{ request('budget_max') == 100000000 ? 'selected' : '' }}>
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
                                        <option value="100" {{ request('size_min') == 100 ? 'selected' : '' }}>100 sqft
                                        </option>
                                        <option value="250" {{ request('size_min') == 250 ? 'selected' : '' }}>250 sqft
                                        </option>
                                        <option value="500" {{ request('size_min') == 500 ? 'selected' : '' }}>500 sqft
                                        </option>
                                        <option value="750" {{ request('size_min') == 750 ? 'selected' : '' }}>750 sqft
                                        </option>
                                        <option value="1000" {{ request('size_min') == 1000 ? 'selected' : '' }}>1,000 sqft
                                        </option>
                                        <option value="1500" {{ request('size_min') == 1500 ? 'selected' : '' }}>1,500 sqft
                                        </option>
                                        <option value="2000" {{ request('size_min') == 2000 ? 'selected' : '' }}>2,000 sqft
                                        </option>
                                        <option value="2500" {{ request('size_min') == 2500 ? 'selected' : '' }}>2,500 sqft
                                        </option>
                                        <option value="3000" {{ request('size_min') == 3000 ? 'selected' : '' }}>3,000 sqft
                                        </option>
                                        <option value="4000" {{ request('size_min') == 4000 ? 'selected' : '' }}>4,000 sqft
                                        </option>
                                        <option value="5000" {{ request('size_min') == 5000 ? 'selected' : '' }}>5,000 sqft
                                        </option>
                                        <option value="10000" {{ request('size_min') == 10000 ? 'selected' : '' }}>10,000 sqft
                                        </option>
                                        <option value="20000" {{ request('size_min') == 20000 ? 'selected' : '' }}>20,000 sqft
                                        </option>
                                    </select>

                                    <select id="size_max" name="size_max">
                                        <option value="">Max</option>
                                        <option value="500" {{ request('size_max') == 500 ? 'selected' : '' }}>500 sqft
                                        </option>
                                        <option value="750" {{ request('size_max') == 750 ? 'selected' : '' }}>750 sqft
                                        </option>
                                        <option value="1000" {{ request('size_max') == 1000 ? 'selected' : '' }}>1,000 sqft
                                        </option>
                                        <option value="1500" {{ request('size_max') == 1500 ? 'selected' : '' }}>1,500 sqft
                                        </option>
                                        <option value="2000" {{ request('size_max') == 2000 ? 'selected' : '' }}>2,000 sqft
                                        </option>
                                        <option value="2500" {{ request('size_max') == 2500 ? 'selected' : '' }}>2,500 sqft
                                        </option>
                                        <option value="3000" {{ request('size_max') == 3000 ? 'selected' : '' }}>3,000 sqft
                                        </option>
                                        <option value="4000" {{ request('size_max') == 4000 ? 'selected' : '' }}>4,000 sqft
                                        </option>
                                        <option value="5000" {{ request('size_max') == 5000 ? 'selected' : '' }}>5,000 sqft
                                        </option>
                                        <option value="10000" {{ request('size_max') == 10000 ? 'selected' : '' }}>10,000 sqft
                                        </option>
                                        <option value="20000" {{ request('size_max') == 20000 ? 'selected' : '' }}>20,000 sqft
                                        </option>
                                        <option value="50000" {{ request('size_max') == 50000 ? 'selected' : '' }}>50,000
                                            sqft+</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <!-- Building Type Buttons -->
                            <div class="building-type d-flex flex-column">
                                <h2>Building Type</h2>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($subcategories as $subcat)
                                        <button type="button" class="sub-category-btn" data-id="{{ $subcat->id }}">
                                            {{ $subcat->sub_category_name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <!-- Property Type Checkboxes -->
                            <div class="property-type d-flex flex-column">
                                <h2>Property Type</h2>
                                <div class="property-type-button">
                                    @foreach($propertyTypes as $ptype)
                                        <button>
                                            <input type="checkbox" class="sub-sub-category-checkbox" data-id="{{ $ptype->id }}">
                                            {{ $ptype->sub_sub_category_name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>


                            <hr>
                            <div class="bedrooms property-type d-flex flex-column">
                                <h2>Bedrooms</h2>
                                <div class="property-type-button">
                                    <button><input type="checkbox" class="bedroom-checkbox" value="1"> 1 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="2"> 2 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="3"> 3 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="4"> 4 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="5"> 5 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="6"> 6 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="7"> 7 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="8"> 8 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="9"> 9 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="10"> 10 BHK</button>
                                    <button><input type="checkbox" class="bedroom-checkbox" value="10+"> 10+ BHK</button>
                                </div>
                            </div>
                            <hr>
                            <div class="localities">
                                <h2>Localities</h2>
                                <input type="text" id="locationSearch" class="search-input" placeholder="Search Location">

                                @php
                                    $selectedLocations = request()->input('locations') ? explode(',', request()->input('locations')) : [];
                                    $maxVisible = 10; // number of locations to show initially
                                @endphp

                                <div id="locationsContainer" class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($locations as $index => $loc)
                                        <button
                                            class="location-btn {{ in_array($loc->id, $selectedLocations) ? 'active' : '' }}"
                                            data-id="{{ $loc->id }}"
                                            style="{{ in_array($loc->id, $selectedLocations) ? '' : 'display:none;' }}">
                                            {{ $loc->location }}
                                        </button>
                                    @endforeach
                                </div>

                                <!-- @if($locations->count() > $maxVisible)
                                                                                                        <button id="showMoreLocations" class="btn btn-link">Show More</button>
                                                                                                    @endif -->

                            </div>

                            <hr>
                            <div class="furnishing-status">
                                <h2>Furnishing Status</h2>
                                <div class="property-type-button d-flex flex-wrap gap-2">
                                    @php
                                        $furnishingStatuses = \App\Models\FurnishingStatus::where('status', 'active')->get();
                                    @endphp

                                    @foreach($furnishingStatuses as $status)
                                        <button>
                                            <input type="checkbox" class="furnishing-Status-checkbox" value="{{ $status->id }}">
                                            {{ $status->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="furnishing-status">
                                <h2>Property Status</h2>
                                <div class="property-type-button d-flex flex-wrap gap-2">
                                    @php
                                        $propertyStatuses = \App\Models\PropertyStatus::where('status', 'active')->get();
                                    @endphp
                                    @foreach($propertyStatuses as $status)
                                        <button>
                                            <input type="checkbox" class="property-Status-checkbox" value="{{ $status->id }}">
                                            {{ $status->name }}
                                        </button>
                                    @endforeach
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
                                    <input class="form-check-input" type="checkbox" role="switch" id="verified_property">

                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <div class="d-flex flex-column ">
                                    <h2 style="margin:0px;">Properties with photos</h2>

                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="with_photos">

                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-item-center">
                                <div class="d-flex flex-column ">
                                    <h2 style="margin:0px;">Properties with Video</h2>

                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="with_videos">

                                </div>
                            </div>
                            <hr>
                            <!-- <div class="furnishing-status">
                                                                                                                                                                                <h2>Age of Property</h2>
                                                                                                                                                                                <div class="property-type-button">
                                                                                                                                                                                    <button><input type="checkbox"> 0-1 year old</button>
                                                                                                                                                                                    <button><input type="checkbox"> 1-5 year old</button>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div> -->
                        </div>
                    </div>
                    <div class="listing-page-right">
                        <div class="right-sorting">
                            <div class="search-title mb-2">
                                <strong>Search Results:</strong>
                                @if(request()->filled('search'))
                                    {{ request('search') }} in
                                @endif
                                @if(request()->filled('city'))
                                    @php
                                        $city = App\City::find(request('city'));
                                        echo $city ? $city->name : '';
                                    @endphp
                                @endif
                                @if(request()->filled('type'))
                                    - {{ ucfirst(request('type')) }} Properties
                                @endif
                                @if(request()->filled('sub_sub_category_id'))
                                    @php
                                        $propertyTypes = explode(',', request('sub_sub_category_id'));
                                        $typeNames = App\SubSubCategory::whereIn('id', $propertyTypes)->pluck('sub_sub_category_name')->toArray();
                                        if (count($typeNames) > 0) {
                                            echo ' - ' . implode(', ', $typeNames);
                                        }
                                    @endphp
                                @endif
                            </div>
                            <div class="sorting-options">
                                <select id="sortBy" name="sort">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sort by: Default</option>
                                    <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price:
                                        Low to High</option>
                                    <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price:
                                        High to Low</option>
                                    <option value="size-low" {{ request('sort') == 'size-low' ? 'selected' : '' }}>Size: Low
                                        to High</option>
                                    <option value="size-high" {{ request('sort') == 'size-high' ? 'selected' : '' }}>Size:
                                        High to Low</option>
                                </select>

                            </div>

                        </div>
                        <div id="listings-container">
                            @include('front.partials.property-listings', ['properties' => $properties])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const listingsContainer = document.getElementById('listings-container');
            const params = new URLSearchParams(window.location.search);
            const searchInput = document.querySelector('.search-input');

            // ----- Initialize Sub Category Buttons -----
            const subCategoryIds = params.get('sub_category_id');
            if (subCategoryIds) {
                subCategoryIds.split(',').forEach(id => {
                    const btns = Array.from(document.querySelectorAll(`.sub-category-btn[data-id='${id}']`));
                    const btn = btns.filter(btn => btn.offsetParent !== null)[0];
                    if (btn) btn.classList.add('active');
                });
            }

            // ----- Initialize Property Type Checkboxes -----
            const propertyTypeIds = params.get('sub_sub_category_id');
            if (propertyTypeIds) {
                propertyTypeIds.split(',').forEach(id => {
                    const cbList = Array.from(document.querySelectorAll(`.sub-sub-category-checkbox[data-id='${id}']`));
                    const cb = cbList.filter(cb => cb.offsetParent !== null)[0];
                    if (cb) cb.checked = true;

                });
            }

            // Initialize Furnishing Status checkboxes
            const furnishingIds = params.get('furnishing_status');
            if (furnishingIds) {
                furnishingIds.split(',').forEach(id => {
                    const cbs = Array.from(document.querySelectorAll(`.furnishing-Status-checkbox[value='${id}']`));
                    const cb = cbs.filter(el => el.offsetParent !== null)[0];
                    if (cb) cb.checked = true;
                });
            }

            // Initialize Property Status checkboxes
            const propertyIds = params.get('property_status');
            if (propertyIds) {
                propertyIds.split(',').forEach(id => {
                    const cbs = Array.from(document.querySelectorAll(`.property-Status-checkbox[value='${id}']`));
                    const cb = cbs.filter(el => el.offsetParent !== null)[0];
                    if (cb) cb.checked = true;
                });
            }

            // Initialize Bedrooms checkboxes
            const bedroomVals = params.get('bedrooms');
            if (bedroomVals) {
                bedroomVals.split(',').forEach(val => {
                    const cbs = Array.from(document.querySelectorAll(`.bedroom-checkbox[value='${val}']`));
                    const cb = cbs.filter(el => el.offsetParent !== null)[0];
                    if (cb) cb.checked = true;
                });
            }

            ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(field => {
                const el = document.getElementById(field);
                if (el && params.get(field)) el.value = params.get(field);
            });

            if (searchInput && params.get('search')) searchInput.value = params.get('search');

            ['verified_property', 'with_photos', 'with_videos'].forEach(param => {
                const el = document.getElementById(param);
                if (el && params.get(param) === '1') el.checked = true;
            });


            if (params.get('price_negotiable') === '1') {
                document.querySelector('.filter-btn[data-filter="price_negotiable"]')?.classList.add('active');
            }
            if (params.get('security_available') === '1') {
                document.querySelector('.filter-btn[data-filter="security_available"]')?.classList.add('active');
            }

            // Select elements
            const locationContainer = document.getElementById('locationsContainer');
            const locationButtons = Array.from(locationContainer.querySelectorAll('.location-btn'));

            // Toggle active class on click and update query params
            locationButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    this.classList.toggle('active');
                    updateLocationsFilter();
                });
            });

            // Search input
            document.getElementById('locationSearch').addEventListener('input', function () {
                const query = this.value.toLowerCase();
                locationButtons.forEach(btn => {
                    // Show button if it matches query OR is selected
                    if (btn.textContent.toLowerCase().includes(query) || btn.classList.contains('active')) {
                        btn.style.display = 'inline-block';
                    } else {
                        btn.style.display = 'none';
                    }
                });
            });

            // Update locations in URL params
            function updateLocationsFilter() {
                const selected = locationButtons.filter(btn => btn.classList.contains('active'))
                    .map(btn => btn.dataset.id);

                if (selected.length) {
                    params.set('locations', selected.join(','));
                } else {
                    params.delete('locations');
                }
                updateFiltersAjax();

            }


            // Collect all filters, generate URL params, and send AJAX request
            function updateFiltersAjax() {

                // Search input
                if (searchInput && searchInput.value.trim()) {
                    params.set('search', searchInput.value.trim());
                }

                // Budget and Size
                ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el && el.value) {
                        params.set(id, el.value);
                    }
                });

                // Sub-category buttons active
                const subCatIds = Array.from(document.querySelectorAll('.sub-category-btn.active'))
                    .map(btn => btn.dataset.id);
                if (subCatIds.length) params.set('sub_category_id', subCatIds.join(','));

                // Property Type checkboxes
                const propertyTypeIds = Array.from(document.querySelectorAll('.sub-sub-category-checkbox:checked'))
                    .map(cb => cb.dataset.id);
                params.set('sub_sub_category_id', propertyTypeIds.join(','));

                // Furnishing Status checkboxes
                const furnishingIds = Array.from(document.querySelectorAll('.furnishing-Status-checkbox:checked'))
                    .map(cb => cb.value);
                if (furnishingIds.length) params.set('furnishing_status', furnishingIds.join(','));

                // Property Status checkboxes
                const propertyIds = Array.from(document.querySelectorAll('.property-Status-checkbox:checked'))
                    .map(cb => cb.value);
                if (propertyIds.length) params.set('property_status', propertyIds.join(','));

                // Verified Properties
                if (document.getElementById('verified_property')?.checked) {
                    params.set('verified_property', '1');
                }

                // Properties with Photos
                if (document.getElementById('with_photos')?.checked) {
                    params.set('with_photos', '1');
                }

                // Properties with Videos
                if (document.getElementById('with_videos')?.checked) {
                    params.set('with_videos', '1');
                }

                // Bedrooms
                const bedroomVals = Array.from(document.querySelectorAll('.bedroom-checkbox:checked'))
                    .map(cb => cb.value);
                if (bedroomVals.length) params.set('bedrooms', bedroomVals.join(','));

                // Sort
                const sortEl = document.getElementById('sortBy');
                if (sortEl && sortEl.value) {
                    params.set('sort', sortEl.value);
                }


                // Check which buttons are active
                const priceBtn = document.querySelector('.filter-btn[data-filter="price_negotiable"]');
                const securityBtn = document.querySelector('.filter-btn[data-filter="security_available"]');

                if (priceBtn && priceBtn.classList.contains('active')) {
                    params.set('price_negotiable', '1');
                } else {
                    params.delete('price_negotiable');
                }

                if (securityBtn && securityBtn.classList.contains('active')) {
                    params.set('security_available', '1');
                } else {
                    params.delete('security_available');
                }

                // Fetch filtered listings via AJAX
                fetch(`${window.location.pathname}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(response => response.text())
                    .then(html => {
                        listingsContainer.innerHTML = html;
                        history.pushState(null, '', `${window.location.pathname}?${params.toString()}`);
                    })
                    .catch(console.error);
            }

            // Bind updateFiltersAjax to all filter input changes
            document.querySelectorAll('.filter-input, .sub-category-btn, .sub-sub-category-checkbox, .furnishing-Status-checkbox, .property-Status-checkbox, .bedroom-checkbox').forEach(el => {
                el.addEventListener('change', updateFiltersAjax);
            });

            // For sub-category buttons which are buttons with active class toggling
            document.querySelectorAll('.sub-category-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.classList.toggle('active');
                    updateFiltersAjax();
                });
            });


            ['budget_min', 'budget_max', 'size_min', 'size_max'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('change', updateFiltersAjax);
                }
            });


            ['verified_property', 'with_photos', 'with_videos'].forEach(id => {
                document.getElementById(id)?.addEventListener('change', updateFiltersAjax);
            });


            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    this.classList.toggle('active'); // visually toggle
                    updateFiltersAjax(); // update URL params
                });
            });

            // Sort select
            const sortBy = document.getElementById('sortBy');
            if (sortBy) {
                sortBy.addEventListener('change', updateFiltersAjax);
            }

            // Search input Enter key
            if (searchInput) {
                searchInput.addEventListener('keypress', e => {
                    if (e.key === 'Enter') {
                        updateFiltersAjax();
                    }
                });
            }

            // ----- Reset Filters -----
            document.getElementById('resetFilters')?.addEventListener('click', function () {
                const params = new URLSearchParams(window.location.search);

                // Remove only filters applied on this page
                ['budget_min', 'budget_max', 'size_min', 'size_max', 'sub_category_id', 'sub_sub_category_id', 'furnishing_status', 'property_status', 'verified_property', 'with_photos', 'with_videos', 'bedrooms', 'sort'].forEach(key => {
                    params.delete(key);
                });

                // Redirect without these filters, keeping other params (like search, city, type)
                window.location.href = `${window.location.pathname}?${params.toString()}`;

            });

        });


    </script>
    <script>
        document.querySelectorAll('.sort-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active state from all buttons
                document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
                // Add active state to clicked button
                btn.classList.add('active');
                // Optional: you can send the value for filtering
                const sortValue = btn.getAttribute('data-value');
                console.log('Selected sort:', sortValue);
                // Example redirect or API call:
                // window.location.href = `?sort=${sortValue}`;
            });
        });
    </script>

@endsection