@extends('layouts.app')

@section('title')
Manage Job Requests
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
                        <li class="breadcrumb-item">Jobs</li>
                        <li class="breadcrumb-item active">Job Requests</li>
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
                                            <th>Job Title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Resume</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($requests as $k => $req)
                                        <tr id="{{ $req->id }}">
                                            <td>{{ $k+1 }}</td>
                                            <td>{{ $req->job->heading ?? 'N/A' }}</td>
                                            <td>{{ $req->name }}</td>
                                            <td>{{ $req->email }}</td>
                                            <td>{{ $req->mobile_number }}</td>

                                            <td>
                                                <a href="{{ asset('storage/'.$req->resume) }}" target="_blank">
                                                    View Resume
                                                </a>
                                            </td>

                                            <td>{{ $req->created_at->format('d M Y') }}</td>

                                            <td>
                                                <ul class="action">
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#delete-request"
                                                           onclick="$('#delete_request #id').val({{ $req->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">No records found</td>
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


{{-- View Modal --}}
<div class="modal" id="view-details">
    <div class="modal-dialog">
        <div class="modal-content">

            <center>
                <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </center>

            <div class="modal-header">
                <h4 class="modal-title">Job Request Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p><strong>Name:</strong> <span id="view-name"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Mobile:</strong> <span id="view-mobile"></span></p>
                <p><strong>Resume:</strong> <span id="view-resume"></span></p>
            </div>

        </div>
    </div>
</div>


{{-- Delete Modal --}}
<div class="modal" id="delete-request">
    <div class="modal-dialog">
        <div class="modal-content">

            <center>
                <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </center>

            <div class="modal-header">
                <h4 class="modal-title">Delete Request</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form id="delete_request" name="delete_request">
                    <center>Are you sure you want to delete this?</center>

                    <div class="form-action row mt-3">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary btn-delete" type="submit">Delete</button>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id">
                    {{ csrf_field() }}
                </form>

            </div>

        </div>
    </div>
</div>

@endsection


@section('js')

<script>
$(".btn-delete").on('click', function(e){
    e.preventDefault();
    var id = $("#delete_request #id").val();
    $(".loading").show();

    $.ajax({
        url: "{{ route('admin.deleteJobRequest') }}",
        method: "POST",
        data: $("#delete_request").serialize(),

        success: function(response){
            var res = JSON.parse(response);

            if(res.status == 200){
                toastr.success(res.message);
                $("#delete-request").modal("hide");
                $("#" + id).remove();
            } else {
                toastr.error(res.message);
            }
        },

        error: function(){
            toastr.error("An error occurred");
        },

        complete: function(){
            $(".loading").hide();
        }
    });
});


</script>

@endsection
