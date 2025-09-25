@extends('layouts.app')

@section('title')
Manage Registration Statuses
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
          <a href="{{ route('admin.registration-statuses.create') }}">
            <button class="btn btn-primary btn-save">
              <i class="fas fa-plus"></i> Add Registration Status
            </button>
          </a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Registration Statuses</li>
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
                    @if(isset($statuses) && count($statuses) > 0)
                      @foreach($statuses as $status)
                          <tr>
                              <td>{{ $status->created_at }}</td>
                              <td>{{ $status->name }}</td>
                              <td>{{ ucfirst($status->input_format) }}</td>
                              <td>
                                @if($status->second_input == 'yes')
                                  Yes ({{ $status->second_input_label }})
                                @else
                                  No
                                @endif
                              </td>
                              <td>{{ ucfirst($status->status) }}</td>
                              <td class="text-center btn-group-sm">
                                <ul class="action">
                                  <li>
                                    <a href="{{ route('admin.registration-statuses.edit', $status->id) }}">
                                      <i class="fas fa-pencil-alt"></i>
                                    </a>
                                  </li>
                                  
                                  <li>
                                    <form action="{{ route('admin.registration-statuses.destroy', $status->id) }}" method="POST" style="display:inline;">
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

