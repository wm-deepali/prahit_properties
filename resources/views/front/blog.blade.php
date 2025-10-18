
@extends('layouts.front.app')

@section('title')
    <title>Blogs</title>
@endsection

@section('content')
    <style>
        /* Custom Blog Styling */
        .breadcrumb-section {
            background: #f5f7fa;
            padding: 20px 0;
        }

        .blog-page {
            padding: 60px 0;
            background: #fff;
        }

        .blog-section-title {
            /*text-align: center;*/
            margin-bottom: 40px;
        }

        .blog-section-title h2 {
            font-size: 2.2rem;
            color: #1a3c34;
            
            font-weight: 700;
            position: relative;
            margin-bottom: 15px;
        }

        .blog-section-title h2::after {
            content: '';
            width: 50px;
            height: 3px;
            background: #007bff;
            position: absolute;
            bottom: -5px;
            left: 2%;
            transform: translateX(-50%);
        }

        .blog-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }

        .blog-card:hover {
            transform: translateY(-5px);
        }

        .blog-img img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-cat {
            display:flex ;
            justify-content:space-between;
            padding: 12px 10px;
            background: #f8f9fa;
            font-size: 0.75rem;
           
        }

        .blog-cat span {
            margin-right: 15px;
            color: #555;
        }

        .blog-cat i {
            margin-right: 5px;
        }

        .blog-heading {
            padding: 15px;
          
        }
        .blog-heading h1 {
            font-size: 1.3rem;
            color: #1a3c34;
            text-decoration: none;
            font-weight: 600;
            line-height: 25px;
        }

        .blog-heading h1 a {
            font-size: 1.3rem;
            color: #1a3c34;
            text-decoration: none;
            font-weight: 600;
            line-height: 10px;
        }

        .blog-heading h1 a:hover {
            color: #007bff;
        }

        .blog-heading p {
            font-size: 0.95rem;
            color: #666;
            margin-top: 10px;
            line-height: 1.6;
        }

        .featured-blog .blog-card {
            margin: 0 15px;
        }

        .owl-carousel .owl-nav {
            display: block;
        }

        .owl-carousel .owl-nav button {
            background: #007bff !important;
            color: #fff !important;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin: 0 10px;
        }

        .owl-carousel .owl-nav button:hover {
            background: #0056b3 !important;
        }
       
    </style>

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Blog</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page">
        <div class="blog-featured">
            <div class="container">
                @if(count($featured) > 0)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-section-title">
                                <h2>Featured Posts</h2>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="owl-carousel featured-blog">
                                @foreach($featured as $feature)
                                    <div class="blog-card">
                                        <div class="blog-img">
                                            <img alt="{{ $feature->image_alt }}" src="{{ asset('storage') }}/{{ $feature->image }}" class="img-fluid">
                                        </div>
                                        <div class="blog-cat">
                                            <span>{{ $feature->getBlogCategory->name }}</span>
                                            <span><i class="fas fa-clock"></i> {{ date('d M Y', strtotime($feature->created_at)) }}</span>
                                        </div>
                                        <div class="blog-heading">
                                            <h1><a href="{{ route('front.blogDetail', $feature->id) }}">{{ $feature->heading }}</a></h1>
                                            <p>{!! \Illuminate\Support\Str::limit($feature->description, 100, '...') !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @foreach($blog_categories as $blog_category)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-section-title">
                                <h2>{{ $blog_category->name }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($blog_category->getRelatedBlogs as $blog)
                            <div class="col-md-3 col-sm-6">
                                <div class="blog-card">
                                    <div class="blog-img">
                                       									<img alt="{{ $blog->image_alt }}" src="{{ asset('storage') }}/{{ $blog->image }}" class="img-fluid">
                                    </div>
                                    <div class="blog-cat">
                                        <span>{{ $blog->getBlogCategory->name }}</span>
                                        <span><i class="fas fa-clock"></i> {{ date('d M Y', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <div class="blog-heading">
                                        <h1><a href="{{ route('front.blogDetail', $blog->id) }}">{{ $blog->heading }}</a></h1>
                                        <p>{!! \Illuminate\Support\Str::limit($blog->description, 100, '...') !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.featured-blog').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            });
        });
    </script>
@endsection
