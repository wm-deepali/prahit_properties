@extends('layouts.app')

@section('title')
    Manage Business Listings - {{ $user->firstname . ' ' . $user->lastname }}
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
                        <h3 class="content-header-title">Web Directory</h3>
                        <a class="btn btn-primary btn-save" href="{{ route('admin.business-listing.create') }}">
                            <i class="fas fa-plus"></i> Add New Business
                        </a>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Web Directory</li>
                            <li class="breadcrumb-item active">Manage Business Listings of - {{ $user->firstname . ' ' . $user->lastname }}</li>
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
                                                <th>Sr. No.</th>
                                                <th>Date & Time</th>
                                                <th>Business Name</th>
                                                <th>Contact Detail</th>
                                                <th>Membership Type</th>
                                                <th>Category Info</th>
                                                <th>Property Category</th>
                                                <th>Property Subcategory</th>
                                                <th>Property Types</th>
                                                <th>Total Views</th>
                                                <th>Total Enquiries</th>
                                                <th>Added By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($businessListings) && count($businessListings) > 0)
                                                @foreach($businessListings as $c => $b)
                                                    @include('admin.business-listing.business-table', ['b' => $b, 'c' => $c])
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="13" class="text-center">No records found</td>
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
        </div>
        </div>
    </section>

    {{-- Delete Modal --}}
    <div class="modal" id="delete-business">
        <div class="modal-dialog">
            <div class="modal-content">

                <center>
                    <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
                </center>

                <div class="modal-header">
                    <h4 class="modal-title">Delete Business</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form id="delete_business" name="delete_business">
                        <div class="form-group row">
                            <center>Are you sure you want to delete this?</center>
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
        $(document).ready(function () {

            $(".btn-delete").on('click', function (e) {
                e.preventDefault();
                $(".loading_2").show();
                $(".btn-delete").prop('disabled', true);

                var id = $("#delete_business #id").val();

                $.ajax({
                    url: '{{ route("admin.business-listing.ajaxDelete", ":id") }}'.replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.message);
                            $("#delete-business").modal('hide');
                            $("#" + id).remove();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function () {
                        toastr.error('An error occurred.');
                    },
                    complete: function () {
                        $(".loading_2").hide();
                        $(".btn-delete").prop('disabled', false);
                    }
                });
            });

            // Toggle business status
            $(".btn-toggle-status").on('click', function (e) {
                e.preventDefault();
                var btn = $(this);
                var id = btn.data('id');
                var status = btn.data('status');

                $.ajax({
                    url: '/admin/business-listing/toggle-status/' + id, // Custom POST route
                    method: "POST",
                    data: {
                        is_published: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.message);
                            location.reload(); // reload table
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function () {
                        toastr.error('An error occurred.');
                    }
                });
            });

        });
    </script>
@endsection