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
        max-width: 400px;
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
                    <button class="close" data-dismiss="modal" type="button" onclick="closeModal()"><i class="fas fa-times"></i></button>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <div class="location-prompt">
                            <p>Please choose your preferred location to see the properties in your own city.</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center flex-wrap mb-4">
                           <div class="search-wrapper flex-grow-1 position-relative">
                                <i class="fas fa-search search-icon"></i> <!-- Search icon -->
                                <input 
                                    type="text" 
                                    class="form-control rounded-pill px-4 py-2 border" 
                                    id="search-city" 
                                    onkeyup="fetch_data()" 
                                    autocomplete="off"
                                    style="box-shadow:none; outline:none;"
                                >
                                <div class="animated-placeholder">
                                    <span id="placeholder-text">Search Lucknow</span>
                                </div>
                            </div>
                            <div class="h-line"></div>
                            <span class="or-text me-3">OR</span>
                            <div class="h-line"></div>
                             <button type="button" class="btn btn-success rounded-pill px-4 py-2 me-3 detect-btn">Detect my location</button>
                            
                        </div>
                        <center class="modal_loading mt-2">
                            <img src="{{ asset('images/loading.gif')}}" alt="Loading.." class="modal_loading" style="width:40px; display:none;" />
                        </center>
                    </div>
                </div>
                <input type="hidden" name="running_state" id="running_state" value="">
                <div class="max-cities-scroll">
                    <div class="row" id="states-section">
                        <div class="col-sm-12 mt-3">
                            <h4 class="title-city">States</h4><br>
                            @foreach($states as $state)
                                <span class="state-data badge" id="state_id{{ $state->id }}" state-id="{{ $state->id }}" onclick="fetch_data(1, '{{ $state->id }}', '{{ $state->name }}')" style="cursor:pointer;padding:10px 20px; margin-bottom:7px;">{{ $state->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mt-3">
                            <div id="breadcrumb" class="breadcrumb">
                                <button id="back-btn" onclick="backToStates()"><i class="fas fa-arrow-left"></i> Back</button>
                                <span id="state-name"></span> > City list
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="other-cities" id="other-cities"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!--<script type="text/javascript">-->
<!--    $(document).on('click', '.pagination a', function(event){-->
<!--        event.preventDefault(); -->
<!--        var page = $(this).attr('href').split('page=')[1];-->
<!--        var state_id = $('#running_state').val();-->
<!--        fetch_data(page, state_id);-->
<!--    });-->

<!--    function fetch_data(page, state_id = null, state_name = null) {-->
<!--        state_id = state_id == null || state_id == '' ? $('#running_state').val() : state_id;-->
<!--        document.getElementById('running_state').value = state_id;-->
<!--        manageStateHover(state_id);-->
<!--        var search = $('#search-city').val();-->
<!--        page = page == null || typeof page === "undefined" ? 1 : page;-->

<!--        if (state_id && state_id !== '') {-->
<!--            $('#states-section').hide();-->
<!--            $('#breadcrumb').show();-->
<!--            $('#other-cities').show();-->
<!--            if (state_name) {-->
<!--                $('#state-name').text(state_name);-->
<!--            }-->
<!--        } else {-->
<!--            $('#states-section').show();-->
<!--            $('#breadcrumb').hide();-->
<!--            $('#other-cities').hide();-->
<!--        }-->

<!--        $.ajax({-->
<!--            url: "{{ url('/') }}/home/get/all/cities/ancher/?page=" + page + "&state_id=" + state_id + "&search=" + search,-->
<!--            beforeSend: function() {-->
<!--                $(".modal_loading").css('display', 'block');-->
<!--                $('#other-cities').css({ opacity: 0, transform: 'translateX(100%)' });-->
<!--            },-->
<!--            success: function(data) {-->
<!--                $('#other-cities').html(data).css({ opacity: 1, transform: 'translateX(0)' });-->
<!--            },-->
<!--            error: function(response) {-->
<!--                $(".modal_loading").css('display', 'none');-->
<!--                swal('', response, 'error');-->
<!--            },-->
<!--            complete: function() {-->
<!--                $(".modal_loading").css('display', 'none');-->
<!--            }-->
<!--        });-->
<!--    }-->

<!--    function manageStateHover(id_one) {-->
<!--        var lis = $('.state-data');-->
<!--        for (var i = 0; i < lis.length; i++) {-->
<!--            var id = lis[i].getAttribute('state-id');-->
<!--            if (id_one == id) -->
<!--                lis[i].style.backgroundColor = '#28a745';-->
<!--            else-->
<!--                lis[i].style.backgroundColor = '#6c757d';-->
<!--        }-->
<!--        return true;-->
<!--    }-->

<!--    function backToStates() {-->
<!--        $('#running_state').val('');-->
<!--        $('#states-section').show();-->
<!--        $('#breadcrumb').hide();-->
<!--        $('#other-cities').hide();-->
        $('#other-cities').html(''); // Clear city list
<!--    }-->

    // Handle animated placeholder with prefix
<!--    const cities = ['Lucknow', 'Mumbai', 'Ahmedabad', 'Delhi', 'Bengaluru', 'Kolkata'];-->
<!--    let index = 0;-->
<!--    const placeholderText = document.getElementById('placeholder-text');-->
<!--    const searchInput = document.getElementById('search-city');-->
<!--    const animatedPlaceholder = searchInput.parentElement.querySelector('.animated-placeholder');-->

<!--    function cyclePlaceholder() {-->
<!--        placeholderText.style.opacity = 0;-->
<!--        placeholderText.style.transform = 'translateY(-20px)';-->
<!--        setTimeout(() => {-->
<!--            index = (index + 1) % cities.length;-->
            placeholderText.textContent = 'Search ' + cities[index]; // Add prefix
<!--            placeholderText.style.transition = 'none';-->
<!--            placeholderText.style.transform = 'translateY(20px)';-->
<!--            setTimeout(() => {-->
<!--                placeholderText.style.transition = 'opacity 0.5s ease, transform 0.5s ease';-->
<!--                placeholderText.style.opacity = 1;-->
<!--                placeholderText.style.transform = 'translateY(0)';-->
<!--            }, 10);-->
<!--        }, 500);-->
<!--    }-->

<!--    const intervalId = setInterval(cyclePlaceholder, 3000);-->

    // Hide placeholder on input or focus
<!--    animatedPlaceholder.addEventListener('click', () => searchInput.focus());-->
<!--    searchInput.addEventListener('input', () => {-->
<!--        animatedPlaceholder.style.display = searchInput.value ? 'none' : 'flex';-->
<!--    });-->
<!--    searchInput.addEventListener('focus', () => {-->
<!--        animatedPlaceholder.style.display = 'none';-->
<!--    });-->
<!--    searchInput.addEventListener('blur', () => {-->
<!--        animatedPlaceholder.style.display = searchInput.value ? 'none' : 'flex';-->
<!--    });-->
<!--    function closeModal() {-->
<!--        $('#location-list').modal('hide');-->
<!--    }-->
<!--</script>-->