@extends('layouts.app')

@section('title')
Manage Audience
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Ads Management</h3>
          <button class="btn btn-primary btn-save" onclick="window.location.href='{{route('admin.manage-audience.create')}}'"><i class="fas fa-plus"></i> Add Audience</button>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.manage-ads.index')}}">Ads Management</a></li>
            <li class="breadcrumb-item active">Manage Ads Audience</li>
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
                <table class="table table-bordered table-ads">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Audience Name</th>
                      <th>Owner</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($audience))
                      @foreach($audience as $k=>$v)
                        <tr>
                          <td>{{$k+1}}</td>
                          <td>{{$v->name}}</td>
                          <td><a href="#" data-target="#owner-details" data-toggle="modal">Owner</a></td>
                          <td>
                          <ul class="action">
                              <li><a href="{{route('admin.manage-audience.edit', ['manage_audience' => '1'])}}" title="Edit Audience"><i class="fas fa-pencil-alt"></i></a> </li>
                              <li><a href="#" data-target="#view-audience" data-toggle="modal" title="View Audience"><i class="fas fa-eye"></i></a> </li>
                              <li><a href="#"><i class="fas fa-trash"></i></a> </li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
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

<div class="modal custom-white" id="owner-details">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Owner Information</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-sm-4 align-self-center">
            <div class="dealer-prop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png" class="img-fluid">
              <button class="btn btn-blue-p mt-3" type="button">View Profile</button>
            </div>
          </div>
          <div class="col-sm-8 align-self-center">
            <div class="dealer-content">
              <div class="row">
                <div class="col-sm-6">
                  <label class="content-label">Name</label>
                  <h3 class="content-head">Arbaaz</h3>
                </div>
                <div class="col-sm-6">
                  <label class="content-label">Email</label>
                  <h3 class="content-head">im@gmail.com</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label class="content-label">Mobile No.</label>
                  <h3 class="content-head">9898989898</h3>
                </div>
                <div class="col-sm-6">
                  <label class="content-label">Property Posted</label>
                  <h3 class="content-head">12</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label class="content-label">Type</label>
                  <h3 class="content-head">Agent</h3>
                </div>
                <div class="col-sm-6">
                  <label class="content-label">Location</label>
                  <h3 class="content-head">Lucknow / UP</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal custom-white" id="view-audience">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Audience</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Audience Name</th>
            <td>Hello</td>
            <th>Age Group</th>
            <td>13-20</td>
          </tr>
          <tr>
            <th>State</th>
            <td colspan="3">Maharashtra, Uttar Pardesh</td>
          </tr>
          <tr>
            <th>Gender</th>
            <td>Both</td>
            <th>Language</th>
            <td>English</td>
          </tr>
        </table>  
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
</script>

@endsection