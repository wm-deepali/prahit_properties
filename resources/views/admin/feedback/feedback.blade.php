@extends('layouts.app')

@section('title')
Manage Complaints
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
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.properties.index')}}">Manage Property</a></li>
            <li class="breadcrumb-item active">View Property Feedback</li>
          </ol>
<!--       <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter" aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
 -->        </div>
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
                  <div class="col-sm-3">
                    <label class="label label-control">Category</label>
                    <select class="text-control" name="feedback.properties.category_id" onchange="fetchSubCategory(this.value)">
                      <option value="">Select Category</option>
                      @if(isset($category))
                        @foreach($category as $k=>$v)
                          <option value="{{$v->id}}">{{$v->category_name}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="col-sm-3">
                    <label class="label label-control">Sub Category</label>
                    <select class="text-control populate_sub_categories" name="feedback.properties.sub_category_id">
                      <option value="">Select Sub Cat</option>
                    </select>
                  </div>

                  <div class="col-sm-3">
                    <label class="label label-control">Package</label>
                    <select class="text-control">
                      <option value="">Select Package</option>
                    </select>
                  </div>

                  <div class="col-sm-3">
                    <label class="label label-control">Location</label>
                    <select class="text-control" onchange="fetchSubLocation(this.value)">
                      <option value="">Select Location</option>
                      @if(isset($location))
                        @foreach($location as $k=>$v)
                          <option value="{{$v->id}}">{{$v->location}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <label class="label label-control">Sub Location</label>
                    <select class="text-control populate_sublocation">
                      <option value="">Select Sub Location</option>
                    </select>
                  </div>

                  <div class="col-sm-4">
                    <div class="row">
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">From Date</label>
                        <input type="date" class="text-control">
                      </div>
                      <div class="col-sm-6 col-xs-6">
                        <label class="label label-control">To Date</label>
                        <input type="date" class="text-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2 align-self-end">
                    <button class="btn btn-filternow" type="submit"><i class="fas fa-filter"></i> Filter Now</button>
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
                <table class="table table-bordered table-fitems" id="feedback">
                  <thead>
                    <tr>
                      <th>Property Title</th>
                      <th>Feedback</th>
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
              <label class="content-label">Title</label>
              <h3 class="content-head title">2BHK in Hazratganj</h3>
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
              <label class="content-label">Sub Sub Cat</label>
              <h3 class="content-head subsubcategory">Flat</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Package</label>
              <h3 class="content-head">Basic</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Location</label>
              <h3 class="content-head location">Mumbai, MH</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Property ID</label>
              <h3 class="content-head listing_id">374923843</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>
<div class="modal custom-white" id="view-feedback">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Experience</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
      <div class="col-sm-12">
        <p class="experience"></p>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>

@endsection



@section('js')

<script type="text/javascript">

$(function() {

  $("#feedback").DataTable({
    "processing": true,
    "serverSide": true,
    "destroy":true,
    "sAjaxSource": "{{route('admin.propertyFeedbacks')}}",
    "columns": [
        {"data":"property_title"},
        {"data":"feedback"},
        {"data":"status"},
        {"data":"action"},
    ]
  });

});


$("#filter_form").submit(function(e) {
  e.preventDefault();

    var queryParams = "?";
    $(this).find(':input').each(function(x,y) {
      // queryParams[y.name] = y.value;
      if(!y.value) return true;
      queryParams += `filter_${y.name}`
      queryParams += `=${y.value}&`
    });

    console.log(queryParams);
      $("#feedback").DataTable({
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "{{route('admin.complaints.apply_filters')}}"+queryParams,
        "destroy":true,
        "bServerSide": true,
        "columns": [
            { "data": "id"},
            {"data":"property_title"},
            {"data":"feedback"},
            {"data":"action"}
        ]
      });
})

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
              console.log(response.data.Property);
              $(".listing_thumbnail").attr('src', "{{config('app.url')}}/public/"+response.data.Property.property_gallery[0].image_path);
              $(".title").text(response.data.Property.title);
              $(".category").text(response.data.Property.category.category_name);
              $(".subcategory").text(response.data.Property.sub_category.sub_category_name)
              // $(".subsubcategory").val(response.data.Property.category_meta_title)
              $(".location").text(response.data.Property.location.location)
              $(".property_id").text(response.data.Property.listing_id)
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

function fetchFeedback(id){

  var route = "{{route('admin.manage-complaints.show', ':id')}}";
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
              $(".experience").text(response.data.Feedback.feedback);
              $("#view-feedback").modal('show');
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

function fetchSubCategory(id){
  // var route = "{{route('admin.sub_category.fetch_subcategories_by_cat_id', ':id')}}";
  // var route = route.replace(":id", id);

  var route = "{{config('app.api_url')}}/fetch_subcategories_by_cat_id/"+id;

        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
              var subcategory = response.data.SubCategory;
              $(".populate_sub_categories").empty();
              console.log(subcategory.sub_category_name);
              if(subcategory) {
                $.each(subcategory, function(x,y) {
                  $(".populate_sub_categories").append(
                    `<option value=${y.id}> ${y.sub_category_name} </option`
                  );
                });
              } else {
                $(".populate_sub_categories").append(
                    `<option> No records found </option`
                );
              }
            } else if (response.fetch_subcategories_by_cat_id === 400) {
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


function fetchSubLocation(id){
  var route = "{{route('admin.fetch_sublocations', ':id')}}";
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
              var sublocation = response.data.SubLocation;
              $(".populate_sublocation").empty();
              // console.log(sublocation);
              if(sublocation) {
                $.each(sublocation, function(x,y) {
                  $(".populate_sublocation").append(
                    `<option> ${y.sub_location_name} </option`
                  );
                });
              } else {
                $(".populate_sublocation").append(
                    `<option> No records found </option`
                );
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
}

function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chnage Status Of This Feedback.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/change-status/feedback') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id'    : id
            },
            success: function(response) {
              var response = JSON.parse(response);
              if(response.status === 200) {
                toastr.success(response.message)
                reloadPage();
              } else if (response.status === 500) {
                toastr.error(response.message)
              }
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

</script>

@endsection