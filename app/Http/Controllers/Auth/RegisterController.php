<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'comuna' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fechaNacimiento' => ['required', 'date'],
            'telefono' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $users=User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'comuna' => $data['comuna'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fechaNacimiento' => $data['fechaNacimiento'],
            'telefono' => $data['telefono'],
        ]);
        $usersCli=User::where('email',$users->email)->first();
        $clientes=new Cliente;
        $clientes->id=$usersCli->id;
        if($data['nfc']!==null)
        {
            $clientes->nfc=$data['nfc'];
            $clientes->update();
        }else{
            $clientes->nfc=0;
        }
        $clientes->save();
        return $users;
    }
}
