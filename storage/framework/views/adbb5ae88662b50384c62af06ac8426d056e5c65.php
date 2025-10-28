

<?php $__env->startSection('title'); ?>
<title>My Wishlist</title>
<?php $__env->stopSection(); ?>

<style>
.wishlist-card {
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  border: none;
  background: #f9fbff;
}
.wishlist-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
}
.wishlist-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}
.wishlist-info {
  padding: 1rem 1.25rem;
}
.wishlist-info h5 {
  font-size: 1.1rem;
  margin-bottom: 8px;
  font-weight: 600;
}
.wishlist-info h5 a {
  text-decoration: none;
  color: #007bff;
}
.wishlist-info h5 a:hover {
  color: #0056b3;
  text-decoration: underline;
}
.wishlist-info p {
  margin: 0 0 5px;
  font-size: 14px;
  color: #333;
}
.property-actions {
  margin-top: 10px;
}
.property-actions .btn {
  margin-right: 8px;
  border-radius: 6px;
}
.property-actions .btn:last-child {
  margin-right: 0;
}
</style>

<?php $__env->startSection('content'); ?>

<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>My Wishlist</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
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
          <h3 class="head-tit mb-4">Saved Properties</h3>

          <div class="row g-3">
            <!-- 🏡 Card 1 -->
            <div class="col-md-4 mb-4">
              <div class="card wishlist-card">
                <img src="https://bhawanbhoomi.com/uploads/properties/gallery_images/99115_03FFDC5E-937D-4A9A-9553-423C4482941B.png" alt="Luxury Apartment">
                <div class="wishlist-info">
                  <h5><a href="#">Luxury Apartment in Andheri</a></h5>
                  <p><strong>Price:</strong> ₹1.2 Cr</p>
                  <p><strong>Location:</strong> Mumbai, Andheri West</p>
                  <p><strong>Category:</strong> Residential</p>
                  <div class="property-actions">
                    <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> View</a>
                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- 🏡 Card 2 -->
            <div class="col-md-4 mb-4">
              <div class="card wishlist-card">
                <img src="https://bhawanbhoomi.com/uploads/properties/gallery_images/99115_03FFDC5E-937D-4A9A-9553-423C4482941B.png" alt="Office Space">
                <div class="wishlist-info">
                  <h5><a href="#">Premium Office Space</a></h5>
                  <p><strong>Price:</strong> ₹85 Lakh</p>
                  <p><strong>Location:</strong> Pune, Hinjewadi</p>
                  <p><strong>Category:</strong> Commercial</p>
                  <div class="property-actions">
                    <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> View</a>
                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- 🏡 Card 3 -->
            <div class="col-md-4 mb-4">
              <div class="card wishlist-card">
                <img src="https://bhawanbhoomi.com/uploads/properties/gallery_images/99115_03FFDC5E-937D-4A9A-9553-423C4482941B.png" alt="Villa Property">
                <div class="wishlist-info">
                  <h5><a href="#">Elegant Villa with Garden</a></h5>
                  <p><strong>Price:</strong> ₹2.5 Cr</p>
                  <p><strong>Location:</strong> Bangalore, Whitefield</p>
                  <p><strong>Category:</strong> Residential</p>
                  <div class="property-actions">
                    <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> View</a>
                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- row end -->
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/user/my-wishlist.blade.php ENDPATH**/ ?>