@extends('layouts.app')

@section('title')
  Manage Amenities
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
            <button class="btn btn-primary btn-save" data-target="#add-category" data-toggle="modal"><i
                class="fas fa-plus"></i> Add Amenities</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Amenities</li>
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
                        <th>Image</th>
                        <th>Amenity</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($amenities) && count($amenities) > 0)
                        @foreach($amenities as $k => $v)
                          <tr id="{{$v->id}}">
                            <td>{{ $amenities->firstItem() + $k}}</td>
                            <td><img src="{{ asset('storage') }}/{{$v->icon}}" style="height: 50px;"></td>
                            <td>{{$v->name}}</td>
                            <td>
                              @if($v->status == "Yes")
                                Active
                              @else
                                Inactive
                              @endif
                            </td>
                            <td>
                              <ul class="action">
                                @if($v->status == 'Yes')
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-ban"
                                        aria-hidden="true"></i></a></li>
                                @else
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-check"
                                        aria-hidden="true"></i></a></li>
                                @endif
                                <li><a style="cursor: pointer;" onclick="fetchData('{{$v->id}}');"><i
                                      class="fas fa-pencil-alt"></i></a></li>
                                <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                                <li><a href="#" data-toggle="modal" data-target="#delete-category"
                                    onclick="$('#delete_category #id').val('{{$v->id}}')"><i class="fas fa-trash"></i></a>
                                </li>
                              </ul>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="5"> No records found </td>
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
      <div class="d-flex justify-content-center mt-3">
        {{ $amenities->links('pagination::bootstrap-4') }}
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
          <h4 class="modal-title">Add Amenity</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{ route('admin.createAmenities') }}" enctype="multipart/form-data">
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Icon</label>
                <p><strong>Note: Image should be 1:1 and for better result please upload 500px x 500px</strong></p>
                <input type="file" name="image" class="form-control" required="">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Amenity Name</label>
                <input type="text" class="text-control" name="name" placeholder="Enter Amenity Name" required />
              </div>
            </div>
            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Add Amenity</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="update-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Amenity</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{ route('admin.updateAmenities') }}" enctype="multipart/form-data">
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Icon</label>
                <p><strong>Note: Image should be 1:1 and for better result please upload 500px x 500px</strong></p>
                <input type="file" name="image" class="form-control">
                <img src="" id="view-icon" style="height: 50px;">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Amenity Name</label>
                <input type="text" class="text-control" name="name" id="name" placeholder="Enter Amenity Name" required />
              </div>
            </div>
            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Update Amenity</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="amenity_id" id="amenity_id" />
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
          <h4 class="modal-title">Delete Amenity</h4>
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

    function fetchData(id) {

      var route = "{{route('admin.getAmenitiesData', ':id')}}";
      var route = route.replace(":id", id);

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function (argument) {
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            document.getElementById('view-icon').src = '{{ asset('storage') }}/' + response.data.picked.icon;
            document.getElementById('amenity_id').value = response.data.picked.id;
            document.getElementById('name').value = response.data.picked.name;
            $("#update-category").modal('show');
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
          $(".loading").css('display', 'none');
        },
        error: function (response) {
          toastr.error('An error occured');
          $(".loading").css('display', 'none');
        }
      });
    }

    function changeStatus(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Chnage Status Of This Amenity.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '{{ route('admin.chnageStatusAmenities') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id
            },
            beforeSend: function () {
              $(".loading").css('display', 'block');
            },
            success: function (response) {
              swal('', response, 'success');
              setTimeout(function () {
                location.reload();
              }, 1000);
            },
            error: function (response) {
              $(".loading").css('display', 'none');
              swal('', response, 'error');
            },
            complete: function () {
              $(".loading").css('display', 'none');
            }
          })
        }
      });

    }

    $(".btn-delete").on('click', function (e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deleteAmenities', ['id' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_category").serialize(),
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            toastr.success(response.message)
            $("#delete-category").modal('hide');
            delete_row(id);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
        },
        error: function (response) {
          toastr.error('An error occured.')
        },
        complete: function () {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
    });

  </script>

@endsection