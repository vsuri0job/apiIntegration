<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DateTime;
use Auth;
use App\Rating;
use App\Social;
use App\Socialmedia;
use DB;
use Stripe\Stripe;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$userid1=Auth::user()->id;
        //$this->run_curl(Auth::user->id);
        $data['rating']=Rating::where('review_type', '!=', 10)->where('customer_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $data['socials']=Socialmedia::whereIn('id',[1,2,3])->get();        
        $data['user_id'] = Auth::user()->id;
        
        $user_id = Auth::user()->id;
        $record=Social::where('social_id', 1, true)->first();
        
        //YELP API
        $yelp=Socialmedia::where('name', 'yelp')->value('id');
        $token=Social::where('user_id', Auth::user()->id)->where('social_id',$yelp)->value('api');
        $businessid = Social::where('user_id', Auth::user()->id, true)->where('social_id', $yelp)->value('page_id');
        if( !$businessid || $businessid == 'N/A' ||  $businessid == 'NA'){
            $data['yelptotal']=0;
        } else {
          $url='https://api.yelp.com/v3/businesses/'.$businessid.'/reviews';
          $response=$this->curl($url, $token);        
          $responses = json_decode($response, true);        
          if(isset($responses['error']))
          {
              $data['yelptotal']=0;              
              if($responses['error']['code']=='BUSINESS_NOT_FOUND'){
                  // $data['status']='Yelp Invalid Business Id';
              }elseif($responses['error']['code']=='TOKEN_INVALID'){                  
                  // $data['status']='Yelp Invalid API ID';                  
              }elseif($responses['error']['code']=='TOKEN_MISSING'){                  
                  // $data['status']='Yelp Token Missing';                  
              }elseif($responses['error']['code']=='NOT_FOUND'){
                  // $data['status']='Check Yelp businessid Or Api Id';                  
              }              
          } else {
              $data['yelptotal']=$responses['total'];              
          }
        }
        if( !$data['yelptotal'] ){
          $data['status'] = '';
        }
        return view('home', $data);
       
        //Facebook API
        
        try 
          {
            $fb = new \Facebook\Facebook([
              'app_id'=>$record['api'],
              'app_secret'=>$record['secret'],
            ]);
            $response = $fb->get(
              '/'.$record['page_id'].'?fields=ratings',$record['access_token']
            );
          } 
          catch(FacebookExceptionsFacebookResponseException $e) 
          {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } 
          catch(FacebookExceptionsFacebookSDKException $e) 
          {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }

          $graphNode = $response->getGraphNode();

          $response=json_decode($response->getBody(), true);
          $i = 0;
          foreach($response['ratings']['data'] as $rating){
            $count = $rating['rating'];
            $i++;
           
          }
          $data['facebook']=$i;
          

          return view('home', $data);
    }
   
    public function curl($url, $token)
    {
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
          echo 'Error';
        } else {
          return $response;
        }

     }
}
