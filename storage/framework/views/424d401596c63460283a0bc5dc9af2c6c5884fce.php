<tr id="<?php echo e($b->id); ?>">
    <td><?php echo e($c + 1); ?></td>
    <td><?php echo e($b->created_at->format('d-m-Y H:i')); ?></td>
    <td><?php echo e($b->business_name); ?></td>
    <td>
        <?php echo e($b->email); ?> <br>
        <?php echo e($b->mobile_number); ?>

    </td>
    <td><?php echo e(ucfirst($b->membership_type)); ?></td>
    <td>
        <?php echo e($b->category ? $b->category->category_name : '-'); ?> <br>
        <?php if($b->subCategories && count($b->subCategories) > 0): ?>
            <?php echo e(implode(', ', $b->subCategories->pluck('sub_category_name')->toArray())); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php
            $pc = $b->propertyCategories ?? collect();
            $psc = $b->propertySubCategories ?? collect();
            $pssc = $b->propertySubSubCategories ?? collect();
        ?>
        <?php if($pc->count() === ($pc instanceof \Illuminate\Support\Collection ? $pc : collect($pc))->count() && $pc->count() > 0 && $pc->count() === \App\Category::count()): ?>
            All
        <?php else: ?>
            <?php echo e($pc->count() ? $pc->pluck('category_name')->implode(', ') : '-'); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php if($psc->count() && $pc->count() === 1 && $psc->count() === \App\SubCategory::where('category_id', $pc->first()->id)->count()): ?>
            All
        <?php else: ?>
            <?php echo e($psc->count() ? $psc->pluck('sub_category_name')->implode(', ') : '-'); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php echo e($pssc->count() ? $pssc->pluck('sub_sub_category_name')->implode(', ') : '-'); ?>

    </td>
    <td><?php echo e($b->total_views ?? 0); ?></td>
    <td><?php echo e($b->total_enquiries ?? 0); ?></td>
    <td><?php echo e($b->user ? $b->user->firstname : 'Admin'); ?> <?php echo e($b->user ? $b->user->lastname : '-'); ?></td>
    <td><?php echo e($b->status == 'Active' ? 'Active' : 'Inactive'); ?></td>
    <td>
        <ul class="action">
            <li><a href="<?php echo e(route('admin.business-listing.edit', $b->id)); ?>"><i class="fas fa-pencil-alt"></i></a></li>
            <li>
                <a href="#" data-toggle="modal" data-target="#delete-business"
                    onclick="$('#delete_business #id').val(<?php echo e($b->id); ?>)">
                    <i class="fas fa-trash"></i>
                </a>
            </li>
            <li>
                <?php if($b->is_published): ?>
                    <!-- Business is currently published → admin can unpublish -->
                    <button class="btn btn-warning btn-sm btn-toggle-status" data-id="<?php echo e($b->id); ?>" data-status="false">
                        Unpublish
                    </button>
                <?php else: ?>
                    <!-- Business is currently unpublished → admin can publish -->
                    <button class="btn btn-success btn-sm btn-toggle-status" data-id="<?php echo e($b->id); ?>" data-status="true">
                        Publish
                    </button>
                <?php endif; ?>
            </li>

        </ul>

    </td>
</tr><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/business-listing/business-table.blade.php ENDPATH**/ ?>