@extends('layouts.app')

@section('title')
  Add Form
@endsection

@section('css')
  <style type="text/css">
    /*.table-fitems tbody tr td:nth-child(2) {
              width: 60%;
          }*/
    .checkbox {
      pointer-events: none !important;
    }
  </style>
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
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Add Form</li>
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
                <form method="post" action="{{ route('admin.formtype.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-sm-3">
                      <label class="label-control">Form Name</label>
                      <input type="text" class="text-control" placeholder="Enter Form Name" name="form_name"
                        id="form_name" required />
                    </div>
                    <div class="col-sm-3">
                      <label class="label-control">Assign to Property Available For:</label>
                      <div class="d-block">
                        <select class="form-control" name="assigned_to" id="category_data">
                          <option value="">Select</option>
                          @foreach($categories as $v)
                            <option value="{{$v->id}}">{{$v->category_name}}</option>
                          @endforeach
                        </select>


                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label class="label-control">Cateogry:</label>
                      <div class="d-block">
                        <select class="text-control populate_subcategories" onchange="loadSubSubcategories()"
                          name="sub_category_id" id="sub_category_id">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label class="label-control">Property Type</label>
                      <select class="text-control populate_subsubcategories" name="sub_sub_category_id[]"
                        id="sub_sub_category_id" multiple onchange="check_availability()">
                        <option value="">Select Property Type</option>
                      </select>
                    </div>

                  </div>
                  <div class="row" style="margin-top: 20px;">
                    <div class="col-12">
                      <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Click on or drag and drop components onto the main panel to build your form content.
                      </div>

                      <div id="fb-editor" class="fb-editor"></div>
                    </div>
                  </div>
                  <div id="build-wrap-1"></div>
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <div class="btn-wrap"><button class="btn btn-primary btn-add" type="button" id="getData">Add New
                          Form</button></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">

  </script>
@endsection
@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script>
    jQuery(function ($) {
      var $fbTemplate1 = $(document.getElementById("build-wrap-1"));
      var formData = JSON.stringify([{ type: "text", label: "Input Label" }]);
      var formBuilder = $fbTemplate1.formBuilder({ formData });

      try {
        console.log(formBuilder.formData);
      } catch (err) {
        console.warn("formData not available yet.");
        console.error("Error: ", err);
      }

      formBuilder.promise.then(function (fb) {
        console.log(fb.formData);
      });


      document.getElementById("getData").addEventListener("click", function () {
        var form_name = $('#form_name').val();
        var category_data = $('#category_data').val();
        var sub_category_id = $('#sub_category_id').val();
        var sub_sub_category_id = $('#sub_sub_category_id').val(); // array

        if (form_name == '') {
          swal('', 'Form name field must be required', 'warning');
          return false;
        }
        if (!category_data) {
          swal('', 'Category field must be required', 'warning');
          return false;
        }
        if (!sub_category_id) {
          swal('', 'Subcategory field must be required', 'warning');
          return false;
        }
        if (!sub_sub_category_id || sub_sub_category_id.length === 0) {
          swal('', 'Property Type must be selected', 'warning');
          return false;
        }

        var form_json = formBuilder.formData;
        if (!form_json) {
          swal('', 'Invalid Form Format, Please Refresh Page & Create Again.', 'error');
          return false;
        }

        document.getElementById('new_loader').style.display = 'block';
        $(".btn-delete").attr('disabled', true);

        $.ajax({
          url: '{{ url('master/custom/form/create') }}',
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            'name': form_name,
            'categories': category_data,
            'subcategories': sub_category_id,
            'sub_sub_categories': sub_sub_category_id, // <--- send the array here
            'form_data': form_json
          },
          success: function (response) {
            var response = JSON.parse(response);
            if (response.status === 200) {
              toastr.success(response.message)
              setTimeout(function () {
                window.location = "{{route('admin.formtype.index')}}"
              }, 2000);
            } else if (response.status === 500) {
              toastr.error(response.message)
            }
            document.getElementById('new_loader').style.display = 'none';
          },
          error: function (response) {
            toastr.error('An error occurred.')
          },
          complete: function () {
            document.getElementById('new_loader').style.display = 'none';
            $(".btn-delete").attr('disabled', false);
          }
        })
      });


    });

    $(document).on('change', '#category_data', function () {
      loadSubcategories();
    });

    function loadSubcategories() {
      var sel_category_id = $('#category_data').val();

      if (sel_category_id.length < 1) {
        $('.populate_subcategories').empty().append('<option value="">Select</option>');
        return true;
      }

      var route = "{{route('admin.sub_category.fetch_multiple_subcategories_by_cat_id')}}/?id=" + sel_category_id;

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function () {
          $(".loading").css('display', 'block');
          $(".categories").attr('disabled', true);
          // $(".populate_subcategories option").each(function(x,y) {
          //   if(!y.value.includes(sel_category_id)) {
          //     $(this).remove();
          //   }
          // });
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            // $(".populate_subcategories option").empty();

            var subcategories = response.data.SubCategory;
            if (subcategories.length > 0) {
              $(".populate_subcategories").empty().append('<option value="">Select Category</option>');
              $.each(subcategories, function (x, y) {
                $(".populate_subcategories").append(
                  `<option value=${y.id}> ${y.sub_category_name} </option>`
                );
              });
              // $(".populate_subcategories option[value='']").remove();
            } else {
              $(".populate_subcategories").empty();
              $(".populate_subcategories").append(
                `<option value=''> No record found </option>`
              );
            }
          } else {
            toastr.error('An error occured');
          }
        },
        error: function (response) {
          toastr.error('An error occured');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          $(".categories").attr('disabled', false);
        }
      })
    }


    function loadSubSubcategories() {
      var sub_category_id = $('#sub_category_id').val();

      if (!sub_category_id) {
        $('.populate_subsubcategories').empty().append('<option value="">Select Property Type</option>');
        return true;
      }

      var route = "{{ url('get/sub-sub-categories') }}/" + sub_category_id;

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function () {
          $(".loading").show();
          $('#sub_sub_category_id').html('<option value="">Loading...</option>');
        },
        success: function (response) {
          // If your backend returns JSON string
          try {
            response = JSON.parse(response);
          } catch (e) { }

          if (response.subsubcategories && response.subsubcategories.length) {
            var subsubcategories = response.subsubcategories;

            $(".populate_subsubcategories").empty().append('<option value="">Select Property Type</option>');
            $.each(subsubcategories, function (x, y) {
              $(".populate_subsubcategories").append(
                `<option value="${y.id}">${y.sub_sub_category_name}</option>`
              );
            });
          } else {
            $(".populate_subsubcategories").html('<option value="">No property type found</option>');
          }
        },
        error: function () {
          toastr.error('Error loading property types.');
          $(".populate_subsubcategories").html('<option value="">Error loading</option>');
        },
        complete: function () {
          $(".loading").hide();
        }
      });
    }


    function check_availability() {
      var sel_category_id = $('#category_data').val();
      var sub_cats_id = $('#sub_category_id').val();
      var sub_sub_cats_id = $('#sub_sub_category_id').val(); // array

      if (!sel_category_id || !sub_cats_id || !sub_sub_cats_id || sub_sub_cats_id.length === 0) {
        toastr.warning('Please select category, subcategory, and property type.');
        $(".btn-add").attr('disabled', true);
        return;
      }

      // convert array to comma-separated string for GET route
      var sub_sub_cats_str = sub_sub_cats_id.join(',');

      var route = "{{ route('admin.category_to_formtype_availablity', ['cats' => ':cat_id', 'subcats' => ':sub_cat_id', 'subsubcats' => ':sub_sub_cat_id']) }}";
      route = route.replace(':cat_id', sel_category_id);
      route = route.replace(':sub_cat_id', sub_cats_id);
      route = route.replace(':sub_sub_cat_id', sub_sub_cats_str);

      $.ajax({
        url: route,
        method: 'GET',
        success: function (response) {
          try {
            response = JSON.parse(response);
          } catch (e) { }

          if (response.status === 400) {
            toastr.error(response.message);
            $(".btn-add").attr('disabled', true);
          } else {
            $(".btn-add").attr('disabled', false);
          }
        },
        error: function () {
          toastr.error('Error checking availability.');
        }
      });
    }


  </script>
@endsection