@extends('layouts.main')



@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
      <h3 class="content-header-title">User</h3>
    </div>
    <div class="content-body">
      <section id="striped-row-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body collapse in">
              <div class="card-block">
                <form class="form form-horizontal striped-rows form-bordered" method="POST" action="{{url('user/update/'.$users->id)}}">
                  {{ csrf_field() }}
                  <div class="form-body usrform">
                    <h4 class="form-section"><i class="ft-user"></i> Edit User Information</h4>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="projectinput1">Name</label>
                      <div class="col-md-9">
                        <input type="text" id="projectinput1" class="form-control" placeholder="Name" name="name" value="{{$users->name}}">
                        @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="projectinput2">Email Address</label>
                      <div class="col-md-9">
                        <input type="text" id="projectinput2" class="form-control" placeholder="Email Address" name="email" value="{{$users->email}}">
                        @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="projectinput3">Company Name</label>
                      <div class="col-md-9">
                        <textarea  id="projectinput3" class="form-control" placeholder="Address" name="company_name">{{$users->company_name}}</textarea>
                        @if ($errors->has('company_name')) <span class="help-block"> <strong>{{ $errors->first('company_name') }}</strong> </span> @endif </div>
                    </div>
                  </div>
                  <div class="form-group row last">
                    <label class="col-md-3 label-control" for="projectinput4"></label>
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 