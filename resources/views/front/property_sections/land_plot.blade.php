<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        @isset($features['Project'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Project</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-compass"></i> {{ $features['Project'] }}
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
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
                    <div class="text-muted small fw-600">Plot Area</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Plot Area'] }} {{ $features['Plot Area Unit'] ?? '' }}
                    </div>
                    @if($perUnitPrice)
                        <div class="text-muted small">
                            ₹ {{ number_format($perUnitPrice) }} / {{ $unit }}
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        @if(isset($features['Plot Length']) && isset($features['Plot Breadth']))
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                    <div class="text-muted small fw-600">Dimensions (L × B)</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Plot Length'] }} × {{ $features['Plot Breadth'] }}
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


        @isset($features['Boundary Wall made'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Boundary Wall</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ ucfirst($features['Boundary Wall made']) }}
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