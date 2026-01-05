<!-- Right: Key Details Grid -->

    <div class="row g-4">

      @isset($features['No. of Bedrooms'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
                <div class="text-muted small fw-600">Bedrooms</div>

                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bed"></i>
                    {{ $features['No. of Bedrooms'] }} Beds
                </div>
            </div>
        </div>
        @endif

        @isset($features['No. of Bathrooms'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
                <div class="text-muted small fw-600">Bathrooms</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-bath"></i>
                    {{ $features['No. of Bathrooms'] }} Baths
                </div>
            </div>
        </div>
        @endif

        @isset($features['No. of Balconies'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
                <div class="text-muted small fw-600">Balconies</div>
                <div class="fw-bold text-dark fs-5">
                    <i class="fas fa-building"></i>
                    {{ $features['No. of Balconies'] }} Balconies
                </div>
            </div>
        </div>
        @endif

      
      @php
    $parkingAvailable = strtolower($features['Parking Available'] ?? '');
    $parkingType      = $features['Parking Type'] ?? '';
    $carParking       = (int) ($features['No. of Car Parkings'] ?? 0);
    $bikeParking      = (int) ($features['No. of Bike Parking'] ?? 0);
@endphp

@if(
    $parkingAvailable === 'yes' &&
    ($carParking > 0 || $bikeParking > 0)
)
    <div class="col-12 col-lg-3">
        <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
            <div class="text-muted small fw-600">Parking</div>

            <div class="fw-bold text-dark fs-5">
                <i class="fas fa-car"></i>

                {{-- Parking Type --}}
                @if(!empty($parkingType))
                    {{ $parkingType }}
                @endif

                {{-- Separator --}}
                @if(!empty($parkingType) && ($carParking > 0 || $bikeParking > 0))
                    ·
                @endif

                {{-- Car Parking --}}
                @if($carParking > 0)
                    {{ $carParking }} Car
                @endif

                {{-- Comma --}}
                @if($carParking > 0 && $bikeParking > 0)
                    ,
                @endif

                {{-- Bike Parking --}}
                @if($bikeParking > 0)
                    {{ $bikeParking }} Bike
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
        @isset($features['Name of the Society / Project'])
        <div class="col-12 col-lg-3">
            <div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
                <div class="text-muted small fw-600">Project</div>
                <div class="fw-bold text-dark fs-5">
                    {{ $features['Name of the Society / Project'] }}
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
 