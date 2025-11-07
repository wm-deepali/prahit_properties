

<?php $__env->startSection('title'); ?>
    <title>My Sent Reviews</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="breadcrumb-section">
    <div class="container">
        <h3>My Sent Reviews</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="breadcrumb-item active">Sent Reviews</li>
            </ol>
        </nav>
    </div>
</section>

<section class="owner-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"><?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

            <div class="col-sm-9">
                <h5 class="mb-3">Agent Reviews You’ve Sent</h5>
                <?php if($agentReviews->count()): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Agent</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $agentReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($review->profileSection->user->firstname ?? 'N/A'); ?></td>
                                    <td><?php echo e($review->rating ?? '-'); ?></td>
                                    <td><?php echo e($review->comment ?? '-'); ?></td>
                                    <td><?php echo e($review->created_at->format('d M Y, h:i A')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No agent reviews sent yet.</p>
                <?php endif; ?>

                <h5 class="mt-5 mb-3">Business Listing Reviews You’ve Sent</h5>
                <?php if($businessReviews->count()): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Business</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $businessReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($review->businessListing->business_name ?? 'N/A'); ?></td>
                                    <td><?php echo e($review->rating ?? '-'); ?></td>
                                    <td><?php echo e($review->comment ?? '-'); ?></td>
                                    <td><?php echo e($review->created_at->format('d M Y, h:i A')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No business reviews sent yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/sent-reviews.blade.php ENDPATH**/ ?>