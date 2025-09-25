@extends('layouts.app')

@section('title')
Create Jobs
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Jobs</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Jobs</li>
                        <li class="breadcrumb-item active">Create Jobs</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="{{route('admin.createJob')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Post Job</h4>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Job Category</label>
                                        <select class="form-control" name="job_category" required="">
                                            <option value="">Select Category</option>
                                            @foreach($job_categories as $job_category)
                                                <option value="{{ $job_category->id }}">{{ $job_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Tag Line</label>
                                        <input type="text" class="text-control" name="tag_line" placeholder="Enter Job Tag Line" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Country</label>
                                        <select class="form-control" name="country" required="">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">State</label>
                                        <input type="text" class="text-control" name="state" placeholder="Enter State" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">City</label>
                                        <input type="text" class="text-control" name="city" placeholder="Enter City" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Skills</label>
                                        <select class="form-control" name="skills[]" multiple="" required="">
                                            @if(count($technologies) > 0)
                                                @foreach($technologies as $technology)
                                                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No any category found.</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Job Requirements</label>
                                        <textarea name="requirements" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Job Description</label>
                                        <textarea name="description" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Post Job</button>
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
    CKEDITOR.replace( 'requirements' );
    CKEDITOR.replace( 'description' );

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

@endsection