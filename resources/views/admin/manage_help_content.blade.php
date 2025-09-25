@extends('layouts.app')

@section('title')
Help Content
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
                        <li class="breadcrumb-item active">Update Help Content</li>
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
                            <form method="post" action="{{route('admin.updateHelpContent')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Content</h4>
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $content->id }}">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter First Name" value="{{ $content->heading }}"  />
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label-control">Content One:</label>
                                        <textarea name="description_one" class="form-control">{{ $content->content_one }}</textarea>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label-control">Content Two:</label>
                                        <textarea name="description_two" class="form-control">{{ $content->content_two }}</textarea>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <label class="label-control">Content Three:</label>
                                        <textarea name="description_three" class="form-control">{{ $content->content_three }}</textarea>
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
</section>


@endsection

@section('js')

<script type="text/javascript">
    CKEDITOR.replace( 'description_one' );
    CKEDITOR.replace( 'description_two' );
    CKEDITOR.replace( 'description_three' );
</script>

@endsection