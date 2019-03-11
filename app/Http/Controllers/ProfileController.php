<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Models\Profile;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $name=Auth::user()->name;
        $id=Auth::user()->id;
        $type=Auth::user()->user_type;
    
        if($type=='1')
        {
            $user_type="owner";
            $org=Organization::where('owner_id',$id)->get();
            $user=Auth::user();
            $mystaff=Staff::where('cli_id',$user->id)->get();
            $inver=Invertory::where('owner_id',$id)->get();
            $profile_content=Profile::where('user_id',$id)->get();
            return view('frontend.profile',['mystaff'=>$mystaff,'user'=>$user,'user_type'=>$user_type,'org'=>$org,'inver'=>$inver,'profile'=>$profile_content]);
            
        }
        else
        {
            $profile_content=Profile::where('user_id',$id)->get();
            $user_type="staff";
            $cli_id=Auth::user()->cli_id;
            $cli=Staff::where('id',$cli_id)->get();
            return view('frontend.profile',['user_type'=>$user_type,'cli'=>$cli,'profile_content'=>$profile_content]);
        }
      
    }
    public function searchprofile(Request $request)
    {
        $sear_username=$request->user_name;
        $match_user=Staff_where('name',$sear_username)->get();
        if(isset($match_user))
        {
            $user=$match_user[0];
            if($user->user_type=="1")
            {
                $user_type="owner";
                $id=$user->id;
                $org=Organization::where('owner_id',$id)->get();
                $inver=Inventory::where('owner_id',$id)->get();
                $profile_content=Profile::where('user_id',$id)->get();
                return view('frontend.profile',['user_type'=>$user_type,'org'=>$org,'inver'=>$inver,'profile'=>$profile_content]);
            }
            else
            {
                $user_type="staff";
                $cli_id=$user->cli_id;
                $user_id=$user->id;
                $cli=Staff::where('id',$cli_id)->get();
                $profile_content=Profile::where('user_id',$user_id);
                return view('frontend.profile',['user_type'=>$user_type,'cli'=>$cli,'profile_content'=>$profile_content]);
            }
        }
    }
    public function updateprofile(Request $request)
    {
          $newusername=$request->name;
          $prevuserid=$request->userid;
          $companycontent=$request->companycontent;
          $usercontent=$request->usercontent;
          $file=$request->file('profileimage');
          $fileName = "fileName".time().'.'.request()->profileimage->getClientOriginalExtension();
          $data=array('name'=>$newusername);
          $validate=Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
          ]);
          if($validate->fails())
          {
              return redirect('profile')->withErrors($validate);

          }
          else
          {
             $cursta=Staff::where('id',$prevuserid)->get();
              if(count($cursta)>0)
              {
                     Staff::where('id',$prevuserid)->update(['name'=>$newusername]);
                     
                     $prof=Profile::where('user_id',$prevuserid)->get();
                     if(count($prof)>0)
                     {
                         $destionpath=public_path('/images');
                         $file->move($destionpath,$fileName);
                          Staff::where('id',$prevuserid)->update(['img'=>$fileName]);
                          Profile::where('user_id',$prevuserid)->update(['profile_content'=>$usercontent,'company_history'=>$companycontent]);
                     }
                     else
                     {
                         Profile::insert(['user_id'=>$prevuserid,'profile_content'=>$usercontent,'company_history'=>$companycontent]);
                     }
                    return redirect('profile');
              }
              
          }

    }
}
