@extends('layouts.front.app')
@section('title')
	<title>Welcome</title>
@endsection
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
            justify-content:center;
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
        .price-text{
            width:100%;
            height:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            background:#f3f3f32e;
            padding-left:15px;
            border-radius:5px;
            margin-top:10px;
        }
        .price-text h2{
            font-size:22px;
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
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 12px 0;
            color: #6b7280;
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
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
            background: #f9fafb;
            appearance: none;
        }

        .listing-filter .building-type {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .listing-filter .building-type button {
            flex: 1;
            padding: 8px;
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
            padding: 8px;
            /*margin-bottom: 8px;*/
            border: 1px solid #d1d5db;
            border-radius: 4px;
            background: #f9fafb;
            font-size: 14px;
            cursor: pointer;
            gap:10px;
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
        .property-type-button{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
        }
        .property-type-button button{
            width:fit-content;
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
            font-size: 18px;
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
            appearance: none;
            cursor: pointer;
        }
    </style>
@section('content')

<section style="background:#f9f9f9;">
	<div class="container" >
		<div class="row">
		    <div class="listing-page">
		        <div class="listing-page-left">
        <div class="listing-filter">
            <div class="reset-btn d-flex justify-content-between">
                <h2>Filters</h2>
                <button>Reset</button>
            </div>
            <hr>
            
            <div class="budget">
                <h2>Budget</h2>
                <div class="range-group">
                    <select>
                        <option value="">Min</option>
                        <option value="1000">₹1,000</option>
                        <option value="5000">₹5,000</option>
                        <option value="10000">₹10,000</option>
                    </select>
                    <select>
                        <option value="">Max</option>
                        <option value="20000">₹20,000</option>
                        <option value="50000">₹50,000</option>
                        <option value="100000">₹1,00,000</option>
                    </select>
                </div>
            </div>
            <div class="size">
                <h2>Size</h2>
                <div class="range-group">
                    <select>
                        <option value="">Min</option>
                        <option value="500">500 sqft</option>
                        <option value="1000">1000 sqft</option>
                        <option value="1500">1500 sqft</option>
                    </select>
                    <select>
                        <option value="">Max</option>
                        <option value="2000">2000 sqft</option>
                        <option value="3000">3000 sqft</option>
                        <option value="4000">4000 sqft</option>
                    </select>
                </div>
            </div>
            <div class="building-type d-flex flex-column">
                <h2>Building Type</h2>
                <div class="d-flex justify-content-between gap-2">
                    <button class="active">Residential</button>
                <button>Commercial</button>
                </div>
                
            </div>
            <div class="property-type d-flex flex-column">
                <h2>Property Type</h2>
                <div class="property-type-button">
                <button><input type="checkbox" checked> Plot</button>
                <button><input type="checkbox" checked> Apartment</button>
                <button><input type="checkbox"> Villa</button>
                <button><input type="checkbox"> Builder Floor</button>
                <button><input type="checkbox"> Independent House</button>
                <button><input type="checkbox"> Penthouse</button>
                </div>
            </div>
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
            <div class="furnishing-status">
                <h2>Furnishing Status</h2>
                <div class="property-type-button">
                <button><input type="checkbox"> Furnished</button>
                <button><input type="checkbox"> Semi-Furnished</button>
                </div>
            </div>
        </div>
    </div>
		        <div class="listing-page-right">
		            <div class="right-sorting">
        <div class="search-title">Search Results: 2 BHK Flat for Rent in Gulshan Nagar, Srinagar</div>
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
		           <div class="listing-page-card">
        <div class="image-section">
            <div class="image-count">1 Photo</div>
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Industrial worker" class="property-image">
<div class="price-text"><h2 class="m-0">₹16 Cr</h2>
            <p class="m-0">See other charges</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <div class="listing-header">
                    <h1 class="listing-title">2 BHK Flat for Rent in Gulshan Nagar, Srinagar</h1>
                    <div class="listing-actions">
                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                    <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
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
                    2 BHK, Multistorey Apartment is available for Rent in Gulshan Nagar, Srinagar for 16000
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <div class="listing-owner-info mb-2">
                    <div class="owner-avatar">RA</div>
                    <span><strong>Owner:</strong> Rafiq Ahmad</span>
                </div>
                <div class="listing-owner-info mb-2">
                    
                    <span><strong>Posted on:</strong> 15 Oct 2025</span>
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
    <div class="listing-page-card">
        <div class="image-section">
            <div class="image-count">1 Photo</div>
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Industrial worker" class="property-image">
<div class="price-text"><h2 class="m-0">₹16 Cr</h2>
            <p class="m-0">See other charges</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <div class="listing-header">
                    <h1 class="listing-title">2 BHK Flat for Rent in Gulshan Nagar, Srinagar</h1>
                    <div class="listing-actions">
                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                    <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
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
                    2 BHK, Multistorey Apartment is available for Rent in Gulshan Nagar, Srinagar for 16000
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <div class="listing-owner-info mb-2">
                    <div class="owner-avatar">RA</div>
                    <span><strong>Owner:</strong> Rafiq Ahmad</span>
                </div>
                <div class="listing-owner-info mb-2">
                    
                    <span><strong>Posted on:</strong> 15 Oct 2025</span>
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
    <div class="listing-page-card">
        <div class="image-section">
            <div class="image-count">1 Photo</div>
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Industrial worker" class="property-image">
<div class="price-text"><h2 class="m-0">₹16 Cr</h2>
            <p class="m-0">See other charges</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <div class="listing-header">
                    <h1 class="listing-title">2 BHK Flat for Rent in Gulshan Nagar, Srinagar</h1>
                    <div class="listing-actions">
                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                    <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
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
                    2 BHK, Multistorey Apartment is available for Rent in Gulshan Nagar, Srinagar for 16000
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <div class="listing-owner-info mb-2">
                    <div class="owner-avatar">RA</div>
                    <span><strong>Owner:</strong> Rafiq Ahmad</span>
                </div>
                <div class="listing-owner-info mb-2">
                    
                    <span><strong>Posted on:</strong> 15 Oct 2025</span>
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
    <div class="listing-page-card">
        <div class="image-section">
            <div class="image-count">1 Photo</div>
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Industrial worker" class="property-image">
<div class="price-text"><h2 class="m-0">₹16 Cr</h2>
            <p class="m-0">See other charges</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <div class="listing-header">
                    <h1 class="listing-title">2 BHK Flat for Rent in Gulshan Nagar, Srinagar</h1>
                    <div class="listing-actions">
                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                    <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
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
                    2 BHK, Multistorey Apartment is available for Rent in Gulshan Nagar, Srinagar for 16000
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <div class="listing-owner-info mb-2">
                    <div class="owner-avatar">RA</div>
                    <span><strong>Owner:</strong> Rafiq Ahmad</span>
                </div>
                <div class="listing-owner-info mb-2">
                    
                    <span><strong>Posted on:</strong> 15 Oct 2025</span>
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
   
    

   
		            
		        </div>
		    </div>
			
		</div>
	</div>
</section>
 


@endsection
@section('js')
@endsection