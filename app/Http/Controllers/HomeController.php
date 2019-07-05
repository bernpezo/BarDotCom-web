<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Aviso;
use App\Comuna;
use App\Rubro;
use App\User;
use App\Cliente;
use App\Administrador_sistema;
use App\Administrador_local;
use App\Local_comercial;
use App\Usuario_local;

class HomeController extends Controller
{
    private $respuesta = -1;// Variable para generar respuestas
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /*
     * Método para boton "Mi Panel" que redirige a cada usuario a su respectivo panel
     */
    public function miPanel()
    {
        try {
            $user=Auth::user();// Obtener usuario autenticado
            if($user!==null){
                if(Administrador_sistema::find($user->id)!==null)// Verificar que tipo de usuario es y redirigir
                {
                    return view ('dashboard.dashAdminSys');
                }   
                if(Administrador_local::find($user->id)!==null)
                {
                    return view ('dashboard.dashAdminLocal')->with('data',Aviso::all());// Mostrar avisos de sistema
                }
                if(Usuario_local::find($user->id)!==null)
                {
                    return view ('dashboard.dashUsuarioLocal')->with('respuesta',$this->respuesta);
                }
                else
                {
                    return view ('dashboard.dashCliente')->with('data',Local_comercial::all());// Mostrar locales
                }
            }else{
                return view ('home');
            }
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Buscar comunas en BD para entregar a Select2
     */
    public function selectComuna(Request $request)
    {
        try {
            $term=$request->term ?: '';
            $comunas=Comuna::where('nombre', 'like', $term.'%')->limit(5)->get();
            $comunasEnviar=[];
            foreach ($comunas as $comuna)
            {
                $comunasEnviar[]=['id' => $comuna->id, 'text' => $comuna->nombre];
            }
            return \Response::json($comunasEnviar);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Buscar comunas en BD para entregar a Select2 preseleccionado
     */
    public function selectComunaPre(Request $request)
    {
        try {
            $comuna=Comuna::find($request->id);
            return $comuna;
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Buscar rubros en BD para entregar a Select2
     */
    public function selectRubro(Request $request)
    {
        try {
            $term=$request->term ?: '';
            $rubros=Rubro::where('nombre', 'like', $term.'%')->limit(5)->get();
            $rubrosEnviar=[];
            foreach ($rubros as $rubro)
            {
                $rubrosEnviar[]=['id' => $rubro->id, 'text' => $rubro->nombre];
            }
            return \Response::json($rubrosEnviar);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Buscar rubros en BD para entregar a Select2 preseleccionado
     */
    public function selectRubroPre(Request $request)
    {
        try {
            $rubro=Rubro::find($request->id);
            return $rubro;
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
    }
    /*
     * Buscar locales en BD para entregar a Select2
     */
    public function selectLocal(Request $request)
    {
        try {
            $term=$request->term ?: '';
            $local_comercial=Local_comercial::where('nombre', 'like', $term.'%')->limit(5)->get();
            $localesEnviar=[];
            foreach ($local_comercial as $local)
            {
                $localesEnviar[]=['id' => $local->id, 'text' => $local->nombre];
            }
            return \Response::json($localesEnviar);
        } catch (\Throwable $th) {
            return view('layouts.error')->with('th',$th);
        }
        
    }
}
