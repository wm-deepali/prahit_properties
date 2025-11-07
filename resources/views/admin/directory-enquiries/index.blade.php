@extends('layouts.app')

@section('title')
  Manage Business Enquiries
@endsection

@section('content')

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <div class="loading">
              <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
            </div>
            <h3 class="content-header-title">Business Enquiries</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Manage Enquiries</li>
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
                        <th>Date & Time</th>
                        <th>Business Detail</th>
                        <th>Enquirer Detail</th>
                        <th>Message</th>
                        <th>Added By (User)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($enquiries->count() > 0)
                        @foreach($enquiries as $index => $enquiry)
                          <tr id="enquiry-{{ $enquiry->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                             <td>
                              {{ $enquiry->business->business_name ?? 'N/A' }}<br>
                              {{ $enquiry->business->category->category_name  ?? ''}}<br>
                              {{ $enquiry->business->subCategories->pluck('sub_category_name')->implode(', ')  ?? ''}}
                            </td>
                             <td>
                              {{ $enquiry->name ?? 'N/A' }}<br>
                              {{ $enquiry->email ?? 'N/A' }}<br>
                              {{ $enquiry->mobile ?? 'N/A' }}
                            </td>
                            <td>{{ Str::limit($enquiry->message, 60) }}</td>
                            <td>{{ $enquiry->user->firstname ?? 'Guest' }} {{ $enquiry->user->lastname ?? '' }}</td>
                            <td>
                              <button class="btn btn-danger btn-sm btn-delete-enquiry" data-id="{{ $enquiry->id }}">
                                <i class="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="9" class="text-center">No enquiries found</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>

                <div class="mt-3">
                  {{ $enquiries->links('pagination::bootstrap-4') }}
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Delete Modal --}}
  <div class="modal" id="delete-enquiry">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
        </center>

        <div class="modal-header">
          <h4 class="modal-title">Delete Enquiry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form id="delete_enquiry_form">
            <div class="form-group row">
              <center>Are you sure you want to delete this enquiry?</center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete-confirm" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="delete_enquiry_id" />
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {

    // Open delete modal
    $(document).on('click', '.btn-delete-enquiry', function() {
        var id = $(this).data('id');
        $('#delete_enquiry_id').val(id);
        $('#delete-enquiry').modal('show');
    });

    // Handle delete
    $('#delete_enquiry_form').on('submit', function(e) {
        e.preventDefault();
        var id = $('#delete_enquiry_id').val();

        $.ajax({
            url: '{{ route("admin.directory-enquiries.destroy", ":id") }}'.replace(':id', id),
            type: "DELETE",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                     location.reload();
                    $('#delete-enquiry').modal('hide');
                    $('#enquiry-' + id).remove();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('An error occurred.');
            }
        });
    });

});
</script>
@endsection
