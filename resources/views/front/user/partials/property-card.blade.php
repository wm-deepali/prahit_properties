<div class="single-listing card shadow-sm mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img class="card-img" src="{{ asset($v->PropertyGallery[0]->image_path ?? 'front/images/no-image.jpg') }}"
        alt="{{ $v->title }}" style="object-fit: cover; height: 200px;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title property-title">
          <a href="{{ route('property_detail', ['title' => $v->slug]) }}">{{ $v->title }}</a>
        </h5>

        <p class="card-text"><strong>Price:</strong> <i class="fas fa-rupee-sign"></i>
          {{\App\Helpers\Helper::formatIndianPrice($v->price)}}</p>
        <p class="card-text"><strong>Category:</strong> {{ $v->Category->category_name ?? '-' }}</p>
        <p class="card-text"><strong>Subcategory:</strong> {{ $v->SubCategory->sub_category_name ?? '-' }}</p>
        <p class="card-text"><strong>Location:</strong>
          {{ $v->getCity->name ?? 'N/A' }}, {{ $v->getState->name ?? 'N/A' }}
        </p>

        <div class="property-buttons mt-2">
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a href="{{ url('update/property/' . $v->id) }}" class="btn btn-sm btn-outline-primary"
                title="Edit Property">
                <i class="fas fa-pencil-alt"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="{{ route('property_detail', ['title' => $v->slug]) }}" class="btn btn-sm btn-outline-info"
                title="View Property">
                <i class="fas fa-eye"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a style="cursor:pointer;" onclick="deleteProperty('{{ $v->id }}')" class="btn btn-sm btn-outline-danger"
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