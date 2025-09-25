@extends('layouts.app')

@section('title')
Social Media
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
                        <li class="breadcrumb-item active">Update Social Media</li>
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
                            <form method="post" action="{{route('admin.updateSocialMedia')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Links</h4>
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $media->id }}">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Facebook</label>
                                        <input type="text" class="text-control" name="facebook" value="{{ $media->facebook }}" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Twitter</label>
                                        <input type="text" class="text-control" name="twitter" value="{{ $media->twitter }}" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Instagram</label>
                                        <input type="text" class="text-control" name="insta" value="{{ $media->insta }}" required="">
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 10px;">
                                        <label class="label label-control">Youtube</label>
                                        <input type="text" class="text-control" name="youtube" value="{{ $media->youtube }}" required="">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Links</button>
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
</section>


@endsection

@section('js')

<script type="text/javascript">
    CKEDITOR.replace( 'description_one' );
    CKEDITOR.replace( 'description_two' );
    CKEDITOR.replace( 'description_three' );
</script>

@endsection