@extends('layouts.app')

@section('title')
  Manage Business Listings
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
            <h3 class="content-header-title">Web Directory</h3>
            <a class="btn btn-primary btn-save" href="{{ route('admin.business-listing.create') }}">
              <i class="fas fa-plus"></i> Add New Business
            </a>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Manage Business Listings</li>
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
                        <th>Sr. No.</th>
                        <th>Date & Time</th>
                        <th>Business Name</th>
                        <th>Contact Detail</th>
                        <th>Membership Type</th>
                        <th>Category Info</th>
                        <th>Property Category</th>
                        <th>Property Subcategory</th>
                        <th>Property Types</th>
                        <th>Total Views</th>
                        <th>Total Enquiries</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($businesses) && count($businesses) > 0)
                        @foreach($businesses as $c => $b)
                          <tr id="{{ $b->id }}">
                            <td>{{ $c + 1 }}</td>
                            <td>{{ $b->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $b->business_name }}</td>
                            <td>
                              {{ $b->email }} <br>
                              {{ $b->mobile_number }}
                            </td>
                            <td>{{ ucfirst($b->membership_type) }}</td>
                            <td>
                              {{ $b->category ? $b->category->category_name : '-' }} <br>
                              @if($b->subCategories && count($b->subCategories) > 0)
                                {{ implode(', ', $b->subCategories->pluck('sub_category_name')->toArray()) }}
                              @endif
                            </td>
                            <td>
                              @php
                                $pc = $b->propertyCategories ?? collect();
                                $psc = $b->propertySubCategories ?? collect();
                                $pssc = $b->propertySubSubCategories ?? collect();
                              @endphp
                              @if($pc->count() === ($pc instanceof \Illuminate\Support\Collection ? $pc : collect($pc))->count() && $pc->count() > 0 && $pc->count() === \App\Category::count())
                                All
                              @else
                                {{ $pc->count() ? $pc->pluck('category_name')->implode(', ') : '-' }}
                              @endif
                            </td>
                            <td>
                              @if($psc->count() && $pc->count() === 1 && $psc->count() === \App\SubCategory::where('category_id', $pc->first()->id)->count())
                                All
                              @else
                                {{ $psc->count() ? $psc->pluck('sub_category_name')->implode(', ') : '-' }}
                              @endif
                            </td>
                            <td>
                              {{ $pssc->count() ? $pssc->pluck('sub_sub_category_name')->implode(', ') : '-' }}
                            </td>
                            <td>{{ $b->total_views ?? 0 }}</td>
                            <td>{{ $b->total_enquiries ?? 0 }}</td>
                            <td>{{ $b->status == 'Active' ? 'Active' : 'Inactive' }}</td>
                            <td>
                              <ul class="action">
                                <li><a href="{{ route('admin.business-listing.edit', $b->id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="#" data-toggle="modal" data-target="#delete-business"
                                    onclick="$('#delete_business #id').val({{ $b->id }})">
                                    <i class="fas fa-trash"></i>
                                  </a>
                                </li>
                              </ul>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="10" class="text-center">No records found</td>
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

  {{-- Delete Modal --}}
  <div class="modal" id="delete-business">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
        </center>

        <div class="modal-header">
          <h4 class="modal-title">Delete Business</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form id="delete_business" name="delete_business">
            <div class="form-group row">
              <center>Are you sure you want to delete this?</center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="id" />
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
  <script type="text/javascript">
    $(".btn-delete").on('click', function (e) {
      e.preventDefault();
      $(".loading_2").css('display', 'block');
      $(".btn-delete").attr('disabled', true);

      var id = $("#delete_business #id").val();
      $.ajax({
        url: '{{ url('admin/business-listing') }}/' + id,
        method: "DELETE",
        data: $("#delete_business").serialize(),
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            toastr.success(response.message)
            $("#delete-business").modal('hide');
            $("#" + id).remove();
          } else {
            toastr.error(response.message)
          }
        },
        error: function (response) {
          toastr.error('An error occured.')
        },
        complete: function () {
          $(".loading_2").css('display', 'none');
          $(".btn-delete").attr('disabled', false);
        }
      })
    });
  </script>
@endsection