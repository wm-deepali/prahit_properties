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
              <div class="main-card mb-3 card">
        <div class="card-header">Edit Template</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <form class="form form-horizontal" method="post" action="{{ route('admin.email-template.update', $template->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="label-control">Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title" value="{{ $template->title }}">
                                    <div class="text-danger" id="title-err"></div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="label-control">Subject</label>
                                    <input type="text" class="form-control" placeholder="Enter Subject" name="subject" id="subject" value="{{ $template->subject }}">
                                    <div class="text-danger" id="subject-err"></div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="label-control">Title Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    <div class="text-danger" id="image-err"></div>
                                    @if (isset($template->image) && Storage::exists($template->image))
                                        <img src="{{ asset('storage') }}/{{ $template->image }}" width="100"> 
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="label-control">Content</label>
                                    <textarea class="form-control" name="template" id="template" cols="30" rows="10">{!! $template->template !!}</textarea>
                                    <div class="text-danger" id="template-err"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary update-template-btn" template_id="{{ $template->id }}">Update Email Settings</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="main-sideb">
                        <h4>Email Preview</h4>
                        <div class="ema-prev">
                            <a href="http://themetoaster.co.in/kkmedical/public/admin/images/email-preview.PNG">
                            <img src="http://themetoaster.co.in/kkmedical/public/admin/images/email-preview.PNG" class="img-fluid">
                        </a>
                        
                        </div>
                    </div>
                    <div class="main-sideb">
                        <h4>Code List</h4>
                        <ul>
                            @if ($template->id==1)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                            @elseif($template->id==2)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                            @elseif($template->id==3)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                            @elseif($template->id==4)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                            @elseif($template->id==5)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#COUPONCODE</li>
                                <li>#COUPONREMARK</li>
                            @elseif($template->id==6)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                                <li>#ORDERSTATUS</li>
                            @elseif($template->id==7)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                            @elseif($template->id==8)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                            @elseif($template->id==9)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#INVOICENUMBER</li>
                                <li>#ORDERAMOUNT</li>
                            @elseif($template->id==10)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#COUPONCODE</li>
                            @elseif($template->id==11)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#COUPONCODE</li>
                                <li>#COUPONREMARK</li>
                            @elseif($template->id==12)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                                <li>#COUPONCODE</li>
                            @elseif($template->id==13)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                            @elseif($template->id==14)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                            @elseif($template->id==15)
                                <li>#ADMINNAME</li>
                                <li>#PRODUCTCODE</li>
                            @elseif($template->id==16)
                                <li>#CUSTOMERNAME</li>
                                <li>#CUSTOMEREMAIL</li>
                                <li>#CUSTOMERCONTACT</li>
                            @endif
                        </ul>
                    </div>
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
    CKEDITOR.replace( 'template' );
</script>

@endsection