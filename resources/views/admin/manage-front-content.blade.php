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
                        <li class="breadcrumb-item">Home Page Contents</li>
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
                            <form method="post" action="{{ url('manage/front/content') }}/{{ $banner->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <h4 class="form-section-h">Manage Banner Content</h4>
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{ asset('storage') }}/{{ $banner->image }}" target="_blank"><img src="{{ asset('storage') }}/{{ $banner->image }}" style="height: 50px;margin: 22px 0px 0px 47px;"></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="label label-control">Update Image</label>
                                                <input type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="{{ $banner->heading }}" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="{{ $banner->title }}" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section Two -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="{{ url('manage/front/content') }}/{{ $hand_picked->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <h4 class="form-section-h">Manage Hand Picked Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="{{ $hand_picked->heading }}" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Choose Properties</label>
                                        <select name="ids[]" class="form-control selectpicker" multiple required>
                                            @foreach($properties as $property)
                                                <option value="{{ $property->id }}" @if(in_array($property->id, explode(',', $hand_picked->ids))) selected @endif>{{ $property->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Two -->
            <!-- Section Three -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="{{ url('manage/front/content') }}/{{ $trending->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <h4 class="form-section-h">Manage Trending Projects</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="{{ $trending->heading }}" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="{{ $trending->title }}" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Three -->
            <!-- Section Four -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="{{ url('manage/front/content') }}/{{ $latest_property->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <h4 class="form-section-h">Manage Latest Properties Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="{{ $latest_property->heading }}" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="{{ $latest_property->title }}" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Four -->
            <!-- Section Five -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <form method="post" action="{{ url('manage/front/content') }}/{{ $featured_property->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <h4 class="form-section-h">Manage Featured Property Content</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label label-control">Heading</label>
                                        <input type="text" class="text-control" name="heading" value="{{ $featured_property->heading }}" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label label-control">Title</label>
                                        <input type="text" class="text-control" name="title" value="{{ $featured_property->title }}" required="">
                                    </div>
                                </div>  
                                <div class="form-group row" style="margin-top: 20px;">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Five -->
        </div>
    </div>
</section>


@endsection

@section('js')

@endsection