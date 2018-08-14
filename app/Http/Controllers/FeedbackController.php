<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Rating;
use App\Socialmedia;
use View;
use Mail;
use App\Template;
use Illuminate\Support\Facades\Input;
class FeedbackController extends Controller
{
    
    /*
        *Method: index
        *Parameter: Null
        *Task:To display feedback  
    */
    public function index()
    {
        $social= Socialmedia::where('name', 'Review Champ', true)->first();
        $reviewtype = $social['id'];
        $id=Auth::user()->id;
        // $user = Rating::where('customer_id', $id, true)->where('review_type', $reviewtype)->first();        
        // $user = Rating::where('review_type', $reviewtype)->get();
        // $user = User::where('active', 1)
        //             ->where('role', 'user')
        //             ->where('email', '!=', '')
        //             // ->where('is_subscribed', 1)
        //             ->get();
        $user = Rating::select('email')
                        ->distinct()
                        ->where('review_type', $reviewtype)->where('customer_id', Auth::user()->id)
                        ->orderBy( 'name', 'asc' )->get();
        $data['rating']=$user;
        $data['templates']=Template::where('user_id',$id)->get();

        return view('feedback.index',$data);
    }


    public function list(Request $request)
    {        
        $social= Socialmedia::where('name', 'Review Champ', true)->first();
        $reviewtype = $social['id'];
        $id=Auth::user()->id;
        // $user = Rating::where('customer_id', $id, true)->where('review_type', $reviewtype)->first();        
        // $user = Rating::where('review_type', $reviewtype)->get();
        // $user = User::where('active', 1)
        //             ->where('role', 'user')
        //             ->where('email', '!=', '')
        //             // ->where('is_subscribed', 1)
        //             ->get();
        // $user = Rating::where('review_type', $reviewtype)->where('customer_id', Auth::user()->id)
        //     ->orderBy( 'name', 'asc' )->get();
        $start_date = $request->input('date_start');
        $end_date = $request->input('date_end');
        $data['end_date']=$end_date;
        $data['start_date']=$start_date;
        if( $start_date || $end_date ){
            $where_date = [];
            if( $start_date ){
                $start_date = date( 'Y-m-d', strtotime($start_date) );
                $where_date[] = ' DATE( created_at ) >= "'.$start_date.'" ';
            }
            if( $end_date ){
                $end_date = date( 'Y-m-d', strtotime($end_date) );
                $where_date[] = ' DATE( created_at ) <= "'.$end_date.'" ';
            }            
            $where_date = implode(' AND ', $where_date);            
            $user = Rating::where('review_type', $reviewtype)
                        ->where('customer_id', Auth::user()->id)
                        ->whereRaw($where_date)
                        ->orderBy( 'id', 'desc' )->paginate(15);
        } else {            
            $user = Rating::where('review_type', $reviewtype)->where('customer_id', Auth::user()->id)
                ->orderBy( 'id', 'desc' )->paginate(15);
        }
        $data['rating']=$user;
        $data['social_id'] = $reviewtype;
        return view('feedback.list',$data);
    }

    public function ask_feedback(Socialmedia $smedia, Rating $rating, Request $request)
    {        
        $id=Auth::user()->id;
        $data['smedia']=$smedia;
        $data['rating']=$rating;
        $data['templates']=Template::where('user_id',$id)->get();
        return view('feedback.rating-feedback', $data);
    }

     /*
        *Method: index
        *Parameter: Null
        *Task:To display Email Templates 
    */
    
    public function feedback()
    {
        return view('feedback.feedback');
    }

     /*
        *Method: index
        *Parameter: Request ($request)
        *Task:To display Email Templates 
    */
    public function send(Request $request)
    {
        $data=$request->all();        
        unset($data['_token']);
        $emails=$data['ratingid'];
        $data2=array();
        $message=Template::where('id',$data['templateid'],true)->value('message');        
        //$templates=$temp->message;
        $data2['html']=$message;
        $data2['subject']='ReviewChamp';
        $img = url('public/images/header.jpg');
        foreach($data['ratingid'] as $usersemail) {
            $detail = array('title' => 'Demo Title', 
                        'content' => 'Demo content', 
                        'subject' => 'Customer Feedback', 
                        'email'=>$usersemail, 
                        'templ'=>$message);
            Mail::send('email',$detail,function($message) use($detail){
                        $message->to($detail['email']);
                        $message->from('noreply@reviewchamp.net', 'ReviewChamp');
                        $message->subject($detail['subject'], 'hello');
                        //$message->setBody($detail['templ'], 'text/html');
                        $message->setBody($detail['templ'], 'text/html'); 
              });
        }
        return redirect('request-feedback')->with('message', 'Sent Successfully');
        //return view('feedback.tempmail', $data2);
        die();
        $emails = $data['ratingid'];
        
        return view('feedback.tempmail', $data2);
        
        foreach ($emails as $email) 
        {
            $data2['email']=$email;
            Mail::send('feedback.tempmail', $data2, function($message) use($data2)
            {
                $message->from('noreplayreview@gmail.com', 'ReviewChamp');
                $message->to($data2['email'],'ReviewChamp');
                $message->subject($data2['subject']);
                $message->setBody($data2['html'], 'text/html');
            });
             
        }
        
        return redirect('request-feedback')->with('message', 'Sent Successfully');
    }


    public function gettemplate($id)
    {
      $data =Template::where('id',$id,true)->first();
      echo $data->message;
    }

}


