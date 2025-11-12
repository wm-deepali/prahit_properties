

<?php $__env->startSection('title'); ?>
    Agent Profile Section
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Agent Business Profile</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('agent.index')); ?>">Agents</a></li>
                <li class="breadcrumb-item active">Profile Section</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="content-main-body py-4">
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Business Profile Details - <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></h5>
                <a href="<?php echo e(route('profile.page', $user->slug ?? $user->id)); ?>" target="_blank" class="btn btn-light btn-sm">
                    <i class="fa fa-external-link-alt"></i> View Public Profile
                </a>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('agent.update',$user->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Business Logo</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">

                        <?php if(!empty($profileSection->logo)): ?>
                            <div class="mt-2">
                                <img src="<?php echo e(asset('storage/' . $profileSection->logo)); ?>" alt="Business Logo"
                                     class="img-thumbnail" style="max-height: 120px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Business Name</label>
                            <input type="text" class="form-control" name="business_name"
                                value="<?php echo e(old('business_name', $profileSection->business_name)); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">RERA Number</label>
                            <input type="text" class="form-control" name="rera_number"
                                value="<?php echo e(old('rera_number', $profileSection->rera_number)); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Operating Since</label>
                            <input type="text" class="form-control" name="operating_since"
                                value="<?php echo e(old('operating_since', $profileSection->operating_since)); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Years of Experience</label>
                            <input type="number" class="form-control" name="years_experience" min="0"
                                value="<?php echo e(old('years_experience', $profileSection->years_experience)); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deals In</label>
                        <input type="text" class="form-control" name="deals_in"
                            value="<?php echo e(old('deals_in', $profileSection->deals_in)); ?>">
                        <small class="text-muted">Separate multiple values with commas.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">
                            <?php echo e(old('description', $profileSection->description)); ?>

                        </textarea>
                    </div>

                    
                    <div class="services-section p-3 border rounded mb-4">
                        <h5 class="mb-3">Services Offered</h5>
                        <div id="services-container">
                            <?php $services = $profileSection->services ?? []; ?>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="service-item border p-3 mb-2 rounded bg-light">
                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <input type="text" class="form-control"
                                                name="services[<?php echo e($index); ?>][title]"
                                                value="<?php echo e($service['title'] ?? ''); ?>" placeholder="Service Title">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <input type="text" class="form-control"
                                                name="services[<?php echo e($index); ?>][description]"
                                                value="<?php echo e($service['description'] ?? ''); ?>"
                                                placeholder="Short Description">
                                        </div>
                                        <div class="col-md-1 text-end">
                                            <button type="button" class="btn btn-danger btn-sm remove-service">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <button type="button" id="add-service" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="bi bi-plus-circle"></i> Add More
                        </button>
                    </div>

                    
                    <div class="p-3 border rounded mb-4">
                        <h5 class="mb-3">Contact Information</h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" class="form-control" name="address"
                                value="<?php echo e($profileSection['address']); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" class="form-control" name="phone"
                                value="<?php echo e($profileSection['phone']); ?>">
                            <small class="text-muted">Separate multiple values with commas.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="<?php echo e($profileSection['email']); ?>">
                        </div>
                    </div>

                    
                                                       <?php
    // Load existing working_hours as array if present, otherwise create sensible defaults
    $existingWH =$profileSection['working_hours'] ;

    if (!$existingWH || !is_array($existingWH)) {
        $existingWH = [
            ['day' => 'Monday - Friday', 'start' => '09:00', 'end' => '19:00', 'closed' => false],
            ['day' => 'Saturday',        'start' => '10:00', 'end' => '17:00', 'closed' => false],
            ['day' => 'Sunday',          'start' => '',      'end' => '',      'closed' => true ],
        ];
    }
?>

<div class="contact-section p-3 border rounded mb-4">
    <h5 class="mb-3">Contact Information</h5>

    <div class="mb-4">
        <h5 class="mb-2">Working Hours</h5>

        <div id="working-hours-container">
            <?php $__currentLoopData = $existingWH; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="timing-item row align-items-center mb-2 gx-2" data-index="<?php echo e($index); ?>">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="working_hours[<?php echo e($index); ?>][day]"
                               value="<?php echo e($wh['day'] ?? ''); ?>" placeholder="Day or range (e.g. Monday - Friday)">
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm start-time"
                               name="working_hours[<?php echo e($index); ?>][start]" value="<?php echo e($wh['start'] ?? ''); ?>"
                               <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm end-time"
                               name="working_hours[<?php echo e($index); ?>][end]" value="<?php echo e($wh['end'] ?? ''); ?>"
                               <?php if(!empty($wh['closed'])): ?> disabled <?php endif; ?>>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input closed-checkbox" type="checkbox"
                                   name="working_hours[<?php echo e($index); ?>][closed]" value="1"
                                   id="closed_<?php echo e($index); ?>" <?php echo e(!empty($wh['closed']) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="closed_<?php echo e($index); ?>">Closed</label>
                        </div>
                    </div>

                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-working-hour" title="Remove">
                           <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-2">
            <button type="button" id="add-working-hour" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add Row
            </button>
            <small class="text-muted d-block mt-1">Use rows to show day ranges or individual days. Time fields use 24-hour format.</small>
        </div>
    </div>
</div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        CKEDITOR.replace('description', {
            height: 200,
            removeButtons: 'PasteFromWord',
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table'] },
                { name: 'styles', items: ['Format'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });

        // ✅ Add / Remove Services Script (keep yours as is)
        document.addEventListener('click', function (e) {
            if (e.target.closest('#add-service')) {
                let container = document.getElementById('services-container');
                let index = container.querySelectorAll('.service-item').length;
                let newItem = `
                            <div class="service-item border p-3 mb-2 rounded bg-light">
                                <div class="row">
                                    <div class="col-md-5 mb-2">
                                        <input type="text" class="form-control" name="services[${index}][title]" placeholder="Service Title">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" name="services[${index}][description]" placeholder="Short Description">
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-service"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>`;
                container.insertAdjacentHTML('beforeend', newItem);
            }

            if (e.target.closest('.remove-service')) {
                e.target.closest('.service-item').remove();
            }
        });
    </script>
    <script>
document.addEventListener('click', function (e) {
    // Add working hour row
    if (e.target.closest('#add-working-hour')) {
        let container = document.getElementById('working-hours-container');
        let index = container.querySelectorAll('.timing-item').length;
        let row = document.createElement('div');
        row.className = 'timing-item row align-items-center mb-2 gx-2';
        row.dataset.index = index;

        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" name="working_hours[${index}][day]" placeholder="Day or range (e.g. Monday - Friday)">
            </div>
            <div class="col-md-2">
                <input type="time" class="form-control form-control-sm start-time" name="working_hours[${index}][start]" value="">
            </div>
            <div class="col-md-2">
                <input type="time" class="form-control form-control-sm end-time" name="working_hours[${index}][end]" value="">
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input closed-checkbox" type="checkbox" name="working_hours[${index}][closed]" value="1" id="closed_${index}">
                    <label class="form-check-label" for="closed_${index}">Closed</label>
                </div>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm remove-working-hour" title="Remove">
                   <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    // Remove working hour row
    if (e.target.closest('.remove-working-hour')) {
        let row = e.target.closest('.timing-item');
        if (row) row.remove();

        // Re-index names so server receives contiguous indices
        reindexWorkingHours();
    }
});

// toggle time inputs when closed checkbox changes (use delegation)
document.addEventListener('change', function (e) {
    if (e.target.classList && e.target.classList.contains('closed-checkbox')) {
        let row = e.target.closest('.timing-item');
        if (!row) return;
        let start = row.querySelector('.start-time');
        let end = row.querySelector('.end-time');
        if (e.target.checked) {
            if (start) { start.disabled = true; start.value = ''; }
            if (end)   { end.disabled = true; end.value = ''; }
        } else {
            if (start) start.disabled = false;
            if (end)   end.disabled = false;
        }
        // after toggling, reindex names to keep inputs consistent
        reindexWorkingHours();
    }
});

// Reindex function - ensures names are sequential for server (0,1,2,...)
function reindexWorkingHours(){
    const container = document.getElementById('working-hours-container');
    const rows = container.querySelectorAll('.timing-item');
    rows.forEach((row, idx) => {
        row.dataset.index = idx;
        // update inputs' name and id attributes
        const day = row.querySelector('input[type="text"]');
        if (day) day.name = `working_hours[${idx}][day]`;

        const start = row.querySelector('.start-time');
        if (start) start.name = `working_hours[${idx}][start]`;

        const end = row.querySelector('.end-time');
        if (end) end.name = `working_hours[${idx}][end]`;

        const checkbox = row.querySelector('.closed-checkbox');
        if (checkbox) {
            checkbox.name = `working_hours[${idx}][closed]`;
            checkbox.id = `closed_${idx}`;
            const label = row.querySelector('label.form-check-label');
            if (label) label.htmlFor = `closed_${idx}`;
        }
    });
}

// Run once on load to ensure names are indexed correctly (useful if server-rendered indices were non-contiguous)
document.addEventListener('DOMContentLoaded', function(){ reindexWorkingHours(); });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/agent/profile-section.blade.php ENDPATH**/ ?>