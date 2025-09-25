@extends('layouts.app')

@section('title')
Edit Profile
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">User Profile</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">User Profile</li>
                        <li class="breadcrumb-item active">Update Profile</li>
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
                    <li>* {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                             <form method="post" action="{{ url('master/update/user/profile') }}">
                              @csrf
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <input type="hidden" name="user_id" value="{{ $user->id }}">
                                  <label class="label-control">FirstName</label>
                                  <input type="text" class="text-control" placeholder="Enter Name" name="firstname" value="{{ $user->firstname }}" required />
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">LastName</label>
                                  <input type="text" class="text-control" placeholder="Enter Name" name="lastname" value="{{ $user->lastname }}" required />
                                </div>
                              </div>
                          
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">Email</label>
                                  <input type="text" class="text-control" placeholder="Enter Email" name="email" value="{{ $user->email }}" required />
                                </div>

                                <div class="col-sm-6">
                                  <label class="label-control">Mobile No.</label>
                                  <input type="text" class="text-control" placeholder="Enter Mobile No." name="mobile_number" value="{{ $user->mobile_number }}" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">State</label>
                                  <select class="text-control" id="state_id" name="state_id" required onchange="loadCities(this.value, 'populate_cities');">
                                      @if(count($states) < 1)
                                        <option value="">No records found</option>
                                      @else
                                        @foreach($states as $k=>$v)
                                          <option value="{{$v->id}}" {{$v->id == $user->state_id ? "selected" : ''}}>{{$v->name}}</option>
                                        @endforeach
                                      @endif
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">City</label>
                                  <select class="text-control" id="populate_cities" name="city_id" required>
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                      @if($user->city_id == $city->id)
                                        <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                                      @else
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                      @endif
                                    @endforeach()
                                  </select>
                                </div>
                              </div>
                          
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">Address</label>
                                  <input type="text" class="text-control" placeholder="Enter Address" name="address" value="{{ $user->address }}" required />
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">Gender</label>
                                  <select class="text-control" name="gender" required>
                                  @if($user->gender == 'Male')
                                    <option value="Male" selected="">Male</option>
                                    <option value="Female">Female</option>
                                  @elseif($user->gender == 'Female')
                                    <option value="Male">Male</option>
                                    <option value="Female" selected="">Female</option>
                                  @else
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  @endif
                                  </select>
                                </div>
                              </div>

                              <div class="form-action row">
                                <div class="col-sm-12 text-center">
                                  <button class="btn btn-primary btn-add" type="submit">Update</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card"> 
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-body">														
                                <form method="post" action="{{ url('master/update/user/password') }}">
                                    @csrf
                                    <h4 class="form-section-h">Update User Password</h4>
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">New Password <span class="required">*</span></label>
                                            <input type="password" name="password" class="text-control" placeholder="Enter New Password" required />
                                            <span>Leave Blank if you don't want to change.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Re-enter Password <span class="required">*</span></label>
                                            <input type="password" name="new_password" class="text-control" placeholder="Re-enter Password" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn-w100 btn btn-dark">Update Password</button>
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
    $("#edit_profile_form").validate();
    $("#edit_security_form").validate();
});

$(function(){
  loadCities($("#state_id").val(), 'populate_cities', function(){
    $("#populate_cities").val("{{$user->city_id}}");
  });
});

function loadCities(state_id, element_id, callback = null) {
    // if(empty(state_id)) return true;

    var route = "{{config('app.api_url')}}/cities_states/"+state_id;

    $.ajax({
        url: route,
        method:"GET",
        beforeSend:function() {
            $(".loading").css('display','block');
            $(".btn-submit").attr('disabled', true);
        },
        success:function(response) {
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
                var cities = response.data.Cities;
                if(cities.length > 0) {
                    $(`#${element_id}`).empty();
                    $.each(cities, function(x,y) {
                        $(`#${element_id}`).append(
                            `<option value=${y.id}>${y.name}</option>`
                        );
                    });
                } else {
                        $(`#${element_id}`).append(
                            `<option value=''>No records found</option>`
                        );
                }
                if(callback){
                  callback();
                }
            }
        },
        error:function() {
            toastr.error('An error occured')
        },
        complete:function() {
            $(".loading").css('display','none');
            $(".btn-submit").attr('disabled', false);
        }
    });

}
</script>

@endsection