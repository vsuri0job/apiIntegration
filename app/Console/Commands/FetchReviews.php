<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Cron;
use App\Rating;
use App\Social;
use App\Socialmedia;
use Exception;
use Illuminate\Http\Request;
use Mail;

class FetchReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Reviews';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $users = User::where('role', 'user')->get();      
      foreach($users as $user) 
      {
        //$this->googlereview($user->id);
        //$this->facebookreview($user->id);
        $this->yelpreview($user->id);
      }
      Cron::create([
                    'message' => 'Review Fetched',
                  ]);
    }

    private function yelpreview($user_id) 
    {
      $yelp = Socialmedia::where('name', 'yelp', true)->value('id');      
      $social = Social::where('social_id', $yelp, true)->where('user_id', $user_id)->first();
      // $token =  $social->api;
      $token= env( 'YELP_KEY' );

      $options = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"Authorization: Bearer " . $token . "\r\n",
        )
      );

      if( $social ){
        $business_id = null;
        if( $social->page_id && $social->page_id != '#' && $social->page_id != 'NA' && $social->page_id != 'N/A'){
          $business_id = $social->page_id;
        }
        if(!$business_id && $social->url && $social->url != '#' && $social->url != 'NA' && $social->url != 'N/A'){
          $business_id = $social->url; 
        }
        if( $business_id ){        
          $url='https://api.yelp.com/v3/businesses/'.$business_id.'/reviews';
          $response=$this->curl($url, $token);          
          $responses = json_decode($response, true);          
          if(isset($responses['reviews']))
          {
              foreach($responses['reviews'] as $rating) {
                $url=Rating::where('review_type', $yelp)->where('user_url', $rating['url'])->where('customer_id', $user_id)->get();
                if(!count($url)) {
                  $cdate = explode(' ', $rating['time_created']);
                  $rating=Rating::create([
                    'customer_id' =>$user_id,
                    'yelp_business_id'  => "$business_id",
                    'comment' => $rating['text'],
                    'rating' => $rating['rating'],
                    'name' => $rating['user']['name'],
                    'user_url' => $rating['url'],                    
                    'review_type'=> $yelp,
                    'source' => 'cron',
                    'created' => current($cdate)
                  ]);
                }
              }
          }
        }
      } // end if
    } // function

    private function curl($url, $token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "authorization: Bearer ".$token
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          //return Redirect::back()->withErrors(['Invalid Your API Key Or Place Id', 'The Message']);
          $response = [ 'error' => [ 'code' => 'CUS_NOT_FOUND', 'msg' => $err] ];
          return json_encode( $response );
        } else {
          return $response;
        }
    }
}
