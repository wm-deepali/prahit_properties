

<?php $__env->startSection('title'); ?>
Manage Claims
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Claims</li>
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
              <div class="table-responsive">
                <table class="table table-bordered table-fitems" id="states">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Property Id</th>
                      <th>Claimed BY</th>
                      <th>Claim Verify</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal custom-white" id="property_info">
    <div class="modal-dialog">
      <div class="modal-content"> 
        
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Property Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group row">
        <div class="col-sm-4 align-self-center">
          <div class="dealer-prop">
            <img src="https://images.livemint.com/rf/Image-621x414/LiveMint/Period1/2013/08/13/Photos/house--621x414.jpg" class="img-fluid listing_thumbnail">
          </div>
        </div> 
        <div class="col-sm-8 align-self-center">
          <div class="dealer-content">
            <div class="row">
              <div class="col-sm-12">
                  <label class="content-label">Property Type</label>
                  <h3 class="content-head p-type"></h3>
              </div>
              <div class="col-sm-12">
                <label class="content-label">Title</label>
                <h3 class="content-head title"></h3>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <label class="content-label">Category</label>
                <h3 class="content-head category">Rent</h3>
              </div>
              
              <div class="col-sm-6">
                <label class="content-label">Sub Category</label>
                <h3 class="content-head subcategory">Commercial</h3>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <label class="content-label">Location</label>
                <h3 class="content-head location"></h3>
              </div>
              
              <div class="col-sm-6">
                <label class="content-label">Property ID</label>
                <h3 class="content-head property_id"></h3>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label class="content-label">Price</label>
                <h3 class="content-head price"></h3>
              </div>
              
              <div class="col-sm-6">
                <label class="content-label">Published Date</label>
                <h3 class="content-head published_date"></h3>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label class="content-label">Listing Type</label>
                <h3 class="content-head listing-type"></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal custom-white" id="dealer_info">
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Owner Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group row">
      <div class="col-sm-4 align-self-center">
        <div class="dealer-prop">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png" id="profile-image" class="img-fluid">
        </div>
      </div> 
      <div class="col-sm-8 align-self-center">
        <div class="dealer-content">
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Name</label>
              <h3 class="content-head" id="view-name"></h3>
            </div>
            
            <div class="col-sm-12">
              <label class="content-label">Email</label>
              <h3 class="content-head" id="view-email">im@gmail.com</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Mobile No.</label>
              <h3 class="content-head" id="view-mobile">9898989898</h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Property Posted</label>
              <h3 class="content-head" id="total-post-p">12</h3>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <label class="content-label">Email Verified</label>
              <h3 class="content-head" id="email-verify"></h3>
            </div>
            
            <div class="col-sm-6">
              <label class="content-label">Mobile Verified</label>
              <h3 class="content-head" id="mobile-verify"></h3>
            </div>
          </div>
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

//-------------------- Manage pending lead listing ----------------------//
  $(function () {
      var table = $('#states').DataTable({
          processing: true,
          serverSide: true,
          render: true,
          searching: true,
          ajax: "<?php echo e(route('admin.manageClaimsDatatable')); ?>",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'property_id', name: 'property_id'},
              {data: 'claim_by', name: 'claim_by'},
              {data: 'otp_verify', name: 'otp_verify'},
              {data: 'approval_status', name: 'approval_status'},
              {data: 'action', name: 'action'},
          ],
      });
  });

    function fetchPropertyDetails(id){
      var route = "<?php echo e(route('admin.properties.show', ':id')); ?>";
      var route = route.replace(":id", id);

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function(argument) {
          $(".loading").css('display', 'block');
        },
        success: function(response) {
          var response = JSON.parse(response);
          if(response.status === 200) {
            console.log(response.data);
            $(".listing_thumbnail").attr('src', "<?php echo e(config('app.url')); ?>/public/"+response.data.Property.property_gallery[0].image_path);
            var publish = response.data.Property.publish_date ? response.data.Property.publish_date : 'Not Defined';
            $(".title").text(response.data.Property.title);
            $(".category").text(response.data.Property.category.category_name);
            $(".subcategory").text(response.data.Property.sub_category.sub_category_name)
            $(".location").text(response.data.Property.location.location)
            $(".property_id").text(response.data.Property.listing_id)
            $(".p-type").text(response.data.Property.property_types.type)
            $(".price").text('₹'+response.data.Property.price)
            $(".listing-type").text('₹'+response.data.Property.listing_type)
            $(".published_date").text(publish)
            $("#property_info").modal('show');
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
          $(".loading").css('display', 'none');
        },
        error: function(response) {
          toastr.error('An error occured');
          $(".loading").css('display', 'none');
        }
      });
  }

  function showOwnerInfo(id) {
    var route = "<?php echo e(route('admin.getUserInfo', ':id')); ?>";
    var route = route.replace(":id", id);

    $.ajax({
      url: route,
      method: "GET",
      beforeSend: function(argument) {
        $(".loading").css('display', 'block');
      },
      success: function(response) {
        console.log(response);
        if(response.avatar) {
          $("#profile-image").attr('src', "<?php echo e(config('app.url')); ?>/public/"+response.avatar);
        }
        $("#view-name").text(response.firstname+' '+response.lastname);
        $("#view-email").text(response.email);
        $("#view-mobile").text(response.mobile_numebr);
        $("#total-post-p").text(response.get_properties.length);
        var email_status  = response.is_verified == 1 ? 'Verified' : 'Not Verified';
        var mobile_status = response.mobile_verified == 1 ? 'Verified' : 'Not Verified';
        $("#email-verify").text(email_status);
        $("#mobile-verify").text(mobile_status);
        $('#dealer_info').modal('show');
      },
      error: function(response) {
        toastr.error('An error occured');
        $(".loading").css('display', 'none');
      },
      complete: function() {
        $(".loading").css('display', 'none');
      }
    });
  }

  function assignClaim(id) {
    swal({
        title: "Are you sure?",
        text: "Assign Clain This User.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          $(".loading_2").css('display', 'block');
          $(".btn-delete").attr('disabled', true);
          $.ajax({
            url: '<?php echo e(url('master/assign/claim')); ?>',
            method: "POST",
            data: {
              "_token": "<?php echo e(csrf_token()); ?>",
              'id'    : id,
              'type'  : 'mobile'
            },
            success: function(response) {
              toastr.success(response)
              reloadPage();
            },
            error: function(response) {
              toastr.error('An error occured.')
            },
            complete: function() {
              $(".loading_2").css('display', 'none');
              $(".btn-delete").attr('disabled', false);
            }
          })
      }
    });
    
  }

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-new/resources/views/admin/manage_claim.blade.php ENDPATH**/ ?>