@forelse($list as $company)
    <div class="directory-card">
        <div class="logo-section">
            <img src="{{ isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80' }}"
                alt="Company Logo" class="company-logo">
            {{-- Badge overlay --}}
            <div class="badge-wrapper">
                @if($company->badge_type == 'premium')
                    <span class="premium-badge">Premium</span>
                @elseif($company->badge_type == 'verified')
                    <span class="verified-badge">Verified</span>
                @endif
            </div>

        </div>
        <div class="content-section">
            <div>
                <div class="directory-header">
                    <h1 class="company-name">{{ $company->business_name }}</h1>
                    <div class="directory-actions">
                        <button class="action-btn wishlist-btn" data-business-id="{{ $company->id }}" title="Wishlist">
                            <i
                                class="fas fa-heart {{ auth()->check() && \App\Models\BusinessWishlist::where('user_id', auth()->id())->where('business_listing_id', $company->id)->exists() ? 'text-danger' : '' }}"></i>
                        </button>

                        <button class="action-btn share-btn" data-id="{{ $company->id }}"
                            data-name="{{ $company->business_name }}" title="Share">
                            <i class="fas fa-share"></i>
                        </button>

                        <button class="action-btn more-btn" data-url="{{ route('business.details', $company->id) }}"
                            title="View Details">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>

                </div>
                <div class="short-content">
                    {{ \Illuminate\Support\Str::limit($company->introduction, 350) }}
                </div>
                <div class="directory-features">
                    <div class="feature-item"><i class="fas fa-tag feature-icon"></i>
                        <span>Category: {{ $company->category->category_name ?? 'N/A' }}</span>
                    </div>
                    <div class="feature-item"><i class="fas fa-tags feature-icon"></i>
                        <span>Sub Category: {{ $company->subCategories->pluck('sub_category_name')->implode(', ') }}</span>
                    </div>
                    <div class="feature-item"><i class="fas fa-calendar-alt feature-icon"></i>
                        <span>Established: {{ $company->established_year }}</span>
                    </div>
                    <div class="feature-item"><i class="fas fa-user-clock feature-icon"></i>
                        <span>Member Since: {{ $company->created_at->format('Y') }}</span>
                    </div>
                    <div class="feature-item"><i class="fas fa-eye feature-icon"></i>
                        <span>Views: {{ $company->total_views }}</span>
                    </div>
                </div>
            </div>
            <div class="directory-buttons">
                <button class="contact-btn" onclick="contactBusiness({{ $company->id }})">Contact Now</button>

                <a href="{{ route('business.details', $company->id) }}" class="detail-btn">View Detail</a>
            </div>
        </div>
    </div>
@empty
    <p>No results found.</p>
@endforelse

<!-- Pagination -->
<div class="mt-4">
    {{ $list->links() }}
</div>