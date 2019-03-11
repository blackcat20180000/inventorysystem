<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\User;
use App\Http\Models\Invertory;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class OrganazationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $org_data=Organization::all();
        $owner=array();
        $org_staff=array();
        $org_inver=array();
        foreach($org_data as $key=>$row)
        {
            $orgid=$row->id;
            $org_staff[$key]=Staff::where('org_id',$orgid)->get();
            $org_inver[$key]=Invertory::where('org_id',$orgid)->get();
            $owner[$key]=Staff::where('id',$row->owner_id)->get();

        }
       
        return view('admin.organization',['client' =>$owner ,'org_data'=>$org_data,'org_staff'=>$org_staff,'org_inver'=>$org_inver]);
        
     }
   
}
