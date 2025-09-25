@extends('layouts.app')

@section('title')
Manage Ads
@endsection

@section('content')

<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">
      <div class="loading">
        <img src="{{asset('images/loading.gif')}}" alt="Loading.." class="loading" />
      </div>
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <form class="form-body" id="ad_form" name="ad_form" enctype="multipart/form-data">
                <h4 class="form-section-h">Ad Information</h4>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Owner </label>
                    <input type="number" class="text-control" placeholder="Enter Owner Number" name="owner_mobile_number">
                    <span class="ad-span">Leave Blank If you want to add for self</span>
                  </div>
                  <div class="col-sm-2 align-self-center">
                    <button class="btn btn-dark" type="button">Verify</button>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-ads">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Arbaaz</td>
                            <td>im@gmail.com</td>
                            <td>9898989898</td>
                            <td>Individual</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Ad Name </label>
                    <input type="text" class="text-control" placeholder="Enter Ad Name" name="name" required />
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Position</label>
                    <select class="text-control" name="banner_type" required>
                      <option value="">Select Position</option>
                      <option value="1">250 x 250 – Square</option>
                      <option value="2">200 x 200 – Small Square</option>
                      <option value="3">468 x 60 – Banner</option>
                      <option value="4">728 x 90 – Leaderboard</option>
                      <option value="5">300 x 250 – Inline Rectangle</option>
                      <option value="6">336 x 280 – Large Rectangle</option>
                      <option value="7">120 x 600 – Skyscraper</option>
                      <option value="8">160 x 600 – Wide Skyscraper</option>
                      <option value="9">300 x 600 – Half-Page Ad</option>
                      <option value="10">970 x 90 – Large Leaderboard</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Ad Image</label>
                    <input type="file" class="text-control" name="thumbnail_file" required />
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Ad Type</label>
                    <select class="text-control" name="ad_type" required>
                      <option value="">Select Type</option>
                      <option value="1">Per Click</option>
                      <option value="2">Impressions</option>
                    </select>
                    <span class="ad-span">1 Click (<i class="fas fa-rupee-sign"></i> 12) - 100 Impressions (<i class="fas fa-rupee-sign"></i> 80)</span>
                  </div>
                  
                  <div class="col-sm-2">
                    <label class="label-control">Start Date</label>
                    <input type="date" class="text-control" placeholder="Select Start Date" name="start_date" required />
                  </div>
                  
                  <div class="col-sm-2">
                    <label class="label-control">End Date</label>
                    <input type="date" class="text-control" placeholder="Select End Date" name="end_date" required />
                  </div>
                  
                  <div class="col-sm-4">
                    <label class="label-control">Audience</label>
                    <select class="text-control" name="audience_id">
                      <option>Select Audience</option>
                      <option value="1">Audience 01</option>
                    </select>
                    <span class="ad-span">Leave blank if all auidence</span>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Budget</label>
                    <input type="text" class="text-control" placeholder="Enter Budget" name="budget" required />
                    <span class="ad-span">Min <i class="fas fa-rupee-sign"></i> 500</span>
                  </div>
                  
                  <div class="col-sm-4">
                    <label class="label-control">Ad Linked to</label>
                    <select class="text-control" id="add_linked_to" name="linked_to" required>
                      <option value="" selected>Select Type</option>
                      <option value="1">Property Page</option>
                      <option value="2">Custom Link</option>
                    </select>
                  </div>
                  
                  <div class="col-sm-4 my_ad_properties" style="display: none;">
                    <label class="label-control">My Properties</label>
                    <select class="text-control" name="property_id">
                      <option value="">Select Properties</option>
                    </select>
                  </div>
                  
                  <div class="col-sm-4 my_ad_customurl" style="display: none;">
                    <label class="label-control">Custom Link (URL)</label>
                    <input type="text" class="text-control" placeholder="Enter URL" name="custom_link" />
                  </div>
                </div>
                

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-add" type="submit">Submit Now <i class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


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
            } else if (response.status === 400) {
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
            } else if (response.status === 400) {
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
          } else if (response.status === 400) {
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

</script>

@endsection