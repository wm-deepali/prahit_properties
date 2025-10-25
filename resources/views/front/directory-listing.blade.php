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
</style>
@section('content')
    <section style="background:#f9f9f9;">
        <div class="top-search-section">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search Anything"
                        value="{{ request('search') }}">
                    <i class="fas fa-microphone mic-icon"></i>
                </div>
                <div class="filter-buttons">
                    <span class="filter-label">Quick Filters:</span>
                    <button class="filter-btn {{ request('verified') == 'true' ? 'active' : '' }}"
                        onclick="applyQuickFilter('verified')">
                        <i class="fas fa-check-circle"></i> Verified
                    </button>
                    <button class="filter-btn {{ request('premium') == 'true' ? 'active' : '' }}"
                        onclick="applyQuickFilter('premium')">
                        <i class="fas fa-crown"></i> Premium
                    </button>
                    <button class="filter-btn {{ request('sort') == 'rating-high' ? 'active' : '' }}"
                        onclick="applyQuickFilter('top_rated')">
                        <i class="fas fa-star"></i> Top Rated
                    </button>
                    <button class="filter-btn {{ request('sort') == 'views-high' ? 'active' : '' }}"
                        onclick="applyQuickFilter('most_viewed')">
                        <i class="fas fa-fire"></i> Popular
                    </button>
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
                                    @foreach($categories as $category)
                                        <div class="category-wrapper">
                                            <p class="category-item" data-category-id="{{ $category->id }}"
                                                onclick="toggleCategory(this, '{{ $category->category_name }}', {{ $category->id }})">
                                                {{ $category->category_name }}
                                            </p>
                                            <div class="subcategory-section" style="display: none;">
                                                <div class="subcategory-list">
                                                    @foreach($category->subcategories as $subCat)
                                                        <p data-subcategory-id="{{ $subCat->id }}"
                                                            onclick="selectSubCategory(this, {{ $category->id }}, {{ $subCat->id }})">
                                                            {{ $subCat->sub_category_name }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                <strong>Directory Listing:</strong> Business Companies ({{ $list->total() }} Results)
                            </div>
                            <div class="sorting-options">
                                <select id="sortSelect">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Sort by:
                                        Default</option>
                                    <option value="rating-high" {{ request('sort') == 'rating-high' ? 'selected' : '' }}>
                                        Rating: High to Low</option>
                                    <option value="views-high" {{ request('sort') == 'views-high' ? 'selected' : '' }}>Views:
                                        High to Low</option>
                                    <option value="established-old" {{ request('sort') == 'established-old' ? 'selected' : '' }}>Established Year: Oldest First</option>
                                    <option value="member-old" {{ request('sort') == 'member-old' ? 'selected' : '' }}>Member
                                        Since: Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div id="directory-cards">
                            @forelse($list as $company)
                                <div class="directory-card">
                                    <div class="logo-section">
                                        <img src="{{ isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80' }}"
                                            alt="Company Logo" class="company-logo">
                                    </div>
                                    <div class="content-section">
                                        <div>
                                            <div class="directory-header">
                                                <h1 class="company-name">{{ $company->business_name }}</h1>
                                                <div class="directory-actions">
                                                    <button class="action-btn" title="Like">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                    <button class="action-btn" title="Share">
                                                        <i class="fas fa-share"></i>
                                                    </button>
                                                    <button class="action-btn" title="More">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="short-content">
                                                {{ \Illuminate\Support\Str::limit($company->introduction, 350) }}
                                            </div>
                                            <div class="directory-features">
                                                <div class="feature-item">
                                                    <i class="fas fa-tag feature-icon"></i>
                                                    <span class="feature-value">Category:
                                                        {{ $company->category->category_name ?? 'N/A' }}</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-tags feature-icon"></i>
                                                    <span class="feature-value">
                                                        Sub Category:
                                                        {{ $company->subCategories->pluck('sub_category_name')->implode(', ') }}
                                                    </span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-calendar-alt feature-icon"></i>
                                                    <span class="feature-value">Established:
                                                        {{ $company->established_year }}</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-user-clock feature-icon"></i>
                                                    <span class="feature-value">
                                                        Member Since: {{ $company->created_at->format('Y') }}
                                                    </span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-eye feature-icon"></i>
                                                    <span class="feature-value">Views: {{ $company->total_views }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="directory-buttons">
                                            <button class="contact-btn" onclick="contactBusiness({{ $company->id }})">
                                                Contact Now
                                            </button>
                                            <a href="{{ route('business.details', $company->id) }}" class="detail-btn"
                                                style="text-decoration:none; display:flex; align-items:center; justify-content:center;">
                                                View Detail
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No results found.</p>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
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

        // ✅ Quick Filter Function
        function applyQuickFilter(filterType) {
            const params = new URLSearchParams(window.location.search);

            // Clear conflicting filters
            params.delete('verified');
            params.delete('premium');
            params.delete('sort');

            switch (filterType) {
                case 'verified':
                    params.set('verified', 'true');
                    break;
                case 'premium':
                    params.set('premium', 'true');
                    break;
                case 'top_rated':
                    params.set('sort', 'rating-high');
                    break;
                case 'most_viewed':
                    params.set('sort', 'views-high');
                    break;
            }

            window.location.href = "{{ route('directory.list') }}?" + params.toString();
        }

        // Toggle category and show subcategories
        function toggleCategory(element, categoryName, categoryId) {
            const categoryWrappers = document.querySelectorAll('.category-wrapper');
            const subcategorySection = element.nextElementSibling;

            // Remove active state from all categories and close their subcategories
            categoryWrappers.forEach(wrapper => {
                const categoryItem = wrapper.querySelector('.category-item');
                categoryItem.classList.remove('active');
                wrapper.querySelector('.subcategory-section').style.display = 'none';
            });

            // Set active state on clicked category
            element.classList.add('active');
            selectedCategory = categoryId;
            selectedSubCategory = null; // Reset subcategory
            subcategorySection.style.display = 'block';

            // Apply filters
            applyFilters();
        }

        // Select subcategory
        function selectSubCategory(element, categoryId, subCategoryId) {
            const subcategoryItems = element.parentElement.querySelectorAll('p');
            subcategoryItems.forEach(item => item.classList.remove('active'));
            element.classList.add('active');

            selectedCategory = categoryId;
            selectedSubCategory = subCategoryId;

            // Apply filters
            applyFilters();
        }

        // Search input with debounce
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 500);
        });

        // Sort change
        document.getElementById('sortSelect').addEventListener('change', function () {
            applyFilters();
        });

        // Rating and other filters
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (this.name === 'rating') {
                    // Clear other rating checkboxes
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

        // Apply all filters
        function applyFilters() {
            const params = new URLSearchParams();

            // Add search
            const searchValue = document.getElementById('searchInput').value;
            if (searchValue) params.append('search', searchValue);

            // Add category
            if (selectedCategory) params.append('category', selectedCategory);

            // Add subcategory
            if (selectedSubCategory) params.append('subcategory', selectedSubCategory);

            // Add rating
            if (selectedRating) params.append('rating', selectedRating);

            // Add verified filter
            if (selectedFilters.verified) params.append('verified', 'true');

            // Add premium filter
            if (selectedFilters.premium) params.append('premium', 'true');

            // Add most_rated filter
            if (selectedFilters.most_rated) params.append('most_rated', 'true');

            // Add sorting
            const sortValue = document.getElementById('sortSelect').value;
            if (sortValue !== 'default') params.append('sort', sortValue);

            // Redirect with filters
            window.location.href = "{{ route('directory.list') }}?" + params.toString();
        }

        // Reset all filters
        function resetFilters() {
            window.location.href = "{{ route('directory.list') }}";
        }

        // Contact business (you can implement modal or redirect)
        function contactBusiness(businessId) {
            // Implement your contact logic here
            alert('Contact business ID: ' + businessId);
        }

        // Set active states on page load based on URL parameters
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);

            // Set category active
            const categoryParam = urlParams.get('category');
            if (categoryParam) {
                const categoryEl = document.querySelector(`[data-category-id="${categoryParam}"]`);
                if (categoryEl) {
                    categoryEl.classList.add('active');
                    categoryEl.nextElementSibling.style.display = 'block';
                    selectedCategory = parseInt(categoryParam);
                }
            }

            // Set subcategory active
            const subcategoryParam = urlParams.get('subcategory');
            if (subcategoryParam) {
                const subcategoryEl = document.querySelector(`[data-subcategory-id="${subcategoryParam}"]`);
                if (subcategoryEl) {
                    subcategoryEl.classList.add('active');
                    selectedSubCategory = parseInt(subcategoryParam);
                }
            }

            // Set rating
            const ratingParam = urlParams.get('rating');
            if (ratingParam) {
                const ratingCheckbox = document.querySelector(`.filter-checkbox[name="rating"][value="${ratingParam}"]`);
                if (ratingCheckbox) {
                    ratingCheckbox.checked = true;
                    selectedRating = ratingParam;
                }
            }

            // Set verified
            if (urlParams.get('verified') === 'true') {
                const verifiedCheckbox = document.querySelector('.filter-checkbox[name="verified"]');
                if (verifiedCheckbox) {
                    verifiedCheckbox.checked = true;
                    selectedFilters.verified = true;
                }
            }

            // Set premium
            if (urlParams.get('premium') === 'true') {
                const premiumCheckbox = document.querySelector('.filter-checkbox[name="premium"]');
                if (premiumCheckbox) {
                    premiumCheckbox.checked = true;
                    selectedFilters.premium = true;
                }
            }

            // Set most_rated
            if (urlParams.get('most_rated') === 'true') {
                const mostRatedCheckbox = document.querySelector('.filter-checkbox[name="most_rated"]');
                if (mostRatedCheckbox) {
                    mostRatedCheckbox.checked = true;
                    selectedFilters.most_rated = true;
                }
            }
        });
    </script>

@endsection