

<?php $__env->startSection('title'); ?>
<title>My Properties</title>
<?php $__env->stopSection(); ?>

<style>
.single-listing.card {
  border-radius: 10px;
  transition: transform 0.2s;
}
.single-listing.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.card-img {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}
.card-body {
  padding: 1.25rem;
}
.property-title a {
  color: #007bff;
  text-decoration: none;
}
.property-title a:hover {
  color: #0056b3;
  text-decoration: underline;
}
.property-buttons .btn {
  margin-right: 5px;
}
.property-buttons .btn:last-child {
  margin-right: 0;
}
.alert-info {
  background-color: #e9f1ff;
  border-color: #cce5ff;
}
.card-text{
    margin:0px;
    font-weight:400;
    font-size:14px;
}
</style>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>My Properties</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">My Properties</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<section class="owner-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php echo $__env->make('front.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="col-sm-9">
        <div class="main-area-dash">
          <h3 class="head-tit">Properties</h3>
          <section class="dashboard-area account-my-properties">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="prop-pending-tab" data-toggle="pill" href="#prop-pending" role="tab" aria-controls="prop-pending" aria-selected="true">Pending</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="prop-approved-tab" data-toggle="pill" href="#prop-approved" role="tab" aria-controls="prop-approved" aria-selected="false">Approved</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="prop-rejected-tab" data-toggle="pill" href="#prop-rejected" role="tab" aria-controls="prop-rejected" aria-selected="false">Rejected</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="prop-pending" role="tabpanel" aria-labelledby="prop-pending-tab">
                <div class="row">
                  <div class="col-sm-12">
                    <?php if(count($properties) > 0): ?>
                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-listing card shadow-sm mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img class="card-img" src="<?php echo e(asset('')); ?><?php echo e($v->PropertyGallery[0]->image_path); ?>" alt="<?php echo e($v->title); ?>" style="object-fit: cover; height: 200px;">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title property-title"><a href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>"><?php echo e($v->title); ?></a></h5>
                            <p class="card-text"><strong>Price:</strong> <i class="fas fa-rupee-sign"></i> <?php echo e($v->price); ?></p>
                            <p class="card-text"><strong>Category:</strong> <a href="#"><?php echo e($v->category->category_name); ?></a></p>
                            <p class="card-text"><strong>Location:</strong> Mumbai, Andheri (Static Example)</p>
                            <p class="card-text"><strong>Subcategory:</strong> Residential (Static Example)</p>
                            <div class="property-buttons mt-2">
                              <ul class="list-inline">
                                <li class="list-inline-item"><a href="<?php echo e(url('update/property')); ?>/<?php echo e($v->id); ?>" title="Edit Property" class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i></a></li>
                                <li class="list-inline-item"><a href="<?php echo e(route('property_detail', ['title' => $v->slug])); ?>" title="View Property" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a></li>
                                <li class="list-inline-item"><a style="cursor: pointer;" title="Delete Property" onclick="deleteProperty('<?php echo e($v->id); ?>')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?> 
                    <div class="alert alert-info text-center">No records found</div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="prop-approved" role="tabpanel" aria-labelledby="prop-approved-tab"></div>
              <div class="tab-pane fade" id="prop-rejected" role="tabpanel" aria-labelledby="prop-rejected-tab"></div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  function deleteProperty(id) {
    swal({
      title: "Are you sure?",
      text: "Delete this Property",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          method:'post',
          url   : "<?php echo e(route('property.delete')); ?>",
          data  : {
            "_token": "<?php echo e(csrf_token()); ?>",
            'id'    : id
          },
          success: function(data){
            toastr.success(data);
            setTimeout( function () {
              location.reload();
            }, 2000);
          }
        });
      }
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/properties.blade.php ENDPATH**/ ?>