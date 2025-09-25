@extends('layouts.app')

@section('title')
Add Form
@endsection

@section('css')
<style type="text/css">
.table-fitems tbody tr td:nth-child(2) {
    width: 60%;
}
</style>
@endsection


@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <div class="loading">
            <img src="{{url('/').'/'.'images/loading.gif'}}" alt="Loading.." class="loading" />
          </div>
          <h3 class="content-header-title">Master</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Add Form</li>
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
              <form class="form-body" id="add_form_types" name="add_form_types">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Form Name</label>
                    <input type="text" class="text-control" placeholder="Enter Form Name" name="form_name" required />
                  </div>
                  <div class="col-sm-8">
                    <label class="label-control">Assign to category:</label>
                    <div class="d-block">
                      <label><input type="checkbox" name="assigned_to[]" value="Rent">&nbsp;Rent &nbsp;&nbsp;</label>
                      <label><input type="checkbox" name="assigned_to[]" value="Sale">&nbsp;Sale &nbsp;&nbsp;</label>
                      <label><input type="checkbox" name="assigned_to[]" value="Projects">&nbsp;Projects &nbsp;&nbsp;</label>
                      <label><input type="checkbox" name="assigned_to[]" value="Setup For Sale">&nbsp;Setup For Sale &nbsp;&nbsp;</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems">
                        <thead>
                          <tr>
                            <th colspan="4">Property Description &amp; Price</th>
                          </tr>
                          <tr>
                            <th>Position</th>
                            <th>Label</th>
                            <th>Enable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="number" class="text-control" name="title_position" required  /></td>
                            <td>Title</td>
                            <td><input type="checkbox" name="is_title_enabled" value="1" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="type_position" required /></td>
                            <td>Type</td>
                            <td><input type="checkbox" name="is_type_enabled" value="1" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="price_position" required /></td>
                            <td>Price</td>
                            <td><input type="checkbox" name="is_price_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="price_label_position" required /></td>
                            <td>Price Label</td>
                            <td><input type="checkbox" name="is_price_label_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="status_position" required /></td>
                            <td>Status</td>
                            <td><input type="checkbox" name="is_status_enabled" value="1" /></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems">
                        <thead>
                          <tr>
                            <th colspan="4">Property Location</th>
                          </tr>
                          <tr>
                            <th>Position</th>
                            <th>Label</th>
                            <th>Enable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="number" class="text-control" name="address_position" required /></td>
                            <td>Address</td>
                            <td><input type="checkbox" name="is_address_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="map_marker_position" required /></td>
                            <td>Map Marker</td>
                            <td><input type="checkbox" name="is_map_marker_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="location_position" required /></td>
                            <td>Location</td>
                            <td><input type="checkbox" name="is_location_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="sub_location_position" required /></td>
                            <td>Sub Location</td>
                            <td><input type="checkbox" name="is_sub_location_enabled" value="1" /></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems">
                        <thead>
                          <tr>
                            <th colspan="4">Property Additional Info</th>
                          </tr>
                          <tr>
                            <th>Position</th>
                            <th>Label</th>
                            <th>Enable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="number" class="text-control" name="super_area_position" required /></td>
                            <td>Super Area</td>
                            <td><input type="checkbox" name="is_super_area_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="carpet_area_position" required /></td>
                            <td>Carpet Area</td>
                            <td><input type="checkbox" name="is_carpet_area_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="plot_area_position" required /></td>
                            <td>Plot Area</td>
                            <td><input type="checkbox" name="is_plot_area_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="property_front_position"></td>
                            <td>Property Front</td>
                            <td><input type="checkbox" name="is_property_front_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="property_depth_position"></td>
                            <td>Property Depth</td>
                            <td><input type="checkbox" name="is_property_depth_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="road_width_position" required /></td>
                            <td>Road Width</td>
                            <td><input type="checkbox" name="is_road_width_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="built_up_area_position" required /></td>
                            <td>Build up area</td>
                            <td><input type="checkbox" name="is_built_up_area_enabled" value="1" /></td>
                          </tr>
                          <tr>
                            <td><input type="number" class="text-control" name="bedrooms_position" required /></td>
                            <td>Bedrooms</td>
                            <td><input type="checkbox" name="is_bedrooms_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="bathrooms_position" required /></td>
                            <td>Bathrooms</td>
                            <td><input type="checkbox" name="is_bathrooms_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="balcony_position" required /></td>
                            <td>Balcony</td>
                            <td><input type="checkbox" name="is_balcony_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="year_built_position" required /></td>
                            <td>Year Built</td>
                            <td><input type="checkbox" name="is_year_built_enabled" value="1"></td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-fitems">
                        <thead>
                          <tr>
                            <th>Position</th>
                            <th>Label</th>
                            <th>Enable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="number" class="text-control" name="floors_position" required /></td>
                            <td>Floors</td>
                            <td><input type="checkbox" name="is_floors_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="building_total_floors_position" required /></td>
                            <td>Building Total Floors</td>
                            <td><input type="checkbox" name="is_building_total_floors_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="flooring_position" required /></td>
                            <td>Flooring</td>
                            <td><input type="checkbox" name="is_flooring_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="open_sides_position" required /></td>
                            <td>No. of Open Side</td>
                            <td><input type="checkbox" name="is_open_sides_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="facing_direction_position" required /></td>
                            <td>Facing Direction</td>
                            <td><input type="checkbox" name="is_facing_direction_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="parking_position" required /></td>
                            <td>Parking</td>
                            <td><input type="checkbox" name="is_parking_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="style_position" required /></td>
                            <td>Style</td>
                            <td><input type="checkbox" name="is_style_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="maintenance_charges_position" required /></td>
                            <td>Maintenance </td>
                            <td><input type="checkbox" name="is_maintenance_charges_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="property_charges_position" required /></td>
                            <td>Property Charges</td>
                            <td><input type="checkbox" name="is_property_charges_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="other_charges_position" required /></td>
                            <td>Other Charges</td>
                            <td><input type="checkbox" name="is_other_charges_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="booking_token_position" required /></td>
                            <td>Booking/Token</td>
                            <td><input type="checkbox" name="is_booking_token_enabled" value="1" /></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="property_use_for_position" required /></td>
                            <td>Property Use For </td>
                            <td><input type="checkbox" name="is_property_use_for_enabled" value="1"></td>
                          </tr>
                          
                          <tr>
                            <td><input type="number" class="text-control" name="amenities_features_position" required /></td>
                            <td>Amenities & Features</td>
                            <td><input type="checkbox" name="is_amenities_features_enabled" value="1" /></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-add" type="submit">Add New Form</button>
                  </div>
                </div>

                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@section('js')
<script type="text/javascript">
$(function() {
    $("#add_form_types").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.formtype.store')}}",
          method: "POST",
          data: $("#add_form_types").serialize(),
          beforeSend:function() {
            $(".loading").css('display', 'block');
            $(".btn-add").attr('disabled', true);
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              setTimeout(function() {
                window.location.href = "{{route('admin.formtype.index')}}";
              }, 1000);
            } else if (response.status === 400) {
              toastr.error(response.message)
            }
          },
          error: function(response) {
            toastr.error('An error occured')
          },
          complete: function() {
            $(".loading").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });
});
</script>


@endsection
