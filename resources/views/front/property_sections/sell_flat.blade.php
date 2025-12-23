<!-- Right: Key Details Grid -->
<div class="col-md-8">
    <div class="row g-4">

        @isset($features['Bedroom'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
                <div class="text-muted small fw-600">Bedrooms</div>

                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bed"></i>
                    {{ $features['Bedroom'] }} Beds
                </div>
            </div>
        </div>
        @endif

        @isset($features['Bathrooms'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Bathrooms</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bath"></i>
                    {{ $features['Bathrooms'] }} Baths
                </div>
            </div>
        </div>
        @endif

        @isset($features['Balconies'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                <div class="text-muted small fw-600">Balconies</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-building"></i>
                    {{ $features['Balconies'] }} Balconies
                </div>
            </div>
        </div>
        @endif

        @if(
                (!empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0) ||
                (!empty($features['Open Parking']) && (int) $features['Open Parking'] > 0)
            )
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
                    <div class="text-muted small fw-600">Parking</div>
                    <div class="fw-bold text-dark fs-5">
                        <i class="fas fa-car"></i>

                        @if(!empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0)
                            {{ $features['Covered Parking'] }} Covered
                        @endif

                        @if(
                                !empty($features['Covered Parking']) && (int) $features['Covered Parking'] > 0 &&
                                !empty($features['Open Parking']) && (int) $features['Open Parking'] > 0
                            )
                            ,
                        @endif

                        @if(!empty($features['Open Parking']) && (int) $features['Open Parking'] > 0)
                            {{ $features['Open Parking'] }} Open
                        @endif
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


        {{-- Project --}}
        @isset($features['Name of Project/Society'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Project</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Name of Project/Society'] }}
                </div>
            </div>
        </div>
        @endif

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


        @isset($features['Transaction Type'])
            <div class="col-12 col-lg-3">
                <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
                    <div class="text-muted small fw-600">Transaction Type</div>
                    <div class="fw-bold text-dark fs-5">
                        {{ $features['Transaction Type'] }}
                    </div>
                </div>
            </div>
        @endisset

        @isset($property_detail->property_status)
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Status</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $property_detail->getPropertyStatuses($property_detail->property_status) ?? 'N/A' }}
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


        @isset($property_detail->property_status_second)
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">
                    {{ optional($property_detail->getPropertyStatusObj())->second_input_label ?? 'Possession By' }}
                </div>
                <div class="fw-bold text-dark fs-5">
                    {{ $property_detail->property_status_second }}
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