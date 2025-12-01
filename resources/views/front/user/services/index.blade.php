@extends('layouts.front.app')

@section('title')
  <title>My Business Listing</title>
@endsection

<style>
  .single-listing.card {
    border-radius: 10px;
    transition: transform 0.2s;
  }

  .single-listing.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .card-img {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
  }

  .card-body {
    padding: 1.25rem;
  }

  .property-title a {
    color: #007bff;
    text-decoration: none;
  }

  .property-title a:hover {
    color: #0056b3;
    text-decoration: underline;
  }

  .property-buttons .btn {
    margin-right: 5px;
  }

  .property-buttons .btn:last-child {
    margin-right: 0;
  }

  .alert-info {
    background-color: #e9f1ff;
    border-color: #cce5ff;
  }

  .card-text {
    margin: 0px;
    font-weight: 400;
    font-size: 14px;
  }
</style>

@section('content')

  <section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>My Business Listing</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">My Business Listing</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="owner-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          @include('front.user.sidebar')
        </div>
        <div class="col-sm-9">
          <div class="main-area-dash">
            <h3 class="head-tit">Business Listing</h3>
            <section class="dashboard-area account-my-properties">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="prop-published-tab" data-toggle="pill" href="#prop-published" role="tab"
                    aria-controls="prop-published" aria-selected="false">Published</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="prop-unpublished-tab" data-toggle="pill" href="#prop-unpublished" role="tab"
                    aria-controls="prop-unpublished" aria-selected="false">Unpublished</a>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">


                {{-- PUBLISHED --}}
                <div class="tab-pane fade show active" id="prop-published" role="tabpanel"
                  aria-labelledby="prop-published-tab">
                  <div class="row">
                    <div class="col-sm-12">
                      @if(count($published) > 0)
                        @foreach($published as $v)
                          @include('front.user.partials.directory-card', ['company' => $v])
                        @endforeach
                      @else
                        <div class="alert alert-info text-center">No published business listing</div>
                      @endif
                    </div>
                  </div>
                </div>

                {{-- REJECTED --}}
                <div class="tab-pane fade" id="prop-unPublished" role="tabpanel" aria-labelledby="prop-unpublished-tab">
                  <div class="row">
                    <div class="col-sm-12">
                      @if(count($unPublished) > 0)
                        @foreach($unPublished as $v)
                          @include('front.user.partials.directory-card', ['company' => $v])
                        @endforeach
                      @else
                        <div class="alert alert-info text-center">No unpublished business listing</div>
                      @endif
                    </div>
                  </div>
                </div>

              </div>

            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    function deleteBusiness(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Delete this Business Listing?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete",
        cancelButtonText: "Cancel",
        allowOutsideClick: false, // Prevent accidental delete
        allowEscapeKey: false
      }).then((result) => {

        if (result.isConfirmed) {

          $.ajax({
            method: 'DELETE',
            url: "{{ url('user/services/delete') }}/" + id,
            data: {
              "_token": "{{ csrf_token() }}",
              "_method": "DELETE"
            },
            success: function (data) {
              toastr.success(data.message || 'Deleted successfully');

              // Remove card from DOM
              $('#business-' + id).remove();
            },
            error: function (err) {
              toastr.error(err.responseJSON?.message || 'Something went wrong');
            }
          });

        }

      });
    }

  </script>

@endsection