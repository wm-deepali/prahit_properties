<!-- Right: Key Details Grid -->
 
    <div class="row g-4">

        {{-- Project --}}
        @isset($features['Name of the Society / Project'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Name of the Society / Project</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Name of the Society / Project'] }}
                </div>
            </div>
        </div>
        @endif

        @isset($features['Carpet Area'])
            @php
                $carpetArea = (float) $features['Carpet Area'];
                $unit = $features['Carpet Area Unit'] ?? '';
                $price = isset($property_detail->price)
                    ? (float) $property_detail->price
                    : null;

                $perUnitPrice = ($price && $carpetArea > 0)
                    ? round($price / $carpetArea)
                    : null;
            @endphp

            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Carpet Area</div>

                    <div class="fw-bold text-dark fs-5">
                        {{ number_format($carpetArea) }} {{ $unit }}
                    </div>

                    @if($perUnitPrice)
                        <div class="text-muted small">
                            ₹ {{ number_format($perUnitPrice) }} / {{ $unit }}
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        @isset($features['Super Area'])
            @php
                $superArea = (float) $features['Super Area'];
                $unit = $features['Super Area Unit'] ?? '';
                $price = isset($property_detail->price)
                    ? (float) $property_detail->price
                    : null;

                $perUnitPrice = ($price && $superArea > 0)
                    ? round($price / $superArea)
                    : null;
            @endphp

            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Super Area</div>

                    <div class="fw-bold text-dark fs-5">
                        {{ number_format($superArea) }} {{ $unit }}
                    </div>

                    @if($perUnitPrice)
                        <div class="text-muted small">
                            ₹ {{ number_format($perUnitPrice) }} / {{ $unit }}
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        {{-- Floor --}}
        @isset($features['Floor No.'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Floor No.'] }}
                        @isset($features['Total Floors'])
                            (Out of {{ $features['Total Floors'] }} Floors)
                        @endisset
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['No. of Unit on Floor'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">No. of Unit on Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['No. of Unit on Floor'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Suitable for'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Suitable for</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Suitable for'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Maintenance Charge'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Maintenance Charge</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Maintenance Charge'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Locking Period'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Lock-in period</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Locking Period'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['lift'])
                <div class="col-12 col-lg-3">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Lift</div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="fas fa-elevator"></i>
                            {{ $features['lift'] }}
                        </div>
                    </div>
                </div>
        @endisset

        @isset($features['Property Facing'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Facing</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i>
                        {{ ucfirst($features['Property Facing']) }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Age of Construction (in years)'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Age Of Construction</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Age of Construction (in years)'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Furnishing Status'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Furnishing Status</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Furnishing Status'] }}
                </div>
            </div>
        </div>
        @endisset

    </div>