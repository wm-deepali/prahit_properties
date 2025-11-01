

<?php $__env->startSection('title'); ?>
<title>Invoice Details</title>
<?php $__env->stopSection(); ?>

<style>
.invoice-card {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  margin-bottom: 30px;
}

.invoice-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
  border-bottom: 2px solid #eaeaea;
  padding-bottom: 20px;
  margin-bottom: 20px;
}

.invoice-header .company-details,
.invoice-header .user-details {
  width: 48%;
}

.invoice-header h4 {
  margin-bottom: 10px;
  font-weight: 600;
}

.invoice-header p {
  margin: 0;
  font-size: 14px;
  color: #444;
}

.invoice-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

.invoice-table th,
.invoice-table td {
  border: 1px solid #ddd;
  padding: 10px 12px;
  font-size: 14px;
  text-align: left;
}

.invoice-table th {
  background: #f4f6fb;
  font-weight: 600;
}

.total-section {
  text-align: right;
  margin-top: 10px;
  font-size: 16px;
  font-weight: 600;
}

.btn-download {
  display: inline-block;
  background-color: #007bff;
  color: #fff;
  padding: 10px 18px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s ease;
}

.btn-download:hover {
  background-color: #0056b3;
  color: #fff;
}
</style>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>Invoice Details</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice Details</li>
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
        <div class="invoice-card">
          
          <!-- Header Section -->
          <div class="invoice-header">
            <div class="company-details">
              <h4>🏢 Tirkey Estates Pvt. Ltd.</h4>
              <p>Plot No. 23, Tech Park Road</p>
              <p>Bangalore - 560103</p>
              <p>Email: support@tirkey.com</p>
              <p>Phone: +91-9876543210</p>
            </div>

            <div class="user-details">
              <h4>👤 Customer Details</h4>
              <p><strong>Name:</strong> <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></p>
              <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
              <p><strong>Mobile:</strong> <?php echo e($user->mobile_number); ?></p>
              <p><strong>Address:</strong> <?php echo e($user->address ?? 'N/A'); ?></p>
            </div>
          </div>

          <!-- Invoice Details Table -->
          <div class="table-responsive">
            <table class="invoice-table">
              <thead>
                <tr>
                  <th>Package</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Transaction ID</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo e($subscription->package->name ?? 'N/A'); ?></td>
                  <td><?php echo e(\Carbon\Carbon::parse($subscription->start_date)->format('d M Y')); ?></td>
                  <td><?php echo e(\Carbon\Carbon::parse($subscription->end_date)->format('d M Y')); ?></td>
                  <td><?php echo e($subscription->payment->transaction_id ?? 'N/A'); ?></td>
                  <td>₹<?php echo e(number_format($subscription->amount, 2)); ?></td>
                  <td>
                    <?php
                      $status = $subscription->payment_status ?? $subscription->payment->status ?? 'pending';
                    ?>
                    <span class="badge bg-<?php echo e($status == 'success' ? 'success' : ($status == 'pending' ? 'warning' : 'danger')); ?> text-light">
                      <?php echo e(ucfirst($status)); ?>

                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Total -->
          <div class="total-section">
            Total Amount Paid: ₹<?php echo e(number_format($subscription->amount, 2)); ?>

          </div>

          <!-- Download Button -->
          <div class="text-end mt-4">
            <a href="#" class="btn-download">
              <i class="fas fa-file-pdf"></i> Download PDF
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/invoice-details.blade.php ENDPATH**/ ?>