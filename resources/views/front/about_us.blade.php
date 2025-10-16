@extends('layouts.front.app')
@section('title')
	<title>Welcome</title>
@endsection

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>About Us</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">About Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
 
<section class="about-us-page">
	<div class="container">
		<div class="about-one-part">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="about-one-img">
						<img src="{{ asset('storage/') }}/{{ $about->images }}" class="img-fluid">
						<div class="about-shape">
							<img src="{{ asset('') }}images/bg-shape.png" class="img-fluid" alt="Images">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="about-one-content">
						<div class="section-title">
							<span class="sp-span">ABOUT US</span>
							<h2>{{ $about->heading }}</h2>
							<p>
								{!! $about->description !!}
							</p>
						</div>
						<div class="about-btn">
							<a href="#" class="btn btn-readmore">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="about-two-part">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="about-two-content">
						<div class="section-title">
							<span class="sp-span">Bhawan Bhoomi - Your Property, Your Platform.</span>
							<h2>{{ $vision->heading }}</h2>
							<p>
								{!! $vision->description !!}
							</p>
							<div class="mission-vision">
								<div class="row">
									@foreach($keys as $key)
									<div class="col-md-6">
										<h3>{{ $key->heading }}</h3>
										<p>{!! $key->description !!}</p>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-two-img">
						<img src="{{ asset('storage/') }}/{{ $vision->images }}" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('js')
@endsection