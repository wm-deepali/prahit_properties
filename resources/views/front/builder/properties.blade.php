@extends('layouts.front.app')

@section('title')
<title>My Properties</title>
@endsection

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>My Properties</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">My Properties</li>
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
					<h3 class="head-tit">Properties</h3>
					<section class="dashboard-area account-my-properties">
						<div class="row">
							<div class="col-sm-12">
								@if(count($properties) > 0)
									@foreach($properties as $k=>$v)
										<div class="single-listing">
											<div class="media">
												<img class="mr-3 img-fluid" src="{{ asset('') }}{{ $v->PropertyGallery[0]->image_path }}" alt="Title">
												<div class="media-body">
													<h1 class="property-title"><a href="{{ route('property_detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{$v->title}}</a></h1>
													<h3 class="property-price"><i class="fas fa-rupee-sign"></i> {{$v->price}}</h3>
													<h3 class="property-listed">Listing in <a href="#">{{$v->category->category_name}}</a> </h3>
													<div class="property-buttons">
														<ul>
															<li><a href="{{ url('update/property') }}/{{ $v->id }}" title="Edit Property"><i class="fas fa-pencil-alt"></i></a>
															</li>
															<li><a  href="{{ route('property_detail', parameters: ['id' => $v->id, 'slug' => $v->slug]) }}" title="View Property"><i class="fas fa-eye"></i></a>
															</li>
															<li><a style="cursor: pointer;" title="Delete Property" onclick="deleteProperty('{{ $v->id }}')"><i class="fas fa-trash"></i></a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@else 
									<div class=""> No records found </div>
								@endif
							</div>



						</div>

<!-- 						<div class="row">
							<div class="col-sm-12">
								<div class="pagination justify-content-center">
									<nav aria-label="Page navigation example">
										<ul class="pagination justify-content-center">
											<li class="page-item disabled">
												<a class="page-link" href="#" tabindex="-1">Previous</a>
											</li>
											<li class="page-item"><a class="page-link" href="#">1</a>
											</li>
											<li class="page-item active"><a class="page-link" href="#">2</a>
											</li>
											<li class="page-item"><a class="page-link" href="#">3</a>
											</li>
											<li class="page-item">
												<a class="page-link" href="#">Next</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
						</div> -->
					</section>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function deleteProperty(id) {
		swal({
                title: "Are you sure?",
                text: "Delete this Property",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method:'post',
                    url   : "{{ route('property.delete') }}",
                    data  : {
                    "_token": "{{ csrf_token() }}",
                        'id'    : id
                    },
                    success: function(data){
                    	toastr.success(data);
                        setTimeout( function () {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
	}
</script>
@endsection