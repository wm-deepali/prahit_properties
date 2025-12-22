<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        <?php if(isset($features['Property Facing'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Facing</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i> <?php echo e($features['Property Facing']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Is in a gated colony'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-secondary border-5">
                    <div class="text-muted small fw-600">Gated Colony</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e(ucfirst($features['Is in a gated colony'])); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Plot Area'])): ?>
            <?php
                $carpetArea = (float) $features['Plot Area'];
                $unit = $features['Plot Area Unit'] ?? '';
                $price = isset($property_detail->price)
                    ? (float) $property_detail->price
                    : null;

                $perUnitPrice = ($price && $carpetArea > 0)
                    ? round($price / $carpetArea)
                    : null;
            ?>

            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
                    <div class="text-muted small fw-600">Plot Area</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Plot Area']); ?> <?php echo e($features['Plot Area Unit'] ?? ''); ?>

                    </div>
                    <?php if($perUnitPrice): ?>
                        <div class="text-muted small">
                            ₹ <?php echo e(number_format($perUnitPrice)); ?> / <?php echo e($unit); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Plot Length']) && isset($features['Plot Breadth'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                    <div class="text-muted small fw-600">Dimensions (L × B)</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Plot Length']); ?> × <?php echo e($features['Plot Breadth']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['No of open sides'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">No. of Open Sides</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['No of open sides']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Any Construction done'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Any Construction Done</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e(ucfirst($features['Any Construction done'])); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Boundry Wall made'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Boundary Wall</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e(ucfirst($features['Boundry Wall made'])); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Overlooking'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                    <div class="text-muted small fw-600">Overlooking</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Overlooking']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['Transaction Type'])): ?>
            <div class="col-12 col-lg-4">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Transaction Type</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['Transaction Type']); ?>

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
    </div><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_sections/sell_residential_land_plot.blade.php ENDPATH**/ ?>