

<?php $__env->startSection('title'); ?>
  <title>Pricing</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  background: #fff;
}
.pricing-card .header {
  padding: 25px 15px;
  color: #fff;
}
.header.free { background: #f3fafd; color:#000; }
.header.basic { background: #fffce1; color:#000; }
.header.standard { background: #fff3ec; color:#000; }
.header.premium { background: #f5ecff; color:#000; }

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
@media(max-width:768px){
  .pricing-table {
    grid-template-columns: 1fr;
  }
}
</style>

<section class="pricing-section">
  <h2>Service Provider Packages</h2>
  <p>Compare features and choose the right plan for your business.</p>

  <div class="pricing-table">
    <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="pricing-card">
        <div class="header free">
          <h3><?php echo e($package->name); ?></h3>
          <p class="price">₹<?php echo e(number_format($package->price, 2)); ?>

            <?php if($package->duration && $package->duration_unit): ?>
              / <?php echo e($package->duration); ?> <?php echo e(ucfirst($package->duration_unit)); ?>

            <?php endif; ?>
          </p>
          <button class="btn btn-primary w-100 choose-plan-btn" 
                  data-id="<?php echo e($package->id); ?>" 
                  data-name="<?php echo e($package->name); ?>"
                  data-price="<?php echo e($package->price); ?>"
                  data-description="<?php echo e($package->description ?? 'Subscription Plan'); ?>">
            Choose Plan
          </button>
        </div>

        <table>
          <tr><td>Business Listing</td><td><?php echo e($package->business_listing ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Total Services You Can List</td><td><?php echo e($package->service_limit ?? 'Unlimited'); ?></td></tr>
          <tr><td>Profile Page with Contact Form</td><td><?php echo e($package->profile_page_with_contact ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Business Logo & Banner</td><td><?php echo e($package->business_logo_banner ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Appear in Local Search Results</td><td><?php echo e($package->appear_in_search ?? '—'); ?></td></tr>
          <tr><td>Verified Badge</td><td><?php echo e($package->verified_badge ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Premium Badge</td><td><?php echo e($package->premium_badge ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Image Upload</td><td><?php echo e($package->image_upload_limit ?? '—'); ?></td></tr>
          <tr><td>Video Upload</td><td><?php echo e($package->video_upload ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Lead Enquiries</td><td><?php echo e($package->lead_enquiries ?? '—'); ?></td></tr>
          <tr><td>Response Rate</td><td><?php echo e($package->response_rate ?? '—'); ?></td></tr>
          <tr><td>Featured in “Top Service Providers”</td><td><?php echo e($package->featured_in_top ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Customer Support</td><td><?php echo e($package->customer_support ?? '—'); ?></td></tr>
          <tr><td>Lead Alerts via SMS/Email</td><td><?php echo e($package->lead_alerts ? 'Yes' : 'No'); ?></td></tr>
          <tr><td>Validity</td><td>
            <?php if($package->duration && $package->duration_unit): ?>
              <?php echo e($package->duration); ?> <?php echo e(ucfirst($package->duration_unit)); ?>

            <?php else: ?>
              —
            <?php endif; ?>
          </td></tr>
        </table>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p>No packages available at this time.</p>
    <?php endif; ?>


      <!-- Free Plan -->
    <div class="pricing-card">
      <div class="header free">
        <h3>Free</h3>
        <p class="price">Free for 1 Month</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>1</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>No</td></tr>
        <tr><td>Verified Badge</td><td>No</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>4</td></tr>
        <tr><td>Video Upload</td><td>Not Allowed</td></tr>
        <tr><td>Lead Enquiries</td><td>Limited</td></tr>
        <tr><td>Response Rate</td><td>Normal</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>1 Month</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: Free</h5>-->
      <!--</div>-->
    </div>

    <!-- Basic Plan -->
    <div class="pricing-card">
      <div class="header basic">
        <h3>Basic Plan</h3>
        <p class="price">₹1,999 / 3 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>3</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>Medium</td></tr>
        <tr><td>Verified Badge</td><td>No</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>5</td></tr>
        <tr><td>Video Upload</td><td>No</td></tr>
        <tr><td>Lead Enquiries</td><td>Moderate</td></tr>
        <tr><td>Response Rate</td><td>Standard</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email & Phone</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>3 Months</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹1,999 / 3 Months</h5>-->
      <!--</div>-->
    </div>

    <!-- Standard Plan -->
    <div class="pricing-card">
      <div class="header standard">
        <h3>Standard</h3>
        <p class="price">₹3,499 / 6 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>5</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>High</td></tr>
        <tr><td>Verified Badge</td><td>Yes</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>10</td></tr>
        <tr><td>Video Upload</td><td>Yes</td></tr>
        <tr><td>Lead Enquiries</td><td>High</td></tr>
        <tr><td>Response Rate</td><td>Up to 2 times more</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email / Phone / Chat</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>6 Months</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹3,499 / 6 Months</h5>-->
      <!--</div>-->
    </div>

    <!-- Premium Plan -->
    <div class="pricing-card">
      <div class="header premium">
        <h3>Premium</h3>
        <p class="price">₹9,999 / 12 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>Unlimited</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes (Featured)</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>Top Priority</td></tr>
        <tr><td>Verified Badge</td><td>Yes</td></tr>
        <tr><td>Premium Badge</td><td>Yes</td></tr>
        <tr><td>Image Upload</td><td>Yes</td></tr>
        <tr><td>Video Upload</td><td>Yes</td></tr>
        <tr><td>Lead Enquiries</td><td>Priority</td></tr>
        <tr><td>Response Rate</td><td>Up to 4 times more</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>Yes</td></tr>
        <tr><td>Customer Support</td><td>Dedicated</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>1 Year</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹9,999 / 12 Months</h5>-->
      <!--</div>-->
    </div>
    
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const isLoggedIn = <?php echo json_encode(Auth::check(), 15, 512) ?>;
  const csrfToken = "<?php echo e(csrf_token()); ?>";
  const redirectAfterPayment = "<?php echo e(route('user.dashboard')); ?>";

  $('.choose-plan-btn').click(function() {
      const packageId = $(this).data('id');
      const name = $(this).data('name');
      const price = $(this).data('price');
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
      } else {
          $('#selected_package_id').val(packageId);
          $('#selected_package_name').val(name);
          $('#selected_package_amount').val(price);
          $('#selected_package_description').val(description);
          $('#paymentModal').modal('show');
      }
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

            fetch("<?php echo e(route('subscription.store')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
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
                        text: 'Test subscription created successfully.'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
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
  //         key: "<?php echo e(config('services.razorpay.key')); ?>",
  //         amount: selectedPackage.amount,
  //         currency: "INR",
  //         name: "Flippingo",
  //         description: selectedPackage.description,
  //         image: "<?php echo e(asset('logo.png')); ?>",
  //         handler: function (response) {
  //             fetch("<?php echo e(route('subscription.store')); ?>", {
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
  //             name: "<?php echo e(Auth::user()->name ?? ''); ?>",
  //             email: "<?php echo e(Auth::user()->email ?? ''); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/pricing.blade.php ENDPATH**/ ?>