@extends('layouts.front.app')

@section('title')
<title>Testimonials</title>
@endsection
@section('content')

<section class="breadcrumb-section"> 
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Testimonials</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Testimonials</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="testimonial-section-page">
	<div class="testimonial-one-part">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<div class="testi-con">
						{!! $picked->heading !!}
						<p>{!! $picked->description !!}</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testi-img">
						<img src="{{ asset('storage') }}/{{ $picked->images }}" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="testimonial-two-part">
		<div class="container">
			<div class="row">
				@foreach($testimonials as $testimonial)
					<div class="col-md-4">
						<article class="quote-modern">
							<div class="quote-modern-inner">
								<time class="quote-modern-time" datetime="2020">March 15, 2020</time>
								<div class="quote-modern-main">
									<p>{{ $testimonial->description }}</p>
								</div>
								<div class="quote-modern-meta-outer"><img class="quote-modern-avatar" src="{{ asset('storage') }}/{{ $testimonial->image }}" alt="" width="57" height="57">
									<div class="quote-modern-meta">
										<h4 class="quote-modern-cite">{{ $testimonial->name }}</h4>
										<p class="quote-modern-position">{{ $testimonial->designation }}</p>
									</div>
								</div>
							</div>
						</article>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

@endsection
@section('js')
@endsection