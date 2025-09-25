@extends('layouts.app')

@section('title')
Update Features
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Master</h3>
          <button class="btn btn-primary btn-save" data-target="#add-feature" data-toggle="modal"><i class="fas fa-plus"></i> Add Feature</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Update Master Features</li>
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
                      <th>Name</th>
                      <th>URL Slug</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$features->feature_name}}</td>
                      <td>{{$features->feature_slug}}</td>
                      <td>
                        @if($features->status == "0")
                          Active
                        @else 
                          Inactive
                        @endif
                      </td>

                      <td><ul class="action">
                          <li><a href="#" data-target="#update-feature" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a></li>
                          <li><a href="#"><i class="fas fa-times"></i></a></li>
                          <li><a href="#"><i class="fas fa-trash"></i></a></li>
                        </ul></td>
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

<div class="modal" id="add-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="create_features" name="create_features">

          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Feature</label>
              <input type="text" class="text-control" placeholder="Enter Feature Name" name="feature_name" required />
            </div>
      <div class="col-sm-6">
              <label class="label-control">Feature Slug</label>
              <input type="text" class="text-control" placeholder="Enter Feature Slug" name="feature_slug" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" name="feature_meta_title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" name="feature_meta_description" required></textarea>
            </div>
        <div class="col-sm-6">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" placeholder="Enter Meta Keywords" name="feature_keywords"></textarea>
            </div>
          </div>
        
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-save" type="submit">Add Feature</button>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{csrf_token()}}" />

        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="update-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="loading_2">
        <img src="{{url('/').'/'.'images/loading.gif'}}" alt="Loading.." class="loading" />
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="update_features" name="update_features">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Feature</label>
              <input type="text" class="text-control" placeholder="Enter Feature Name" value="{{$features->feature_name}}" name="feature_name" required />
            </div>
      <div class="col-sm-6">
              <label class="label-control">Feature Slug</label>
              <input type="text" class="text-control" placeholder="Enter Feature Slug" value="{{$features->feature_slug}}" name="feature_slug" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" value="{{$features->feature_meta_title}}" name="feature_meta_title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" name="feature_meta_description" required> {{$features->feature_meta_description}} </textarea>
            </div>
        <div class="col-sm-6">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" placeholder="Enter Meta Keywords"  name="feature_keywords">{{$features->feature_keywords}}</textarea>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-save" type="submit">Update Feature</button>
            </div>
          </div>

          <input type="hidden" name="feature_id" value="{{$features->id}}" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('js')

<script type="text/javascript">
$(function() {

    $("#create_features").validate({
      submitHandler:function() {
        $(".loading_2").css('display', 'block');
        $.ajax({
          url: "{{route('admin.manage-features.store')}}",
          method: "POST",
          data: $("#create_features").serialize(),
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
          }
        })
      }
    });


    $("#update_features").validate({
      submitHandler:function() {
        $(".loading_2").css('display', 'block');
        $.ajax({
          url: "{{route('admin.manage-features.update', ['id' => 1])}}",
          method: "PATCH",
          data: $("#update_features").serialize(),
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
          }
        })
      }
    });


});
</script>

@endsection