@extends('layouts.app')

@section('title')
Update Features Access
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
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Update Features Access (Amenities)</li>
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
        <div class="form-group row">
        <div class="col-sm-3">
          <label class="label-control">Category</label>
          <select class="text-control" id="select_category" name="category_id">
            <!-- <option>Select Category</option> -->
          </select>
        </div>
        <div class="col-sm-3 align-self-end">
          <button type="submit" class="btn btn-filternow filter_by_category" onclick="loadCategoryTree($('#select_category').val())"><i class="fas fa-search"></i> Filter Now</button>
        </div>
        </div>
          <div class="form-group row">
        <div class="col-sm-6">
          <div class="table-responsive">
                  <table class="table table-bordered table-fitems subcategory">
                      <thead>
                        <tr>
                            <th colspan="4">Sub Category</th>
                        </tr>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                  </div>
        </div>
        <div class="col-sm-6">
          <div class="table-responsive">
                  <table class="table table-bordered table-fitems subsubcategory">
                      <thead>
              <tr>
                            <th colspan="4">Sub Sub Category</th>
                        </tr>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                  </div>
        </div>
        </div>
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
  window.is_category_loaded = false;
  loadCategoryTree();
});

function loadCategoryTree(value = 'all') {
        $(".loading").css('display', 'block');
        $(".subcategory tbody, .subsubcategory tbody").empty();
        $.ajax({
          url: "{{route('admin.category.fetch_category_tree')}}/?cat="+value,
          method: "GET",
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              var categories = response.data.CategoryTree;

              $.each(categories, function(a,b) {
                if(!window.is_category_loaded) {
                  // populate categories
                  $("#select_category").append(
                    `<option value=${b.id}> ${b.category_name} </option>`
                  );
                }

                // populate subcategories
                $.each(categories[a].subcategory, function(c,d) {
                  $(".subcategory tbody").append(
                    `<tr>
                      <td>
                        ${c+1}
                      </td>
                      <td>
                        ${d.sub_category_name}
                      </td>
                      <td>
                        ${d.status == "0" ? 'Active' : "Inactive"}
                      </td>
                      <td>
                        <ul class="action">
                          <li><a href="#"><i class="fas fa-times" title="Change Status"></i></a></li>
                        </ul>
                      </td>
                     </tr>
                    `
                  );

                  $.each(categories[a].subcategory[c].subsubcategory, function(c,d) {
                    $(".subsubcategory tbody").append(
                      `<tr>
                        <td>
                          ${c+1}
                        </td>
                        <td>
                          ${d.sub_sub_category_name}
                        </td>
                        <td>
                          ${d.status == "0" ? 'Active' : "Inactive"}
                        </td>
                        <td>
                          <ul class="action">
                            <li><a href="#"><i class="fas fa-times" title="Change Status"></i></a></li>
                          </ul>
                        </td>
                       </tr>
                      `
                    );
                  });


                });

              });


            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            toastr.error('An error occured');
          },
          complete: function() {
            $(".loading").css('display', 'none');

            var subcategory_tbody = ".subcategory tbody";
            var subcategory_tbody_tr = ".subcategory tbody tr";

            var subsubcategory_tbody = ".subsubcategory tbody";
            var subsubcategory_tbody_tr = ".subsubcategory tbody tr";

            if($(subcategory_tbody_tr).length == "0") {
              $(subcategory_tbody).append(
                `
                  <tr>
                    <td colspan='4'> No Records Found </td>
                  </tr>
                `
              );
            }

            if($(subsubcategory_tbody_tr).length == "0") {
              $(subsubcategory_tbody).append(
                `
                  <tr>
                    <td colspan='4'> No Records Found </td>
                  </tr>
                `
              );
            }

            window.is_category_loaded = true;
          }
        })
}

</script>

@endsection