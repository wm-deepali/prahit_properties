@extends('layouts.app')

@section('title')
Update Sub Location
@endsection

@section('content')


<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Sub Location</h3>
          <button class="btn btn-primary btn-save" data-target="#add-sub-location" data-toggle="modal"><i class="fas fa-plus"></i> Add Sub Location</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Maharshtra</li>
            <li class="breadcrumb-item active">Sub Location</li>
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
                <table class="table table-bordered table-fitems">
                  <thead>
                    <tr>
                      <th>State</th>
                      <th>City</th>
                      <th>Location</th>
                      <th>Sub Location</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($location->sublocations) > 0)
                      @foreach($location->sublocations as $k=>$v)
                      <tr id="{{$v->id}}">
                        <td>{{$location->getState->name}}</td>
                        <td>{{$location->Cities->name}}</td>

                        <td>{{$location->location}}</td>
                        <td>{{$v->sub_location_name}}</td> 
                        <td>Active</td>
                        <td>
                          <ul class="action">
                            <li><a href="#" onclick="fetchData('{{$v->id}}')" ><i class="fas fa-pencil-alt"></i></a></li>
                            <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                            <li><a href="#" data-toggle="modal" data-target="#delete-sublocation" onclick="$('#delete_sublocation #id').val({{$v->id}})"><i class="fas fa-trash"></i></a></li>
                          </ul>
                        </td>
                      </tr>
                      @endforeach
                    @else 
                      <tr>
                        <td colspan="6"> No records found </td>
                      </tr>
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
<div class="modal" id="add-sub-location">
	<div class="modal-dialog">
		<div class="modal-content">

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add Sub Location</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="create_sublocation" name="create_sublocation">
<!-- 					<div class="form-group row">
						<div class="col-sm-6">
							<label class="label-control">State</label>
							<select class="text-control populate_states" name="state_id" onchange="update_cities(this.value, (()=>{}))">
                @foreach($states as $k=>$v)
                  <option value="{{$v->id}}">{{$v->city_state}}</option>
                @endforeach
              </select>
						</div>
						<div class="col-sm-6">
							<label class="label-control">City</label>
							<select class="text-control populate_cities" name="city_id">
                <option value="">Select City</option>
              </select>
						</div>
					</div> -->
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="label-control">Location</label>
							<select class="text-control populate_locations" name="location_id" required >
                <option value="{{$location->id}}">{{$location->location}}</option>
							</select>
						</div>
						<div class="col-sm-6">
							<label class="label-control">Sub Location</label>
							<input type="text" class="text-control" placeholder="Enter Sub Location" name="sub_location_name" required />
						</div>
					</div>
					<div class="form-action row">
						<div class="col-sm-12 text-center">
							<button class="btn btn-primary btn-add" type="submit">Add Sub Location</button>
						</div>
					</div>

					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="edit-sub-location">
	<div class="modal-dialog">
		<div class="modal-content">

	      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
	      </center>

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Edit Sub Location</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="update_sublocation" name="update_sublocation">
<!-- 					<div class="form-group row">
						<div class="col-sm-6">
							<label class="label-control">State</label>
							<select class="text-control populate_states" name="state_id" onchange="update_cities(this.value, (()=>{}))">
                @foreach($states as $k=>$v)
                  @if($saved_state->id == $v->id)
                    <option value="{{$v->id}}" selected="">{{$v->city_state}}</option>
                  @else
                    <option value="{{$v->id}}">{{$v->city_state}}</option>
                  @endif
                @endforeach
              </select>
						</div>
						<div class="col-sm-6">
							<label class="label-control">City</label>
							<select class="text-control populate_cities" name="city_id">
                <option value="{{$saved_city->id}}">{{$saved_city->city_name}}</option>
              </select>
						</div>
					</div> -->
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="label-control">Location</label>
							<select class="text-control" name="location_id" required>
                @foreach($locations as $k=>$v)
                  @if($location->id == $v->id)
                    <option value="{{$v->id}}" selected="">{{$v->location}}</option>
                  @else
                    <option value="{{$v->id}}">{{$v->location}}</option>
                  @endif
                @endforeach
							</select>
						</div>
						<div class="col-sm-6">
							<label class="label-control">Sub Location</label>
							<input type="text" class="text-control" placeholder="Enter Sub Location" id="edit_sub_location_name"  name="sub_location_name" required />
						</div>
					</div>
					<div class="form-action row">
						<div class="col-sm-12 text-center">
							<button class="btn btn-primary btn-update" type="submit">Update Sub Location</button>
						</div>
					</div>
					<input type="hidden" id="sub_location_id" name="sub_location_id"  />

					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="delete-sublocation" class="delete-sublocation">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_sublocation" name="delete_sublocation">
          <div class="form-group row">
            <center> Are you sure you want to delete this? </center>
          </div>      

          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-delete" type="submit">Delete</button>
            </div>
          </div>  

          <input type="hidden" name="id" id="id" />
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('js')
<script type="text/javascript">
$(function() {
    $("#create_sublocation").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.create_sublocation')}}",
          method: "POST",
          data: $("#create_sublocation").serialize(),
          beforeSend:function() {
            $(".btn-add").attr('disabled', true);
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
            toastr.error('An error message')
          },
          complete: function() {
    			$(".modal").modal('hide');
            $(".loading_2").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });


    $("#update_sublocation").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.update_sublocation')}}",
          method: "post",
          data: $("#update_sublocation").serialize(),
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
            } else {
                toastr.error('An error occured!')
            }
          },
          error: function(response) {
            toastr.error('An error message')
          },
          complete: function() {
    			  $(".modal").modal('hide');            	
              $(".btn-update").attr('disabled', false);
              $(".loading_2").css('display', 'none');
            }
        })
      }
    });
});




function fetchData(id){
		// var route = "{{route('admin.fetch_sublocations', ['id' => ':id'])}}";
		// var route = route.replace(':id', id);
    var route = "{{config('app.api_url')}}/fetch_sublocation/"+id;

        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function function_name(argument) {
            document.getElementById('new_loader').style.display = 'block';
            $(".btn-add").attr('disabled', true);
          },
          success: function(response) {
            if(response.responseCode === 200) {
              $("#edit_sub_location_name").val(response.data.SubLocation.sub_location_name);
              $("#sub_location_id").val(response.data.SubLocation.id);
              $("#edit-sub-location").modal('show');
            } else {
              toastr.error('An error occured');
              document.getElementById('new_loader').style.display = 'none';
            }

          },
          error: function(response) {
            toastr.error('An error occured');
            document.getElementById('new_loader').style.display = 'none';
          },
          complete:function() {
            document.getElementById('new_loader').style.display = 'none';
            $(".btn-add").attr('disabled', false);
          }
        });
}


  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_sublocation #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.delete_sublocation', ['id' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_sublocation").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-sublocation").modal('hide');
            delete_row(id);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
          document.getElementById('new_loader').style.display = 'none';
        },
        error: function(response) {
            toastr.error('An error occured.')
            document.getElementById('new_loader').style.display = 'none';
        },
        complete: function() {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
  });


  function update_cities(sel_state_id, callback) {

  var route =  "{{route('cities_states', ['id' => ':id'])}}";
  var route = route.replace(':id', sel_state_id);

  $(".populate_cities").empty();
  $.ajax({
    url: route,
    method: "GET",
    beforeSend:function() {
      $(".loading_2").css('display', 'block');
      $(".btn-update").attr('disabled', true);
    },
    success: function(response) {
      if(response) {
        var cities = response;
        $.each(cities, function(x,y) {
          $(".populate_cities").append(
            `
              <option value=${y.id}> ${y.city_name} </otion>
            `
          );
        });

      } else {
        toastr.error('Cities not found.')
      }
    },
    error: function(response) {
      toastr.error('An error occured');
    },
    complete: function() {
      $(".loading_2").css('display', 'none');
      $(".btn-update").attr('disabled', false);
      callback();
    }
  });

  // callback();
}


</script>

@endsection
