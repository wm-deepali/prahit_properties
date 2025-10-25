
@extends('layouts.front.app')

@section('title')
    <title>Profile</title>
@endsection

@section('content')
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

        .card1 { background: linear-gradient(135deg, #fbf4f5 0%, #fff5f2 100%); }
        .card2 { background: linear-gradient(135deg, #e6efff 0%, #edf4f7 100%); }
        .card3 { background: linear-gradient(135deg, #e4f1e4 0%, #d7e9d7 100%); }
        .card4 { background: linear-gradient(135deg, #fffafa 0%, #f7e4bc 100%); }

        .services-section, .properties-section, .contact-section {
            padding: 50px 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .service-item, .property-card {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .service-item:hover, .property-card:hover {
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

        .contact-card, .feedback-form {
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

            .col-md-3, .col-md-6, .col-md-8, .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .stats-card {
                margin-bottom: 15px;
            }

            .services-section, .properties-section, .contact-section {
                padding: 30px 0;
            }

            .service-item, .property-card {
                margin-bottom: 15px;
            }

            .introduction {
                padding: 20px;
            }

            .contact-card, .feedback-form {
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

            .col-md-8, .col-md-4 {
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
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    margin-right:10px;
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

    <section class="profile-section1" style="100%">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header mb-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Profile" class="profile-avatar">
                        </div>
                        <div class="col-md-9">
                            <div class="profil-data">
                                <div class="profile-name-info">
                                    <h2 class="m-0">Raju Kumar</h2>
                                    <p class="m-0"><strong>Gupta Properties</strong></p>
                                    <p class="m-0">Business Categories</p>
                                </div>
                                
                                <div class="hori-line">
                                    <p><strong>Registration Number</strong><br>23456789</p>
                                    <div class="line"></div>
                                    <p><strong>Operating Since</strong><br>2024</p>
                                    <div class="line"></div>
                                    <p><strong>Membership</strong><br> Free</p>
                                </div>
                                <p class="m-0 mt-3"><strong>Deals in</strong><br>Rent/Lease , Pre-launch , Original Booking , Resale , Others</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card1">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Services</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card2">
                        <div class="stat-number">85</div>
                        <div class="stat-label">Satisfied Clients</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card3">
                        <div class="stat-number">65</div>
                        <div class="stat-label">Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card card4">
                        <div class="stat-number">4.9 <i class="far fa-star" data-rating="5" style="font-size:30px;color:orange;"></i></div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Main Content -->
                <div class="col-md-8" style="padding-left:0px;">
                    <div class="introduction">
                        <h3>About John Doe</h3>
                        <p>
                            With over a decade of experience in the real estate industry, John Doe has established himself as a trusted name in property consulting. Specializing in both residential and commercial properties, he has successfully closed over 500 deals and helped countless families find their dream homes.
                        </p>
                        <p>
                            John believes in transparency, integrity, and personalized service. His deep understanding of market trends and negotiation skills ensure the best deals for his clients. Whether you're buying, selling, or investing, John and his team at Doe Realty Solutions are committed to making your real estate journey seamless and rewarding.
                        </p>
                    </div>
                    <div class="services-section p-3">
                        <h3 class="mb-4">Services Offered</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="service-item">
                                    <h5>Residential Properties</h5>
                                    <p>Apartments, Villas, Independent Houses</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="service-item">
                                    <h5>Commercial Properties</h5>
                                    <p>Offices, Shops, Warehouses</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="service-item">
                                    <h5>Property Valuation</h5>
                                    <p>Free market value assessment</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="service-item">
                                    <h5>Legal Assistance</h5>
                                    <p>Documentation & RERA compliance</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="properties-section p-3">
                        <h3 class="mb-4">Featured Properties</h3>
                        <div class="row">
                            <!-- Property Card 1 -->
                            <div class="col-lg-6 mb-3">
                                <div class="newdesign-project-main">
                                    <div class="newdesign-image-proj">
                                        <img src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;" class="img-fluid" alt="Property 1">
                                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                                    </div>
                                    <div class="newdesign-info-proj">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="newdesign-proj-name">West Center Meridian Courts</h4>
                                            <span class="newdesign-proj-category">Villa</span>
                                        </div>
                                        <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in the heart of Kandivali....</span>
                                        <hr>
                                        <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra West</span>
                                        <div class="newdesign-proj-price">
                                            <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                                            <span class="newdesign-proj-owner"><strong>Posted:</strong><br> 10 Oct 2027.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Property Card 2 -->
                            <div class="col-lg-6 mb-3">
                                <div class="newdesign-project-main">
                                    <div class="newdesign-image-proj">
                                        <img src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;" class="img-fluid" alt="Property 2">
                                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                                    </div>
                                    <div class="newdesign-info-proj">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="newdesign-proj-name">Origin Rock Highland</h4>
                                            <span class="newdesign-proj-category">Apartment</span>
                                        </div>
                                        <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in the heart of Kandivali....</span>
                                        <hr>
                                        <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra West</span>
                                        <div class="newdesign-proj-price">
                                            <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                                            <span class="newdesign-proj-owner"><strong>Publish:</strong><br> 10 Oct 2027.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Property Card 3 -->
                            <div class="col-lg-6 mb-3">
                                <div class="newdesign-project-main">
                                    <div class="newdesign-image-proj">
                                        <img src="https://static.squareyards.com/resources/images/mumbai/project-image/west-center-meridian-courts-project-project-large-image1-6167.jpg?aio=w-578;h-316;crop;" class="img-fluid" alt="Property 3">
                                        <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                                    </div>
                                    <div class="newdesign-info-proj">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="newdesign-proj-name">Greenfield Estate</h4>
                                            <span class="newdesign-proj-category">Apartment</span>
                                        </div>
                                        <span class="newdesign-apart-name">Presenting West Center Meridian Courts, a residential property located in the heart of Kandivali....</span>
                                        <hr>
                                        <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra, Bandra West</span>
                                        <div class="newdesign-proj-price">
                                            <span><i class="fas fa-rupee-sign"></i>2.5 Cr - 4.8 Cr</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="newdesign-proj-owner"><strong>Builder:</strong><br> Green Homes Ltd.</span>
                                            <span class="newdesign-proj-owner"><strong>Publish:</strong><br> 10 Oct 2027.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-section p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-card">
                                    <h4 class="mb-3">Contact Information</h4>
                                    <div class="mb-3">
                                        <div class="d-flex gap-2" >
                                            <div style="white-space:nowrap;">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        <strong>Address:</strong> 
                                        </div>
                                        
                                        
                                        <div>123 Business Park, Sector 18, Noida - 201301</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <i class="fas fa-phone me-2 text-success"></i>
                                        <strong>Phone:</strong> +91 98765 43210
                                    </div>
                                    <div class="mb-3">
                                        <i class="fas fa-envelope me-2 text-info"></i>
                                        <strong>Email:</strong> john@doerealtysolutions.com
                                    </div>
                                    <hr>
                                    <div class="mb-4">
                                        <h5 class="mb-2">Working Hours</h5>
                                        <div class="timing-item">
                                            <span>Monday - Friday</span>
                                            <span>9:00 AM - 7:00 PM</span>
                                        </div>
                                        <div class="timing-item">
                                            <span>Saturday</span>
                                            <span>10:00 AM - 5:00 PM</span>
                                        </div>
                                        <div class="timing-item">
                                            <span>Sunday</span>
                                            <span>Closed</span>
                                        </div>
                                    </div>
                                   <div class="contact-now-section d-flex align-items-center my-4 p-3" style="background:#f8f9fa; gap:10px; border-radius:10px;">
  <h5 class="" style="white-space:nowrap;">Connect <i class="fa-solid fa-hand-point-right" style="color:orange;"></i> </h5>
  <div class="row g-2" style="gap:15px;padding:0px 15px;">
    <div class="icon-button">
      <a href="tel:+919451591515" class="btn btn-success w-100">
        <i class="fas fa-phone me-2"></i>
      </a>
    </div>
    <div class="icon-button">
      <a href="https://wa.me/919451591515" target="_blank" class="btn btn-success w-100" style="background:#25D366; border-color:#25D366;">
        <i class="fab fa-whatsapp me-2"></i>
      </a>
    </div>
    <div class="icon-button">
      <a href="mailto:example@email.com" class="btn btn-outline-primary w-100">
        <i class="fas fa-envelope me-2"></i>
      </a>
    </div>
  </div>
</div>



                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="feedback-form">
                                    <h4 class="mb-4">Leave a Review</h4>
                                    <form>
                                        <div class="mb-3">
                                            <!--<label class="form-label">Rating</label>-->
                                            <div class="star-rating mb-2">
                                                <i class="far fa-star" data-rating="1" style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="2" style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="3" style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="4" style="font-size:30px;color:orange;"></i>
                                                <i class="far fa-star" data-rating="5" style="font-size:30px;color:orange;"></i>
                                            </div>
                                            <input type="hidden" name="rating" id="rating">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Your Name</label>
                                            <input type="text" class="form-control" placeholder="Enter your name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter your email">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Your Review</label>
                                            <textarea class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Agents/Builders Sidebar -->
                <div class="col-md-4" style="padding-right:0px;">
                    <div class="related-agents">
                        <h4 class="mb-4">Other Experts</h4>
                        <div class="agent-card mb-3 border">
                            <div class="newdesign-image-agent">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Agent" class="agent-avatar">
                                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                            <div class="newdesign-info-agent">
                                <div class="d-flex justify-content-between">
                                    <h4 class="newdesign-proj-name">Sarah Wilson</h4>
                                    <span class="newdesign-proj-category">Agent</span>
                                </div>
                                <span class="newdesign-apart-name">Specializes in residential properties and market analysis.</span>
                                <hr>
                                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Mumbai, Maharashtra</span>
                                <div class="d-flex justify-content-between">
                                    <span class="newdesign-proj-owner"><strong>Company:</strong><br>Wilson Properties</span>
                                    <span class="newdesign-proj-owner"><strong>Rating:</strong><br>4.9 (89 reviews)</span>
                                </div>
                                <a href="#" class="view-profile-btn">View Profile</a>
                            </div>
                        </div>
                        <div class="agent-card mb-3 border">
                            <div class="newdesign-image-agent">
                                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Agent" class="agent-avatar">
                                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                            <div class="newdesign-info-agent">
                                <div class="d-flex justify-content-between">
                                    <h4 class="newdesign-proj-name">Mike Chen</h4>
                                    <span class="newdesign-proj-category">Agent</span>
                                </div>
                                <span class="newdesign-apart-name">Expert in commercial real estate and leasing.</span>
                                <hr>
                                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Delhi, India</span>
                                <div class="d-flex justify-content-between">
                                    <span class="newdesign-proj-owner"><strong>Company:</strong><br>Chen Realty Group</span>
                                    <span class="newdesign-proj-owner"><strong>Rating:</strong><br>4.6 (156 reviews)</span>
                                </div>
                                <a href="#" class="view-profile-btn">View Profile</a>
                            </div>
                        </div>
                        <div class="agent-card mb-3 border">
                            <div class="newdesign-image-agent">
                                <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Agent" class="agent-avatar">
                                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                            <div class="newdesign-info-agent">
                                <div class="d-flex justify-content-between">
                                    <h4 class="newdesign-proj-name">Priya Sharma</h4>
                                    <span class="newdesign-proj-category">Agent</span>
                                </div>
                                <span class="newdesign-apart-name">Focuses on luxury properties and investments.</span>
                                <hr>
                                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Bangalore, Karnataka</span>
                                <div class="d-flex justify-content-between">
                                    <span class="newdesign-proj-owner"><strong>Company:</strong><br>Sharma Builders</span>
                                    <span class="newdesign-proj-owner"><strong>Rating:</strong><br>4.8 (234 reviews)</span>
                                </div>
                                <a href="#" class="view-profile-btn">View Profile</a>
                            </div>
                        </div>
                        <div class="agent-card mb-3 border">
                            <div class="newdesign-image-agent">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Agent" class="agent-avatar">
                                <span class="newdesign-verified-seal"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                            <div class="newdesign-info-agent">
                                <div class="d-flex justify-content-between">
                                    <h4 class="newdesign-proj-name">David Patel</h4>
                                    <span class="newdesign-proj-category">Agent</span>
                                </div>
                                <span class="newdesign-apart-name">Specializes in residential sales and rentals.</span>
                                <hr>
                                <span class="newdesign-apart-adress"><i class="fa-solid fa-location-dot"></i> Pune, Maharashtra</span>
                                <div class="d-flex justify-content-between">
                                    <span class="newdesign-proj-owner"><strong>Company:</strong><br>Patel Realty</span>
                                    <span class="newdesign-proj-owner"><strong>Rating:</strong><br>5.0 (67 reviews)</span>
                                </div>
                                <a href="#" class="view-profile-btn">View Profile</a>
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

            // Favorite button hover effect
            $('.property-favorite').hover(
                function() { $(this).css('background', '#cc0000'); },
                function() { $(this).css('background', '#ff4444'); }
            );
        });
    </script>
    
@endsection
