@extends('layouts.app')

@section('title')
Manage Email Templates
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
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Email Templates</li>
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
        <div class="main-card mb-3 card">
        <div class="card-header">Add Template</div>
        <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.email-template.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="label-control">Title</label>
                            <input type="text" class="form-control" placeholder="Enter Title" name="title">
                        </div> 
                        <div class="col-md-4">
                            <label class="label-control">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div> 
                        <div class="col-md-4">
                            <label class="label-control">Subject</label>
                            <input type="text" class="form-control" placeholder="Enter Subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="label-control">Template</label>
                            <textarea class="form-control" name="template" id="editor" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>


@endsection



@section('js')

<script type="text/javascript">
    CKEDITOR.replace( 'template' );
</script>

@endsection