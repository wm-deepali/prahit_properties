@extends('layouts.app')

@section('title')
Manage Blogs
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
          <a href="{{ route('admin.createBlogView') }}"><button class="btn btn-primary btn-save"><i class="fas fa-plus"></i> Add Job</button></a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Blogs</li>
            <li class="breadcrumb-item active">Manage Blogs</li>
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
                      <th>Category</th>
                      <th>Heading</th>
                      <th>Featured</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($blogs) && count($blogs) > 0)
                      @foreach($blogs as $k => $v)
                        <tr id="{{$v->id}}">
                          <td>{{$k+1}}</td>
                          <td><img src="{{ asset('storage') }}/{{ $v->image }}" style="height: 60px;"></td>
                          <td>{{$v->getBlogCategory->name}}</td>
                          <td>{{$v->heading}}</td>
                          <td>
                            <select class="form-control" onchange="updateFeatureBlog('{{ $v->id }}')">
                                <option @if($v->featured == "No") selected @endif>Inactive</option>
                                <option @if($v->featured == "Yes") selected @endif>Active</option>
                            </select>
                          </td>
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
                              <li><a href="#" onclick="fetchData({{$v->id}});"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                              <li><a href="{{ route('admin.editBlog', $v->id) }}"><i class="fas fa-pencil-alt"></i></a></li>
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

<div class="modal" id="view-reasons">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">More Info.</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div>
          <center><h3>Description</h3></center>
          <p id="view-description"></p>
        </div>
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
        <h4 class="modal-title">Delete Blog</h4>
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

  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deleteBlog', ['id' => ':id'])}}";
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
    var route = "{{route('admin.blogInfo', ':id')}}";
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
          document.getElementById('view-description').innerHTML = response.data.picked.description;
          $("#view-reasons").modal('show');
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
        text: "Chnage Status Of This Blog.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ route('admin.blogChangeStatus') }}',
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

  function updateFeatureBlog(id) {
      $.ajax({
        url: '{{ route('admin.updateFeatureBlog') }}',
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

</script>

@endsection