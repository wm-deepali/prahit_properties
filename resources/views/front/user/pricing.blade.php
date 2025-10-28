@extends('layouts.front.app')

@section('title')
<title>Pricing</title>
@endsection

@section('content')

<style>
.pricing-section {
  text-align: center;
  padding: 60px 0;
  background: #fff;
  font-family: 'Poppins', sans-serif;
}
.pricing-section h2 {
  font-weight: 700;
  font-size: 32px;
  margin-bottom: 10px;
}
.pricing-table {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
  gap: 20px;
  max-width: 1200px;
  margin: auto;
}
.pricing-card {
  border: 1px solid #ddd;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  background: #fff;
}
.pricing-card .header {
  padding: 25px 15px;
  color: #fff;
}
.header.free { background: #f3fafd; color:#000; }
.header.basic { background: #fffce1; color:#000; }
.header.standard { background: #fff3ec; color:#000; }
.header.premium { background: #f5ecff; color:#000; }

.pricing-card h3 {
  font-weight: 700;
  font-size: 22px;
  margin-bottom: 8px;
}
.pricing-card .price {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 15px;
}
.pricing-card table {
  width: 100%;
  text-align: left;
  font-size: 14px;
}
.pricing-card table td {
  padding: 8px 15px;
  border-bottom: 1px solid #eee;
}
.pricing-card table td:last-child {
  text-align: center;
  font-weight: 500;
}
.pricing-card table td i {
  color: green;
}
.pricing-footer {
  background: #f9f9f9;
  padding: 15px;
}
.pricing-card .btn-primary {
  background: #0d1b3e;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-weight: 500;
}
@media(max-width:768px){
  .pricing-table {
    grid-template-columns: 1fr;
  }
}
</style>

<section class="pricing-section">
  <h2>Service Provider Packages</h2>
  <p>Compare features and choose the right plan for your business.</p>

  <div class="pricing-table">

    <!-- Free Plan -->
    <div class="pricing-card">
      <div class="header free">
        <h3>Free</h3>
        <p class="price">Free for 1 Month</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>1</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>No</td></tr>
        <tr><td>Verified Badge</td><td>No</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>4</td></tr>
        <tr><td>Video Upload</td><td>Not Allowed</td></tr>
        <tr><td>Lead Enquiries</td><td>Limited</td></tr>
        <tr><td>Response Rate</td><td>Normal</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>1 Month</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: Free</h5>-->
      <!--</div>-->
    </div>

    <!-- Basic Plan -->
    <div class="pricing-card">
      <div class="header basic">
        <h3>Basic Plan</h3>
        <p class="price">₹1,999 / 3 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>3</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>Medium</td></tr>
        <tr><td>Verified Badge</td><td>No</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>5</td></tr>
        <tr><td>Video Upload</td><td>No</td></tr>
        <tr><td>Lead Enquiries</td><td>Moderate</td></tr>
        <tr><td>Response Rate</td><td>Standard</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email & Phone</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>3 Months</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹1,999 / 3 Months</h5>-->
      <!--</div>-->
    </div>

    <!-- Standard Plan -->
    <div class="pricing-card">
      <div class="header standard">
        <h3>Standard</h3>
        <p class="price">₹3,499 / 6 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>5</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>High</td></tr>
        <tr><td>Verified Badge</td><td>Yes</td></tr>
        <tr><td>Premium Badge</td><td>No</td></tr>
        <tr><td>Image Upload</td><td>10</td></tr>
        <tr><td>Video Upload</td><td>Yes</td></tr>
        <tr><td>Lead Enquiries</td><td>High</td></tr>
        <tr><td>Response Rate</td><td>Up to 2 times more</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>No</td></tr>
        <tr><td>Customer Support</td><td>Email / Phone / Chat</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>6 Months</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹3,499 / 6 Months</h5>-->
      <!--</div>-->
    </div>

    <!-- Premium Plan -->
    <div class="pricing-card">
      <div class="header premium">
        <h3>Premium</h3>
        <p class="price">₹9,999 / 12 Months</p>
        <button class="btn btn-primary w-100">Get Started</button>
      </div>
      <table>
        <tr><td>Business Listing</td><td>Yes</td></tr>
        <tr><td>Total Services You Can List</td><td>Unlimited</td></tr>
        <tr><td>Profile Page with Contact Form</td><td>Yes (Featured)</td></tr>
        <tr><td>Business Logo & Banner</td><td>Yes</td></tr>
        <tr><td>Appear in Local Search Results</td><td>Top Priority</td></tr>
        <tr><td>Verified Badge</td><td>Yes</td></tr>
        <tr><td>Premium Badge</td><td>Yes</td></tr>
        <tr><td>Image Upload</td><td>Yes</td></tr>
        <tr><td>Video Upload</td><td>Yes</td></tr>
        <tr><td>Lead Enquiries</td><td>Priority</td></tr>
        <tr><td>Response Rate</td><td>Up to 4 times more</td></tr>
        <tr><td>Featured in “Top Service Providers”</td><td>Yes</td></tr>
        <tr><td>Customer Support</td><td>Dedicated</td></tr>
        <tr><td>Lead Alerts via SMS/Email</td><td>Yes</td></tr>
        <tr><td>Validity</td><td>1 Year</td></tr>
      </table>
      <!--<div class="pricing-footer">-->
      <!--  <h5>Price: ₹9,999 / 12 Months</h5>-->
      <!--</div>-->
    </div>

  </div>
</section>

@endsection
