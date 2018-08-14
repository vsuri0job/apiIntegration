<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Widget;
use App\Company;
use App\User;
use App\Rating;
use App\Template;
use App\Social;
use View;
use Auth;
use DB;

class WidgetsController extends Controller
{
    /*
    *Method: index
    *Parameter: Null
    *Task:To display Form for create widgets.
    */
    public function index($slug)
    {
        $data=User::where('company_slug',$slug)->get();
        if($data->count()=='0')
        {
           return view('widgets.error-form');
        }
        else
        {
          $data12['slug']=User::where('company_slug',$slug,true)->first();
          $slug=User::where('company_slug',$slug,true)->first();
          $data12['socialmedia']=Social::where('user_id', $slug->id)->where('active','yes')->get();
          $data12['rating']=Rating::where([
            ['customer_id', $slug->id],
            ['rating', '>', '3'],
            ['active', '0']
          ])->limit(8)->get();
          $data12['show_review']=User::where('id',$slug->id, true)->first();
          $data12['logo'] = $slug['logo'];
          $data12['message'] = $slug['message'];
          $data12['phone'] = $slug['phone'];
          $data12['website'] = $slug['website'];
          return view('widgets.form',$data12);
        }
      }

     /*
    *Method: rating
    *Parameter: Request ($request)
    *Task:For Add Rating
    */
    public function rating(Request $request)
    {

        $id = Auth::id();
        $user = User::where('id',$id, true)->first();        
        //$useremail = trim($user['email']);
        
        $data=$request->all();
        $useremail = trim($data['email']);
        //$useremail = $user->email;
        
        $name = $data['name'];
        
        $slug=$data['slug'];
        $data12['slug']=User::where('company_slug',$slug,true)->first();
        $useremail = $data12['slug']->email;        
        $validation=Validator::make($data, [
           'rating'=> 'required|in:1,2,3,4,5', 
            'name' => 'required|string|max:255',
            //'lastname' => '',
            'contact' => 'required|string|max:255',
            'email' => 'required|email|max:255',

        ]);
        
        if($validation->fails())
        {
          return Redirect::to('web-widget/'.$slug)->withErrors($validation)->withInput();
        }
        else
        {

          if($data['rating'] <= 3) 
          {
              $detail = array('title' => 'Low Rating', 'content' => 'Demo content', 
                'subject' => 'Negative Rating Alert', 'email'=>$useremail);
              Mail::send('email',$detail,function($message) use($detail){
                          $message->to($detail['email']);
                          $message->from('noreply@reviewchamp.net', 'ReviewChamp');
                          $message->subject($detail['subject'], 'hello');
                          $message->setBody('Dear Client:
  <br/>
  <br/>
  <br/>
  You just received an unfavorable Review Champ rating. At your first opportunity, we suggest you look it over so you can take the appropriate follow-up action. That will help prevent this customer from giving you a similar negative rating on one or more of the public review sites. It also enables you to fix the problem and make good on your promise of superior customer service.
<br/>
<br/>
The Review Champ Team', 'text/html'); 
              });
          } 

          $rating= Rating::create([
            'customer_id' => $data['customer_id'],
            //'comment' => $data['comment'],
            'rating' => $data['rating'],
            'name' => $data['name'],
            //'lastname' => $data['lastname'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'review_type' => 10,
            'created'=>$date=date('Y-m-d'),
          ]);

            $data['name']=$rating->name;
            $data['email']=$rating->email;

            if($data['rating'] > 3) 
            {
              $msg='yes';
            }
            else
            {
              $msg='no';
            }

            return Redirect::to('web-widget/'.$slug.'/thank-you')->with('message', $msg);;
        }
    }

    /*
    *Method: thankyou
    *Parameter: Slug ($slug)
    *Task:To Display thank you page
    */

    public function thankyou($slug)
    {
        $data13['slug']=User::where('company_slug',$slug,true)->first();

        $slug=User::where('company_slug', $slug, true)->first();
        
        $data13['rating']=Rating::where('customer_id', $slug->id)->where('rating', '>', '3')->where('active', '0')->orderBy('id', 'desc')->limit(8)->get();
        $data13['review']=Rating::where('created',date('Y-m-d'))->orderBy('id', 'desc')->first();
        $data13['socialmedia']=Social::where('user_id', $slug->id)->where('active', '!=', 'no')->where('social_id', '!=', '10')->get();
        $data13['logo'] = $slug['logo'];
        $data13['message'] = $slug['message'];
        $data13['phone'] = $slug['phone'];
        $data13['website']= $slug['website'];
        return view('widgets.thankyou',$data13);
    }
    

    public function mail()
    {
        return view('mail.demo');
    }


    public function wigets()
    {
      return view('widgets.buttonWidget');
    }

    public function reviewwidget($slug)
    {
      $userid = Auth::id();;
      $data=User::where( 'company_slug',$slug)->get();
        if($data->count()=='0')
        {
           return view('widgets.error-form');
        }
        else
        {
          $data12['slug']=User::where('company_slug',$slug,true)->first();
          $slug=User::where('company_slug',$slug,true)->first();
          $review_counts = 0;
          $data12['socialmedia']=Social::where('user_id', $slug->id)->where('active','yes')->get();
          foreach( $data12['socialmedia'] as $social_media ){
            if( $social_media->social_id != 3 ){
              $review_counts += Rating::where('customer_id', $userid)
                                          ->where('review_type', $social_media->social_id)->get()->count();;
            } else if ( $social_media->social_id == 3 ){
                $businessid = $social_media->page_id;
                if( $businessid && $businessid != 'N/A' && $businessid != 'NA'){
                  $token = $social_media->api;
                  $token = env('YELP_KEY');
                  $url='https://api.yelp.com/v3/businesses/'.$businessid.'/reviews';
                  $response=$this->curl($url, $token);
                  $responses = json_decode($response, true);
                  if(!isset($responses['error'])){
                      $review_counts += $responses['total'];
                  }
                }
            }
          }
          $data12['review_counts'] = $review_counts;
          $wheredata1=[['customer_id',$slug->id],['rating','>','3'],['active','0']];          
          //$data12['rating']=Rating::where($wheredata1)->orderBy('id', 'desc')->limit(8)->get();
          $data12['show_review']=User::where('id',$slug->id, true)->first();
          $data = Rating::where('customer_id', $userid)->where('review_type', '!=', 10)->get();
          $data12['ratings'] = Rating::sum('rating');
          //$data = Rating::where('customer_id', $userid)->get();
          $data = Rating::where('customer_id', $userid)->where('review_type', '!=', 10)->get();
          $data12['ratings'] = count($data);
          return view('user.reviewwidget' ,$data12);
        }
    }

    public function json($slug)
    {
      $user = User::where('company_slug', $slug, true)->first();
      $review_counts = 0;
      $socialmedia =Social::where('user_id', $user->id)->where('active','yes')->get();
      foreach( $socialmedia as $social_media ){
        if( $social_media->social_id != 3 ){
          $review_counts += Rating::where('customer_id', $user->id)
                                      ->where('review_type', $social_media->social_id)->get()->count();;
        } else if ( $social_media->social_id == 3 ){
            $token = env('YELP_KEY');
            $businessid = $social_media->page_id;
            if( $businessid && $businessid != 'N/A' && $businessid != 'NA'){
              $url='https://api.yelp.com/v3/businesses/'.$businessid.'/reviews';
              $response=$this->curl($url, $token);
              $responses = json_decode($response, true);
              if(!isset($responses['error'])){
                  $review_counts += $responses['total'];
              }
            }
        }
      }      
      return $review_counts;
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
