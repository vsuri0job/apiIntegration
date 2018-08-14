<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Payment;
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Stripe_InvalidRequestError;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\newSubscription;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company_name' => 'required|string|max:255|unique:users'
            //'stripeToken' => 'required',
           ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $role='user';
        $slug_old=strtolower($data['company_name']);
        $slug=str_replace(' ','-',$slug_old);
	
        /* User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $role,
            'active' => 1,
            'company_name' =>$data['company_name'],
            'company_slug'=>$slug,
        ]); */

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $userid=999;
        $user= $data['name'];
        $date = date('Y-m-d');
        $enddate=date("Y-m-d",strtotime("+1 month". $date));

        
          $token = $_POST['stripeToken'];
          $cus_st = array(
            "description" => "Customer for ".$data['email'],
            "source" => $token,
            "email" => $data['email']
          );            
          $customer = \Stripe\Customer::create( $cus_st );
            
          $charge = \Stripe\Charge::create([
            'amount' => 100,
            'currency' => 'usd',
            'description' => 'Example charge',
            'customer' => $customer->id
          ]);
          if( $charge && $charge->status == 'succeeded' ){
              $eventdata =\Stripe\Charge::all(array("limit" => 1));
              $Subscription = \Stripe\Subscription::create(array(
                                "customer" => $customer->id,
                                "items" => array(
                                  array(
                                    "plan" => "plan_DB2WyVwlOT0HJT",
                                  ),
                                )
                              ));
          $user_id = User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'role' => $role,
              'active' => 1,
              'company_name' =>$data['company_name'],
              'company_slug'=>$slug,
              'stripe_customer_id' => $customer->id,
              'stripe_subscription_id' => $Subscription->id,
              'is_subscribed' => 1
          ]);
          if (Auth::attempt(['email' => $user_id->email,
            'password' => $data['password'], 'active' => 1])) {
                  $payment=Payment::create([
                    'user_id'=> $user_id['id'],
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
                    'email'=>$user_id->email,
                    'end_date'=>$enddate,
                    //'end_month'=>\Carbon\Carbon::now(),
                  ]);
                  $record = array('end_date'=>$enddate);
                  $user=User::where('id',Auth::user()->id)->update($record);
                } 
          } else {
            $cu = \Stripe\Customer::retrieve($customer->id);
            $cu->delete();
          }        
        //redirect('/home');
        return $user_id;
        
        /* ##### /STRIPE ##### */
    }

    public function register_beta($value='')
    {
        # code...
        $data['page_data'] = array();
        $data['include_js'] = array();
        $data['include_css'] = array();

        return view('auth.register-test',$data);
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

        $charge = \Stripe\Charge::create([
          'amount' => 100,
          'currency' => 'usd',
          'description' => 'Example charge',
          'source' => $token,
        ]);

        $eventdata =\Stripe\Charge::all(array("limit" => 1));

        dd($eventdata);
        
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
}
