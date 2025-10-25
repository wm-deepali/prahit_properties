<style type="text/css">
    /* Custom CSS for Modal */
    .modal-content {
        border-radius: 15px;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .cities-section {
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .close {
        font-size: 24px;
        color: #666;
    }

    .title-city {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    /* States Buttons */
    .state-data {
            background-color: #f1f1f1 !important;
    color: #656464;
        /*border-radius: 20px;*/
        padding: 8px 16px;
        margin: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .state-data:hover {
        background-color: #5a6268 !important;
        color:#ffffff;
    }

    .badge-success {
        background-color: #28a745 !important; /* Green for selected */
    }

    /* Cities List */
    #other-cities {
        list-style: none;
        padding: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
        display: none; /* Initially hidden */
    }

    .filter-city {
        padding: 10px;
        color: #9b9ea1;
        text-decoration: none;
        border:1px solid #9b9ea1;
        white-space:nowrap;
        border-radius:3px;
      
    }

    .filter-city:hover {
        /*text-decoration: underline;*/
        border:1px solid blue;
        color:blue;
        
    }

    /* Breadcrumb */
    .breadcrumb {
        font-size: 16px;
        color: #333;
        font-weight: bold;
        display: flex;
        align-items: center;
        display: none; /* Initially hidden */
    }

    #back-btn {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        margin-right: 5px;
    }

    /* Max Scroll */
    .max-cities-scroll {
        max-height: 400px;
        overflow-y: auto;
    }

    /* Location Prompt */
    .location-prompt p {
        font-size: 16px;
        color: #666;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Detect Button and Search */
    .detect-btn {
        background-color: #28a745;
        border: none;
        color: #fff;
        font-weight: bold;
    }

    .or-text {
        font-size: 14px;
        color: #999;
    }

    /* Animated Placeholder and Search Icon */
    .search-wrapper {
        width: 100%;
        position: relative;
    }

    .search-wrapper input {
        height: 45px;
        font-size: 16px;
        padding-left: 40px !important; /* Increased padding to accommodate icon */
        background: #fff;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #999;
        pointer-events: none;
    }

    .animated-placeholder {
        position: absolute;
        top: 0;
        left: 40px; /* Adjusted to start after the icon */
        height: 100%;
        display: flex;
        align-items: center;
        pointer-events: none;
        color: #999;
        overflow: hidden;
        white-space: nowrap;
    }

    #placeholder-text {
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .h-line{
        width:50px;
        height:1px;
        background:#f9f9f9;
        margin:0px 10px;
        /*margin:auto;*/
    }
</style>

<div class="modal fade location-modal" id="location-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="cities-section">
                <div class="modal-close">
                    <button class="close" data-bs-dismiss="modal" type="button"><i class="fas fa-times"></i></button>
                </div>

                <!-- Search & Detect -->
                <!--<div class="row justify-content-center mt-3">-->
                <!--    <div class="col-sm-12">-->
                <!--        <div class="search-wrapper mb-3">-->
                <!--            <i class="fas fa-search search-icon"></i>-->
                <!--            <input type="text" class="form-control" id="search-city" onkeyup="fetch_data()" placeholder="Search Your City">-->
                <!--            <div class="animated-placeholder"><span id="placeholder-text">Search Lucknow</span></div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="row justify-content-center mt-5"> <div class="col-sm-12"> <div class="location-prompt"> <p>Please choose your preferred location to see the properties in your own city.</p> </div> 
                <div class="d-flex align-items-center justify-content-center flex-wrap mb-4 location-search">
                     <div class="search-wrapper flex-grow-1 position-relative"> <i class="fas fa-search search-icon"></i> <input type="text" class="form-control rounded-pill px-4 py-2 border" id="search-city" onkeyup="fetch_data()" autocomplete="off" style="box-shadow:none; outline:none;"> 
                     <div class="animated-placeholder"> <span id="placeholder-text">Search By State Or City</span> </div> </div> 
                     <!--<div class="h-line"></div>-->
                     <!--<span class="or-text me-3">OR</span> -->
                     <!--<div class="h-line"></div>-->
                     <!--<button type="button" class="btn btn-success rounded-pill px-4 py-2 me-3 detect-btn"> Detect my location </button> -->
                     </div> <center class="modal_loading mt-2"> <img src="{{ asset('images/loading.gif')}}" alt="Loading.." class="modal_loading" style="width:40px; display:none;" /> </center> </div> </div>

                <input type="hidden" name="running_state" id="running_state" value="">

                <!-- STATES -->
                <div class="max-cities-scroll">
                    <div class="row" id="states-section">
                        <div class="col-sm-12">
                            <h4 class="title-city">States</h4>
                            <br>
                            @foreach($states as $state)
                                <span class="state-data badge" id="state_id{{ $state->id }}" state-id="{{ $state->id }}" onclick="fetch_data(1,'{{ $state->id }}','{{ $state->name }}')" style="cursor:pointer;padding:10px 20px; margin-bottom:7px;">
                                    {{ $state->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- BREADCRUMB -->
                    <div class="row">
                        <div class="col-sm-12 mt-3">
                            <div id="breadcrumb" class="breadcrumb" style="display:none;">
                                <button id="back-btn" onclick="backToStates()"><i class="fas fa-arrow-left"></i> Back</button>
                                <span id="state-name"></span> > City list
                            </div>
                        </div>
                    </div>

                    <!-- CITY LIST -->
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="other-cities" id="other-cities" style="display:none;"></ul>
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <center class="modal_loading">
                    <img src="{{ asset('images/loading.gif')}}" alt="Loading.." class="modal_loading" style="display:none;width:40px;" />
                </center>
            </div>
        </div>
    </div>
</div>

<script>
function fetch_data(page, state_id = null, state_name = null) {
    state_id = state_id || $('#running_state').val();
    $('#running_state').val(state_id);
    manageStateHover(state_id);

    var search = $('#search-city').val();
    page = page || 1;

    if(state_id) {
        $('#states-section').hide();
        $('#breadcrumb').show();
        $('#other-cities').show();
        if(state_name) $('#state-name').text(state_name);
    } else {
        $('#states-section').show();
        $('#breadcrumb').hide();
        $('#other-cities').hide();
    }

    $.ajax({
        url: "{{ url('/') }}/home/get/all/cities/ancher/?page="+page+"&state_id="+state_id+"&search="+search,
        beforeSend:function() {
            $(".modal_loading").show();
            $('#other-cities').css({opacity:0, transform:'translateX(100%)'});
        },
        success:function(data) {
            let container = $('#other-cities');
            setTimeout(()=>{
                if(!data.trim()){
                    container.html('<div class="no-city-message">No city found</div>');
                } else {
                    container.html(data);
                }
                container.css({opacity:1, transform:'translateX(0)'});
            }, 300);
        },
        complete:function() { $(".modal_loading").hide(); }
    });
}

function manageStateHover(id) {
    $('.state-data').each(function(){
        $(this).css('background-color', $(this).attr('state-id')==id ? '#28a745':'#007bff');
    });
}

function backToStates() {
    $('#running_state').val('');
    $('#states-section').show();
    $('#breadcrumb').hide();
    $('#other-cities').hide().html('');
}

$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page, $('#running_state').val());
});
</script>
