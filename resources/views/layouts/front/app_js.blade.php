<script src="{{ asset('js/library/jquery-v3/jquery.js')}}"></script>
<script src="{{ asset('js/library/jquery-v3/poppers.js')}}"></script>
<script src="{{ asset('js/library/bootstrap-v4/bootstrap.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/js/bootstrap-select.js"></script>
<script src="{{ asset('js/library/owl-carousel-v2.3/owl.carousel.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<script src="{{ asset('js/custom.js')}}"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

<script src="{{  asset('js/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

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

@auth
<script type="text/javascript">
 function previewImage(input) {
    var avatar = new FormData(document.getElementById('avatar-form'));
    avatar.append('_token', $("input[name=_token").val());
    avatar.append('user_id', "{{Auth::user()->id}}");
        $.ajax({
            url:"{{url('user/upload_avatar')}}",
            method:"post",
            data:avatar,
                        datatype:'json',
                        cache: false,
                        contentType: false,
                        processData: false,
            beforeSend:function(){
                $(".p-image").hide();
                $("#change_avatar").addClass('hw30 br0').attr('src', "{{url('/').'/images/loading.gif'}}");
            },
            success:function(response){
                if(response.status === 200) {
                    toastr.success('Profile pic uploaded successfully');
                    $("#change_avatar").attr('src', "{{url('/').'/'}}"+response.avatar_file).removeClass('hw30 br0');
                } else {
                    toastr.error('An error occured');
                    $("#change_avatar").attr('src', "{{url('/').'/'.Auth::user()->avatar}}").removeClass('hw30 br0');
                }
            },
            error:function(response){
                toastr.error('An error occured');
                $("#change_avatar").attr('src', "{{url('/').'/'.Auth::user()->avatar}}").removeClass('hw30 br0');
            },
            complete:function(){
                $(".p-image").show();
            }
        });

  }
</script>
@endauth


<script type="text/javascript">
    var path = "{{url('home/autocomplete-search')}}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            $(".modal_loading").css('display', 'block');
            return $.get(path, { query: query }, function (data) {
                $(".modal_loading").css('display', 'none');
                return process(data);
            });
        },
        updater: function(item) {
            window.location = '{{ url('/') }}/'+item.name;
        }
    });

function claim(id) {
    document.getElementById('p_id').value = id;
    $('#claim-listing').modal('show');
}

function claimListing(){
    var data = {};
    var id   = $("#p_id").val(); 
    if($("#verify_by_email").val() !== '') {
        var v = $("#verify_by_email").val();
    } else {
        var v = $("#verify_by_phone").val();
    }
    if(v == '') {
        toastr.error('Please Enter Email Or Mobile Number');
        return false;
    }
    data.key = v;
    data._token = $("input[name=_token]").val();
    $.ajax({
        url: "{{ url('property/claim') }}/"+id,
        method:'post',
        data: data,
        beforeSend:function(){
            $(".loading").css('display','block');
        },
        success:function(response){
            console.log(response);
            if(response.responseCode === 200) {
                $(".modal").modal('hide');
                $("#verifyemail").modal('show');
                toastr.success(response.message)
            }else {
                toastr.error(response.message);
            }
        }, 
        error:function(response) {
            var response = JSON.parse(response.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete:function(){
            $(".loading").css('display','none');
        }
    })
}

function resetField(key) {
    if(key == 'email') {
        document.getElementById('verify_by_phone').value = '';
    }else if(key == 'mobile'){
        document.getElementById('verify_by_email').value = '';
    }
}

function verifyOTPForClaim() {
    var data = {};
    var otp  = $("#verify_otp").val(); 
    if(otp == '') {
        toastr.error('Otp field must be required.');
        return false;
    }
    data.otp = otp;
    data._token = $("input[name=_token]").val();
    $.ajax({
        url: "{{ url('claim/verified') }}",
        method:'post',
        data: data,
        beforeSend:function(){
            $(".loading").css('display','block');
        },
        success:function(response){
            if(response.responseCode === 200) {
                $(".modal").modal('hide');
                toastr.success(response.message)
            } else {
                toastr.error(response.message);
            }
        }, 
        error:function(response) {
            var response = JSON.parse(response.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete:function(){
            $(".loading").css('display','none');
        }
    })
}

function resendOTP() {
    $.ajax({
        url: "{{ url('claim/resend/otp') }}",
        method:'get',
        beforeSend:function(){
            $(".loading").css('display','block');
        },
        success:function(response){
            if(response.responseCode === 200) {
                toastr.success(response.message)
            } else {
                toastr.error(response.message);
            }
        }, 
        error:function(response) {
            var response = JSON.parse(response.responseText);
            response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
        },
        complete:function(){
            $(".loading").css('display','none');
        }
    })
}

$("#contact_agent_form_modal").validate({
    rules:{
        mobile_number:{
            number:true,
            minlength:10,
            maxlength:10,
        }
    },
    submitHandler:function() {
        var formData = $("#contact_agent_form_modal").serializeArray();
        formData.push({name: 'property_id', value:window.active_listing_id});
        $.ajax({
            url: "{{config('app.api_url').'/property/agent_enquiry'}}",
            method:'post',
            data: formData,
            beforeSend:function(){
                $(".loading").css('display','block');
            },
            success:function(response){
                if(response.responseCode === 200) {
                    toastr.success('Enquiry sent successfully')
                    $("#contact_agent_form_modal").trigger('reset');
                } else {
                    toastr.error(response.message);
                }
            }, 
            error:function(response) {
                var response = JSON.parse(response.responseText);
                response.responseCode === 400 ? toastr.error(response.message) : toastr.error('An error occured');
            },
            complete:function(){
                $(".loading").css('display','none');
                location.reload();
            }
        })

    }
});


</script>