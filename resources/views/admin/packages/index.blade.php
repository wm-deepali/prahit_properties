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
                                <h3 class="content-header-title">Packages</h3>
                                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary btn-save">
                                    <i class="fas fa-plus"></i> Add Package
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Packages</li>
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
                                        <table class="table table-bordered table-striped" id="packages-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price (₹)</th>
                                                    <th>Duration</th>
                                                    <th>Active</th>
                                                    <th>Created At</th>
                                                    <th width="120px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($packages as $package)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $package->name }}</td>
                                                        <td>{{ number_format($package->price, 2) }}</td>
                                                        <td>
                                                            @if($package->duration)
                                                                {{ $package->duration }} {{ ucfirst($package->duration_unit) }}
                                                            @else
                                                                —
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($package->is_active)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $package->created_at->format('d M Y, h:i A') }}</td>
                                                        <td class="text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-light dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.packages.edit', $package->id) }}">
                                                                            <i class="fas fa-edit text-primary me-2"></i> Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger"
                                                                            href="javascript:void(0)"
                                                                            onclick="deletePackage({{ $package->id }})">
                                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No packages found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        {{ $packages->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function deletePackage(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This package will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('admin/packages') }}/${id}`,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Deleted!', res.message, 'success');
                                setTimeout(() => location.reload(), 500);
                            } else {
                                Swal.fire('Error!', res.message || 'Failed to delete.', 'error');
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection