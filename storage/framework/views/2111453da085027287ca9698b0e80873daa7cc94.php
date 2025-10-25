<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="edit-category-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="<?php echo e($category->name); ?>">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug"
                            value="<?php echo e($category->slug); ?>">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Published" <?php echo e($category->status == 'Published' ? 'selected' : ''); ?>>Published
                            </option>
                            <option value="Draft" <?php echo e($category->status == 'Draft' ? 'selected' : ''); ?>>Draft</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="update-category-btn"
                            data-category-id="<?php echo e($category->id); ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  // Function to convert text to URL-friendly slug
  function slugify(text) {
    return text.toString().toLowerCase()
      .trim()
      .replace(/[\s\W-]+/g, '-')   // Replace spaces and non-word chars with hyphens
      .replace(/^-+|-+$/g, '');    // Remove leading/trailing hyphens
  }

  // Listen for input changes on the 'name' field and update 'slug' field accordingly
  document.getElementById('name').addEventListener('input', function() {
    document.getElementById('slug').value = slugify(this.value);
  });
</script>
<?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/admin/faq-categories/edit.blade.php ENDPATH**/ ?>