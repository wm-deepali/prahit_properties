@extends('layouts.app')

@section('title')
Edit Price Label
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
            <li class="breadcrumb-item active">Edit Price Label</li>
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
          <div class="card-header">Edit Price Label</div>
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ route('admin.price-labels.update', $priceLabel->id) }}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Label Name</label>
                            <input type="text" class="form-control" placeholder="Enter Label Name" name="label_name" value="{{ $priceLabel->name }}" required>
                        </div> 
                        <div class="col-md-6">
                            <label class="label-control">Input Type</label>
                            <select class="form-control" name="input_type" required>
                                <option value="">Select Input Type</option>
                                <option value="dropdown" {{ $priceLabel->input_format == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                                <option value="checkbox" {{ $priceLabel->input_format == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="label-control">Requires Second Input?</label>
                            <select class="form-control" name="second_input" id="second_input">
                                <option value="no" {{ $priceLabel->second_input == 0 ? 'selected' : '' }}>No</option>
                                <option value="yes" {{ $priceLabel->second_input == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="second_input_label_div" style="display: {{ $priceLabel->second_input == 1 ? 'block' : 'none' }};">
                            <label class="label-control">Second Input Label</label>
                            <input type="text" class="form-control" placeholder="Enter Second Input Label" name="second_input_label" value="{{ $priceLabel->second_input_label }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Price Label</button>
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
        if(this.value == '1'){
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
</script>
@endsection
