<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use Illuminate\Support\Facades\Validator;
use App\Http\Models\Unit;
use Redirect;
class OrganazationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id=Auth::user()->id;
        $orgdata=Organization::where('owner_id',$id)->get();
        return view('frontend.orgnaization',['org_data'=>$orgdata]);
    }
    public function addorgnazation(Request $request)
    {
        $name=Auth::user()->name;
        $id=Auth::user()->id;
        $orgname=$request->orgname;
        $retime="".date('Y-m-d H:i:s');
        $org_group=Organization::where('name',$orgname)->get();
        if(count($org_group)>0)
        {
             return redirect('organzation');

        }   
        else
        {
            if(isset($name))
            {
                $org_id=Organization::insertGetId(['name'=>$orgname,'owner_id'=>$id,'orgdate'=>$retime]);
                Unit::insert(['name'=>'Purchase','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>1]);
                Unit::insert(['name'=>'Order','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>2]);
                Unit::insert(['name'=>'New order','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>3]);
                Unit::insert(['name'=>'Job','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>4]);
                Unit::insert(['name'=>'PO','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>5])    ;
                Unit::insert(['name'=>'Stock','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>6]);
                Unit::insert(['name'=>'Loss','org_id'=>$org_id,'owner_id'=>$id,'uniqe_id'=>7]);
             
                return Redirect('organzation');
            }

        }
        

    
        
    }
    public function updateorg(Request $request)
    {
            $name=$request->orgname;
            $orgid=$request->orgid;
            if(isset($orgid))
            {
                $org_prod=Organization::where('org_id',$orgid)->update(['name'=>$name]);
            }
            return redirect('organzation');
        
    }
    public function deleteorg(Request $request)
   {
           $org_id=$request->orgid;
            if(isset($org_id))
            {
                 Organization::where('id',$org_id)->delete();
            }
            return redirect('organzation');
   }
   public function subuser(Request $request)
   {
       
   }
   
}
