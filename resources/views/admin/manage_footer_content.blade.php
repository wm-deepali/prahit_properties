@extends('layouts.app')

@section('title')
Manage Footer Content
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Home Page Settings</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Home Page Settings</li>
                        <li class="breadcrumb-item active">Manage Footer Content</li>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <form method="post" action="{{route('admin.updateFooterContent')}}" enctype="multipart/form-data">
                                        <h4 class="form-section-h">Update App Section Content</h4>
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $data['app']->id }}">
                                            <div class="col-sm-6">
                                                <label class="label label-control">Image</label>
                                                <input type="file" class="text-control" name="image">
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{ asset('storage') }}/{{ $data['app']->image }}" target="_blank"><img src="{{ asset('storage') }}/{{ $data['app']->image }}" style="height: 50px;margin: 22px 0px 0px 47px;"></a>
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Heading</label>
                                                <input type="text" class="text-control" name="heading" value="{{ $data['app']->heading }}" required="">
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Title</label>
                                                <input type="text" class="text-control" name="title" value="{{ $data['app']->title }}" required="">
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Key Point One</label>
                                                <input type="text" class="text-control" name="key_one" value="{{ $data['app']->key_one }}" required="">
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Key Point Two</label>
                                                <input type="text" class="text-control" name="key_two" value="{{ $data['app']->key_two }}" required="">
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Key Point Three</label>
                                                <input type="text" class="text-control" name="key_three" value="{{ $data['app']->key_three }}" required="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" style="margin-top: 20px;">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-dark">Update Content</button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form method="post" action="{{route('admin.updateFooterContent')}}" enctype="multipart/form-data">
                                        <h4 class="form-section-h">Update Footer Section Content</h4>
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $data['footer']->id }}">
                                            <div class="col-sm-12">
                                                <label class="label label-control">About Us:</label>
                                                <textarea name="title" id="title" class="form-control" rows="7" required="">{{ $data['footer']->title }}</textarea>
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <label class="label label-control">Disclaimer:</label>
                                                <textarea name="description" class="form-control" rows="7" required="">{{ $data['footer']->description }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" style="margin-top: 20px;">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-dark">Update Content</button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    </form>
                                </div>
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
    // var textarea = document.getElementById('title');
    // CKEDITOR.replace(textarea);
    // CKEDITOR.replace( 'description' );
</script>

@endsection