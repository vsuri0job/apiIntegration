<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Stripe\Stripe;
use Stripe\Subscription;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*
    *Method: index
    *Parameter: Null
    *Task:To display user list
    */

    public function index()
    {
        $data['users']=User::where('role','user')->get();
        return view('user.index',$data);
    }

     /*
    *Method: edit
    *Parameter: user_id ($id)
    *Task:To Display edit form
    */

    public function edit($id)
    {
        $data['users']=User::where('id',$id)->first();
        return view('user.edit',$data);
    }

    /*
    *Method: update
    *Parameter: user_id ($id)
    *Task:Edit User
    */

    public function update(Request $request, $id)
    {
        $data=$request->all();
        $validation=Validator::make($data, [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ]);

        if($validation->fails())
        {
            return redirect('user/edit'.$id)->withErrors($validation)->withInput();
        }
        else
        {   
            $slug_old=strtolower($data['company_name']);
            $slug=str_replace(' ','-',$slug_old);
            $record = array('name'=> $data['name'],
                'company_name'=> $data['company_name'],
                'email'=>$data['email'],
                'company_slug'=>$slug,
            );

            User::where('id',$id)->update($record);
            return redirect('user');
        }
    }



    /*
    *Method: delete
    *Parameter: user_id ($id)
    *Task:Edit User
    */

    public function delete($id)
    {
        User::where('id',$id)->delete();
        return redirect('user')->with('message2', 'Successfully Update');
    }
    
    /*
    *Method: viewprofile
    *Parameter: Null
    *Task:To display user profile
    */

    public function viewprofile()
    {
        $data['users']=User::where('id',Auth::user()->id)->first();
        return view('viewprofile',$data);
    }

    public function cancelSubscription(Request $request)
    {
        $user = Auth::user();        
        if( $user->stripe_customer_id && $user->stripe_subscription_id && $user->is_subscribed){
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $sub = \Stripe\Subscription::retrieve( $user->stripe_subscription_id );
            $sub->cancel(['at_period_end' => true]);
            $user->end_date = date('Y-m-d', $sub->current_period_end );
            $user->is_subscribed = 0;
            $user->save();
            $request->session()->flash('status', 'Your Subscription has been cancelled and will remain this period end!');
        }        
        return redirect('viewprofile');
    }
    /*
    *Method: editprofile
    *Parameter: Request($request)
    *Task:To edit user profile
    */

    public function editprofile(Request $request, $id)
    {
        $data=$request->all();
        $validation=Validator::make($data, [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ]);

        if($validation->fails())
        {
            return redirect('viewprofile')->withErrors($validation)->withInput();
        }
        else
        {   
            $slug_old=strtolower($data['company_name']);
            $slug=str_replace(' ','-',$slug_old);
            $record = array('name'=> $data['name'],
                        'company_name'=> $data['company_name'],
                        'email'=>$data['email'],
                        'company_slug'=>$slug,
            );
            User::where('id',$id)->update($record);
            return redirect('viewprofile');
        }
    }
    
    /*
    *Method: index
    *Parameter: Null
    *Task:To display Form for create widgets.
    */

    public function widgets()
    {
        $user_id=Auth::user()->id;
        $slug=User::where('id',$user_id)->value('company_slug');
        $data['url']=url('web-widget').'/'.$slug; 
        $data['url2']=url('reviewwidget'.'/'.$slug);
        $data['show_review']=User::where('id',$user_id, true)->value('show_review');
        $data['url3']=url("$slug").'/reviews';
        //'http://reviewchamp.net/login/plumbtastic-redlands-ca/reviews';
        $slug = User::where('id', $user_id, true)->first();
        $data['slug'] = $slug['company_slug'];
        $data['widgeturl']=asset('public/js/coupon.js');
        return view('user.widget',$data);
    }


    /*
    *Method: header
    *Parameter: Null
    *Task:To display Form for create widgets.
    */
     public function header(Request $request,$id)
    {
        $data=$request->all();
        /*$validation=Validator::make($data, [
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if($validation->fails())
        {
            return redirect('viewprofile')->withErrors($validation)->withInput();
        }
        else
        {*/
            $record = array('message'=>$data['message'],'phone'=>$data['phone'],'website'=>$data['website']);
            $update = User::where('id',$id)->update($record);

            if($request->hasFile('logo'))
            {
                $destinationPath = storage_path('logos');
                $extension = $request->file('logo')->getClientOriginalExtension(); // getting image extension
                $fileName = $id.'-'.time().'.'.$extension; // renameing image
                $request->file('logo')->move($destinationPath, $fileName);
                $idata['logo'] = $fileName;
                User::where('id',$id)->update($idata);
            }
            return redirect('viewprofile')->with('success', 'Successfully Update');
        //}
    }

    public function add()
    {
        return view('user.add');
    }
    
    public function insert(Request $request)
    {
        $data = $request->all();
        $validation=Validator::make($data, [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,',
            'password' => 'required|min:6|confirmed',
            'company_name' => 'required|string|max:255|unique:users',
            'phone' => 'required|integer|min:6',
            'website' => 'required',
        ]);

       if($validation->fails())
        {
            return redirect('user/add')->withErrors($validation)->withInput();
        } 
        else
        {
            $role='user';
            $slug_old=strtolower($data['company_name']);
            $slug=str_replace(' ','-',$slug_old);
            $company= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $role,
                'company_name' =>$data['company_name'],
                'company_slug'=>$slug,
                'phone' => $data['phone'],
                'website' => $data['website'],
            ]);
            return redirect()->back()->with('message', 'Company Inserted Successfully');
        }
     }

    public function active($id)
    {
        $record = array('active'=>'1');
        $rating=User::where('id',$id)->update($record);
        return back()->with('success','Thank you for Activate account');
    }

    public function inactive($id)
    {
        $record = array('active'=>'0');
        $rating=User::where('id',$id)->update($record);
        return back()->with('success','Thank you for Deactive account');
    }

    public function show($id)
    {
        $data['user']=User::where('id',$id,true)->first();
        return view('user.show',$data);
    }
}

