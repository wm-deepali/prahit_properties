@extends('layouts.app')

@section('title')
Manage Features
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
          <h3 class="content-header-title">Home Page Settings</h3>
          <button class="btn btn-primary btn-save" data-target="#add-reason" data-toggle="modal"><i class="fas fa-plus"></i> Add Feature</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Home Page Settings</li>
            <li class="breadcrumb-item active">Manage Features</li>
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
                      <th>Heading</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($features as $k => $feature)
                      <tr>
                        <td>{{ $k+1 }}</td>
                        <td style="background-color: lightgray;"><img src="{{ asset('storage') }}/{{ $feature->image }}" style="height: 50px;"></td>
                        <td>{{ $feature->heading }}</td>
                        <td>{!! $feature->description !!}</td>
                        <td>@if($feature->status == 'Yes') Active @else Inactive  @endif</td>
                        <td>
                            <ul class="action">
                                @if($feature->status == 'Yes')
                                    <li><a style="cursor: pointer;" onclick="changeStatus('{{ $feature->id }}')"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                                @else
                                    <li><a style="cursor: pointer;" onclick="changeStatus('{{ $feature->id }}')"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                                @endif
                                <li><a href="#" onclick="fetchData('{{$feature->id}}');"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#" data-toggle="modal" data-target="#delete-category" onclick="$('#delete_category #id').val('{{$feature->id}}')"><i class="fas fa-trash"></i></a></li>
                            </ul>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $features->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal" id="add-reason">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.createFeatureContent') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Image</label>
                  <p style="color: red;"><b>Note:</b> <span>Image should be 1:1 and for better result please upload 80px x 80px .</span></p>
                  <input type="file" name="image" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-12">
                  <label class="label-control">heading</label>
                  <input type="text" name="heading" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-12">
                  <label class="label-control">Description</label>
                  <textarea name="description" class="form-control" required=""></textarea>
                </div>
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Feature</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="update-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.updateFeatureContent') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                  <label class="label-control">Image</label>
                  <p style="color: red;"><b>Note:</b> <span>Image should be 1:1 and for better result please upload 80px x 80px .</span></p>
                  <input type="file" name="image" class="form-control">
                  <img src="" id="render-image" style="height: 50px;">
                  <input type="hidden" name="id" id="render-id">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-12">
                  <label class="label-control">heading</label>
                  <input type="text" name="heading" id="render-heading" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-12">
                  <label class="label-control">Description</label>
                  <textarea name="up_description" id="render-description" class="form-control" required=""></textarea>
                </div>
            </div>
          </div>
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Update Feature</button>
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
        <h4 class="modal-title">Delete Feature</h4>
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

    $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deleteFeatureContent', ['id' => ':id'])}}";
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

    function fetchData(id){
        var route = "{{route('admin.getFeatureContent', ':id')}}";
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
              console.log(response);
              document.getElementById('render-id').value = response.data.picked.id;
              document.getElementById('render-image').src = '{{ asset('storage') }}/'+response.data.picked.image;
              document.getElementById('render-heading').value = response.data.picked.heading;
              CKEDITOR.instances['render-description'].setData(response.data.picked.description);
              $("#update-feature").modal('show');
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
        text: "Chnage Status Of This Feature.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ route('admin.changeStatusFeatureContent') }}',
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
</script>
@endsection