@extends('layouts.app')

@section('title')
Manage Ads
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{url('/').'/'.'images/loading.gif'}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Ads Management</h3>
          <button class="btn btn-primary btn-save" onclick="window.location.href='{{route('admin.manage-ads.create')}}'"><i class="fas fa-plus"></i> Add Ads</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Ads Management</li>
            <li class="breadcrumb-item active">Manage Ads</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-ads" id="for_all">
                  <thead>
                    <tr>
                      <th>Ad Name</th>
                      <th>Owner</th>
                      <th>Type</th>
                      <th>Position</th>
                      <th>Click</th>
                      <th>Impression</th>
                      <th>Cost per</th>
                      <th>Amount Spent</th>
                      <th>Start - End</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($ads))
                      @foreach($ads as $k=>$v)
                        <tr>
                          <td>
                          <div class="ad-name">
                            <h3><a href="#" data-target="#ad-info" data-toggle="modal">{{$v->Property->title}}</a></h3>
                            <ul class="actn-btn">
                              <li><a href="view-ad-analytics.php"><i class="fas fa-chart-area"></i> View Analytics</a></li>
                              <li><a href="edit-ads.php"><i class="fas fa-pencil-alt"></i> Edit Ad</a></li>
                            </ul>
                          </div>
                          </td>
                          <td><a href="#" data-target="#owner-details" data-toggle="modal">Owner</a></td>
                          <td>
                            @if($v->ad_type == "1")
                              Per Click
                            @else 
                              Impressions
                            @endif
                          </td>
                          <td>
                            @if($v->ad_type == "1")
                              Square (250x250)
                            @elseif($v->ad_type == "2")
                              Small Square (200x200)
                            @elseif($v->ad_type == "2")
                              Banner (468x60)
                            @elseif($v->ad_type == "2")
                              Leaderboard (728x90)
                            @elseif($v->ad_type == "2")
                              Inline Rectangle (300x250)
                            @elseif($v->ad_type == "2")
                              Large Rectangle (336x280)
                            @elseif($v->ad_type == "2")
                              SkyScraper (120x600)
                            @elseif($v->ad_type == "2")
                              Wide SkyScraper (160x600)
                            @elseif($v->ad_type == "2")
                              Half Page Ad (300x600)
                            @elseif($v->ad_type == "2")
                              Large Leaderboard (970x90)
                            @endif
                          </td>
                          <td>12</td>
                          <td>1200</td>
                          <td>Click (<i class="fas fa-rupee-sign"></i> 5) / Impression (<i class="fas fa-rupee-sign"></i> 199)</td>
                          <td><i class="fas fa-rupee-sign"></i> 900 of 1000</td>
                          <td>12.10.2020 - 13.10.2020</td>
                          <td>
                            <ul class="action">
                              <li><button class="btn btn-danger btn-sm" type="button">Stop</button></li>
                              <li><a href="#" title="Approve Ad"><i class="fas fa-check"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
                    @endif
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

<div class="modal custom-white" id="owner-details">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Owner Information</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
      <div class="col-sm-4 align-self-center">
        <div class="dealer-prop">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png" class="img-fluid">
          <button class="btn btn-blue-p mt-3" type="button">View Profile</button>
        </div>
      </div> 
      <div class="col-sm-8 align-self-center">
        <div class="dealer-content">
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Name</label>
              <h3 class="content-head">Arbaaz</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Email</label>
              <h3 class="content-head">im@gmail.com</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Mobile No.</label>
              <h3 class="content-head">9898989898</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Property Posted</label>
              <h3 class="content-head">12</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Type</label>
              <h3 class="content-head">Agent</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Location</label>
              <h3 class="content-head">Lucknow / UP</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>

<div class="modal custom-white" id="ad-info">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ad Information</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Ad Title</th>
            <td>Meri Property</td>
          </tr>
          
          <tr>
            <th>Ad Image (Banner - 728x90)</th>
            <td><img src="images/logo.png" class="img-fluid" style="height: 30px;"></td>
          </tr>
          
          <tr>
            <th>Ad Type</th>
            <td>Per Click</td>
          </tr>
          
          <tr>
            <th>Ad Linked to</th>
            <td>Property - <a href="#">View</a></td>
          </tr>
        </table>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>

@endsection



@section('js')

<script type="text/javascript">

$(document).on("submit", "#ad_form", function(event) {
    event.preventDefault();
    $(this).validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.manage-ads.store')}}",
          method: "POST",
          data: new FormData($("#ad_form")[0]),
          datatype:'json',
          processData: false,
          contentType: false,
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              reloadPage();
            } elseif (response.status === 400) {
              toastr.error(response.message)
            } else {
              toastr.error('An error occured')
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });




    $("#update_category").validate({
      rules:{
        category_slug:{
          restrict_special_chars: true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.category.update', ['category' => 1])}}",
          method: "PATCH",
          data: $("#update_category").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              reloadPage();
            } elseif (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".update_category_modal").modal('hide');
            $(".btn-update").attr('disabled', false);
            $(".loading_2").css('display', 'none');
          }
        })
      }
    });
});


  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      $(".loading_2").css('display', 'block');
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.category.destroy', ['category' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_category").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-category").modal('hide');
            delete_row(id);
          } elseif (response.status === 400) {
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
  });

function fetchData(id){

  var route = "{{route('admin.category.show', ':id')}}";
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
              $(".update_category_modal #category_id").val(response.data.Category.id)
              $(".update_category_modal #category_name").val(response.data.Category.category_name)
              $(".update_category_modal #edit_category_slug").val(response.data.Category.category_slug)
              $(".update_category_modal #category_meta_title").val(response.data.Category.category_meta_title)
              $(".update_category_modal #category_meta_description").val(response.data.Category.category_meta_description)
              $(".update_category_modal #category_keywords").val(response.data.Category.category_keywords)
              $(".update_category_modal #category_keywords").val(response.data.Category.category_keywords)
              $(".update_category_modal").modal('show');
            } elseif (response.status === 400) {
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

</script>

@endsection