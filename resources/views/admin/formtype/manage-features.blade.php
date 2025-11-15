@extends('layouts.app')

<style>
    .icon-picker-wrapper { position: relative; }

.icon-modal-backdrop {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: 998;
}

.icon-modal-content {
    position: fixed;
    top: 10%; left: 50%;
    transform: translateX(-50%);
    width: 500px;
    background: white;
    border-radius: 8px;
    padding: 15px;
    z-index: 999;
    max-height: 80%;
    overflow-y: auto;
}

.icon-modal-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.icon-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-gap: 12px;
}

.icon-item {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
    cursor: pointer;
    border-radius: 5px;
}

.icon-item:hover {
    background: #eef;
}

.icon-search {
    margin-bottom: 10px;
}

</style>
@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Features: {{ $form->name }} Manage</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

  <section class="content-main-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">


    <form action="{{ url('master/custom/form/features/save') }}" method="POST">
        @csrf

        <input type="hidden" name="form_id" value="{{ $form->id }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width:70px">Show</th>
                    <th>Field (type)</th>
                    <th>Preview</th>
                    <th>Label to show</th>
                    <th>Icon</th>
                    <th style="width:90px">Sort</th>
                </tr>
            </thead>

            <tbody>
                @foreach($fields as $field)
                    @php
                        $key = $field['key'];
                        $setting = $saved[$key] ?? null;

                        // safe default label
                        $displayLabel = old("label.$key", $setting->label_to_show ?? $field['label']);
                        $displayIcon = old("icon.$key", $setting->icon_class ?? '');
                        $displaySort = old("sort.$key", $setting->sort_order ?? '');
                        $isShown = old("show.$key", ($setting && $setting->show_in_front) ? '1' : null);
                    @endphp

                    <tr>
                        <td class="text-center align-middle">
                            <input type="checkbox" name="show[{{ $key }}]" value="1" {{ $isShown ? 'checked' : '' }}>
                        </td>

                        <td class="align-middle">
                            <strong>{{ $field['label'] }}</strong>
                            <div class="text-muted" style="font-size:12px;">{{ $field['type'] }}</div>
                        </td>

                        <td class="align-middle">
                            {{-- preview value --}}
                            @if($field['preview'] !== '')
                                <span>{{ $field['preview'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif

                            {{-- For complex types show sample details --}}
                            @if(isset($field['raw']['values']) && is_array($field['raw']['values']))
                                <div style="font-size:11px; margin-top:6px;">
                                    <em>Options:</em>
                                    <div>
                                        @foreach(array_slice($field['raw']['values'], 0, 6) as $opt)
                                            <span class="badge badge-light"
                                                style="margin-right:4px;">{{ $opt['label'] ?? $opt['value'] }}</span>
                                        @endforeach
                                        @if(count($field['raw']['values']) > 6)
                                            <small class="text-muted">+{{ count($field['raw']['values']) - 6 }} more</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </td>

                        <td class="align-middle">
                            <input type="text" class="form-control" name="label[{{ $key }}]" value="{{ $displayLabel }}">
                        </td>

                        <td class="align-middle">
    <div class="icon-picker-wrapper">
        <input type="hidden" name="icon[{{ $key }}]" class="icon-value" value="{{ $displayIcon }}">

        <!-- Selected icon preview -->
        <button type="button" class="btn btn-outline-secondary btn-block pick-icon">
            <i class="{{ $displayIcon ?: 'fas fa-icons' }}"></i> 
            <span class="ml-2 selected-icon-text">{{ $displayIcon ?: 'Select Icon' }}</span>
        </button>

        <!-- Modal -->
        <div class="icon-modal" style="display:none;">
            <div class="icon-modal-backdrop"></div>

            <div class="icon-modal-content">
                <div class="icon-modal-header">
                    <strong>Select Icon</strong>
                    <button type="button" class="close-icon-modal">&times;</button>
                </div>

                <input type="text" class="form-control icon-search" placeholder="Search icons...">

                <div class="icon-grid">
                    @foreach([
                        'fas fa-home','fas fa-bed','fas fa-bath','fas fa-car','fas fa-utensils','fas fa-star',
                        'fas fa-heart','fas fa-building','fas fa-house-user','fas fa-warehouse','fas fa-store',
                        'fas fa-money-bill','fas fa-chart-line','fas fa-clock','fas fa-phone','fas fa-envelope',
                        'fas fa-map-marker-alt','fas fa-bolt','fas fa-fire','fas fa-leaf','fas fa-tree',
                        'fas fa-mountain','fas fa-water','fas fa-swimmer','fas fa-snowflake','fas fa-fan',
                        'fas fa-gem','fas fa-trophy','fas fa-tags','fas fa-box','fas fa-chair','fas fa-couch',
                        'fas fa-tv','fas fa-bell','fas fa-lightbulb','fas fa-wifi','fas fa-shower',
                        'fas fa-plug','fas fa-lock','fas fa-key','fas fa-user','fas fa-users','fas fa-th',
                        'fas fa-list','fas fa-image','fas fa-camera','fas fa-video','fas fa-music'
                    ] as $icon)
                        <div class="icon-item" data-value="{{ $icon }}">
                            <i class="{{ $icon }}"></i>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</td>


                        <td class="align-middle">
                            <input type="number" class="form-control" name="sort[{{ $key }}]" value="{{ $displaySort }}">
                        </td>

                        {{-- hidden fields to preserve key/label/raw if needed --}}
                        <input type="hidden" name="field_keys[]" value="{{ $key }}">
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('master/custom/form') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function () {

    // open modal
    $(document).on("click", ".pick-icon", function () {
        $(this).closest(".icon-picker-wrapper").find(".icon-modal").show();
    });

    // close modal
    $(document).on("click", ".close-icon-modal, .icon-modal-backdrop", function () {
        $(".icon-modal").hide();
    });

    // live search
    $(document).on("keyup", ".icon-search", function () {
        let val = $(this).val().toLowerCase();
        $(this).closest(".icon-modal-content").find(".icon-item").each(function () {
            $(this).toggle($(this).attr("data-value").toLowerCase().includes(val));
        });
    });

    // selecting an icon
    $(document).on("click", ".icon-item", function () {
        let icon = $(this).data("value");

        let box = $(this).closest(".icon-picker-wrapper");
        box.find(".icon-value").val(icon);
        box.find(".selected-icon-text").text(icon);
        box.find(".pick-icon i").attr("class", icon);

        $(".icon-modal").hide();
    });

});
</script>
@endsection
