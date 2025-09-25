@extends('layouts.app')

@section('title')
Manage Enquiries
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
          <h3 class="content-header-title">Enquiries</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Complaints</a></li>
            <li class="breadcrumb-item active">Manage Queries</li>
          </ol>
<!--       <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter" aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
 -->        </div>
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
                <table class="table table-bordered table-fitems" id="enquiries">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Link</th>
                      <th>Message</th>
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
</section>

<div class="modal" id="view-reasons">
  <div class="modal-dialog">
    <div class="modal-content"> 

      <center>
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
      </center>

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reasons</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div id="reasons"></div>
        <div>
          <center><h3>Other Reason</h3></center>
          <p id="other_reason"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="admin-reply" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Reply</h3>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="post" action="{{ route('admin.replyComplaintQuery') }}">
            @csrf
            <div class="row">
              <label>Email</label>
              <input type="hidden" name="id" id="query-id">
              <input type="text" class="form-control" name="email" id="view-email" readonly="" required="">
            </div>
            <div class="row" style="margin-top: 20px;">
              <label>Message</label>
              <textarea class="form-control" cols="5" name="message" required=""></textarea>
            </div>
            <div class="form-action row" style="margin-top:20px;">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="admin-reply-answer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Answer</h3>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <p id="view-admin-reply"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@endsection



@section('js')

<script type="text/javascript">

  //-------------------- Manage pending lead listing ----------------------//
  $(function () {
      var table = $('#enquiries').DataTable({
          processing: true,
          serverSide: true,
          render: true,
          searching: true,
          ajax: "{{ route('admin.manageComplaintsDatatable') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'mobile_number', name: 'mobile_number'},
              {data: 'link', name: 'link'},
              {data: 'message', name: 'message'},
              {data: 'action', name: 'action'}
          ],
      });
  });

  function fetchData(id){
    var route = "{{route('admin.getComplaintData', ':id')}}";
    var route = route.replace(":id", id);
    $.ajax({
      url: route,
      method: "GET",
      beforeSend: function(argument) {
        $(".loading").css('display', 'block');
      },
      success: function(response) {
        var response = JSON.parse(response);
        if(response.status === 200) {
          console.log(response);
          $.each(response.data.data.reasons,function(key,res){
              $("#reasons").append('<div>*'+res.reason+'</div>');
          });
          document.getElementById('other_reason').innerHTML = response.data.data.complaint.other_reason;
          $("#view-reasons").modal('show');
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

function adminReply(id) {
  var route = "{{route('admin.getComplaintData', ':id')}}";
  var route = route.replace(":id", id);
  $.ajax({
    url: route,
    method: "GET",
    beforeSend: function(argument) {
      $(".loading").css('display', 'block');
    },
    success: function(response) {
      var response = JSON.parse(response);
      if(response.status === 200) {
        document.getElementById('query-id').value = response.data.data.complaint.id;
        document.getElementById('view-email').value = response.data.data.complaint.email;
        $("#admin-reply").modal('show');
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

  function viewReply(id) {
    $.ajax({
      url:"{{ route('admin.getSupportCenterData') }}",
      type: 'post',
      dataType: "json",
      data: {
         _token: '{{ csrf_token() }}',
         id: id
      },
      success: function( data ) {
        document.getElementById('view-admin-reply').innerHTML = data.reply;
        $('#admin-reply-answer').modal('show');
      }
    });
  }
</script>

@endsection