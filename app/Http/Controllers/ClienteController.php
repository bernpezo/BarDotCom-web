<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class ClienteController extends Controller
{
    private $respuesta = -1;// Variable para generar respuestas
    /*
     * Validar si el usuario está autenticado como cliente
     */
    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            try {
                $user=Auth::user();
                if(Cliente::where('idUser',$user->id)==null)
                {
                    return redirect()->route('login');
                }
                return $next($request);
            } catch (\Throwable $th) {
                return redirect()->route('login');
                return $next($request);
            }
            
        });
    }
    /*
     * Vistas pertenecientes al cliente
     */
    public function index()
    {
        return view('dashboard.dashCliente');
    }

    public function perfil()
    {
        $data=array();
        $data['user']=Auth::user();
        $data['cliente']=Cliente::where('idUser',Auth::user()->id)->first();
        $data['respuesta'] = $this->respuesta;
        return view ('dashboard.dashCliente.perfil')->with('data',$data);
    }
    /*
     * Editar perfil de usuario
     */
    public function editPerfil(Request $request)
    {
        $user=User::find($request->id);
        $data=array();
        $data['user'] = $user;
        try {
            $validar = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'comuna' => 'required|integer',
                'fechaNacimiento' => 'required|date',
                'nfc' => 'integer',
                'telefono' => 'required|integer',
                'email' => 'required|string|email|max:255',
                'passwordActual' => 'required|string|min:8',
            ]);
            if((Hash::check($request->passwordActual, $user->password))){// Validar contraseña
                $user->update($validar);
                $cliente=Cliente::where('idUser',$user->id)->first();
                if($request->nfc!=''){
                    $cliente->nfc=$request->nfc;
                    $cliente->update();
                }
                $data['cliente'] = $cliente;
                if($request->password!=''){
                    $user->password=Hash::make($request->password);
                    $user->update();
                }
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashCliente.perfil')->with('data',$data);
            }else{
                $data['respuesta'] = $this->respuesta = 2;
                return view('dashboard.dashCliente.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashCliente.perfil')->with('data',$data);
        }
    }
    /*
     * Eliminar cuenta
     */
    public function eliminarCuenta(Request $request)
    {
        $user=User::find($request->id);
        $data=array();
        $data['user'] = $user;
        try {
            if((Hash::check($request->passwordEliminar, $user->password))){// Validar contraseña
                $user->delete();
                return view('home');
            }else{
                $data['respuesta'] = $this->respuesta = 2;
                return view('dashboard.dashCliente.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashCliente.perfil')->with('data',$data);
        }
    }
}
