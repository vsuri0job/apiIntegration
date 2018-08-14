<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Payment;

class Active
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
       if(Auth::user()->active != 1 && Auth::user()->role != 'admin' && (strtotime(Auth::user()->end_date) > strtotime(date("Y-m-d")) || Auth::user()->end_date == ''))
        {
           return redirect('payment')->with('status', 'You must complete payment process to login!');
            return redirect('payment');
        }
            return $next($request);
    }
}
