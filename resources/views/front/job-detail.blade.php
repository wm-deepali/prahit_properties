@extends('layouts.front.app')
@section('title')
	<title>Job Details</title>
@endsection
@section('content')
<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Job Details</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Job Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="job-detail-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="job-heading">
					<h3>{{ $job->heading }}</h3>
					<div class="job-category">
						<span><i class="fas fa-map-marker"></i> {{ $job->state }}, {{ $job->getCountry->name }}</span>
					</div>
				</div>
				
				<div class="job-content">
					<p>{!! $job->description !!}</p>
				</div>
				
				<div class="job-skills">
					<h3 class="h-heading">Skills</h3>
					<div class="skill-sets">
						<ul>
							@foreach($skills as $skill)
								<li>{{ $skill->name }}</li>
							@endforeach
						</ul>
					</div>
				</div>
				
				<div class="job-tags">
					<h3 class="h-heading">Requirements</h3>
					<div class="tags-sets">
						{!! $job->requirements !!}
					</div>
				</div>
				
				<div class="job-apply">
					<button class="btn btn-applyjob" type="button" data-target="#applyjob" data-toggle="modal" type="button">Apply For this Job</button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="job-apply-w100">
					<button class="btn btn-applyjob" data-target="#applyjob" data-toggle="modal" type="button">Apply For this Job</button>
				</div>
				
				<div class="share-job">
					<h3 class="h-heading">Share this Job</h3>
				</div>
				
				<div class="similar-job">
					<h3 class="h-heading">Similar Jobs</h3>
					<ul>
						@foreach($related_jobs as $related_job)
						<li>
							<div class="position-main">
								<a href="{{ route('front.jobdetail', $related_job->id) }}">
									{{ $related_job->heading }} <span>{{ $related_job->tag_line }}</span>
								</a>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade custom-modal" id="applyjob" tabindex="-1" role="dialog" aria-labelledby="applynow" aria-hidden="true">
	<div class="modal-dialog w-450" role="document">
		<div class="modal-content">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
		
			<div class="top-design">
				<img src="{{ asset('') }}/images/top-designs.png" class="img-fluid">
			</div>
			<div class="modal-body">
				<div class="modal-main">
					<div class="row login-heads">
						<div class="col-sm-12">
							<h3 class="heads-login">Apply Now</h3>
							<span class="allrequired">All field are required</span>
						</div>
					</div>
					<div class="modal-form">
						<form method="post" action="{{ route('front.sendJobRequest') }}" enctype="multipart/form-data">
						@csrf
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Name</label>
									<input type="text" class="text-control" name="name" placeholder="Enter Name" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Email</label>
									<input type="text" class="text-control" name="email" placeholder="Enter Email" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Mobile No.</label>
									<input type="text" class="text-control" name="mobile_number" placeholder="Enter Mobile No." required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Applying For</label>
									<input type="hidden" name="job_id" value="{{ $job->id }}">
									<input type="text" class="text-control" name="apply_for" value="{{ $job->heading }}" readonly="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="label-control">Attach CV/Resume</label>
									<input type="file" name="file" class="text-control" required="">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12 text-center">
									<button type="submit" class="btn btn-send w-100">Apply Now <i class="fas fa-chevron-circle-right"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
@endsection