<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comuna;
use App\Rubro;
use App\User;
use App\Cliente;
use App\Administrador_sistema;

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

    public function miPanel()
    {
        $user=Auth::user();
        $cliente=Cliente::find($user->id);
        $adminsys=Administrador_sistema::find($user->id);
        if($cliente!==null)
        {
            return view ('dashboard.dashCliente');
        }
        if($adminsys!==null)
        {
            return view ('dashboard.dashAdminSys');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
}
