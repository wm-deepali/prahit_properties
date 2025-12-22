<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        
        <?php if(isset($features['Commercial Complex'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Commercial Complex</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Commercial Complex']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($features['Carpet Area'])): ?>
            <?php
                $carpetArea = (float) $features['Carpet Area'];
                $unit = $features['Carpet Area Unit'] ?? '';
                $price = isset($property_detail->price)
                    ? (float) $property_detail->price
                    : null;

                $perUnitPrice = ($price && $carpetArea > 0)
                    ? round($price / $carpetArea)
                    : null;
            ?>

            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Carpet Area</div>

                    <div class="fw-bold text-dark fs-5">
                        <?php echo e(number_format($carpetArea)); ?> <?php echo e($unit); ?>

                    </div>

                    <?php if($perUnitPrice): ?>
                        <div class="text-muted small">
                            ₹ <?php echo e(number_format($perUnitPrice)); ?> / <?php echo e($unit); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Super Area'])): ?>
            <?php
                $superArea = (float) $features['Super Area'];
                $unit = $features['Super Area Unit'] ?? '';
                $price = isset($property_detail->price)
                    ? (float) $property_detail->price
                    : null;

                $perUnitPrice = ($price && $superArea > 0)
                    ? round($price / $superArea)
                    : null;
            ?>

            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Super Area</div>

                    <div class="fw-bold text-dark fs-5">
                        <?php echo e(number_format($superArea)); ?> <?php echo e($unit); ?>

                    </div>

                    <?php if($perUnitPrice): ?>
                        <div class="text-muted small">
                            ₹ <?php echo e(number_format($perUnitPrice)); ?> / <?php echo e($unit); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>


        
        <?php if(isset($features['Floor No.'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Floor No.']); ?>

                        <?php if(isset($features['Total Floors'])): ?>
                            (Out of <?php echo e($features['Total Floors']); ?> Floors)
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

          <?php if(isset($features['Units on Floor'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">Units on Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Units on Floor']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>


        <?php if(isset($features['Pantry Cafeteria'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Pantry Cafeteria</div>
                <div class="fw-bold text-dark fs-5">
                   <i class="fas fa-mug-hot"></i>
                    <?php echo e($features['Pantry Cafeteria']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

          <?php if(isset($features['Washrooms'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Washrooms</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-restroom"></i>
                    <?php echo e($features['Washrooms']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php if(isset($features['Number of lifts'])): ?>
            <?php if((int) $features['Number of lifts'] > 0): ?>
                <div class="col-12 col-lg-4">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Lift</div>
                        <div class="fw-bold text-dark fs-5">
                           <i class="fas fa-elevator"></i>
                            <?php echo e($features['Number of lifts']); ?>

                            Lift<?php echo e($features['Number of lifts'] > 1 ? 's' : ''); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>


        <?php if(isset($features['Property Facing'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Facing</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i>
                        <?php echo e(ucfirst($features['Property Facing'])); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

         <?php if(isset($features['Car Parking'])): ?>
            <?php if((int) $features['Car Parking'] > 0): ?>
                <div class="col-12 col-lg-4">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Car Parking</div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="fas fa-car"></i>
                            <?php echo e($features['Car Parking']); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

   

        <?php if($features['Furnished Status']): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Furnished Status</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Furnished Status']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>


        <!-- Action Buttons -->
        <div class="mt-4 pt-3 border-top">
            <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                <button type="button" class="btn btn-outline-primary btn-lg px-4 rounded-pill shadow-sm"
                    onclick="claim('<?php echo e($property_detail->id); ?>')">
                    <i class="fas fa-shield-alt"></i> Claim This Listing
                </button>
                <button type="button" class="btn btn-outline-warning btn-lg px-4 rounded-pill shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#feedback-complaint">
                    <i class="fas fa-phone"></i> Feedback & Complaint </button>
                <button id="wishlistButton" class="btn btn-outline-danger btn-lg px-4 rounded-pill shadow-sm"
                    data-submission="<?php echo e($property_detail->id); ?>">
                    <?php echo $isInWishlist
    ? '<i class="fas fa-heart"></i> Added to Wishlist'
    : '<i class="far fa-heart"></i> Add to Wishlist'; ?>

                </button>
            </div>
        </div>
    </div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_sections/sell_office_space.blade.php ENDPATH**/ ?>