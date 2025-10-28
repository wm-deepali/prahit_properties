@if(isset($properties) && $properties->count() > 0)
    @foreach($properties as $property)
        <div class="listing-page-card">
            <div class="image-section">
                <div class="image-count">1 Photo</div>
                <img src="{{ isset($property->PropertyGallery[0]->image_path) ? asset($property->PropertyGallery[0]->image_path) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}"
                    alt="{{ $property->title }}" class="property-image">
                <div class="price-text">
                    <h2 class="m-0">₹{{ \App\Helpers\Helper::formatIndianPrice($property->price ?? 0) }}</h2>
                    <p class="m-0">See other charges</p>
                </div>
            </div>
            <div class="content-section">
                <div>
                    <div class="listing-header">
                        <h1 class="listing-title">
                            <a href="{{ route('property_detail', ['title' => $property->slug]) }}"style="text-decoration: none; color: inherit;">
                                {{ $property->title ?? '' }}
                            </a>
                        </h1>
                        <div class="listing-actions">
                            <button class="action-btn" title="Like"><i class="fas fa-heart"></i></button>
                            <button class="action-btn" title="Share"><i class="fas fa-share"></i></button>
                            <button class="action-btn" title="More"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                    </div>
                    <div class="listing-features">
                        <!-- Your property features here -->
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
                            <span><strong>Posted on:</strong> {{ optional($property->created_at)->format('d M Y') }}</span>
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

    <div class="pagination-links">
        {{ $properties->links() }}
    </div>
@else
    <p>No properties found matching your criteria.</p>
@endif
