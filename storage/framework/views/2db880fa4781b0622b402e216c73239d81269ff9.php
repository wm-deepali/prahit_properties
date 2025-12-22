<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        <?php if(isset($features['Bedroom'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
                <div class="text-muted small fw-600">Bedrooms</div>

                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bed"></i>
                    <?php echo e($features['Bedroom']); ?> Beds
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($features['Bathrooms'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Bathrooms</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bath"></i>
                    <?php echo e($features['Bathrooms']); ?> Baths
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($features['Balconies'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                <div class="text-muted small fw-600">Balconies</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-building"></i>
                    <?php echo e($features['Balconies']); ?> Balconies
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(
                (!empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0) ||
                (!empty($features['Open Parking']) && (int) $features['Open Parking'] > 0)
            ): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Parking</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-car"></i>

                        <?php if(!empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0): ?>
                            <?php echo e($features['Covered Parking']); ?> Covered
                        <?php endif; ?>

                        <?php if(
                                !empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0 &&
                                !empty($features['Open Parking']) && (int) $features['Open Parking'] > 0
                            ): ?>
                            ,
                        <?php endif; ?>

                        <?php if(!empty($features['Open Parking']) && (int) $features['Open Parking'] > 0): ?>
                            <?php echo e($features['Open Parking']); ?> Open
                        <?php endif; ?>
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


        
        <?php if(isset($features['Name of Project/Society'])): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Project</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Name of Project/Society']); ?>

                </div>
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


        <?php if(isset($features['Transaction Type'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Transaction Type</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Transaction Type']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($property_detail->property_status): ?>
        <div class="col-12 col-lg-4">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Status</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($property_detail->getPropertyStatuses($property_detail->property_status) ?? 'N/A'); ?>

                </div>
            </div>
        </div>
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
    </div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_sections/sell_residential_flat.blade.php ENDPATH**/ ?>