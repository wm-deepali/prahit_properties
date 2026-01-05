<!-- Right: Key Details Grid -->
    <div class="row g-4">

        
        <?php if(isset($features['Name of the Society / Project'])): ?>
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Name of the Project</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Name of the Society / Project']); ?>

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

            <div class="col-12 col-lg-3">
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

            <div class="col-12 col-lg-3">
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
            <div class="col-12 col-lg-3">
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

        <?php if(isset($features['No. of Unit on Floor'])): ?>
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">No. of Unit on Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        <?php echo e($features['No. of Unit on Floor']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>


        <?php if(isset($features['Pantry Cafeteria'])): ?>
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Pantry Cafeteria</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-mug-hot"></i>
                    <?php echo e($features['Pantry Cafeteria']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($features['No. of Washrooms'])): ?>
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Washrooms</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-restroom"></i>
                    <?php echo e($features['No. of Washrooms']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php if(isset($features['Lift'])): ?>
                <div class="col-12 col-lg-3">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Lift</div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="fas fa-elevator"></i>
                            <?php echo e($features['Lift']); ?>

                        </div>
                    </div>
                </div>
        <?php endif; ?>


        <?php if(isset($features['Property Facing'])): ?>
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Facing</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i>
                        <?php echo e(ucfirst($features['Property Facing'])); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($features['No. of Car Parkings'])): ?>
            <?php if((int) $features['No. of Car Parkings'] > 0): ?>
                <div class="col-12 col-lg-3">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Car Parking</div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="fas fa-car"></i>
                            <?php echo e($features['No. of Car Parkings']); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($features['Furnishing Status'])): ?>
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Furnishing Status</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Furnishing Status']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($features['Suitable for'])): ?>
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Suitable for</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Suitable for']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
 <?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_sections/sell_office_space.blade.php ENDPATH**/ ?>