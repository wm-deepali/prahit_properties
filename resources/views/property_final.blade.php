@extends('layouts.front.app')
@section('title')
  <title>Property Post, Offer</title>
@endsection
@section('content')

  <section class="hero-section hero-bg-bg1 bg-gradient">
    <div class="text-block">
      <div class="container">
        <div class="table-responsive">
          <table class="table package-table">
            <thead>
              <tr>
                <th rowspan="2">Features</th>
                <th class="text-center">Silver</th>
                <th class="text-center">Gold</th>
                <th class="text-center">Platinum</th>
              </tr>
              <tr>
                <th class="text-center"><span class="main-price">₹ 4000</span><span class="cut-price">₹ 5000</span><span class="off-price">10% off</span></th>
                <th class="text-center"><span class="main-price">₹ 9000</span><span class="cut-price">₹ 10000</span><span class="off-price">10% off</span></th>
                <th class="text-center"><span class="main-price">₹ 14000</span><span class="cut-price">₹ 15000</span><span class="off-price">10% off</span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Responsive Design <span class="table-flags" style="background:#069f17;">New</span></th>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Custom Layout Design</th>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Main Banner Management <span class="table-flags" style="background:#ed0000;">Featured</span></th>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Social Media Buttons</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>SEO Management <span class="table-flags" style="background:#069f17;">New</span></th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Testimonials Management</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Google Analytics</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>XML Sitemap</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Google Location Map</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Blog</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
              <tr>
                <th>Support</th>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="cross-sectb">✕</span></td>
                <td class="text-center"><span class="tick-sectb">✓</span></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th class="text-center"><span class="main-price">₹ 4000</span><span class="cut-price">₹ 5000</span><span class="off-price">10% off</span></th>
                <th class="text-center"><span class="main-price">₹ 9000</span><span class="cut-price">₹ 10000</span><span class="off-price">10% off</span></th>
                <th class="text-center"><span class="main-price">₹ 14000</span><span class="cut-price">₹ 15000</span><span class="off-price">10% off</span></th>
              </tr>
              <tr>
                <th></th>
                <th class="text-center"><a href="#" class="table-book-btn">Book Now</a></th>
                <th class="text-center"><a href="#" class="table-book-btn">Book Now</a></th>
                <th class="text-center"><a href="#" class="table-book-btn">Book Now</a></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>

  <div class="cta-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="call-to-action-content i-text-center">
            <h2 class="h1">Not looking to buy right now? no worry, Post it for FREE</h2>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="call-to-action-btn text-right i-text-center">
            <form method="post" action="{{ url('post/property/final') }}">
              @csrf
              <input type="hidden" name="property_id" value="{{ $id }}">
              <input type="hidden" name="listing_type" value="Free">
              <th class="text-center"><input type="submit" class="table-book-btn" value="Post Property Free"></th>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection