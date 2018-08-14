@extends('layouts.website')

@section('content')

<style type="text/css">
  /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
  .StripeElement {
    background-color: white;
    height: 40px;
    padding: 10px 12px;
    border-radius: 4px;
    border: 1px solid #04936a61;
    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
  .form-in-process {
    display: none;
    color: #00a5a8;
    font-size: 12px;
    float: right;
    text-decoration: underline;
  }
</style>

<div class="container" style="margin-top: 56px;">
  <div class="row">
    <div class="col-md-12 card">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title logintitle" id="basic-layout-card-center">Registration</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a> </div>
          <div class="card-body collapse in">
            <div class="card-block">
              <form class="form" id="submit_register" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-body">
                  <div class="form-group">
                    <label for="eventRegInput1">Full Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
                  <div class="form-group">
                    <label for="eventRegInput2">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
                  <div class="form-group">
                    <label for="eventRegInput3">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
                  <div class="form-group">
                    <label for="eventRegInput3">Business Name</label>
                    <input id="company_name" type="text" class="form-control" name="company_name" required>
                    @if ($errors->has('company_name')) <span class="help-block"> <strong>{{ $errors->first('company_name') }}</strong> </span> @endif 
                  </div>
                  
                  <div class="form-group">
                    <label for="eventRegInput3">Enter your card details to complete the registration process, Amount: $1</label>
                    <!-- ##### CARD ELEMENTS ##### -->
                    <div id="card-element">
                      <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    <!-- ##### /CARD ELEMENTS ##### -->
                  </div>
                  
                  <span class="form-in-process">Please wait while your registration is in process...</span>

                  <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Register </button>
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