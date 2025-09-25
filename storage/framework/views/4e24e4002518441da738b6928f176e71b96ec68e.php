

<?php $__env->startSection('title'); ?>
Edit Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">User Profile</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">User Profile</li>
                        <li class="breadcrumb-item active">Update Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-main-body">
    <div class="container-fluid">
        <?php if(count($errors) > 0 ): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="p-0 m-0" style="list-style: none;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>* <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                             <form method="post" action="<?php echo e(url('master/update/user/profile')); ?>">
                              <?php echo csrf_field(); ?>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                  <label class="label-control">FirstName</label>
                                  <input type="text" class="text-control" placeholder="Enter Name" name="firstname" value="<?php echo e($user->firstname); ?>" required />
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">LastName</label>
                                  <input type="text" class="text-control" placeholder="Enter Name" name="lastname" value="<?php echo e($user->lastname); ?>" required />
                                </div>
                              </div>
                          
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">Email</label>
                                  <input type="text" class="text-control" placeholder="Enter Email" name="email" value="<?php echo e($user->email); ?>" required />
                                </div>

                                <div class="col-sm-6">
                                  <label class="label-control">Mobile No.</label>
                                  <input type="text" class="text-control" placeholder="Enter Mobile No." name="mobile_number" value="<?php echo e($user->mobile_number); ?>" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">State</label>
                                  <select class="text-control" id="state_id" name="state_id" required onchange="loadCities(this.value, 'populate_cities');">
                                      <?php if(count($states) < 1): ?>
                                        <option value="">No records found</option>
                                      <?php else: ?>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($v->id); ?>" <?php echo e($v->id == $user->state_id ? "selected" : ''); ?>><?php echo e($v->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endif; ?>
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">City</label>
                                  <select class="text-control" id="populate_cities" name="city_id" required>
                                    <option value="">Select City</option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($user->city_id == $city->id): ?>
                                        <option value="<?php echo e($city->id); ?>" selected=""><?php echo e($city->name); ?></option>
                                      <?php else: ?>
                                        <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                      <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </div>
                              </div>
                          
                              <div class="form-group row">
                                <div class="col-sm-6">
                                  <label class="label-control">Address</label>
                                  <input type="text" class="text-control" placeholder="Enter Address" name="address" value="<?php echo e($user->address); ?>" required />
                                </div>
                                <div class="col-sm-6">
                                  <label class="label-control">Gender</label>
                                  <select class="text-control" name="gender" required>
                                  <?php if($user->gender == 'Male'): ?>
                                    <option value="Male" selected="">Male</option>
                                    <option value="Female">Female</option>
                                  <?php elseif($user->gender == 'Female'): ?>
                                    <option value="Male">Male</option>
                                    <option value="Female" selected="">Female</option>
                                  <?php else: ?>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  <?php endif; ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-action row">
                                <div class="col-sm-12 text-center">
                                  <button class="btn btn-primary btn-add" type="submit">Update</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card"> 
                    <div class="card-body">
                        <div class="card-block">
                            <div class="form-body">														
                                <form method="post" action="<?php echo e(url('master/update/user/password')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <h4 class="form-section-h">Update User Password</h4>
                                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">New Password <span class="required">*</span></label>
                                            <input type="password" name="password" class="text-control" placeholder="Enter New Password" required />
                                            <span>Leave Blank if you don't want to change.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="label-control">Re-enter Password <span class="required">*</span></label>
                                            <input type="password" name="new_password" class="text-control" placeholder="Re-enter Password" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn-w100 btn btn-dark">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
$(function() {
    $("#edit_profile_form").validate();
    $("#edit_security_form").validate();
});

$(function(){
  loadCities($("#state_id").val(), 'populate_cities', function(){
    $("#populate_cities").val("<?php echo e($user->city_id); ?>");
  });
});

function loadCities(state_id, element_id, callback = null) {
    // if(empty(state_id)) return true;

    var route = "<?php echo e(config('app.api_url')); ?>/cities_states/"+state_id;

    $.ajax({
        url: route,
        method:"GET",
        beforeSend:function() {
            $(".loading").css('display','block');
            $(".btn-submit").attr('disabled', true);
        },
        success:function(response) {
            // var response = JSON.parse(response);
            if(response.responseCode === 200) {
                var cities = response.data.Cities;
                if(cities.length > 0) {
                    $(`#${element_id}`).empty();
                    $.each(cities, function(x,y) {
                        $(`#${element_id}`).append(
                            `<option value=${y.id}>${y.name}</option>`
                        );
                    });
                } else {
                        $(`#${element_id}`).append(
                            `<option value=''>No records found</option>`
                        );
                }
                if(callback){
                  callback();
                }
            }
        },
        error:function() {
            toastr.error('An error occured')
        },
        complete:function() {
            $(".loading").css('display','none');
            $(".btn-submit").attr('disabled', false);
        }
    });

}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/update_user_profile.blade.php ENDPATH**/ ?>