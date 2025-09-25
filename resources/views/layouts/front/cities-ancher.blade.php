@foreach($cities as $city)
    <a href="{{ url('/') }}/{{ $city->name }}"><li class="filter-city">{{ $city->name }}</li></a>
@endforeach
<li style="margin-top:20px;">{{ $cities->links() }}</li>