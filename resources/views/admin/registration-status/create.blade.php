@extends('layouts.app')

@section('title')
  Add Registration Status
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
              <li class="breadcrumb-item active">Add Registration Status</li>
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
            <div class="card-header">Add Registration Status</div>
            <div class="card-body">
              <form class="form form-horizontal" method="POST" action="{{ route('admin.registration-statuses.store') }}">
                @csrf
                <div class="form-body" id="price-label-container">
                  <div class="price-label-row form-group row">
                    <div class="col-md-3">
                      <label class="label-control">Name</label>
                      <input type="text" class="form-control" placeholder="Enter Name" name="name[]" required>
                    </div>
                    <div class="col-md-3">
                      <label class="label-control">Input Type</label>
                      <select class="form-control" name="input_type[]" required>
                        <option value="">Select Input Type</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="checkbox">Checkbox</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="label-control">Second Input?</label>
                      <select class="form-control second-input-select" name="second_input[]"
                        onchange="toggleSecondInput(this)">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                      </select>
                    </div>
                    <div class="col-md-3" style="display:none;">
                      <label class="label-control">Second Input Label</label>
                      <input type="text" class="form-control second-input-label" placeholder="Enter Second Input Label"
                        name="second_input_label[]">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                      <button type="button" class="btn btn-danger remove-row" style="display:none;">Remove</button>
                    </div>
                  </div>

                  <div class="form-group row mt-2">
                    <div class="col-sm-12 text-right">
                      <button type="button" class="btn btn-success" id="addMore">Add More</button>
                    </div>
                  </div>

                  <div class="form-group row mt-3">
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-primary">Add Registration Status</button>
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
    // Toggle second input label visibility
    function toggleSecondInput(select) {
      let row = select.closest('.price-label-row');
      let inputDiv = row.querySelector('.second-input-label').parentElement;
      inputDiv.style.display = select.value === 'yes' ? 'block' : 'none';
    }

    // Add More functionality
    document.getElementById('addMore').addEventListener('click', function () {
      let container = document.getElementById('price-label-container');
      let firstRow = container.querySelector('.price-label-row');
      let clone = firstRow.cloneNode(true);

      // Reset input values
      clone.querySelectorAll('input').forEach(input => input.value = '');
      clone.querySelectorAll('select').forEach(select => select.value = 'no'); // default for second input

      // Show remove button for cloned row
      let removeBtn = clone.querySelector('.remove-row');
      removeBtn.style.display = 'block';
      removeBtn.addEventListener('click', function () {
        clone.remove();
      });

      // Hide second input label initially
      clone.querySelector('.second-input-label').parentElement.style.display = 'none';

      // Update onchange event
      clone.querySelector('.second-input-select').setAttribute('onchange', 'toggleSecondInput(this)');

      // Insert before Add More button row
      container.insertBefore(clone, this.closest('.row'));
    });
  </script>
@endsection