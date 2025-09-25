<?php $__env->startSection('title'); ?>
Manage Enquiries
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="<?php echo e(url('/public/images/loading.gif')); ?>" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Enquiries</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Enquiries</a></li>
            <li class="breadcrumb-item active">All Enquiries</li>
          </ol>
<!--       <button type="button" class="btn btn-primary btn-save mr-3" data-toggle="collapse" data-target="#showFilter" aria-expanded="false" aria-controls="showFilter"><i class="fas fa-sort-amount-down-alt"></i> Show Filters</button>
 -->        </div>
      </div>
    </div>
  </div>
</section>
<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 collapse" id="showFilter">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="form-group row">
                <div class="col-sm-3">
                  <label class="label label-control">Category</label>
                  <select class="text-control">
                    <option>Select Category</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label class="label label-control">Sub Category</label>
                  <select class="text-control">
                    <option>Select Sub Cat</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label class="label label-control">Sub Sub Category</label>
                  <select class="text-control">
                    <option>Select Sub Sub Cat</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label class="label label-control">Package</label>
                  <select class="text-control">
                    <option>Select Package</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-3">
                  <label class="label label-control">Location</label>
                  <select class="text-control">
                    <option>Select Location</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <label class="label label-control">Sub Location</label>
                  <select class="text-control">
                    <option>Select Sub Location</option>
                  </select>
                </div>

                <div class="col-sm-4">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <label class="label label-control">From Date</label>
                      <input type="date" class="text-control">
                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <label class="label label-control">To Date</label>
                      <input type="date" class="text-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 align-self-end">
                  <button class="btn btn-filternow" type="submit"><i class="fas fa-filter"></i> Filter Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-bordered table-fitems" id="enquiries">
                  <thead>
                    <tr>
                      <th>Property ID</th>
                      <th>Name</th>
                      <th>Mobile No.</th>
                      <th>Email</th>
                      <th>Interested In</th>
                      <th>Verified</th>
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
          <img src="https://images.livemint.com/rf/Image-621x414/LiveMint/Period1/2013/08/13/Photos/house--621x414.jpg" class="img-fluid listing_thumbnail">
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
              <h3 class="content-head property_id">374923843</h3>
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

$(function() {

  $("#enquiries").DataTable({
    "processing": true,
    "serverSide": true,
    "destroy":true,
    "sAjaxSource": "<?php echo e(route('admin.manage-enquiries.index')); ?>",
    "columns": [
        { "data": "listing_id"},
        { "data": "name" },
        { "data": "mobile_number" },
        { "data": "email" },
        { "data": "interested_in" },
        { "data": "verified" }
    ]
  });

  $.ajax({
    url: "<?php echo e(config('app.api_url')); ?>"+'/category_tree',
    method:"get",
    beforeSend:function() {
      $(".loading").css('display', 'block');
    },
    success:function(response) {
      if(response.responseCode === 200) {
        var response = response.data.Categories;
        console.log(response)
        // $(".populate_categories, .populate_sub_categories, .populate_sub_sub_categories").empty()
        $.each(response, function(x,y) {
          if(response.length<1) return true;
          $(".populate_categories").append(
            `
              <option value=${y.id}> ${y.category_name} </option>
            `
          );
          if(y.subcategory.length<1) return true;
          $.each(y.subcategory, function(a,b) {
            $(".populate_sub_categories").append(
              `
                <option value=${b.id}> ${b.sub_category_name} </option>
              `
            );
            if(b.subsubcategory.length<1) return true;
            $.each(b.subsubcategory, function(c,d) {
              $(".populate_sub_sub_categories").append(
                `
                  <option value=${d.id}> ${d.sub_sub_category_name} </option>
                `
              );
            })

          })

        });

      } else {
        toastr.error('An error occured while fetching categories');
      }
      $(".loading").css('display', 'none');
    },
    error:function(response) {
      toastr.error('An error occured');
    }
  })
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
              console.log(response.data.Property);
              $(".listing_thumbnail").attr('src', "<?php echo e(config('app.url')); ?>/public/"+response.data.Property.property_gallery[0].image_path);
              $(".title").text(response.data.Property.title);
              $(".category").text(response.data.Property.category.category_name);
              $(".subcategory").text(response.data.Property.sub_category.sub_category_name)
              // $(".subsubcategory").val(response.data.Property.category_meta_title)
              $(".location").text(response.data.Property.location.location)
              $(".property_id").text(response.data.Property.listing_id)
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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/admin/enquiries/index.blade.php ENDPATH**/ ?>