<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use Illuminate\Foundation\Auth\RegistersUsers;

class HomeController extends Controller
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
//         $parser = new \Smalot\PdfParser\Parser();
//         $pdf=$parser->parseFile('sample.pdf');
//       // Retrieve all pages from the pdf file.
//         $pages  = $pdf->getPages();
 
// // Loop over each page to extract text.
//         foreach ($pages as $page) {
//             echo $page->getText();
//             echo "<br>";
//             echo "<br>";
//         }   
//         var_dump(exit);
           
        // $starndard=strstr($text,"REF #	SKU");
        // $strarr=explode("MERCHANDISE",$starndard,2);
        // $strline=explode("\n",$strarr[0]);
        // foreach($strline as $row)
        // {
        //     echo $row;
            
        //     echo "<br>";
        // }
        // exit;  

        $user=Auth::user();
        if($user->user_type==1)
        {
            $organzation="";
            $name=$user->name;
            $ownerid=$user->id;
            if(isset($ownerid))
            {
                $organzation=Organization::where('owner_id',$ownerid)->get();
                $clientstaff=Staff::where('cli_id',$ownerid)->get();
                $invertoritem=Invertory::where('owner_id',$ownerid)->get();
               
            }
            
            return view('home',['name' => $name,'organzation'=>$organzation,'item'=>$invertoritem,'staff'=>$clientstaff]);
            // return view('home')->('name'=>$name,'organzation'=>$organzation);
        }
        elseif($user->user_type==0)
        {
             return redirect('admin/index');
        }
        else
        {
             $this->Logoout();    
        }
       
    }
    public function Logoout()
    {

        Auth::logout();
        return redirect('/login');
    }
    public function permissiondenied(Request $request)
    {
         Auth::logout();
         return view('permission');
    }
}
