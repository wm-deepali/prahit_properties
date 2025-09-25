@extends('layouts.app')

@section('title')
Manage Dealers
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Dealers</h3>
      <button class="btn btn-primary btn-save" data-target="#create_dealer_modal" data-toggle="modal"><i class="fas fa-plus"></i> Add Dealer</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Dealers</li>
            <li class="breadcrumb-item active">Manage Dealers</li>
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
                <table class="table table-bordered table-fitems" id="for_all">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No.</th>
                      <th>Type</th>
                      <th>Listings</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($dealers) && count($dealers) > 0)
                      @foreach($dealers as $k => $v)
                        <tr>
                          <td>{{$k+1}}</td>
                          <td>{{$v->User->name}}</td>
                          <td>{{$v->User->email}}</td>
                          <td>{{$v->User->mobile_number}}</td>
                          <td>
                            @if($v->type == "1")
                              Agent
                            @elseif($v->type == "1")
                              Builder
                            @elseif($v->type == "2")
                              Owner/Individual
                            @endif
                          </td>

                          <td></td>
                          <td>{{$v->location}}</td>
                          <td>
                            @if($v->status == "0")
                              Pending
                            @elseif($v->status == "1")
                              Approved
                            @elseif($v->type == "2")
                              Rejected
                            @endif
                          </td>
                          <td>
                            <ul class="action">
                              <li><a href="#" title="Approved"><i class="fas fa-check"></i></a></li>
                              <li><a href="#" title="Reject"><i class="fas fa-times"></i></a></li>
                              <li><a href="#"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a href="#" data-target="#change-password" data-toggle="modal"><i class="fas fa-lock"></i></a></li>
                              <li><a href="#"><i class="fas fa-trash"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
                    @else 
                      <tr>
                        <td colspan="5"> No records found </td>
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

<div class="modal" id="change-password">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form>
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">New Password</label>
              <input type="password" class="text-control" placeholder="Enter New Password">
            </div>
            <div class="col-sm-6">
              <label class="label-control">Re-enter Password</label>
              <input type="password" class="text-control" placeholder="Enter Re-enter Password">
            </div>
          </div>
      
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-save" type="submit">Change Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="create_dealer_modal">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Dealer</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form id="create_dealer" name="create_dealer">
          <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Name</label>
              <input type="text" class="text-control" placeholder="Enter Name" name="name" required />
            </div>
            <div class="col-sm-6">
              <label class="label-control">Email</label>
              <input type="text" class="text-control" placeholder="Enter Email" name="email" required />
            </div>
          </div>
      
      <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Mobile No.</label>
              <input type="text" class="text-control" placeholder="Enter Mobile No." name="mobile_number" required />
            </div>
            <div class="col-sm-6">
              <label class="label-control">Type</label>
              <select class="text-control" name="type" required />
                <option value="0">Agent</option>
                <option value="1">Builder</option>
                <option value="2">Owner/Individual</option>
              </select>
            </div>
          </div>
      
      <div class="form-group row">
            <div class="col-sm-6">
              <label class="label-control">Gender</label>
              <select class="text-control" name="gender" required />
                <option value="0">Male</option>
                <option value="1">Female</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="label-control">Password</label>
              <input type="password" class="text-control" placeholder="Enter Password" name="password" required />
            </div>
          </div>
      
          <div class="form-action row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-primary btn-add" type="submit">Add Dealer</button>
            </div>
          </div>

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
    $("#for_all").dataTable();

    $("#create_dealer").validate({
      rules: {
        mobile_number: {
          required: true,
          minlength:10,
          maxlength:10,
        },
        email: {
          required:true,
          email:true
        }
      },
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.dealers.store')}}",
          method: "POST",
          data: $("#create_dealer").serialize(),
          beforeSend:function() {
            $(".loading_2").css('display', 'block');
            $(".btn-add").attr('disabled', true);
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            toastr.error('An error occured')
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-add").attr('disabled', false);
            $("#create_dealer_modal").modal('hide');
          }
        })
      }
    });
});
</script>


@endsection
