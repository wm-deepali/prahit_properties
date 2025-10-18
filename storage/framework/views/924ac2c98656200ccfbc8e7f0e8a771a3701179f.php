<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(url('/')); ?>/<?php echo e($city->name); ?>"><li class="filter-city"><?php echo e($city->name); ?></li></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<li style="margin-top:20px;"><?php echo e($cities->links()); ?></li><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/layouts/front/cities-ancher.blade.php ENDPATH**/ ?>