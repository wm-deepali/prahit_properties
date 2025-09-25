@extends('layouts.app')

@section('title')
Manage Properties
@endsection
<style type="text/css">
  .tabs { list-style: none; }
  .tabs li { display: inline; }
  .tabs li a { color: black; float: left; display: block; padding: 4px 10px; margin-left: 10px; position: relative; left: 1px; background: white; text-decoration: none;border: 1px solid black; }
  .tabs li a:hover { background: #ccc; }
</style>
@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">User</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">User Profile</li>
            <li class="breadcrumb-item active">View Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </div> 
</section>
<section class="content-main-body">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="card-block">
          <div class="row">
            <div class="pro-m">
              <a href="{{ url('master/update/owner/') }}/{{ $user->id }}" class="btn btn-dark">Edit Profile</a>
              <a href="{{ url('master/update/owner/') }}/{{ $user->id }}" class="btn btn-dark">Change Password</a>
              <a style="cursor: pointer;color: white" class="btn btn-dark" data-toggle="modal" data-target="#send-sms">Send SMS</a>
              <a style="cursor: pointer;color: white" class="btn btn-dark" data-toggle="modal" data-target="#send-email">Send Email</a>
            </div>

          </div>
          <div class="row" style="margin-top: 20px;">
            @if($user->avatar)
            @if(file_exists(url('/').$user->avatar))

            @endif
            <img src="{{ url('') }}/{{ $user->avatar }}" style="height: 100px;">
            @endif
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label class="content-label">Name:</label>
              <h5 class="content-h">{{ $user->firstname }} {{ $user->lastname }}</h5>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Email:</label>
              <h5 class="content-h">{{ $user->email }}</h5>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Mobile Number:</label>
              <h5 class="content-h">{{ $user->mobile_number }}</h5>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label class="content-label">State:</label>
              <h5 class="content-h">{{ $user->getState ? $user->getState->name : '' }}</h5>
            </div>
            <div class="col-sm-4">
              <label class="content-label">City:</label>
              <h5 class="content-h">{{ $user->getCity ? $user->getCity->name : '' }}</h5>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Gender:</label>
              <h5 class="content-h">{{ $user->gender }}</h5>
            </div>
          </div>
          
          <div class="form-group row">
              <div class="col-sm-4">
              <label class="content-label">Address:</label>
              <h5 class="content-h">{{ $user->address }}</h5>
            </div>
              <div class="col-sm-4">
                  <label class="content-label">Email Verified:</label>
                  <h5 class="content-h">@if($user->is_verified == 1) <span class="badge badge-success">Yes</span>  @else <span class="badge badge-danger">No</span>  @endif</h5>
                </div>
                <div class="col-sm-4">
                  <label class="content-label">Mobile Number Verified:</label>
                  <h5 class="content-h">@if($user->mobile_verified == 1) <span class="badge badge-success">Yes</span>  @else <span class="badge badge-danger">No</span>  @endif</h5>
                </div>
          </div>
          <hr />
          <h4 class="form-section-h">Manage Properties</h4>
          <div class="row">
            <div class="col-sm-12">
              <div class="cust-navs">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#total" class="active">Total Properties</a></li>
                  <li><a data-toggle="tab" href="#free">Free Listing</a></li>
                  <li><a data-toggle="tab" href="#premium">Premium Listing</a></li>
                </ul>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="tab-content">
                <div id="total" class="tab-pane fade in active show">
                  <div class="table-responsive">
                    <table class="table table-bordered table-fitems" id="total-properties">
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
                <div id="free" class="tab-pane fade">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems" id="free-properties">
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
                <div id="premium" class="tab-pane fade">
                  <div class="table-responsive">
                    <table class="table table-bordered table-fitems" id="paid-properties">
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
    </div>
  </div>
</div>
</section>

<!-- Send SMS -->
<div id="send-sms" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send SMS</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.sendSMS') }}">
          @csrf
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="container-fluid">
            <div class="row form-group"> 
              <label><strong>Name:</strong></label>
              <input type="text" class="form-control" name="name" value="{{ $user->firstname }} {{ $user->lastname }}" readonly="" required="">
            </div>
            <div class="row form-group"> 
              <label><strong>Mobile Number:</strong></label>
              <input type="number" class="form-control" name="number" value="{{ $user->mobile_number }}" readonly="" required="">
            </div>
            <div class="row form-group"> 
              <label><strong>Message:</strong></label>
              <textarea name="message" class="form-control" id="message" cols="5" onkeyup="charCount()" required=""></textarea>
              <p id="char_count"></p>
            </div>
            <div class="row form-group"> 
              <input type="submit" class="btn btn-primary" value="Send">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Send Email -->
<div id="send-email" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Compose</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.sendEmail') }}">
          @csrf
          <input type="hidden" name="id" value="{{ $user->id }}">
          <div class="container-fluid">
            <div class="row form-group"> 
              <label><strong>Name:</strong></label>
              <input type="text" class="form-control" name="name" value="{{ $user->firstname }} {{ $user->lastname }}" readonly="" required="">
            </div>
            <div class="row form-group"> 
              <label><strong>Email:</strong></label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly="" required="">
            </div>
            <div class="row form-group"> 
              <label><strong>Message:</strong></label>
              <textarea name="email_message" required=""></textarea>
            </div>
            <div class="row form-group"> 
              <input type="submit" class="btn btn-primary" value="Send">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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

<div class="modal custom-white" id="send-information">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Send Content On What's App</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row"> 
          <div class="col-sm-12">
            <div class="dealer-content">
              <h3 class="con-dtitle">Mobile Number</h3>
              <div class="row">
                <input type="hidden" id="p-id">
                <input type="hidden" id="p-status">
                <div class="col-sm-12">
                  <input type="number" name="mobile_number" id="mobile_number" class="form-control" placeholder="Enter Mobile Number">
                </div>
              </div>
            </div>
            <div class="dealer-content" id="property-title">

            </div>
            <div class="dealer-content" id="property-id">

            </div>
            <div class="dealer-content" id="property-link">

            </div>
            <div class="dealer-content" id="property-images">
              <h3 class="con-dtitle" style="margin-top:15px;">Property Images</h3>
              <div class="row" id="render-images">

              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <center><button class="btn btn-primary" onclick="sendInformation()" style="margin-top:15px;">Send</button></center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('js')
<script type="text/javascript">
  CKEDITOR.replace( 'email_message' );
  //-------------------- Manage Total lead listing ----------------------//
  $(function () {
    var user_id = '{{ $user->id }}';
    var table = $('#total-properties').DataTable({
      processing: true,
      serverSide: true,
      render: true,
      searching: true,
      ajax: "{{ url('total/properties/datatable') }}?user_id="+user_id,
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

    var table = $('#free-properties').DataTable({
      processing: true,
      serverSide: true,
      render: true,
      searching: true,
      ajax: "{{ url('total/properties/datatable') }}?user_id="+user_id+"&listing_type=free",
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

    var table = $('#paid-properties').DataTable({
      processing: true,
      serverSide: true,
      render: true,
      searching: true,
      ajax: "{{ url('total/properties/datatable') }}?user_id="+user_id+"&listing_type=paid",
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
  });


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
            $('#total-properties').DataTable().ajax.reload();
            $('#free-properties').DataTable().ajax.reload();
            $('#paid-properties').DataTable().ajax.reload();
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
    swal({
      title: "Are you sure?",
      text: "Approved This Property.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        document.getElementById('new_loader').style.display = 'block';
        $(".btn-delete").attr('disabled', true);
        $.ajax({
          url: '{{ url('master/approve/properties') }}',
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            'id'    : id
          },
          success: function(response) {
            toastr.success(response);
            document.getElementById('new_loader').style.display = 'none';
            $('#properties').DataTable().ajax.reload();
          },
          error: function(response) {
            toastr.error('An error occured.')
          },
          complete: function() {
           document.getElementById('new_loader').style.display = 'none';
         }
       })
      }
    });
    
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

  function shareDocuments(id) {
    var route = "{{route('admin.properties.show', ':id')}}";
    var route = route.replace(":id", id);
    var attribute = document.querySelector('#publish_status'+id);
    if (attribute) {
      var status = attribute.getAttribute('publish-status');
    }
    $.ajax({
      url: route,
      method: "GET",
      beforeSend: function(argument) {
        $(".loading").css('display', 'block');
      },
      success: function(response) {
        var response = JSON.parse(response);
        if(response.status === 200) {
          document.getElementById('p-id').value = id;
          document.getElementById('p-status').value = status;
          $('#property-title').html('');
          $('#property-id').html('');
          $('#property-link').html('');
          $('#render-images').html('');
          if(status == 'Unpublish') {
            document.getElementById('property-title').style.display = 'block';
            document.getElementById('property-id').style.display = 'block';
            document.getElementById('property-link').style.display = 'none';
            document.getElementById('property-images').style.display = 'none';
            $('#property-title').append(`<h3 class="con-dtitle" style="margin-top:15px;">Property Title</h3>
              <div class="row">
              <div class="col-sm-10">
              <input type="text" name="title" id="title" class="form-control" value="${response.data.Property.title}" readonly>
              </div>
              <div class="col-sm-2">
              <input type="checkbox" id="title-check" class="form-control">
              </div>
              </div>`);
            $('#property-id').append(`<h3 class="con-dtitle" style="margin-top:15px;">Property Id</h3>
              <div class="row">
              <div class="col-sm-10">
              <input type="text" name="listing_id" id="listing_id" class="form-control" value="${response.data.Property.listing_id}" readonly>
              </div>
              <div class="col-sm-2">
              <input type="checkbox" id="listing-check" class="form-control">
              </div>
              </div>`);
          }else {
            document.getElementById('property-title').style.display = 'block';
            document.getElementById('property-id').style.display = 'block';
            document.getElementById('property-link').style.display = 'block';
            document.getElementById('property-images').style.display = 'block';
            $('#property-title').append(`<h3 class="con-dtitle" style="margin-top:15px;">Property Title</h3>
              <div class="row">
              <div class="col-sm-10">
              <input type="text" name="title" id="title" class="form-control" value="${response.data.Property.title}" readonly>
              </div>
              <div class="col-sm-2">
              <input type="checkbox" id="title-check" class="form-control">
              </div>
              </div>`);
            $('#property-id').append(`<h3 class="con-dtitle" style="margin-top:15px;">Property Id</h3>
              <div class="row">
              <div class="col-sm-10">
              <input type="text" name="listing_id" id="listing_id" class="form-control" value="${response.data.Property.listing_id}" readonly>
              </div>
              <div class="col-sm-2">
              <input type="checkbox" id="listing-check" class="form-control">
              </div>
              </div>`);
            $('#property-link').append(`<h3 class="con-dtitle" style="margin-top:15px;">Property Page Link</h3>
              <div class="row">
              <div class="col-sm-10">
              <input type="text" name="page-link" id="page-link" class="form-control" value="{{ url('') }}/property/${response.data.Property.slug}" readonly>
              </div>
              <div class="col-sm-2">
              <input type="checkbox" id="link-check" class="form-control">
              </div>
              </div>`);
            $.each(response.data.Property.property_gallery,function(key,image){
              $("#render-images").append(`<div class="col-sm-3">
                <img src="{{config('app.url')}}/public/${image.image_path}" style="height:50px;" /><br>
                <input type="checkbox" name="document" value="{{config('app.url')}}/public/${image.image_path}" />
                </div>`);
            });
            
          }
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
$('#send-information').modal('show');
}

function sendInformation() {
  var checkboxes = document.getElementsByName('document');
  var checkboxesChecked = [];
  for (var i=0; i<checkboxes.length; i++) {
       // And stick the checked ones onto an array...
       if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i].value);
      }
    }

    var mobile_number = $('#mobile_number').val();
    var title   = document.getElementById('title-check');
    var listing = document.getElementById('listing-check');
    var linkdata = document.getElementById('link-check');
    if(mobile_number == '') {
      toastr.error('Mobile number field must be required.');
      return false;
    }
    if (/^\d{10}$/.test(mobile_number)) {

    } else {
      toastr.error('Invalid number; must be ten digits');
      return false
    }
    if(title.checked == false && listing.checked == false && linkdata.checked == false && checkboxesChecked.length == 0) {
      toastr.error('Please Select Atleast One Item');
      return false;
    }else {
      var token = 'fke9gs917kuk3o0t';
      var titlemsg = $('#title').val();
      var listing_id = $('#listing_id').val();
      if(title.checked == true) {
        var message = titlemsg;
        var url = `https://api.chat-api.com/instance272835/message?token=${token}`;
        var data = {
          phone: '91'+mobile_number,
          body: message,
        };
        $.ajax({
          url: url,
          type: "POST",
          data : JSON.stringify(data),
          contentType : 'application/json',
          success: function(response) {
            if(response.sent) {
              toastr.success('Message Successfully Send.');
            }else {
              toastr.error('Something went wrong, message not send.')
              return false;
            }
          },
          error: function(response) {
            toastr.error('An error occured.')
            return false;
          },
          complete: function() {
           document.getElementById('new_loader').style.display = 'none';
         }
       })
      }
      if(listing.checked == true) {
        var message = 'Property Id: '+listing_id;
        var url = `https://api.chat-api.com/instance272835/message?token=${token}`;
        var data = {
          phone: '91'+mobile_number,
          body: message,
        };
        $.ajax({
          url: url,
          type: "POST",
          data : JSON.stringify(data),
          contentType : 'application/json',
          success: function(response) {
            if(response.sent) {
              toastr.success('Message Successfully Send.');
              // location.reload();
            }else {
              toastr.error('Something went wrong, message not send.')
              return false;
            }
          },
          error: function(response) {
            toastr.error('An error occured.')
            return false;
          },
          complete: function() {
           document.getElementById('new_loader').style.display = 'none';
         }
       })
      }
      if(linkdata.checked == true) {
        var link = $('#page-link').val();
        var message = 'Property Page URL: '+link;
        var url = `https://api.chat-api.com/instance272835/message?token=${token}`;
        var data = {
          phone: '91'+mobile_number,
          body: message,
        };
        $.ajax({
          url: url,
          type: "POST",
          data : JSON.stringify(data),
          contentType : 'application/json',
          success: function(response) {
            if(response.sent) {
              toastr.success('Message Successfully Send.');
              // location.reload();
            }else {
              toastr.error('Something went wrong, message not send.')
              return false;
            }
          },
          error: function(response) {
            toastr.error('An error occured.')
            return false;
          },
          complete: function() {
           document.getElementById('new_loader').style.display = 'none';
         }
       })
      }
      if(checkboxesChecked.length > 0) {
        for (var i = 0; i < checkboxesChecked.length; i++) {
          var url = `https://api.chat-api.com/instance272835/sendFile?token=${token}`;
          var data = {
            phone: '91'+mobile_number,
            body: checkboxesChecked[i],
            filename: "property.jpg"
          };
          $.ajax({
            url: url,
            type: "POST",
            data : JSON.stringify(data),
            contentType : 'application/json',
            success: function(response) {
              if(response.sent) {
                toastr.success('Message Successfully Send.');
                // location.reload();
              }else {
                toastr.error('Something went wrong, message not send.')
                return false;
              }
            },
          })
        }
        
      } 
      setTimeout(function() {
        location.reload();
      }, 2000);

    }
  }
</script>
@endsection