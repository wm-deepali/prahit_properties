@extends('layouts.front.app')
@section('title')
    <title>Welcome</title>
@endsection
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

    .filter-btn.active {
        background: #f3e8ff;
        border-color: #a855f7;
    }

    .location-btn.active {
        background-color: #007bff !important;
        color: #fff;
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
                                            data-id="{{ $loc->id }}" style="{{ in_array($loc->id, $selectedLocations) ? '' : 'display:none;' }}">
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
                        @if(isset($properties))
                            @foreach($properties as $property)
                                <div class="listing-page-card">
                                    <div class="image-section">
                                        <div class="image-count">1 Photo</div>
                                        <img src="{{isset($property->PropertyGallery[0]->image_path) ? asset('') . $property->PropertyGallery[0]->image_path : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'}}"
                                            alt="Industrial worker" class="property-image">
                                        <div class="price-text">
                                            <h2 class="m-0">₹{{\App\Helpers\Helper::formatIndianPrice($property->price ?? 0)}}</h2>
                                            <p class="m-0">See other charges</p>
                                        </div>
                                    </div>
                                    <div class="content-section">
                                        <div>
                                            <div class="listing-header">
                                                <h1 class="listing-title">
                                                    <a href="{{ route('property_detail', ['title' => $property->slug]) }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        {{ $property->title ?? '' }}
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
                                                {{ \Illuminate\Support\Str::limit($property->description, 50) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div class="listing-owner-info mb-2">
                                                    <div class="owner-avatar">RA</div>
                                                    <span><strong>Owner:</strong> {{ $property->getUser->firstname ?? '' }}</span>
                                                </div>
                                                <div class="listing-owner-info mb-2">
                                                    <span><strong>Posted on:</strong>
                                                        {{ optional($property->created_at)->format('d M Y') }}</span>
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
                            @endforeach
                        @endif
                        <div class="d-flex justify-content-center">
                            {{ $properties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        // Scroll Section Function
        function scrollSection(distance) {
            const container = document.querySelector('.filter-options-container');
            if (container) container.scrollLeft += distance;
        }



        document.getElementById('resetFilters')?.addEventListener('click', function () {
            const params = new URLSearchParams(window.location.search);

            // Remove only filters applied on this page
            ['budget_min', 'budget_max', 'size_min', 'size_max', 'sub_category_id', 'sub_sub_category_id', 'furnishing_status', 'property_status', 'verified_property', 'with_photos', 'with_videos', 'bedrooms', 'sort'].forEach(key => {
                params.delete(key);
            });

            // Redirect without these filters, keeping other params (like search, city, type)
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });


        // ----- Search By buttons -----
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.classList.toggle('active'); // visually toggle
                updateSearchByFilters(); // update URL params
            });
        });

        function updateSearchByFilters() {
            const params = new URLSearchParams(window.location.search);

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

            // Redirect with updated params
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }


        const params = new URLSearchParams(window.location.search);
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

        // document.getElementById('showMoreLocations')?.addEventListener('click', function () {
        //     locationButtons.forEach(btn => btn.style.display = 'inline-block');
        //     this.style.display = 'none'; // hide button after click
        // });

        // Update locations in URL params
        function updateLocationsFilter() {
            const params = new URLSearchParams(window.location.search);
            const selected = locationButtons.filter(btn => btn.classList.contains('active'))
                .map(btn => btn.dataset.id);

            if (selected.length) {
                params.set('locations', selected.join(','));
            } else {
                params.delete('locations');
            }

            window.location.href = `${window.location.pathname}?${params.toString()}`;
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

            ['verified_property', 'with_photos', 'with_videos'].forEach(param => {
                const el = document.getElementById(param);

                if (el && params.get(param) === '1') el.checked = true;
            });

            // Initialize Bedrooms checkboxes
            const bedroomVals = params.get('bedrooms');
            if (bedroomVals) {
                bedroomVals.split(',').forEach(val => {
                    const cb = document.querySelector(`.bedroom-checkbox[value='${val}']`);
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

            // Verified Properties
            const verified = document.getElementById('verified_property')?.checked;
            if (verified) params.set('verified_property', '1');
            else params.delete('verified_property');

            // Properties with Photos
            const withPhotos = document.getElementById('with_photos')?.checked;
            if (withPhotos) params.set('with_photos', '1');
            else params.delete('with_photos');

            // Properties with Video
            const withVideos = document.getElementById('with_videos')?.checked;
            if (withVideos) params.set('with_videos', '1');
            else params.delete('with_videos');


            // Bedrooms
            const bedroomVals = Array.from(document.querySelectorAll('.bedroom-checkbox:checked'))
                .map(cb => cb.value);
            if (bedroomVals.length) params.set('bedrooms', bedroomVals.join(','));
            else params.delete('bedrooms');


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

        ['verified_property', 'with_photos', 'with_videos'].forEach(id => {
            document.getElementById(id)?.addEventListener('change', updateFilters);
        });

        document.querySelectorAll('.bedroom-checkbox').forEach(cb => {
            cb.addEventListener('change', updateFilters);
        });


        document.getElementById('sortBy').addEventListener('change', function () {
            const params = new URLSearchParams(window.location.search);
            const value = this.value;
            if (value) params.set('sort', value);
            else params.delete('sort');
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });

    </script>

@endsection