

<?php $__env->startSection('title'); ?>
  <title>My Properties</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>My Properties</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">My Properties</li>
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
          <?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="col-sm-9">
      

          <!-- Inquiries Table -->
          <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Date & Time</th>
                  <th>Customer Detail</th>
                  <th>Property ID</th>
                  <th>Property Detail</th>
                  <th>Interested In</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($enquiry->created_at->format('d M Y, h:i A')); ?></td>
                    <td>
                      <?php echo e($enquiry->name); ?><br>
                      <?php echo e($enquiry->email); ?><br>
                      <?php echo e($enquiry->mobile_number); ?>

                    </td>
                    <td><?php echo e($enquiry->Property->id ?? 'N/A'); ?></td>
                    <td>
                      <?php echo e($enquiry->Property->title ?? 'N/A'); ?><br>
                      <?php echo e($enquiry->Property->getCity->name ?? ''); ?><br>
                      <?php echo e($enquiry->Property->Category->category_name ?? ''); ?>

                    </td>
                    <?php
                      $interestedTypes = [
                        1 => 'Site Visit',
                        2 => 'Immediate Purchase',
                        3 => 'Home Loan'
                      ];
                    ?>

                    <td>
                      <span class="badge bg-info"><?php echo e($interestedTypes[$enquiry->interested_in] ?? 'N/A'); ?></span>
                    </td>

                    <td>
                      <button class="btn btn-sm btn-primary me-1 view-inquiry-btn" data-bs-toggle="modal"
                        data-bs-target="#viewInquiryModal" data-enquiry='<?php echo json_encode($enquiry, 15, 512) ?>'>
                        <i class="fas fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr>
                    <td colspan="6" class="text-center">No enquiries found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- View Inquiry Modal -->
          <div class="modal fade" id="viewInquiryModal" tabindex="-1" aria-labelledby="viewInquiryLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="viewInquiryLabel">Inquiry Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div id="inquiryDetails"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".view-inquiry-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
          const enquiry = JSON.parse(this.getAttribute("data-enquiry"));

          // format created_at (property creation date)
          const formatDate = (dateStr) => {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            return date.toLocaleString('en-IN', {
              day: '2-digit',
              month: 'short',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit',
              hour12: true
            });
          };

          const postedOn = formatDate(enquiry.property?.created_at);
          const enquiredOn = formatDate(enquiry.created_at);

          let html = `
          <h6>Property Details</h6>
          <ul class="list-unstyled mb-3">
            <li><strong>Property ID:</strong> ${enquiry.property?.id ?? 'N/A'}</li>
            <li><strong>Property Available for:</strong> ${enquiry.property?.category?.category_name ?? 'N/A'}</li>
            <li><strong>Property Category:</strong> ${enquiry.property?.sub_category?.sub_category_name ?? 'N/A'}</li>
            <li><strong>Property Type:</strong> ${enquiry.property?.sub_sub_category?.sub_sub_category_name ?? 'N/A'}</li>
            <li><strong>Title:</strong> ${enquiry.property?.title ?? 'N/A'}</li>
            <li><strong>Location:</strong> ${enquiry.property?.get_city?.name ?? 'N/A'}</li>
            <li><strong>Posted On:</strong> ${postedOn}</li>
          </ul>

          <h6>Customer Details</h6>
          <ul class="list-unstyled">
            <li><strong>Name:</strong> ${enquiry.name}</li>
            <li><strong>Email ID:</strong> ${enquiry.email}</li>
            <li><strong>Mobile Number:</strong> ${enquiry.mobile_number}</li>
            <li><strong>Interested In:</strong> ${enquiry.interested_in == 1 ? 'Site Visit' :
              enquiry.interested_in == 2 ? 'Immediate Purchase' :
                enquiry.interested_in == 3 ? 'Home Loan' : 'N/A'
            }</li>
            <li><strong>Enquired On:</strong> ${enquiredOn}</li>
          </ul>
        `;

          document.getElementById("inquiryDetails").innerHTML = html;
        });
      });
    });

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/sent-inquiries.blade.php ENDPATH**/ ?>