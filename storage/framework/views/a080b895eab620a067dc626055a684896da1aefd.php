

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
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
            </li>
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

  <!-- Top Cards -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100">
        <div class="card-body">
          <h6 class="card-title">Current Month</h6>
          <p class="card-text display-5 m-0">12</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100" style="background-color: #fce4ec;">
        <div class="card-body">
          <h6 class="card-title">Last Month</h6>
          <p class="card-text display-5 m-0">8</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100" style="background-color: #e0f7fa;">
        <div class="card-body">
          <h6 class="card-title">Total</h6>
          <p class="card-text display-5 m-0">120</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Inquiries Table -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>Date & Time</th>
          <th>Customer Detail</th>
          <th>Property ID</th>
          <th>Property Detail</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Row -->
        <tr>
          <td>23 Oct 2025, 08:00 PM</td>
          <td>
            John Doe<br>
            john@example.com<br>
            +91-9451591515
          </td>
          <td>PR-001</td>
          <td>3BHK Apartment, Mumbai, Residential</td>
          <td><span class="badge bg-success">Viewed</span></td>
          <td>
            <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewInquiryModal">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-sm btn-danger">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
        <!-- Repeat rows as needed -->
      </tbody>
    </table>
  </div>

  <!-- View Inquiry Modal -->
  <div class="modal fade" id="viewInquiryModal" tabindex="-1" aria-labelledby="viewInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewInquiryLabel">Inquiry Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <h6>Property Details</h6>
          <ul class="list-unstyled mb-3">
            <li><strong>Property ID:</strong> PR-001</li>
            <li><strong>Category:</strong> Residential</li>
            <li><strong>Type:</strong> Apartment</li>
            <li><strong>Title:</strong> 3BHK Apartment</li>
            <li><strong>Posted On:</strong> 20 Oct 2025</li>
          </ul>
          <h6>Customer Details</h6>
          <ul class="list-unstyled">
            <li><strong>Name:</strong> John Doe</li>
            <li><strong>Email ID:</strong> john@example.com</li>
            <li><strong>Mobile Number:</strong> +91-9451591515</li>
            <li><strong>Location:</strong> Mumbai</li>
          </ul>
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
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/all-inquries.blade.php ENDPATH**/ ?>