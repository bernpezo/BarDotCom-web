<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user=Auth::user();// Obtener usuario autenticado
        if(Cliente::find($user->id)!==null)// Verificar que tipo de usuario es y redirigir
        {
            return view ('dashboard.dashCliente');
        }
        if(Administrador_sistema::find($user->id)!==null)
        {
            return view ('dashboard.dashAdminSys');
        }
        if(Administrador_local::find($user->id)!==null)
        {
            return view ('dashboard.dashAdminLocal');
        }
        if(Usuario_local::find($user->id)!==null)
        {
            return view ('dashboard.dashUsuarioLocal');
        }
    }
    /*
     * Buscar comunas en BD para entregar a Select2
     */
    public function selectComuna(Request $request)
    {
        $term=$request->term ?: '';
        $comunas=Comuna::where('nombre', 'like', $term.'%')->limit(5)->get();
        $comunasEnviar=[];
        foreach ($comunas as $comuna)
        {
            $comunasEnviar[]=['id' => $comuna->id, 'text' => $comuna->nombre];
        }
        return \Response::json($comunasEnviar);
    }
    /*
     * Buscar rubros en BD para entregar a Select2
     */
    public function selectRubro(Request $request)
    {
        $term=$request->term ?: '';
        $rubros=Rubro::where('nombre', 'like', $term.'%')->limit(5)->get();
        $rubrosEnviar=[];
        foreach ($rubros as $rubro)
        {
            $rubrosEnviar[]=['id' => $rubro->id, 'text' => $rubro->nombre];
        }
        return \Response::json($rubrosEnviar);
    }
    /*
     * Buscar locales en BD para entregar a Select2
     */
    public function selectLocal(Request $request)
    {
        $term=$request->term ?: '';
        $local_comercial=Local_comercial::where('nombre', 'like', $term.'%')->limit(5)->get();
        $localesEnviar=[];
        foreach ($local_comercial as $local)
        {
            $localesEnviar[]=['id' => $local->id, 'text' => $local->nombre];
        }
        return \Response::json($localesEnviar);
    }
}
