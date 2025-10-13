    <div class="modal fade location-modal" id="location-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="cities-section">
                    <div class="modal-close">
                        <button class="close" data-dismiss="modal" type="button"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-xs-12">
                            <div class="input-group mb-3 search-box-city input-group-sm">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search prefix"></i></span>
                                </div>
                                <form autocomplete="off">
                                    <input type="text" class="form-control typeahead" id="search-city" onkeyup="fetch_data()" placeholder="Search Your City" autocomplete="off">
                                </form>
                                <center class="modal_loading">
                                    <img src="<?php echo e(asset('images/loading.gif')); ?>" alt="Loading.." class="modal_loading" />
                                </center>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="running_state" id="running_state" value="<?php echo e(Cache::get('state-id') ? Cache::get('state-id') : 38); ?>">
                    <div class="max-cities-scroll">
                        <div class="row">
                            <div class="col-sm-12 mt30">
                                <h4 class="title-city">States</h4><br>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="state-data badge <?php if(Cache::get('state-id') == $state->id): ?> badge-success <?php else: ?> badge-primary <?php endif; ?>" id="state_id<?php echo e($state->id); ?>" state-id="<?php echo e($state->id); ?>" onclick="fetch_data(1,'<?php echo e($state->id); ?>')" style="cursor:pointer;"><?php echo e($state->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt30">
                                <h4 class="title-city">All Cities</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="other-cities" id="other-cities">
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(url('/')); ?>/<?php echo e($city->name); ?>"><li class="filter-city"><?php echo e($city->name); ?></li></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li style="margin-top:20px;"><?php echo e($cities->links()); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            var state_id = $('#running_state').val();
            fetch_data(page, state_id);
        });

        function fetch_data(page, state_id = null)
        {
            var state_id = state_id == null || state_id == '' ? $('#running_state').val() : state_id;
            document.getElementById('running_state').value = state_id;
            manageStateHover(state_id);
            var search   = $('#search-city').val();
            page = page == null || typeof page === "undefined" ? 1 : page;
            $.ajax({
                url:"<?php echo e(url('/')); ?>/home/get/all/cities/ancher/?page="+page+"&state_id="+state_id+"&search="+search,
                beforeSend:function() {
                    $(".modal_loading").css('display', 'block');
                },
                success:function(data)
                {
                    $('#other-cities').html(data);
                },
                error: function(response) {
                    $(".modal_loading").css('display', 'none');
                    swal('', response, 'error');
                },
                complete: function() {
                    $(".modal_loading").css('display', 'none');
                }
            });
        }

        function manageStateHover(id_one) {
            var lis = $('.state-data');
            for (var i = 0; i < lis.length; i++) {
                var id = lis[i].getAttribute('state-id');
                if (id_one == id) 
                    lis[i].style.backgroundColor = '#28a745';
                else
                    lis[i].style.backgroundColor = '#007bff';
            }
            return true;
        }
    </script><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/layouts/front/cities-modal.blade.php ENDPATH**/ ?>