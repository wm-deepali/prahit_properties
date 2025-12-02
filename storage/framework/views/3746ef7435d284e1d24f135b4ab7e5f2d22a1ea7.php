

<?php $__env->startSection('title'); ?>
    <title>My Wishlist</title>
<?php $__env->stopSection(); ?>

<style>
    .wishlist-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background: #f9fbff;
    }

    .wishlist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .wishlist-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .wishlist-info {
        padding: 1rem 1.25rem;
    }

    .wishlist-info h5 {
        font-size: 1.1rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .wishlist-info h5 a {
        text-decoration: none;
        color: #007bff;
    }

    .wishlist-info h5 a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .wishlist-info p {
        margin: 0 0 5px;
        font-size: 14px;
        color: #333;
    }

    .property-actions {
        margin-top: 10px;
    }

    .property-actions .btn {
        margin-right: 8px;
        border-radius: 6px;
    }

    .property-actions .btn:last-child {
        margin-right: 0;
    }
</style>

<?php $__env->startSection('content'); ?>

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Wishlist</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="owner-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="col-sm-9">
                    <div class="main-area-dash">
                        <h3 class="head-tit mb-4">Saved Properties</h3>

                        <div class="row g-3">
                            <?php $__empty_1 = true; $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $company = $item->business;
                                  ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card wishlist-card">
                                        <img src="<?php echo e(isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80'); ?>"
                                            alt="<?php echo e($company->business_name); ?>">
                                        <div class="wishlist-info">
                                            <h5><a
                                                    href="<?php echo e(route('business.details', ['id' => $company->id, 'slug' => $company->slug])); ?>"><?php echo e($company->business_name); ?></a>
                                            </h5>
                                            <p><strong>Location:</strong> <?php echo e($company->city ?? 'N/A'); ?>,
                                                <?php echo e($company->state ?? 'N/A'); ?></p>
                                            <p><strong>Category:</strong> <?php echo e($company->Category->category_name ?? '-'); ?></p>
                                            <div class="property-actions">
                                                <a href="<?php echo e(route('business.details', ['id' => $company->id, 'slug' => $company->slug])); ?>"
                                                    class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-outline-danger remove-wishlist"
                                                    data-business-id="<?php echo e($company->id); ?>">
                                                    <i class="fas fa-trash"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">
                                    <div class="alert alert-info text-center mb-0">
                                        You haven't added any properties to your wishlist yet.
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div> <!-- row end -->
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).on('click', '.remove-wishlist', function () {
            const businessId = $(this).data('business-id');
            if (confirm('Are you sure you want to remove this property from your wishlist?')) {
                $.ajax({
                    url: "<?php echo e(route('business.wishlist.toggle')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        business_listing_id: businessId
                    },
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/services/wishlist.blade.php ENDPATH**/ ?>