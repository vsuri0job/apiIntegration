<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Settings;
use Illuminate\Support\Facades\Input;
class SettingsController extends Controller
{
    


    /*
    *Method: index
    *Parameter: Null
    *Task:To display all settings.
    */
    public function index()
    {
      	$title1=Settings::where('set_type','title')->first();
    	return view('settings.index',$title1);
    }

    /*
    *Method: title
    *Parameter: Request $request
    *Task:To change front end title
    */

    public function title(Request $request)
    {
      $data=$request->all();
      $record = array('set_value' => $data['title_new'], );
      Settings::where('id','1')->update($record);
      return redirect('settings')->with('message2', 'Successfully Update');
    }

    /*
    *Method: headertitle
    *Parameter: Request ($request)
    *Task: To change Backend header title
    */

    public function headertitle(Request $request)
    {
      $data=$request->all();
      $record = array('set_value' => $data['headertitle_new'], );
      Settings::where('id','2')->update($record);
      return redirect('settings')->with('message2', 'Successfully Update');
    }

     /*
    *Method: logo
    *Parameter: Request ($request)
    *Task:Change logo
    */

    public function logo(Request $request)
    {
        if($request->hasFile('image'))
        {   
            $destinationPath = storage_path('images');
            $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = time().'.'.$extension; // renameing image
            $request->file('image')->move($destinationPath, $fileName);
            $idata['set_value'] = $fileName;
            Settings::where('id','3')->update($idata);
            
        }
        return redirect('settings')->with('message2', 'Successfully Update');
    }

    

}
