<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Settings;
use App\Review;
use App\Template;
use Illuminate\Support\Facades\Input;
class EmailController extends Controller
{
    


    /*
    *Method: index
    *Parameter: Null
    *Task:To display Email Templates 
    */
    public function index()
    {
      	$data['templates']=Template::where('user_id',Auth::user()->id)->get();
    	return view('mail.index',$data);
    }


    /*
    *Method: index
    *Parameter: Null
    *Task:To display Email Templates 
    */
    public function add()
    {
       // $data['templates']=Template::all();
        return view('mail.add');
    }


     /*
    *Method: index
    *Parameter: Null
    *Task:To display Email Templates 
    */
    public function create(Request $request)
    {
        $data=$request->all();
        $user_id=Auth::user()->id;
        $validation=Validator::make($data, [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:8000',
          ]);
        if($validation->fails())
        {
            return redirect('mail')->withErrors($validation)->withInput();
        }
        else
        {
        $record = array('name'=> $data['name'],
                        'message'=> $data['message'],
                        'user_id'=>$user_id,
                  );
            Template::create($record);
            //die();
            return redirect('mail')->with('message2', 'Successfully Update');
        }
    }


    /*
    *Method: edit
    *Parameter: template id ($id)
    *Task:To display edit form for update.
    */
    public function edit($id)
    {
        $data['template']=Template::where('id',$id,true)->first();
        return view('mail.edit',$data);
    }

    /*
    *Method: update
    *Parameter: Request ($request), template id ($id)
    *Task:To Update template.
    */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        $validation=Validator::make($data, [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:8000',
          ]);
        if($validation->fails())
        {
            return redirect('mail/edit/'.$id)->withErrors($validation)->withInput();
        }
        else
        {
            $record = array('name'=> $data['name'],
                        'message'=> $data['message'],
                  );
            Template::where('id',$id)->update($record);
            //die();
            return redirect('mail')->with('message2', 'Successfully Update');
        }
    }
   
}
