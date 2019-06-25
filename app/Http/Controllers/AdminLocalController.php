<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Administrador_local;
use App\Promocion;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
