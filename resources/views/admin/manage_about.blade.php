@extends('layouts.app')

@section('title')
Edit About Content
@endsection

@section('content')

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">About Us</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">About Us</li>
                        <li class="breadcrumb-item active">Update About Content</li>
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
                            <form id="edit_profile_form" class="form-body" method="post" action="{{route('updateAboutContent')}}" enctype="multipart/form-data">
                                <h4 class="form-section-h">Update Content</h4>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <img src="{{ asset('storage/') }}/{{ $picked->images }}" id="output"  class="img-fluid" style="width: 90px;">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="file" accept="image/*" name="images" onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" placeholder="Enter Heading" value="{{ $picked->heading }}"  />
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <textarea name="description">{{ $picked->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update Content</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $picked->id }}" />
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