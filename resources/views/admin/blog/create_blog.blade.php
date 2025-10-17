@extends('layouts.app')

@section('title')
Create Blog
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Blog</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Create Blog</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="{{route('admin.createBlog')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Post Blog</h4>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Blog Category</label>
                                        <select class="form-control" name="blog_category" required="">
                                            <option value="">Select Category</option>
                                            @foreach($blog_categories as $blog_category)
                                                <option value="{{ $blog_category->id }}">{{ $blog_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" required="">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Image</label>
                                        <input type="file" class="text-control" name="image" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Image Alt Text</label>
                                        <input type="text" class="text-control" name="image_alt" placeholder="Enter image alt text" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Blog Description</label>
                                        <textarea name="description" required=""></textarea>
                                    </div>
                                </div>

                                <h4 class="form-section-h mt-3">SEO Meta Data</h4>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Title</label>
                                        <input type="text" class="text-control" name="meta_title" placeholder="Enter Meta Title">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Keywords</label>
                                        <input type="text" class="text-control" name="meta_keywords" placeholder="Enter Meta Keywords (comma separated)">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Meta Description</label>
                                        <textarea name="meta_description" class="text-control" placeholder="Enter Meta Description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Post Blog</button>
                                    </div>
                                </div>
                                @csrf
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
    CKEDITOR.replace('description');

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection
