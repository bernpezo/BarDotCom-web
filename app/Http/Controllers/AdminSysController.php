<?php

namespace App\Http\Controllers;

use App\Administrador_sistema;
use Illuminate\Http\Request;
use App\Local_comercial;
use App\Administrador_loca;
use App\Usuario_local;
use App\Aviso;

class AdminSysController extends Controller
{
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
        return view('dashboard.dashAdminSys.localesCrear');
    }

    public function localesEditar()
    {
        return view('dashboard.dashAdminSys.localesEditar');
    }

    public function administradores()
    {
        return view ('dashboard.dashAdminSys.administradores');
    }

    public function administradoresCrear()
    {
        return view ('dashboard.dashAdminSys.administradoresCrear');
    }

    public function administradoresEditar()
    {
        return view ('dashboard.dashAdminSys.administradoresEditar');
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
        return view ('dashboard.dashAdminSys.avisosCrear');
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
    public function createLocalComercial()
    {
        //
    }
    
    public function createAdministrador_local()
    {
        //
    }

    public function createUsuario_local()
    {
        //
    }

    public function createAviso()
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
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function showLocalComercial(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function showAdministradorLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function showUsuarioLocal(Administrador_sistema $administrador_sistema)
    {
        //
    }

    public function showAviso(Administrador_sistema $administrador_sistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function editLocalComercial(Administrador_sistema $administrador_sistema)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrador_sistema $administrador_sistema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function destroyLocalComercial(Administrador_sistema $administrador_sistema)
    {
        //
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
