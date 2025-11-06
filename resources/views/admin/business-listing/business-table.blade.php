<tr id="{{ $b->id }}">
    <td>{{ $c + 1 }}</td>
    <td>{{ $b->created_at->format('d-m-Y H:i') }}</td>
    <td>{{ $b->business_name }}</td>
    <td>
        {{ $b->email }} <br>
        {{ $b->mobile_number }}
    </td>
    <td>{{ ucfirst($b->membership_type) }}</td>
    <td>
        {{ $b->category ? $b->category->category_name : '-' }} <br>
        @if($b->subCategories && count($b->subCategories) > 0)
            {{ implode(', ', $b->subCategories->pluck('sub_category_name')->toArray()) }}
        @endif
    </td>
    <td>
        @php
            $pc = $b->propertyCategories ?? collect();
            $psc = $b->propertySubCategories ?? collect();
            $pssc = $b->propertySubSubCategories ?? collect();
        @endphp
        @if($pc->count() === ($pc instanceof \Illuminate\Support\Collection ? $pc : collect($pc))->count() && $pc->count() > 0 && $pc->count() === \App\Category::count())
            All
        @else
            {{ $pc->count() ? $pc->pluck('category_name')->implode(', ') : '-' }}
        @endif
    </td>
    <td>
        @if($psc->count() && $pc->count() === 1 && $psc->count() === \App\SubCategory::where('category_id', $pc->first()->id)->count())
            All
        @else
            {{ $psc->count() ? $psc->pluck('sub_category_name')->implode(', ') : '-' }}
        @endif
    </td>
    <td>
        {{ $pssc->count() ? $pssc->pluck('sub_sub_category_name')->implode(', ') : '-' }}
    </td>
    <td>{{ $b->total_views ?? 0 }}</td>
    <td>{{ $b->total_enquiries ?? 0 }}</td>
    <td>{{ $b->user ? $b->user->firstname : 'Admin' }} {{ $b->user ? $b->user->lastname : '-' }}</td>
    <td>{{ $b->status == 'Active' ? 'Active' : 'Inactive' }}</td>
    <td>
        <ul class="action">
            <li><a href="{{ route('admin.business-listing.edit', $b->id) }}"><i class="fas fa-pencil-alt"></i></a></li>
            <li>
                <a href="#" data-toggle="modal" data-target="#delete-business"
                    onclick="$('#delete_business #id').val({{ $b->id }})">
                    <i class="fas fa-trash"></i>
                </a>
            </li>
            <li>
                @if($b->is_published)
                    <!-- Business is currently published → admin can unpublish -->
                    <button class="btn btn-warning btn-sm btn-toggle-status" data-id="{{ $b->id }}" data-status="false">
                        Unpublish
                    </button>
                @else
                    <!-- Business is currently unpublished → admin can publish -->
                    <button class="btn btn-success btn-sm btn-toggle-status" data-id="{{ $b->id }}" data-status="true">
                        Publish
                    </button>
                @endif
            </li>

        </ul>

    </td>
</tr>