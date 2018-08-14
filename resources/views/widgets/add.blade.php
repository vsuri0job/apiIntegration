@extends('layouts.main')
@section('content')
 <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title">Create Widgets</h3>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Create Widgets</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Zero configuration table -->
            <section class="basic-select2">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="card">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <form class="form form-horizontal" method="post" action="{{url('web_widgets/')}}" enctype="multipart/form-data">{{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="projectinput1">Select Company Name</label>
                                                <div class="col-md-9">
                                                    <select class="select2 form-control" name="company_id">
                                                        @foreach($company as $companies)
                                                            <option value="{{$companies->id}}">{{$companies->name}}</option>
                                                        @endforeach
                                                     </select>
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
  <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/selects/select2.min.css">
 <script src="{{url('assets')}}/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
 <script src="{{url('assets')}}/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
@endsection
