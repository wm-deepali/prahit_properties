@extends('layouts.front.app')
@section('title')
	<title>Blogs</title>
@endsection

@section('content')
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Blog</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
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
								<div class="blog-main">
									<div class="blog-img">
										<img src="{{ asset('storage') }}/{{ $feature->image }}" class="img-fluid">
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
						<div class="col-md-3">
							<div class="blog-main mb-5">
								<div class="blog-img">
									<img src="{{ asset('storage') }}/{{ $blog->image }}" class="img-fluid">
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
@endsection