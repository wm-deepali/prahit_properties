<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        {{-- Project --}}
        @isset($features['Commercial Complex'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Commercial Complex</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Commercial Complex'] }}
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

        @isset($features['Units on Floor'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                    <div class="text-muted small fw-600">Units on Floor</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Units on Floor'] }}
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

        @isset($features['Maintenance Charges'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Maintenance Charges</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Maintenance Charges'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Lock-in period'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Lock-in period</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Lock-in period'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Number of lifts'])
            @if((int) $features['Number of lifts'] > 0)
                <div class="col-12 col-lg-3">
                    <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                        <div class="text-muted small fw-600">Lift</div>
                        <div class="fw-bold text-dark fs-5">
                            <i class="fas fa-elevator"></i>
                            {{ $features['Number of lifts'] }}
                            Lift{{ $features['Number of lifts'] > 1 ? 's' : '' }}
                        </div>
                    </div>
                </div>
            @endif
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

        @isset($features['Age Of Construction'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Age Of Construction</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Age Of Construction'] }}
                </div>
            </div>
        </div>
        @endisset

        @isset($features['Furnished Status'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Furnished Status</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Furnished Status'] }}
                </div>
            </div>
        </div>
        @endisset

    </div>
    <!-- Action Buttons -->
    <div class="mt-4 pt-3 border-top">
        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
            <button type="button" class="btn btn-outline-primary btn-lg px-4 rounded-pill shadow-sm"
                onclick="claim('{{ $property_detail->id }}')">
                <i class="fas fa-shield-alt"></i> Claim This Listing
            </button>
            <button type="button" class="btn btn-outline-warning btn-lg px-4 rounded-pill shadow-sm"
                data-bs-toggle="modal" data-bs-target="#feedback-complaint">
                <i class="fas fa-phone"></i> Feedback & Complaint </button>
            <button id="wishlistButton" class="btn btn-outline-danger btn-lg px-4 rounded-pill shadow-sm"
                data-submission="{{ $property_detail->id }}">
                {!! $isInWishlist
    ? '<i class="fas fa-heart"></i> Added to Wishlist'
    : '<i class="far fa-heart"></i> Add to Wishlist' 
										!!}
            </button>
        </div>
    </div>
</div>