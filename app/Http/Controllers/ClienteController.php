<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Aviso;
use App\Local_comercial;
use App\Item;
use App\Pedido;
use App\Cuenta;
use App\Promocion;

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
        return view('dashboard.dashCliente')->with('data',Local_comercial::where('comuna',Auth::user()->comuna)->get());// Mostrar locales
    }

    public function detalleLocal(Request $request)
    {
        $data=array();
        $data['local'] = Local_comercial::find($request->id);
        $data['promocion'] = Promocion::where('idLocal',$request->id)->get();
        return view('dashboard.dashCliente.detalleLocal')->with('data',$data);
    }

    public function revisarCarta(Request $request)
    {
        $item=Item::where('idLocal',$request->id)->get();
        return view('dashboard.dashCliente.revisarCarta')->with('data',$item);// Mostrar carta
    }

    public function detalleItem(Request $request)
    {
        $data=array();
        $data['item'] = Item::find($request->id);
        $cuenta = Cuenta::where([['estado',2],['idLocal',$request->idLocal]])->first();
        if($cuenta==null){
            $data['respuesta'] = $this->respuesta = 2;
        }else{
            $data['respuesta'] = $this->respuesta = 3;
        }
        return view('dashboard.dashCliente.detalleItem')->with('data',$data);
    }

    public function verCuenta(Request $request)
    {
        try {
            $cliente = Cliente::where('idUser',Auth::user()->id)->first();
            $cuenta=Cuenta::where('idCliente',$cliente->id)->first();
            $pedido=Pedido::where([['idCuenta',$cuenta->id],['estado','>',0]])->get();
            $data=array();
            $data['cuenta']=$cuenta;
            $data['pedido']=$pedido;
            foreach ($pedido as $item) {
                $itemPedido=Item::find($item->idItem)->get();
            }
            $data['itemPedido']=$itemPedido;
            $data['respuesta'] = $this->respuesta;
            return view ('dashboard.dashCliente.verCuenta')->with('data',$data);
        } catch (\Throwable $th) {
            return view('dashboard.dashCliente')->with('data',Local_comercial::all());
        }
        
    }

    public function hacerPedido(Request $request)
    {
        $data=array();
        $data['item'] = Item::find($request->idItem);
        try {
            $cliente = Cliente::where('idUser',Auth::user()->id)->first();
            $cuenta = Cuenta::where('idCliente',$cliente->id)->first();
            $request->request->add(['idItem' => $request->idItem,'idCuenta' => $cuenta->id,'idLocal' => $request->idLocal,'idUsuario' => $cuenta->idUsuario,'idCliente' => $cliente->id,'idMesa' => $cuenta->idMesa,'cantidadItem' => $request->cantidad,'estado' => 2]);
            $validar = $request->validate([// Validar datos provenientes del formulario
                'idLocal' => 'required',
                'idUsuario' => 'required',
                'idCliente' => 'required',
                'idCuenta' => 'required',
                'idMesa' => 'required',
                'idItem' => 'required',
                'cantidadItem' => 'required',
                'estado' => 'required',
            ]);
            $pedido = Pedido::create($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashCliente.detalleItem')->with('data',$data);
        } catch (\Throwable $th) {
            $data=array();
            $data['item'] = Item::find($request->idItem);
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashCliente.detalleItem')->with('data',$data);
        }
        
    }
    /*
     * Pedir cuenta
     */
    public function pedirCuenta(Request $request)
    {
        $cliente = Cliente::where('idUser',Auth::user()->id)->first();
        $cuenta=Cuenta::where('idCliente',$cliente->id)->first();
        $pedido=Pedido::where([['idCuenta',$cuenta->id],['estado','>',0]])->get();
        $data=array();
        $data['cuenta']=$cuenta;
        $data['pedido']=$pedido;
        foreach ($pedido as $item) {
            $itemPedido=Item::find($item->idItem)->get();
        }
        //return $itemPedido;
        $data['itemPedido']=$itemPedido;
        try {
            $cuenta->estado=1;
            $cuenta->update();
            $data['respuesta'] = $this->respuesta = 1;
            return view ('dashboard.dashCliente.verCuenta')->with('data',$data);
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view ('dashboard.dashCliente.verCuenta')->with('data',$data);
        }
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
        $cliente=Cliente::where('idUser',$user->id)->first();
        $data=array();
        $data['user'] = $user;
        try {
            $validar = $request->validate([
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'comuna' => 'required|integer',
                'fechaNacimiento' => 'required|date',
                'nfc' => 'integer',
                'telefono' => 'required|integer',
                'email' => 'required|string|email|max:50|unique:users,email,'.$user->id,
                'passwordActual' => 'required|string|min:8',
            ]);
            if((Hash::check($request->passwordActual, $user->password))){// Validar contraseña
                $user->update($validar);
                if($request->nfc!=''){
                    $cliente->nfc=$request->nfc;
                    $cliente->update();
                }
                if($request->password!=''){
                    $user->password=Hash::make($request->password);
                    $user->update();
                }
                $data['cliente'] = $cliente;
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashCliente.perfil')->with('data',$data);
            }else{
                $data['cliente'] = $cliente;
                $data['respuesta'] = $this->respuesta = 2;
                return view('dashboard.dashCliente.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            $data['cliente'] = $cliente;
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
        $cliente=Cliente::where('idUser',$user->id)->first();
        $data=array();
        $data['cliente'] = $cliente;
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
