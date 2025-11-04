

<?php $__env->startSection('title'); ?>
    <title>My Sent Enquiries</title>
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
                            <li class="breadcrumb-item active" aria-current="page">Sent Enquiries</li>
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
                                    <p class="card-text display-5 m-0"><?php echo e($currentMonthCount); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm text-center h-100" style="background-color: #fce4ec;">
                                <div class="card-body">
                                    <h6 class="card-title">Last Month</h6>
                                    <p class="card-text display-5 m-0"><?php echo e($lastMonthCount); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm text-center h-100" style="background-color: #e0f7fa;">
                                <div class="card-body">
                                    <h6 class="card-title">Total</h6>
                                    <p class="card-text display-5 m-0"><?php echo e($totalCount); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($inquiries->count()): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Business</th>
                                    <th>Message</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Sent On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($enquiry->business->business_name ?? 'N/A'); ?><br>
                                            <?php echo e($enquiry->business->city ?? ''); ?><br>
                                        </td>
                                        <td>
                                            <?php echo e($enquiry->message); ?>

                                        </td>
                                        <td><?php echo e($enquiry->name); ?></td>
                                        <td><?php echo e($enquiry->email); ?></td>
                                        <td><?php echo e($enquiry->mobile); ?></td>
                                        <td><?php echo e($enquiry->created_at->format('d M Y, h:i A')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p>No enquiries found.</p>
                    <?php endif; ?>

                </div>
            </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/services/sent-inquiries.blade.php ENDPATH**/ ?>