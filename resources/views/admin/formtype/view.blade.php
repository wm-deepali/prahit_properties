@extends('layouts.app')

@section('title')
View Form
@endsection

@section('css')
<style type="text/css">
/*.table-fitems tbody tr td:nth-child(2) {
    width: 60%;
}*/
.checkbox{
  pointer-events: none !important;
}

</style>
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
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">View Form</li>
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
            <div class="card-block" id="fb-render">
            </div>
          </div>
        </div>
      </div>
      <center><a href="{{ url('master/formtype') }}"><button type="button" class="btn btn-info">Back</button></a></center>
    </div>
  </div>
</section>
<input type="hidden" name="save_json" id="save_json" value="{{ $data->form_data }}">ce
@endsection
@section('js')
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<script type="text/javascript">
  $(function() {
    document.getElementById('fb-render').innerHTML = '';
    var formData = $('#save_json').val();
    var formRenderOptions = {formData};
    frInstance = $('#fb-render').formRender(formRenderOptions);
  });
</script>
@endsection
