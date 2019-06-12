<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
