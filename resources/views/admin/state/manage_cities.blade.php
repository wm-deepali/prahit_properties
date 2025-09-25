@extends('layouts.app')

@section('title')
Manage Cities
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
          <button class="btn btn-primary btn-save" data-target="#add-category" data-toggle="modal"><i class="fas fa-plus"></i> Add City</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Cities</li>
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
                <table class="table table-bordered table-fitems" id="cities">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>State Name</th>
                      <th>Name</th>
                      <th>Total Locations</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($id != 'all' && $id != null)
                    @php
                      $cities = App\City::where('state_id', $id)->get();
                      foreach($cities as $c => $city) {
                             $state = App\State::find($city->state_id);
                    @endphp
                     <tr>
                       <td>{{ $c + 1 }}</td>
                       <td>{{ $state ? $state->name : 'N/A' }}</td>
                       <td>{{ $city->name }}</td>
                       <td>{{ $city->location }}</td>
                       <td>
                         <ul class="action">
                             <li><a href="{{ route('admin.locations.index', ['city_id' => $city->id]) }}" title="Manage Locations"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                             <li>
                                 <a href="#" title="Edit City" onclick="fetchData('{{ $city->id }}')"><i class="fas fa-edit"></i></a>
                             </li>
                             <li>
                                 <a href="#" title="Delete City" onclick="deleteCity('{{ $city->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                             </li>
                         </ul>
                       </td>
                     </tr>
                     @php
                           }
                    @endphp
                  @else
                    @php
                       App\City::orderBy('id', 'ASC')->chunk(50000, function($rows) {
                           $cities = [];
                           foreach($rows as $c => $city) {
                             $state = App\State::find($city->state_id);
                     @endphp
                     <tr>
                       <td>{{ $c + 1 }}</td>
                       <td>{{ $state ? $state->name : 'N/A' }}</td>
                       <td>{{ $city->name }}</td>
                       <td>{{ $city->location }}</td>
                       <td>
                         <ul class="action">
                             <li><a href="{{ route('admin.locations.index', ['city_id' => $city->id]) }}" title="Manage Locations"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                             <li>
                                 <a href="#" title="Edit City" onclick="fetchData('{{ $city->id }}')"><i class="fas fa-edit"></i></a>
                             </li>
                             <li>
                                 <a href="#" title="Delete City" onclick="deleteCity('{{ $city->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                             </li>
                         </ul>
                       </td>
                     </tr>
                     @php
                           }
                       });
                    @endphp
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

<div class="modal" id="add-category">
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
        <form method="post" action="{{ route('admin.createCity') }}">
        @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Select State</label>
              <select class="form-control" name="state" required="">
                <option value="">Select State</option>
                @foreach($states as $state)
                  <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-12" style="margin-top: 20px;">
              <label class="label-control">City Name</label>
              <input type="text" class="text-control" name="name" placeholder="Enter City Name"  required />
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

<div class="modal update_category_modal" id="update-category">
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
        <form method="post" action="{{ route('admin.updateCity') }}">
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Select State</label>
              <select class="form-control" name="state"  id="render-state" required="">
                <option value="">Select State</option>
              </select>
            </div>

            <div class="col-sm-12" style="margin-top: 20px;">
              <label class="label-control">City Name</label>
              <input type="text" class="text-control" id="city_name" name="name" required />
            </div>
      
          </div>
          
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update City</button>
            </div>
          </div>

          <input type="hidden" id="city_id" name="city_id" value="" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        </form>
      </div>
    </div>
  </div>
</div>




@endsection

@section('js')

<script type="text/javascript">

  $(document).ready( function () {
    $('#cities').DataTable();
  });

//-------------------- Manage pending lead listing ----------------------//
  // $(function () {
  //     var table = $('#cities').DataTable({
  //         processing: true,
  //         serverSide: true,
  //         render: true,
  //         searching: true,
  //         ajax: "{{ route('admin.manageCitiesDatatable') }}/{{ $id }}",
  //         columns: [
  //             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
  //             {data: 'state_name', name: 'state_name'},
  //             {data: 'name', name: 'name'},
  //             {data: 'location_count', name: 'location_count'},
  //             {data: 'action', name: 'action'},
  //         ],
  //     });
  // });

$(function() {
    jQuery.validator.addMethod("restrict_special_chars", function(value, element) {
        if(value.length == 0 && value == "") {
          return true;
        }
        if (/[a-zA-Z0-9-]$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, 'Special characters not allowed. Please try again.');

    $("#create_category").validate({
      rules:{
        category_slug:{
          restrict_special_chars: true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.category.store')}}",
          method: "POST",
          data: $("#create_category").serialize(),
          beforeSend:function() {
            $(".btn-add").attr('disabled', true);
            document.getElementById('new_loader').style.display = 'block';
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            document.getElementById('new_loader').style.display = 'none';
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
            document.getElementById('new_loader').style.display = 'block';
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
            document.getElementById('new_loader').style.display = 'none';
          }
        })
      }
    });
});


  function deleteCity(id) {
    swal({
        title: "Are you sure?",
        text: "Delete This City.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ route('admin.deleteCity') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id'    : id
            },
            beforeSend:function() {
              $(".loading").css('display', 'block');
            },
            success: function(response) {
              swal('', response, 'success');
              setTimeout(function() {
                location.reload();
              }, 1000);
            },
            error: function(response) {
              $(".loading").css('display', 'none');
              swal('', response, 'error');
            },
            complete: function() {
              $(".loading").css('display', 'none');
            }
          })
      }
    });
    
  }

function fetchData(id){

  var route = "{{route('admin.cityInfo', ':id')}}";
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
              $('#render-state').html('<option value="">Select State</option>');
              $.each(response.data.data.states,function(key,state){
                if(parseInt(response.data.data.city.state_id) == parseInt(state.id)) {
                  $("#render-state").append('<option value="'+state.id+'" selected>'+state.name+'</option>');
                }else {
                  $("#render-state").append('<option value="'+state.id+'" >'+state.name+'</option>');
                }
              });
              $(".update_category_modal #city_id").val(response.data.data.city.id)
              $(".update_category_modal #city_name").val(response.data.data.city.name)
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