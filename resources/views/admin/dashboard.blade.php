@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')

<section class="content-main-body">
	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card counter-dash">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col mr-2">
								<div class="heading">Property Added</div>
								<div class="heading-2 font-weight-bold">40,000</div>
								<div class="heading-3">
									<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
									<span>Since last month</span>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-file-alt fa-2x text-primary"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card counter-dash">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col mr-2">
								<div class="heading">Total Sale</div>
								<div class="heading-2 font-weight-bold">1,02,000</div>
								<div class="heading-3">
									<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 8.48%</span>
									<span>Since last month</span>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-wallet fa-2x text-success"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card counter-dash">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col mr-2">
								<div class="heading">New Registration</div>
								<div class="heading-2 font-weight-bold">8700</div>
								<div class="heading-3">
									<span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 9.98%</span>
									<span>Since last month</span>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user fa-2x text-dark"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card counter-dash">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col mr-2">
								<div class="heading">Site Traffic</div>
								<div class="heading-2 font-weight-bold">6,50,900</div>
								<div class="heading-3">
									<span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 9.98%</span>
									<span>Since last week</span>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chart-bar fa-2x text-danger"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8">
				<div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">This Month</h4>
						<canvas id="myChart"></canvas>
					</div>
				</div>
				
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Transactions Hours</h4>
						<canvas id="hourstrans"></canvas>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">Last Login: {{date('jS F, Y, h:i:sa', strtotime($last_login->created_at))}}</h4>
					</div>
				</div>

				<div class="card mb-4">
					<div class="card-body">
						<h4 class="card-title">Site Traffic</h4>
						<canvas id="doughnut-chart"></canvas>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Activity timeline</h4>
						<ul class="bullet-line-list">
							<li>
								<p class="dated">24 May 2018</p>
								<p>New User Registered</p>
							</li>
							<li>
								<p class="dated">25 May 2018</p>
								<p>User Purchased Premium Plan</p>
							</li>
							<li>
								<p class="dated">26 May 2018</p>
								<p>Payment Request from user</p>
							</li>
							<li>
								<p class="dated">27 May 2018</p>
								<p class="mb-0">New Transaction Done</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection