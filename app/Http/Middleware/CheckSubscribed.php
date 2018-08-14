<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Stripe_InvalidRequestError;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\newSubscription;
class CheckSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if( $user->stripe_subscription_id ){
            $sub = \Stripe\Subscription::retrieve( $user->stripe_subscription_id );
            if ( $sub->status !== 'active' && !$user->is_subscribed) {
                return redirect('resubscribe')->with('status', 'You must subscribe to proceed!');
            }
        } else if( Auth::user()->role != 'admin' && !Auth::user()->is_subscribed ){            
            return redirect('payment')->with('status', 'You must complete payment process to login!');
        }
        return $next($request);
    }
}
