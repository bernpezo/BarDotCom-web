<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cliente;
use App\Administrador_sistema;
use App\Administrador_local;
use App\Usuario_local;

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
    //protected $redirectTo = '/home';

    public function redirectTo(){
        try {
            $user=Auth::user();
            $cliente=Cliente::find($user->id);
            $adminsys=Administrador_sistema::find($user->id);
            $adminlocal=Administrador_local::find($user->id);
            $usuariolocal=Usuario_local::find($user->id);
            if($cliente!==null)
            {
                return '/dashCliente';
            }
            if($adminsys!==null)
            {
                return '/dashAdminSys';
            }
            if($adminlocal!==null)
            {
                return '/dashAdminLocal';
            }
            if($usuariolocal!==null)
            {
                return '/dashUsuarioLocal';
            }
        } catch (\Throwable $th) {
            return "error";
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
