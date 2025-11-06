<div class="single-listing card shadow-sm mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="card-img" src="{{ isset($company->logo) ? asset('storage/' . $company->logo) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80' }}"
        alt="{{ $company->business_name }}" style="object-fit: cover; height: 200px;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title property-title">
          <a href="{{ route('business.details', $company->id) }}">{{ $company->business_name }}</a>
        </h5>

        <!-- <p class="card-text"><strong>Price:</strong> <i class="fas fa-rupee-sign"></i> -->
          <!-- {{\App\Helpers\Helper::formatIndianPrice($v->price)}}</p> -->
        <p class="card-text"><strong>Category:</strong> {{ $company->category->category_name ?? 'N/A' }}</p>
        <p class="card-text"><strong>Subcategory:</strong> {{ $company->subCategories->pluck('sub_category_name')->implode(', ') }}</p>
        <p class="card-text"><strong>Established:</strong>
          {{ $company->established_year }}
        </p>

        <div class="property-buttons mt-2">
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a href="{{ route('user.services.edit', $company->id) }}" class="btn btn-sm btn-outline-primary"
                title="Edit Property">
                <i class="fas fa-pencil-alt"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="{{ route('business.details', $company->id) }}" class="btn btn-sm btn-outline-info"
                title="View Business Listing">
                <i class="fas fa-eye"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a style="cursor:pointer;" onclick="deleteBusiness('{{ $company->id }}')" class="btn btn-sm btn-outline-danger"
                title="Delete Property">
                <i class="fas fa-trash"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>