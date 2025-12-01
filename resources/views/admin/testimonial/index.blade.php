@extends('layouts.app')

@section('title')
  Manage Testimonials
@endsection

@section('content')

  <section class="breadcrumb-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <div class="loading">
              <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
            </div>
            <h3 class="content-header-title">Master</h3>
            <button class="btn btn-primary btn-save" data-target="#add-category" data-toggle="modal"><i
                class="fas fa-plus"></i> Add Testimonials</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Testimonials</li>
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
                <form id="edit_profile_form" class="form-body" method="post" action="{{route('updateAboutContent')}}"
                  enctype="multipart/form-data">
                  <h4 class="form-section-h">Update Content</h4>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <div class="form-group row">
                        <div class="col-sm-8">
                          <img src="{{ asset('storage/') }}/{{ $picked->images }}" id="output" class="img-fluid"
                            style="width: 90px;">
                        </div>
                        <div class="col-sm-4">
                          <input type="file" accept="image/*" name="images" onchange="loadFile(event)">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <label class="label label-control">Heading</label>
                      <input type="text" class="text-control" name="heading" placeholder="Enter Heading"
                        value="{{ $picked->heading }}" />
                    </div>
                    <div class="col-sm-12" style="margin-top: 20px;">
                      <textarea name="description">{{ $picked->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-dark">Update Content</button>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="{{ $picked->id }}" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content-main-body">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Show On Front</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($testimonials as $t => $testimonial)
                        <tr>
                          <td>{{ $t + 1 }}</td>
                          <td><img src="{{ asset('storage/') }}/{{ $testimonial->image }}"
                              style="height: 100px;">{{ $testimonial->heading }}</td>
                          <td>{{ $testimonial->name }}</td>
                          <td>{{ $testimonial->designation }}</td>
                          <td>{{ $testimonial->description }}</td>
                          <td>@if($testimonial->status == 'Yes') Active @else Inactive @endif</td>
                          <td>
                            <select class="form-control" onchange="showOnFront('{{ $testimonial->id }}')">
                              <option @if($testimonial->show_on_front == "No") selected @endif>No</option>
                              <option @if($testimonial->show_on_front == "Yes") selected @endif>Yes</option>
                            </select>
                          </td>
                          <td>
                            <ul class="action">
                              @if($testimonial->status == 'Yes')
                                <li><a style="cursor: pointer;" onclick="changeStatus('{{ $testimonial->id }}')"><i
                                      class="fa fa-ban" aria-hidden="true"></i></a></li>
                              @else
                                <li><a style="cursor: pointer;" onclick="changeStatus('{{ $testimonial->id }}')"><i
                                      class="fa fa-check" aria-hidden="true"></i></a></li>
                              @endif
                              <li><a href="#" onclick="fetchData({{$testimonial->id}});"><i
                                    class="fas fa-pencil-alt"></i></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#delete-category"
                                  onclick="$('#delete_category #id').val({{$testimonial->id}})"><i
                                    class="fas fa-trash"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $testimonials->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" id="add-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Testimonial</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{ route('admin.createTestimonial') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="label-control">Image</label>
                <input type="file" class="text-control" name="image" required />
              </div>
              <div class="col-sm-12">
                <label class="label-control">Name</label>
                <input type="text" class="text-control" name="name" placeholder="Enter Name" required />
              </div>
              <div class="col-sm-12">
                <label class="label-control">Designation</label>
                <input type="text" class="text-control" name="designation" placeholder="Enter Designation" required />
              </div>
              <div class="col-sm-12">
                <label class="label-control">Description</label>
                <textarea name="description" class="form-control" required=""></textarea>
              </div>
            </div>
            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Add Testimonial</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="update-testimonial">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Testimonial</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{ route('admin.updateTestimonial') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <div class="col-sm-12">
                <input type="hidden" name="id" id="id">
                <label class="label-control">Image</label><br>
                <img id="show-image" style="height: 100px;">
                <input type="file" class="text-control" name="image">
              </div>
              <div class="col-sm-12">
                <label class="label-control">Name</label>
                <input type="text" class="text-control" name="name" id="name" placeholder="Enter Name" required />
              </div>
              <div class="col-sm-12">
                <label class="label-control">Designation</label>
                <input type="text" class="text-control" name="designation" id="designation"
                  placeholder="Enter Designation" required />
              </div>
              <div class="col-sm-12">
                <label class="label-control">Description</label>
                <textarea name="up_description" id="up_description" class="form-control" required=""></textarea>
              </div>
            </div>
            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-add" type="submit">Update Testimonial</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="delete-category" class="delete-category">
    <div class="modal-dialog">
      <div class="modal-content">

        <center>
          <img src="{{url('/images/loading.gif')}}" alt="Loading.." class="loading" />
        </center>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Testimonial</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="delete_category" name="delete_category">
            <div class="form-group row">
              <center> Are you sure you want to delete this? </center>
            </div>

            <div class="form-action row">
              <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-delete" type="submit">Delete</button>
              </div>
            </div>

            <input type="hidden" name="id" id="id" />
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection



@section('js')

  <script type="text/javascript">

    CKEDITOR.replace('description');
    var loadFile = function (event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
      }
    };

    $(function () {
      jQuery.validator.addMethod("restrict_special_chars", function (value, element) {
        if (value.length == 0 && value == "") {
          return true;
        }
        if (/[a-zA-Z0-9-]$/.test(value)) {
          return true;  // FAIL validation when REGEX matches
        } else {
          return false;   // PASS validation otherwise
        };
      }, 'Special characters not allowed. Please try again.');

      $("#create_category").validate({
        rules: {
          category_slug: {
            restrict_special_chars: true
          }
        },
        submitHandler: function () {
          $.ajax({
            url: "{{route('admin.category.store')}}",
            method: "POST",
            data: $("#create_category").serialize(),
            beforeSend: function () {
              $(".btn-add").attr('disabled', true);
              document.getElementById('new_loader').style.display = 'block';
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                $(".modal").modal('hide');
                reloadPage();
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              console.log(response)
            },
            complete: function () {
              document.getElementById('new_loader').style.display = 'none';
              $(".btn-add").attr('disabled', false);
            }
          })
        }
      });


      $("#update_category").validate({
        rules: {
          category_slug: {
            restrict_special_chars: true
          }
        },
        submitHandler: function () {
          $.ajax({
            url: "{{route('admin.category.update', ['category' => 1])}}",
            method: "PATCH",
            data: $("#update_category").serialize(),
            beforeSend: function () {
              $(".btn-update").attr('disabled', true);
              document.getElementById('new_loader').style.display = 'block';
            },
            success: function (response) {
              var response = JSON.parse(response);
              if (response.status === 200) {
                toastr.success(response.message)
                reloadPage();
              } else if (response.status === 400) {
                toastr.error(response.message)
              }
            },
            error: function (response) {
              console.log(response)
            },
            complete: function () {
              $(".update_category_modal").modal('hide');
              $(".btn-update").attr('disabled', false);
              document.getElementById('new_loader').style.display = 'none';
            }
          })
        }
      });
    });


    $(".btn-delete").on('click', function (e) {
      e.preventDefault();
      var id = $("#delete_category #id").val();
      document.getElementById('new_loader').style.display = 'block';
      $(".btn-delete").attr('disabled', true);
      var route = "{{route('admin.deleteTestimonial', ['id' => ':id'])}}";
      var route = route.replace(':id', id);
      $.ajax({
        url: route,
        method: "DELETE",
        data: $("#delete_category").serialize(),
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            toastr.success(response.message)
            $("#delete-category").modal('hide');
            delete_row(id);
            setTimeout(function () {
              location.reload();
            }, 2000);
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
        },
        error: function (response) {
          toastr.error('An error occured.')
        },
        complete: function () {
          document.getElementById('new_loader').style.display = 'none';
          $(".btn-delete").attr('disabled', false);
        }
      })
    });

    function fetchData(id) {

      var route = "{{route('admin.getTestimonialData', ':id')}}";
      var route = route.replace(":id", id);

      $.ajax({
        url: route,
        method: "GET",
        beforeSend: function (argument) {
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          var response = JSON.parse(response);
          if (response.status === 200) {
            console.log(response);
            document.getElementById('id').value = response.data.picked.id;
            document.getElementById('name').value = response.data.picked.name;
            document.getElementById('designation').value = response.data.picked.designation;
            document.getElementById('up_description').value = response.data.picked.description;
            document.getElementById('show-image').src = '{{ asset('storage') }}/' + response.data.picked.image;
            $("#update-testimonial").modal('show');
          } else if (response.status === 400) {
            toastr.error(response.message)
          }
          $(".loading").css('display', 'none');
        },
        error: function (response) {
          toastr.error('An error occured');
          $(".loading").css('display', 'none');
        }
      });
    }

    function changeStatus(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Chnage Status Of This Testimonial.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '{{ route('admin.changeStatusTestimonial') }}',
            method: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              'id': id
            },
            beforeSend: function () {
              $(".loading").css('display', 'block');
            },
            success: function (response) {
              swal('', response, 'success');
              setTimeout(function () {
                location.reload();
              }, 1000);
            },
            error: function (response) {
              $(".loading").css('display', 'none');
              swal('', response, 'error');
            },
            complete: function () {
              $(".loading").css('display', 'none');
            }
          })
        }
      });

    }

    function showOnFront(id) {
      $.ajax({
        url: '{{ route('admin.showOnFrontTestimonial') }}',
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
          'id': id
        },
        beforeSend: function () {
          $(".loading").css('display', 'block');
        },
        success: function (response) {
          swal('', response, 'success');
          setTimeout(function () {
            location.reload();
          }, 1000);
        },
        error: function (response) {
          $(".loading").css('display', 'none');
          swal('', response, 'error');
        },
        complete: function () {
          $(".loading").css('display', 'none');
        }
      })
    }

  </script>

@endsection