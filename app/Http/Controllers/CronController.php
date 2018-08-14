<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client as Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Excel;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Settings;
use App\Review;
use App\Rating;
use App\Company;
use DateTime;
use App\Socialmedia;
use App\Social;
use Exception;
use Mail;

class CronController extends Controller
{
    /*
    *Method: index
    *Parameter: Null
    *Task:To display all settings.
    */
    public function index()
    {
      $users = User::where('role', 'user')->get();      
      foreach($users as $user) 
      {
        //$this->googlereview($user->id);
        //$this->facebookreview($user->id);
        $this->yelpreview($user->id);
      }
    }

   /*
    *Method: reviews
    *Parameter: Null
    *Task:To show facebook review.
    */
    
    public function facebookreview($id)
    {
      $client = new Client;
      $facebook=Socialmedia::where('name','facebook',true)->value('id');
      $placeid = Social::where('social_id', $facebook, true)->where('user_id', $id, true)->first();
      
      $place_id = $placeid->url; 
      $access_token = $placeid->api; 
     
      $response = $client->get('https://graph.facebook.com/v2.11/' .$place_id. '?access_token=' . $access_token . '&&fields=access_token,ratings{reviewer,rating,review_text,email,created_time,id}');

      $response = json_decode($response->getBody(), true);
      $ratings=$response['ratings']['data'];
      foreach ($ratings as $rating) 
      {
        echo "name: ".$rating['reviewer']['name'].'<br>';
        echo "rating: ".$rating['rating'].'<br>';
        echo "Commments: ".$rating['review_text'].'<br>';
        echo "date: ".$rating['created_time'].'<br>';
        $date=  substr($rating['created_time'], 0,-14);
        //echo  $date=implode("T",$rating['created_time']);
        //echo $date[0];
        // echo $date[1];
        $check=Rating::where('user_type',$rating['reviewer']['id'])->where('customer_id', $id)->get();
        if($check->count()=='0')
        {
          $rating= Rating::create([
                      'customer_id' =>$id,
                      'comment' => $rating['review_text'],
                      'rating' => $rating['rating'],
                      'name' => $rating['reviewer']['name'],
                      'email' => '',
                      'contact' => '',
                      'created'=>$date,
                      'user_type'=>$rating['reviewer']['id'],
                      'review_type'=>$facebook
                    ]);
        }
      }
    }

    /*
    *Method: googlereview
    *Parameter: Null
    *Task:To show google review.
    */

    public function googlereview($user_id) 
    {
        $client = new Client;
        $google = Socialmedia::where('name', 'google', true)->value('id');
        $get = Rating::where('customer_id', $user_id)->where('review_type', 2, true)->first();
        $social_id = 2;
        $socials = Social::where('social_id', $social_id)->where('user_id', $user_id, true)->first();
        $place_id = $socials->url;
        $api = $socials->api;
        //$response = $client->get('https://maps.googleapis.com/maps/api/place/details/json?placeid='.$place_id.'&key='.$api);
        $response = $client->get('https://maps.googleapis.com/maps/api/place/details/json?placeid=123&key=282');
        $response = json_decode($response->getBody(), true);
        try
        {
          if(isset($response['result'])) 
          {
            $ratings=$response;
            $reviews = $ratings['result']['reviews'];
            foreach ($ratings['result']['reviews'] as $rating) 
            {
              $url=Rating::where('review_type', $google)->where('user_url', $rating['author_url'])->get();
              if(count($url) == 1) 
              {
                echo 'already exists <b>' .$rating['author_url'] . '</b><br>';
              } 
              else 
              {
                $rating= Rating::create([
                  'customer_id' =>$user_id,
                  'comment' => $rating['text'],
                  'rating' => $rating['rating'],
                  'name' => $rating['author_name'],
                  'user_url' => $rating['author_url'],
                  'email' => '',
                  'contact' => '',
                  // 'created'=>$date,
                  //'user_type'=>$rating['reviewer']['id'],
                  'review_type'=>$google,
                  //'created' => $date
                ]);
              }
            }
            $var_msg = "Data Insreted";
            throw new Exception($var_msg);
          } 
        }
        catch (Exception $e) 
        {
            echo "Message: " . $e->getMessage();
        }
      }   


    /*
    *Method: yelpreview
    *Parameter: Null
    *Task:To show yelp review.
    */

    public function yelpreview($user_id) 
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
                    'review_type'=>$yelp,
                    'created' => current($cdate)
                  ]);
                }
              }
          }
        }
      } // end if
    } // function

    public function send()
    {

      $data = array('title' => 'Demo Title', 'content' => 'Demo content');
      echo view('email.send', $data);
      
      /*Mail::send('email.send', $data, function($message) use($data) {
            $message->from("info@reviewchamp.net");
            $message->to("hdhote7@gmail.com");
            $message->subject("New Inspection Detail");
        });*/
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
          $response = [ 'error' => [ 'code' => 'CUS_NOT_FOUND', 'msg' => $err] ];
          return json_encode( $response );
        } else {
          return $response;
        }

     }
}
