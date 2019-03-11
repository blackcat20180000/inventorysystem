<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
Use Redirect;   
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getstaffinterface(Request $request)
    {
         $staff=Staff::where('user_type',2)->get();
         $client=array();
         $org=array();
         foreach($staff as $key=>$row)
         {
              $cli_id=$row->cli_id;
              $org_id=$row->org_id;
              $client[$key]=Staff::where('id',$cli_id)->get();
              $org[$key]=Organization::where('id',$org_id)->get();
         }
        return view('admin.staff',['staff'=>$staff,'org'=>$org,'client'=>$client]);


    }
    public function getownerinterface(Request $request)
    {   
        $owner=Staff::where('user_type',1)->get();
        $org_data=array();
        $inver_data=array();
        $staff_data=array();
        foreach($owner as $key => $row)
        {
            $id=$row->id;
            $org_data[$key]=Organization::where('owner_id',$id)->get();
            $inver_data[$key]=Invertory::where('owner_id',$id)->get();
            $staff_data[$key]=Staff::where('cli_id',$id)->get();

        }
        return view('admin.owner',['owner'=>$owner,'org_data'=>$org_data,'inver_data' => $inver_data,'staff_data' => $staff_data]);

    }
    public function owneredit($id)
    {
         $cliid=$id;
         $client=Staff::where('id',$cliid)->get();
         
         return view('admin.clientinfoupdate',['client'=>$client]);
         
    }
    public function ownerchange(Request $request)
    {
        $username=$request->username;
        $client_id=$request->client_id;
        $client=Staff::where('id',$client_id)->get();
        $email=$request->email;
        $address=$request->address;
        // $useravatar=$request->useravatar;
        $ac_status=$request->ac_status;
        $avatarimage=$request->file('useravatar'); 
        $data=array('name' => $username,'email' => $email,'address' => $address,'ac_status' => $ac_status,'useravatar'=>$avatarimage);
        $initalvalidate=Validator::make($data,['name' => 'required','email' => 'required','address' => 'required','ac_status'=>'required','useravatar' =>'required']);
        if($initalvalidate->fails()) 
        {   
            return Redirect::back()->withErrors($initalvalidate);
            
        }   
        else
        {
            if($username!=$client[0]->name || $email!=$client[0]->email)
            {
                if($username!=$client[0]->name)
                {
                    $validate=Validator::make($data, [
                        'name' => 'required|string|max:255|unique:users',
                        
                    ]);
    
                }
                elseif($email!=$client[0]->email)
                {
                    $validate=Validator::make($data, [
                        'email' => 'required|string|max:255|unique:users',
                    ]);
    
                }
                else
                {
                    $validate=Validator::make($data, [
                        'name' => 'required|string|max:255|unique:users',
                        'email'=> 'required|string|max:255|unique:users'
                    ]);
    
                }
                if($validate->fails())
                {
                    return Redirect::back()->withErrors($validate);
                }
                
            }
            else
            {
    
                     
                     $fileName = "fileName".time().'.'.request()->useravatar->getClientOriginalExtension();
                     $destionpath=public_path('/images');
                     $avatarimage->move($destionpath,$fileName);
                     Staff::where('id',$client_id)->update(['name'=>$username,'email'=>$email,'address'=>$address,'activity' => $ac_status,'img'=>$fileName]);
                     return redirect('groupowner');
              
    
            }
           
                   
    

        }
       
    }
    public function user_delete($id)
    {
        Staff::where('id',$id)->delete();
        return Redirect::back(); 

    }
    
}
