<div class="single-listing card shadow-sm mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="card-img" src="<?php echo e(asset($v->PropertyGallery[0]->image_path ?? 'front/images/no-image.jpg')); ?>"
        alt="<?php echo e($v->title); ?>" style="object-fit: cover; height: 200px;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title property-title">
          <a href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>"><?php echo e($v->title); ?></a>
        </h5>

        <p class="card-text"><strong>Price:</strong> <i class="fas fa-rupee-sign"></i>
          <?php echo e(\App\Helpers\Helper::formatIndianPrice($v->price)); ?></p>
        <p class="card-text"><strong>Category:</strong> <?php echo e($v->Category->category_name ?? '-'); ?></p>
        <p class="card-text"><strong>Subcategory:</strong> <?php echo e($v->SubCategory->sub_category_name ?? '-'); ?></p>
        <p class="card-text"><strong>Location:</strong>
          <?php echo e($v->getCity->name ?? 'N/A'); ?>, <?php echo e($v->getState->name ?? 'N/A'); ?>

        </p>

        <div class="property-buttons mt-2">
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a href="<?php echo e(url('update/property/' . $v->id)); ?>" class="btn btn-sm btn-outline-primary"
                title="Edit Property">
                <i class="fas fa-pencil-alt"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>" class="btn btn-sm btn-outline-info"
                title="View Property">
                <i class="fas fa-eye"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a style="cursor:pointer;" onclick="deleteProperty('<?php echo e($v->id); ?>')" class="btn btn-sm btn-outline-danger"
                title="Delete Property">
                <i class="fas fa-trash"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/partials/property-card.blade.php ENDPATH**/ ?>