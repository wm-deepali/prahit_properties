@extends('layouts.app')

@section('title')
Edit Furnishing status
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Edit Furnishing status</li>
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
          <div class="card-header">Edit Furnishing status</div>
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.furnishing-statuses.update', $status->id) }}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $status->name }}" required>
                        </div> 
                        <div class="col-md-6">
                            <label class="label-control">Input Type</label>
                            <select class="form-control" name="input_type" required>
                                <option value="">Select Input Type</option>
                                <option value="dropdown" {{ $status->input_format == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                                <option value="checkbox" {{ $status->input_format == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Requires Second Input?</label>
                            <select class="form-control" name="second_input" id="second_input">
                                <option value="no" {{ $status->second_input == 'no' ? 'selected' : '' }}>No</option>
                                <option value="yes" {{ $status->second_input == 'yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="second_input_label_div" style="display: {{ $status->second_input == 'yes' ? 'block' : 'none' }};">
                            <label class="label-control">Second Input Label</label>
                            <input type="text" class="form-control" placeholder="Enter Second Input Label" name="second_input_label" value="{{ $status->second_input_label }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Furnishing status</button>
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
<script>
    // Show/hide second input label based on selection
    document.getElementById('second_input').addEventListener('change', function() {
        let div = document.getElementById('second_input_label_div');
        if(this.value == 'yes'){
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
</script>
@endsection
