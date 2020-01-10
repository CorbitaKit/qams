<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
use App\User;
use App\Employee;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
      return config('ldap_auth.usernames.eloquent');
    }

   
    protected function attemptLogin(Request $request)
    {

        $ldaprdn = $request->username.'@'.env('LDAP_USER_DOM');
        $ldappass = $request->password;

        // dd($ldaprdn);

        $ldapconn = ldap_connect(env("LDAP_HOSTS"));

        ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3);
        ldap_set_option($ldapconn,LDAP_OPT_REFERRALS,0);

        if($ldapconn){
            $ldapbind = @ldap_bind($ldapconn,$ldaprdn,$ldappass);
    
            if($ldapbind){

                if(self::checkIfAddedAsEmployee($request->username))
                    return false;


                $filter = "(samaccountname=".$request->username.")";


                $result = ldap_search($ldapconn,env('LDAP_BASE_DN'),$filter);


                $info = ldap_get_entries($ldapconn,$result);


                $user = $this->setUser($request->username,$info);
                $this->guard()->login($user, true);
                return true;

            }else{
                return false;
            }
        }
    }

    protected function setUser($username,$ldapinfo){

    
    
       $user = User::where("employee_id",$username)->first();

       if(! $user){


            $new_user = new User();

            $new_user->name = $ldapinfo[0]['cn'][0];
            $new_user->username = $username;
            $new_user->password = '';
            $new_user->employee_id = $username;

            return $new_user;
       }

       return $user;


    }

    private function checkIfAddedAsEmployee($employee_id){
        if(! Employee::where('employee_id',$employee_id)->first())
            return true;
    }

 



}
