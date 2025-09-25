@extends('layouts.front.app')
@section('title')
	<title>Career With Us</title>
@endsection

@section('content')
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Career With Us</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Career With Us</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="career-with-us">
	<div class="career-one-part">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="career-content">
						<h2>{{ $picked->heading_more }}</h2>
						<p>{!! $picked->sub_description !!}</p>
						<a href="#open-positions">Open Positions</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="career-img">
						<img src="{{ asset('storage') }}/{{ $picked->images }}" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="career-two-part">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="sec-title">
						<h2>{{ $picked->heading }}</h2>
						<p>{!! $picked->description !!}</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="open-positions">
			<div class="container">
				@foreach($categories as $category)
					<div class="open-designation">
						<h3>{{ $category->name }}</h3>
						<div class="row">
							@foreach($category->getRealatedJobs as $job)
								<div class="col-sm-4">
									<div class="position-main">
										<a href="{{ route('front.jobdetail', $job->id) }}">
											{{ $job->heading }} <span>{{ $job->tag_line }}</span>
										</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
@endsection