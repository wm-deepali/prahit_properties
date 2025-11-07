

<?php $__env->startSection('title'); ?>
    <title>My Agent Profile Reviews</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Reviews</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agent Profile Reviews</li>
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
                    <?php if($reviews->count()): ?>
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Reviewer Name</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    
                                        <td><?php echo e($review->name); ?></td>
                                        <td>⭐ <?php echo e($review->rating); ?>/5</td>
                                        <td><?php echo e($review->comment); ?></td>
                                        <td><?php echo e($review->created_at->format('d M Y, h:i A')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($reviews->links()); ?>

                        </div>
                    <?php else: ?>
                        <p>No reviews found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/agent-profile-review.blade.php ENDPATH**/ ?>