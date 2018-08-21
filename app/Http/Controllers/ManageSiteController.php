<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Settings;
use App\Review;
use App\Company;
use App\Social;
use App\Rating;
use App\Socialmedia;
use Illuminate\Support\Facades\Input;
use Google_Client;
use Google_Service;
use Google_Service_MyBusiness;
use Google_Service_MyBusiness_ListAccountsResponse;

class ManageSiteController extends Controller
{
    /**
     * Method: index
     * Parameter: Null
     * Task:To display all companies.
    **/
    private function getGoogleClient(){
        $scopes = array();
        $scopes[] = "https://www.googleapis.com/auth/plus.business.manage";
        $redirect_uri = route('verify_google');        
        $client = new Google_Client();
        $client->setApplicationName("Analytics Report");
        $client->setAccessType("offline");
        $client->setApprovalPrompt("force");
        $client->setClientId( "455306179471-57g8mnief9065t2kd2gdbd3v8sd0j2n4.apps.googleusercontent.com" );
        $client->setClientSecret( "OiyKGU_gPn8TR7zOl1o399CM" );
        $client->setRedirectUri($redirect_uri);
        $client->addScope( $scopes );
        return $client;
    }

    public function mTest()
    {

        $user_id=Auth::user()->id;

        $data['social']=Social::where('user_id',$user_id)->get();

        $data['social_fb']=Social::where('user_id',$user_id)->where('social_id', '1')->where('active', 'yes')->get();
        $data['social_google']=Social::where('user_id',$user_id)->where('social_id', '2')->where('active', 'yes')->get();
        $data['social_home_advisor']=Social::where('user_id',$user_id)->where('social_id', '7')->where('active', 'yes')->get();
        $data['social_yelp']=Social::where('user_id',$user_id)->where('social_id', '3')->where('active', 'yes')->get();
        $data['social_review_champ']=Social::where('user_id',$user_id)->where('social_id', '10')->where('active', 'yes')->get();
        $data['social_google_pcount']=Rating::where('customer_id',$user_id)->where('review_type', '2')->get();        
        //dd($data['social_fb']);
        $data['hasGoogleToken'] = Auth::user()->google_access_token ? true: false;
        $data['include_js'] = 'custom';
        $data['include_css'] = 'custom';

        return view('manage_site.mTest',$data);
    } 

    public function login_google(){
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl();        
        return redirect($authUrl);
        exit;
    }

    public function verify_google(Request $request){
        $ret_code = $request->code;
        if( $ret_code ){
            $client = $this->getGoogleClient();
            $authentication = $client->authenticate($ret_code);
            $access_token = $client->getAccessToken();
            $refresh_token = $client->getRefreshToken();
            if( $access_token ){
                $opt = array();
                $opt[ 'google_access_token' ] = json_encode($access_token);
                $opt[ 'google_refresh_token' ] = $refresh_token;
                $user_id=Auth::user()->id;
                User::where('id', $user_id)                      
                      ->update($opt);
                return redirect( 'manage/connect-social-pages' );
                exit;
            }
        }
        redirect('/');
        exit;
    }

    public function google_business_list(){
        $access_token = Auth::user()->google_access_token;
        $refresh_token = Auth::user()->google_refresh_token;
        $client = $this->getGoogleClient();
        $client->setAccessToken($access_token);
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken( $refresh_token );
            $access_token = $client->getAccessToken();
            $opt = array();
            $opt[ 'google_access_token' ] = json_encode($access_token);
            $user_id=Auth::user()->id;
            User::where('id', $user_id)
                  ->update($opt);
        }
        $service = new Google_Service_MyBusiness($client);
        $gList = $service->accounts->listAccounts();        
        $gAList = $gList->accounts;
        $gADataBPages = array();
        $gADataBPagesLocations = array();
        foreach ($gAList as $key => $value) {
            $gADataBPages[ $value->name ] = $value->accountName;
            $locations = $service->accounts_locations->listAccountsLocations( $value->name );
            dd( $locations );
            $gADataBPagesLocations[ $value->name ] = array();
            foreach( $locations->locations as $lk => $lData ){
                $gADataBPagesLocations[ $value->name ][ $lData->name ] = $lData->locationName;                
            }
        }
        $out = array();
        $out[ 'bPages' ] = $gADataBPages;
        $out[ 'pagesLocation' ] = $gADataBPagesLocations;
        echo json_encode($out);
        exit;
    }

    public function add_google_location( Request $request )
    {
        $user_id=Auth::user()->id;
        $res_data = array();
        $res_data['res_validation_error'] = 0;
        $data=$request->all();

        $messages = [
            'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
            'without_spaces_api_id' => 'Can not use API ID without space',
        ];

        $validation=Validator::make($data, [
            'pagename'=>'string|max:255',
            'socialurl'=>'string|max:255',
            'social_page_review_url'=>'string|max:255'
        ],$messages);

        if($validation->fails())
        {
            $res_data['res_validation_error'] = 1;
            $res_data['res_message'] = $validation->messages();
            $res_data['res_status'] = 'error';
        }
        else
        {

                # code...
                $social_count = Social::where('user_id', $user_id)->where('social_id', 2)->first();

                //dd($social_count);

                if ( !$social_count ) {
                    $pagename = trim($data['gbpagename']);
                    $socialurl = trim($data['business-name']);
                    $access_token = Auth::user()->google_access_token;
                    $refresh_token = Auth::user()->google_refresh_token;
                    $client = $this->getGoogleClient();
                    $client->setAccessToken($access_token);
                    if ($client->isAccessTokenExpired()) {
                        $client->fetchAccessTokenWithRefreshToken( $refresh_token );
                        $access_token = $client->getAccessToken();
                        $opt = array();
                        $opt[ 'google_access_token' ] = json_encode($access_token);
                        $user_id=Auth::user()->id;
                        User::where('id', $user_id)
                              ->update($opt);
                    }
                    $service = new Google_Service_MyBusiness($client);
                    $gList = $service->accounts->get( $socialurl );
                    echo json_encode( $gList );
                    exit;
                    # code...
                    $social_page_review_url = trim($data['business-name-location']);                    
                    $social_create = Social::create([
                                'social_id' => '2',
                                'user_id'   => $user_id,
                                'pagename'  => $pagename,
                                'socialurl' => $socialurl,
                                'social_page_review_url' => $social_page_review_url, //addd
                                'url'       => $socialurl,
                                'page_id'       => rand(1, 1000000)
                    ]);
                    if( $social_page_review_url ){                        
                        $this->fetchGoogleLocationReviews( $social_page_review_url );
                    }
                }                
        }

        return redirect( 'manage/connect-social-pages' );
        exit;
        // echo json_encode($res_data);
    }

    public function fetchGoogleLocationReviews( $locationId ){
        $ratingStack = array();
        $ratingStack[ 'ONE' ] = 1;
        $ratingStack[ 'TWO' ] = 2;
        $ratingStack[ 'THREE' ] = 3;
        $ratingStack[ 'FOUR' ] = 4;
        $ratingStack[ 'FIVE' ] = 5;
        $ratingStack[ 'STAR_RATING_UNSPECIFIED' ] = null;
        
        $access_token = Auth::user()->google_access_token;
        $refresh_token = Auth::user()->google_refresh_token;
        $client = $this->getGoogleClient();
        $client->setAccessToken($access_token);
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken( $refresh_token );
            $access_token = $client->getAccessToken();
            $opt = array();
            $opt[ 'google_access_token' ] = json_encode($access_token);
            $user_id=Auth::user()->id;
            User::where('id', $user_id)
                  ->update($opt);
        }
        $service = new Google_Service_MyBusiness($client);
        $reviews = $service->accounts_locations_reviews->listAccountsLocationsReviews( $locationId );        
        $ttlReviews = $reviews->totalReviewCount;
        $fetchedReviewsCount = count( $reviews->reviews );
        $insertReviewsStack = array();
        $nPageToken = isset( $reviews->nextPageToken ) ? $reviews->nextPageToken : false;
        do {
            foreach ($reviews->reviews as $rKey => $rData) {
                $reviewRating = $rData->starRating;
                if( isset( $ratingStack[ $rData->starRating ] )  ){
                    $reviewRating = $ratingStack[ $rData->starRating ];
                }
                $auth_name = '';
                if( isset( $rData->reviewer->displayName ) ){
                    $auth_name = $rData->reviewer->displayName;
                }
                $cdate = date('Y-m-d', strtotime( $rData->createTime ));                
                $data = [
                  'customer_id' => Auth::user()->id,
                  'comment' => $rData->comment,
                  'rating' => $reviewRating,
                  'name' => $auth_name,
                  'user_url' => $rData->reviewId,
                  'email' => '',
                  'contact' => '',
                  'created'=>$cdate,
                  'updated'=>$rData->updateTime,
                  'review_type'=>2,
                ];                
                $rating = Rating::create( $data );
            }
            if($nPageToken){
                $reviews = $service->accounts_locations_reviews->listAccountsLocationsReviews( $locationId, array( 'pageToken' => $nPageToken ));
                $nPageToken = isset( $reviews->nextPageToken ) ? $reviews->nextPageToken : false;
                $fetchedReviewsCount += count( $reviews->reviews );
            }
        } while ($fetchedReviewsCount < $ttlReviews);
    }

    /*
    *Method: index
    *Parameter: Null
    *Task:To display all companies.
    */
    public function index()
    {
        $user_id=Auth::user()->id;
        $data['social']=Social::where('user_id',$user_id)->get();
        return view('manage_site.index',$data);
    } 

    /*
    *Method: add
    *Parameter: Null
    *Task:To display Add Company Form
    */
    public function add()
    {
        $data['socialmedia']=Socialmedia::all();
        return view('manage_site.add',$data);
    }

    /*
    *Method: add
    *Parameter: Null
    *Task:To display Add Company Form
    */
    public function add_social_page()
    {
        
        $data['include_js'] = 'custom';        
        $data['include_css'] = 'custom';  

        $data['socialmedia']=Socialmedia::all();
        return view('manage_site.add_social_page',$data);
    }

    /*
    *Method: add
    *Parameter: Null
    *Task:To create Company deatil
    */

    public function create(Request $request)
    {
        $data=$request->all();
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        Validator::extend('without_spaces_api_id', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $messages = [
        'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
        'without_spaces_api_id' => 'Can not use API ID without space',
        ];
        $userid=Auth::user()->id;
        $validation=Validator::make($data, [
            'social_id'=>'required|string|max:255',
            'pagename'=>'required|string|max:255',
            'socialurl'=>'required|string|max:255',
            'api'=>'required|without_spaces_api_id|string|max:255',
            'secret'=> 'required|without_spaces|string|max:255',
            'socialpage_reviewurl' => 'required|string|max:255', // addd
            'page_id'=>'required|string|max:255',
            'access_token'=>'required|string|max:255',

            // 'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
         ],$messages);
       if($validation->fails())
        {
            return redirect('manage_site/add')->withErrors($validation)->withInput();
        }
        else
        {
           $company= Social::create([
                'social_id'=>$data['social_id'],
                'user_id'=>$userid,
                'pagename'=>$data['pagename'],
                'socialurl'=>$data['socialurl'],
                'social_page_review_url'=>$data['socialpage_reviewurl'], //addd
                //'url' => $data['secret'],  //place id
                'secret'=>$data['secret'],
                'api'=>$data['api'],
                'page_id'=>$data['page_id'],
                'access_token'=>$data['access_token'],
            ]);
            return redirect('manage_site')->with('success', 'Successfully Added');
        }
       // return view('manage_site.add');
    }

    public function create_social_page(Request $request)
    {
        $data=$request->all();

        //dd($data);

        /*Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        Validator::extend('without_spaces_api_id', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $messages = [
        'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
        'without_spaces_api_id' => 'Can not use API ID without space',
        ];*/

        $userid=Auth::user()->id;
        
        /*$validation=Validator::make($data, [
            'social_id'=>'required|string|max:255',
            'pagename'=>'required|string|max:255',
            'socialurl'=>'required|string|max:255',
            'api'=>'required|without_spaces_api_id|string|max:255',
            'secret'=> 'required|without_spaces|string|max:255',
            'socialpage_reviewurl' => 'required|string|max:255', // addd
            'page_id'=>'required|string|max:255',
            'access_token'=>'required|string|max:255',

            // 'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],$messages);*/

        /*if($validation->fails())
        {
            dd($validation->messages()->all());
            return redirect('manage_site/add_social_page')->withErrors($validation)->withInput();
        }
        else
        {
            dd('here');*/

            /* CHECK AND INSERT PAGE HERE */

            if ( !empty($data['_data']) ) {
                # code...
                foreach ($data['_data'] as $_data) {
                    # code...

                    $social_id = 1;
                    $user_id = $userid;
                    $pagename = $_data['name'];
                    $socialurl = 'https://www.facebook.com/'.$_data['id'];
                    $social_page_review_url = 'https://www.facebook.com/'.$_data['id'].'/reviews';
                    $url = 'https://www.facebook.com/'.$_data['id'].'/reviews';
                    $api = '#NA';
                    $secret = '#NA';
                    $page_id = $_data['id'];
                    $access_token = $_data['access_token'];

                    $data['social'] = Social::where('page_id', "$page_id")->first();

                    if ( empty($data['social']) ) {
                        # code...
                        $company= Social::create([
                            'social_id' => $social_id,
                            'user_id'   => $user_id,
                            'pagename'  => $pagename,
                            'socialurl' => $socialurl,
                            'social_page_review_url' => $social_page_review_url, //addd
                            'url'       => $url,  //place id
                            'secret'    => $secret,
                            'api'       => $api,
                            'page_id'   => $page_id,
                            'access_token' => $access_token,
                        ]);
                    }
                }
            }
            /* /CHECK AND INSERT PAGE HERE */

           /*$company= Social::create([
                'social_id'=>$data['social_id'],
                'user_id'=>$userid,
                'pagename'=>$data['pagename'],
                'socialurl'=>$data['socialurl'],
                'social_page_review_url'=>$data['socialpage_reviewurl'], //addd
                //'url' => $data['secret'],  //place id
                'secret'=>$data['secret'],
                'api'=>$data['api'],
                'page_id'=>$data['page_id'],
                'access_token'=>$data['access_token'],
            ]);*/
            
            //return redirect('manage_site')->with('success', 'Successfully Added');

        //}
       // return view('manage_site.add');
    }

    /*
    *Method: edit
    *Parameter: Company id ($id)
    *Task:To display Edit Company Form
    */
    public function edit($id)
    {
        $data['social']=Social::where('id',$id)->first();
        $data['socialmedia']=Socialmedia::all();
        return view('manage_site.edit', $data);
    } 

    /*
    *Method: update
    *Parameter: Request ($request), comapny Id ($id)
    *Task:To update  Company deatil
    */
    public function update (Request $request,$id)
    {
        $data=$request->all();
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        Validator::extend('without_spaces_api_id', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        $messages = [
        'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
        'without_spaces_api_id' => 'Can not use API ID without space',
        ];
        //$userid=Auth::user()->id;
        $validation=Validator::make($data, [
            'social_id' => 'required|string|max:255',
            'pagename' => 'required|string|max:255',
            'socialurl' => 'required|string|max:255',
            'socialpage_reviewurl' => 'required|string',
            //'url' =>  'required|string|max:255',
            'api' =>  'required|without_spaces_api_id|string|max:255',
            'secret'=> 'required|without_spaces|string|max:255',
            'page_id'=>'required|string|max:255',
            'access_token'=>'required|string|max:255',
        ],$messages);
        if($validation->fails())
        {
            return redirect('manage_site/edit/'.$id)->withErrors($validation)->withInput();
        }
        else
        {
            $record = array('social_id' => $data['social_id'],
                        'pagename' => $data['pagename'],
                        'socialurl' => $data['socialurl'],
                        'social_page_review_url' => $data['socialpage_reviewurl'],
                        //'url' => $data['secret'],
                        'secret' => $data['secret'],
                        'api' => $data['api'],
                        'page_id'=>$data['page_id'],
                        'access_token'=>$data['access_token'],
            );
            $company=Social::where('id',$id)->update($record);
            return redirect('manage_site')->with('success', 'Successfully Updated');
        }
    } 

    /*
    *Method: delete
    *Parameter: Company id ($id)
    *Task:To delete Company deatil
    */
    public function delete($id)
    {
        $social=Social::where('id',$id)->delete();
        return redirect('manage_site')->with('success', 'Successfully Deleted');
    }

    /*
    *Method: facebook
    *Parameter:Null
    *Task:To Display manage facebook site
    */
    public function facebook()
    {
        $data['social']=Social::where('name','facebook',true)->first();
       return view('manage_site.facebook',$data);
    }

     /*
    *Method: facebook
    *Parameter:Null
    *Task:To Display manage facebook site
    */
    public function show($id)
    {
       $data['social']=Social::where('id',$id,true)->first();
       return view('manage_site.show',$data);
    }

     /*
    *Method: active
    *Parameter:Social id ($id)
    *Task:To active social account
    */
    public function active($id)
    {
        $record = array('active'=>'no');
        $rating=Social::where('id',$id)->update($record);
        return back()->with('success','Thank you for deactivate account');
    }

    /*
    *Method: inactive
    *Parameter:Social id ($id)
    *Task:To inactive social account
    */
    public function inactive($id)
    {
        $record = array('active'=>'yes');
        $rating=Social::where('id',$id)->update($record);
        return back()->with('success','Thank you for active account');
    } 

    public function add_facebook_page( Request $request )
    {
        $user_id=Auth::user()->id;
        $res_data = array();
        $res_data['res_validation_error'] = 0;
        $data=$request->all();

        $messages = [
        'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
        'without_spaces_api_id' => 'Can not use API ID without space',
        ];

        $validation=Validator::make($data, [
            'pagename'=>'required|string|max:255',
            'socialurl'=>'required|string|max:255',
            'social_page_review_url'=>'required|string|max:255'
        ],$messages);

        if($validation->fails())
        {
            $res_data['res_validation_error'] = 1;
            $res_data['res_message'] = $validation->messages();
            $res_data['res_status'] = 'error';
        }
        else
        {
            //dd($data);

            if ($data['action'] == 'add' ) {
                # code...
                $social_count = Social::where('user_id', $user_id)->where('social_id', 1)->first();

                //dd($social_count);

                if ( !$social_count ) {
                    # code...

                    $pagename = trim($data['pagename']);

                    $socialurl = trim($data['socialurl']);
                    $socialurl = rtrim($socialurl, '/');

                    $social_page_review_url = trim($data['social_page_review_url']);
                    $social_page_review_url = rtrim($social_page_review_url, '/');
                    
                    $social_create = Social::create([
                                'social_id' => '1',
                                'user_id'   => $user_id,
                                'pagename'  => $pagename,
                                'socialurl' => $socialurl,
                                'social_page_review_url' => $social_page_review_url, //addd
                                'url'       => $socialurl,
                                'page_id'       => rand(1, 1000000)
                    ]);

                    if ($social_create) {
                        # code...
                        $res_data['res_message'] = 'Facebook page created successfully.';
                        $res_data['res_status'] = 'success';
                    } 
                    else
                    {
                        $res_data['res_message'] = 'There is some error on creating facebook page.';
                        $res_data['res_status'] = 'error';
                    }
                }
                else
                {
                    $res_data['res_message'] = 'You already have a facebook page in your DB.';
                    $res_data['res_status'] = 'error';
                }
            }
            else if ($data['action'] == 'edit')
            {
                $pagename = trim($data['pagename']);

                $socialurl = trim($data['socialurl']);
                $socialurl = rtrim($socialurl, '/');

                $social_page_review_url = trim($data['social_page_review_url']);
                $social_page_review_url = rtrim($social_page_review_url, '/');
                
                $update_record = array(
                    'pagename'  => $pagename,
                    'socialurl' => $socialurl,
                    'social_page_review_url' => $social_page_review_url, //addd
                    'url'       => $socialurl
                );

                if (Social::where('id', $data['DB_ID'])->where( 'user_id', $user_id)->update($update_record)) {
                    # code...
                    $res_data['res_message'] = 'Facebook page updated successfully.';
                    $res_data['res_status'] = 'success';
                } 
                else
                {
                    $res_data['res_message'] = 'There is some error on updating facebook page.';
                    $res_data['res_status'] = 'error';
                }
            }
        }

        echo json_encode($res_data);
    }

    public function add_google_page( Request $request )
    {
        $user_id=Auth::user()->id;
        $res_data = array();
        $res_data['res_validation_error'] = 0;
        $data=$request->all();

        $messages = [
        'without_spaces' => 'Can not use Place ID/Business Key/Secret Key without space',
        'without_spaces_api_id' => 'Can not use API ID without space',
        ];

        $validation=Validator::make($data, [
            'pagename'=>'required|string|max:255',
            'socialurl'=>'required|string|max:255',
            'social_page_review_url'=>'required|string|max:255'
        ],$messages);

        if($validation->fails())
        {
            $res_data['res_validation_error'] = 1;
            $res_data['res_message'] = $validation->messages();
            $res_data['res_status'] = 'error';
        }
        else
        {
            //dd($data);

            if ($data['action'] == 'add' ) {
                # code...
                $social_count = Social::where('user_id', $user_id)->where('social_id', 2)->first();

                //dd($social_count);

                if ( !$social_count ) {
                    # code...

                    $pagename = trim($data['pagename']);

                    $socialurl = trim($data['socialurl']);
                    $socialurl = rtrim($socialurl, '/');

                    $social_page_review_url = trim($data['social_page_review_url']);
                    $social_page_review_url = rtrim($social_page_review_url, '/');
                    
                    $social_create = Social::create([
                                'social_id' => '2',
                                'user_id'   => $user_id,
                                'pagename'  => $pagename,
                                'socialurl' => $socialurl,
                                'social_page_review_url' => $social_page_review_url, //addd
                                'url'       => $socialurl,
                                'page_id'       => rand(1, 1000000)
                    ]);

                    if ($social_create) {
                        # code...
                        $res_data['res_message'] = 'Google page created successfully.';
                        $res_data['res_status'] = 'success';
                    } 
                    else
                    {
                        $res_data['res_message'] = 'There is some error on creating Google page.';
                        $res_data['res_status'] = 'error';
                    }
                }
                else
                {
                    $res_data['res_message'] = 'You already have a Google page in your DB.';
                    $res_data['res_status'] = 'error';
                }
            }
            else if ($data['action'] == 'edit')
            {
                $pagename = trim($data['pagename']);

                $socialurl = trim($data['socialurl']);
                $socialurl = rtrim($socialurl, '/');

                $social_page_review_url = trim($data['social_page_review_url']);
                $social_page_review_url = rtrim($social_page_review_url, '/');
                
                $update_record = array(
                    'pagename'  => $pagename,
                    'socialurl' => $socialurl,
                    'social_page_review_url' => $social_page_review_url, //addd
                    'url'       => $socialurl
                );

                if (Social::where('id', $data['DB_ID'])->where( 'user_id', $user_id)->update($update_record)) {
                    # code...
                    $res_data['res_message'] = 'Google page updated successfully.';
                    $res_data['res_status'] = 'success';
                } 
                else
                {
                    $res_data['res_message'] = 'There is some error on updating Google page.';
                    $res_data['res_status'] = 'error';
                }
            }
        }

        echo json_encode($res_data);
    }

    public function updateGoogleLocationReviews(){
        $out = array();
        $out[ 'success' ] = 0;
        $user_id=Auth::user()->id;       
        $social_det = Social::where('user_id', $user_id)->where('social_id', 2)->first();
        $out[ 'msg' ] = 'Google page not found!';
        if( $social_det ){            
            $location = $social_det->social_page_review_url;
            $out[ 'msg' ] = 'Google page location not found!';
            if(  $location ){
                $out[ 'success' ] = 1;
                $social=Rating::where('customer_id',$user_id)
                                ->where('review_type', 2)
                                ->delete();
                $this->fetchGoogleLocationReviews( $location );
                $out[ 'msg' ] = 'Google page reviews fetched!';
            }
        }
        echo json_encode($out);
        exit;
    }
}