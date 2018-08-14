@extends('layouts.main')
@section('content')

<div class="container" style="margin-top: 56px;">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-10 card">
	<div class="card-header">
	    <h4 class="card-title" id="basic-layout-card-center">Add Customer</h4>
	    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
	</div>
	<div class="col-md-6 offset-md-3">
	    <div class="card">
	    	<div class="card-body collapse in">
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session()->get('message') }}
                    </div>
                @endif
	        	<div class="card-block">
	             	<form class="form" method="POST" action="{{ url('insert') }}">
	                {{ csrf_field() }}
                    <div class="form-body">
						<div class="form-group">
                        	<label for="eventRegInput1">Full Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        </div>
						<div class="form-group">
                            <label for="eventRegInput2">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >
						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
						<div class="form-group">
                            <label for="eventRegInput3">Password</label>
                             <input id="password" type="password" class="form-control" name="password" >
						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
						<div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                        </div>
						<div class="form-group">
                            <label for="eventRegInput3">Business Name</label>
                             <input id="company_name" type="text" class="form-control" name="company_name" >

                        @if ($errors->has('company_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="eventRegInput2">Phone</label>
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" >
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="eventRegInput2">Web Site</label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" >
                        @if ($errors->has('website'))
                            <span class="help-block">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> ADD
                        </button> 
                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
</div>
</div>
</div>
@endsection