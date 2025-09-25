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
          <h3 class="content-header-title">Master</h3>
          <button class="btn btn-primary btn-save" data-target="#add-feature" data-toggle="modal"><i class="fas fa-plus"></i> Add Feature</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Master Features</li>
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
                      <th>Feature</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($features) && count($features) > 0)
                      @foreach($features as $k=>$v)
                        <tr id="{{$v->id}}">
                          <td>{{$k+1}}</td>
                          <td>{{$v->feature_name}}</td>
                            <td>
                              @if($v->status == "0")
                                Active
                              @else 
                                Inactive
                              @endif
                            </td>

                          <td>
                            <ul class="action">
<!--                                 <li><a href="#" onclick="fetchData({{$v->id}})" title="Update Features"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#" data-toggle="modal" data-target="#delete-features" onclick="$('#delete_features #id').val({{$v->id}})"><i class="fas fa-times" title="Change Delete"></i></a></li> -->
                            <li><a href="#" onclick="fetchData({{$v->id}})" title="Edit Features"><i class="fas fa-pencil-alt"></i></a></li>
                            <li><a href="{{route('admin.features.edit', ['feature' => base64_encode($v->id)])}}" title="Update Sub Features"><i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="{{route('admin.features.edit_features_access')}}" title="Permission Access"><i class="fas fa-reply-all"></i></a></li>
                            <li><a href="#"><i class="fas fa-times" title="Change Status"></i></a></li>
                            <li><a href="#" data-toggle="modal" data-target="#delete-features" onclick="$('#delete_features #id').val({{$v->id}})"><i class="fas fa-trash" title="Delete Feature"></i></a></li>


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
  </div>
</section>


<div class="modal" id="add-feature">
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
        <form id="create_features" name="create_features">
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Feature</label>
              <input type="text" class="text-control" placeholder="Enter Feature Name" name="feature_name" required />
            </div>
          </div>
      
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Feature Input</label>
              <select class="text-control" name="input_type" required>
                <option value="">Select</option>
                <option value="1">Checkbox</option>
                <option value="2">Text field</option>
                <option value="3">Radio button</option>
                <option value="4">Textarea</option>
                <option value="5">Select Box</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="label-control">Feature Type</label>
              <select class="text-control" name="input_selectable" required>
                <option value="">Select</option>
                <option value="1">Single</option>
                <option value="2">Multiple</option>
              </select>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-save" type="submit">Add Feature</button>
            </div>
          </div>
          {{csrf_field()}}
        </form>
      </div>

    </div>
  </div>
</div>



<div class="modal" id="edit-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="edit-feature-form" name="edit-feature-form">
          <div class="form-group row">
            <div class="col-sm-12">
              <label class="label-control">Feature</label>
              <input type="text" class="text-control" placeholder="Enter Feature Name" id="feature_name" name="feature_name" required />
            </div>
          </div>  
      
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Feature Input</label>
              <select class="text-control" id="input_type" name="input_type" required>
                <option value="">Select</option>
                <option value="1">Checkbox</option>
                <option value="2">Text field</option>
                <option value="3">Radio button</option>
                <option value="4">Textarea</option>
                <option value="5">Select Box</option>
              </select>

            </div>
            <div class="col-sm-6">
              <label class="label-control">Feature Type</label>
              <select class="text-control" id="input_selectable" name="input_selectable" required>
                <option value="">Select</option>
                <option value="1">Single</option>
                <option value="2">Multiple</option>
              </select>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Feature</button>
            </div>
          </div>

          <input type="hidden" id="feature_id" name="feature_id" />
          {{csrf_field()}}
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal" id="delete-features" class="delete-features">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Features</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_features" name="delete_features">
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

    $("#create_features").validate({
      rules:{
        feature_slug:{
          restrict_special_chars: true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.features.store')}}",
          method: "POST",
          data: $("#create_features").serialize(),
          beforeSend:function() {
            $(".btn-save").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
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
            toastr.error('An error occured')
          },
          complete: function() {
            $(".btn-save").attr('disabled', false);
            $(".loading_2").css('display', 'none');
          }
        })
      }
    });


    $("#edit-feature-form").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.features.update', 1)}}",
          method: "PATCH",
          data: $("#edit-feature-form").serialize(),
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
           toastr.error('An error occured')
          },
          complete: function() {
            $("#edit-feature").modal('hide');
            $(".btn-update").attr('disabled', false);
            $(".loading_2").css('display', 'none');
          }
        })
      }
    });


  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      var id = $("#delete_features #id").val();
      var route = "{{route('admin.features.destroy', ':id')}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_features").serialize(),
        beforeSend:function() {
          $(".loading_2").css('display', 'block');
          $(".btn-update").attr('disabled', true);
        },
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-features").modal('hide');
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
          $(".btn-update").attr('disabled', false);
        }
      })
  });



function fetchData(id){
  var route = "{{route('admin.features.show', ':id')}}";
  var route = route.replace(':id', id);

        $.ajax({
          url: route,
          method: "GET",
          beforeSend: function function_name(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              $("#edit-feature-form #feature_id").val(response.data.Feature.id);
              $("#edit-feature-form #feature_name").val(response.data.Feature.feature_name)
              $("#edit-feature-form #input_type").val(response.data.Feature.input_type)
              $("#edit-feature-form #input_selectable").val(response.data.Feature.input_selectable)
              $("#edit-feature").modal('show');
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

@endsection('js')