<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add Client Reel</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="reel-form" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
          {{-- Author Name --}}
          <div class="form-group col-md-6">
            <label>Author Name <span class="text-danger">*</span></label>
            <input type="text" name="author_name" id="author_name" class="form-control" required>
            <div class="text-danger validation-err" id="author_name-err"></div>
          </div>

          {{-- Author Image --}}
          <div class="form-group col-md-6">
            <label>Author Image</label>
            <input type="file" name="author_image" id="author_image" class="form-control">
            <small class="text-muted">Accepted: jpeg, png, jpg, webp. Max 2MB</small>
            <div class="text-danger validation-err" id="author_image-err"></div>
          </div>
        </div>

        <div class="form-row">
          {{-- Designation --}}
          <div class="form-group col-md-6">
            <label>Designation</label>
            <input type="text" name="designation" id="designation" class="form-control">
            <div class="text-danger validation-err" id="designation-err"></div>
          </div>

          {{-- Reel Type --}}
          <div class="form-group col-md-6">
            <label>Reel Type <span class="text-danger">*</span></label>
            <select name="reel_type" id="reel_type" class="form-control" required>
              <option value="youtube">YouTube</option>
              <option value="facebook">Facebook</option>
              <option value="upload">Upload File</option>
            </select>
            <div class="text-danger validation-err" id="reel_type-err"></div>
          </div>
        </div>

        {{-- Conditional Inputs --}}
        <div class="form-group reel-input youtube-input d-none">
          <label>YouTube URL <span class="text-danger">*</span></label>
          <input type="url" name="youtube_url" id="youtube_url" class="form-control">
          <div class="text-danger validation-err" id="youtube_url-err"></div>
        </div>

        <div class="form-group reel-input facebook-input d-none">
          <label>Facebook URL <span class="text-danger">*</span></label>
          <input type="url" name="facebook_url" id="facebook_url" class="form-control">
          <div class="text-danger validation-err" id="facebook_url-err"></div>
        </div>

        <div class="form-group reel-input upload-input d-none">
          <label>Upload Video File <span class="text-danger">*</span></label>
          <input type="file" name="video_file" id="video_file" class="form-control">
          <small class="text-muted">Accepted: mp4, mov, avi, mkv. Max 20MB</small>
          <div class="text-danger validation-err" id="video_file-err"></div>
        </div>

        <button type="button" class="btn btn-primary" id="add-clientreel-btn">Save</button>
      </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function () {
  function toggleReelInputs() {
    // Hide all inputs
    $('.reel-input').addClass('d-none');

    // Clear all other fields
    $('#youtube_url').val('');
    $('#facebook_url').val('');
    $('#video_file').val('');

    // Show only selected field
    let type = $('#reel_type').val();
    if (type === 'youtube') {
      $('.youtube-input').removeClass('d-none');
    } else if (type === 'facebook') {
      $('.facebook-input').removeClass('d-none');
    } else if (type === 'upload') {
      $('.upload-input').removeClass('d-none');
    }
  }

  // On change reel type
  $(document).on('change', '#reel_type', function () {
    toggleReelInputs();
  });

  // Init on load
  toggleReelInputs();
});
</script>
