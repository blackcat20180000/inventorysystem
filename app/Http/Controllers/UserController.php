<?php           

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Unit;
use App\Http\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id=Auth::user()->id;
        $org_name=Organization::where('owner_id',$id)->get();
         $staff=array();
         $units_org=array();
        if(count($org_name)>0)
        {
            $fir_org=$org_name[0]->id;
        
              
            $units_org=Unit::where('org_id',$fir_org)->get();
            if(count($units_org)>0)
            {
                $unit_id=$units_org[0]->id;
                $permission=Permission::where([['org_id','=',$fir_org],['unit_id','=',$unit_id]])->pluck('user_id')->toArray();
                
                $staff=array();
                foreach($permission as $key => $row)
                { 
                     $matchstaff=Staff::where('id',$row)->first();
                    if($matchstaff)
                    {
                        $staff[$key]=$matchstaff;         
                    }
                }
                
            }
        }
        
        return view('frontend.User',['org_name'=>$org_name,'staff'=>$staff,'unit_name'=> $units_org]);
    }
   
    public function subuser(Request $request)
    {
         $name=$request->name;
         $email=$request->email;
         $password=$request->password;
         $orgid=$request->orgnazation;
         $password_confirmation=$request->password_confirmation;
         $unit_field=$request->entity_unit;
        
         $data=array('name'=>$name,'email'=>$email,'password'=>$password,'unit_field'=>$unit_field,'password_confirmation'=>$password_confirmation);
         $validate=Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'unit_field'=>'required'
          
        ]);
       
         if($validate->fails())
         {  
            return redirect('user')->withErrors($validate);
         }
         else
         {
            $users=User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'org_id'=>$orgid,
                'cli_id'=>Auth::user()->id,
                'user_type'=>2,
                'stacas_password'=>$password
                
            ]);
           
            permission::insert(['org_id'=>$orgid,'user_id'=>$users->id,'unit_id'=>$unit_field]);
         }

        return redirect('user');
    }
    public function getstaffnamebyorgid(Request $request)
    {
        
         $orgid=$request->orgid;
         $unitid=$request->entityid;
         $staff=Staff::where([['org_id','=',$orgid],['unit_id','=',$unitid]])->get();
          echo json_encode($staff);

    }
    public function searchuser(Request $request)
    {
             $name=$request->username;
             $searchuser=Staff::orWhere('name','like','%'.$name.'%')->take(5)->get();
             echo json_encode($searchuser); 

    }
    public function setpermission(Request $request)
    {
         $permission=array();
         if($request->selpermiss)
         {
             $permission=$request->selpermiss;
         }
         $org_id=$request->org_id;
         $user_id=$request->staffid;
         
         Permission::where([['user_id','=',$user_id],['org_id','=',$org_id]])->delete();
         foreach($permission as $row)
         {
             Permission::insert(['user_id'=>$user_id,'org_id'=>$org_id,'unit_id'=>$row]);  
         }    
         return redirect('user');

    }
    public function getpermission(Request $request)
    {
         $permission_info=Permission::where('user_id',$staff_id)->orderBy('unit_id','asc')->pluck('unit_id')->toArray();
         $permission_unit=array();
         foreach($permission_info as $key => $row)
         {
                $unit=Unit::where('id',$row)->first();
                if($unit)
                {
                    $permission_unit[$key]=$unit;
                }
         }
         echo json_encode($permission_unit);
    }
    public function staffpermission(Request $request)
    {
        $staffid=$request->staff_id;
        $permission=Permission::where('user_id',$staffid)->pluck('unit_id')->toArray();
        $company_permission=Permission::where('user_id',$staffid)->orderBy('org_id','asc')->distinct('org_id')->pluck('org_id');
        
        $unit_info=array();
        $company_info=array();
        foreach($permission as $key => $row)
        {
            $unit=unit::where('id',$row)->first();
            $unit_info[$key]=$unit;
        }
        $permis_info=array();
        foreach($company_permission as $key=> $row)
        {
            $company_info[$key]=Organization::where('id',$row)->first();
        }
        $permis_info["org"]=$company_info;
        $permis_info["unit"]=$unit_info;
        echo json_encode($permis_info);
    }
    public function getorgname(Request $request)
    {
        $org_id=$request->orgid;
        $entityid=$request->entityid;
        $user=Permission::where([['org_id','=',$org_id],['unit_id','=',$entityid]])->pluck('user_id')->toArray();
        $user_info=array();
        foreach($user as $key => $row)
        {
            $user_info[$key]=Staff::where('id',$row)->first();
        }
        echo json_encode($user_info);
    }
     

}
