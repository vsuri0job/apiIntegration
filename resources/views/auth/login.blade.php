@extends('layouts.website')



@section('content') 

<!-- <div class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                <div class="panel-heading">Login</div>



                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">

                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>



                            <div class="col-md-6">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>



                                @if ($errors->has('email'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <label for="password" class="col-md-4 control-label">Password</label>



                            <div class="col-md-6">

                                <input id="password" type="password" class="form-control" name="password" required>



                                @if ($errors->has('password'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="form-group">

                            <div class="col-md-6 col-md-offset-4">

                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me

                                    </label>

                                </div>

                            </div>

                        </div>



                        <div class="form-group">

                            <div class="col-md-8 col-md-offset-4">

                                <button type="submit" class="btn btn-primary">

                                    Login

                                </button>



                                <a class="btn btn-link" href="{{ route('password.request') }}">

                                    Forgot Your Password?

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div> -->

<div class="container" style="margin-top: 56px;">
  <div class="row match-height">
    <div class="col-md-12 card">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title logintitle" id="basic-layout-form-center" style="text-align: center;">Login</h4>
          </div>
          <div class="card-body collapse in">
            <div class="card-block">
              <form class="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-6 offset-md-3">
                    <div class="form-body">
                      <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus  placeholder="email">
                        @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required placeholder="password">
                      </div>
                      <a class="btn btn-link" href="{{ route('password.request') }}"> Forgot Your Password? </a> </div>
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Login </button>
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
@endsection 