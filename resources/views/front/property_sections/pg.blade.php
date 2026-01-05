<!-- Right: Key Details Grid -->
 
    <div class="row g-4">

        {{-- Deposit Amount --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Deposit Amount</div>
                <div class="fw-bold text-dark fs-5">
                    ₹{{ number_format($features['Security Deposit per bed'] ?? 0) }}
                </div>
            </div>
        </div>

        {{-- Maintenance --}}
        <!-- <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Maintenance</div>
                <div class="fw-bold text-dark fs-5">-</div>
            </div>
        </div> -->

        {{-- Notice Period --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Notice Period</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Select notice period'] ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Electricity Charges --}}
        <!-- <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Electricity Charges</div>
                <div class="fw-bold text-dark fs-5">-</div>
            </div>
        </div> -->

        {{-- Food Availability --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Food Availability</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Veg/nonveg Food Provided'] ?? '-' }}
                </div>
            </div>
        </div>

        {{-- AC Rooms (from Room Facilities) --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">AC Rooms</div>
                <div class="fw-bold text-dark fs-5">
                    {{ str_contains(strtolower($features['Room Facilities'] ?? ''), 'ac')
                        ? 'Available'
                        : '-' }}
                </div>
            </div>
        </div>

        {{-- Parking --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Parking</div>
                <div class="fw-bold text-dark fs-5">
                    {{ ($features['Parking availability'] ?? '') === 'yes' ? 'Available' : '-' }}
                </div>
            </div>
        </div>

        {{-- Power Backup (from Amenities) --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Power Backup</div>
                <div class="fw-bold text-dark fs-5">
                    {{ str_contains(strtolower($features['Amenities'] ?? ''), 'power backup')
                        ? 'Available'
                        : '-' }}
                </div>
            </div>
        </div>

        {{-- Available For --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Available for</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Preferred Gender'] ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Preferred Tenants --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Preferred Tenants</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Set Your Tenant Preferrence'] ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Total Beds --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Total Number of Beds</div>
                <div class="fw-bold text-dark fs-5">
                    {{ ((int)($features['No of rooms'] ?? 0)) * 2 }}
                </div>
            </div>
        </div>

        {{-- Operating Since --}}
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Operating Since</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['PG Operational since'] ?? '-' }}
                </div>
            </div>
        </div>

    </div>

 