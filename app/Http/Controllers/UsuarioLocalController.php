<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario_local;
use App\Pedido;
use App\Cuenta;

class UsuarioLocalController extends Controller
{
    private $respuesta = -1;

    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            $user=Auth::user();
            if(Usuario_local::find($user->id)==null)
            {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashUsuarioLocal');
    }

    public function perfil()
    {
        $data=array();
        $data['user']=Auth::user();
        $data['respuesta'] = $this->respuesta;
        return view ('dashboard.dashUsuarioLocal.perfil')->with('data',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPedidosPendientes(Request $request)
    {
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
                                            ->where('estado','like','1')
                                            ->orWhere('idItem','like','%'.$request->search['value'].'%')
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Pedido::latest('created_at')
                                            ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                            ->where('estado','like','1')
                                            ->orWhere('idItem','like','%'.$request->search['value'].'%')
                                            ->offset($start)
                                            ->limit($length)
                                            ->get();
           }else{
                $totalRegistros = Pedido::where('idLocal','like','%'.$usuario->idLocal.'%')
                                                ->where('estado','like','1')
                								->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                $registros = Pedido::latest('created_at')     
                                                ->where('idLocal','like','%'.$usuario->idLocal.'%')
                                                ->where('estado','like','1')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
           }
           //agregamos los botones html entregar/eliminar
           foreach ($registros as $pedido) {
                $pedido->parametros= '<a href="'.route('entregarPedido', ['id64'=>base64_encode($pedido->id)]).'" class="btn btn-info btn-actions btn-editar">Entregar</a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($pedido->id).'" data-url="'.route('destroyPedido').'" data-ing="'.$pedido->fecha.'">Eliminar</buttom>';
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
    }

    public function showCuentasPendientes(Request $request)
    {
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
                                            ->orWhere('idItem','like','%'.$request->search['value'].'%')
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Cuenta::latest('created_at')
                                            ->where('idLocal','like','%'.$usuario->idLocal.'%')	
                                            ->where('estado','like','1')
                                            ->orWhere('idItem','like','%'.$request->search['value'].'%')
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
                $cuenta->parametros= '<a href="'.route('entregarCuenta', ['id64'=>base64_encode($cuenta->id)]).'" class="btn btn-info btn-actions btn-editar">Entregar</a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($cuenta->id).'" data-url="'.route('destroyCuenta').'" data-ing="'.$cuenta->created_at.'">Eliminar</buttom>';
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
    }

    public function entregarPedido(Request $request)
    {
        
    }

    public function entregarCuenta(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPedido(Request $request)
    {
        //
    }

    public function destroyCuenta(Request $request)
    {
        //
    }

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
                'telefono' => 'required|integer',
                'email' => 'required|string|email|max:255',
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
    }
}
