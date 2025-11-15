<?php $__env->startSection('title'); ?>
  Manage Complaints
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
            <h3 class="content-header-title">Property</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.properties.index')); ?>">Manage Property</a></li>
              <li class="breadcrumb-item active">View Property Feedback</li>
            </ol>
            <!--       <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter" aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
         -->
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
                  <table class="table table-bordered table-fitems" id="feedback">
                    <thead>
                      <tr>
                        <th>Property Title</th>
                        <th>User Details</th>
                        <th>What's Wrong</th>
                        <th>Feedback</th>
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
  </section>

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
                <img
                  src="https://images.livemint.com/rf/Image-621x414/LiveMint/Period1/2013/08/13/Photos/house--621x414.jpg"
                  class="img-fluid listing_thumbnail">
              </div>
            </div>
            <div class="col-sm-8 align-self-center">
              <div class="dealer-content">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="content-label">Title</label>
                    <h3 class="content-head title">2BHK in Hazratganj</h3>
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
                    <label class="content-label">Sub Sub Cat</label>
                    <h3 class="content-head subsubcategory">Flat</h3>
                  </div>

                  <div class="col-sm-6">
                    <label class="content-label">Package</label>
                    <h3 class="content-head">Basic</h3>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label class="content-label">Location</label>
                    <h3 class="content-head location">Mumbai, MH</h3>
                  </div>

                  <div class="col-sm-6">
                    <label class="content-label">Property ID</label>
                    <h3 class="content-head listing_id">374923843</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

  <script type="text/javascript">

    $(function () {

      $("#feedback").DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "sAjaxSource": "<?php echo e(route('admin.manage-complaints.index')); ?>",
        "columns": [
          { "data": "property_title" },
          { "data": 'user_details' },
          { "data": "complaint" },
          { "data": "feedback" },
          { "data": "action" }

        ]
      });

    });


    function fetchPropertyDetails(id) {
      var route = "<?php echo e(route('admin.properties.show', ':id')); ?>";
      route = route.replace(":id", id);

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function () {
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          try {
            response = JSON.parse(response);

            if (response.status === 200 && response.data && response.data.Property) {
              const property = response.data.Property;

              // Thumbnail
              if (property.property_gallery && property.property_gallery.length > 0 && property.property_gallery[0].image_path) {
                $(".listing_thumbnail").attr('src', "<?php echo e(config('app.url')); ?>/public/" + property.property_gallery[0].image_path);
              } else {
                $(".listing_thumbnail").attr('src', "https://via.placeholder.com/150"); // fallback image
              }

              // Basic property details
              $(".title").text(property.title ?? 'N/A');
              $(".category").text(property.category?.category_name ?? 'N/A');
              $(".subcategory").text(property.sub_category?.sub_category_name ?? 'N/A');
              $(".subsubcategory").text(property.sub_sub_category?.sub_category_name ?? 'N/A');
              $(".location").text(property.location?.location ?? 'N/A');
              $(".property_id").text(property.listing_id ?? 'N/A');

              $("#property_info").modal('show');
            } else {
              toastr.error(response.message || 'Property data not found.');
            }
          } catch (e) {
            console.error(e);
            toastr.error('Error parsing server response.');
          }
          $(".loading").css('display', 'none');
        },
        error: function () {
          toastr.error('An error occurred.');
          $(".loading").css('display', 'none');
        }
      });
    }

    function changeStatus(id) {
      swal({
        title: "Are you sure?",
        text: "Chnage Status Of This Feedback.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $(".loading_2").css('display', 'block');
            $(".btn-delete").attr('disabled', true);
            $.ajax({
              url: '<?php echo e(url('master/change-status/feedback')); ?>',
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


  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/feedback/index.blade.php ENDPATH**/ ?>