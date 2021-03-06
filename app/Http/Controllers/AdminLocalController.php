<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Administrador_local;
use App\Promocion;
use App\Mesa;
use App\Item;
use App\Cuenta;
use App\Aviso;
use Carbon\Carbon;

class AdminLocalController extends Controller
{
    private $respuesta = -1;// Variable para generar respuestas
    /*
     * Validar si el usuario está autenticado como administrador de local
     */
    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            try {
                $user=Auth::user();
                if(Administrador_local::find($user->id)==null)
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
     * Vistas pertenecientes al administrador local
     */
    public function index()
    {
        try {
            return view('dashboard.dashAdminLocal')->with('data',Aviso::all());// Mostrar avisos de sistema
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }

    public function promociones()
    {
        return view('dashboard.dashAdminLocal.promociones');
    }

    public function promocionesCrear()
    {
        return view('dashboard.dashAdminLocal.promocionesCrear')->with('respuesta',$this->respuesta);
    }

    public function mesas()
    {
        return view('dashboard.dashAdminLocal.mesas');
    }

    public function mesasCrear()
    {
        return view('dashboard.dashAdminLocal.mesasCrear')->with('respuesta',$this->respuesta);
    }

    public function items()
    {
        return view('dashboard.dashAdminLocal.items');
    }

    public function itemsCrear()
    {
        return view('dashboard.dashAdminLocal.itemsCrear')->with('respuesta',$this->respuesta);
    }

    public function reportes()
    {
        return view('dashboard.dashAdminLocal.reportes');
    }

    public function reporteItems()
    {
        return view('dashboard.dashAdminLocal.reporteItems');
    }

    public function reporteSemanal()
    {
        return view('dashboard.dashAdminLocal.reporteSemanal');
    }

    public function reporteMensual()
    {
        return view('dashboard.dashAdminLocal.reporteMensual');
    }

    public function reporteCuenta()
    {
        return view('dashboard.dashAdminLocal.reporteCuenta');
    }

    public function perfil()
    {
        try {
            $data=array();
            $data['user']=Auth::user();
            $data['respuesta'] = $this->respuesta;
            return view ('dashboard.dashAdminLocal.perfil')->with('data',$data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Crear promoción
     */
    public function createPromocion(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $admin->idLocal ]);// Obtener id del local comercial
            $validar = $request->validate([// Validar datos provenientes del formulario
                'idLocal' => 'required',
                'nombre' => 'required|string|max:50',
                'descripcion' => 'required|string|max:500',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $promocion=Promocion::create($validar);
            $imagen = time().'.'.request()->imagen->getClientOriginalExtension();
            request()->imagen->move(public_path('images/local'.$admin->idLocal.'/promocion'), $imagen);
            $promocion->imagen=$imagen;
            $promocion->update();
            $respuesta = 1;
            return view('dashboard.dashAdminLocal.promocionesCrear')->with('respuesta',$respuesta);// Redirigir a la vista con respuesta positiva
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminLocal.promocionesCrear')->with('respuesta',$respuesta);// Redirigir a la vista con respuesta negativa
        }
    }
    /*
     * Crear mesa
     */
    public function createMesa(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $admin->idLocal ]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'numero' => 'required|integer',
            ]);
            /*agregar imagen pendiente*/
            Mesa::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminLocal.mesasCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminLocal.mesasCrear')->with('respuesta',$respuesta);
        }
    }
    /*
     * Crear ítem
     */
    public function createItem(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $admin->idLocal ]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'nombre' => 'required|string|max:50',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',// Validar archivo de imagen
                'precio' => 'required|integer',
                'stock' => 'required|integer',
                'estado' => 'required|integer',
                'descripcion' => 'required|string|max:500',
            ]);
            $item=Item::create($validar);
            $imagen = time().'.'.request()->imagen->getClientOriginalExtension();
            request()->imagen->move(public_path('images/local'.$admin->idLocal.'/item'), $imagen);
            $item->imagen=$imagen;
            $item->update();
            $respuesta = 1;
            return view('dashboard.dashAdminLocal.itemsCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminLocal.itemsCrear')->with('respuesta',$respuesta);
        }
    }
    /*
     * Mostrar lista de promociones
     */
    public function showPromocion(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                    0 => 'id',    
                    1 => 'nombre',
                    2 => 'created_at'
                );
                //si vienen criterios de busqueda
                if(!empty($request->search['value'])){
                    $totalRegistros = Promocion::where('idLocal','like','%'.$admin->idLocal.'%')// Mostrar solo las pertenecientes al local
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Promocion::latest('created_at')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
                }else{
                    $totalRegistros = Promocion::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Promocion::latest('created_at')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
                }
                //agregamos los botones editar y eliminar
                foreach ($registros as $promociones) {
                    $promociones->parametros= '<a href="'.route('getOnePromocion', ['id64'=>base64_encode($promociones->id)]).'" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($promociones->id).'" data-url="'.route('destroyPromocion').'" data-ing="'.$promociones->nombre.'">Eliminar</buttom>';
                    $data[] = $promociones;
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
     * Mostrar lista de mesas
     */
    public function showMesa(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                    0 => 'id',    
                    1 => 'numero',
                    2 => 'created_at'
                );
                //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Mesa::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->where('numero','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Mesa::latest('created_at')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->where('numero','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Mesa::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Mesa::latest('created_at')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $mesa) {
                    $mesa->parametros= '<a href="'.route('getOneMesa', ['id64'=>base64_encode($mesa->id)]).'" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($mesa->id).'" data-url="'.route('destroyMesa').'" data-ing="'.$mesa->numero.'">Eliminar</buttom>';
                    $data[] = $mesa;
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
     * Mostrar lista de ítems
     */
    public function showItem(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                  0 => 'id',    
                  1 => 'nombre',
                  2 => 'stock'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Item::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Item::latest('created_at')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Item::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Item::latest('created_at')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $items) {
                    $items->parametros= '<a href="'.route('getOneItem', ['id64'=>base64_encode($items->id)]).'" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($items->id).'" data-url="'.route('destroyItem').'" data-ing="'.$items->nombre.'">Eliminar</buttom>';
                    $data[] = $items;
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
     * Reporte item
     */
    public function showReporteItem(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                  0 => 'id',    
                  1 => 'nombre',
                  2 => 'precio',
                  3 => 'stock'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Item::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Item::orderBy('stock','ASC')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Item::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Item::orderBy('stock','ASC')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $items) {
                    $items->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($items->id).'" data-url="#" data-ing="'.$items->nombre.'">Eliminar</buttom>';
                    $data[] = $items;
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
     * Reporte semanal
     */
    public function showReporteSemanal(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                    0 => 'id',
                    1 => 'idCliente',
                    2 => 'idUsuario',
                    3 => 'idMesa',    
                    4 => 'total',
                    5 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                   $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->where('created_at', '>', Carbon::now()->subDays(7)->toDateTimeString())
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Cuenta::latest('created_at')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->where('created_at', '>', Carbon::now()->subDays(7)->toDateTimeString())
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(7)->toDateTimeString())
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Cuenta::latest('created_at')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(7)->toDateTimeString())
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $cuenta) {
                    $cuenta->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($cuenta->id).'" data-url="#" data-ing="'.$cuenta->nombre.'">Eliminar</buttom>';
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
     * Reporte Mensual
     */
    public function showReporteMensual(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                    0 => 'id',
                    1 => 'idCliente',
                    2 => 'idUsuario',
                    3 => 'idMesa',    
                    4 => 'total',
                    5 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Cuenta::latest('created_at')
                                                ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Cuenta::latest('created_at')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $cuenta) {
                    $cuenta->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($cuenta->id).'" data-url="#" data-ing="'.$cuenta->nombre.'">Eliminar</buttom>';
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
     * Reporte Cuenta
     */
    public function showReporteCuenta(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
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
                    0 => 'id',
                    1 => 'idCliente',
                    2 => 'idUsuario',
                    3 => 'idMesa',    
                    4 => 'total',
                    5 => 'fecha'
                );
               //si vienen criterios de busqueda
               if(!empty($request->search['value'])){
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Cuenta::latest('total')
                                                ->where('idLocal','like','%'.$admin->idLocal.'%')	
                                                ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                ->offset($start)
                                                ->limit(10)
                                                ->get();
               }else{
                    $totalRegistros = Cuenta::where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Cuenta::latest('total')     
                                                    ->where('idLocal','like','%'.$admin->idLocal.'%')
                                                    ->where('created_at', '>', Carbon::now()->subDays(30)->toDateTimeString())
                                                    ->offset($start)
                                                    ->limit(10)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $cuenta) {
                    $cuenta->parametros= '<a href="#" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($cuenta->id).'" data-url="#" data-ing="'.$cuenta->nombre.'">Eliminar</buttom>';
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
            return "errro";
        }
    }
    /*
     * Enviar promoción a la vista de edición 
     */
    public function getOnePromocion(Request $request)
    {
        try {
            $promocion=Promocion::find(base64_decode($request->id64));
            $data=array();
            $data['promocion'] = $promocion;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Enviar mesa a la vista de edición
     */
    public function getOneMesa(Request $request)
    {
        try {
            $mesa=Mesa::find(base64_decode($request->id64));
            $data=array();
            $data['mesa'] = $mesa;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.mesasEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Enviar ítem a la vista de edición
     */
    public function getOneItem(Request $request)
    {
        try {
            $item=Item::find(base64_decode($request->id64));
            $data=array();
            $data['item'] = $item;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Editar promoción
     */
    public function editPromocion(Request $request)
    {
        try {
            $promocion=Promocion::find($request->id);
            $data=array();
            $data['promocion'] = $promocion;
            try {
                $Admin = Administrador_Local::where('id',Auth::user()->id)->first();
                $request->request->add(['idLocal' => $Admin->idLocal]);
                $validar = $request->validate([
                    'idLocal' => 'required',
                    'imagen' => 'required',
                    'nombre' => 'required|string|max:50',
                    'descripcion' => 'required|string|max:500',
                ]);
                $promocion->update($validar);
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
            } catch (\Throwable $th) {
                $data['respuesta'] = $this->respuesta = 0;
                return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Editar mesa
     */
    public function editMesa(Request $request)
    {
        try {
            $mesa=Mesa::find($request->id);
            $data=array();
            $data['mesa'] = $mesa;
            try {
                $Admin = Administrador_Local::where('id',Auth::user()->id)->first();
                $request->request->add(['idLocal' => $Admin->idLocal]);
                $validar = $request->validate([
                    'idLocal' => 'required',
                    'numero' => 'required',
                ]);
                $mesa->update($validar);
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashAdminLocal.mesasEditar')->with('data',$data);
            } catch (\Throwable $th) {
                $data['respuesta'] = $this->respuesta = 0;
                return view('dashboard.dashAdminLocal.mesasEditar')->with('data',$data);
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Editar ítem
     */
    public function editItem(Request $request)
    {
        try {
            $item=Item::find($request->id);
            $data=array();
            $data['item'] = $item;
            try {
                $Admin = Administrador_Local::where('id',Auth::user()->id)->first();
                $request->request->add(['idLocal' => $Admin->idLocal]);
                $validar = $request->validate([
                    'idLocal' => 'required',
                    'nombre' => 'required|string|max:50',
                    'imagen' => 'required',
                    'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'precio' => 'required|integer',
                    'stock' => 'required|integer',
                    'estado' => 'required|integer',
                    'descripcion' => 'required|string|max:500',
                ]);
                $item->update($validar);
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
            } catch (\Throwable $th) {
                $data['respuesta'] = $this->respuesta = 0;
                return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Eliminar promoción
     */
    public function destroyPromocion(Request $request)
    {
        try {
            $promocion=Promocion::find(base64_decode($request->id));
            $promocion->delete();
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Eliminar mesa
     */
    public function destroyMesa(Request $request)
    {
        try {
            $mesa=Mesa::find(base64_decode($request->id));
            $mesa->delete();
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Eliminar ítem
     */
    public function destroyItem(Request $request)
    {
        try {
            $item=Item::find(base64_decode($request->id));
            $item->delete();
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
                if((Hash::check($request->passwordActual, $user->password))){// Validar contraseña
                    $user->update($validar);
                    if($request->password!=''){
                        $user->password=Hash::make($request->password);
                        $user->update();
                    }
                    $data['respuesta'] = $this->respuesta = 1;
                    return view('dashboard.dashAdminLocal.perfil')->with('data',$data);
                }else{
                    $data['respuesta'] = $this->respuesta = 2;
                    return view('dashboard.dashAdminLocal.perfil')->with('data',$data);
                }
            } catch (\Throwable $th) {
                $data['respuesta'] = $this->respuesta = 0;
                return view('dashboard.dashAdminLocal.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
}
