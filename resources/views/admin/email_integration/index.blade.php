@extends('layouts.app')

@section('title')
Manage Email Settings
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
          <h3 class="content-header-title">General Setting</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Email API</li>
            <li class="breadcrumb-item active">Manage Email Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content-main-body">
  <div class="container-fluid">
    @if(count($errors) > 0 )
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <ul class="p-0 m-0" style="list-style: none;">
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="card-block">
                  <form method="post" action="{{route('admin.email-integration.update', $email_settings->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                      <h4 class="form-section-h">Manage Settings</h4>
                      <div class="row">
                          <div class="col-sm-4">
                              <label>MAIL DRIVER</label>
                              <input type="text" name="driver" class="form-control" value="{{ $email_settings->driver }}" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL HOST</label>
                              <input type="text" name="host" class="form-control" value="{{ $email_settings->host }}" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL PORT</label>
                              <input type="text" name="port" class="form-control" value="{{ $email_settings->port }}" required="">
                          </div>
                      </div>
                      <div class="row" style="margin-top: 20px;">
                          <div class="col-sm-4">
                              <label>MAIL USERNAME</label>
                              <input type="text" name="username" class="form-control" value="{{ $email_settings->user_name }}" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL PASSWORD</label>
                              <input type="text" name="password" class="form-control" value="{{ $email_settings->password }}" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL ENCRYPTION</label>
                              <input type="text" name="encryption" class="form-control" value="{{ $email_settings->encryption }}" required="">
                          </div>
                      </div>
                      <div class="row" style="margin-top: 20px;">
                          <div class="col-sm-4">
                              <label>MAIL FROM ADDRESS</label>
                              <input type="text" name="from_address" class="form-control" value="{{ $email_settings->form_address }}" required="">
                          </div>
                          <div class="col-sm-4">
                              <label>MAIL FROM NAME</label>
                              <input type="text" name="from_name" class="form-control" value="{{ $email_settings->form_name }}" required="">
                          </div>
                      </div>
                      <div class="form-group row" style="margin-top: 20px;">
                          <div class="col-sm-12 text-center">
                              <button type="submit" class="btn btn-dark">Update Settings</button>
                          </div>
                      </div>
                  </form>
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
    $("#email_integration_form").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.email-integration.update', '1')}}",
          method: "PATCH",
          data: $("#email_integration_form").serialize(),
          beforeSend:function() {
            $(".btn-update").attr('disabled', true);
            $(".loading_2").css('display', 'block');
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              reloadPage();
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            // console.log(response)
            toastr.error('An error occured');
          },
          complete: function() {
            $(".loading_2").css('display', 'none');
            $(".btn-update").attr('disabled', false);
          }
        })
      }
    });

});



</script>

@endsection