<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

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

        @isset($features['Transaction Type'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                    <div class="text-muted small fw-600">Transaction Type</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Transaction Type'] }}
                    </div>
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

        @isset($features['Available from'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Available From</div>

                    <div class="fw-bold text-dark fs-5">
                        @if($features['Available from'] === 'Immediately')
                            Immediately
                        @elseif($features['Available from'] === 'select-date' && isset($features['Select Date']))
                            {{ \Carbon\Carbon::parse($features['Select Date'])->format('d M Y') }}
                        @else
                            —
                        @endif
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