@extends('layouts.app')
@section('title')
  Callback Requests
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="content-header">
          <h3 class="content-header-title">Callback Requests</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Callback Requests</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content-main-body">
  <div class="container-fluid">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems" id="callback_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date & Time</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($requests as $k => $req)
                    <tr>
                      <td>{{ $k + 1 }}</td>
                      <td>{{ \Carbon\Carbon::parse($req->created_at)->timezone('Asia/Kolkata')->format('d.m.Y h:i A') }}</td>
                      <td>{{ $req->name }}</td>
                      <td>{{ $req->email }}</td>
                      <td>{{ $req->mobile_number }}</td>
                      <td>{{ $req->message }}</td>
                      <td>
                        <a href="javascript:void(0);" onclick="deleteRequest('{{ $req->id }}')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7">No callback requests found</td>
                    </tr>
                    @endforelse
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

@endsection

@section('js')
<script>
function deleteRequest(id) {
  swal.fire({
    title: "Are you sure?",
    text: "Delete this callback request?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '{{ url("master/callback-requests") }}/' + id,
        type: 'DELETE',
        data: {_token: '{{ csrf_token() }}'},
        success: function(res) {
          toastr.success('Request deleted successfully');
          location.reload();
        },
        error: function(err) {
          toastr.error('Something went wrong');
        }
      });
    }
  });
}
</script>
@endsection
