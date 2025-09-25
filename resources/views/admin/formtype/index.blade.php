@extends('layouts.app')

@section('title')
Manage Formtypes
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Master</h3>
          <a class="btn btn-primary btn-save" href="{{route('admin.formtype.create')}}"><i class="fas fa-plus"></i> Add Form</a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Master Form Type</li>
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
                      <th>Form Name</th>
                      <th>Categories</th>
                      <th>Sub Categories</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($formtypes) && count($formtypes) > 0)
                      @foreach($formtypes as $k => $v)
                        <tr id="{{$v->id}}">
                          <td>{{$k+1}}</td>
                          <td>{{$v->name}}</td>
                          <td>{{ $v->getCategories($v->category_id) }}</td>
                          <td>{{ $v->getSubCategories($v->sub_category_id) }}</td>
                          <td>
                            @if($v->status == "No")
                              <span class="badge badge-danger">In-Active</span>
                            @else
                              <span class="badge badge-success">Active</span>
                            @endif
                          </td>
                          <td><ul class="action">
                              <li><a href="{{ url('master/custom/form/view/') }}/{{ $v->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                              @if($v->status == "No")
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-check-circle" aria-hidden="true"></i></a></li>
                              @else
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
                              @endif
                              <li><a href="{{ url('master/custom/form/edit/') }}/{{ $v->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a style="cursor: pointer;" onclick="deleteForm('{{ $v->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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


<div class="modal" id="delete-formtype" class="delete-formtype">
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
        <form id="delete_formtype" name="delete_formtype">
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
    $("#for_all").dataTable();
});

  function deleteForm(id) {
    swal({
        title: "Are you sure?",
        text: "Delete This Form.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          document.getElementById('new_loader').style.display = 'block';
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/custom/form/delete') }}',
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
              document.getElementById('new_loader').style.display = 'none';
              },
            error: function(response) {
              toastr.error('An error occured.');
              document.getElementById('new_loader').style.display = 'none';
            },
            complete: function() {
              document.getElementById('new_loader').style.display = 'none';
              $(".btn-delete").attr('disabled', false);
            }
          })
      }
    });
    
  }

  function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Change Status This Form.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          document.getElementById('new_loader').style.display = 'block';
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/custom/form/change-status') }}',
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
              document.getElementById('new_loader').style.display = 'none';
              },
            error: function(response) {
              toastr.error('An error occured.');
              document.getElementById('new_loader').style.display = 'none';
            },
            complete: function() {
              document.getElementById('new_loader').style.display = 'none';
              $(".btn-delete").attr('disabled', false);
            }
          })
      }
    });
    
  }

</script>


@endsection
