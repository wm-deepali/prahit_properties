@extends('layouts.app')

@section('title')
Add Form
@endsection

@section('css')
<style type="text/css">
.table-fitems tbody tr td:nth-child(2) {
    width: 60%;
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
            <img src="{{url('/').'/'.'images/loading.gif'}}" alt="Loading.." class="loading" />
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
              <form class="form-body" id="add_form_types" name="add_form_types">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Form Name</label>
                    <input type="text" class="text-control" placeholder="Enter Form Name" name="form_name" required />
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Assign to category:</label>
                    <div class="d-block">
                      @foreach($categories as $k=>$v)
                        <label><input type="checkbox" class="categories" name="assigned_to[]" value="{{$v->id}}" data-category-id="{{$v->id}}" />&nbsp; {{$v->category_name}} &nbsp;&nbsp;</label>
                      @endforeach

                    </div>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Sub Cateogry:</label>
                    <div class="d-block">
                      <select class="text-control populate_subcategories" onclick="loadSubcategories();" name="sub_category_id" required>
                        <option value="">Select</option>
                      </select>
                    </div>
                  </div>

                </div>


                <div class="form-group row">
                  @foreach($features as $k=>$v)
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems">
                        <thead>
                          <tr>
                            <th colspan="4"> {{$v->feature_name}} </th>
                          </tr>
                          <tr>
                            <th>Position</th>
                            <th>Label</th>
                            <th>Enable</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($v->subfeatures as $a=>$b)
                          <tr>
                            <td><input type="number" class="text-control" name="feature_position[]"  /></td>
                            <td> {{$b->sub_feature_name}} </td>
                            <td><input type="checkbox" name="feature_enabled[]" value="{{$b->sub_feature_name}}" /></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @endforeach

                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-add" type="submit">Add New Form</button>
                  </div>
                </div>

                {{ csrf_field() }}
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
$(function() {
    $("#add_form_types").validate({
      submitHandler:function() {
        var sel_category_ids = [];
        $('.categories:checkbox:checked').each(function(i){
          sel_category_ids[i] = $(this).val();
        });    

        if(sel_category_ids.length<1) {
          $('.populate_subcategories').empty().append('<option value="">Select</option>');
        }

        $.ajax({
          url: "{{route('admin.formtype.store')}}",
          method: "POST",
          data: $("#add_form_types").serialize(),
          beforeSend:function() {
            $(".loading").css('display', 'block');
            $(".btn-add").attr('disabled', true);
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              // setTimeout(function() {
              //   window.location.href = "{{route('admin.formtype.index')}}";
              // }, 1000);
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            toastr.error('An error occured')
          },
          complete: function() {
            $(".loading").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });
});


function loadSubcategories() {

    var sel_category_ids = [];
    $('.categories:checkbox:checked').each(function(i){
      sel_category_ids[i] = $(this).val();
    });    

    if(sel_category_ids.length<1) {
      $('.populate_subcategories').empty().append('<option value="">Select</option>');
      return true;
    }
    var route = "{{route('admin.sub_category.fetch_multiple_subcategories_by_cat_id')}}/?id="+sel_category_ids.join(',');

    $.ajax({
      url: route,
      method:"GET",
      beforeSend:function() {
        $(".loading").css('display','block');
        $(".categories").attr('disabled', true);
      },
      success: function(response) {
        var response = JSON.parse(response);
        if(response.status === 200) {
          var subcategories = response.data.SubCategory;
            if(subcategories.length>0) {
              $(".populate_subcategories").empty();
              $.each(subcategories, function(x,y) {
                $(".populate_subcategories").append(
                  `<option value=${y.id}> ${y.sub_category_name} </option>`
                );
              });
              $(".populate_subcategories option[value='']").remove();
            } else {
                  $(".populate_subcategories").append(
                    `<option value=''> No record found </option>`
                  );
            }
        }
      },
      error:function(response) {
        toastr.error('An error occured');
      },
      complete:function() {
        $(".loading").css('display','none');
        $(".categories").attr('disabled', false);
      }
    })
}
</script>


@endsection
