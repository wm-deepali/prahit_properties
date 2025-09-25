@extends('layouts.app')

@section('title')
Manage Price Labels
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <a href="{{ route('admin.price-labels.create') }}">
            <button class="btn btn-primary btn-save">
              <i class="fas fa-plus"></i> Add Price Label
            </button>
          </a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Price Labels</li>
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
              <div class="table-responsive">
                <table class="table table-bordered table-fitems">
                  <thead>
                    <tr>
                      <th>Date &amp; Time</th>
                      <th>Name</th>
                      <th>Input Format</th>
                      <th>Second Input</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($labels) && count($labels) > 0)
                      @foreach($labels as $label)
                          <tr>
                              <td>{{ $label->created_at }}</td>
                              <td>{{ $label->name }}</td>
                              <td>{{ ucfirst($label->input_format) }}</td>
                              <td>
                                @if($label->second_input == 'yes')
                                  Yes ({{ $label->second_input_label }})
                                @else
                                  No
                                @endif
                              </td>
                              <td>{{ ucfirst($label->status) }}</td>
                              <td class="text-center btn-group-sm">
                                <ul class="action">
                                  <li>
                                    <a href="{{ route('admin.price-labels.edit', $label->id) }}">
                                      <i class="fas fa-pencil-alt"></i>
                                    </a>
                                  </li>
                                  <li>
                                    <a style="cursor: pointer;" >
                                      @if($label->status == "active")
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                      @else
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      @endif
                                    </a>
                                  </li>
                                  <li>
                                    <form action="{{ route('admin.price-labels.destroy', $label->id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-link p-0 m-0">
                                        <i class="fa fa-trash text-danger"></i>
                                      </button>
                                    </form>
                                  </li>
                                </ul>
                              </td>
                          </tr>
                      @endforeach
                    @else 
                      <tr>
                        <td colspan="6"> No records found </td>
                      </tr> 
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

