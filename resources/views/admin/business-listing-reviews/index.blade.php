@extends('layouts.app')

@section('title')
  Manage Business Listing Reviews
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
            <h3 class="content-header-title">Business Listing Reviews</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Web Directory</li>
              <li class="breadcrumb-item active">Manage Reviews</li>
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
                        <th>Business Detail</th>
                        <th>Reviewer Detail</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Added By (User)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($reviews) && count($reviews) > 0)
                        @foreach($reviews as $key => $review)
                          <tr id="review-{{ $review->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>
                              {{ $review->businessListing->business_name ?? 'N/A' }}<br>
                              {{ $review->businessListing->category->category_name  ?? ''}}<br>
                              {{ $review->businessListing->subCategories->pluck('sub_category_name')->implode(', ')  ?? ''}}
                            </td>
                            <td>
                              {{ $review->name ?? 'N/A' }}<br>
                              {{ $review->email ?? 'N/A' }}<br>
                              {{ $review->phone ?? 'N/A' }}
                            </td>
                            <td>{{ $review->rating ?? 'N/A' }}/5</td>
                            <td>{{ Str::limit($review->comment, 50) }}</td>
                            <td>{{ $review->created_at ? $review->created_at->format('d M Y') : 'N/A' }}</td>
                            <td>{{ $review->user->firstname ?? 'Guest' }} {{ $review->user->lastname ?? '' }}</td>
                            <td>
                              <button class="btn btn-info btn-sm btn-view" data-id="{{ $review->id }}">
                                <i class="fa fa-eye"></i>
                              </button>
                              <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $review->id }}">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="9" class="text-center">No reviews found</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>

                  <div class="mt-3">
                    {{ $reviews->links() }}
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- View Modal --}}
  <div class="modal fade" id="viewReviewModal" tabindex="-1" role="dialog" aria-labelledby="viewReviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Review Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <label><strong>Business Name:</strong></label>
              <p class="business_name"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Reviewer Name:</strong></label>
              <p class="reviewer_name"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Email:</strong></label>
              <p class="review_email"></p>
            </div>
            <div class="col-sm-6">
              <label><strong>Phone:</strong></label>
              <p class="review_phone"></p>
            </div>
            <div class="col-sm-12">
              <label><strong>Rating:</strong></label>
              <p class="review_rating"></p>
            </div>
            <div class="col-sm-12">
              <label><strong>Comment:</strong></label>
              <p class="review_comment"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Delete Modal --}}
  <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to delete this review?</p>
          <button type="button" class="btn btn-danger btn-confirm-delete">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" id="delete_review_id" />
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function () {

      // Open View Modal
      $(".btn-view").on('click', function () {
        var id = $(this).data('id');
        $.ajax({
          url: '{{ route("admin.business-listing-reviews.show", ":id") }}'.replace(':id', id),
          method: 'GET',
          beforeSend: function () { $(".loading").show(); },
          success: function (response) {
            $(".loading").hide();
            $(".business_name").text(response.data.business_listing?.business_name ?? 'N/A');
            $(".reviewer_name").text(response.data.name ?? 'N/A');
            $(".review_email").text(response.data.email ?? 'N/A');
            $(".review_phone").text(response.data.phone ?? 'N/A');
            $(".review_rating").text(response.data.rating + '/5');
            $(".review_comment").text(response.data.comment ?? 'N/A');
            $("#viewReviewModal").modal('show');
          },
          error: function () {
            $(".loading").hide();
            toastr.error("Unable to fetch review details.");
          }
        });
      });

      // Open Delete Modal
      $(".btn-delete").on('click', function () {
        var id = $(this).data('id');
        $("#delete_review_id").val(id);
        $("#deleteReviewModal").modal('show');
      });

      // Confirm Delete
      $(".btn-confirm-delete").on('click', function () {
        var id = $("#delete_review_id").val();

        $.ajax({
          url: '{{ route("admin.business-listing-reviews.destroy", ":id") }}'.replace(':id', id),
          method: 'POST',
          data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
          success: function (response) {
            if (response.status === 200) {
              toastr.success(response.message);
              location.reload();
              $("#deleteReviewModal").modal('hide');
              $("#review-" + id).remove();
            } else {
              toastr.error(response.message);
            }
          },
          error: function () {
            toastr.error('An error occurred while deleting the review.');
          }
        });
      });

    });
  </script>
@endsection