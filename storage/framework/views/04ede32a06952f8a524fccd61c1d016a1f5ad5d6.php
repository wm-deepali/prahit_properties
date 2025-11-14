<?php $__empty_1 = true; $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="directory-card">
        <div class="logo-section">
            <img src="<?php echo e(isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80'); ?>"
                alt="Company Logo" class="company-logo">
            
            <div class="badge-wrapper">
                <?php if($company->premium_badge == 'Yes'): ?>
                    <span class="premium-badge">Premium</span>
                <?php elseif($company->verified_badge == 'Yes'): ?>
                    <span class="verified-badge">Verified</span>
                <?php endif; ?>
            </div>

        </div>
        <div class="content-section">
            <div>
                <div class="directory-header">
                    <h1 class="company-name"><?php echo e($company->business_name); ?></h1>
                    <div class="directory-actions">
                        <button class="action-btn wishlist-btn" data-business-id="<?php echo e($company->id); ?>" title="Wishlist">
                            <i
                                class="fas fa-heart <?php echo e(auth()->check() && \App\Models\BusinessWishlist::where('user_id', auth()->id())->where('business_listing_id', $company->id)->exists() ? 'text-danger' : ''); ?>"></i>
                        </button>

                        <button class="action-btn share-btn" data-id="<?php echo e($company->id); ?>"
                            data-name="<?php echo e($company->business_name); ?>" title="Share">
                            <i class="fas fa-share"></i>
                        </button>

                        <button class="action-btn more-btn" data-url="<?php echo e(route('business.details', $company->id)); ?>"
                            title="View Details">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>

                </div>
                <div class="short-content">
                    <?php echo e(\Illuminate\Support\Str::limit($company->introduction, 350)); ?>

                </div>
                <div class="directory-features">
                    <div class="feature-item"><i class="fas fa-tag feature-icon"></i>
                        <span>Category: <?php echo e($company->category->category_name ?? 'N/A'); ?></span>
                    </div>
                    <div class="feature-item"><i class="fas fa-tags feature-icon"></i>
                        <span>Sub Category: <?php echo e($company->subCategories->pluck('sub_category_name')->implode(', ')); ?></span>
                    </div>
                    <div class="feature-item"><i class="fas fa-calendar-alt feature-icon"></i>
                        <span>Established: <?php echo e($company->established_year); ?></span>
                    </div>
                    <div class="feature-item"><i class="fas fa-user-clock feature-icon"></i>
                        <span>Member Since: <?php echo e($company->created_at->format('Y')); ?></span>
                    </div>
                    <div class="feature-item"><i class="fas fa-eye feature-icon"></i>
                        <span>Views: <?php echo e($company->total_views); ?></span>
                    </div>
                </div>
            </div>
            <div class="directory-buttons">
                <button class="contact-btn" onclick="contactBusiness(<?php echo e($company->id); ?>)">Contact Now</button>

                <a href="<?php echo e(route('business.details', $company->id)); ?>" class="detail-btn">View Detail</a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>No results found.</p>
<?php endif; ?>

<!-- Pagination -->
<div class="mt-4">
    <?php echo e($list->links()); ?>

</div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/partials/directory-items.blade.php ENDPATH**/ ?>