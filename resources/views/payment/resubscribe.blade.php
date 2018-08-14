@extends('layouts.website')
@section('content')
<div class="container" style="    margin-top: 56px;">
        <div class="row">
        <div class="col-md-12 card">
         <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><b>Resubscribe</b></h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-body">
                    <div class="card-block">
                      @if(session('status'))
                         <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          {{ session('status') }}
                          </div>
                      @endif
                        <form class="form" method="POST" action="{{url('reset_subscription')}}" name="reset_subscription">
                          {{ csrf_field() }}
                          <label>                            
                            Your subscription has been ended. Please subscribe!
                          </label>
                          <input type="submit" class="btn btn-primary" name="subscribe" value="subscribe" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




@endsection