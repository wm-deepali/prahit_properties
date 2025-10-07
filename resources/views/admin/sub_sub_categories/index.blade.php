@extends('layouts.app')

@section('title')
  Manage Property Type
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
            <button class="btn btn-primary btn-save" data-target="#add-sub-sub-category" data-toggle="modal"><i
                class="fas fa-plus"></i> Add Property Type</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Property Type</li>
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
                        <th>Property Available For</th>
                        <th>Category</th>
                        <th>Property Type</th>
                        <th>URL Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($subsubcategories) && count($subsubcategories) > 0)
                        @foreach($subsubcategories as $k => $v)
                          <tr id="{{$v->id}}">
                            <td>{{ $subsubcategories->firstItem() + $k}}</td>
                            <td>{{$v->subcategory->category->category_name}}</td>
                            <td>{{$v->subcategory->sub_category_name}}</td>
                            <td>{{$v->sub_sub_category_name}}</td>
                            <td>{{$v->sub_sub_category_slug}}</td>
                            <td>
                              @if($v->status == "0")
                                Active
                              @else
                                Inactive
                              @endif
                            </td>
                            <td>
                              <ul class="action">
                                <li><a href="#" onclick="openModal('edit', '{{$v->id}}', '{{$v->category_id}}');"><i
                                      class="fas fa-pencil-alt"></i></a></li>
                                <!-- <li><a href="#"><i class="fas fa-times"></i></a></li> -->
                                <li><a href="#" onclick="openModal('delete', '{{$v->id}}');"><i class="fas fa-trash"></i></a>
                                </li>
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
        <div class="d-flex justify-content-center mt-3">
        {{ $subsubcategories->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </section>

  <div class="modal" id="add-sub-sub-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center class="loading">
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading_2" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Property Type</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="create_sub_sub_category" name="create_sub_sub_category">
            <div class="form-group row">
              <div class="col-sm-6 form-group">
                <label class="label-control">Property Available For</label>
                <select class="text-control populate_categories"
                  onchange="remove_invalid_option();load_subcategories(this.value);" name="category_id">
                  <option value="">Select</option>
                  @foreach($categories as $k => $v)
                    <option value="{{$v->id}}">{{$v->category_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Category</label>
                <select class="text-control populate_subcategories" id="sub_category" name="sub_category_id" required />
                <option value="">Select Category</option>
                </select>
              </div>


              <div class="col-sm-6 form-group">
                <label class="label-control">Property Type</label>
                <input type="text" class="text-control" placeholder="Enter Property Type" required
                  id="sub_sub_category_name" name="sub_sub_category_name"
                  onchange="populate_slug('sub_sub_category_slug', this);" />
              </div>


              <div class="col-sm-6 form-group">
                <label class="label-control">Slug</label>
                <input type="text" class="text-control" placeholder="Enter Slug" id="sub_sub_category_slug"
                  name="sub_sub_category_slug" />
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Title</label>
                <input type="text" class="text-control" placeholder="Enter Meta Title" required
                  name="sub_sub_category_meta_title" />
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Description</label>
                <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description" required
                  name="sub_sub_category_meta_description" /></textarea>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Keywords</label>
                <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Keywords" required
                  name="sub_sub_category_keywords" /></textarea>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Price Label</label>
                <select class="form-control" name="price_label_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Property Status</label>
                <select class="form-control" name="property_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Registration Status</label>
                <select class="form-control" name="registration_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Furnishing Status</label>
                <select class="form-control" name="furnishing_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Amenities</label>
                <select class="form-control" name="amenities_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>
            </div>


            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Add Property Type</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="edit-sub-sub-category" class="edit-sub-sub-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Property Type</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="update_sub_sub_category" name="update_sub_sub_category">
            <div class="form-group row">
              <div class="col-sm-6 form-group">
                <label class="label-control">Property Available For</label>
                <select class="text-control populate_categories" onchange="remove_invalid_option()" name="category_id"
                  id="category_id">
                  <option value="">Select</option>
                  @foreach($categories as $k => $v)
                    <option value="{{$v->id}}">{{$v->category_name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Category</label>
                <select class="text-control populate_subcategories" id="sub_category_id" name="sub_category_id">
                  <option value="">Select Category</option>
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Property Type</label>
                <input type="text" class="text-control" placeholder="Enter Property Type" name="sub_sub_category_name"
                  id="sub_sub_category_name" onchange="populate_slug('edit_sub_sub_category_slug', this);" required />
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Slug</label>
                <input type="text" class="text-control" placeholder="Enter Slug" name="sub_sub_category_slug"
                  id="edit_sub_sub_category_slug" />
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Title</label>
                <input type="text" class="text-control" placeholder="Enter Meta Title" name="sub_sub_category_meta_title"
                  id="sub_sub_category_meta_title" required />
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Description</label>
                <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Description"
                  name="sub_sub_category_meta_description" id="sub_sub_category_meta_description" required></textarea>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Meta Keywords</label>
                <textarea class="text-control" rows="2" cols="3" placeholder="Enter Meta Keywords"
                  name="sub_sub_category_keywords" id="sub_sub_category_keywords" required></textarea>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Price Label</label>
                <select class="form-control" name="price_label_toggle" id="edit_price_label_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Property Status</label>
                <select class="form-control" name="property_status_toggle" id="edit_property_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Registration Status</label>
                <select class="form-control" name="registration_status_toggle" id="edit_registration_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-6 form-group">
                <label class="label-control">Furnishing Status</label>
                <select class="form-control" name="furnishing_status_toggle" id="edit_furnishing_status_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <div class="col-sm-6 form-group">
                <label class="label-control">Amenities</label>
                <select class="form-control" name="amenities_toggle" id="edit_amenities_toggle">
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select>
              </div>

              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-update" type="submit">Update Property Type</button>
              </div>
            </div>

            <input type="hidden" id="sub_sub_category_id" name="sub_sub_category_id" value="" />

            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal" id="delete-sub-sub-category" class="delete-sub-sub-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Property Type</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="delete_sub_sub_category" name="delete_sub_sub_category">
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
    $(function () {

      jQuery.validator.addMethod("restrict_special_chars", function (value, element) {
        if (value.length == 0 && value == "") {
          return true;
        }
        if (/[a-zA-Z0-9-]$/.test(value)) {
          return true;  // FAIL validation when REGEX matches
        } else {
          return false;   // PASS validation otherwise
        };
      }, 'Special characters not allowed. Please try again.');

      $("#create_sub_sub_category").validate({
        rules: {
          // sub_sub_category_slug: 'restrict_special_chars'
          sub_sub_category_slug: {
            restrict_special_chars: true
          }
        },
        submitHandler: function () {
          $(".loading_2").css('display', 'block');
          $.ajax({
            url: "{{route('admin.sub-sub-category.store')}}",
            method: "POST",
            data: $("#create_sub_sub_category").serialize(),
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                $("#add-sub-sub-category").modal('hide');
                reloadPage();
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              console.log(response)
            },
            complete: function () {
              $(".loading_2").css('display', 'none');
            }
          })
        }
      });


      $("#update_sub_sub_category").validate({
        rules: {
          // sub_sub_category_slug: 'restrict_special_chars'
          sub_sub_category_slug: {
            restrict_special_chars: true
          }
        },
        submitHandler: function () {
          $(".loading_2").css('display', 'block');
          var route = "{{route('admin.sub-sub-category.update', ':id')}}";
          var route = route.replace(':id', $("#edit-sub-sub-category #sub_sub_category_id").val());
          $.ajax({
            url: route,
            method: "PATCH",
            data: $("#update_sub_sub_category").serialize(),
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                $("#edit-sub-sub-category").modal('hide');
                reloadPage();
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              console.log(response)
            },
            complete: function () {
              $(".loading_2").css('display', 'none');
            }
          })
        }
      });
    });


    $(".btn-delete").on('click', function (e) {
      e.preventDefault();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);

      var id = $("#delete_sub_sub_category #id").val();
      var route = "{{route('admin.sub-sub-category.destroy', ':id')}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_sub_sub_category").serialize(),
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            toastr.success(response.message)
            $("#delete-sub-sub-category").modal('hide');
            delete_row(id);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
        },
        error: function (response) {
          toastr.error('An error occured.');
          document.getElementById('new_loader').style.display = 'none';
        },
        complete: function () {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', true);
        }
      })
    });





    function openModal(type, id = null, cat_id = null) {
      if (type == "edit") {
        // load_subcategories(cat_id, function () {
        fetchData(id)
        // })
      } else {
        $("#delete_sub_sub_category #id").val(id);
        $("#delete-sub-sub-category").modal('show');
      }
    }


    function fetchData(id) {
      var route = "{{route('admin.sub-sub-category.show', ':id')}}";
      var route = route.replace(':id', id);


      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function function_name(argument) {
          document.getElementById('new_loader').style.display = 'block';
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            $("#edit-sub-sub-category #sub_sub_category_id").val(response.data.SubCategory.id)
            $("#edit-sub-sub-category #category_id").val(response.data.SubCategory.category_id);
            // $("#edit-sub-sub-category #category_id").change();
            $("#edit-sub-sub-category #sub_category_id").val(response.data.SubCategory.sub_category_id);
            $("#edit-sub-sub-category #sub_sub_category_name").val(response.data.SubCategory.sub_sub_category_name)
            $("#edit-sub-sub-category #edit_sub_sub_category_slug").val(response.data.SubCategory.sub_sub_category_slug)
            $("#edit-sub-sub-category #sub_sub_category_meta_title").val(response.data.SubCategory.sub_sub_category_meta_title)
            $("#edit-sub-sub-category #sub_sub_category_meta_description").val(response.data.SubCategory.sub_sub_category_meta_description)
            $("#edit-sub-sub-category #sub_sub_category_keywords").val(response.data.SubCategory.sub_sub_category_keywords)
            $("#edit-sub-sub-category #sub_sub_category_keywords").val(response.data.SubCategory.sub_sub_category_keywords)
            $("#edit_price_label_toggle").val(response.data.SubCategory.price_label_toggle);
            $("#edit_property_status_toggle").val(response.data.SubCategory.property_status_toggle);
            $("#edit_registration_status_toggle").val(response.data.SubCategory.registration_status_toggle);
            $("#edit_furnishing_status_toggle").val(response.data.SubCategory.furnishing_status_toggle);
            $("#edit_amenities_toggle").val(response.data.SubCategory.amenities_toggle)

            $(".populate_categories").change();
            $("#edit-sub-sub-category").modal('show');
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
          document.getElementById('new_loader').style.display = 'none';
        },
        error: function (response) {
          toastr.error('An error occured');
          document.getElementById('new_loader').style.display = 'none';
        }
      });
    }



    function load_subcategories(id, callback = null) {
      if (!id) {
        return false;
      }
      // var route = "{{route('admin.sub_category.fetch_subcategories_by_cat_id', ':id')}}";
      // var route = route.replace(':id', id);
      var route = "{{ url('get/sub-categories') }}/" + id

      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".btn-add, .btn-update").attr('disabled', true);
          $(".loading_2").css('display', 'block');
        },
        success: function (response) {
          // var response = JSON.parse(response);
          if (response.status === 200) {
            $(".populate_subcategories").empty();
            var SubCategory = response.subcategories;
            if (SubCategory.length > 0) {
              $(".populate_subcategories").removeClass('error');
              $("#sub_category-error").remove();
              $.each(SubCategory, function (x, y) {
                $(".populate_subcategories").append(
                  `
                          <option value=${y.id}> ${y.sub_category_name} </option>
                        `
                );
              });
            } else {
              $(".populate_subcategories").append(
                `
                          <option value=''> No records found </option>
                        `
              );
            }

            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          // console.log(response);
          response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete: function () {
          $(".btn-add, .btn-update").attr('disabled', false);
          $(".loading_2").css('display', 'none');
        }
      });
    }


    function remove_invalid_option() {
      $(".populate_categories option[value='']").remove();
    }

  </script>

@endsection