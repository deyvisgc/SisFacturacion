<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/home';

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
        return 'usuario';
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        if (!User::where('usuario', $request->usuario)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => trans('auth.usuario'),
                ]);
        }
        if (!User::where('usuario', $request->usuario)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([

                    'password' => trans('auth.password'),
                ]);
        }

    }

}
