

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
  <h5 class="mb-4">My Activities</h5>
  <div class="row g-3">
    <!-- Wishlist Card -->
    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100">
        <div class="card-body">
          <h6 class="card-title">Wishlist</h6>
          <p class="card-text display-5 m-0">12</p>
        </div>
      </div>
    </div>

    <!-- Viewed Card -->
    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100" style="background-color: #fce4ec;">
        <div class="card-body">
          <h6 class="card-title">Viewed</h6>
          <p class="card-text display-5 m-0">34</p>
        </div>
      </div>
    </div>

    <!-- Contacted Card -->
    <div class="col-md-4">
      <div class="card shadow-sm text-center h-100" style="background-color: #e0f7fa;">
        <div class="card-body">
          <h6 class="card-title">Contacted</h6>
          <p class="card-text display-5 m-0">7</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Last Login Info as Cards -->
  <div class="row mt-4 g-3">
    <div class="col-md-6">
      <div class="card text-center shadow-sm" style="background-color: #fff3e0;">
        <div class="card-body">
          <strong>Last Successful Login:</strong><br>
          23rd October 2025, 08:00 PM, Mumbai
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-center shadow-sm" style="background-color: #f3e5f5;">
        <div class="card-body">
          <strong>Last Unsuccessful Login:</strong><br>
          20th October 2025, 09:00 PM, Lucknow
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/my-activities.blade.php ENDPATH**/ ?>