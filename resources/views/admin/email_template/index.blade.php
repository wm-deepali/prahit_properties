@extends('layouts.app')

@section('title')
Manage Email Templates
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
          <a href="{{ route('admin.email-template.create') }}"><button class="btn btn-primary btn-save"><i class="fas fa-plus"></i> Add Template</button></a>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Manage Email Templates</li>
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
              <div class="table-responsive">
                <table class="table table-bordered table-fitems">
                  <thead>
                    <tr>
                      <th>Date &amp; Time</th>
                      <th>Title Image</th>
                      <th>Title</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($templates) && count($templates) > 0)
                      @foreach($templates as $template)
                          <tr>
                              <td>{{ $template->created_at }}</td>
                              <td>
                                @if(isset($template->image) && Storage::exists($template->image))
                                  <img src="{{ asset('storage') }}/{{ $template->image }}" style="height: 50px;">
                                @else
                                  'N/A'
                                @endif
                              </td>
                              <td>{{ $template->title }}</td>
                              <td>{{ $template->subject }}</td>
                              <td>{{ $template->status }}</td>
                              <td class="text-center btn-group-sm">
                                <ul class="action">
                                  <li><a href="{{ route('admin.email-template.edit', $template->id) }}"><i class="fas fa-pencil-alt"></i></a></li>
                                  @if($template->status == "active")
                                    <li><a style="cursor: pointer;" onclick="changeStatus('{{ $template->id }}')"><i class="fa fa-ban" aria-hidden="true"></i></a></li>
                                  @else
                                    <li><a style="cursor: pointer;" onclick="changeStatus('{{ $template->id }}')"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                                  @endif
                                </ul>
                              </td>
                          </tr>
                      @endforeach
                    @else 
                      <tr>
                        <td colspan="5"> No records found </td>
                      </tr> 
                    @endif
                  </tbody>
                </table>
              </div>
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
  function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chaneg Status This Template.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ route('admin.change-email-template-status') }}',
            method: "post",
            data:{
              _token:'{{ csrf_token() }}',
              'id'  : id
            },
            beforeSend:function() {
              $(".loading").css('display', 'block');
            },
            success: function(response) {
              swal('', response, 'success');
              setTimeout(function() {
                location.reload();
              }, 1000);
            },
            error: function(response) {
              swal('', response, 'error');
            },
            complete: function() {
                $(".loading").css('display', 'none');
            }
          })
      }
    });
  }

</script>

@endsection