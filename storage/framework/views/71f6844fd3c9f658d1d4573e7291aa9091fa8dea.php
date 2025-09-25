
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo e(url('public/backend/css/bootstrap-4.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(url('public/backend/css/style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />    

    <title>Login</title>
    <style type="text/css">
        #loading img{
            height: 100px;
        }
    </style>
</head> 

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <img src="<?php echo e(url('public/images/admin-logo.png')); ?>" class="img-fluid">
                    </div>
                    <form method="post" action="<?php echo e(route('login')); ?>" name="login_form" id="login_form">
                        <div class="form-group">
                            <label for="exampleInputId">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required />
                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required />
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block mybtn btn-dark tx-tfm">Login</button>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="#forgot-pass" data-target="#forgot-pass" data-toggle="modal">Forgot Password ?</a>
                        </div>
                        
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="forgot-pass" tabindex="-1" role="dialog" aria-labelledby="forgot-pass" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgot-pass">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                
                </div>
                <div class="modal-body">

                    <div id="loading"></div>

                    <form id="forgot_password_form" name="forgot_password_form">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="label-control">Email Address</label>
                                <input type="text" id="email" name="email" class="text-control" placeholder="Enter Registered Email Address" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">

                                <button type="submit" class="btn btn-dark reset_now">Reset Now</button>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="<?php echo e(url('/public/backend/js/jquery.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/public/backend/js/poppers.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/backend/js/bootstrap-4.js')); ?>" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>

<script src="<?php echo e(URL('public/backend/js/toastr.min.js')); ?>"></script>

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
<?php $__currentLoopData = ['error','warning','success','info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(Session::has('alert-'.$key)): ?>
        <script>
            $(document).ready(function() {
                toastr.<?php echo e($key); ?>('<?php echo e(Session::get('alert-'.$key)); ?>');
            })
        </script>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<script type="text/javascript">
$("#login_form").validate();

$("#forgot_password_form").validate({
    submitHandler:function() {
        $.ajax({
            url: "<?php echo e(route('forgot_password')); ?>",
            method: 'POST',
            data: $("#forgot_password_form").serialize(),
            beforeSend: function() {
                $("#loading").html("<center> <img src='<?php echo e(URL::asset('images/loading.gif')); ?>' alt='loading..' /> </center> ")                
            },
            success: function(response) {
                if(response.status === 200) {
                    toastr.success(response.message);
                } else if(response.status === 400) {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error('An error occured');
            },
            complete: function() {
                $("#loading").empty();            
                $("#forgot-pass").modal('hide');
                $("#forgot_password_form").trigger('reset');
            }
        })
    }
});
</script>
<?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/auth/login.blade.php ENDPATH**/ ?>