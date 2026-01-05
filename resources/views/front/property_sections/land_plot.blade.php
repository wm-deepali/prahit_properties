<!-- Right: Key Details Grid -->
    <div class="row g-4">

        @isset($features['Name of the Society / Project'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Project</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i> {{ $features['Name of the Society / Project'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Property Facing'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Facing</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i> {{ $features['Property Facing'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Is in a gated colony'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-secondary border-5">
                    <div class="text-muted small fw-600">Gated Colony</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ ucfirst($features['Is in a gated colony']) }}
                    </div>
                </div>
            </div>
        @endisset

        @php
    $plotArea = isset($features['Plot Area']) ? (float) $features['Plot Area'] : null;
    $plotAreaUnit = $features['Plot Area Unit'] ?? '';
    $price = isset($property_detail->price) ? (float) $property_detail->price : null;

    $perUnitPrice = ($price && $plotArea && $plotArea > 0)
        ? round($price / $plotArea)
        : null;
@endphp

@if($plotArea && $plotArea > 0)
    <div class="col-12 col-lg-3">
        <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
            <div class="text-muted small fw-600">Plot Area</div>

            <div class="fw-bold text-dark fs-5">
                {{ number_format($plotArea) }}
                {{ $plotAreaUnit }}
            </div>

            @if($perUnitPrice && $plotAreaUnit)
                <div class="text-muted small">
                    ₹ {{ number_format($perUnitPrice) }} / {{ $plotAreaUnit }}
                </div>
            @endif
        </div>
    </div>
@endif

      @php
    $plotLength = isset($features['Plot Length']) ? trim($features['Plot Length']) : null;
    $plotLengthUnit = $features['Plot Length Unit'] ?? '';

    $plotBreadth = isset($features['Plot Breadth']) ? trim($features['Plot Breadth']) : null;
    $plotBreadthUnit = $features['Plot Breadth Unit'] ?? '';
@endphp

@if($plotLength && $plotBreadth)
    <div class="col-12 col-lg-3">
        <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
            <div class="text-muted small fw-600">Dimensions (L × B)</div>

            <div class="fw-bold text-dark fs-5">
                {{ $plotLength }}
                @if($plotLengthUnit) {{ $plotLengthUnit }} @endif
                ×
                {{ $plotBreadth }}
                @if($plotBreadthUnit) {{ $plotBreadthUnit }} @endif
            </div>
        </div>
    </div>
@endif


        @isset($features['No of open sides'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">No. of Open Sides</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['No of open sides'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Any Construction done'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Any Construction Done</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ ucfirst($features['Any Construction done']) }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Floors allowed for construction'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-secondary border-5">
                    <div class="text-muted small fw-600">Floor allowed</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Floors allowed for construction'] }}
                    </div>
                </div>
            </div>
        @endisset


        @isset($features['Boundary Wall ?'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Boundary Wall</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ ucfirst($features['Boundary Wall ?']) }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Overlooking'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                    <div class="text-muted small fw-600">Overlooking</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Overlooking'] }}
                    </div>
                </div>
            </div>
        @endisset


        @isset($features['Water Availability'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Water Availability</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Water Availability'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($features['Status of Electricity'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Status of Electricity</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Status of Electricity'] }}
                    </div>
                </div>
            </div>
        @endisset

    </div>

