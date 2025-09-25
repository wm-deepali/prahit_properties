@extends('layouts.app')

@section('title')
Manage Audience
@endsection

@section('content')

<section class="breadcrumb-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="content-header">
          <h3 class="content-header-title">Ad Management</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Ad Management</li>
            <li class="breadcrumb-item active">Add Audience</li>
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
              <form class="form-body" id="add_audience" name="add_audience">
                <h4 class="form-section-h">Audience Information</h4>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Audience Name</label>
                    <input type="text" class="text-control" placeholder="Enter Audience Name" name="name" required />
                  </div>
                  <div class="col-sm-8">
                    <label class="label-control">Location</label>
                    <div class="d-block">
                      @if(isset($location))
                        @foreach($location as $k=>$v)
                          <label><input type="checkbox" name="location_id[]" value="{{$v->id}}" required /> {{$v->location}} </label>&nbsp;&nbsp;
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Age Group</label>
                    <div class="d-flex">
                      <div>
                        <select class="text-control-s" name="min_age_group" required>
                          <option>From</option>
                          <?php for($i=13;$i<=65;$i++){?>
                          <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                          <?php }?>
                          <option>65+</option>
                        </select>
                      </div>
                      &nbsp;
                      &nbsp;
                      &nbsp;
                      <div>
                        <select class="text-control-s" name="max_age_group" required>
                          <option>To</option>
                          <?php for($i=13;$i<=65;$i++){?>
                          <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                          <?php }?>
                          <option>65+</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Gender</label>
                    <div class="d-block">
                      <label><input type="checkbox" name="gender[]" value="1" required /> Male </label>&nbsp;&nbsp;
                      <label><input type="checkbox" name="gender[]" value="2" required /> Female </label>&nbsp;&nbsp;
                      <label><input type="checkbox" name="gender[]" value="3" required /> Both </label>&nbsp;&nbsp;
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Language</label>
                    <div class="d-block">
                      <label><input type="checkbox" name="language[]" value="1" required /> English </label>&nbsp;&nbsp;
                      <label><input type="checkbox" name="language[]" value="2" required /> Hindi </label>&nbsp;&nbsp;
                      <label><input type="checkbox" name="language[]" value="3" required /> Both </label>&nbsp;&nbsp;
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-primary" type="submit">Add Audience <i class="fas fa-chevron-circle-right"></i></button>
                  </div>
                </div>
                @csrf
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
    $("#add_audience").validate({
      submitHandler:function() {
        $.ajax({
          url: "{{route('admin.manage-audience.store')}}",
          method: "POST",
          data: $("#add_audience").serialize(),
          success: function(response) {
            var response = JSON.parse(response);
            if(response.status === 200) {
              toastr.success(response.message)
              $(".modal").modal('hide');
              window.location.href="{{route('admin.manage-audience.index')}}";
            } else if (response.status === 400) {
              toastr.error(response.message)
            } else {
              toastr.error('An error occured')
            }
          },
          error: function(response) {
            console.log(response)
          },
          complete: function() {
            $(".loading").css('display', 'none');
            $(".btn-add").attr('disabled', false);
          }
        })
      }
    });
</script>

@endsection