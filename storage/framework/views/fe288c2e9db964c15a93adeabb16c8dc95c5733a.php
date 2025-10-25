


<?php $__env->startSection('title'); ?>
    <title>Business Listing Detail</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .listing-section {
            background: linear-gradient(to bottom, #f8f9fa 0%, #e3e9ef 100%);
            padding: 80px 0;
            position: relative;
        }

        .listing-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .listing-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 50px;
            position: relative;
            z-index: 1;
        }

        .listing-logo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            border: 5px solid #007bff;
            transition: transform 0.3s ease;
        }

        .listing-logo:hover {
            transform: scale(1.05);
        }

        .listing-info h1 {
            font-size: 2.8rem;
            font-family: 'Arial', sans-serif;
            font-weight: 800;
            margin-bottom: 15px;
            color: #1a3c34;
        }

        .listing-info .badge {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            margin-right: 15px;
            font-size: 1rem;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
        }

        .listing-content {
            padding: 50px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .listing-content h3 {
            font-size: 2rem;
            margin-bottom: 25px;
            font-family: 'Arial', sans-serif;
            color: #1a3c34;
            position: relative;
        }

        .listing-content h3::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #007bff;
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .listing-content p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
            font-family: 'Georgia', serif;
        }

        .contact-details {
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .contact-details .detail-item {
            margin-bottom: 20px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .contact-details .detail-item i {
            margin-right: 15px;
            color: #007bff;
            font-size: 1.3rem;
        }

        .services-section {
            padding: 50px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .service-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .service-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .service-card:hover img {
            transform: scale(1.05);
        }

        .service-card h5 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            font-family: 'Arial', sans-serif;
            color: #1a3c34;
        }

        .service-card .meta {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 15px;
        }

        .service-card .description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
            line-height: 1.5;
        }

        .service-card .price {
            font-size: 1.2rem;
            color: #28a745;
            font-weight: bold;
        }

        .feedback-form {
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 1;
        }

        .related-providers {
            position: sticky;
            top: 20px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .provider-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .provider-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .provider-avatar {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .provider-info {
            padding: 20px;
        }

        .provider-info h6 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-family: 'Arial', sans-serif;
            color: #1a3c34;
        }

        .provider-info p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 15px;
        }

        .star-rating {
            color: #ffc107;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .view-profile-btn {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .view-profile-btn:hover {
            transform: scale(1.05);
        }
        .related-providers .related-card{
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            gap:20px;
        }
    </style>

    <section class="listing-section">
        <div class="container">
            <div class="listing-header">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Logo" class="listing-logo">
                    </div>
                    <div class="col-md-10">
                        <div class="listing-info">
                            <h1>Premier Real Estate Group</h1>
                            <div class="mb-3">
                                <span class="badge">Reg No: RERA-12345</span>
                                <span class="badge">Est: 2005</span>
                                <span class="badge">Member Since: 2010</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listing-content">
                <h3>Introduction</h3>
                <p>
                    Premier Real Estate Group is a leading property management and brokerage firm specializing in residential and commercial real estate. With a focus on client satisfaction and market expertise, we offer comprehensive solutions for buying, selling, renting, and managing properties in urban and suburban areas.
                </p>
            </div>

            <div class="listing-content">
                <h3>Details</h3>
                <p>
                    Our services include property valuation, legal documentation, market analysis, and personalized consulting. We handle everything from luxury villas to commercial spaces, ensuring seamless transactions and high returns on investment. Our team of certified agents uses the latest technology for virtual tours, market predictions, and efficient property matching.
                </p>
            </div>

            <div class="contact-details">
                <h3>Contact Information</h3>
                <div class="detail-item"><i class="fas fa-map-marker-alt"></i> Address: 789 Property Plaza, Sector 62, Noida - 201309</div>
                <div class="detail-item"><i class="fas fa-envelope"></i> Email: info@premierrealestate.com</div>
                <div class="detail-item"><i class="fas fa-phone"></i> Contact: +91 98765 43210</div>
                <div class="detail-item"><i class="fas fa-globe"></i> Country: India</div>
                <div class="detail-item"><i class="fas fa-map"></i> State: Uttar Pradesh</div>
                <div class="detail-item"><i class="fas fa-city"></i> City: Noida</div>
                <div class="detail-item"><i class="fas fa-map-pin"></i> Pin Code: 201309</div>
                <div class="detail-item">
                    <i class="fas fa-clock"></i> Office Hours: Mon-Fri 9:00 AM - 6:00 PM, Sat 10:00 AM - 4:00 PM, Sun Closed
                </div>
            </div>

            <div class="services-section">
                <h3>Property Services</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="service-card">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Service" class="img-fluid">
                            <h5>Property Buying Consultation</h5>
                            <p class="meta"><i class="fas fa-home"></i> Type: Residential | <i class="fas fa-map-marker-alt"></i> Location: Noida</p>
                            <p class="meta"><i class="fas fa-ruler-combined"></i> Size: 1,500-2,500 sq.ft.</p>
                            <p class="meta"><i class="fas fa-check"></i> Availability: Immediate</p>
                            <p class="description">Expert guidance for purchasing homes, including market analysis, site visits, and negotiation support.</p>
                            <p class="price">Starting at ₹10,000</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-card">
                            <img src="https://images.unsplash.com/photo-1582268611958-ebfd67b19b79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Service" class="img-fluid">
                            <h5>Rental Management</h5>
                            <p class="meta"><i class="fas fa-building"></i> Type: Commercial | <i class="fas fa-map-marker-alt"></i> Location: Gurgaon</p>
                            <p class="meta"><i class="fas fa-ruler-combined"></i> Size: 1,000-2,000 sq.ft.</p>
                            <p class="meta"><i class="fas fa-check"></i> Availability: Available Now</p>
                            <p class="description">Comprehensive rental services including tenant screening, lease agreements, and maintenance oversight.</p>
                            <p class="price">Starting at ₹5,000/month</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-card">
                            <img src="https://images.unsplash.com/photo-1576941089067-2de3c901e126?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Service" class="img-fluid">
                            <h5>Property Valuation</h5>
                            <p class="meta"><i class="fas fa-home"></i> Type: Residential/Commercial | <i class="fas fa-map-marker-alt"></i> Location: Pune</p>
                            <p class="meta"><i class="fas fa-ruler-combined"></i> Size: Varies</p>
                            <p class="meta"><i class="fas fa-check"></i> Availability: On Request</p>
                            <p class="description">Accurate valuation services using advanced tools to determine market value for selling or insurance.</p>
                            <p class="price">Starting at ₹15,000</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-card">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Service" class="img-fluid">
                            <h5>Commercial Leasing</h5>
                            <p class="meta"><i class="fas fa-building"></i> Type: Office Space | <i class="fas fa-map-marker-alt"></i> Location: Bangalore</p>
                            <p class="meta"><i class="fas fa-ruler-combined"></i> Size: 2,500-5,000 sq.ft.</p>
                            <p class="meta"><i class="fas fa-check"></i> Availability: Under Negotiation</p>
                            <p class="description">Tailored leasing solutions for commercial properties with legal and financial support.</p>
                            <p class="price">Starting at ₹20,000</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="feedback-form">
                            <h3>Leave a Review</h3>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="star-rating mb-2">
                                        <i class="far fa-star" data-rating="1"></i>
                                        <i class="far fa-star" data-rating="2"></i>
                                        <i class="far fa-star" data-rating="3"></i>
                                        <i class="far fa-star" data-rating="4"></i>
                                        <i class="far fa-star" data-rating="5"></i>
                                    </div>
                                    <input type="hidden" name="rating" id="rating">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Your Review</label>
                                    <textarea class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit Review</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="related-providers">
                            <h4>Other Service Providers</h4>
                            <div class="related-card">
                            <div class="card provider-card  mb-3">
                                <img src="https://images.unsplash.com/photo-1504639724207-75b7b0d8af33?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Provider" class="provider-avatar">
                                <div class="card-body provider-info">
                                    <h6>Elite Properties Inc</h6>
                                    <p>Residential & Commercial Real Estate</p>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <small>4.5 (120 reviews)</small>
                                    <a href="#" class="view-profile-btn btn w-100 mt-3">View Profile</a>
                                </div>
                            </div>
                            <div class="card provider-card  mb-3">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Provider" class="provider-avatar">
                                <div class="card-body provider-info">
                                    <h6>Urban Homes Realty</h6>
                                    <p>Property Management & Sales</p>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <small>4.2 (85 reviews)</small>
                                    <a href="#" class="view-profile-btn btn w-100 mt-3">View Profile</a>
                                </div>
                            </div>
                            <div class="card provider-card  mb-3">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Provider" class="provider-avatar">
                                <div class="card-body provider-info">
                                    <h6>Luxury Estates Ltd</h6>
                                    <p>High-End Property Consulting</p>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <small>5.0 (200 reviews)</small>
                                    <a href="#" class="view-profile-btn btn w-100 mt-3">View Profile</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Star rating functionality
            $('.star-rating i[data-rating]').click(function() {
                var rating = $(this).data('rating');
                $('#rating').val(rating);
                
                $('.star-rating i[data-rating]').removeClass('fas fa-star').addClass('far fa-star');
                for(var i = 1; i <= rating; i++) {
                    $('.star-rating i[data-rating="' + i + '"]').removeClass('far fa-star').addClass('fas fa-star');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/business-details.blade.php ENDPATH**/ ?>