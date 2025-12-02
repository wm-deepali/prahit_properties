@extends('layouts.app')

@section('title')
  Manage Complaints
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
            <h3 class="content-header-title">Property</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.properties.index')}}">Manage Property</a></li>
              <li class="breadcrumb-item active">View Property Feedback</li>
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

                <!-- ========== TABS ========== -->
                <ul class="nav nav-tabs" id="feedbackTabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#complaints">Complaints</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#feedbacks">Feedback</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#agent">Agent Not Reachable</a>
                  </li>
                </ul>

                <!-- ========== TAB CONTENT ========== -->
                <div class="tab-content pt-3">

                  <!-- COMPLAINT TAB -->
                  <div class="tab-pane fade show active" id="complaints">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems" id="tableComplaints" style="width:1336px;">
                        <thead>
                          <tr>
                            <th>Property Title</th>
                            <th>User Details</th>
                            <th>What's Wrong</th>
                            <th>Feedback</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                  <!-- FEEDBACK TAB -->
                  <div class="tab-pane fade" id="feedbacks">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems" id="tableFeedbacks" style="width:1336px;">
                        <thead>
                          <tr>
                            <th>Property Title</th>
                            <th>User Details</th>
                            <th>Feedback</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                  <!-- AGENT ISSUE TAB -->
                  <div class="tab-pane fade" id="agent">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems" id="tableAgent" style="width:1336px;">
                        <thead>
                          <tr>
                            <th>Property Title</th>
                            <th>User Details</th>
                            <th>Issue Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                </div>
                <!-- END TAB CONTENT -->

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- ================= PROPERTY DETAILS MODAL ================= -->
  <div class="modal custom-white" id="property_info">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Property Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <div class="form-group row">
            <div class="col-sm-4 align-self-center">
              <div class="dealer-prop">
                <img
                  src="https://images.livemint.com/rf/Image-621x414/LiveMint/Period1/2013/08/13/Photos/house--621x414.jpg"
                  class="img-fluid listing_thumbnail">
              </div>
            </div>

            <div class="col-sm-8 align-self-center">
              <div class="dealer-content">

                <div class="row">
                  <div class="col-sm-12">
                    <label class="content-label">Title</label>
                    <h3 class="content-head title">2BHK in Hazratganj</h3>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label class="content-label">Category</label>
                    <h3 class="content-head category">Rent</h3>
                  </div>

                  <div class="col-sm-6">
                    <label class="content-label">Sub Category</label>
                    <h3 class="content-head subcategory">Commercial</h3>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label class="content-label">Sub Sub Cat</label>
                    <h3 class="content-head subsubcategory">Flat</h3>
                  </div>

                  <div class="col-sm-6">
                    <label class="content-label">Package</label>
                    <h3 class="content-head">Basic</h3>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label class="content-label">Location</label>
                    <h3 class="content-head location">Mumbai, MH</h3>
                  </div>

                  <div class="col-sm-6">
                    <label class="content-label">Property ID</label>
                    <h3 class="content-head property_id">374923843</h3>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </div>

@endsection



@section('js')

  <script type="text/javascript">

    $(function () {

      // Adjust DataTable columns when tab is shown
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
      });


      // ------------ COMPLAINTS TABLE ------------
      $("#tableComplaints").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        sAjaxSource: "{{ route('admin.manage-feedback.complaints') }}",
        scrollX: true,       // enable horizontal scrolling
        autoWidth: false,    // prevent auto width calculation issues
        columns: [
          { data: "property_title" },
          { data: "user_details" },
          { data: "complaint" },
          { data: "feedback" },
          { data: "action" }
        ]
      });

      // ------------ FEEDBACK TABLE ------------
      $("#tableFeedbacks").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        sAjaxSource: "{{ route('admin.manage-feedback.feedbacks') }}",
        scrollX: true,       // enable horizontal scrolling
        autoWidth: false,    // prevent auto width calculation issues
        columns: [
          { data: "property_title" },
          { data: "user_details" },
          { data: "feedback" },
          { data: "action" }
        ]
      });

      // ------------ AGENT NOT REACHABLE TABLE ------------
      $("#tableAgent").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        sAjaxSource: "{{ route('admin.manage-feedback.agent') }}",
        scrollX: true,       // enable horizontal scrolling
        autoWidth: false,    // prevent auto width calculation issues
        columns: [
          { data: "property_title" },
          { data: "user_details" },
          { data: "agent_issue" },
          { data: "action" }
        ]
      });

    });


    // ================= FETCH PROPERTY DETAILS =================
    function fetchPropertyDetails(id) {
      var route = "{{ route('admin.properties.show', ':id') }}";
      route = route.replace(":id", id);

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function () {
          $(".loading").css('display', 'block');
        },
        success: function (response) {

          response = JSON.parse(response);

          if (response.status === 200) {
            const property = response.data.Property;

            // Thumbnail
            if (property.property_gallery && property.property_gallery.length > 0) {
              $(".listing_thumbnail").attr('src',
                "{{ config('app.url') }}/public/" + property.property_gallery[0].image_path
              );
            } else {
              $(".listing_thumbnail").attr('src', "https://via.placeholder.com/150");
            }

            $(".title").text(property.title ?? 'N/A');
            $(".category").text(property.category?.category_name ?? 'N/A');
            $(".subcategory").text(property.sub_category?.sub_category_name ?? 'N/A');
            $(".subsubcategory").text(property.sub_sub_category?.sub_category_name ?? 'N/A');
            $(".location").text(property.location?.location ?? 'N/A');
            $(".property_id").text(property.listing_id ?? 'N/A');

            $("#property_info").modal('show');
          } else {
            toastr.error("No Property details found.");
          }

          $(".loading").css('display', 'none');
        }
      });
    }

    function changeStatus(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Chnage Status Of This Feedback.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ route('admin.changeStatusPropertyFeedbacks') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                reloadPage();
              } else if (response.status === 500) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              toastr.error('An error occured.')
            },
            complete: function () {
              $(".loading_2").css('display', 'none');
              $(".btn-delete").attr('disabled', false);
            }
          })
        }
      });
    };

    function deleteFeedback(id) {
    swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the feedback.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            $(".loading_2").css('display', 'block');
            $.ajax({
                url: '{{ route("admin.manage-feedback.delete") }}',
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                        reloadPage();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("An error occurred.");
                },
                complete: function() {
                    $(".loading_2").css('display', 'none');
                }
            });
        }
    });
}


  </script>

@endsection