@extends('layouts.app')

@section('title')
Edit Properties
@endsection

@section('content')

<section class="content-main-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card"> 
          <div class="loading">
            <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
          </div>

          <div class="card-body">
            <div class="card-block">
              <form class="form-body" id="update_property_form" name="update_property_form" enctype="multipart/form-data">
                <h4 class="form-section-h">Property Description &amp; Price</h4>
                <input type="hidden" name="from" id="from" value="{{ app('request')->input('from') }}">
                <div class="form-group-f row">
                  <div class="col-sm-8">
                    <label class="label-control">Title </label>
                    <input type="text" class="text-control" name="title" placeholder="Enter Property Name" value="{{$property->title}}" required />
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Type </label>
                    <select class="text-control" name="type_id" required />
                    <option value="">Select Type</option>
                    <option value="1" {{$property->type_id == "1" ? "selected" : ""}}>Commercial</option>
                    <option value="2" {{$property->type_id == "2" ? "selected" : ""}}>Agricultural</option>
                    <option value="3" {{$property->type_id == "3" ? "selected" : ""}}>Industrial</option>
                    <option value="4" {{$property->type_id == "4" ? "selected" : ""}}>Free Hold</option>
                  </select>
                </div>
              </div>

              <div class="form-group-f row">
                <div class="col-sm-4">
                  <label class="label-control">Price (<i class="fas fa-rupee-sign"></i>) </label>
                  <input type="number" class="text-control" name="price" min="0" placeholder="Enter Price" value="{{$property->price}}" required />
                </div>
                <div class="col-md-8">
                  <label class="label-control">Price Label</label>
                  <ul class="price_inc">
                    @php
                    $db_price_labels = explode(',', $property->price_label)
                    @endphp 

                    @foreach(config('app.price_labels') as $k=>$v)
                    @if(in_array($k, $db_price_labels))
                    <li><label><input type="checkbox" id="" name="price_label[]" value="{{$k}}" checked> {{$v}}</label></li>
                    @endif
                    @if(!in_array($k, $db_price_labels))
                    <li><label><input type="checkbox" id="" name="price_label[]" value="{{$k}}"> {{$v}}</label></li>
                    @endif
                    @endforeach
                  </ul>
                </div>
              </div>

              <div class="form-group-f row"> 
                <div class="col-sm-3">
                  <label class="label-control">Category</label>
                  <select class="text-control populate_categories" name="category_id" onchange="fetch_subcategories(this.value, fetch_form_type);">
                    @foreach($category as $k=>$v)
                    <option value="{{$v->id}}" {{$property->category_id == $v->id ? "selected" : ""}}>{{$v->category_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="label-control">Sub Category</label>
                  <select class="text-control populate_subcategories" name="sub_category_id" onchange="fetch_subsubcategories(this.value, fetch_form_type);" required>
                    <option value="">Select Sub Category</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="label-control">Sub Sub Category</label>
                  <select class="text-control populate_subsubcategories" name="sub_sub_category_id" onchange="fetch_form_type();">
                    <option value="">Select Sub Sub Category</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="label-control">Status</label>
                  <select class="text-control" name="construction_age" >
                    <option value="0" {{$property->construction_age == "0" ? "selected" : ""}}>Ready to Move</option>
                    <option value="1" {{$property->construction_age == "1" ? "selected" : ""}}>Under Construction</option>
                  </select>
                </div>
              </div>

              <div class="form-group-f row">
                <div class="col-sm-12">
                  <label class="label-control">Description</label>
                  <textarea class="text-control" rows="2" cols="4" name="description" required> {{$property->description}}</textarea>
                </div>
              </div>

              <h4 class="form-section-h">Amenities</h4>
              <div class="form-group-f row">
                @foreach($amenities as $amenity)
                <div class="col-sm-3">
                  <img src="{{ asset('storage') }}/{{ $amenity->icon }}" style="height: 30px;">
                  <p><input type="checkbox" name="amenity[]" value="{{ $amenity->id }}" @if(in_array($amenity->id, explode(',', $property->amenities))) checked @endif>  {{ $amenity->name }}</p>
                </div>
                @endforeach
              </div>

              <h4 class="form-section-h">Property Location</h4>
              <div class="form-group-f row">
                <div class="col-sm-6">
                  <label class="label-control">State </label>
                  <select class="form-control" name="state" id="state" required="">
                    <option value="">Select State </option>
                    @foreach($states as $state)
                    @if($property->state_id == $state->id)
                    <option value="{{ $state->id }}" selected="">{{ $state->name }}</option>
                    @else
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="label-control">City </label>
                  <select class="form-control" name="city" id="city" required="">
                    @foreach($cities as $city)
                    @if($property->city_id == $city->id)
                    <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                    @else
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group-f row">
                <div class="col-sm-6">
                  <label class="label-control">Location </label>
                  <select class="text-control" name="location_id[]" id="location_id" multiple="" required="">
                    @foreach($locations as $location)
                    @if(in_array($location->id, explode(',', $property->location_id)))
                    <option value="{{ $location->id }}" selected="">{{ $location->location }}</option>
                    @else
                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                    @endif
                    @endforeach
                  </select>

                </div>
                <div class="col-sm-6">
                  <label class="label-control">Sub Location </label>
                  <select class="text-control" name="sub_location_id[]" id="sub_location_id" multiple="">
                    @foreach($sub_locations as $sub_location)
                    @if(in_array($sub_location->id, explode(',', $property->sub_location_id)))
                    <option value="{{ $sub_location->id }}" selected="">{{ $sub_location->sub_location_name }}</option>
                    @else
                    <option value="{{ $sub_location->id }}">{{ $sub_location->sub_location_name }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group-f row">
                <div class="col-sm-12">
                  <label class="label-control">Address </label>
                  <input type="text" class="text-control" placeholder="Enter Address" id="address" name="address" value="{{ $property->address }}" required />
                </div>
              </div>

              <h4 class="form-section-h">Property Images</h4>
              <input type="hidden" name="additional_info" id="form_json">
              <input type="hidden" name="save_json" id="save_json" value="{{ $property->additional_info }}">
              <div class="form-group-f row">
                <div class="col-sm-6">
                  <label class="label-control">Featured Image </label>
                  <input type="file" class="text-control" name="feature_image_file"    />
                </div>
                <div class="col-sm-6">
                  <label class="label-control">Gallery Images (Multiple) </label>
                  <input type="file" class="text-control" name="gallery_images_file[]"   />
                </div>
              </div>
              <div class="row form-group-f">
                @if(count($property->PropertyGallery) > 0)
                @foreach($property->PropertyGallery as $value)
                <div class="col-sm-2">
                  <div class="prop-img-d">
                    <a href="{{ asset('') }}/{{ $value->image_path }}" target="_blank"><img src="{{ asset('') }}/{{ $value->image_path }}" alt="Property Images" class="img-fluid"></a>
                    <span onclick="deleteGalleryPhoto('{{ $value->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  </div>
                </div>
                @endforeach
                @else
                <h5 style="color: brown;">No Any Images Found.</h5> 
                @endif
              </div>
              <div id="fb-render"></div>

              <div class="form-group-f row">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-primary updateproperty" type="submit">Update Property</button>
                </div>
              </div>

              <input type="hidden" id="id" name="id" value="{{$property->id}}" />
              <input type="hidden" id="formtype_id" name="formtype_id" value="{{$property->formtype_id}}" />
              {{csrf_field()}}
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
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<script type="text/javascript">
  $(function() {

    fetch_subcategories('{{$property->category_id}}', function() {
      $(".populate_subcategories").val('{{$property->sub_category_id}}');
      fetch_subsubcategories('{{$property->sub_category_id}}', function() {
        $(".populate_subsubcategories").val('{{$property->sub_sub_category_id}}');
        fetch_form_type();
      });
    });
    fetch_sublocations('{{$property->location_id}}', function() {
      $(".populate_sublocations").val('{{$property->sub_location_id}}');
    });

    $(".property_use_for").hide();    


    setTimeout(function() {
      document.getElementById('fb-render').innerHTML = '';
      var formData = $('#save_json').val();
      var formRenderOptions = {formData};
      frInstance = $('#fb-render').formRender(formRenderOptions);
    }, 1000);
  });


  //-------------------- Get city By state --------------------//
  $('#state').on('change', function() {
    var state_id = this.value;
    $("#city").html('');
    $.ajax({
      url:"{{route('front.getCities')}}",
      type: "POST",
      data: {
        state_id: state_id,
        _token: '{{csrf_token()}}',
      },
      dataType : 'json',
      success: function(result){
        $('#city').html('<option value="">Select City</option>');
        $.each(result,function(key,city){
          $("#city").append('<option value="'+city.id+'" >'+city.name+'</option>');
        });
      }
    });
  });

//-------------------- Get city By state --------------------//
$('#city').on('change', function() {
  var city_id = this.value;
  $("#location_id").html('');
  $.ajax({
    url:"{{route('front.getLocations')}}",
    type: "POST",
    data: {
      city_id: city_id,
      _token: '{{csrf_token()}}',
    },
    dataType : 'json',
    success: function(result){
      $('#location_id').html('<option value="">Select Location</option>');
      $.each(result,function(key,location){
        $("#location_id").append('<option value="'+location.id+'" >'+location.location+'</option>');
      });
    }
  });
});

$('#location_id').on('change', function() {
  var location_id = $('#location_id').val();
  $("#sub_location_id").html('');
  $.ajax({
    url:"{{route('front.getSubLocations')}}",
    type: "POST",
    data: {
      location_id: location_id,
      _token: '{{csrf_token()}}',
    },
    dataType : 'json',
    success: function(result){
      $('#sub_location_id').html('<option value="">Select Location</option>');
      $.each(result,function(key,location){
        $("#sub_location_id").append('<option value="'+location.id+'" >'+location.sub_location_name+'</option>');
      });
    }
  });
});



$("#update_property_form").validate({
  submitHandler: function(form) {
    var data = $('#fb-render').formRender('userData');
    if(!data) {
      toastr.error('Additional details form must be required, please select another category or contact to admin.');
      return false;
    }else {
      document.getElementById('form_json').value = JSON.stringify(data);
    }
    var formData = new FormData(form);
    var obj = {};
    // // console.log(formData.formtype_id);
    // $(".dynamic_forms").each(function(x,y) {
    //  // console.log(y);
    //  var input_type = $(this).attr('data-input-type');
    //  let objKey = $(this).attr('data-sub-feature-id').replace(/\ /g,'');
    //  let objVal = $(this).val();
    //  if(input_type == "1" ) {
    //    if($(this).is(':checked')) {
    //      obj[objKey] = objVal;       
    //    }
    //  } else if(input_type == "3" ) {
    //    if(objVal != "") {
    //      if($(this).is(':checked')) {
    //        obj[objKey] = objVal;       
    //      }
    //    }
    //  } else if(input_type == "5" ) {
    //    if(objVal != "") {
    //      obj[objKey] = objVal;       
    //    }
    //  } else {
    //    obj[objKey] = objVal;       
    //  }
    // });
    // formData.append('listing_features', JSON.stringify(obj));

        // console.log(obj);
        // if(jQuery.isEmptyObject(obj)) {
        //  toastr.error('Atleast 1 feature must be selected.');
        //  return true;
        // }
        $.ajax({
          url: "{{route('admin.properties.update_property')}}",
          method: "POST",
          data: formData,
          datatype:'json',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function() {
            $(".updateproperty").attr('disabled', true);
          },
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              console.log(response);
              toastr.success(response.message);
              var from = $('#from').val();
              if(from == 'preview') {
                var id = response.data.listing.id;
                window.location.href = "{{url('master/preview/property')}}/"+id;
              }else {
                location.reload();
              }
            } else if (response.status === 400) {
              toastr.error(response.message)
            } else {
              toastr.error('An error occured')
            }
          },
          error: function(response) {
            toastr.error('An error occured')
          },
          complete: function() {
            $(".updateproperty").attr('disabled', false);
            console.log(typeof(formData));
            console.log('formData=>', formData)
          }
        })


      }
    });

// $("#update_property_form").validate({
//  submitHandler:function(form) {
//    var formData = new FormData(form);
//    $.ajax({
//      url: "{{route('admin.properties.update_property')}}",
//      method: "POST",
//      data: formData,
//          cache: false,
//          contentType: false,
//          processData: false,
//      beforeSend:function() {
//        $(".updateproperty").attr('disabled', true);
//      },
//      success: function(response) {
//        var response = JSON.parse(response);
//        if(response.status === 200) {
//          toastr.success(response.message)
//          // window.location.href = "{{route('admin.properties.index')}}";
//        } else if (response.status === 400) {
//          toastr.error(response.message)
//        }
//      },
//      error: function(response) {
//        toastr.error('An error occured')
//      },
//      complete: function() {
//        $(".updateproperty").attr('disabled', false);
//      }
//    })
//  }
// });



function fetch_subcategories(id, callback) {
  // var route = "{{route('admin.sub_category.fetch_subcategories_by_cat_id', ['id' => ':id'])}}";
  var route = "{{config('app.api_url')}}/fetch_subcategories_by_cat_id/"+id
  // var route = route.replace(':id', id);
  $.ajax({
    url:route,
    method: 'get',
    beforeSend:function() {
      $(".updateproperty").attr('disabled', true);
      $(".location").css('display','block');
    },
    success:function(response) {
      // var response = JSON.parse(response);
      if(response.responseCode === 200) {
        $(".populate_subcategories").empty();
        var subcategories = response.data.SubCategory;
        if(subcategories.length > 0) {
          $.each(subcategories, function(x,y) {
            $(".populate_subcategories").append(
              `<option> Select </option>`
              );
            $(".populate_subcategories").append(
              `<option value=${y.id}> ${y.sub_category_name} </option>`
              );
          });
        } else {
          $(".populate_subcategories").append(
            `<option value=''> No records found </option>`
            );
        }
        if(callback) {
          callback();
        }
      }
    },
    error:function(response) {
      toastr.error('An error occured while fetching sub categories');
    },
    complete:function() {
      $(".location").css('display','none');
      $(".updateproperty").attr('disabled', false);
    }
  })
}

function fetch_subsubcategories(id, callback) {
  var route = "{{config('app.api_url')}}/fetch_subsubcategories_by_subcat_id/"+id
  $.ajax({
    url:route,
    method: 'get',
    beforeSend:function() {
      $(".addproperty").attr('disabled', true);
      $(".add_formtype").empty();
      $(".loading").css('display','block');
    },
    success:function(response) {
      // var response = JSON.parse(response);
      if(response.responseCode === 200) {
        $(".populate_subsubcategories").empty();
        var subcategories = response.data.SubSubCategory;
        if(subcategories.length > 0) {
          $(".populate_subsubcategories").append(
            `<option> Select </option>`
            );
          $.each(subcategories, function(x,y) {
            $(".populate_subsubcategories").append(
              `<option value=${y.id}> ${y.sub_sub_category_name} </option>`
              );
          });
        } else {
          $(".populate_subsubcategories").append(
            `<option value=''> Please add a sub sub category </option>`
            );
        }
        if(callback){
          callback();         
        }
      }
    },
    error:function(response) {
      toastr.error('An error occured while fetching subsubcategories');
    },
    complete:function() {
      $(".loading").css('display','none');
      // $(".addproperty").attr('disabled', false);
    }
  })
}


function fetch_form_type() {

  var cat = $(".populate_categories option:selected").val();
  var subcat = $(".populate_subcategories option:selected").val();
  var listing_id = $("#id").val();

  if(subcat=="") {
    clearFormType(true);
    return true;
  }


  // var route = "{{route('admin.fetch_form_type')}}/?cat="+cat+"&subcat="+subcat+"&edit=0&listing_id="+listing_id;
  var route = "{{config('app.api_url')}}/fetch_form_type/?cat="+cat+"&subcat="+subcat+"&edit=0&listing_id="+listing_id;
  $.ajax({
    url:route,
    method: 'get',
    beforeSend:function() {
      // $(".updateproperty").attr('disabled', true);
      $(".loading").css('display','block');
    },
    success:function(response) {
      // var response = JSON.parse(response);
      $("#formtype_id").val('')
      if(response.responseCode === 200) {
        var responseData = response.data.FormType;
        var listing = response.data.Property;
        var property_subfeatures = [];
        if(responseData.length>0){
          clearFormType();
          // form type
          $.each(responseData, function(x,y) {
            // console.log(y)
            // console.log('formtype_id=>',y.formtype_id)
            $("#formtype_id").val(y.formtype_id)


            switch(y.input_type) {
              case "1" :
                    // console.log('sub_feature_enabled =>', b.sub_feature_enabled, 'sub_features =>', sub_features.id)
            // console.log('sub_f_id =>',y.sub_f_id);
            $(".add_formtype").append(
              `
              <div class='col-sm-4'>
              <label> 
              <input type='checkbox' class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value="checked"  name=${y.sub_feature_slug}  />
              ${y.sub_feature_name} 
              </label>
              </div>
              `
              );
            break;            

            case "2":
            $(".add_formtype").append(
              `
              <div class='col-sm-4'>
              <label> 
              <input type='text'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}   />
              ${y.sub_feature_name} 
              </label>
              </div>
              `
              );
            break;            

            case "3":
            $(".add_formtype").append(
              `
              <div class='col-sm-4'>
              <label> 
              <input type='radio'  class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} value='on' name='radio[]'  />
              ${y.sub_feature_name} 
              </label>
              </div>
              `
              );
            break;            

            case "4":
            $(".add_formtype").append(
              `
              <div class='col-sm-4'>
              <label> 
              <textarea class='dynamic_forms' data-sub-feature-id=${y.sub_f_id} data-input-type=${y.input_type} name=${y.sub_feature_slug}></textarea>
              ${y.sub_feature_name} 
              </label>
              </div>
              `
              );
            break;            

            case "5":
            $(".add_formtype").append(
              `
              <div class='col-sm-4'>
              <label> 
              ${y.sub_feature_name} 
              <select>
              <option value='' class='text-control dynamic_forms' data-sub-feature-id=${y.sub_f_id} name=${y.sub_feature_slug} data-input-type=${y.input_type}>
              Select
              </option>
              </select>
              </label>
              </div>
              `
              );
            break;            


          }

          }); // end $.each

          $.each(listing, function(c,d) {
            // property_subfeatures.push(y.sub_feature_id);

            console.log(d);
            $(".dynamic_forms").each(function(a,b) {
              var input_val = Number($(this).attr('data-sub-feature-id'));
              if(input_val == d.sub_feature_id) {
                $(this).attr('checked', true);
                $(this).val(d.feature_value)
              }
              // if(property_subfeatures.includes(input_val)) {
              //  $(this).attr('checked', true);
              // }
            });

          });



        } else {
          clearFormType(true);
        }
      }
    },
    error:function(response) {
      toastr.error('An error occured');
    },
    complete:function() {
      $(".loading").css('display','none');
      $(".updateproperty").attr('disabled', false);
    }
  })
}

function fetch_sublocations(id, callback) {
  var route = "{{route('admin.fetch_sublocations', ['id' => ':id'])}}";
  var route = route.replace(':id', id);
  $.ajax({
    url:route,
    method: 'get',
    beforeSend:function() {
      $(".updateproperty").attr('disabled', true);
      $(".location").css('display','block');
    },
    success:function(response) {
      var response = JSON.parse(response);
      if(response.status === 200) {
        $(".populate_sublocations").empty();
        var sublocations = response.data.SubLocation;
        if(!jQuery.isEmptyObject(sublocations)) {
          $.each(sublocations, function(x,y) {
            $(".populate_sublocations").append(
              `<option value=${y.id}> ${y.sub_location_name} </option>`
              );
          });
          
        } else {
          $(".populate_sublocations").append(
            `<option value=''> Please add a sub location </option>`
            );
        }

        if(callback) {
          callback();
        }
      }
    },
    error:function(response) {
      toastr.error('An error occured while fetching sub locations');
    },
    complete:function() {
      $(".location").css('display','none');
      $(".updateproperty").attr('disabled', false);
    }
  })
}

function deleteGalleryPhoto(id) {
  swal({
    title: "Are you sure?",
    text: "Delete This Image.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $(".loading_4").css('display', 'block');
      $(".btn-delete").attr('disabled', true);
      $.ajax({
        url: '{{ url('delete/property/images') }}',
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
          'id'    : id
        },
        success: function(response) {
          toastr.success(response);
          setTimeout(function() {
            location.reload();
          }, 2000);
        },
        error: function(response) {
          toastr.error('An error occured.')
        },
        complete: function() {
          $(".loading_4").css('display', 'none');
          $(".btn-delete").attr('disabled', false);
        }
      })
    }
  });
}

</script>
@endsection