<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Controllers\Controller;
class InvertoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        
       $invertory=Invertory::all();
       $client=array();
       $org_data=array();
        foreach($invertory as $key => $row)
       {
             $owner_id=$row->owner_id;
             $org_id=$row->org_id;
             $inv_cli=Staff::where('id',$owner_id)->get();
             $org_dat=Organization::where('id',$org_id)->get();
             $client[$key] =$inv_cli;     
             $org_data[$key]=$org_dat;
        }
        return view('admin.invertory',['invertory' => $invertory,'client' => $client,'org_data' => $org_data]);
        
    }


}
