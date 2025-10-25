<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="add-category-form" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <!-- Slug (readonly) -->

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Published" selected>Published</option>
                            <option value="Draft">Draft</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="add-category-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function slugify(text) {
    return text
      .toString()
      .toLowerCase()
      .trim()
      .replace(/[\s\W-]+/g, '-')   // Replace spaces and non-word chars with hyphens
      .replace(/^-+|-+$/g, '');    // Remove leading/trailing hyphens
}

document.getElementById('name').addEventListener('input', function() {
    document.getElementById('slug').value = slugify(this.value);
});
</script>
