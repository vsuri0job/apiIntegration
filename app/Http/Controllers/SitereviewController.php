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

class SitereviewController extends Controller
{
  public function index($slug)
  {
    // dd($user_id=Auth::user()->id);
    $data=User::where('company_slug',$slug)->first();        
    if($data === null)
    {
      dd('Sorry page not found');
    }
    else
    {
      // $social_yelp=Social::where('user_id',$data['id'])->where('social_id', '3')->where('active', 'yes')->get();
      // dd($social_yelp);
      $check=Social::where('user_id', $data['id'])->where('active', 'yes')->get();      
      $user = Social::where('user_id', '=', $data['id'])->where('active', 'yes')->first();
            
      if ($user === null) 
      {
        echo '<a href="'.url('manage_site').'">'.'Click To Add Services'.'</a><br>';
        die('Too See Reviews First sYou Need To Add Review Services');
      }
      else
      {
          $data12['slug']=User::where('company_slug',$slug,true)->first();
          $slug=User::where('company_slug',$slug,true)->first();
          $id=Socialmedia::where('name', 'Review Champ')->value('id');
          $data12['socialmedia']=Social::where('user_id', $slug->id)->where('social_id', '!=', $id)->where('active', 'yes')->get(); // social logo
          $data12['rating']=Rating::where([
            ['customer_id', $slug->id],
            ['active', '0']
          ])->orderBy('id', 'desc')->where('review_type', '!=', $id)->paginate(10); 
          $data12['show_review']=User::where('id',$slug->id, true)->first();
          $data12['logo'] = $slug['logo'];
          $data12['message'] = $slug['message'];
          $data12['phone'] = $slug['phone'];
          $data12['website'] = $slug['website'];
        
          $companyslug=$data12['slug']['company_slug'];
          $data12['url']=url('web-widget').'/'.$companyslug;
          
          // fb review
          $record=Social::where('social_id', 1, true)->where('user_id', $slug->id)->where('active', 'yes')->first();
          /*$fb = new \Facebook\Facebook([
            'app_id'=>$record['api'],
            'app_secret'=> $record['secret'],
          ]);
          try 
          {
            
            $response = $fb->get('/'.$record['page_id'].'?fields=ratings',$record['access_token']);
            $graphNode = $response->getGraphNode();
            $response=json_decode($response->getBody(), true);
            
            if(isset($response['ratings']['data'])){
              $facebookcount=count($response['ratings']['data']);
              $data12['userid']=$slug->id;
              $data12['facebookcount']=$facebookcount;
            }
            else
            {
               $i=0;
                $data12['userid']=$slug->id;
                $data12['facebookcount']=$i;
            }
            
          } 
          catch(\Facebook\Exceptions\FacebookResponseException $e) 
          {
            //When Graph returns an error
            //echo 'Graph returned an error: ' . $e->getMessage();
            $i=0;
            $data12['userid']=$slug->id;
            $data12['facebookcount']=$i;
          } 
          catch(\Facebook\Exceptions\FacebookSDKException $e) 
          {
            // When validation fails or other local issues
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            $i=0;
            $data12['userid']=$slug->id;
            $data12['facebookcount']=$i;
          }*/
          
          //yelpreview
          $data12['slug']=$slug;
          $yelp=Socialmedia::where('name', 'yelp')->value('id');          
          $token=Social::where('user_id', $slug->id)->where('social_id', $yelp)->where('active', 'yes')->value('api');
          $token= env( 'YELP_KEY' );
          // $businessid = Social::where('user_id', $slug->id, true)->where('social_id', $yelp)->where('active', 'yes')->value('secret');
          $social_yelp=Social::where('user_id',$slug->id)->where('social_id', $yelp)->where('active', 'yes')->get()->first();          
          $businessid = $social_yelp->url;          
          // $social_yelp=Social::where('user_id',$data['id'])->where('social_id', '3')->where('active', 'yes')->get();          
          $url='https://api.yelp.com/v3/businesses/'.$businessid.'/reviews';
          $response=$this->curl($url, $token);          
          $responses = json_decode($response, true);          
          if(isset($responses['error']))
          {
              if($responses['error']['code']=='BUSINESS_NOT_FOUND')
              {
                  $data12['yelp']=0;
                  $data12['userid']=$slug->id;
                  $data['status']='Yelp Invalid Business Id';
                  return view('site.index',$data12);
              }
              elseif($responses['error']['code']=='TOKEN_INVALID')
              {
                  $data12['yelp']=0;
                  $data12['userid']=$slug->id;
                  $data['status']='Yelp Invalid API ID';
                   return view('site.index',$data12);
               }
              elseif($responses['error']['code']=='TOKEN_MISSING')
              {
                  $data12['yelp']=0;
                  $data12['userid']=$slug->id;
                  $data['status']='Yelp Token Missing';
                  return view('site.index',$data12);
              }
              elseif($responses['error']['code']=='NOT_FOUND')
              {
                  $data12['yelp']=0;
                  $data12['userid']=$slug->id;
                  $data['status']='Check Yelp businessid Or Api Id';
                   return view('site.index',$data12);
              }
          }
          else
          {
            $data12['userid']=$slug->id;
            $data12['yelp']=$responses['total'];           
            $data12['facebookcount'] = Rating::where('customer_id', $slug['id'])->where('review_type', 1)->count();            
            return view('site.index',$data12);
          }
        }    
      }// End if else
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
