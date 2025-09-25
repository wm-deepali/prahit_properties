@extends('layouts.app')

@section('title')
Update Jobs
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
                        <li class="breadcrumb-item active">Update Jobs</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="{{route('admin.updateJob')}}" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{ $picked->id }}">
                                <h4 class="form-section-h">Post Job</h4>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Job Category</label>
                                        <select class="form-control" name="job_category" required="">
                                            <option value="">Select Category</option>
                                            @foreach($job_categories as $job_category)
                                                @if($picked->category_id == $job_category->id)
                                                    <option value="{{ $job_category->id }}" selected="">{{ $job_category->name }}</option>
                                                @else
                                                    <option value="{{ $job_category->id }}">{{ $job_category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="{{ $picked->heading }}" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">Tag Line</label>
                                        <input type="text" class="text-control" name="tag_line" placeholder="Enter Job Tag Line"  value="{{ $picked->tag_line }}" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="label label-control">Country</label>
                                        <select class="form-control" name="country" required="">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                @if($picked->country == $country->id)
                                                    <option value="{{ $country->id }}" selected="">{{ $country->name }}</option>
                                                @else
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">State</label>
                                        <input type="text" class="text-control" name="state" placeholder="Enter State" value="{{ $picked->state }}" required="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label label-control">City</label>
                                        <input type="text" class="text-control" name="city" placeholder="Enter City" value="{{ $picked->state }}" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Skills</label>
                                        <select class="form-control" name="skills[]" multiple="" required="">
                                            @if(count($technologies) > 0)
                                                @foreach($technologies as $technology)
                                                    @if(in_array($technology->id, explode(',', $picked->skills)))
                                                        <option value="{{ $technology->id }}" selected="">{{ $technology->name }}</option>
                                                    @else
                                                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                                    @endif
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
                                        <textarea name="requirements" required="">{{ $picked->requirements }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="label label-control">Job Description</label>
                                        <textarea name="description" required="">{{ $picked->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Job</button>
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