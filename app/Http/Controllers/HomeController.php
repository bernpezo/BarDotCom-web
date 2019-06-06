<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cliente;

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
        if($cliente!==null)
        {
            return view('dashboard/dashCliente');
        }
    }
}
