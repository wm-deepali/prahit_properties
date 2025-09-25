@extends('layouts.front.app')

@section('title')
<title>Privecy Policy</title>
@endsection

@section('content')
 
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>{{ $policy->heading }}</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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
				<h1>{{ $policy->heading }}</h1>
				{!! $policy->description !!}
			</div>
		</div>
	</div>
</section>

@endsection
@section('js')
@endsection