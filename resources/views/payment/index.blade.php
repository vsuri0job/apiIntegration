@extends('layouts.website')
@section('content')
<div class="container" style="    margin-top: 56px;">
        <div class="row">
        <div class="col-md-12 card">
         <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><b>PAY WITH STRIPE</b></h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                      @if(session('status'))
                         <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          {{ session('status') }}
                          </div>
                      @endif
                       <form class="form" method="POST" action="{{url('setpayment')}}" name="member_signup">
                        {{ csrf_field() }}
                        <script
                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="{{ env('STRIPE_KEY') }}"
                          data-amount="100"
                          data-name="Payment"
                          data-description="Enter Your Account Detail"
                          data-image=""                          
                          data-email="{{ Auth::user()->email }}"
                          data-locale="auto"
                          data-currency="usd">
                        </script>
                              <input type="hidden"  name="user_id" value="{{Auth::user()->id }}">
                              <button id="customButton" style="display: none">Purchase</button>
                              <script>
                                  // Open Checkout when the page has finished loading
                                  $(window).load(function() {
                                    $('#customButton').trigger('click');
                                  });
                        </script>
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
