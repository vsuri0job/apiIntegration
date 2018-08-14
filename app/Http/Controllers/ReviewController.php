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
use Illuminate\Support\Facades\Redirect;
class ReviewController extends Controller
{
    /**
     * Method: index
     * Parameter: Null
     * Task:To display all settings.
    **/
    public function index($social=NULL)
    {
        if($social!=NULL)
        {
          if($social=='all')
          {
            $wheredata=[
                ['customer_id',Auth::user()->id],
               // ['comment','!=',''],
                ];
          }
          else
          {
            $wheredata=[
                ['customer_id',Auth::user()->id],
                //['comment','!=',''],
                ['review_type',$social]
                ];
          }
        }
        else
        {
           $wheredata=[
                  ['customer_id',Auth::user()->id],
                 //  ['comment','!=',''],
                  ];
        }
      $data['ratings']=Rating::where($wheredata)->where('review_type', '!=', 10)->orderBy('id','DESC')->get();
      $data['socilamedia']=Social::where('user_id',Auth::user()->id)->where('active','yes')->where('social_id', '!=', '10')->orderBy('social_id', 'DESC')->get();
      return view('review.index',$data);
    }
    /*
    *Method: customers
    *Parameter: Null
    *Task:To display all Customer.
    */
    public function customers()
    {
      $data['ratings']=Rating::where('review_type', 10)->where('customer_id', Auth::user()->id)->get();
      return view('review.customers',$data);
    }
     /*
    *Method: import
    *Parameter: Null
    *Task:To display Import Form
    */
    public function import()
    {
      return view('review.import');
    }
    
    /*
     * Method: importdata
     * Parameter: Null
     * Task:To  Import data
     */
    public function importdata(Request $request)
    { 
      $dt = new DateTime();
      $id=Auth::user()->id;
      $new_date= $dt->format('Y-m-d');
      if($request->hasFile('import_file'))
      {
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();
        $exist = array(); $inserted =0; $not_inserted=0;
        $data_count = $data->count();
        //die('sadas');
        if(!empty($data) && $data_count!=0){
          foreach ($data->toArray() as $key => $value) 
          {
            $ratings=Rating::where('email',$value['email'])->get();
            $count=$ratings->count();
              if($count=='0')
              {
                $insert['customer_id'] = $id;
                $insert['rating'] = $value['rating'];
                $insert['comment'] = $value['comment'];
                $insert['name'] = $value['name'];
                $insert['email'] = $value['email'];
                $insert['created'] =$new_date;
                $insert['contact'] = $value['contact'];
                Rating::create($insert);
                $inserted++;
              }
              else
              {
                array_push($exist, $value);
                $not_inserted++;
              }
          }
            $data['success'] = "Successfully added!!";
            $data['total'] = $data_count;
            $data['inserted'] = $inserted;
            $data['not_inserted'] = $not_inserted;
            $data['exists'] = $exist;
            return view('review.import',$data);
          }
          else
          {
            $data['error'] = "Blank File does not exist";
            return view('review.import',$data);
          }
      }
      else
      {
        $data['error'] = "Please Select a File";
        return view('review.import',$data);
      }
    }

    /*
    *Method: import
    *Parameter: Null
    *Task:To display Import Form
    */
    public function active($id)
    {
      // return view('review.import');
      $record = array('active'=>'1');
      $rating=Rating::where('id',$id)->update($record);
      return back()->with('success','Thank you for hide the review');
    }

     /*
    *Method: inactive
    *Parameter: Null
    *Task:To inactive bad review.
    */
    public function inactive($id)
    {
      //return view('review.import');
      $record = array('active'=>'0');
      $rating=Rating::where('id',$id)->update($record);
      return back()->with('success','Thank you for show the review');
    }

     /*
    *Method: reviews
    *Parameter: Null
    *Task:To show facebook review.
    */
    public function reviews($id)
    {
      $record=Social::where('social_id', 1, true)->where('user_id', Auth::user()->id)->first();
      try 
      {
        $fb = new \Facebook\Facebook([
          'app_id' => $record['api'],
          'app_secret' =>  $record['secret'],
        ]);
        $response = $fb->get(
          '/'.$record['page_id'].'?fields=ratings',$record['access_token']
        );
      } 
      catch(\Facebook\Exceptions\FacebookResponseException $e) 
      {
          //When Graph returns an error
          //echo 'Graph returned an error: ' . $e->getMessage();
          return Redirect::back()->withErrors([$e->getMessage(), 'The Message']);
          exit;
      } 
      catch(\Facebook\Exceptions\FacebookSDKException $e) 
      {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      $graphNode = $response->getGraphNode();
      $response=json_decode($response->getBody(), true);
      
      try
      { 
        foreach($response['ratings']['data'] as $rating) 
        {
          $url=Rating::where('review_type', 1)->where('user_url', $rating['reviewer']['id'])->where('customer_id', Auth::user()->id)->get()->count(); 
          if($url==0)
          {
            $rating=Rating::create([
              'customer_id'=>Auth::user()->id,
              'comment'=> (isset($rating['review_text'])) ? $rating['review_text'] : '',
              'rating'=> $rating['rating'],
              'name'=> $rating['reviewer']['name'],
              'user_url'=> $rating['reviewer']['id'],
              'email'=> '',
              'contact'=> '',
              'review_type'=>1, 
            ]);
             return redirect('manage_site')->with('success', 'Successfully Added');
          }
          else 
          {
            $msg="Feedback is already exists";
          }
        }
        return Redirect::back()->withErrors([$msg, 'The Message']);
      }   
      catch(\Exception $ex) 
      {
         return Redirect::back()->withErrors([$ex->getMessage(), 'The Message']);
      }
    }

     /*
    *Method: showreview
    *Parameter: Null
    *Task:To show data.
    */
    public function showreview(Request $request)
    {
        $data=$request->all();
        $user_id=Auth::user()->id;
        User::where('id',$user_id)->update(['show_review'=>$data['review_show']]);
        return back()->with('success','Your review has been hidden');
    }
    
     /*
    *Method: googlereview
    *Parameter: Null
    *Task:To show google review.
    */
    public function googlereview() 
    {
      $client=new Client;
      $google=Socialmedia::where('name', 'Google')->value('id');
      $user_id=Auth::user()->id;
      $socials=Social::where('social_id', $google, true)->where('user_id', $user_id, true)->first();
      $place_id=$socials->secret;
      $api=$socials->api;
      $response=$client->get('https://maps.googleapis.com/maps/api/place/details/json?placeid='.$place_id.'&key='.$api);
      $response=json_decode($response->getBody(), true);
      
      $insertrow=0; $exists=0;
      if($response['status']=="INVALID_REQUEST")
      {
       
        return Redirect::back()->withErrors(['Invalid Your API Key Or Place Id', 'The Message']);
      }
      else
      {
        try
        {
          $ratings=$response;
          $reviews=$ratings['result']['reviews'];
          
          foreach($ratings['result']['reviews'] as $rating) 
          {
            $url=Rating::where('review_type', $google)->where('user_url', $rating['author_url'])->where('customer_id', Auth::user()->id)->get()->count();
            if($url == 0) 
            {
              $rating= Rating::create([
                'customer_id'=>$user_id,
                'comment'=> $rating['text'],
                'rating'=> $rating['rating'],
                'name'=> $rating['author_name'],
                'user_url'=> $rating['author_url'],
                'email'=> '',
                'contact'=> '',
                'review_type'=>$google,
              ]);
              $insertrow++; 
              //$msg="Feedback added to the system";
            }
            else
            {
               $exists++;
            }
          }
            //return redirect('manage_site')->with('success', 'Successfully Feedback added to the system'); 
            return Redirect('manage_site')->with('success', 'Feedback Inserted Successfully (Summary:- '.$insertrow. ' New Feedback Inserted - '.$exists.' Feedback Already exists)' );
        }
        catch(\Exception $ex)
        {
          //return $ex->getMessage();

          if($insertrow==0)
          {
             return Redirect::back()->withErrors(['Already Exsits', 'The Message']);
          }
          else{
             return Redirect::back()->withErrors(['Invalid Your API Key Or Place Id', 'The Message']);
          }
         
        }
      }
    } 

    /*
    *Method: yelpreview
    *Parameter: Null
    *Task:To show yelp review.
    */
    public function yelpreview() 
    {
        $yelp=Socialmedia::where('name', 'yelp')->value('id');
        $token=Social::where('user_id', Auth::user()->id)->where('social_id',$yelp)->value('api');
        $socialurl = Social::where('user_id', Auth::user()->id, true)->where('social_id', $yelp)->value('secret');
        $url='https://api.yelp.com/v3/businesses/'.$socialurl.'/reviews';
        $response=$this->curl($url, $token);
        $responses = json_decode($response, true);
        if(isset($responses['error']))
        {
            if($responses['error']['code']=='BUSINESS_NOT_FOUND')
            {
                return Redirect::back()->withErrors(['Invalid Business Id', 'The Message']);
            }
            elseif($responses['error']['code']=='TOKEN_INVALID')
            {
               return Redirect::back()->withErrors(['Invalid API ID', 'The Message']);
            }
            elseif($responses['error']['code']=='TOKEN_MISSING')
            {
               return Redirect::back()->withErrors(['Invalid API ID', 'The Message']);
            }
        }
        else
        {
            if(isset($responses['reviews']))
            {
                $reviews=$responses['reviews'];
                //$totalrow=count($reviews);
                $insertrow=0; $exists=0;
                foreach($reviews as $rating) 
                {
                    $url=Rating::where('review_type', $yelp)->where('user_url', $rating['url'])->get()->count();
                   
                    if($url==0)
                    {
                        $rating=Rating::create([
                          'customer_id'=>Auth::user()->id,
                          'comment'=>$rating['text'],
                          'rating'=>$rating['rating'],
                          'name'=>$rating['user']['name'],
                          'user_url'=>$rating['url'],
                          'review_type'=>$yelp,
                          'created'=>'2017-11-01'
                        ]);
                        $insertrow++; 
                    }
                    else
                    {
                        $exists++;
                    }
                }
                return Redirect('manage_site')->with('success', 'Feedback Inserted Successfully (Summary:- '.$insertrow. ' New Feedback Inserted - '.$exists.' Feedback Already exists)' );
            }
        }
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
          return Redirect::back()->withErrors(['Invalid Your API Key Or Place Id', 'The Message']);
        } else {
          return $response;
        }
    }

  public function yelp_fusion_api( Request $request )
  {
    $data = array();

    if($user_id=Auth::user()->id ) {

      $api_key = 'Q1f28T05IN-H1tvDtQ-IMf4TMd2nsgZ4mN2e03EuUgO-5bQSqBxkXpb_uTPeA98FGq-3vmz0BoFTV3cz6oeh2GnCq9BiNk4nG83nX73wBCclVU2y1rQ1OqrczSUxW3Yx';
      $request_data = $request->all();

      $Socialmedia_id=Socialmedia::where('name', 'Yelp')->value('id');

      /* ##### Update Yelp here ##### */
      if ($request_data['action'] == 'edit')
      {

        $social_count=Social::where('social_id', $Socialmedia_id)->where('user_id', $user_id)->where('page_id', $request_data['yelp_business_id'])->where('socialurl', 'https://www.yelp.com/biz/'.$request_data['yelp_business_id'])->get()->count();
        
        if($social_count > 0)
        {
          $data['res_status'] = 'error';
          $data['res_message'] = "business already exists in database.";
        }
        else
        {
          
          /* YELP UPDATE HERE */
          $DB_ID = $request_data['DB_ID'];

          $data['res_data'] = $this->yelp_business_api($businesses_id = $request_data['yelp_business_id'], $api_key);

          //echo "<pre>"; print_r($data['res_data']); echo "<pre>";

          if ( isset($data['res_data']->error)) {
            # code...
            $res_message = $data['res_data']->error->description;
            $data['res_status'] = 'error';
            $data['res_message'] = "$res_message"; 
          }
          else
          {
            $social_count=Social::where('social_id', $Socialmedia_id)->where('user_id', $user_id)->where('page_id', $data['res_data']->alias)->where('socialurl', 'https://www.yelp.com/biz/'.$data['res_data']->alias)->get()->count();
        
            if($social_count==0)
            {
                $rating_record = array( 
                  'yelp_business_id'   => $data['res_data']->alias
                  ); 
                $record_id=Social::where('id', $DB_ID, true)->first();
                $rating_update=Rating::where('yelp_business_id', $record_id['page_id'])->update($rating_record);


                $social_record = array( 
                  'pagename'    => $data['res_data']->name,
                  'socialurl'   => 'https://www.yelp.com/biz/'.$data['res_data']->alias,
                  'social_page_review_url'  => 'https://www.yelp.com/writeareview/biz/'.$data['res_data']->id,
                  'url'   => $data['res_data']->alias,
                  'page_id'   => $data['res_data']->alias );

                $social_update=Social::where('id', $DB_ID)->update($social_record);

                $businesses = Social::where('social_id', $Socialmedia_id)->where('user_id', $user_id)->orderBy('id','DESC')->get();

                if (!empty($businesses)) {

                  # code...
                  $data['res_yelp_businesses'] = '';
                  $page_count = 0;

                  foreach ($businesses as $business) {

                    $rating_html = '';

                    if ($page_count == 0)
                    {
                      $_in = 'in';
                      $_status = 'true';
                    }
                    else
                    {
                      $_in = '';
                      $_status = 'false'; 
                    } 

                    # code...
                    $business_page_id = $business['page_id'];
                    $business_id = $business['id'];
                    $business_name = $business['pagename'];
                    $business_user_url = $business['social_page_review_url'];

                    $ratings = Rating::where('customer_id', $user_id)->where('review_type', $Socialmedia_id)->where('yelp_business_id', $business_page_id)->orderBy('id','DESC')->get();

                    //dd($ratings);

                    if (  count($ratings) > 0 ) {
                      # code...

                      foreach ($ratings as $rating) {
                        # code...

                        $star_rating = $rating['rating'];
                        $rating_text = $rating['comment'];
                        $reviewer_name = $rating['name'];

                        $rating_html = $rating_html.'<div class="media align-items-stretch reviews-cards mt-1">
                            <div class="bg-warning p-2 media-middle pull-left col-sm-1">
                                <i class="icon-speech font-large-1 white"></i>
                            </div>
                            
                            <div class="media-body pull-left col-sm-10">
                                <h4 class="reviewer">Reviewer: '.$reviewer_name.'</h4>
                                <p>'.$rating_text.'</p>
                            </div>
                            <div class="media-right p-1 media-middle pull-right col-sm-1">
                              <h4 class="social-rating danger">'.$star_rating.'*</h4>
                            </div>
                          </div>';
                      }
                    } 
                    else 
                    {
                      $rating_html = '<div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                            <strong>No Reviews!</strong> There no reviews fetched for this business.
                          </div>';
                    }

                    $data['res_yelp_businesses'] = $data['res_yelp_businesses'].'<div class="p-0-30">
                    <div id="heading_yelp_'.$business_id.'" class="card-header">
                      
                      <a data-toggle="collapse" href="#accordion_yelp_'.$business_id.'" aria-expanded="'.$_status.'" aria-controls="accordion_yelp_'.$business_id.'" class="card-title lead collapsed">
                        <i class="fa fa-facebook-square white font-medium-5"></i>&nbsp;&nbsp;'.$business_name.'
                      </a>
                      
                      <a  item-id ="'.$business_page_id.'" class="btn btn-social btn-xs pull-right get_yelp_reviews"><span class="fa fa-home"></span> Fetch the page reviews/businesses
                      </a>
                    </div>
                        
                    <div id="accordion_yelp_'.$business_id.'" role="tabpanel" aria-labelledby="heading_yelp_'.$business_id.'" class="collapse '.$_in.'" aria-expanded="'.$_status.'">
                      <div class="card-content">
                        <div class="card-body p-0-25 reviews-cards-container" id="'.$business_page_id.'">'.$rating_html.'</div>
                      </div>
                    </div>
                    </div>';

                    $page_count++;

                  }
                }

                $data['res_status'] = 'success';
                $data['res_message'] = "Yelp business page updated successfully!"; 
            }
            else
            {
              $data['res_status'] = 'warning';
              $data['res_message'] = 'The Yelp business page already exists in the database!';
            }

            /* /YELP UPDATE HERE */
          }
        }
      }

      else if ($request_data['yelp_api'] == 'businesses')
      {        
        $data['res_data'] = $this->yelp_business_api($businesses_id = $request_data['yelp_business_id'], $api_key);

        //echo "<pre>"; print_r($data['res_data']); echo "<pre>";

        if ( isset($data['res_data']->error)) {
          # code...
          $res_message = $data['res_data']->error->description;
          $data['res_status'] = 'error';
          $data['res_message'] = "$res_message"; 
        }
        else
        {
          $social_count=Social::where('social_id', $Socialmedia_id)->where('user_id', $user_id)->where('page_id', $data['res_data']->alias)->where('socialurl', 'https://www.yelp.com/biz/'.$data['res_data']->alias)->get()->count();
        
          if($social_count==0)
          {
              $rating=Social::create([
                'social_id'   => $Socialmedia_id,
                'user_id'     => Auth::user()->id,
                'pagename'    => $data['res_data']->name,
                'socialurl'   => 'https://www.yelp.com/biz/'.$data['res_data']->alias,
                'social_page_review_url'  => 'https://www.yelp.com/writeareview/biz/'.$data['res_data']->id,
                'url'   => $data['res_data']->alias,
                'api'   => 'NA',
                'secret'    => 'NA',
                'page_id'   => $data['res_data']->alias,
                'access_token'   => 'NA',
              ]);

              $businesses = Social::where('social_id', $Socialmedia_id)->where('user_id', $user_id)->orderBy('id','DESC')->get();

              if (!empty($businesses)) {

                # code...
                $data['res_yelp_businesses'] = '';
                $page_count = 0;

                foreach ($businesses as $business) {

                  $rating_html = '';

                  if ($page_count == 0)
                  {
                    $_in = 'in';
                    $_status = 'true';
                  }
                  else
                  {
                    $_in = '';
                    $_status = 'false'; 
                  } 

                  # code...
                  $business_page_id = $business['page_id'];
                  $business_id = $business['id'];
                  $business_name = $business['pagename'];
                  $business_user_url = $business['social_page_review_url'];

                  $ratings = Rating::where('customer_id', $user_id)->where('review_type', $Socialmedia_id)->where('user_url', $business_user_url)->orderBy('id','DESC')->get();

                  //dd($ratings);

                  if (  count($ratings) > 0 ) {
                    # code...

                    foreach ($ratings as $rating) {
                      # code...

                      $star_rating = $rating['rating'];
                      $rating_text = $rating['comment'];
                      $reviewer_name = $rating['name'];

                      $rating_html = $rating_html.'<div class="media align-items-stretch reviews-cards mt-1">
                          <div class="bg-warning p-2 media-middle pull-left col-sm-1">
                              <i class="icon-speech font-large-1 white"></i>
                          </div>
                          
                          <div class="media-body pull-left col-sm-10">
                              <h4 class="reviewer">Reviewer: '.$reviewer_name.'</h4>
                              <p>'.$rating_text.'</p>
                          </div>
                          <div class="media-right p-1 media-middle pull-right col-sm-1">
                            <h4 class="social-rating danger">'.$star_rating.'*</h4>
                          </div>
                        </div>';
                    }
                  } 
                  else 
                  {
                    $rating_html = '<div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                          <strong>No Reviews!</strong> There no reviews fetched for this business.
                        </div>';
                  }

                  $data['res_yelp_businesses'] = $data['res_yelp_businesses'].'<div class="p-0-30">
                  <div id="heading_yelp_'.$business_id.'" class="card-header">
                    
                    <a data-toggle="collapse" href="#accordion_yelp_'.$business_id.'" aria-expanded="'.$_status.'" aria-controls="accordion_yelp_'.$business_id.'" class="card-title lead collapsed">
                      <i class="fa fa-facebook-square white font-medium-5"></i>&nbsp;&nbsp;'.$business_name.'
                    </a>
                    
                    <a  item-id ="'.$business_page_id.'" class="btn btn-social btn-xs pull-right get_yelp_reviews"><span class="fa fa-home"></span> Fetch the page reviews/businesses
                    </a>
                  </div>
                      
                  <div id="accordion_yelp_'.$business_id.'" role="tabpanel" aria-labelledby="heading_yelp_'.$business_id.'" class="collapse '.$_in.'" aria-expanded="'.$_status.'">
                    <div class="card-content">
                      <div class="card-body p-0-25 reviews-cards-container" id="'.$business_page_id.'">'.$rating_html.'</div>
                    </div>
                  </div>
                  </div>';

                  $page_count++;

                }
              }

              $data['res_status'] = 'success';
              $data['res_message'] = 'The Yelp business page connected successfully!'; 
          }
          else
          {
            $data['res_status'] = 'warning';
            $data['res_message'] = 'The Yelp business page already exists in the database!';
          }
        }
      }
      else if ($request_data['yelp_api'] == 'reviews')
      {
        $businesses_id = $request_data['yelp_business_id'];

        $data['res_data'] = $this->yelp_reviews_api($businesses_id = $request_data['yelp_business_id'], $api_key);

        if ( isset($data['res_data']->error)) {
          # code...
          $res_message = $data['res_data']->error->description;
          $data['res_status'] = 'error';
          $data['res_message'] = "$res_message"; 
        }
        else
        {
          
          $business_reviews =  $data['res_data']->reviews;          
          $total_business_reviews =  $data['res_data']->total;
          //echo "<pre>"; print_r($business_reviews); dd();

          if ($total_business_reviews != 0) 
          { 
            $inserted = 0;

            foreach ($business_reviews as $business_review) 
            {
              $review_count=Rating::where('review_type', $Socialmedia_id)->where('customer_id', $user_id)->where('user_url', $business_review->url)->get()->count();
            
                if($review_count==0)
                {
                  //echo $businesses_id;
                    $cdate = explode(' ', $business_review->time_created);
                    $rating=Rating::create([
                      'customer_id'   => Auth::user()->id,
                      'yelp_business_id'  => "$businesses_id",
                      'rating'        => $business_review->rating,
                      'comment'       => $business_review->text,
                      'name'          => $business_review->user->name,
                      'review_type'   => $Socialmedia_id,
                      'user_url'      => $business_review->url,
                      'created'       => current($cdate)
                    ]);

                    if ($rating) {
                      # code...
                      $inserted++;
                    }
                }
            }

          }

          $my_ratings = Rating::where('customer_id', $user_id)->where('review_type', $Socialmedia_id)->where('yelp_business_id', $businesses_id)->orderBy('id','DESC')->get();

          //dd($ratings);

          if (  count($my_ratings) > 0 ) {
            # code...

            $data['res_yelp_reviews'] = '';

            foreach ($my_ratings as $my_rating) {

              $data['res_yelp_reviews'] = $data['res_yelp_reviews'].'<div class="media align-items-stretch reviews-cards mt-1">
                  <div class="bg-warning p-2 media-middle pull-left col-sm-1">
                      <i class="icon-speech font-large-1 white"></i>
                  </div>
                  
                  <div class="media-body pull-left col-sm-10">
                      <h4 class="reviewer">Reviewer: '.$my_rating->name.'</h4>
                      <p>'.$my_rating->comment.'</p>
                  </div>
                  <div class="media-right p-1 media-middle pull-right col-sm-1">
                    <h4 class="social-rating danger">'.$my_rating->rating.'*</h4>
                  </div>
                </div>';
            }

          } else {  

            $data['res_yelp_reviews'] = '<div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                      <strong>No Reviews!</strong> There no reviews fetched for this page.
                    </div>';

          }       

          $data['res_status'] = 'success';
          $data['res_message'] = "New reviews inserted = $inserted";
        }
      }
      else
      {
        $data['res_status'] = 'warning';
        $data['res_message'] = 'Invalid API call!';
      }
    } 
    else
    {
      $data['res_status'] = 'warning';
      $data['res_message'] = 'Please login to access this API!';
    }

    echo json_encode($data);
  }

  /*
  |--------------------------------------------------------------------------
  | Yelp - API's
  |--------------------------------------------------------------------------
  |
  | function yelp_business_api( $api, $api_key)
  | 
  | $api = north-india-restaurant-san-francisco
  | $api_key = 
  |
  */
  public function yelp_business_api($businesses_id = 'north-india-restaurant-san-francisco', $api_key = 'Q1f28T05IN-H1tvDtQ-IMf4TMd2nsgZ4mN2e03EuUgO-5bQSqBxkXpb_uTPeA98FGq-3vmz0BoFTV3cz6oeh2GnCq9BiNk4nG83nX73wBCclVU2y1rQ1OqrczSUxW3Yx')
  {
    
    $yelp_api_url = 'https://api.yelp.com/v3/businesses/'.$businesses_id;

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $yelp_api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: Bearer ".$api_key
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      
      dd($err);
    
    } else {

      return json_decode($response); dd();
    }
  }

  public function yelp_reviews_api($businesses_id, $api_key)
  {
    
    $yelp_api_url = 'https://api.yelp.com/v3/businesses/'.$businesses_id.'/reviews';

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $yelp_api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: Bearer ".$api_key
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      
      dd($err);
    
    } else {

      return json_decode($response); dd();
    }
  }
  
}
