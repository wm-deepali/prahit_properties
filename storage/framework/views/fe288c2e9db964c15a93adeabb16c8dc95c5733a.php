
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php $__env->startSection('title'); ?>
    <title>Profile</title>
<?php $__env->stopSection(); ?>

<style>
    .portfolio-section {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .portfolio-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 10px;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .portfolio-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-top: 10px;
    }

    .portfolio-card img {
        border-radius: 10px;
        object-fit: cover;
        width: 100%;
        height: 200px;
    }

    .btn-callback {
        width: 100%;
        background-color: #ff7b00;
        color: #fff;
        font-weight: 700;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        font-size: 20px;
    }

    .btn-callback:hover {
        background-color: #e86c00;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    }
</style>
<style>
    .profile-section1 {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .profile-header {
        position: relative;
        background: linear-gradient(135deg, #e8f1f9 0%, #e5feff 100%);
        background-size: cover;
        background-position: center;
        height: 350px;
        display: flex;
        align-items: center;
        color: #333;
        margin-bottom: 40px;
    }

    .profile-avatar {
        width: 230px;
        height: 280px;
        border-radius: 5px;
        border: 6px solid rgba(255, 255, 255, 0.8);
        margin-right: 30px;
        object-fit: cover;
        float: inline-end;
    }

    .profil-data {
        color: #444;
    }

    .profile-name-info h2 {
        font-size: 2.5rem;
        margin: 0;
        font-family: 'Arial', sans-serif;
        font-weight: 700;
        color: #333;
    }

    .profile-name-info p {
        margin: 0;
        font-size: 1.1rem;
        color: #555;
    }

    .profile-name-info p strong {
        color: #444;
    }

    .hori-line {
        width: 70%;
        height: auto;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .hori-line p {
        margin: 0;
        padding: 10px;
        font-size: 1rem;
        color: #555;
    }

    .hori-line p strong {
        color: #333;
        font-size: 1.2rem;
    }

    .line {
        width: 1px;
        height: 50px;
        background: #ccc;
    }

    .stats-card {
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin-bottom: 20px;
        color: #585858;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: bold;
        font-family: 'Verdana', sans-serif;
    }

    .stat-label {
        color: #585858;
        font-size: 1rem;
        font-family: 'Arial', sans-serif;
        opacity: 0.9;
    }

    .card1 {
        background: linear-gradient(135deg, #fbf4f5 0%, #fff5f2 100%);
    }

    .card2 {
        background: linear-gradient(135deg, #e6efff 0%, #edf4f7 100%);
    }

    .card3 {
        background: linear-gradient(135deg, #e4f1e4 0%, #d7e9d7 100%);
    }

    .card4 {
        background: linear-gradient(135deg, #fffafa 0%, #f7e4bc 100%);
    }

    .services-section,
    .properties-section,
    .contact-section {
        padding: 50px 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .service-item,
    .property-card {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .service-item:hover,
    .property-card:hover {
        transform: translateY(-5px);
    }

    .introduction {
        padding: 40px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        line-height: 1.8;
        font-family: 'Georgia', serif;
        color: #333;
    }

    .property-card {
        border: none;
        overflow: hidden;
    }

    .property-img {
        height: 250px;
        object-fit: cover;
        position: relative;
    }

    .property-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .property-card:hover .property-overlay {
        opacity: 1;
    }

    .property-favorite {
        background: #ff4444;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
    }

    .property-details {
        padding: 15px;
    }

    .property-details h5 {
        font-size: 1.3rem;
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif;
    }

    .property-details p {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 10px;
    }

    .property-meta {
        font-size: 0.9rem;
        color: #888;
    }

    .contact-card,
    .feedback-form {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .timing-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        font-size: 1rem;
    }

    .related-agents {
        position: sticky;
        top: 20px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .agent-card {
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }

    .agent-card:hover {
        transform: translateY(-5px);
    }

    .newdesign-image-agent {
        position: relative;
    }

    .newdesign-image-agent img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .newdesign-verified-seal {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 0.9rem;
    }

    .newdesign-info-agent {
        padding: 15px;
    }

    .newdesign-info-agent .newdesign-proj-name {
        font-size: 1.3rem;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
    }

    .newdesign-info-agent .newdesign-apart-name {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 10px;
    }

    .newdesign-info-agent hr {
        margin: 10px 0;
        border: 0;
        border-top: 1px solid #eee;
    }

    .newdesign-info-agent .newdesign-apart-adress {
        font-size: 0.9rem;
        color: #888;
        display: block;
        margin-bottom: 10px;
    }

    .newdesign-info-agent .newdesign-proj-owner {
        font-size: 0.9rem;
        color: #666;
    }

    .newdesign-info-agent .view-profile-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 10px;
        transition: background 0.3s ease;
    }

    .newdesign-info-agent .view-profile-btn:hover {
        background: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-header {
            height: 250px;
        }

        .profile-avatar {
            width: 150px;
            height: 180px;
            margin-right: 15px;
        }

        .profile-name-info h2 {
            font-size: 2rem;
        }

        .profile-name-info p {
            font-size: 0.9rem;
        }

        .hori-line {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hori-line p {
            text-align: center;
            margin: 5px 0;
        }

        .line {
            display: none;
        }

        .col-md-3,
        .col-md-6,
        .col-md-8,
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .stats-card {
            margin-bottom: 15px;
        }

        .services-section,
        .properties-section,
        .contact-section {
            padding: 30px 0;
        }

        .service-item,
        .property-card {
            margin-bottom: 15px;
        }

        .introduction {
            padding: 20px;
        }

        .contact-card,
        .feedback-form {
            padding: 20px;
        }

        .related-agents {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .profile-header {
            height: 300px;
        }

        .profile-avatar {
            width: 180px;
            height: 220px;
        }

        .profile-name-info h2 {
            font-size: 2.2rem;
        }

        .hori-line {
            width: 80%;
        }

        .col-md-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-8,
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .related-agents {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
    }

    .info-btn {
        flex: 1;
        min-width: 200px;
        background: #f3f7ff;
        border: 1px solid #d9e4ff;
        border-radius: 10px;
        padding: 12px 15px;
        text-align: center;
        font-size: 15px;
        color: #333;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    .info-btn:hover {
        background: #e7f0ff;
        transform: translateY(-2px);
    }

    @media(max-width: 768px) {
        .info-btn {
            flex: 100%;
        }
    }
</style>

<?php $__env->startSection('content'); ?>

    <section class="profile-section1" style="100%">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header mb-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="<?php echo e($business->logo ? asset('storage/' . $business->logo) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'); ?>"
                                alt="Logo" class="profile-avatar">

                        </div>
                        <div class="col-md-9">
                            <div class="profil-data">
                                <div class="profile-name-info">
                                    <h2 class="m-0">
                                        <?php echo e(optional($business->user)->firstname ?? ''); ?>

                                        <?php echo e(optional($business->user)->lastname ?? ''); ?>

                                    </h2>

                                    
                                    <?php if($business->badge_type == 'premium'): ?>
                                        <span class="premium-badge" style="margin-left:10px;">Premium</span>
                                    <?php elseif($business->badge_type == 'verified'): ?>
                                        <span class="verified-badge" style="margin-left:10px;">Verified</span>
                                    <?php endif; ?>

                                    <p class="m-0"><strong><?php echo e($business->business_name ?? ''); ?></strong></p>
                                    <p class="m-0">
                                        <?php echo e(isset($business->category->category_name) ? $business->category->category_name : ''); ?>

                                    </p>
                                </div>

                                <div class="hori-line">
                                    <p><strong>Registration Number</strong><br><?php echo e($business->registration_number ?? ''); ?>

                                    </p>
                                    <div class="line"></div>
                                    <p><strong>Operating Since</strong><br><?php echo e($business->established_year ?? ''); ?></p>
                                    <div class="line"></div>
                                    <p><strong>Membership</strong><br> <?php echo e($business->membership_type); ?></p>
                                </div>
                                <p class="m-0 mt-3"><strong>Deals in</strong><br><?php echo e($business->deals_in ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card1">
                        <div class="stat-number"><?php echo e($business->services->count()); ?></div>
                        <div class="stat-label">Services</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card2">
                        <div class="stat-number"><?php echo e($business->satisfied_clients ?? '0'); ?></div>
                        <div class="stat-label">Satisfied Clients</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card3">
                        <?php
                            $currentYear = date('Y');
                            $establishedYear = $business->established_year ?? $currentYear;
                            $experience = max(0, $currentYear - $establishedYear);
                        ?>
                        <div class="stat-number"><?php echo e($experience); ?> <?php echo e($experience === 1 ? 'Year' : 'Years'); ?></div>
                        <div class="stat-label">Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card4">
                        <div class="stat-number">
                            <?php echo e($business->rating ?? '0'); ?>

                            <i class="far fa-star" data-rating="5" style="font-size:30px;color:orange;"></i>
                        </div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <!-- Main Content -->
                <div class="col-md-8" style="padding-left:0px;">

                    <div class="services-section p-3">
                        <h3 class="mb-4">Services Offered</h3>
                        <div class="row">
                            <?php $__currentLoopData = $business->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6 mb-3">
                                    <div class="newdesign-project-main">
                                        <div class="newdesign-image-proj">
                                            <img src="<?php echo e($service->image ? asset('storage/' . $service->image) : 'https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;'); ?>"
                                                class="img-fluid" alt="<?php echo e($service->name); ?>">
                                            <span class="newdesign-verified-seal"> Starts <i class="fas fa-rupee-sign"
                                                    style="margin-top:5px;"></i><?php echo e(number_format($service->price, 2) ?? ''); ?>/-</span>
                                        </div>
                                        <div class="newdesign-info-proj">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="newdesign-proj-name"><?php echo e($service->name); ?></h4>
                                                <!--<span class="newdesign-proj-category">Villa</span>-->
                                            </div>
                                            <span
                                                class="newdesign-apart-name"><?php echo e(Str::limit($service->description, 100, '...')); ?></span>

                                            <div class="callback-section text-center my-4">
                                                <button class="btn btn-callback">
                                                    <i class="fas fa-phone-volume me-2"></i> Get a Callback
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($business->services->isEmpty()): ?>
                                <p class="text-muted">No services available.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="introduction">
                        <h3>Introduction <?php echo e($business->user->firstname ?? ''); ?> <?php echo e($business->user->lastname ?? ''); ?></h3>
                        <p>
                            <?php echo $business->introduction; ?>

                        </p>

                    </div>

                    <div class="portfolio-section p-3 ">
                        <h3 class="mb-4 fw-semibold">Portfolio</h3>
                        <div class="row g-3">
                            <?php $__empty_1 = true; $__currentLoopData = $business->portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="portfolio-card">
                                        <img src="<?php echo e($item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'); ?>"
                                            alt="<?php echo e($item->title); ?>" class="img-fluid rounded">
                                        <h5 class="portfolio-title mt-2"><?php echo e($item->title); ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted">No portfolio items available.</p>
                            <?php endif; ?>
                        </div>
                    </div>




                    <div class="contact-section p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <h4 class="mb-3">Contact Information</h4>
                                    <div class="mb-3">
                                        <div class="d-flex gap-2">
                                            <div style="white-space:nowrap;">
                                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                                <strong>Address:</strong>
                                            </div>
                                            <div><?php echo e($business->full_address ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <i class="fas fa-phone me-2 text-success"></i>
                                        <strong>Phone:</strong> <?php echo e($business->mobile_number ?? 'N/A'); ?>

                                    </div>
                                    <div class="mb-3">
                                        <i class="fas fa-envelope me-2 text-info"></i>
                                        <strong>Email:</strong>
                                        <?php if(!empty($business->email)): ?>
                                            <a href="mailto:<?php echo e($business->email); ?>"><?php echo e($business->email); ?></a>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </div>
                                    <hr>
                                    <div class="mb-4">
                                        <h5 class="mb-2">Working Hours</h5>
                                        <?php $__empty_1 = true; $__currentLoopData = $business->workingHours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="timing-item d-flex justify-content-between">
                                                <span><?php echo e($wh->day); ?></span>
                                                <span>
                                                    <?php if(!empty($wh->closed) && $wh->closed): ?>
                                                        Closed
                                                    <?php else: ?>
                                                        <?php echo e(\Carbon\Carbon::parse($wh->start)->format('g:i A')); ?> -
                                                        <?php echo e(\Carbon\Carbon::parse($wh->end)->format('g:i A')); ?>

                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div>No working hours available.</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="contact-now-section d-flex align-items-center my-4 p-3"
                                        style="background:#f8f9fa; gap:10px; border-radius:10px;">
                                        <h5 style="white-space:nowrap;">Connect
                                            <i class="fa-solid fa-hand-point-right" style="color:orange;"></i>
                                        </h5>
                                        <div class="row g-2" style="gap:15px; padding:0px 15px;">
                                            <?php if(!empty($business->mobile_number)): ?>
                                                <div class="icon-button">
                                                    <a href="tel:<?php echo e(preg_replace('/\s+/', '', $business->mobile_number)); ?>"
                                                        class="btn btn-success w-100">
                                                        <i class="fas fa-phone me-2"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty($business->whatsapp_number)): ?>
                                                <div class="icon-button">
                                                    <a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', $business->whatsapp_number)); ?>"
                                                        target="_blank" class="btn btn-success w-100"
                                                        style="background:#25D366; border-color:#25D366;">
                                                        <i class="fab fa-whatsapp me-2"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty($business->email)): ?>
                                                <div class="icon-button">
                                                    <a href="mailto:<?php echo e($business->email); ?>"
                                                        class="btn btn-outline-primary w-100">
                                                        <i class="fas fa-envelope me-2"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="feedback-form">
                                    <h4 class="mb-4">Leave a Review</h4>

                                    <?php
                                        $authUser = Auth::user();
                                    ?>

                                    <form id="reviewForm">
                                        <?php echo csrf_field(); ?>

                                        
                                        <div class="mb-3">
                                            <div class="star-rating mb-2">
                                                <i class="far fa-star" data-rating="1"
                                                    style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="2"
                                                    style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="3"
                                                    style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="4"
                                                    style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="5"
                                                    style="font-size:30px;color:orange;"></i>
                                            </div>
                                            <input type="hidden" name="rating" id="rating">
                                        </div>

                                        <input type="hidden" name="business_listing_id" id="business_listing_id"
                                            value="<?php echo e($business->id); ?>">
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter your name"
                                                value="<?php echo e($authUser->firstname ?? ''); ?> <?php echo e($authUser->lastname ?? ''); ?>" <?php echo e($authUser ? 'readonly' : ''); ?>>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter your email" value="<?php echo e($authUser->email ?? ''); ?>" <?php echo e($authUser ? 'readonly' : ''); ?>>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Enter your phone" value="<?php echo e($authUser->mobile_number ?? ''); ?>"
                                                <?php echo e($authUser ? 'readonly' : ''); ?>>
                                        </div>

                                        
                                        <?php if(auth()->guard()->guest()): ?>
                                            <div id="otpSection" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter OTP</label>
                                                    <input type="text" id="otpInput" class="form-control"
                                                        placeholder="Enter OTP">
                                                </div>
                                                <button type="button" id="verifyOtpBtn"
                                                    class="btn btn-success w-100 mb-2">Verify OTP</button>
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-3">
                                            <label class="form-label">Your Review</label>
                                            <textarea class="form-control" name="review" rows="4"
                                                placeholder="Share your experience..."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100" id="submitReviewBtn">
                                            Submit Review
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Related Agents/Builders Sidebar -->
                <div class="col-md-4" style="padding-right:0px;">
                    <div class="related-agents">
                        <h4 class="mb-4">Other Service Providers</h4>
                        <?php $__empty_1 = true; $__currentLoopData = $relatedProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="agent-card mb-3 border">
                                <div class="newdesign-image-agent">
                                    <img src="<?php echo e($provider->banner_image ? asset('storage/' . $provider->banner_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'); ?>"
                                        alt="Agent" class="agent-avatar">
                                    
                                    
                                    <?php if($business->badge_type == 'premium'): ?>
                                       <span class="newdesign-verified-seal">
                                        <i class="fas fa-check-circle"></i> Premium
                                    </span>
                                    <?php elseif($business->badge_type == 'verified'): ?>
                                        <span class="newdesign-verified-seal">
                                        <i class="fas fa-check-circle"></i> Verified
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="newdesign-info-agent">
                                    <div class="d-flex flex-column">
                                        <h4 class="newdesign-proj-name"> <?php echo e(optional($provider->user)->firstname ?? ''); ?>

                                            <?php echo e(optional($provider->user)->lastname ?? ''); ?>

                                        </h4>
                                        <span
                                            class="newdesign-proj-category"><?php echo e(isset($provider->category->category_name) ? $provider->category->category_name : ''); ?></span>
                                    </div>
                                    <span
                                        class="newdesign-apart-name"><?php echo e(\Illuminate\Support\Str::limit($provider->detail ?? '', 100, '...')); ?></span>
                                    <hr>
                                    <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i>
                                        <?php echo e($provider->city ?? ''); ?>, <?php echo e($provider->state ?? ''); ?></span>
                                    <div class="d-flex justify-content-between">
                                        <span class="newdesign-proj-owner"><strong>Operating
                                                Since:</strong><br><?php echo e($provider->established_year ?? ''); ?></span>
                                        <span
                                            class="newdesign-proj-owner"><strong>Member:</strong><br><?php echo e($provider->membership_type ?? ''); ?></span>
                                    </div>
                                    <a href="<?php echo e(route('business.details', $provider->id)); ?>" class="view-profile-btn">View
                                        Profile</a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>No other service providers found.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            let isOtpVerified = <?php echo e(Auth::check() ? 'true' : 'false'); ?>;

            // ⭐ Star Rating Selection
            $('.star-rating i[data-rating]').click(function () {
                let rating = $(this).data('rating');
                $('#rating').val(rating);
                $('.star-rating i[data-rating]').removeClass('fas fa-star').addClass('far fa-star');
                for (let i = 1; i <= rating; i++) {
                    $('.star-rating i[data-rating="' + i + '"]').removeClass('far fa-star').addClass('fas fa-star');
                }
            });

            /// 🔹 Send OTP for Guest Users
            $('#reviewForm input[name="phone"]').on('blur', function () {
                if (!isOtpVerified && $(this).val().length >= 10) {
                    $.ajax({
                        url: '<?php echo e(route("send.review.otp")); ?>',
                        type: 'POST',
                        data: {
                            phone: $(this).val(),
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function (res) {
                            if (res.success) {
                                $('#otpSection').show();
                                swal("OTP Sent!", "We’ve sent an OTP to your phone.", "success");
                            } else {
                                swal("Error", res.message || "Failed to send OTP.", "error");
                            }
                        },
                        error: function () {
                            swal("Error", "Something went wrong while sending OTP.", "error");
                        }
                    });
                }
            });

            // 🔹 Verify OTP
            $('#verifyOtpBtn').click(function () {
                $.ajax({
                    url: '<?php echo e(route("verify.review.otp")); ?>',
                    type: 'POST',
                    data: {
                        phone: $('#reviewForm input[name="phone"]').val(),
                        otp: $('#otpInput').val(),
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function (res) {
                        if (res.success) {
                            isOtpVerified = true;
                            $('#otpSection').hide();
                            swal("Verified!", "OTP verified successfully.", "success");
                        } else {
                            swal("Invalid OTP", "Please check the OTP and try again.", "error");
                        }
                    },
                    error: function () {
                        swal("Error", "Unable to verify OTP.", "error");
                    }
                });
            });

            // 🔹 Submit Review
            $('#reviewForm').submit(function (e) {
                e.preventDefault();

                if (!isOtpVerified) {
                    swal("Verify OTP", "Please verify your OTP before submitting.", "warning");
                    return;
                }

                $.ajax({
                    url: '<?php echo e(route("business.submit.review")); ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (res) {
                        if (res.success) {
                            swal("Thank You!", "Your review has been submitted successfully.", "success");
                            $('#reviewForm')[0].reset();
                            $('.star-rating i').removeClass('fas').addClass('far');
                        } else {
                            swal("Error", res.message || "Failed to submit review.", "error");
                        }
                    },
                    error: function () {
                        swal("Error", "Something went wrong while submitting your review.", "error");
                    }
                });
            });

        });
    </script>

    <script>
        // Star rating click handler
        document.querySelectorAll('.star-rating .fa-star').forEach(star => {
            star.addEventListener('click', function () {
                const ratingValue = this.getAttribute('data-rating');
                document.getElementById('rating').value = ratingValue;

                // Reset stars
                document.querySelectorAll('.star-rating .fa-star').forEach(s => s.classList.remove('fas'));
                document.querySelectorAll('.star-rating .fa-star').forEach(s => s.classList.add('far'));

                // Highlight selected stars
                for (let i = 1; i <= ratingValue; i++) {
                    const starToFill = document.querySelector(`.star-rating .fa-star[data-rating='${i}']`);
                    starToFill.classList.remove('far');
                    starToFill.classList.add('fas');
                }
            });
        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/business-details.blade.php ENDPATH**/ ?>