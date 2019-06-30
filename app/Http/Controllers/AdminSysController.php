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
    private $respuesta = -1;// Variable para generar respuestas
    /*
     * Validar si el usuario está autenticado como administrador de sistema
     */
    public function __construct()
    {
        $this->middleware(function($request,$next)
        {
            try {
                $user=Auth::user();
                if(Administrador_sistema::find($user->id)==null)
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
     * Vistas pertenecientes al administrador de sistema
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

    public function avisos()
    {
        return view ('dashboard.dashAdminSys.avisos');
    }

    public function avisosCrear()
    {
        return view ('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$this->respuesta);
    }

    public function perfil()
    {
        $data=array();
        $data['user']=Auth::user();
        $data['respuesta'] = $this->respuesta;
        return view ('dashboard.dashAdminSys.perfil')->with('data',$data);
    }
    /*
     * Crear local
     */
    public function createLocalComercial(Request $request)
    {
        try {
            $Admin = Administrador_sistema::where('id',Auth::user()->id)->first();
            $request->request->add(['idAdmin' => $Admin->idAdmin]);// Obtener id del administrador
            $validar = $request->validate([// Validar datos provenientes del formulario
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
            $local_comercial=Local_comercial::create($validar);
            $logo = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('images/local'.$local_comercial->id), $logo);
            $local_comercial->logo=$logo;
            $local_comercial->update();
            //Crear Administrador de local
            $datosAdmin=[
                'nombre' => 'Administrador',
                'comuna' => ''.$local_comercial->comuna.'',
                'email' => ''.$local_comercial->email.'',
                'password' => ''.Hash::make($local_comercial->nombre).'',
            ];
            $admin=User::create($datosAdmin);
            $usuario=User::where('email',$admin->email)->first();
            $administrador_local=new Administrador_local;
            $administrador_local->id=$usuario->id;
            $administrador_local->idLocal=$local_comercial->id;
            $administrador_local->save();
            //Crear 5 usuarios de local
            for ($i=0; $i < 5; $i++) { 
                $datosUsuario=[
                    'nombre' => 'Usuario'.$i.'',
                    'comuna' => ''.$local_comercial->comuna.'',
                    'email' => ''.$i.'.'.$local_comercial->email.'',
                    'password' => ''.Hash::make($local_comercial->nombre).'',
                ];
                $users=User::create($datosUsuario);
                $usuario=User::where('email',$users->email)->first();
                $usuarioLocal=new Usuario_local;
                $usuarioLocal->id=$usuario->id;
                $usuarioLocal->idLocal=$local_comercial->id;
                $usuarioLocal->save();
            }
            $respuesta = 1;
            return view('dashboard.dashAdminSys.localesCrear')->with('respuesta',$respuesta);// Redirigir a la vista con respuesta positiva
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminSys.localesCrear')->with('respuesta',$respuesta);// Redirigir a la vista con respuesta negativa
        }
    }
    /*
     * Crear aviso
     */
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
            Aviso::create($validar);
            $respuesta = 1;
            return view('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$respuesta);
        } catch (\Throwable $th) {
            $respuesta = 0;
            return view('dashboard.dashAdminSys.avisosCrear')->with('respuesta',$respuesta);
        }
    }
    /*
     * Mostrar lista de locales comerciales
     */
    public function showLocalComercial(Request $request)
    {
        try {
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
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Local_comercial::latest('updated_at')	
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
                }else{
                    $totalRegistros = Local_comercial::where('nombre','like','%'.$request->search['value'].'%')
                                                    ->orWhere('id','like','%'.$request->search['value'].'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Local_comercial::latest('created_at')              													
                                                    ->Where('nombre','like','%'.$request->search['value'].'%')
                                                    ->orWhere('id','like','%'.$request->search['value'].'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
                }
                //agregamos los botones editar y eliminar
                foreach ($registros as $local_comercial) {
                    $local_comercial->parametros= '<a href="'.route('getOneLocalComercial', ['id64'=>base64_encode($local_comercial->id)]).'" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($local_comercial->id).'" data-url="'.route('destroyLocalComercial').'" data-ing="'.$local_comercial->nombre.'">Eliminar</buttom>';
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
        } catch (\Throwable $th) {
            return "error";
        }
    }
    /*
     * Mostrar lista de avisos
     */
    public function showAviso(Request $request)
    {
        try {
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
                    $totalRegistros = Aviso::where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                ->count();
                    $registros = Aviso::latest('created_at')	
                                                ->where('nombre','like','%'.$request->search['value'].'%')
                                                ->orWhere('id','like','%'.$request->search['value'].'%')
                                                ->offset($start)
                                                ->limit($length)
                                                ->get();
               }else{
                    $totalRegistros = Aviso::where('nombre','like','%'.$request->search['value'].'%')
                                                    ->orWhere('id','like','%'.$request->search['value'].'%')
                                                    ->orderBy($columns[$order[0]['column']],$order[0]['dir'])
                                                    ->count();
                    $registros = Aviso::latest('created_at')              													
                                                    ->Where('nombre','like','%'.$request->search['value'].'%')
                                                    ->orWhere('id','like','%'.$request->search['value'].'%')
                                                    ->offset($start)
                                                    ->limit($length)
                                                    ->get();
               }
               //agregamos los botones html edit/delete
               foreach ($registros as $avisos) {
                    $avisos->parametros= '<a href="'.route('getOneAviso', ['id64'=>base64_encode($avisos->id)]).'" class="btn btn-success btn-actions btn-editar">Editar</a>
                <buttom class="btn btn-danger btn-actions btn-eliminar" data-id="'.base64_encode($avisos->id).'" data-url="'.route('destroyAviso').'" data-ing="'.$avisos->nombre.'">Eliminar</buttom>';
                    $data[] = $avisos;
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
            return "error";
        }
    }
    /*
     * Enviar local comercial a la vista de edición
     */
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
    /*
     * Enviar aviso a la vista de edición
     */
    public function getOneAviso(Request $request)
    {
        try {
            $avisos=Aviso::find(base64_decode($request->id64));
            $data=array();
            $data['avisos'] = $avisos;
            $data['respuesta'] = $this->respuesta;
            return view('dashboard.dashAdminSys.avisosEditar')->with('data',$data);
        } catch (\Throwable $th) {
            return "error";
        }
    }
    /*
     * Editar local comercial
     */
    public function editLocalComercial(Request $request)
    {
        $local_comercial=Local_comercial::find($request->id);
        $data=array();
        $data['local_comercial'] = $local_comercial;
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
            $local_comercial->update($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashAdminSys.localesEditar')->with('data',$data);
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminSys.localesEditar')->with('data',$data);
        }
    }
    /*
     * Editar aviso
     */
    public function editAviso(Request $request)
    {
        $avisos=Aviso::find($request->id);
        $data=array();
        $data['avisos'] = $avisos;
        try {
            $Admin = Administrador_sistema::where('id',Auth::user()->id)->first();
            $request->request->add(['idAdmin' => $Admin->idAdmin]);
            $validar = $request->validate([
                'idAdmin' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            $avisos->update($validar);
            $data['respuesta'] = $this->respuesta = 1;
            return view('dashboard.dashAdminSys.avisosEditar')->with('data',$data);
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminSys.avisosEditar')->with('data',$data);
        }
    }
    /*
     * Eliminar local comercial
     */
    public function destroyLocalComercial(Request $request)
    {
        try {
            $usuario_local=Usuario_local::where('idLocal',base64_decode($request->id))->delete();
            $admin_local=Administrador_local::where('idLocal',base64_decode($request->id))->delete();
            $local_comercial=Local_comercial::where('id',base64_decode($request->id))->delete();
        } catch (\Throwable $th) {
            return "error";
        }
    }
    /*
     * Eliminar aviso
     */
    public function destroyAviso(Request $request)
    {
        try {
            $avisos=Aviso::find(base64_decode($request->id));
            $avisos->delete();
        } catch (\Throwable $th) {
            return "error";
        }
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
                'telefono' => 'required|integer',
                'email' => 'required|string|email|max:255',
                'passwordActual' => 'required|string|min:8',
            ]);
            if((Hash::check($request->passwordActual, $user->password))){// Validar contraseña
                $user->update($validar);
                if($request->password!=''){
                    $user->password=Hash::make($request->password);
                    $user->update();
                }
                $data['respuesta'] = $this->respuesta = 1;
                return view('dashboard.dashAdminSys.perfil')->with('data',$data);
            }else{
                $data['respuesta'] = $this->respuesta = 2;
                return view('dashboard.dashAdminSys.perfil')->with('data',$data);
            }
        } catch (\Throwable $th) {
            $data['respuesta'] = $this->respuesta = 0;
            return view('dashboard.dashAdminSys.perfil')->with('data',$data);
        }
    }
}
