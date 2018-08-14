<?php
namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Stripe_CardError;
use Stripe\Stripe_InvalidRequestError;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Product;
use Stripe\Subscription;

class TempController extends Controller
{
	public function __construct(){		
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
	}
	
	public function create_cus(){
		$customer = \Stripe\Customer::create(array(
		  "description" => "Customer for chloe.harris@example.com",
		  "source" => "tok_mastercard",
		  "email" => "temp@yopmail.com"
		));
		dd($customer);
	}
	
	public function check_subs(){
		$stripe_product = \Stripe\Product::retrieve("prod_DAxsLw1FKXXwqr");
		dd($stripe_product);
	}
}
