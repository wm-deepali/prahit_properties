@extends('layouts.app')

@section('title')
Manage Technologies
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
          <button class="btn btn-primary btn-save" data-target="#add-category" data-toggle="modal"><i class="fas fa-plus"></i> Add Technologies</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Job</li>
            <li class="breadcrumb-item active">Manage Technologies</li>
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
                      <th>Category</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($technologies) && count($technologies) > 0)
                      @foreach($technologies as $k => $v)
                        <tr id="{{$v->id}}">
                          <td>{{$k+1}}</td>
                          <td>{{$v->name}}</td>
                          <td>
                            @if($v->status == "Yes")
                              Active
                            @else 
                              Inactive
                            @endif
                          </td>
                          <td><ul class="action">
                              @if($v->status == 'Yes')
                                <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                              @else
                                <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                              @endif
                              <li><a href="#" onclick="fetchData({{$v->id}});"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#" data-toggle="modal" data-target="#delete-category" onclick="$('#delete_category #id').val({{$v->id}})"><i class="fas fa-trash"></i></a></li>
                            </ul></td>
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
        <h4 class="modal-title">Add Technology</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.storeJobTechnologies') }}">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Name</label>
              <input type="text" class="text-control" name="name" placeholder="Enter Technology Name" required />
            </div>
          </div>  
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Technology</button>
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
        <h4 class="modal-title">Update Technology</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="{{ route('admin.updateJobTechnologies') }}">
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Name</label>
              <input type="text" class="text-control" placeholder="Enter Name" id="category_name" name="name" required />
            </div>
          </div>
          
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Technology</button>
            </div>
          </div>

          <input type="hidden" id="category_id" name="category_id" value="" />
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
        <h4 class="modal-title">Delete Technology</h4>
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


  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deleteJobTechnology', ['id' => ':id'])}}";
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
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
  });

function fetchData(id){

  var route = "{{route('admin.getTechnologyInfo', ':id')}}";
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
              $(".update_category_modal #category_id").val(response.data.picked.id)
              $(".update_category_modal #category_name").val(response.data.picked.name)
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

function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chnage Status Of This Technology.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ route('admin.changeStatusTechnology') }}',
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