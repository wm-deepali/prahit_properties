@extends('layouts.front.app')

@section('title')
    <title>Profile Section</title>
@endsection

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Profile Section</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Section</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="owner-section profile py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    @include('front.user.sidebar')
                </div>

                <div class="col-md-9">
                    <div class="main-area-dash card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Business Profile Details</h5>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('user.profile.section.update') }}"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Business Logo --}}
<div class="mb-4">
    <label class="form-label fw-semibold">Business Logo</label>
    <input type="file" class="form-control" name="logo" accept="image/*">

    @if(!empty($profileSection->logo))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $profileSection->logo) }}" alt="Business Logo"
                class="img-thumbnail" style="max-height: 120px;">
        </div>
    @endif
</div>


                                {{-- Business Info --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Business Name</label>
                                    <input type="text" class="form-control" name="business_name"
                                        value="{{ old('business_name', $profileSection->business_name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">RERA Number</label>
                                    <input type="text" class="form-control" name="rera_number"
                                        value="{{ old('rera_number', $profileSection->rera_number) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Operating Since</label>
                                    <input type="text" class="form-control" name="operating_since"
                                        value="{{ old('operating_since', $profileSection->operating_since) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Years of Experience</label>
                                    <input type="number" class="form-control" name="years_experience" min="0"
                                        value="{{ old('years_experience', $profileSection->years_experience) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deals In</label>
                                    <input type="text" class="form-control" name="deals_in"
                                        value="{{ old('deals_in', $profileSection->deals_in) }}">
                                    <small class="text-muted">Separate multiple values with commas.</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">
                                                {{ old('description', $profileSection->description) }}
                                            </textarea>
                                </div>

                                {{-- ✅ Dynamic Services Section --}}
                                <div class="services-section p-3 border rounded mb-4">
                                    <h5 class="mb-3">Services Offered</h5>
                                    <div id="services-container">
                                        @php
                                            $services = $profileSection->services;
                                        @endphp

                                        @forelse($services as $index => $service)
                                            <div class="service-item border p-3 mb-2 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-5 mb-2">
                                                        <input type="text" class="form-control"
                                                            name="services[{{ $index }}][title]" placeholder="Service Title"
                                                            value="{{ $service['title'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control"
                                                            name="services[{{ $index }}][description]"
                                                            placeholder="Short Description"
                                                            value="{{ $service['description'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-1 text-end">
                                                        <button type="button" class="btn btn-danger btn-sm remove-service">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="service-item border p-3 mb-2 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-5 mb-2">
                                                        <input type="text" class="form-control" name="services[0][title]"
                                                            placeholder="Service Title">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control" name="services[0][description]"
                                                            placeholder="Short Description">
                                                    </div>
                                                    <div class="col-md-1 text-end">
                                                        <button type="button" class="btn btn-danger btn-sm remove-service">
                                                            <i class="fas fa-times"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                    <button type="button" id="add-service" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle"></i> Add More
                                    </button>
                                </div>

                                {{-- ✅ Contact Information Section --}}
                                <div class="contact-section p-3 border rounded mb-4">
                                    <h5 class="mb-3">Contact Information</h5>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $profileSection['address'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{  $profileSection['phone'] }}">
                                              <small class="text-muted">Separate multiple values with commas.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $profileSection['email'] }}">
                                    </div>

                                    @php
    // Load existing working_hours as array if present, otherwise create sensible defaults
    $existingWH =$profileSection['working_hours'] ;

    if (!$existingWH || !is_array($existingWH)) {
        $existingWH = [
            ['day' => 'Monday - Friday', 'start' => '09:00', 'end' => '19:00', 'closed' => false],
            ['day' => 'Saturday',        'start' => '10:00', 'end' => '17:00', 'closed' => false],
            ['day' => 'Sunday',          'start' => '',      'end' => '',      'closed' => true ],
        ];
    }
@endphp

<div class="contact-section p-3 border rounded mb-4">
    <h5 class="mb-3">Contact Information</h5>

    <div class="mb-4">
        <h5 class="mb-2">Working Hours</h5>

        <div id="working-hours-container">
            @foreach($existingWH as $index => $wh)
                <div class="timing-item row align-items-center mb-2 gx-2" data-index="{{ $index }}">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="working_hours[{{ $index }}][day]"
                               value="{{ $wh['day'] ?? '' }}" placeholder="Day or range (e.g. Monday - Friday)">
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm start-time"
                               name="working_hours[{{ $index }}][start]" value="{{ $wh['start'] ?? '' }}"
                               @if(!empty($wh['closed'])) disabled @endif>
                    </div>

                    <div class="col-md-2">
                        <input type="time" class="form-control form-control-sm end-time"
                               name="working_hours[{{ $index }}][end]" value="{{ $wh['end'] ?? '' }}"
                               @if(!empty($wh['closed'])) disabled @endif>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input closed-checkbox" type="checkbox"
                                   name="working_hours[{{ $index }}][closed]" value="1"
                                   id="closed_{{ $index }}" {{ !empty($wh['closed']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="closed_{{ $index }}">Closed</label>
                        </div>
                    </div>

                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-working-hour" title="Remove">
                           <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-2">
            <button type="button" id="add-working-hour" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add Row
            </button>
            <small class="text-muted d-block mt-1">Use rows to show day ranges or individual days. Time fields use 24-hour format.</small>
        </div>
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
            </div>
        </div>
    </section>
@endsection

@section('js')
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

@endsection