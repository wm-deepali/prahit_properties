@extends('layouts.front.app')

@section('title')
<title>Dashboard</title>
@endsection

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>My Account</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Account</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="owner-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            	@include('front.user.sidebar')
            </div>
            <div class="col-sm-9">
                <div class="main-area-dash">
                    <h3 class="head-tit">Dashboard</h3>
                    <section class="dashboard-area">
                        
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


