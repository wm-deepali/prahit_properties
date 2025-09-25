@extends('layouts.front.app')
@section('title')
	<title>Blog Detail</title>
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
						<li class="breadcrumb-item active" aria-current="page">Blog Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="blog-detail-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="blog-main">
					<div class="blog-heading">
						<h1><a href="">{{ $blog_detail->heading }}</a></h1>
						<div class="blog-cat">
							<span>{{ $blog_detail->getBlogCategory->name }}</span>
							<span><i class="fas fa-clock"></i> {{ date('d M Y', strtotime($blog_detail->created_at)) }}</span>
						</div>
						<div class="blog-img">
							<img src="{{ asset('storage') }}/{{ $blog_detail->image }}" class="img-fluid">
						</div>

						<div class="blog-content">
							<p>{!! $blog_detail->description !!}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="blog-sidebar">
					<div class="blog-sidebar-widgets">
						<div class="blog-detail-wrap">
							<div class="blog-detail-wrap-header">
								<h4>Related Blogs</h4>
							</div>
							<div class="blog-detail-wrap-body">
								<ul class="blog-post">
									@foreach($related_blogs as $n_blog)
										<li>
											<div class="blog-li">
												<div class="blog-img"><a href="blog-detail.php"><img alt="" src="{{ asset('storage') }}/{{ $n_blog->image }}" class="img-fluid"></a>
												</div>
												<div class="blog-cont">
													<h6><a href="{{ route('front.blogDetail', $n_blog->id) }}">{{ $n_blog->heading }}</a></h6>
													<p>{!! \Illuminate\Support\Str::limit($n_blog->description, 100, '...') !!}</p>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
@endsection