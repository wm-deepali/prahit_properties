@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            {{-- Breadcrumb --}}
            <section class="breadcrumb-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="content-header">
                                <div class="loading">
                                    <img src="{{ url('/images/loading.gif') }}" alt="Loading.." class="loading" />
                                </div>
                                <h3 class="content-header-title">Master</h3>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addFaqModal"
                                    class="btn btn-primary btn-save">
                                    <i class="fas fa-plus"></i> Add FAQ
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">FAQs</li>
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
                                        <table class="table table-bordered" id="faq-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Category</th>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th width="120px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($faqs as $faq)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <!-- <td>{{ ucfirst($faq->type) }}</td> -->
                                                        <td>{{ $faq->category->name ?? 'N/A' }}</td>
                                                        <td>{{ $faq->question }}</td>
                                                        <td>{{ $faq->answer }}</td>
                                                        <td>{{ $faq->status }}</td>
                                                        <td>{{ $faq->created_at->format('d M Y, h:i A') }}</td>
                                                        <td>
                                                            <ul class="action">
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-primary btn-sm edit-faq"
                                                                        data-id="{{ $faq->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                                        onclick="deleteFaq({{ $faq->id }})">
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

            {{-- Add/Edit FAQ Modal --}}
            <div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFaqModalLabel">Add New FAQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="faqForm" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="faq_id">

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="type">FAQ Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach($faqTypes as $type)
                                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                        @endforeach
                                    </select>
                                </div> -->

                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" name="question" id="question" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea name="answer" id="answer" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Published">Published</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" id="save-faq-btn">Save FAQ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

            // Edit FAQ
            $(document).on('click', '.edit-faq', function () {
                const id = $(this).data('id');
                $.get(`{{ url('admin/faqs') }}/${id}/edit`, function (data) {
                    $('#faq_id').val(data.id);
                    $('#question').val(data.question);
                    $('#answer').val(data.answer);
                    $('#status').val(data.status);
                    $('#type').val(data.type);
                    $('#category_id').val(data?.category?.id);
                    $('#addFaqModalLabel').text("Edit FAQ");
                    $('#addFaqModal').modal('show');
                });
            });

            // Delete FAQ
            window.deleteFaq = function (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/faqs/delete') }}/${id}`,
                            type: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (res) {
                                Swal.fire('Deleted!', res.message, 'success');
                                setTimeout(() => location.reload(), 500);
                            },
                            error: function (xhr) {
                                Swal.fire('Delete failed!', '', 'error');
                            }
                        });
                    }
                });
            }

            // Save / Update FAQ
            $('#faqForm').on('submit', function (e) {
                e.preventDefault();

                let id = $('#faq_id').val();
                let url = id ? '{{ url("admin/faqs") }}/' + id : '{{ route("admin.faqs.store") }}';
                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            Swal.fire(response.message);
                            $('#addFaqModal').modal('hide');
                            $('#faqForm')[0].reset();
                            $('#faq_id').val('');
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Something went wrong!');
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>
@endsection