@extends('layouts.app')

@section('title')
Manage Sub Category
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
          <a class="btn btn-primary btn-save" href="{{route('admin.web-directory-sub-category.create')}}"><i class="fas fa-plus"></i> Add Sub Category</a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Sub Category</li>
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
                      <th>Property Category</th>
                      <th>Property Sub Category</th>
                      <th>Property Sub Sub Category</th>
                      <th>Category</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($datas) && count($datas) > 0)
                      @foreach($datas as $c=>$t)
                        <tr id="{{$t->id}}">
                          <td>{{$c+1}}</td>
                          <td> {{ $t->getPropertyCategory ? $t->getPropertyCategory->category_name : '' }} </td>
                          <td> {{ $t->getPropertySubCategory ? $t->getPropertySubCategory->sub_category_name : '' }} </td>
                          <td> {{ $t->getPropertySubSubCategory ? $t->getPropertySubSubCategory->sub_sub_category_name : '' }} </td>
                          <td> {{ $t->WebDirectoryCategory->category_name }} </td>
                          <td> {{ $t->sub_category_name }} </td>
                          <td> {{ $t->sub_category_slug }} </td>
                          <td>
                            @if($t->status == "Yes")
                              Active
                            @else 
                              Inactive
                            @endif
                          </td>
                          <td><ul class="action">
                              <li><a href="{{ url('master/edit/sub-directory/') }}/{{ $t->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                              <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                              <li><a href="#" data-toggle="modal" data-target="#delete-sub-category" onclick="$('#delete_sub_category #id').val({{$t->id}})"><i class="fas fa-trash"></i></a></li>
                            </ul></td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="12"> No records found </td>
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





<div class="modal" id="delete-sub-category" class="delete-sub-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Sub Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="delete_sub_category" name="delete_sub_category">
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

    $("#create_sub_category").validate({
      rules: {
        // sub_sub_category_slug: 'restrict_special_chars'
        sub_category_slug: {
          restrict_special_chars:true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.sub-category.store')}}",
          method: "POST",
          data: $("#create_sub_category").serialize(),
          beforeSend:function() {
            $(".btn-add").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $("#add-sub-category").modal('hide');
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });


    $("#update_sub_category").validate({
      rules: {
        // sub_sub_category_slug: 'restrict_special_chars'
        sub_category_slug: {
          restrict_special_chars:true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.sub-category.update', ':id')}}",
          method: "PATCH",
          data: $("#update_sub_category").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".update_sub_category_modal").modal('hide');
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });
});



  $(".btn-delete").on('click', function(e) {
      e.preventDefault();
      $(".loading_2").css('display', 'block');
      $(".btn-delete").attr('disabled', true);

      var id = $("#delete_sub_category #id").val();
      $.ajax({
        url: '{{ url('master/web-directory-sub-category') }}/'+id,
        method: "DELETE",
        data: $("#delete_sub_category").serialize(),
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            toastr.success(response.message)
            $("#delete-sub-category").modal('hide');
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
          $(".btn-delete").attr('disabled', false);
        }
      })
  });


function fetchData(id){
        $.ajax({
          url: "{{route('admin.sub-category.show', '')}}"+"/"+id,
          method: "GET",
          beforeSend: function function_name(argument) {
            $(".loading").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              $(".update_sub_category_modal #sub_category_id").val(response.data.SubCategory.id)
              $(".update_sub_category_modal #sub_category_name").val(response.data.SubCategory.sub_category_name)
              $(".update_sub_category_modal #edit_sub_category_slug").val(response.data.SubCategory.sub_category_slug)
              $(".update_sub_category_modal #sub_category_meta_title").val(response.data.SubCategory.sub_category_meta_title)
              $(".update_sub_category_modal #sub_category_meta_description").val(response.data.SubCategory.sub_category_meta_description)
              $(".update_sub_category_modal #sub_category_keywords").val(response.data.SubCategory.sub_category_keywords)
              $(".update_sub_category_modal #sub_category_keywords").val(response.data.SubCategory.sub_category_keywords)
              $(".update_sub_category_modal").modal('show');
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