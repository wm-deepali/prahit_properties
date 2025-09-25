<script src="{{ asset('') }}backend/js/jquery.js" type="text/javascript"></script>
<script src="{{ asset('') }}backend/js/poppers.js" type="text/javascript"></script>
<script src="{{ asset('') }}backend/js/bootstrap-4.js" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>


<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/additional-methods.min.js') }}"></script>

<script src="{{ asset('backend/js/custom.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
     toastr.options = {
        "closeButton": true,
        // "debug": false,
        // "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };  
    
    document.getElementById('new_loader').style.display = 'none';
</script>

<script type="text/javascript">
    function getMultipleCities(city_ids = []) {
        var states = $('#states').val();
        $("#render-cities").html('');
        var city_html
        $.ajax({
            url :"{{ route('state.getMultipleCities') }}",
            type: "POST",
            data: {
                '_token' :'{{ csrf_token() }}',
                'states' : states
            },
            success: function(result) {
                $.each(result, function(key,city){
                    city_html = `<div class="col-sm-2"><input type="checkbox" name="cities[]" value="${city.id}"> ${city.name}</div>`;
                    $('#render-cities').append(city_html);
                });
            },
            error: function(response) {
                alert(response);
            },
            complete: function() {
                
            }
        });
    }
</script>

<!-- toastr message -->
@foreach(['error','warning','success','info'] as $key)
    @if(Session::has('alert-'.$key))
        <script>
            $(document).ready(function() {
                toastr.{{$key}}('{{ Session::get('alert-'.$key) }}');
            })
        </script>
    @endif
@endforeach

