@extends('layouts.app')
@section('title')
  Manage Builders
@endsection
<style type="text/css">
  .logged-in {
    color: green;
    font-size: 20px;
  }

  .logged-out {
    color: red;
    font-size: 20px;
  }
</style>
@section('content')

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Builders</h3>
            <button class="btn btn-primary btn-save" data-target="#create_dealer_modal" data-toggle="modal"><i
                class="fa fa-plus" aria-hidden="true"></i> Add Builder</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Builder</li>
              <li class="breadcrumb-item active">Manage Builders</li>
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
              <li>* {{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems" id="for_all">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Total Properties</th>
                        <th>Premium Listing</th>
                        <th>Free Listing</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($builders) && count($builders) > 0)
                        @foreach($builders as $k => $v)
                          <tr>
                            <td>{{$k + 1}}</td>
                            <td>
                              @php
                                $dt = new DateTime($v->created_at);
                                $tz = new DateTimeZone('Asia/Kolkata');
                                $dt->setTimezone($tz);
                                $dateTime = $dt->format('d.m.Y h:i A');
                              @endphp
                              {{ $dateTime }}
                            </td>
                            <td>{{$v->firstname}} {{$v->lastname}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->mobile_number}}</td>
                            <td>{{ $v->getProperties ? count($v->getProperties) : 0 }}</td>
                            <td>{{ count($v->getPremiumProperties($v->id)) }}</td>
                            <td>{{ count($v->getFreeProperties($v->id)) }}</td>
                            <td>{{ $v->getState ? $v->getState->name : '' }}</td>
                            <td>{{ $v->getCity ? $v->getCity->name : '' }}</td>
                            <td>
                              @if($v->status == "No")
                                <span class="badge badge-danger">In-Active</span>
                              @else
                                <span class="badge badge-success">Active</span>
                              @endif
                            </td>
                            <td>
                              <ul class="action">
                                @if($v->status == "No")
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"
                                      title="Activate User Account"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                  </li>
                                @else
                                  <li><a style="cursor: pointer;" onclick="changeStatus('{{ $v->id }}')"
                                      title="Block User Account"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
                                @endif
                                <li><a href="{{ url('user/profile') }}/{{ $v->id }}" title="View User Profile"><i
                                      class="fa fa-eye" aria-hidden="true"></i></a></li>
                                <li>
                                  <a href="{{ route('agent.edit', $v->id) }}" title="Edit Public Profile">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                  </a>
                                </li>

                                @if($v->is_verified == 1)
                                  <li><a style="cursor: pointer;" title="Verify Email" onclick="verifyEmail('{{ $v->id }}')"><i
                                        class="fa fa-envelope" aria-hidden="true"></i></a><span style="cursor: pointer;"
                                      title="Verified" class="logged-in">●</span></li>
                                @else
                                  <li><a style="cursor: pointer;" title="Verify Email" onclick="verifyEmail('{{ $v->id }}')"><i
                                        class="fa fa-envelope" aria-hidden="true"></i></a><span style="cursor: pointer;"
                                      title="Not Verified" class="logged-out">●</span></li>
                                @endif
                                @if($v->mobile_verified == 1)
                                  <li><a style="cursor: pointer;" title="Verify Mobile Number"
                                      onclick="verifyMobileNumber('{{ $v->id }}')"><i class="fa fa-phone"
                                        aria-hidden="true"></i></a><span style="cursor: pointer;" title="Verified"
                                      class="logged-in">●</span></li>
                                @else
                                  <li><a style="cursor: pointer;" title="Verify Mobile Number"
                                      onclick="verifyMobileNumber('{{ $v->id }}')"><i class="fa fa-phone"
                                        aria-hidden="true"></i></a><span style="cursor: pointer;" title="Not Verified"
                                      class="logged-out">●</span></li>
                                @endif
                                <li><a href="{{ url('master/update/owner/') }}/{{ $v->id }}" title="Update User Profile"><i
                                      class="fas fa-pencil-alt"></i></a></li>
                                <li><a style="cursor: pointer;" onclick="deleteUser('{{ $v->id }}');" title="Delete User"><i
                                      class="fa fa-trash" aria-hidden="true"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="9"> No records found </td>
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
  </section>

  <div class="modal" id="create_dealer_modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Builder</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{ url('master/create/builders') }}">
            @csrf
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">FirstName</label>
                <input type="text" class="text-control" placeholder="Enter Name" name="firstname"
                  value="{{ old('firstname') }}" required />
              </div>
              <div class="col-sm-6">
                <label class="label-control">LastName</label>
                <input type="text" class="text-control" placeholder="Enter Name" name="lastname"
                  value="{{ old('lastname') }}" required />
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">Email</label>
                <input type="text" class="text-control" placeholder="Enter Email" name="email" value="{{ old('email') }}"
                  required />
                @if ($errors->has('email'))
                  <span class="error" style="color: red;">
                    <strong>* {{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-sm-6">
                <label class="label-control">Mobile No.</label>
                <input type="text" class="text-control" placeholder="Enter Mobile No." name="mobile_number"
                  value="{{ old('mobile_number') }}" required />
                @if ($errors->has('mobile_number'))
                  <span class="error" style="color: red;">
                    <strong>* {{ $errors->first('mobile_number') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Gender</label>
                <select class="text-control" name="gender" required>
                  @if(old('gender') == 0)
                    <option value="0" selected="">Male</option>
                    <option value="1">Female</option>
                  @elseif(old('gender') == 1)
                    <option value="0">Male</option>
                    <option value="1" selected="">Female</option>
                  @else
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  @endif
                </select>
              </div>
            </div>


            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Password</label>
                <input type="password" class="text-control" placeholder="Enter Password" name="password" required />
              </div>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Add Builder</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('js')
  @if ($errors->has('email'))
    <script type="text/javascript">
      $('#create_dealer_modal').modal('show');
    </script>
  @endif
  @if ($errors->has('mobile_number'))
    <script type="text/javascript">
      $('#create_dealer_modal').modal('show');
    </script>
  @endif
  <script type="text/javascript">

    function changeStatus(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Change status of this user.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('new_loader').style.display = 'block';
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/user/change-status') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                $("#delete-owners").modal('hide');
                reloadPage();
              } else if (response.status === 500) {
                toastr.error(response.message)
              }
              document.getElementById('new_loader').style.display = 'none';
            },
            error: function (response) {
              toastr.error('An error occured.');
              document.getElementById('new_loader').style.display = 'none';
            },
            complete: function () {
              document.getElementById('new_loader').style.display = 'none';
              $(".btn-delete").attr('disabled', false);
            }
          })
        }
      });

    }

    function deleteUser(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Delete This User.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('master/user/delete') }}',
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

    }

    function verifyEmail(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Verify This Email.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, verify this email",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('verify/email/and/mobile') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id,
              'type': "email"
            },
            success: function (response) {
              toastr.success(response)
              reloadPage();
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

    }

    function verifyMobileNumber(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Verify This Mobile Number.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, verify this mobile number",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '{{ url('verify/email/and/mobile') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id,
              'type': 'mobile'
            },
            success: function (response) {
              toastr.success(response)
              reloadPage();
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

    }

  </script>


@endsection