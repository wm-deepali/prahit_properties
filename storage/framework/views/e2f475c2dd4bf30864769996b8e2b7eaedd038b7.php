<?php if(isset($properties) && $properties->count() > 0): ?>
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="listing-page-card">
            <div class="image-section">
                <div class="image-count">1 Photo</div>
                <img src="<?php echo e(isset($property->PropertyGallery[0]->image_path) ? asset($property->PropertyGallery[0]->image_path) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'); ?>"
                    alt="<?php echo e($property->title); ?>" class="property-image">
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
                            <button class="action-btn wishlist-btn" data-property-id="<?php echo e($property->id); ?>" title="Wishlist">
                                <i
                                    class="fas fa-heart <?php echo e(auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('property_id', $property->id)->exists() ? 'text-danger' : ''); ?>"></i>
                            </button>

                            <button class="action-btn share-btn" data-id="<?php echo e($property->id); ?>"
                                data-name="<?php echo e($property->title); ?>" title="Share">
                                <i class="fas fa-share"></i>
                            </button>

                            <button class="action-btn more-btn" data-url="<?php echo e(route('property_detail', ['title' => $property->slug])); ?>"
                                title="View Details">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
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
                            <span><strong>Posted on:</strong> <?php echo e(optional($property->created_at)->format('d M Y')); ?></span>
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
    <div class="d-flex justify-content-center">
        <?php echo e($properties->links()); ?>

    </div>
<?php else: ?>
    <p>No properties found matching your criteria.</p>
<?php endif; ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/partials/property-listings.blade.php ENDPATH**/ ?>