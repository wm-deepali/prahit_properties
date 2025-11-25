<div class="single-listing card shadow-sm mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="card-img" src="<?php echo e(isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80'); ?>"
        alt="<?php echo e($company->business_name); ?>" style="object-fit: cover; height: 200px;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title property-title">
          <a href="<?php echo e(route('business.details', ['id' => $company->id, 'slug' => $company->slug])); ?>"><?php echo e($company->business_name); ?></a>
        </h5>

        <!-- <p class="card-text"><strong>Price:</strong> <i class="fas fa-rupee-sign"></i> -->
          <!-- <?php echo e(\App\Helpers\Helper::formatIndianPrice($v->price)); ?></p> -->
        <p class="card-text"><strong>Category:</strong> <?php echo e($company->category->category_name ?? 'N/A'); ?></p>
        <p class="card-text"><strong>Subcategory:</strong> <?php echo e($company->subCategories->pluck('sub_category_name')->implode(', ')); ?></p>
        <p class="card-text"><strong>Established:</strong>
          <?php echo e($company->established_year); ?>

        </p>

        <div class="property-buttons mt-2">
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a href="<?php echo e(route('user.services.edit', $company->id)); ?>" class="btn btn-sm btn-outline-primary"
                title="Edit Property">
                <i class="fas fa-pencil-alt"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="<?php echo e(route('business.details', ['id' => $company->id, 'slug' => $company->slug])); ?>" class="btn btn-sm btn-outline-info"
                title="View Business Listing">
                <i class="fas fa-eye"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a style="cursor:pointer;" onclick="deleteBusiness('<?php echo e($company->id); ?>')" class="btn btn-sm btn-outline-danger"
                title="Delete Property">
                <i class="fas fa-trash"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/partials/directory-card.blade.php ENDPATH**/ ?>