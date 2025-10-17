@extends('layouts.app')

@section('title')
  Edit Web Directory Sub Category
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

  <style type="text/css">
    .table-fitems tbody tr td:nth-child(2) {
      width: 60%;
    }
  </style>
  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Web Directory</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Edit Web Sub Category</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content-main-body">
    <div class="container-fluid">
      @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <ul class="p-0 m-0" style="list-style: none;">
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <form class="form-body" method="post"
                  action="{{ url('master/web-directory-sub-category') }}/{{ $picked->id }}">
                  @csrf
                  {{ method_field('PATCH') }}
                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="label-control">Category</label>
                      <select class="text-control" name="category_id" id="category_id" required="">
                        @if(isset($categories))
                          <option value="">Select Category</option>
                          @foreach($categories as $key => $value)
                            @if($picked->category_id == $value->id)
                              <option value="{{$value->id}}" cat-name="{{$value->category_name}}" selected="">
                                {{$value->category_name}}
                              </option>
                            @else
                              <option value="{{$value->id}}" cat-name="{{$value->category_name}}"> {{$value->category_name}}
                              </option>
                            @endif
                          @endforeach
                        @else
                          <option value=""> No records found </option>
                        @endif
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Sub Category</label>
                      <input type="text" placeholder="Enter Sub Category Name" id="sub_category_name" class="text-control"
                        onkeyup="autoFilledSlug()" name="sub_category_name" value="{{ $picked->sub_category_name }}"
                        required />
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Sub Category Slug</label>
                      <input type="text" placeholder="Enter Sub Category Slug" id="sub_category_slug"
                        value="{{ $picked->sub_category_slug }}" class="text-control" name="sub_category_slug" required />
                    </div>
                  </div>

                  <!-- <h4 class="form-section-h">Assigned To Property Category</h4>

                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="label-control">Property Available For</label>
                      <select class="text-control populate_categories" name="property_category_id"
                        onchange="fetch_subcategories(this.value, fetch_subsubcategories)" required="">
                        @if(count($p_categories) < 1)
                          <option value="">No records found</option>
                        @else
                          <option value="">Select Category</option>
                          @foreach($p_categories as $k => $v)
                            @if($picked->property_category_id == $v->id)
                              <option value="{{$v->id}}" selected="">{{$v->category_name}}</option>
                            @else
                              <option value="{{$v->id}}">{{$v->category_name}}</option>
                            @endif
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="label-control">Property Category</label>
                      <select class="text-control populate_subcategories" name="sub_category_id"
                        onchange="fetch_subsubcategories(this.value)" required>
                        <option value="">Select Sub Category</option>
                        @foreach($p_sub_categories as $k => $v)
                          @if($picked->sub_category_id == $v->id)
                            <option value="{{$v->id}}" selected="">{{$v->sub_category_name}}</option>
                          @else
                            <option value="{{$v->id}}">{{$v->sub_category_name}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div class="col-sm-4">
                      <label>Property Type</label>
                      <div id="sub_sub_category_list" class="border rounded p-2"
                        style="max-height:200px; overflow-y:auto;">
                        <div class="form-check mb-2">
                          <input type="checkbox" class="form-check-input" id="select_all_sub_sub">
                          <label class="form-check-label" for="select_all_sub_sub"><strong>Select All</strong></label>
                        </div>
                        <div id="sub_sub_category_items">
                          @if(isset($p_sub_sub_categories) && count($p_sub_sub_categories) > 0)
                            @foreach($p_sub_sub_categories as $v)
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sub_sub_category_ids[]"
                                  id="subsub_{{ $v->id }}" value="{{ $v->id }}" {{ in_array($v->id, $picked->sub_sub_category_id ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                  for="subsub_{{ $v->id }}">{{ $v->sub_sub_category_name }}</label>
                              </div>
                            @endforeach
                          @else
                            <p class="text-muted m-0">Select a property subcategory first</p>
                          @endif
                        </div>
                      </div>
                    </div>


                  </div> -->

                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button class="btn btn-primary" type="submit">Update Sub Category</button>
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

@endsection


@section('js')
  <script type="text/javascript">
    $(function () {

      // Select All toggle
      $(document).on('change', '#select_all_sub_sub', function () {
        var isChecked = $(this).is(':checked');
        $('#sub_sub_category_items input[type="checkbox"]').prop('checked', isChecked);
      });

      // Uncheck Select All if any individual is unchecked
      $(document).on('change', '#sub_sub_category_items input[type="checkbox"]', function () {
        var total = $('#sub_sub_category_items input[type="checkbox"]').length;
        var checked = $('#sub_sub_category_items input[type="checkbox"]:checked').length;
        $('#select_all_sub_sub').prop('checked', total === checked);
      });


      $("#add_form_types").validate({
        submitHandler: function () {
          var sel_category_ids = [];
          $('.categories:checkbox:checked').each(function (i) {
            sel_category_ids[i] = $(this).val();
          });

          if (sel_category_ids.length < 1) {
            $('.populate_subcategories').empty().append('<option value="">Select</option>');
          }

          $.ajax({
            url: "{{route('admin.formtype.store')}}",
            method: "POST",
            data: $("#add_form_types").serialize(),
            beforeSend: function () {
              $(".loading").css('display', 'block');
              $(".btn-add").attr('disabled', true);
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                // setTimeout(function() {
                //   window.location.href = "{{route('admin.formtype.index')}}";
                // }, 1000);
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              toastr.error('An error occured')
            },
            complete: function () {
              $(".loading").css('display', 'none');
              $(".btn-add").attr('disabled', false);
            }
          })
        }
      });

      $(".text").on('keyup', function () {
        var this_val = $(this).val();
        if (this_val != "") {
          $(this).parents('.tr:first').find('input:checkbox').attr("checked", "checked");
        } else {
          $(this).parents('.tr:first').find('input:checkbox').attr("checked", false);
        }
      });

    });



    function fetch_subcategories(id, callback) {
      var route = "{{config('app.api_url')}}/fetch_subcategories_by_cat_id/" + id
      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $(".addproperty").attr('disabled', true);
          $(".add_formtype").empty();
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          // var response = JSON.parse(response);
          if (response.responseCode === 200) {
            $(".populate_subcategories").empty();
            var subcategories = response.data.SubCategory;
            if (subcategories.length > 0) {
              $(".populate_subcategories").append(
                `<option value=""> Select </option>`
              );
              $.each(subcategories, function (x, y) {
                $(".populate_subcategories").append(
                  `<option value=${y.id}> ${y.sub_category_name} </option>`
                );
              });
            } else {
              $(".populate_subcategories").append(
                `<option value=''> Please add a sub category </option>`
              );
            }
            if (callback) {
              callback();
            }
          }
        },
        error: function (response) {
          toastr.error('An error occured while fetching subcategories');
        },
        complete: function () {
          $(".loading").css('display', 'none');
          // $(".addproperty").attr('disabled', false);
        }
      })
    }

    function fetch_subsubcategories(subCategoryId, preSelected = []) {
      var route = "{{ config('app.api_url') }}/fetch_subsubcategories_by_subcat_id/" + subCategoryId;

      $.ajax({
        url: route,
        method: 'get',
        beforeSend: function () {
          $("#sub_sub_category_items").html('<p class="text-muted m-0">Loading...</p>');
        },
        success: function (response) {
          if (response.responseCode === 200) {
            var subSubCategories = response.data.SubSubCategory;
            var html = '';

            if (subSubCategories.length > 0) {
              $.each(subSubCategories, function (i, v) {
                var checked = preSelected.includes(v.id) ? 'checked' : '';
                html += `<div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="sub_sub_category_ids[]" 
                                             id="subsub_${v.id}" value="${v.id}" ${checked}>
                                      <label class="form-check-label" for="subsub_${v.id}">${v.sub_sub_category_name}</label>
                                   </div>`;
              });
            } else {
              html = '<p class="text-muted m-0">No Property Types found</p>';
            }

            $("#sub_sub_category_items").html(html);

            // Update Select All checkbox state
            var total = $("#sub_sub_category_items input[type='checkbox']").length;
            var checkedCount = $("#sub_sub_category_items input[type='checkbox']:checked").length;
            $('#select_all_sub_sub').prop('checked', total === checkedCount);
          } else {
            $("#sub_sub_category_items").html('<p class="text-muted m-0">Error fetching property types</p>');
          }
        },
        error: function () {
          $("#sub_sub_category_items").html('<p class="text-muted m-0">Error fetching property types</p>');
        }
      });
    }


    function autoFilledSlug() {
      var e = document.getElementById("category_id");
      var option = e.options[e.selectedIndex];
      var category = option.getAttribute("cat-name");
      var sub_cat_name = $('#sub_category_name').val();
      var text1 = category.split(/\s/).join('');
      var text2 = sub_cat_name.split(/\s/).join('');
      document.getElementById('sub_category_slug').value = text1.toLowerCase() + '-' + text2.toLowerCase();
      console.log(text1);
      console.log(text2);
    }

  </script>


  @if(count($categories) < 1)
    <script type="text/javascript">
      $("#add_form_types").empty().append("<center class='m0-auto'>Please create categories to continue. </center>");  
    </script>

  @endif


@endsection