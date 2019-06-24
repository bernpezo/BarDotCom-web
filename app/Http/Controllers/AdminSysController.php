<?php

namespace App\Http\Controllers;

use App\Administrador_sistema;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Local_comercial;
use App\Administrador_local;
use App\Usuario_local;
use App\Aviso;

class AdminSysController extends Controller
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
        return view('dashboard.dashAdminSys');
    }

    public function locales()
    {
        return view('dashboard.dashAdminSys.locales');
    }
    
    public function localesCrear()
    {
        return view('dashboard.dashAdminSys.localesCrear')->with('respuesta',$this->respuesta);
    }

    public function administradores()
    {
        return view ('dashboard.dashAdminSys.administradores');
    }

    public function administradoresCrear()
    {
        return view ('dashboard.dashAdminSys.administradoresCrear')->with('respuesta',$this->respuesta);
    }

    public function usuarios()
    {
        return view ('dashboard.dashAdminSys.usuarios');
    }

    public function usuariosCrear()
    {
        return view ('dashboard.dashAdminSys.usuariosCrear');
    }

    public function usuariosEditar()
    {
        return view ('dashboard.dashAdminSys.usuariosEditar');
    }

    public function avisos()
    {
        return view ('dashboard.dashAdminSys.avisos');
    }

    public function avisosCrear()
    {
        return view ('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$this->respuesta);
    }

    public function avisosEditar()
    {
        return view ('dashboard.dashAdminSys.avisosEditar');
    }

    public function perfil()
    {
        return view ('dashboard.dashAdminSys.perfil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLocalComercial(Request $request)
    {
        try {
            $Admin = Administrador_sistema::where('id',Auth::user()->id)->first();
            $request->request->add(['idAdmin' => $Admin->idAdmin]);
            $validar = $request->validate([
                'idAdmin' => 'required',
                'rut' => 'required',
                'nombre' => 'required',
                'direccion' => 'required',
                'comuna' => 'required',
                'rubro' => 'required',
                'logo' => 'required',
                'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required',
                'telefono' => 'required',
                'descripcion' => 'required',
            ]);
            /*agregar logo pendiente*/
            Local_comercial::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminSys.localesCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminSys.localesCrear')->with('respuesta',$respuesta);
        }
    }
    
    public function createAdministrador_local(Request $request)
    {
        try {
            $validar = $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'comuna' => 'required',
                'email' => 'required',
                'password' => 'required',
                'fechaNacimiento' => 'required',
                'telefono' => 'required',
            ]);
            $users=User::create($validar);
            $users->password=Hash::make($request->password);
            $users->update();
            $usuario=User::where('email',$users->email)->first();
            $administrador_local=new Administrador_local;
            $administrador_local->id=$usuario->id;
            $administrador_local->idLocal=$request->local;
            $administrador_local->save();
            $respuesta = 1;
            return view('dashboard.dashAdminSys.administradoresCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminSys.administradoresCrear')->with('respuesta',$respuesta);
        }
    }

    public function createUsuario_local()
    {
        //
    }

    public function createAviso(Request $request)
    {
        try {
            $Admin = Administrador_sistema::where('id',Auth::user()->id)->first();
            $request->request->add(['idAdmin' => $Admin->idAdmin]);
            $validar = $request->validate([
                'idAdmin' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            return "ok";
            Aviso::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$respuesta);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function showLocalComercial(Request $request)
    {
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
              2 => 'direccion'
            );
           //si vienen criterios de busqueda
           if(!empty($request->search['value'])){
                $totalRegistros = Local_comercial::where('nombre','like','%'.$request->search['value'].'%')
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = Local_comercial::latest('updated_at')	
                							->where('nombre','like','%'.$request->search['value'].'%')
                                            ->offset($start)
                                            ->limit($length)
                                            ->get();
           }else{
                $totalRegistros = Local_comercial::where('nombre','like','%'.$request->search['value'].'%')
                								->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                $registros = Local_comercial::latest('created_at')              													
                								->Where('nombre','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
           }
           //agregamos los botones html edit/delete
           foreach ($registros as $local_comercial) {
                $local_comercial->parametros= '<a href="'.route('getOneLocalComercial', ['id64'=>base64_encode($local_comercial->id)]).'" class="btn btn-info btn-actions btn-editar">
                <i class="fa fa-edit"></i>
            </a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($local_comercial->id).'" data-url="'.route('destroyLocalComercial').'" data-ing="'.$local_comercial->nombre.'">
                <i class="fa fa-remove"></i>
            </buttom>';
                $data[] = $local_comercial;
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

    public function showAdministradorLocal(Request $request)
    {
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
              1 => 'nombre'
            );
           //si vienen criterios de busqueda
           if(!empty($request->search['value'])){
                $totalRegistros = User::where('nombre','like','%'.$request->search['value'].'%')
                                            ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                            ->count();
                $registros = User::latest('updated_at')	
                							->where('nombre','like','%'.$request->search['value'].'%')
                                            ->offset($start)
                                            ->limit($length)
                                            ->get();
           }else{
                $totalRegistros = User::where('nombre','like','%'.$request->search['value'].'%')
                								->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                $registros = User::latest('created_at')              													
                								->Where('nombre','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
           }
           //agregamos los botones html edit/delete
           foreach ($registros as $administrador_local) {
                $administrador_local->parametros= '<a href="'.route('getOneAdministrador', ['id64'=>base64_encode($administrador_local->id)]).'" class="btn btn-info btn-actions btn-editar">
                <i class="fa fa-edit"></i>
            </a>
            <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($administrador_local->id).'" data-url="'.route('destroyAdministadorLocal').'" data-ing="'.$administrador_local->nombre.'">
                <i class="fa fa-remove"></i>
            </buttom>';
                $data[] = $administrador_local;
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

    public function showUsuarioLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function showAviso(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function getOneLocalComercial(Request $request)
    {
        try {
            $local_comercial=Local_comercial::find(base64_decode($request->id64));
            $data=array();
            $data['local_comercial'] = $local_comercial;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminSys.localesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function getOneAdministrador(Request $request)
    {
        try {
            $administrador_local=Administrador_local::find(base64_decode($request->id64));
            $data=array();
            $data['administrador_local'] = $administrador_local;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminSys.administradoresEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function editLocalComercial(Request $request)
    {
        try {
            $local_comercial=Local_comercial::find($request->id);
            $data=array();
            $data['local_comercial'] = $local_comercial;
            $Admin = Administrador_sistema::where('id',Auth::user()->id)->first();
            $request->request->add(['idAdmin' => $Admin->idAdmin]);
            $validar = $request->validate([
                'idAdmin' => 'required',
                'rut' => 'required',
                'nombre' => 'required',
                'direccion' => 'required',
                'comuna' => 'required',
                'rubro' => 'required',
                'logo' => 'required',
                'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required',
                'telefono' => 'required',
                'descripcion' => 'required',
            ]);
            $local_comercial->update($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashAdminSys.localesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            $data=array();
            $data['local_comercial'] = $local_comercial;
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminSys.localesEditar')->with('data',$data);
        }
    }

    public function editAdministradorLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function editUsuarioLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function editAviso(Administrador_sistema $administrador_sistema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function destroyLocalComercial(Request $request)
    {
        try {
            $local_comercial=Local_comercial::find(base64_decode($request->id));
            $local_comercial->delete();
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function destroyAdministadorLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function destroyUsuarioLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function destroyAviso(Administrador_sistema $administrador_sistema)
    {
        //
    }
}