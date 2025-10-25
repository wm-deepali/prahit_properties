@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <section class="breadcrumb-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="content-header">
                                <div class="loading">
                                    <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
                                </div>
                                <h3 class="content-header-title">Master</h3>
                                  <a href="javascript:void(0)" id="add-category" class="btn btn-primary btn-save">
                                    <i class="fas fa-plus"></i> Add Category
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">FAQ Categories</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            {{-- Table --}}
            <section class="content-main-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="faq-category-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th width="120px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->slug }}</td>
                                                        <td>{{ $category->status ?? 'Draft' }}</td>
                                                        <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>
                                                        <td>
                                                            <ul class="action">
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-primary btn-sm edit-category"
                                                                        data-id="{{ $category->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        onclick="deleteCategory({{ $category->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Modal --}}
            <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            // CSRF setup
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Open Add Modal
            $(document).on('click', '#add-category', function () {
                $.get("{{ url('admin/faq-categories/create') }}", function (result) {
                    if (result.success) {
                        $('#category-modal').html(result.html).modal('show');
                    }
                });
            });

            // Open Edit Modal
            $(document).on('click', '.edit-category', function () {
                const id = $(this).data('id');
                $.get(`{{ url('admin/faq-categories') }}/${id}/edit`, function (result) {
                    if (result.success) {
                        $('#category-modal').html(result.html).modal('show');
                    }
                });
            });

            // Add Category
            $(document).on('click', '#add-category-btn', function () {
                const btn = $(this);
                btn.prop('disabled', true);
                $('.validation-err').html('');

                const formData = new FormData($('#add-category-form')[0]);

                $.ajax({
                    url: "{{ url('admin/faq-categories') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Success!', result.message, 'success');
                            $('#category-modal').modal('hide');
                            setTimeout(() => location.reload(), 400);
                        } else {
                            btn.prop('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    $(`#${key}-err`).html(result.errors[key][0]);
                                }
                            }
                        }
                    }
                });
            });

            // Update Category
            $(document).on('click', '#update-category-btn', function () {
                const btn = $(this);
                btn.prop('disabled', true);
                $('.validation-err').html('');

                const formData = new FormData($('#edit-category-form')[0]);
                formData.append('_method', 'PUT');
                const id = btn.data('category-id');

                $.ajax({
                    url: `{{ url('admin/faq-categories') }}/${id}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Updated!', result.message, 'success');
                            $('#category-modal').modal('hide');
                            setTimeout(() => location.reload(), 400);
                        } else {
                            btn.prop('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    $(`#${key}-err`).html(result.errors[key][0]);
                                }
                            }
                        }
                    }
                });
            });

            // Delete Category
            window.deleteCategory = function (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This category will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/faq-categories') }}/${id}`,
                            type: 'DELETE',
                            success: function (res) {
                                if (res.success) {
                                    Swal.fire('Deleted!', res.message, 'success');
                                    setTimeout(() => location.reload(), 400);
                                } else {
                                    Swal.fire('Error!', res.message || 'Failed to delete', 'error');
                                }
                            }
                        });
                    }
                });
            }

        });
    </script>
@endsection