<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Administrador_local;
use App\Promocion;
use App\Mesa;
use App\Item;

class AdminLocalController extends Controller
{
    private $respuesta = -1;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashAdminLocal');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPromocion(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $admin->idLocal ]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            /*agregar imagen pendiente*/
            Promocion::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminLocal.promocionesCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminLocal.promocionesCrear')->with('respuesta',$respuesta);
        }
    }

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

    public function createItem(Request $request)
    {
        try {
            $admin = Administrador_local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $admin->idLocal ]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'nombre' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'precio' => 'required|integer',
                'stock' => 'required|integer',
                'estado' => 'required|integer',
                'descripcion' => 'required',
            ]);
            /*agregar imagen pendiente*/
            Item::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminLocal.itemsCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminLocal.itemsCrear')->with('respuesta',$respuesta);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPromocion(Request $request)
    {
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
                $totalRegistros = Promocion::where('idLocal','like','%'.$admin->idLocal.'%')
                                            ->where('nombre','like','%'.$request->search['value'].'%')
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Promocion::latest('created_at')
                                            ->where('idLocal','like','%'.$admin->idLocal.'%')	
                							->where('nombre','like','%'.$request->search['value'].'%')
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
           //agregamos los botones html edit/delete
           foreach ($registros as $promociones) {
                $promociones->parametros= '<a href="'.route('getOnePromocion', ['id64'=>base64_encode($promociones->id)]).'" class="btn btn-info btn-actions btn-editar">
                <i class="fa fa-edit"></i>
            </a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($promociones->id).'" data-url="'.route('destroyPromocion').'" data-ing="'.$promociones->nombre.'">
                <i class="fa fa-remove"></i>
            </buttom>';
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
    }

    public function showMesa(Request $request)
    {
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
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Mesa::latest('created_at')
                                            ->where('idLocal','like','%'.$admin->idLocal.'%')	
                							->where('numero','like','%'.$request->search['value'].'%')
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
                $mesa->parametros= '<a href="'.route('getOneMesa', ['id64'=>base64_encode($mesa->id)]).'" class="btn btn-info btn-actions btn-editar">
                <i class="fa fa-edit"></i>
            </a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($mesa->id).'" data-url="'.route('destroyMesa').'" data-ing="'.$mesa->numero.'">
                <i class="fa fa-remove"></i>
            </buttom>';
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
    }

    public function showItem(Request $request)
    {
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
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Item::latest('created_at')
                                            ->where('idLocal','like','%'.$admin->idLocal.'%')	
                							->where('nombre','like','%'.$request->search['value'].'%')
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
                $items->parametros= '<a href="'.route('getOneItem', ['id64'=>base64_encode($items->id)]).'" class="btn btn-info btn-actions btn-editar">
                <i class="fa fa-edit"></i>
            </a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($items->id).'" data-url="'.route('destroyItem').'" data-ing="'.$items->nombre.'">
                <i class="fa fa-remove"></i>
            </buttom>';
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
    }

    public function getOnePromocion(Request $request)
    {
        try {
            $promocion=Promocion::find(base64_decode($request->id64));
            $data=array();
            $data['promocion'] = $promocion;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function getOneMesa(Request $request)
    {
        try {
            $mesa=Mesa::find(base64_decode($request->id64));
            $data=array();
            $data['mesa'] = $mesa;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.mesasEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function getOneItem(Request $request)
    {
        try {
            $item=Item::find(base64_decode($request->id64));
            $data=array();
            $data['item'] = $item;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPromocion(Request $request)
    {
        $promocion=Promocion::find($request->id);
        $data=array();
        $data['promocion'] = $promocion;
        try {
            $Admin = Administrador_Local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $Admin->idLocal]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'imagen' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            $promocion->update($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminLocal.promocionesEditar')->with('data',$data);
        }
    }

    public function editMesa(Request $request)
    {
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
    }

    public function editItem(Request $request)
    {
        $item=Item::find($request->id);
        $data=array();
        $data['item'] = $item;
        try {
            $Admin = Administrador_Local::where('id',Auth::user()->id)->first();
            $request->request->add(['idLocal' => $Admin->idLocal]);
            $validar = $request->validate([
                'idLocal' => 'required',
                'nombre' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'precio' => 'required|integer',
                'stock' => 'required|integer',
                'estado' => 'required|integer',
                'descripcion' => 'required',
            ]);
            $item->update($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminLocal.itemsEditar')->with('data',$data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPromocion(Request $request)
    {
        try {
            $promocion=Promocion::find(base64_decode($request->id));
            $promocion->delete();
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function destroyMesa(Request $request)
    {
        try {
            $mesa=Mesa::find(base64_decode($request->id));
            $mesa->delete();
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function destroyItem(Request $request)
    {
        try {
            $item=Item::find(base64_decode($request->id));
            $item->delete();
        } catch (\Throwable $th) {
            return "error";
        }
    }
}
