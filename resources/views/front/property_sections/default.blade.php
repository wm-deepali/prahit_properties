<!-- Right: Key Details Grid -->

<div class="row g-4">
	@if($property_detail->Category)
		<div class="col-12 col-lg-4">
			<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-primary border-5">
				<div class="text-muted small fw-600">Available For</div>
				<div class="fw-bold text-dark fs-5">
					{{ $property_detail->Category->category_name }}
				</div>
			</div>
		</div>
	@endif

	@if($property_detail->SubSubCategory)
		<div class="col-12 col-lg-4">
			<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-success border-5">
				<div class="text-muted small fw-600">Property Type</div>
				<div class="fw-bold text-dark fs-5">
					{{ $property_detail->SubSubCategory->sub_sub_category_name }}
				</div>
			</div>
		</div>
	@endif

	@if($property_user)
		<div class="col-12 col-lg-4">
			<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-warning border-5">
				<div class="text-muted small fw-600">Posted By</div>
				<div class="fw-bold text-dark fs-5">
					{{ $property_user->firstname }}
					{{ Str::limit($property_user->lastname, 1, '.') }}
					<small class="text-success">({{ ucfirst($property_user->role ?? 'User') }})</small>
				</div>
			</div>
		</div>
	@endif

	<div class="col-12 col-lg-4">
		<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-info border-5">
			<div class="text-muted small fw-600">Published</div>
			<div class="fw-bold text-dark fs-5">
				{{ \Carbon\Carbon::parse($property_detail->created_at)->format('d M, Y') }}
			</div>
		</div>
	</div>

	@if($property_detail->Location)
		<div class="col-12 col-lg-4">
			<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-purple border-5">
				<div class="text-muted small fw-600">Locality</div>
				<div class="fw-bold text-dark fs-5">
					{{ $property_detail->Location->location }}
				</div>
			</div>
		</div>
	@endif

	<div class="col-12 col-lg-4">
		<div class="detail-box text-center p-3 rounded-3 bg-light border-start border-danger border-5">
			<div class="text-muted small fw-600">Property ID</div>
			<div class="fw-bold text-dark fs-5">#{{ $property_detail->id }}</div>
		</div>
	</div>
</div>