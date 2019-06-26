<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario_local;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
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
