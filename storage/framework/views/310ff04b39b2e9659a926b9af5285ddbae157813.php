
<?php $__env->startSection('title'); ?>
  Manage Agents
<?php $__env->stopSection(); ?>
<style type="text/css">
  .logged-in {
    color: green;
    font-size: 20px;
  }

  .logged-out {
    color: red;
    font-size: 20px;
  }
</style>
<?php $__env->startSection('content'); ?>

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Agents</h3>
            <button class="btn btn-primary btn-save" data-target="#create_dealer_modal" data-toggle="modal"><i
                class="fa fa-plus" aria-hidden="true"></i> Add Agents</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Agents</li>
              <li class="breadcrumb-item active">Manage Agents</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content-main-body">
    <div class="container-fluid">
      <?php if(count($errors) > 0): ?>
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
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems" id="for_all">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Total Properties</th>
                        <th>Premium Listing</th>
                        <th>Free Listing</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($agenst) && count($agenst) > 0): ?>
                        <?php $__currentLoopData = $agenst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($k + 1); ?></td>
                            <td>
                              <?php
                                $dt = new DateTime($v->created_at);
                                $tz = new DateTimeZone('Asia/Kolkata');
                                $dt->setTimezone($tz);
                                $dateTime = $dt->format('d.m.Y h:i A');
                              ?>
                              <?php echo e($dateTime); ?>

                            </td>
                            <td><?php echo e($v->firstname); ?> <?php echo e($v->lastname); ?></td>
                            <td><?php echo e($v->email); ?></td>
                            <td><?php echo e($v->mobile_number); ?></td>
                            <td><?php echo e($v->getProperties ? count($v->getProperties) : 0); ?></td>
                            <td><?php echo e(count($v->getPremiumProperties($v->id))); ?></td>
                            <td><?php echo e(count($v->getFreeProperties($v->id))); ?></td>
                            <td><?php echo e($v->getState ? $v->getState->name : ''); ?></td>
                            <td><?php echo e($v->getCity ? $v->getCity->name : ''); ?></td>
                            <td>
                              <?php if($v->status == "No"): ?>
                                <span class="badge badge-danger">In-Active</span>
                              <?php else: ?>
                                <span class="badge badge-success">Active</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <ul class="action">
                                <?php if($v->status == "No"): ?>
                                  <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($v->id); ?>')"
                                      title="Activate User Account"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                  </li>
                                <?php else: ?>
                                  <li><a style="cursor: pointer;" onclick="changeStatus('<?php echo e($v->id); ?>')"
                                      title="Block User Account"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(url('user/profile')); ?>/<?php echo e($v->id); ?>" title="View User Profile"><i
                                      class="fa fa-eye" aria-hidden="true"></i></a></li>
                                <li>
                                  <a href="<?php echo e(route('agent.edit', $v->id)); ?>" title="Edit Public Profile">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                  </a>
                                </li>

                                <?php if($v->is_verified == 1): ?>
                                  <li><a style="cursor: pointer;" title="Verify Email" onclick="verifyEmail('<?php echo e($v->id); ?>')"><i
                                        class="fa fa-envelope" aria-hidden="true"></i></a><span style="cursor: pointer;"
                                      title="Verified" class="logged-in">●</span></li>
                                <?php else: ?>
                                  <li><a style="cursor: pointer;" title="Verify Email" onclick="verifyEmail('<?php echo e($v->id); ?>')"><i
                                        class="fa fa-envelope" aria-hidden="true"></i></a><span style="cursor: pointer;"
                                      title="Not Verified" class="logged-out">●</span></li>
                                <?php endif; ?>
                                <?php if($v->mobile_verified == 1): ?>
                                  <li><a style="cursor: pointer;" title="Verify Mobile Number"
                                      onclick="verifyMobileNumber('<?php echo e($v->id); ?>')"><i class="fa fa-phone"
                                        aria-hidden="true"></i></a><span style="cursor: pointer;" title="Verified"
                                      class="logged-in">●</span></li>
                                <?php else: ?>
                                  <li><a style="cursor: pointer;" title="Verify Mobile Number"
                                      onclick="verifyMobileNumber('<?php echo e($v->id); ?>')"><i class="fa fa-phone"
                                        aria-hidden="true"></i></a><span style="cursor: pointer;" title="Not Verified"
                                      class="logged-out">●</span></li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(url('master/update/owner/')); ?>/<?php echo e($v->id); ?>" title="Update User Profile"><i
                                      class="fas fa-pencil-alt"></i></a></li>
                                <li><a style="cursor: pointer;" onclick="deleteUser('<?php echo e($v->id); ?>');" title="Delete User"><i
                                      class="fa fa-trash" aria-hidden="true"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="9"> No records found </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" id="create_dealer_modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Agents</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="<?php echo e(url('master/create/agent')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">FirstName</label>
                <input type="text" class="text-control" placeholder="Enter Name" name="firstname"
                  value="<?php echo e(old('firstname')); ?>" required />
              </div>
              <div class="col-sm-6">
                <label class="label-control">LastName</label>
                <input type="text" class="text-control" placeholder="Enter Name" name="lastname"
                  value="<?php echo e(old('lastname')); ?>" required />
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label class="label-control">Email</label>
                <input type="text" class="text-control" placeholder="Enter Email" name="email" value="<?php echo e(old('email')); ?>"
                  required />
                <?php if($errors->has('email')): ?>
                  <span class="error" style="color: red;">
                    <strong>* <?php echo e($errors->first('email')); ?></strong>
                  </span>
                <?php endif; ?>
              </div>

              <div class="col-sm-6">
                <label class="label-control">Mobile No.</label>
                <input type="text" class="text-control" placeholder="Enter Mobile No." name="mobile_number"
                  value="<?php echo e(old('mobile_number')); ?>" required />
                <?php if($errors->has('mobile_number')): ?>
                  <span class="error" style="color: red;">
                    <strong>* <?php echo e($errors->first('mobile_number')); ?></strong>
                  </span>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Gender</label>
                <select class="text-control" name="gender" required>
                  <?php if(old('gender') == 0): ?>
                    <option value="0" selected="">Male</option>
                    <option value="1">Female</option>
                  <?php elseif(old('gender') == 1): ?>
                    <option value="0">Male</option>
                    <option value="1" selected="">Female</option>
                  <?php else: ?>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>


            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Password</label>
                <input type="password" class="text-control" placeholder="Enter Password" name="password" required />
              </div>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Add Agent</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
  <?php if($errors->has('email')): ?>
    <script type="text/javascript">
      $('#create_dealer_modal').modal('show');
    </script>
  <?php endif; ?>
  <?php if($errors->has('mobile_number')): ?>
    <script type="text/javascript">
      $('#create_dealer_modal').modal('show');
    </script>
  <?php endif; ?>
  <script type="text/javascript">

    function changeStatus(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Change status of this user",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            document.getElementById('new_loader').style.display = 'block';
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '<?php echo e(url('master/user/change-status')); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'id': id
              },
              success: function (response) {
                var response = JSON.parse(response);
                if (response.status === 200) {
                  toastr.success(response.message)
                  $("#delete-owners").modal('hide');
                  reloadPage();
                } else if (response.status === 500) {
                  toastr.error(response.message)
                }
                document.getElementById('new_loader').style.display = 'none';
              },
              error: function (response) {
                toastr.error('An error occured.');
                document.getElementById('new_loader').style.display = 'none';
              },
              complete: function () {
                document.getElementById('new_loader').style.display = 'none';
                $(".btn-delete").attr('disabled', false);
              }
            })
          }
        });

    }

    function deleteUser(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Delete This User.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $(".loading_2").css('display', 'block');
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '<?php echo e(url('master/user/delete')); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'id': id
              },
              success: function (response) {
                var response = JSON.parse(response);
                if (response.status === 200) {
                  toastr.success(response.message)
                  reloadPage();
                } else if (response.status === 500) {
                  toastr.error(response.message)
                }
              },
              error: function (response) {
                toastr.error('An error occured.')
              },
              complete: function () {
                $(".loading_2").css('display', 'none');
                $(".btn-delete").attr('disabled', false);
              }
            })
          }
        });

    }

    function verifyEmail(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Verify This Email.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $(".loading_2").css('display', 'block');
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '<?php echo e(url('verify/email/and/mobile')); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'id': id,
                'type': "email"
              },
              success: function (response) {
                toastr.success(response)
                reloadPage();
              },
              error: function (response) {
                toastr.error('An error occured.')
              },
              complete: function () {
                $(".loading_2").css('display', 'none');
                $(".btn-delete").attr('disabled', false);
              }
            })
          }
        });

    }

    function verifyMobileNumber(id) {
      swal.fire({
        title: "Are you sure?",
        text: "Verify This Mobile Number.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $(".loading_2").css('display', 'block');
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '<?php echo e(url('verify/email/and/mobile')); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'id': id,
                'type': 'mobile'
              },
              success: function (response) {
                toastr.success(response)
                reloadPage();
              },
              error: function (response) {
                toastr.error('An error occured.')
              },
              complete: function () {
                $(".loading_2").css('display', 'none');
                $(".btn-delete").attr('disabled', false);
              }
            })
          }
        });

    }
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/agent/index.blade.php ENDPATH**/ ?>