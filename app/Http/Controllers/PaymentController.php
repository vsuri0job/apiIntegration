<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use App\User;

use App\Payment;
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Stripe_InvalidRequestError;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\newSubscription;


class PaymentController extends Controller 
{
  public function index()
  {
    $user = Auth::user();
    if( $user->active == 0 && $user->end_date == '' 
        || ( $user->active && !$user->is_subscribed )
    ) 
    {
      return view('payment.index');
    }
    elseif($user->active == 0 && strtotime($user->end_date) > strtotime(date("Y-m-d")))
    {
      return view('payment.index');
    } 
    else 
    {
      return redirect('/home');
    }

  }

  public function setpayment(Request $request)
  {        
    $data=$request->all();
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $userid=Auth::user()->id;
    $user=Auth::user();
    $date = date('Y-m-d');
    $enddate=date("Y-m-d",strtotime("+1 month". $date));
    $cus_id = $user->stripe_customer_id;
    if(!$cus_id){
      $token = $_POST['stripeToken'];
      $cus_st = array(
        "description" => "Customer for ".$user['email'],
        "source" => $token,
        "email" => $user['email']
      );

      $customer = \Stripe\Customer::create( $cus_st );
      $cus_id = $customer->id;
    }
    $charge = \Stripe\Charge::create([
      'amount' => 100,
      'currency' => 'usd',
      'description' => 'set payment Charge',
      'customer' => $cus_id
    ]);    
    $eventdata =\Stripe\Charge::all(array("limit" => 1, 'customer' => $cus_id));        
    try 
    {

      $Subscription = \Stripe\Subscription::create(array(
                        "customer" => $cus_id,
                        "items" => array(
                          array(
                            "plan" => "plan_DB2WyVwlOT0HJT",
                          ),
                        )
                      ));       
      $payment=Payment::create([
        'user_id'=>Auth::user()->id,
        'event_id'=>$eventdata['data'][0]->id,
        'amount'=>$eventdata['data'][0]->amount,
        'currency'=>$eventdata['data'][0]->currency,
        'network_status'=>$eventdata['data'][0]->outcome['network_status'],
        'seller_message'=>$eventdata['data'][0]->outcome['seller_message'],
        'url_refund'=>$eventdata['data'][0]->refunds['url'],
        'card_id'=>$eventdata['data'][0]->source['id'],
        'card_brand'=>$eventdata['data'][0]->source['brand'],
        'country'=>$eventdata['data'][0]->source['country'],
        'exp_month'=>$eventdata['data'][0]->source['exp_month'],
        'exp_year'=>$eventdata['data'][0]->source['exp_year'],
        'fingerprint'=>$eventdata['data'][0]->source['fingerprint'],
        'funding'=>$eventdata['data'][0]->source['funding'],
        'last4'=>$eventdata['data'][0]->source['last4'],
        'email'=>$user->email,
        'end_date'=>$enddate,
        //'end_month'=>\Carbon\Carbon::now(),
      ]);     
      $record = array('end_date'=>$enddate, 
                      'stripe_customer_id' => $cus_id,
                      'stripe_subscription_id' => $Subscription->id,
                      'is_subscribed' => 1
                    );
      $user=User::where('id',Auth::user()->id)->update($record);
    } 
    catch (\Exception $ex) 
    {
      return $ex->getMessage();
    } 
    catch(Stripe_CardError $e) 
    {
      // Since it's a decline, Stripe_CardError will be caught
      $body = $e->getJsonBody();
      $err  = $body['error'];
      print('Status is:' . $e->getHttpStatus() . "\n");
      print('Type is:' . $err['type'] . "\n");
      print('Code is:' . $err['code'] . "\n");
      // param is '' in this case
      print('Param is:' . $err['param'] . "\n");
      print('Message is:' . $err['message'] . "\n");
    } 
    catch (\Stripe\Error\InvalidRequest $e) 
    {
      // Invalid parameters were supplied to Stripe's API
    } 
    catch (\Stripe\Error\Authentication $e) 
    {
      // Authentication with Stripe's API failed
      // (maybe you changed API keys recently)
    } 
    catch (\Stripe\Error\ApiConnection $e) 
    {
      // Network communication with Stripe failed
    } 
    catch (\Stripe\Error\Base $e) 
    {
      // Display a very generic error to the user, and maybe send
      // yourself an email
    } 
    catch (Exception $e) 
    {
      // Something else happened, completely unrelated to Stripe
    }
    
    $role=array('active'=>'1');
    $active=User::where('id', Auth::user()->id)->update($role);
    return redirect('/home');

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  }


  public function payment_beta( Request $request )
  {
    # code...


    $data['page_data'] = array();
    $data['include_js'] = array();
    $data['include_css'] = array();

    /* ##### STRIPE ##### */

    if ( $request->input() )
    {    
      $data=$request->all();
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $userid=999;
      $user= $data['name'];
      $date = date('Y-m-d');
      $enddate=date("Y-m-d",strtotime("+1 month". $date));
      
      try 
      {
        $token = $_POST['stripeToken'];

        $validation_messages = Validator::make($data, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
          'company_name' => 'required|string|max:255|unique:users',
         ]);  

         dd($validation_messages);      

        /*$charge = \Stripe\Charge::create([
          'amount' => 100,
          'currency' => 'usd',
          'description' => 'Example charge',
          'source' => $token,
        ]);

        $eventdata =\Stripe\Charge::all(array("limit" => 1));*/

        //dd($eventdata);
        
        dd('Sign up with stripe functionality is in progress...');

        $payment=Payment::create([
          'user_id'=> '999',
          'event_id'=>$eventdata['data'][0]->id,
          'amount'=>$eventdata['data'][0]->amount,
          'currency'=>$eventdata['data'][0]->currency,
          'network_status'=>$eventdata['data'][0]->outcome['network_status'],
          'seller_message'=>$eventdata['data'][0]->outcome['seller_message'],
          'url_refund'=>$eventdata['data'][0]->refunds['url'],
          'card_id'=>$eventdata['data'][0]->source['id'],
          'card_brand'=>$eventdata['data'][0]->source['brand'],
          'country'=>$eventdata['data'][0]->source['country'],
          'exp_month'=>$eventdata['data'][0]->source['exp_month'],
          'exp_year'=>$eventdata['data'][0]->source['exp_year'],
          'fingerprint'=>$eventdata['data'][0]->source['fingerprint'],
          'funding'=>$eventdata['data'][0]->source['funding'],
          'last4'=>$eventdata['data'][0]->source['last4'],
          'email'=>$eventdata['data'][0]->source['name'],
          'end_date'=>$enddate,
          //'end_month'=>\Carbon\Carbon::now(),
        ]);
        $record = array('end_date'=>$enddate);
        //$user=User::where('id',Auth::user()->id)->update($record);
      } 
      catch (\Exception $ex) 
      {
        return $ex->getMessage();
      } 
      catch(Stripe_CardError $e) 
      {
        // Since it's a decline, Stripe_CardError will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];
        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");
      } 
      catch (\Stripe\Error\InvalidRequest $e) 
      {
        // Invalid parameters were supplied to Stripe's API
      } 
      catch (\Stripe\Error\Authentication $e) 
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
      } 
      catch (\Stripe\Error\ApiConnection $e) 
      {
        // Network communication with Stripe failed
      } 
      catch (\Stripe\Error\Base $e) 
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
      } 
      catch (Exception $e) 
      {
        // Something else happened, completely unrelated to Stripe
      }
      
      $role=array('active'=>'1');
      //$active=User::where('id', Auth::user()->id)->update($role);
      //return redirect('/home');
      /* ##### /STRIPE ##### */

      //return view('auth.register-test',$data);
    }
  }

  public function resubscribe( Request $request ){
    $user = Auth::user();
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $sub = \Stripe\Subscription::retrieve( $user->stripe_subscription_id );
    if( $user->is_subscribed && $sub->status == 'active' ){      
      return redirect('home');
    } else {
      return view('payment.resubscribe', compact('sub'));
    }    
  }


  public function reset_subscription(Request $request){
    $user = Auth::user();
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $sub = \Stripe\Subscription::retrieve( $user->stripe_subscription_id );
     if( $sub->status !== 'active' ){
        $Subscription = \Stripe\Subscription::create(array(
                              "customer" => $user->stripe_customer_id,
                              "items" => array(
                                array(
                                  "plan" => "plan_DB2WyVwlOT0HJT",
                                ),
                              )
                        ));
        $record = array('stripe_subscription_id'=>$Subscription->id, 'is_subscribed' => 1);
        $user=User::where('id',Auth::user()->id)->update($record);
     } else {
        \Stripe\Subscription::update($user->stripe_subscription_id, [
          'cancel_at_period_end' => false,
          'items' => [
                [
                    'id' => $sub->items->data[0]->id,
                    'plan' => 'plan_DB2WyVwlOT0HJT',
                ],
            ],
        ]);
        $record = array('is_subscribed' => 1);
        $user=User::where('id',Auth::user()->id)->update($record);
     }
    return redirect('/home');
  }
}
