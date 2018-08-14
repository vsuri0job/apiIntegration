@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Import</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Import</a></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
          @if(isset($error))
            <div class="row" id="mydiv">
              <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <strong>{{$error}}!</strong> .
              </div>
            </div>
          @endif
          @if(isset($success))
          <div class="row" id="mydiv">
            <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <strong>{{$success}}!</strong> .
            </div>
          </div>
          @endif
          <div class="card">
            <div class="card-body collapse in">
              <div class="card-block card-dashboard">
              @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
                </div>
              @endif
              @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
                </div>
              @endif
              <div class="row">
                <div class="col-md-12">
                  <a href="{{url('customer')}}">
                    <button type="button" class="btn btn-primary btn-min-width ml-1 mb-1" style="float: right;">
                      <i class="fa fa-arrow-left"></i> Back
                    </button>
                  </a>
                </div>
              </div>
              <form class="form form-horizontal striped-rows form-bordered" method="POST" action="{{url('customer/importdata')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="projectinput1">Choose CSV File</label>
                    <div class="col-md-9">
                      <input type="file" name="import_file" class="form-control" value="{{old('import_file')}}">
                      @if ($errors->has('import_file'))
                      <span class="help-block">
                        <strong>{{ $errors->first('import_file') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="projectinput4"></label>
                  <div class="col-md-9">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                  </div>
                  </div>
                 </div>
                </form>
              </div>
            </div>
            </div>
          </div>
          @if(isset($success))
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header"><h4 class="card-title">Result</h4></div>
              <div class="card-body collapse in">
                <div class="table-responsive">
                  <table class="table mb-0">
                    <tbody>
                      <tr>
                        <td>Total</td>
                        <td>{{$total}}</td>
                      </tr>
                      <tr>
                        <td>Inserted</td>
                        <td>{{$inserted}}</td>
                      </tr>
                      <tr>
                        <td>Not Inserted</td>
                        <td>{{$not_inserted}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          @if(isset($exists))
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Already Exist</h4>
              </div>
              <div class="card-body collapse in">
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($exists as $exist)
                      <tr>
                        <td>{{$exist['name']}}</td>
                        <td>{{$exist['email']}}</td>
                        <td>{{$exist['contact']}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </section>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  setTimeout(function() {
      $('#mydiv').fadeOut('slow');
  }, 3000); // <-- time in milliseconds
</script>
@endsection
