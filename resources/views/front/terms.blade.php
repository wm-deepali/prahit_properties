@extends('layouts.front.app')

@section('title')
<title>Term & Conditions</title>
@endsection

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>{{ $term->heading }}</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Terms &amp; Condtions</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="policy-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><strong>{{ $term->heading }}</strong></h2>
				{!! $term->description !!}
			</div>
		</div>
	</div>
</section>

@endsection
@section('js')
@endsection