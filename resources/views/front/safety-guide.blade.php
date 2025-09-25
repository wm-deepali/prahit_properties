@extends('layouts.front.app')

@section('title')
<title>Safety Guide</title>
@endsection

@section('content')
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>{{ $picked->heading }}</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Safety Guide</li>
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
				{!! $picked->description !!}
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
@endsection