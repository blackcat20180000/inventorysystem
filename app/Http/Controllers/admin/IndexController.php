<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
class IndexController extends Controller
{
    use RegistersUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $site_user=Staff::all();
        $org=Organization::all();
        $inver=Invertory::all();
        $owner=Staff::where('user_type',1)->get();
        $comstaff=Staff::where('user_type',2)->get();
        return view('admin.index',['site_user'=>$site_user,'org'=>$org,'inver'=>$inver,'owner'=>$owner,'staff'=>$comstaff]);
       
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function getstaffinterface(Request $request)
    {
         $staff=Staff::where('user_type',2)->get();
         return view('admin.staff',['staff'=>$staff])->get();


    }
    public function getownerinterface(Request $request)
    {   
        $owner=Staff::where('user_type',1)->get();
        return view('admin.owner',['owner'=>$owner]);

    }
    
}
