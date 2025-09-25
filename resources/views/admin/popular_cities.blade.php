@extends('layouts.app')

@section('title')
Popular Cities
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
          <h3 class="content-header-title">Master</h3>
          <button class="btn btn-primary btn-save" data-target="#add-city" data-toggle="modal"><i class="fas fa-plus"></i> Add City</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Home Page Settings</li>
            <li class="breadcrumb-item active">Popular Cities</li>
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
                      <th>Sr. No.</th>
                      <th>Heading</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>{{ $content->heading }}</td>
                      <td>
                          <ul class="action">
                              <li><a href="#" onclick="updateHeading('{{$content->id}}');"><i class="fas fa-pencil-alt"></i></a></li>
                            </ul>
                      </td>
                    </tr>
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

<section class="content-main-body">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Image</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($cities as $c => $city)
                        <tr>
                          <td>{{ $c + 1 }}</td>
                          <td><img src="{{ asset('storage') }}/{{ $city->image }}" style="height: 80px;"></td>
                          <td>{{ $city->getState ? $city->getState->name : '' }}</td>
                          <td>{{ $city->getCity ? $city->getCity->name : '' }}</td>
                          <td>
                            <ul class="action">
                              <li><a style="cursor: pointer;" onclick="updateCity('{{$city->id}}');"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a style="cursor: pointer;" data-toggle="modal" data-target="#delete-category" onclick="$('#delete_category #id').val('{{$city->id}}')"><i class="fas fa-trash"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
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

<div class="modal" id="add-city">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add City</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.createPopularCity') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">State </label>
              <select class="form-control" name="state" id="state" required="">
                <option value="">Select State </option>
                @foreach($states as $state)
                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-12">
              <label class="label-control">City </label>
              <select class="form-control" name="city" id="city" required="">
                
              </select>
            </div>
            <div class="col-sm-12">
              <label class="label-control">City Image</label>
              <input type="file" class="form-control" name="image" required="">
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add City</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="update-city">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update City</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.updatePopularCity') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <input type="hidden" name="id" id="city-id">
              <label class="label-control">State </label>
              <select class="form-control" name="state" id="render-state" required="">
                
              </select>
            </div>
            <div class="col-sm-12">
              <label class="label-control">City </label>
              <select class="form-control" name="city" id="render-city" required="">
                
              </select>
            </div>
            <div class="col-sm-12">
              <label class="label-control">City Image</label>
              <input type="file" class="form-control" name="image"><br>
              <img src="" id="render-image" style="height: 80px;">
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Update City</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="update-heading">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Content</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.updatePopularCity') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <input type="hidden" name="id" id="heading-id">
              <label class="label-control">Heading</label>
              <input type="text" class="form-control" name="heading" id="render-heading">
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Update</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="delete-category" class="delete-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete City</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_category" name="delete_category">
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'up_description' );

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
    };

    //-------------------- Get city By state --------------------//
    $('#state').on('change', function() {
        var state_id = this.value;
        $("#city").html('');
        $.ajax({
            url:"{{route('front.getCities')}}",
            type: "POST",
            data: {
                state_id: state_id,
                _token: '{{csrf_token()}}',
            },
            dataType : 'json',
            success: function(result){
                $('#city').html('<option value="">Select City</option>');
                $.each(result,function(key,city){
                  $("#city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                });
            }
        });
    });

    //-------------------- Get city By state --------------------//
    $('#render-state').on('change', function() {
        var state_id = this.value;
        $("#render-city").html('');
        $.ajax({
            url:"{{route('front.getCities')}}",
            type: "POST",
            data: {
                state_id: state_id,
                _token: '{{csrf_token()}}',
            },
            dataType : 'json',
            success: function(result){
                $('#render-city').html('<option value="">Select City</option>');
                $.each(result,function(key,city){
                  $("#render-city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                });
            }
        });
    });

    $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deletePopularCity', ['id' => ':id'])}}";
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
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
        },
        error: function(response) {
            toastr.error('An error occured.')
        },
        complete: function() {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
  });

    function updateCity(id){
        var route = "{{route('admin.popularCityGetContent', ':id')}}";
        var route = route.replace(":id", id);
        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            if(response.status === 200) {
              $('#render-state').html('<option value="">Select State</option>');
              $.each(response.data.picked.states,function(key,state){
                if(parseInt(response.data.picked.picked.state_id) == parseInt(state.id)){
                  $("#render-state").append('<option value="'+state.id+'" selected>'+state.name+'</option>');
                }else {
                  $("#render-state").append('<option value="'+state.id+'" >'+state.name+'</option>');
                }
              });
              $('#render-city').html('<option value="">Select City</option>');
              $.each(response.data.picked.cities,function(key,city){
                if(parseInt(response.data.picked.picked.city_id) == parseInt(city.id)){
                  $("#render-city").append('<option value="'+city.id+'" selected>'+city.name+'</option>');
                }else {
                  $("#render-city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                }
              });
              document.getElementById('city-id').value = response.data.picked.picked.id;
              document.getElementById('render-image').src = '{{ asset('storage') }}/'+response.data.picked.picked.image;
              $("#update-city").modal('show');
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

    function updateHeading(id){
        var route = "{{route('admin.popularCityGetContent', ':id')}}";
        var route = route.replace(":id", id);
        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            if(response.status === 200) {
              document.getElementById('heading-id').value = response.data.picked.picked.id;
              document.getElementById('render-heading').value = response.data.picked.picked.heading;
              $("#update-heading").modal('show');
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