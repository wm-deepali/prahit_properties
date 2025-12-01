@extends('layouts.front.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('title')
  <title>Pricing</title>
@endsection

@section('content')
  <style>
    .pricing-section {
      text-align: center;
      padding: 60px 0;
      background: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .pricing-section h2 {
      font-weight: 700;
      font-size: 32px;
      margin-bottom: 10px;
    }

    .pricing-table {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: auto;
    }

    .pricing-card {
      border: 1px solid #ddd;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      background: #fff;
    }

    .pricing-card .header {
      padding: 25px 15px;
      color: #fff;
    }

    .header.free {
      background: #f3fafd;
      color: #000;
    }

    .header.basic {
      background: #fffce1;
      color: #000;
    }

    .header.standard {
      background: #fff3ec;
      color: #000;
    }

    .header.premium {
      background: #f5ecff;
      color: #000;
    }

    .pricing-card h3 {
      font-weight: 700;
      font-size: 22px;
      margin-bottom: 8px;
    }

    .pricing-card .price {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .pricing-card table {
      width: 100%;
      text-align: left;
      font-size: 14px;
    }

    .pricing-card table td {
      padding: 8px 15px;
      border-bottom: 1px solid #eee;
    }

    .pricing-card table td:last-child {
      text-align: center;
      font-weight: 500;
    }

    .pricing-card table td i {
      color: green;
    }

    .pricing-footer {
      background: #f9f9f9;
      padding: 15px;
    }

    .pricing-card .btn-primary {
      background: #0d1b3e;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-weight: 500;
    }

    @media(max-width:768px) {
      .pricing-table {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <section class="pricing-section">
    <h2>{{ $packageType === 'service' ? 'Service Provider Packages' : 'Property Packages' }}</h2>
    <p>Compare features and choose the right plan for your {{ $packageType === 'service' ? 'business' : 'property' }}.</p>

    <div class="pricing-table">
      @forelse ($packages as $package)
        <div class="pricing-card">
          <div class="header free">
            <h3>{{ $package->name }}</h3>
            <p class="price">₹{{ number_format($package->price, 2) }}
              @if($package->duration && $package->duration_unit)
                / {{ $package->duration }} {{ ucfirst($package->duration_unit) }}
              @endif
            </p>
            <button class="btn btn-primary w-100 choose-plan-btn" data-id="{{ $package->id }}"
              data-name="{{ $package->name }}" data-price="{{ $package->price }}"
              data-description="{{ $package->description ?? 'Subscription Plan' }}">
              Choose Plan
            </button>
          </div>

          <table>
            @if($packageType === 'service')
              <tr>
                <td>Business Listing</td>
                <td>{{ $package->business_listing ?? '-' }}</td>
              </tr>
              <tr>
                <td>Total Services You Can List</td>
                <td>{{ $package->total_services ?? 'Unlimited' }}</td>
              </tr>
              <tr>
                <td>Profile Page with Contact Form</td>
                <td>{{ $package->profile_page_with_contact ?? '-' }}</td>
              </tr>
              <tr>
                <td>Business Logo & Banner</td>
                <td>{{ $package->business_logo_banner ?? '-' }}</td>
              </tr>
              <tr>
                <td>Appear in Local Search Results</td>
                <td>{{ $package->appear_in_local_search ?? '—' }}</td>
              </tr>
              <tr>
                <td>Verified Badge</td>
                <td>{{ $package->verified_badge ?? '-' }}</td>
              </tr>
              <tr>
                <td>Premium Badge</td>
                <td>{{ $package->premium_badge ?? '-' }}</td>
              </tr>
              <tr>
                <td>Image Upload</td>
                <td>{{ $package->image_upload_limit ?? '—' }}</td>
              </tr>
              <tr>
                <td>Video Upload</td>
                <td>{{ $package->video_upload_service ?? "-" }}</td>
              </tr>
              <tr>
                <td>Lead Enquiries</td>
                <td>{{ $package->lead_enquiries ?? '—' }}</td>
              </tr>
              <tr>
                <td>Response Rate</td>
                <td>{{ $package->response_rate_service ?? '—' }}</td>
              </tr>
              <tr>
                <td>Featured in “Top Service Providers”</td>
                <td>{{ $package->featured_in_top_provider ?? '-' }}</td>
              </tr>
              <tr>
                <td>Customer Support</td>
                <td>{{ $package->customer_support_service ?? '—' }}</td>
              </tr>
              <tr>
                <td>Lead Alerts via SMS/Email</td>
                <td>{{ $package->lead_alerts ?? '-' }}</td>
              </tr>
            @else
              <tr>
                <td>Number of Listings</td>
                <td>{{ $package->number_of_listing ?? '—' }}</td>
              </tr>
              <tr>
                <td>Photos per Listing</td>
                <td>{{ $package->photos_per_listing ?? '—' }}</td>
              </tr>
              <tr>
                <td>Video Upload</td>
                <td>{{ $package->video_upload }}</td>
              </tr>
              <tr>
                <td>Response Rate</td>
                <td>{{ $package->response_rate ?? '—' }}</td>
              </tr>
              <tr>
                <td>Property Visibility</td>
                <td>{{ $package->property_visibility ?? '—' }}</td>
              </tr>
              <tr>
                <td>Verified Tag</td>
                <td>{{ $package->verified_tag ?? '—' }}</td>
              </tr>
              <tr>
                <td>Premium Seller</td>
                <td>{{ $package->premium_seller ?? '—' }}</td>
              </tr>
              <tr>
                <td>Profile Page</td>
                <td>{{ $package->profile_page ?? '—' }}</td>
              </tr>
              <tr>
                <td>Profile Visibility</td>
                <td>{{ $package->profile_visibility ?? '—' }}</td>
              </tr>
              <tr>
                <td>Profile in Search Result</td>
                <td>{{ $package->profile_in_search_result ?? '—' }}</td>
              </tr>
              <tr>
                <td>Priority in Search</td>
                <td>{{ $package->priority_in_search ?? '—' }}</td>
              </tr>
              <tr>
                <td>Customer Support</td>
                <td>{{ $package->customer_support ?? '—' }}</td>
              </tr>
              <tr>
                <td>Lead Alerts</td>
                <td>{{ $package->lead_alerts ?? '—' }}</td>
              </tr>
            @endif

            <tr>
              <td>Validity</td>
              <td>
                {{ $package->validity }}
              </td>
            </tr>
          </table>
        </div>
      @empty
        <p>No packages available at this time.</p>
      @endforelse
    </div>
  </section>


  <!-- Payment Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Complete Your Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <input type="hidden" id="selected_package_id">
          <input type="hidden" id="selected_package_name">
          <input type="hidden" id="selected_package_amount">
          <input type="hidden" id="selected_package_description">

          <p>Choose your preferred payment method:</p>

          <button class="btn btn-success w-100 my-2" id="payOnlineBtn">
            <i class="fa fa-credit-card"></i> Pay with Razorpay
          </button>

          <button class="btn btn-secondary w-100 my-2" data-bs-dismiss="modal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const isLoggedIn = @json(Auth::check());
      const csrfToken = "{{ csrf_token() }}";
      const redirectAfterPayment = "{{ route('user.dashboard') }}";

      $('.choose-plan-btn').click(function () {
        const packageId = $(this).data('id');
        const name = $(this).data('name');
        const price = parseFloat($(this).data('price'));
        const description = $(this).data('description');

        if (!isLoggedIn) {
          Swal.fire({
            icon: 'warning',
            title: 'Login Required',
            text: 'Please login to continue with your plan selection.',
            showCancelButton: true,
            confirmButtonText: 'Login / Signup',
            cancelButtonText: 'Cancel'
          }).then(result => {
            if (result.isConfirmed) {
              $('#signin').modal('show');
            }
          });
          return;
        }

        // ✅ FREE PACKAGE → DIRECT SUBSCRIPTION
        if (price === 0) {
          Swal.fire({
            icon: "info",
            title: "Activating Free Plan...",
            text: "Please wait...",
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 1200
          });

          fetch("{{ route('subscription.store') }}", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
              razorpay_payment_id: 'test_payment_' + Date.now(),
              package_id: packageId,
              payment_method: "free"
            })
          })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Subscription Activated!',
                  text: 'Your free plan is now active.'
                }).then(() => {
                  const urlParams = new URLSearchParams(window.location.search);
                  const redirectUrl = urlParams.get('redirect_url');

                  if (redirectUrl) {
                    window.location.href = redirectUrl;
                  } else {
                    window.location.reload();
                  }
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: data.message || 'Something went wrong.'
                });
              }
            });

          return; // ⛔ STOP here, do not show payment modal
        }

        // ❗ PAID PACKAGE → Show Payment Modal
        $('#selected_package_id').val(packageId);
        $('#selected_package_name').val(name);
        $('#selected_package_amount').val(price);
        $('#selected_package_description').val(description);
        $('#paymentModal').modal('show');
      });


      $('#payOnlineBtn').click(function () {
        const selectedPackage = {
          id: $('#selected_package_id').val(),
          name: $('#selected_package_name').val(),
          amount: $('#selected_package_amount').val(),
          description: $('#selected_package_description').val()
        };

        // ✅ Fake Payment Simulation
        Swal.fire({
          icon: 'info',
          title: 'Testing Mode',
          text: 'Simulating payment success...',
          timer: 1500,
          showConfirmButton: false,
          willClose: () => {
            // simulate a fake Razorpay payment ID
            const fakeResponse = { razorpay_payment_id: 'test_payment_' + Date.now() };

            fetch("{{ route('subscription.store') }}", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
              },
              body: JSON.stringify({
                razorpay_payment_id: fakeResponse.razorpay_payment_id,
                package_id: selectedPackage.id,
                payment_method: "test" // ✅ mark this as test mode
              })
            })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Subscription Activated!',
                    text: 'Your subscription has been successfully activated.'
                  }).then(() => {
                    // ✅ Check if redirect_url is present in the query string
                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectUrl = urlParams.get('redirect_url');

                    if (redirectUrl) {
                      // Go back to the page the user came from
                      window.location.href = redirectUrl;
                    } else {
                      // Otherwise, reload current page or redirect to dashboard
                      window.location.reload();
                      // OR window.location.href = '/user/dashboard';
                    }
                  });
                }
                else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Test subscription failed.'
                  });
                }
              });
          }
        });
      });


      // $('#payOnlineBtn').click(function () {
      //     const selectedPackage = {
      //         id: $('#selected_package_id').val(),
      //         name: $('#selected_package_name').val(),
      //         amount: $('#selected_package_amount').val() * 100, // in paise
      //         description: $('#selected_package_description').val()
      //     };

      //     const options = {
      //         key: "{{ config('services.razorpay.key') }}",
      //         amount: selectedPackage.amount,
      //         currency: "INR",
      //         name: "Flippingo",
      //         description: selectedPackage.description,
      //         image: "{{ asset('logo.png') }}",
      //         handler: function (response) {
      //             fetch("{{ route('subscription.store') }}", {
      //                 method: "POST",
      //                 headers: {
      //                     "Content-Type": "application/json",
      //                     "X-CSRF-TOKEN": csrfToken
      //                 },
      //                 body: JSON.stringify({
      //                     razorpay_payment_id: response.razorpay_payment_id,
      //                     package_id: selectedPackage.id,
      //                     payment_method: "razorpay"
      //                 })
      //             })
      //             .then(res => res.json())
      //             .then(data => {
      //                 if (data.success) {
      //                     Swal.fire({
      //                         icon: 'success',
      //                         title: 'Subscription Activated!',
      //                         text: 'Your subscription has been activated successfully.'
      //                     }).then(() => {
      //                         window.location.href = redirectAfterPayment;
      //                     });
      //                 } else {
      //                     Swal.fire({
      //                         icon: 'error',
      //                         title: 'Error!',
      //                         text: data.message || 'Payment was successful but subscription failed.'
      //                     });
      //                 }
      //             });
      //         },
      //         prefill: {
      //             name: "{{ Auth::user()->name ?? '' }}",
      //             email: "{{ Auth::user()->email ?? '' }}"
      //         },
      //         theme: {
      //             color: "#0d1b3e"
      //         }
      //     };

      //     const rzp = new Razorpay(options);
      //     rzp.open();
      // });
    });
  </script>
@endsection