@extends('layouts.app')

@section('title')
Sub Features
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
          <button class="btn btn-primary btn-save" data-target="#add-sub-feature" data-toggle="modal"><i class="fas fa-plus"></i> Add Sub Feature</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Sub Features</li>
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
                      <th>#</th>
                      <th>Sub Feature Name</th>
                      <th>Sub Feature Slug</th>
                      <th>Sub Feature Meta Title</th>
                      <th>Sub Feature Meta Description</th>
                      <th>Sub Feature Meta Keywords</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($features->subfeatures) && count($features->subfeatures) > 0)
                      @foreach($features->subfeatures as $k=>$v)
                        <tr id="{{$v->id}}">
                          <td>{{$k+1}}</td>
                          <td>{{$v->sub_feature_name}}</td>
                          <td>{{$v->sub_feature_slug}}</td>
                          <td>{{$v->sub_feature_meta_title}}</td>
                          <td>{{$v->sub_feature_meta_description}}</td>
                          <td>{{$v->sub_feature_keywords}}</td>
                          <td><ul class="action">
                              <li><a href="#" onclick="fetchData({{$v->id}})"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#"><i class="fas fa-trash"></i></a></li>
                            </ul>
                          </td>

                        </tr>
                      @endforeach
                    @else 
                      <tr>
                        <td colspan="7"> No records found </td>
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



<div class="modal" id="add-sub-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Sub Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="add-sub-feature-form" name="add-sub-feature-form">

          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Sub Feature</label>
              <input type="text" class="text-control" placeholder="Enter Sub Feature Name" name="sub_feature_name" onchange="populate_slug('sub_feature_slug', this);" required />
            </div>
      <div class="col-sm-6">
              <label class="label-control">Sub Feature Slug</label>
              <input type="text" class="text-control" placeholder="Enter Feature Slug" id="sub_feature_slug" name="sub_feature_slug"  />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Sub Feature Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Sub Feature Meta Title" name="sub_feature_meta_title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Sub Feature Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Sub Feature Meta Description" name="sub_feature_meta_description" required></textarea>
            </div>
        <div class="col-sm-6">
              <label class="label-control">Sub Feature Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" placeholder="Enter Sub Feature Meta Keywords" name="sub_feature_keywords"></textarea>
            </div>
          </div>
        
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-save" type="submit">Add Feature</button>
            </div>
          </div>

          <input type="hidden" id="feature_id" name="feature_id" value="{{$features->id}}" />
          <input type="hidden" name="_token" value="{{csrf_token()}}" />

        </form>
      </div>
    </div>
  </div>
</div>




<div class="modal" id="update-sub-feature">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Feature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="loading_2">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="update_subfeature" name="update_subfeature">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Feature</label>
              <input type="text" class="text-control" placeholder="Enter Feature Name" id="sub_feature_name" name="sub_feature_name" required />
            </div>
      <div class="col-sm-6">
              <label class="label-control">Feature Slug</label>
              <input type="text" class="text-control" placeholder="Enter Feature Slug" id="sub_feature_slug" name="sub_feature_slug" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Title</label>
              <input type="text" class="text-control" placeholder="Enter Meta Title" id="sub_feature_meta_title" name="sub_feature_meta_title" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Meta Description</label>
              <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" id="sub_feature_meta_description" name="sub_feature_meta_description" required>   </textarea>
            </div>
        <div class="col-sm-6">
              <label class="label-control">Meta Keywords</label>
              <textarea class="text-control" rows="3" cols="3" placeholder="Enter Meta Keywords" id="sub_feature_keywords" name="sub_feature_keywords"> </textarea>
            </div>
          </div>
        
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-update" type="submit">Update Feature</button>
            </div>
          </div>

          <input type="hidden" id="sub_feature_id" name="sub_feature_id"  />
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

    $("#add-sub-feature-form").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.create_subfeature')}}",
          method: "POST",
          data: $("#add-sub-feature-form").serialize(),
          beforeSend:function() {
            $(".loading_2").css('display', 'block');
            $(".btn-update").attr('disabled', true);
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
              toastr.error('An error ocured')
            }
          },
          error: function(response) {
            toastr.error('An error ocured')
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });



    $("#update_subfeature").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.update_subfeature', ['id' => 1])}}",
          method: "POST",
          data: $("#update_subfeature").serialize(),
          beforeSend:function() {
            $(".loading_2").css('display', 'block');
            $(".btn-update").attr('disabled', true);
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
              toastr.error('An error ocured')
            }
          },
          error: function(response) {
            toastr.error('An error ocured')
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });

});

function fetchData(id){
  var route = "{{route('admin.fetch_subfeature', ['id' => ':id'])}}";
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
              $("#update_subfeature #sub_feature_id").val(response.data.SubFeature.id);
              $("#update_subfeature #sub_feature_name").val(response.data.SubFeature.sub_feature_name)
              $("#update_subfeature #sub_feature_slug").val(response.data.SubFeature.sub_feature_slug)
              $("#update_subfeature #sub_feature_meta_title").val(response.data.SubFeature.sub_feature_meta_title)
              $("#update_subfeature #sub_feature_meta_description").val(response.data.SubFeature.sub_feature_meta_description)
              $("#update_subfeature #sub_feature_keywords").val(response.data.SubFeature.sub_feature_keywords)
              $("#update-sub-feature").modal('show');
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