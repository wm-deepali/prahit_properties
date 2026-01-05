<!-- Right: Key Details Grid -->
<div class="row g-4">

    @isset($features['Width of road facing the plot'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Width of Road</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Width of road facing the plot'] }} wide road
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

    @isset($features['Possession Status'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Possession Status</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Possession Status'] }}
                </div>
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
                <div class="text-muted small fw-600">Super Built-up Area</div>

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

    @isset($features['Plot Area'])
        @php
            $carpetArea = (float) $features['Plot Area'];
            $unit = $features['Plot Area Unit'] ?? '';
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


    @isset($features['Available From'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">
                    Available From
                </div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Available From'] }}
                </div>
            </div>
        </div>
    @endisset
</div>