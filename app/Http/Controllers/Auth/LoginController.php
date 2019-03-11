<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo()
    {
         $user_status=Auth::user()->activity;
        
         if($user_status==0)
         {
             return '/login/invalid';
         }
         else
         {
            // dd($user_status);
            $role=Auth::user();
            
            if($role)
            {
                $type=$role->user_type;
                
                if(isset($type))
                {
                
                
                    switch($type)
                    {
                        case 0:
                            
                            return '/admin/index';
                        case 1:
                            return '/home';
                        default:
                            return '/login';  
                    }
                }
                
            }

         }
             
    }
}
