@extends('layouts.app')

@section('title')
Manage Properties
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
                  <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Property</h3>
          <a type="button" class="btn btn-primary btn-save" href="{{route('admin.properties.create')}}"><i class="fas fa-plus"></i> Add Property</a>
          <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter"    aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Property</li>
            <li class="breadcrumb-item active">Manage Pending Property</li>
          </ol>
        </div>
      </div>
    </div>
  </div> 
</section>
<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-12 collapse" id="showFilter">
        <div class="card">
          <div class="card-body">
            <form id="filter_form" name="filter_form">
              <div class="card-block">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label label-control">Category</label>
                    <select class="text-control populate_categories" name="properties.category_id">
                      <option value="">Select Category</option>
                    </select>
                  </div>

                  <div class="col-sm-4">
                    <label class="label label-control">Sub Category</label>
                    <select class="text-control populate_sub_categories" name="properties.sub_category_id">
                      <option value="">Select Sub Cat</option>
                    </select>
                  </div>

<!--                   <div class="col-sm-3">
                    <label class="label label-control">Sub Sub Category</label>
                    <select class="text-control populate_sub_sub_categories" name="sub_sub_category">
                      <option value="">Select Sub Sub Cat</option>
                    </select>
                  </div> -->

                  <div class="col-sm-3">
                    <label class="label label-control">Package</label>
                    <select class="text-control">
                      <option value="">Select Package</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-5">
                    <label class="label label-control">Location</label>
                    <select class="text-control" name="properties.location_id">
                      <option value="">Select Location</option>
                      @foreach($location as $k=>$v)
                        <option value="{{$v->id}}">{{$v->location}}</option>
                      @endforeach
                    </select>
                  </div>

                  <!--<div class="col-sm-3">-->
                  <!--  <label class="label label-control">Sub Location</label>-->
                  <!--  <select class="text-control" name="properties.sub_location_id">-->
                  <!--    <option value="">Select Sub Location</option>-->
                  <!--    @foreach($sublocation as $k=>$v)-->
                  <!--      <option value="{{$v->id}}">{{$v->sub_location_name}}</option>-->
                  <!--    @endforeach-->
                  <!--  </select>-->
                  <!--</div>-->

                  <div class="col-sm-3">
                    <div class="row">
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">Min Budget</label>
                        <select class="text-control" name="min_price" id="min_price">
                          <option value="">Select</option>
                          <option data-min="0" value="0">0</option>
                          <option data-min="10000" value="10000">10 K </option>
                          <option data-min="20000" value="20000">20 K </option>
                          <option data-min="30000" value="30000">30 K </option>
                          <option data-min="40000" value="40000">40 K </option>
                          <option data-min="50000" value="50000">50 K</option>
                          <option data-min="100000" value="100000">1 Lakhs</option>
                          <option data-min="200000" value="200000">2 Lakhs</option>
                          <option data-min="300000" value="300000">3 Lakhs</option>
                          <option data-min="500000" value="500000">5 Lakhs</option>
                          <option data-min="1000000" value="1000000">10 Lakhs</option>
                          <option data-min="1500000" value="1500000">15 Lakhs</option>
                          <option data-min="2000000" value="2000000">20 Lakhs</option>
                          <option data-min="2500000" value="2500000">25 Lakhs</option>
                          <option data-min="5000000" value="5000000">50 Lakhs</option>
                          <option data-min="10000000" value="10000000">1 Crore</option>
                          <option data-min="20000000" value="20000000">2 Crore</option>
                          <option data-min="30000000" value="30000000">3 Crore</option>
                          <option data-min="50000000" value="50000000">5 Crore</option>
                          <option data-min="100000000" value="100000000">10 Crore</option>
                          <option data-min="500000000" value="500000000">50 Crore</option>
                          <option data-min="1000000000" value="1000000000">50+ Crore</option>
                        </select>
                      </div>
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">Max Budget</label>
                        <select class="text-control" name="max_price" id="max_price">
                          <option value="">Select</option>
                          <option data-min="10000" value="10000">10 K </option>
                          <option data-min="20000" value="20000">20 K </option>
                          <option data-min="30000" value="30000">30 K </option>
                          <option data-min="40000" value="40000">40 K </option>
                          <option data-min="50000" value="50000">50 K</option>
                          <option data-max="100000" value="100000">1 Lakhs</option>
                          <option data-min="200000" value="200000">2 Lakhs</option>
                          <option data-min="300000" value="300000">3 Lakhs</option>
                          <option data-max="500000" value="500000">5 Lakhs</option>
                          <option data-max="1000000" value="1000000">10 Lakhs</option>
                          <option data-max="1500000" value="1500000">15 Lakhs</option>
                          <option data-max="2000000" value="2000000">20 Lakhs</option>
                          <option data-max="2500000" value="2500000">25 Lakhs</option>
                          <option data-max="5000000" value="5000000">50 Lakhs</option>
                          <option data-max="10000000" value="10000000">1 Crore</option>
                          <option data-min="20000000" value="20000000">2 Crore</option>
                          <option data-min="30000000" value="30000000">3 Crore</option>
                          <option data-max="50000000" value="50000000">5 Crore</option>
                          <option data-max="100000000" value="100000000">10 Crore</option>
                          <option data-max="500000000" value="500000000">50 Crore</option>
                          <option data-min="1000000000" value="1000000000">50+ Crore</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="row">
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">From Date</label>
                        <input type="date" name="form_date" id="form_date" class="text-control">
                      </div>
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="text-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <label class="label label-control">Ownership</label>
                    <select name="ownership" class="text-control">
                      <option value="">Select Ownership</option>
                      <option value="owner">Owner/Individual</option>
                      <option value="builder">Builder</option>
                      <option value="agent">Agent</option>
                    </select>
                  </div>

                  <div class="col-sm-3">
                    <label class="label label-control">Property Type</label>
                    <select name="properties.type_id" class="text-control">
                      <option value="">Select Type</option>
                      @foreach($property_types as $k=>$v)
                        <option value="{{$v->id}}">{{$v->type}}</option>
                      @endforeach
                    </select>
                  </div>


                  <div class="col-sm-3">
                    <label class="label label-control">Property Status</label>
                    <select name="properties.status" class="text-control">
                      <option value="">Select Status</option>
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>
                    </select>
                  </div>

                  <div class="col-sm-3 align-self-end">
                    <button class="btn btn-filternow" type="submit"><i class="fas fa-filter"></i> Filter Now</button>
                    <button class="btn btn-filternow" type="button" onclick="reload()"><i class="fas fa-refresh"></i> Reset</button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>


      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems" id="properties">
                  <thead>
                    <tr>
                      <th>Date & Time</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Property ID</th>
                      <th>Property Price</th> 
                      <th>Owner Type</th>
                      <th>Listing Type</th>
                      <th>Total Enquiries</th>
                      <th>Added By</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal custom-white" id="dealer_info">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Owner Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
			<div class="col-sm-4 align-self-center">
				<div class="dealer-prop">
					<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png" id="profile-image" class="img-fluid">
				</div>
			</div> 
			<div class="col-sm-8 align-self-center">
				<div class="dealer-content">
					<div class="row">
						<div class="col-sm-6">
							<label class="content-label">Name</label>
							<h3 class="content-head" id="view-name"></h3>
						</div>
						
						<div class="col-sm-12">
							<label class="content-label">Email</label>
							<h3 class="content-head" id="view-email">im@gmail.com</h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<label class="content-label">Mobile No.</label>
							<h3 class="content-head" id="view-mobile">9898989898</h3>
						</div>
						
						<div class="col-sm-6">
							<label class="content-label">Property Posted</label>
							<h3 class="content-head" id="total-post-p">12</h3>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<label class="content-label">Email Verified</label>
							<h3 class="content-head" id="email-verify"></h3>
						</div>
						
						<div class="col-sm-6">
							<label class="content-label">Mobile Verified</label>
							<h3 class="content-head" id="mobile-verify"></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal custom-white" id="package_info">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Package Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row"> 
			<div class="col-sm-12">
				<div class="dealer-content">
					<h3 class="con-dtitle">Current Package</h3>
					<div class="row">
						<div class="col-sm-4">
							<label class="content-label">Package</label>
							<h3 class="content-head">Basic</h3>
						</div>
						
						<div class="col-sm-4">
							<label class="content-label">Validity</label>
							<h3 class="content-head">120 days</h3>
						</div>
						
						<div class="col-sm-4">
							<label class="content-label">Price</label>
							<h3 class="content-head"><i class="fas fa-rupee-sign"></i> 1900</h3>
						</div>
					</div>
					
					<h3 class="con-dtitle mt-3">Change Package</h3>
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="label-control">Change to</label>
							<select class="text-control">
								<option value="" selected>Select Package</option>
								<option value="1">Advanced</option>
							</select>
						</div>
						<div class="col-sm-6">
							
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal custom-white" id="property_info">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Property Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
      <div class="col-sm-4 align-self-center">
        <div class="dealer-prop">
          <img src="https://images.livemint.com/rf/Image-621x414/LiveMint/Period1/2013/08/13/Photos/house--621x414.jpg" class="img-fluid listing_thumbnail">
        </div>
      </div> 
      <div class="col-sm-8 align-self-center">
        <div class="dealer-content">
          <div class="row">
            <div class="col-sm-12">
                <label class="content-label">Property Type</label>
                <h3 class="content-head p-type"></h3>
            </div>
            <div class="col-sm-12">
              <label class="content-label">Title</label>
              <h3 class="content-head title"></h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Category</label>
              <h3 class="content-head category">Rent</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Sub Category</label>
              <h3 class="content-head subcategory">Commercial</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Location</label>
              <h3 class="content-head location"></h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Property ID</label>
              <h3 class="content-head property_id"></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Price</label>
              <h3 class="content-head price"></h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Published Date</label>
              <h3 class="content-head published_date"></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Listing Type</label>
              <h3 class="content-head listing-type"></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>

<!-- Approve & Publish Property -->
<div id="approveProperty" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Status Of Property</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('master/approve/properties') }}">
          @csrf
          <input type="hidden" name="id" id="p_id">
          <div class="container">
            <div class="row form-group">
              <label>Select Status:</label>
              <select class="form-control" name="status" id="status" onclick="checkValidSection()" required="">
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            </div>
            <div class="row" id="publish-check">
              <p><input type="checkbox" name="publish"><b>  If you also want to publish property with Approve, please check the checkbox.</b></p>
            </div>
            <div class="row form-group" id="text-area">
              <label>Reason:</label>
              <textarea class="form-control" name="reason" id="reason" cols="5"></textarea>
            </div>
            <center><input type="submit" class="btn btn-primary" value="Submit"></center>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection



@section('js')
<script type="text/javascript">
  document.getElementById('text-area').style.display = 'none';
  //-------------------- Manage pending lead listing ----------------------//
  getPendingPropertyDatatabe();
  function getPendingPropertyDatatabe(queryParams = '?') {
      var route = '{{ route('admin.properties.index') }}'+queryParams;
      var table = $('#properties').DataTable({
          processing: true,
          serverSide: true,
          render: true,
          searching: true,
          ajax: route,
          columns: [
              {data: 'date_time', name: 'date_time'},
              {data: 'category', name: 'category'},
              {data: 'sub_category', name: 'sub_category'},
              {data: 'listing_id', name: 'listing_id'},
              {data: 'price', name: 'price'},
              {data: 'owner_type', name: 'owner_type'},
              {data: 'listing_type', name: 'listing_type'},
              {data: 'total_enquiry', name: 'total_enquiry'},
              {data: 'added_by', name: 'added_by'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action'},
          ],
      });
  }



$(function() {
  $.ajax({
    url: "{{config('app.api_url')}}"+'/category_tree',
    method:"get",
    beforeSend:function() {
      $(".loading").css('display', 'block');
    },
    success:function(response) {
      if(response.responseCode === 200) {
        var response = response.data.Categories;
        console.log(response)
        // $(".populate_categories, .populate_sub_categories, .populate_sub_sub_categories").empty()
        $.each(response, function(x,y) {
          if(response.length<1) return true;
          $(".populate_categories").append(
            `
              <option value=${y.id}> ${y.category_name} </option>
            `
          );
          if(y.subcategory.length<1) return true;
          $.each(y.subcategory, function(a,b) {
            $(".populate_sub_categories").append(
              `
                <option value=${b.id}> ${b.sub_category_name} </option>
              `
            );
            if(b.subsubcategory.length<1) return true;
            $.each(b.subsubcategory, function(c,d) {
              $(".populate_sub_sub_categories").append(
                `
                  <option value=${d.id}> ${d.sub_sub_category_name} </option>
                `
              );
            })

          })

        });

      } else {
        toastr.error('An error occured while fetching categories');
      }
      $(".loading").css('display', 'none');
    },
    error:function(response) {
      toastr.error('An error occured');
    }
  })
});

$("#filter_form").submit(function(e) {
  e.preventDefault();
  var min_price = $('#min_price').val();
  var max_price = $('#max_price').val();
  var form_date = $('#form_date').val();
  var to_date   = $('#to_date').val();
  if(min_price && max_price == '') {
    toastr.error('Max price field must be required');
    return false;
  }
  if(min_price == '' && max_price) {
    toastr.error('Min price field must be required');
    return false;
  }
  if(min_price && max_price) {
    if(parseInt(max_price) < parseInt(min_price)) {
      toastr.error('Max price must be grater than min price.');
      return false;
    }
  }
  if(form_date && to_date == '') {
    toastr.error('To date field must be required');
    return false;
  }
  if(form_date == '' && to_date) {
    toastr.error('From date field must be required');
    return false;
  }
  if(form_date && to_date) {
    const x = new Date(form_date);
    const y = new Date(to_date);
    if(y < x) {
      toastr.error('To date must be grater then from date.');
      return false;
    }
  }
  $('#properties').DataTable().destroy();
  var queryParams = "?";
  $(this).find(':input').each(function(x,y) {
    // queryParams[y.name] = y.value;
    if(!y.value) return true;
    queryParams += `filter_${y.name}`
    queryParams += `=${y.value}&`
  });
  getPendingPropertyDatatabe(queryParams);
})

function delete_record(id) {
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

function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Change Status This Property.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/property/change-status') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id'    : id
            },
            success: function(response) {
              toastr.success(response);
              $('#properties').DataTable().ajax.reload();
            },
            error: function(response) {
              toastr.error('An error occured.')
            },
            complete: function() {
              $(".loading_2").css('display', 'none');
              $(".btn-delete").attr('disabled', false);
            }
          })
      }
    });
    
  }

  function approveProperty(id) {
    document.getElementById('p_id').value = id;
    $('#approveProperty').modal('show');    
  }

  function fetchPropertyDetails(id){
    var route = "{{route('admin.properties.show', ':id')}}";
    var route = route.replace(":id", id);

    $.ajax({
      url: route,
      method: "GET",
      beforeSend: function(argument) {
        $(".loading").css('display', 'block');
      },
      success: function(response) {
        var response = JSON.parse(response);
        if(response.status === 200) {
          console.log(response.data);
          $(".listing_thumbnail").attr('src', "{{config('app.url')}}/public/"+response.data.Property.property_gallery[0].image_path);
          var publish = response.data.Property.publish_date ? response.data.Property.publish_date : 'Not Defined';
          $(".title").text(response.data.Property.title);
          $(".category").text(response.data.Property.category.category_name);
          $(".subcategory").text(response.data.Property.sub_category.sub_category_name)
          $(".location").text(response.data.Property.location.location)
          $(".property_id").text(response.data.Property.listing_id)
          $(".p-type").text(response.data.Property.property_types.type)
          $(".price").text('₹'+response.data.Property.price)
          $(".listing-type").text('₹'+response.data.Property.listing_type)
          $(".published_date").text(publish)
          $("#property_info").modal('show');
        } else if (response.status === 400) {
          toastr.error(response.message)
        }
        $(".loading").css('display', 'none');
      },
      error: function(response) {
        toastr.error('An error occured');
        $(".loading").css('display', 'none');
      }
    });
}

function showOwnerInfo(id) {
  var route = "{{route('admin.getUserInfo', ':id')}}";
  var route = route.replace(":id", id);

  $.ajax({
    url: route,
    method: "GET",
    beforeSend: function(argument) {
      $(".loading").css('display', 'block');
    },
    success: function(response) {
      console.log(response);
      if(response.avatar) {
        $("#profile-image").attr('src', "{{config('app.url')}}/public/"+response.avatar);
      }
      $("#view-name").text(response.firstname+' '+response.lastname);
      $("#view-email").text(response.email);
      $("#view-mobile").text(response.mobile_numebr);
      $("#total-post-p").text(response.get_properties.length);
      var email_status  = response.is_verified == 1 ? 'Verified' : 'Not Verified';
      var mobile_status = response.mobile_verified == 1 ? 'Verified' : 'Not Verified';
      $("#email-verify").text(email_status);
      $("#mobile-verify").text(mobile_status);
      $('#dealer_info').modal('show');
    },
    error: function(response) {
      toastr.error('An error occured');
      $(".loading").css('display', 'none');
    },
    complete: function() {
      $(".loading").css('display', 'none');
    }
  });
} 

function checkValidSection() {
    var status = $('#status').val();
    if(status == 'Approved') {
      document.getElementById('publish-check').style.display = 'block';
      document.getElementById('text-area').style.display = 'none';
      $('#reason').removeAttr('required');
    }else if(status == 'Rejected' || status == 'Cancelled') {
      document.getElementById('publish-check').style.display = 'none';
      document.getElementById('text-area').style.display = 'block';
      $('#reason').attr('required', true);
    }
}

function reload(){
  location.reload();
}


</script>
@endsection