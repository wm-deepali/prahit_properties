

<?php $__env->startSection('content'); ?>
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
                                    <img src="<?php echo e(url('/images/loading.gif')); ?>" alt="Loading.." class="loading" />
                                </div>
                                <h3 class="content-header-title">Master</h3>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addFaqModal"
                                    class="btn btn-primary btn-save">
                                    <i class="fas fa-plus"></i> Add FAQ
                                </a>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">FAQs</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            

            
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
                                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <!-- <td><?php echo e(ucfirst($faq->type)); ?></td> -->
                                                        <td><?php echo e($faq->category->name ?? 'N/A'); ?></td>
                                                        <td><?php echo e($faq->question); ?></td>
                                                        <td><?php echo e($faq->answer); ?></td>
                                                        <td><?php echo e($faq->status); ?></td>
                                                        <td><?php echo e($faq->created_at->format('d M Y, h:i A')); ?></td>
                                                        <td>
                                                            <ul class="action">
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-primary btn-sm edit-faq"
                                                                        data-id="<?php echo e($faq->id); ?>">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                                        onclick="deleteFaq(<?php echo e($faq->id); ?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
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
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" id="faq_id">

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="type">FAQ Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <?php $__currentLoopData = $faqTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type); ?>"><?php echo e(ucfirst($type)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {

            // CSRF setup
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Edit FAQ
            $(document).on('click', '.edit-faq', function () {
                const id = $(this).data('id');
                $.get(`<?php echo e(url('admin/faqs')); ?>/${id}/edit`, function (data) {
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
                            url: `<?php echo e(url('admin/faqs/delete')); ?>/${id}`,
                            type: 'DELETE',
                            data: { _token: '<?php echo e(csrf_token()); ?>' },
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
                let url = id ? '<?php echo e(url("admin/faqs")); ?>/' + id : '<?php echo e(route("admin.faqs.store")); ?>';
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/faq/index.blade.php ENDPATH**/ ?>