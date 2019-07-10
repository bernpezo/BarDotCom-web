<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario_local;
use App\Pedido;
use App\Cuenta;
use App\Item;
use App\Ingreso_cliente;
use App\Cliente;
use App\Mesa;

class UsuarioLocalController extends Controller
{
    private $respuesta = -1;// Variable para generar respuestas
    /*
     * Validar si el usuario está autenticado como usuario de local
     */
    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            try {
                $user=Auth::user();
                if(Usuario_local::find($user->id)==null)
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
     * Vistas pertenecientes al usuario de local
     */
    public function index()
    {
        return view('dashboard.dashUsuarioLocal')->with('respuesta',$this->respuesta);
    }

    public function pedidosEntregados()
    {
        return view('dashboard.dashUsuarioLocal.pedidosEntregados');
    }

    public function cuentasEntregadas()
    {
        return view('dashboard.dashUsuarioLocal.cuentasEntregadas');
    }

    public function perfil()
    {
        try {
            $data=array();
            $data['user']=Auth::user();
            $data['respuesta'] = $this->respuesta;
            return view ('dashboard.dashUsuarioLocal.perfil')->with('data',$data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Registrar cliente
     */
    public function registrarCliente()
    {
        return view('dashboard.dashUsuarioLocal.registrarCliente')->with('respuesta',$this->respuesta);
    }

    public function registrarNFC(Request $request)
    {
        try {
            $usuario = Usuario_local::where('id',Auth::user()->id)->first();
            $cliente = Cliente::where('nfc',$request->nfc)->first();
            $mesa = Mesa::where('numero',$request->mesa)->first();
            $request->request->add(['idLocal' => $usuario->idLocal,'idUsuario' => $usuario->id,'idCliente' => $cliente->id,'idMesa' => $mesa->id]);
            //registrar ingreso
            $validar = $request->validate([// Validar datos provenientes del formulario
                'idLocal' => 'required',
                'idUsuario' => 'required',
                'idCliente' => 'required',
                'idMesa' => 'required',
            ]);
            $ingreso = Ingreso_cliente::create($validar);
            //crear cuenta
            $cuenta = new Cuenta;
            $cuenta->idLocal=$usuario->idLocal;
            $cuenta->idUsuario=$usuario->id;
            $cuenta->idCliente=$cliente->id;
            $cuenta->idMesa=$mesa->id;
            $cuenta->total=0;
            $cuenta->estado=2;
            $cuenta->save();
            $respuesta = 1;
            return view('dashboard.dashUsuarioLocal.registrarCliente')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashUsuarioLocal.registrarCliente')->with('respuesta',$respuesta);
        }
    }
    /*
     * Mostrar pedidos pendientes de entregar
     */
    public function showPedidosPendientes(Request $request)
    {
        try {
            $usuario = Usuario_local::where('id',Auth::user()->id)->first();
            $search = $order = $start = $length = $draw = null;
            /*Se valida que vengan todos los parametros*/
            if(!isset($request->search) && !isset($request->order) && !isset($request->start) && !isset($request->length) && !isset($request->draw)){
                return "data errors";
            }else{
                $search = $request->search;
                $order = $request->order;
                $start = $request->start;
                $length = $request->length;
                $draw = $request->draw;
                $columns = $totalRecords = $data = array();
                //definir indices de las columnas
                $columns = array(
                  0 => 'idCliente',    
                  1 => 'idMesa',
                  2 => 'idItem',
                  3 => 'cantidadItem',
                  4 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Pedido::where('idLocal','like','%'.$usuario->idLocal.'%')// Mostrar solo los pertenecientes al local
                                                ->where('estado','like','2')// Mostrar solo los pedido con estado 2 (pendiente)
                                                ->where('idItem','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Pedido::latest('created_at')
                                                ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                                ->where('estado','like','2')
                                                ->where('idItem','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Pedido::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','2')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Pedido::latest('created_at')     
                                                    ->where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','2')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones entregar y eliminar
               foreach ($registros as $pedido) {
                    $pedido->parametros= '<a href="'.route('entregarPedido', ['id64'=>base64_encode($pedido->id)]).'" class="btn btn-success btn-actions btn-editar">Entregar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminarPedido" data-id="'.base64_encode($pedido->id).'" data-url="'.route('destroyPedido').'" data-ing="'.$pedido->fecha.'">Eliminar</buttom>';
                    $data[] = $pedido;
               }
               //se crea la data
               $json_data = array(
                 "draw"            => intval($draw ),   
                 "recordsTotal"    => intval($totalRegistros ),  
                 "recordsFiltered" => intval($totalRegistros),
                 "data"            => $data   // total data array
               );
            }
            //se retorna en formato JSON
            return json_encode($json_data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Mostrar cuentas pendientes de entregar
     */
    public function showCuentasPendientes(Request $request)
    {
        try {
            $usuario = Usuario_local::where('id',Auth::user()->id)->first();
            $search = $order = $start = $length = $draw = null;
            /*Se valida que vengan todos los parametros*/
            if(!isset($request->search) && !isset($request->order) && !isset($request->start) && !isset($request->length) && !isset($request->draw)){
                return "data errors";
            }else{
                $search = $request->search;
                $order = $request->order;
                $start = $request->start;
                $length = $request->length;
                $draw = $request->draw;
                $columns = $totalRecords = $data = array();
                //definir indices de las columnas
                $columns = array(
                  0 => 'idCliente',
                  1 => 'idMesa',    
                  2 => 'total',
                  3 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                ->where('estado','like','1')
                                                ->where('total','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Cuenta::latest('created_at')
                                                ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                                ->where('estado','like','1')
                                                ->where('total','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','1')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Cuenta::latest('created_at')     
                                                    ->where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','1')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html entregar/eliminar
               foreach ($registros as $cuenta) {
                    $cuenta->parametros= '<a href="'.route('entregarCuenta', ['id64'=>base64_encode($cuenta->id)]).'" class="btn btn-success btn-actions btn-editar">Entregar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminarCuenta" data-id="'.base64_encode($cuenta->id).'" data-url="'.route('destroyCuenta').'" data-ing="'.$cuenta->created_at.'">Eliminar</buttom>';
                    $data[] = $cuenta;
               }
               //se crea la data
               $json_data = array(
                 "draw"            => intval($draw ),   
                 "recordsTotal"    => intval($totalRegistros ),  
                 "recordsFiltered" => intval($totalRegistros),
                 "data"            => $data   // total data array
               );
            }
            //se retorna en formato JSON
            return json_encode($json_data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Mostrar pedidos entregados
     */
    public function showPedidosEntregados(Request $request)
    {
        try {
            $usuario = Usuario_local::where('id',Auth::user()->id)->first();
            $search = $order = $start = $length = $draw = null;
            /*Se valida que vengan todos los parametros*/
            if(!isset($request->search) && !isset($request->order) && !isset($request->start) && !isset($request->length) && !isset($request->draw)){
                return "data errors";
            }else{
                $search = $request->search;
                $order = $request->order;
                $start = $request->start;
                $length = $request->length;
                $draw = $request->draw;
                $columns = $totalRecords = $data = array();
                //definir indices de las columnas
                $columns = array(
                    0 => 'idCliente',    
                    1 => 'idMesa',
                    2 => 'idItem',
                    3 => 'cantidadItem',
                    4 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Pedido::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                ->where('estado','like','0')// Mostrar solo pedidos con estado 0 (Entregados)
                                                ->where('idItem','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Pedido::latest('created_at')
                                                ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                                ->where('estado','like','0')
                                                ->where('idItem','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Pedido::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','0')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Pedido::latest('created_at')     
                                                    ->where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','0')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html entregar/eliminar
               foreach ($registros as $pedido) {
                    $pedido->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Entregar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($pedido->id).'" data-url="#" data-ing="'.$pedido->created_at.'">Eliminar</buttom>';
                    $data[] = $pedido;
               }
               //se crea la data
               $json_data = array(
                 "draw"            => intval($draw ),   
                 "recordsTotal"    => intval($totalRegistros ),  
                 "recordsFiltered" => intval($totalRegistros),
                 "data"            => $data   // total data array
               );
            }
            //se retorna en formato JSON
            return json_encode($json_data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Mostrar cuentas entregadas
     */
    public function showCuentasEntregadas(Request $request)
    {
        try {
            $usuario = Usuario_local::where('id',Auth::user()->id)->first();
            $search = $order = $start = $length = $draw = null;
            /*Se valida que vengan todos los parametros*/
            if(!isset($request->search) && !isset($request->order) && !isset($request->start) && !isset($request->length) && !isset($request->draw)){
                return "data errors";
            }else{
                $search = $request->search;
                $order = $request->order;
                $start = $request->start;
                $length = $request->length;
                $draw = $request->draw;
                $columns = $totalRecords = $data = array();
                //definir indices de las columnas
                $columns = array(
                    0 => 'idCliente',
                    1 => 'idMesa',    
                    2 => 'total',
                    3 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                ->where('estado','like','0')// Mostrar solo cuentas con estado 0 (Entregados)
                                                ->where('idMesa','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Cuenta::latest('created_at')
                                                ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                                ->where('estado','like','0')
                                                ->where('idMesa','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','0')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Cuenta::latest('created_at')     
                                                    ->where('idLocal','like','%'.$usuario->idLocal.'%')
                                                    ->where('estado','like','0')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html entregar/eliminar
               foreach ($registros as $cuenta) {
                    $cuenta->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Entregar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($cuenta->id).'" data-url="#" data-ing="'.$cuenta->created_at.'">Eliminar</buttom>';
                    $data[] = $cuenta;
               }
               //se crea la data
               $json_data = array(
                 "draw"            => intval($draw ),   
                 "recordsTotal"    => intval($totalRegistros ),  
                 "recordsFiltered" => intval($totalRegistros),
                 "data"            => $data   // total data array
               );
            }
            //se retorna en formato JSON
            return json_encode($json_data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Marcar producto como entregado al cliente
     */
    public function entregarPedido(Request $request)
    {
        try {
            $pedido=Pedido::find(base64_decode($request->id64));
            $pedido->estado=1;// Cambiar estado a entregado
            $pedido->update();
            $item=Item::find($pedido->idItem);
            if($pedido->cantidadItem > $item->stock)// Revisar stock disponible
            {
                $respuesta = 2;
                return view('dashboard.dashUsuarioLocal')->with('respuesta',$respuesta);
            }
            $item->stock=$item->stock - $pedido->cantidadItem;// Descontar stock
            $item->update();
            $cuenta=Cuenta::find($pedido->idCuenta);
            $cuenta->total=$cuenta->total + ($item->precio * $pedido->cantidadItem);// Sumar total a la cuenta
            $cuenta->update();
            $respuesta = 1;
            return view('dashboard.dashUsuarioLocal')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashUsuarioLocal')->with('respuesta',$respuesta);
        }
    }
    /*
     * Marcar cuenta como entregada al cliente
     */
    public function entregarCuenta(Request $request)
    {
        try {
            $cuenta=Cuenta::find(base64_decode($request->id64));
            $pedido=Pedido::where('idCuenta',base64_decode($request->id64))->get();
            $cuenta->estado=0;// Cambiar estado a entregada
            foreach ($pedido as $ped) {
                $ped->estado=0;// cambiar estado a producto
                $ped->update();
            }
            $cuenta->update();
            $respuesta = 1;
            return view('dashboard.dashUsuarioLocal')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashUsuarioLocal')->with('respuesta',$respuesta);
        }
    }
    /*
     * Eliminar pedido
     */
    public function destroyPedido(Request $request)
    {
        try {
            $pedido=Pedido::find(base64_decode($request->id));
            $pedido->delete();
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Eliminar cuenta
     */
    public function destroyCuenta(Request $request)
    {
        try {
            $cuenta=Cuenta::find(base64_decode($request->id));
            $cuenta->estado=2;
            $cuenta->update();
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Editar perfil de usuario
     */
    public function editPerfil(Request $request)
    {
        try {
            $user=User::find($request->id);
            $data=array();
            $data['user'] = $user;
            try {
                $validar = $request->validate([
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'comuna' => 'required|integer',
                    'fechaNacimiento' => 'required|date',
                    'telefono' => 'required|integer',
                    'email' => 'required|string|email|max:50|unique:users,email,'.$user->id,
                    'passwordActual' => 'required|string|min:8',
                ]);
                if((Hash::check($request->passwordActual, $user->password))){
                    $user->update($validar);
                    if($request->password!=''){
                        $user->password=Hash::make($request->password);
                        $user->update();
                    }
                    $data['respuesta'] = $this->respuesta = 1;
                    return view('dashboard.dashUsuarioLocal.perfil')->with('data',$data);
                }else{
                    $data['respuesta'] = $this->respuesta = 2;
                    return view('dashboard.dashUsuarioLocal.perfil')->with('data',$data);
                }
            } catch (\Throwable $th) {
                $data['respuesta'] = $this->respuesta = 0;
                return view('dashboard.dashUsuarioLocal.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
}
