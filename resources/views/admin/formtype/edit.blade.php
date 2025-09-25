@extends('layouts.app')

@section('title')
Edit Formtype
@endsection

@section('css')
<style type="text/css">
/*.table-fitems tbody tr td:nth-child(2) {
    width: 60%;
}*/
.checkbox{
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
            <li class="breadcrumb-item active">Edit Form</li>
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
              <form class="form-body" id="update_form_type" name="update_form_type">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Form Name</label>
                    <input type="text" class="text-control" placeholder="Enter Form Name" name="form_name" value="{{$formtype->form_name}}" required />
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Assign to category:</label>
                    <div class="d-block">
                      @foreach($categories as $k=>$v)
                        <label>
                          @if(in_array($v->id, $selected_categories))
                            <input type="checkbox" class="categories" name="assigned_to[]" onclick="loadSubcategories();" value="{{$v->id}}" data-category-id="{{$v->id}}" checked />&nbsp; {{$v->category_name}} &nbsp;&nbsp;
                          @else
                            <input type="checkbox" class="categories" name="assigned_to[]" onclick="loadSubcategories();" value="{{$v->id}}" data-category-id="{{$v->id}}" />&nbsp; {{$v->category_name}} &nbsp;&nbsp;
                          @endif
                        </label>
                      @endforeach
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <label class="label-control">Sub Cateogry:</label>
                    <div class="d-block">
                      <select class="text-control populate_subcategories" multiple="" name="sub_category_id[]" required>
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
                          <tr class="tr">
                            <td> <input type="number" class="text-control text" name="sub_feature_position[]" 

                              value="{{isset($selected_subfeatures_position['sub_feature_id_'.$b->id]) ? $selected_subfeatures_position['sub_feature_id_'.$b->id] : ''}}" 

                             checked /></td>
                            <td> {{$b->sub_feature_name}} </td>
                            <td>
                              @if(in_array($b->id, $selected_subfeatures))
                                <input type="checkbox" name="sub_feature_enabled[]" value="{{$b->id}}" class="checkbox"  checked />
                              @else 
                                <input type="checkbox" name="sub_feature_enabled[]" value="{{$b->id}}" class="checkbox"   />
                              @endif
                            </td>
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
                    <button class="btn btn-primary btn-update" type="submit">Update Form</button>
                  </div>
                </div>

                <input type="hidden" name="id" id="id" value="{{$formtype->id}}" />

                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal" id="delete-category" class="delete-category">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Category</h4>
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
$(function() {
    loadSubcategories();

    $("#update_form_type").validate({
      submitHandler:function() {
        var route = "{{route('admin.formtype.update', ['formtype' => ':id'])}}";
        var route = route.replace(':id', $("#id").val());
        $.ajax({
          url: route,
          method: "PATCH",
          data: $("#update_form_type").serialize(),
          beforeSend:function() {
            document.getElementById('new_loader').style.display = 'block';
            $(".btn-update").attr('disabled', true);
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
            document.getElementById('new_loader').style.display = 'none';
          },
          error: function(response) {
            toastr.error('An error occured');
            document.getElementById('new_loader').style.display = 'none';
          },
          complete: function() {
            document.getElementById('new_loader').style.display = 'none';
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });

    $(".text").on('keyup', function() {
      var this_val = $(this).val();
      if(this_val != "") {
        $(this).parents('.tr:first').find('input:checkbox').attr("checked","checked");
      } else {
        $(this).parents('.tr:first').find('input:checkbox').attr("checked",false);
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

              // $(".populate_subcategories option").each(function(x,y) {
              //   if(!y.value.includes(sel_category_ids)) {
              //     $(this).remove();
              //   }
              // });

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
              $(".populate_subcategories").empty();
                  $(".populate_subcategories").append(
                    `<option value=''> No record found </option>`
                  );
            }
        } else {
          toastr.error('An error occured');
        }
      },
      error:function(response) {
        toastr.error('An error occured');
      },
      complete:function() {
        $(".loading").css('display','none');
        $(".categories").attr('disabled', false);
        markAsSelected();
      }
    })
}

function markAsSelected() {
  var subcats = "{{json_encode($selected_sub_categories)}}";

  $(".populate_subcategories option").each(function(x,y) {
    if(subcats.includes($(this).val())) {
      $(this).attr('selected', true)
    }
  });

}

</script>

@endsection

