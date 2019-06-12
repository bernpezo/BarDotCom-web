<?php

namespace App\Http\Controllers;

use App\Administrador_sistema;
use Illuminate\Http\Request;

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

    public function administradores()
    {
        return view ('dashboard.dashAdminSys.administradores');
    }

    public function usuarios()
    {
        return view ('dashboard.dashAdminSys.usuarios');
    }

    public function avisos()
    {
        return view ('dashboard.dashAdminSys.avisos');
    }

    public function reportes()
    {
        return view ('dashboard.dashAdminSys.reportes');
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
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador_sistema $administrador_sistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador_sistema  $administrador_sistema
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador_sistema $administrador_sistema)
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
    public function destroy(Administrador_sistema $administrador_sistema)
    {
        //
    }
}
