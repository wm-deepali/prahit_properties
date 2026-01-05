<!-- Right: Key Details Grid -->
 
    <div class="row g-4">

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Deposit Amount</div>
                <div class="fw-bold text-dark fs-5">
                    ₹<?php echo e(number_format($features['Security Deposit per bed'] ?? 0)); ?>

                </div>
            </div>
        </div>

        
        <!-- <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Maintenance</div>
                <div class="fw-bold text-dark fs-5">-</div>
            </div>
        </div> -->

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Notice Period</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Select notice period'] ?? '-'); ?>

                </div>
            </div>
        </div>

        
        <!-- <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Electricity Charges</div>
                <div class="fw-bold text-dark fs-5">-</div>
            </div>
        </div> -->

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Food Availability</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Veg/nonveg Food Provided'] ?? '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">AC Rooms</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e(str_contains(strtolower($features['Room Facilities'] ?? ''), 'ac')
                        ? 'Available'
                        : '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Parking</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e(($features['Parking availability'] ?? '') === 'yes' ? 'Available' : '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Power Backup</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e(str_contains(strtolower($features['Amenities'] ?? ''), 'power backup')
                        ? 'Available'
                        : '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Available for</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Preferred Gender'] ?? '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Preferred Tenants</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['Set Your Tenant Preferrence'] ?? '-'); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Total Number of Beds</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e(((int)($features['No of rooms'] ?? 0)) * 2); ?>

                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Operating Since</div>
                <div class="fw-bold text-dark fs-5">
                    <?php echo e($features['PG Operational since'] ?? '-'); ?>

                </div>
            </div>
        </div>

    </div>

 <?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/property_sections/pg.blade.php ENDPATH**/ ?>