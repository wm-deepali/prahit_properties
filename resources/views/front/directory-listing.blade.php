@extends('layouts.front.app')
@section('title')
    <title>Directory Listing</title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    }

    .filter-btn:hover {
        background: #f3e8ff;
        border-color: #a855f7;
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
</style>
@section('content')

    <section style="background:#f9f9f9;">
        <div class="top-search-section">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search Anything" onkeyup="filterResults()">
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
                                    <div class="category-wrapper">
                                        <p class="category-item" onclick="toggleCategory(this, 'Real Estate')">Real Estate
                                        </p>
                                        <div class="subcategory-section" style="display: none;">
                                            <!--<hr class="separator">-->
                                            <div class="subcategory-list"></div>
                                        </div>
                                    </div>
                                    <div class="category-wrapper">
                                        <p class="category-item" onclick="toggleCategory(this, 'Construction')">Construction
                                        </p>
                                        <div class="subcategory-section" style="display: none;">
                                            <!--<hr class="separator">-->
                                            <div class="subcategory-list"></div>
                                        </div>
                                    </div>
                                    <div class="category-wrapper">
                                        <p class="category-item" onclick="toggleCategory(this, 'Interior Design')">Interior
                                            Design</p>
                                        <div class="subcategory-section" style="display: none;">
                                            <!--<hr class="separator">-->
                                            <div class="subcategory-list"></div>
                                        </div>
                                    </div>
                                    <div class="category-wrapper">
                                        <p class="category-item" onclick="toggleCategory(this, 'Property Management')">
                                            Property Management</p>
                                        <div class="subcategory-section" style="display: none;">
                                            <!--<hr class="separator">-->
                                            <div class="subcategory-list"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="rating-group">
                                <h2>Ratings</h2>
                                <div class="rating-button">
                                    <button><input type="checkbox" class="filter-checkbox" value="5"
                                            onchange="filterResults()"> <i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i> 5 Stars</button>
                                    <button><input type="checkbox" class="filter-checkbox" value="4"
                                            onchange="filterResults()"> <i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="far fa-star"></i> 4 Stars & Above</button>
                                    <button><input type="checkbox" class="filter-checkbox" value="3"
                                            onchange="filterResults()"> <i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i
                                            class="far fa-star"></i> 3 Stars & Above</button>
                                </div>
                            </div>
                            <hr>
                            <div class="category-group">
                                <h2>Apply Filter</h2>
                                <div class="category-button">
                                    <button><input type="checkbox" class="filter-checkbox" value="Verified Sellers"
                                            onchange="filterResults()"> Verified Sellers</button>
                                    <button><input type="checkbox" class="filter-checkbox" value="Premium Sellers"
                                            onchange="filterResults()"> Premium Sellers</button>
                                    <button><input type="checkbox" class="filter-checkbox" value="Most Rated"
                                            onchange="filterResults()"> Most Rated</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listing-page-right">
                        <div class="right-sorting">
                            <div class="search-title mb-2"><strong>Directory Listing:</strong> Business Companies</div>
                            <div class="sorting-options">
                                <select onchange="sortResults(this.value)">
                                    <option value="default">Sort by: Default</option>
                                    <option value="rating-high">Rating: High to Low</option>
                                    <option value="views-high">Views: High to Low</option>
                                    <option value="established-old">Established Year: Oldest First</option>
                                    <option value="member-old">Member Since: Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div id="directory-cards"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Sample data for directory listings
        const directoryData = [
            { name: "ABC Real Estate", logo: "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Leading real estate company specializing in residential properties.", category: "Real Estate", subCategory: "Residential", established: 2010, memberSince: 2015, views: 5678, rating: 4.5, verified: true, premium: false, mostRated: true },
            { name: "XYZ Construction", logo: "https://images.unsplash.com/photo-1560520659-7d106de61d58?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Expert in building high-quality commercial structures.", category: "Construction", subCategory: "Commercial", established: 2005, memberSince: 2010, views: 4321, rating: 4.8, verified: false, premium: true, mostRated: false },
            { name: "LMN Interior Design", logo: "https://images.unsplash.com/photo-1556910103-1c02745aae4d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Creative interior design solutions for homes.", category: "Interior Design", subCategory: "Residential", established: 2018, memberSince: 2020, views: 3456, rating: 4.2, verified: true, premium: false, mostRated: false },
            { name: "PQR Property Management", logo: "https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Professional property management services.", category: "Property Management", subCategory: "Commercial", established: 2012, memberSince: 2016, views: 2789, rating: 4.9, verified: false, premium: true, mostRated: true },
            { name: "DEF Builders", logo: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Specialized in residential and commercial construction.", category: "Construction", subCategory: "Villas", established: 2008, memberSince: 2013, views: 4890, rating: 4.6, verified: true, premium: false, mostRated: true },
            { name: "GHI Design Studio", logo: "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80", content: "Innovative interior designs for modern homes.", category: "Interior Design", subCategory: "Apartments", established: 2015, memberSince: 2017, views: 3210, rating: 4.3, verified: false, premium: true, mostRated: false }
        ];

        function createCard(company) {
            return `
                <div class="directory-card">
                    <div class="logo-section">
                        <img src="${company.logo}" alt="Company Logo" class="company-logo">
                    </div>
                    <div class="content-section">
                        <div>
                            <div class="directory-header">
                                <h1 class="company-name">${company.name}</h1>
                                <div class="directory-actions">
                                    <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                                    <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                                    <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
                                </div>
                            </div>
                            <div class="short-content">${company.content}</div>
                            <div class="directory-features">
                                <div class="feature-item">
                                    <i class="fas fa-tag feature-icon"></i>
                                    <span class="feature-value">Category: ${company.category}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-tags feature-icon"></i>
                                    <span class="feature-value">Sub Category: ${company.subCategory}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-calendar-alt feature-icon"></i>
                                    <span class="feature-value">Established: ${company.established}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-user-clock feature-icon"></i>
                                    <span class="feature-value">Member Since: ${company.memberSince}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-eye feature-icon"></i>
                                    <span class="feature-value">Views: ${company.views}</span>
                                </div>
                            </div>
                        </div>
                        <div class="directory-buttons">
                            <button class="contact-btn">Contact Now</button>
                            <button class="detail-btn">View Detail</button>
                        </div>
                    </div>
                </div>
            `;
        }

        // JavaScript to handle category and subcategory toggling
        let activeCategory = null;
        let activeSubCategory = null;

        function toggleCategory(element, category) {
            const categoryWrappers = document.querySelectorAll('.category-wrapper');
            const subcategorySection = element.nextElementSibling;
            const subcategoryList = subcategorySection.querySelector('.subcategory-list');
            const subCategories = {
                "Real Estate": ["Residential", "Commercial", "Land/Plot"],
                "Construction": ["Villas", "Commercial", "Residential"],
                "Interior Design": ["Apartments", "Residential"],
                "Property Management": ["Commercial", "Land/Plot"]
            };

            // Remove active state from all categories and close their subcategories
            categoryWrappers.forEach(wrapper => {
                const categoryItem = wrapper.querySelector('.category-item');
                categoryItem.classList.remove('active');
                wrapper.querySelector('.subcategory-section').style.display = 'none';
                wrapper.querySelector('.subcategory-list').innerHTML = '';
            });

            // Set active state on clicked category and open its subcategory section
            element.classList.add('active');
            activeCategory = category;
            subcategorySection.style.display = 'block';

            // Populate subcategory list for the selected category
            subCategories[category].forEach(subCat => {
                const p = document.createElement('p');
                p.textContent = subCat;
                p.onclick = () => toggleSubCategory(p, category, subCat);
                subcategoryList.appendChild(p);
            });

            // Trigger filter update
            filterResults();
        }

        function toggleSubCategory(element, category, subCategory) {
            const subcategoryItems = element.parentElement.querySelectorAll('p');
            subcategoryItems.forEach(item => item.classList.remove('active'));
            element.classList.add('active');
            activeCategory = category;
            activeSubCategory = subCategory;

            // Trigger filter update
            filterResults();
        }

        // Ensure filterResults is updated to handle category and subcategory
        function filterResults() {
            const searchInput = document.querySelector('.search-input')?.value.toLowerCase() || '';
            let filteredData = [...directoryData];

            // Apply search filter
            if (searchInput) {
                filteredData = filteredData.filter(company =>
                    company.name.toLowerCase().includes(searchInput) ||
                    company.content.toLowerCase().includes(searchInput) ||
                    company.category.toLowerCase().includes(searchInput) ||
                    company.subCategory.toLowerCase().includes(searchInput)
                );
            }

            // Apply category filter
            if (activeCategory) {
                filteredData = filteredData.filter(company => company.category === activeCategory);
            }

            // Apply subcategory filter
            if (activeSubCategory) {
                filteredData = filteredData.filter(company => company.subCategory === activeSubCategory);
            }

            // Apply rating filter
            const ratingFilters = document.querySelectorAll('.filter-checkbox:checked');
            if (ratingFilters.length > 0) {
                const ratingValues = Array.from(ratingFilters).map(cb => parseInt(cb.value));
                filteredData = filteredData.filter(company => ratingValues.some(rating => company.rating >= rating));
            }

            // Apply special filters
            const specialFilters = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
                .filter(cb => ["Verified Sellers", "Premium Sellers", "Most Rated"].includes(cb.value))
                .map(cb => cb.value);
            if (specialFilters.length > 0) {
                filteredData = filteredData.filter(company => {
                    return specialFilters.every(filter => {
                        if (filter === "Verified Sellers") return company.verified;
                        if (filter === "Premium Sellers") return company.premium;
                        if (filter === "Most Rated") return company.mostRated;
                        return true;
                    });
                });
            }

            // Sort if a sorting option is selected
            const sortOption = document.querySelector('.sorting-options select')?.value || 'default';
            if (sortOption === "rating-high") filteredData.sort((a, b) => b.rating - a.rating);
            if (sortOption === "views-high") filteredData.sort((a, b) => b.views - a.views);
            if (sortOption === "established-old") filteredData.sort((a, b) => a.established - b.established);
            if (sortOption === "member-old") filteredData.sort((a, b) => a.memberSince - b.memberSince);

            // Render only the first card
            const cardsContainer = document.getElementById('directory-cards');
            cardsContainer.innerHTML = filteredData.length > 0 ? createCard(filteredData[0]) : '<p>No results found.</p>';
        }

        // Initial call to set up (optional, as toggling handles this)
    </script>

@endsection