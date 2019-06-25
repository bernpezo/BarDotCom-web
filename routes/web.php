<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
 * Rutas control de sesión
 */
Auth::routes();
/*
 * Rutas generales
 */
Route::post('selectComuna', 'HomeController@selectComuna')->name('selectComuna');
Route::post('selectRubro', 'HomeController@selectRubro')->name('selectRubro');
Route::post('selectLocal', 'HomeController@selectLocal')->name('selectLocal');
/*
 * Ruta vista inicio
 */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/fromHome', 'HomeController@miPanel')->name('miPanel');
/*
 * Rutas cliente
 */
Route::get('dashCliente', 'ClienteController@index')->name('dashCliente');

Route::get('dashClienteperfil', 'ClienteController@perfil')->name('dashClienteperfil');
/*
 * Rutas AdminSys
 */
Route::get('dashAdminSys', 'AdminSysController@index')->name('dashAdminSys');
/*
 * Rutas AdminLocal
 */
Route::get('dashAdminLocal', 'AdminLocalController@index')->name('dashAdminLocal');
/*
 * CRUD local comercial
 */
Route::get('dashAdminSyslocales', 'AdminSysController@locales')->name('dashAdminSyslocales');
Route::get('dashAdminSyslocalesCrear', 'AdminSysController@localesCrear')->name('dashAdminSyslocalesCrear');
Route::post('createLocalComercial', 'AdminSysController@createLocalComercial')->name('createLocalComercial');
Route::post('dashAdminsSyslocalesEditar', 'AdminSysController@localesEditar')->name('dashAdminSyslocalesEditar');
Route::post('showLocalComercial', 'AdminSysController@showLocalComercial')->name('showLocalComercial');
Route::get('getOneLocalComercial', 'AdminSysController@getOneLocalComercial')->name('getOneLocalComercial');
Route::post('editLocalComercial', 'AdminSysController@editLocalComercial')->name('editLocalComercial');
Route::post('destroyLocalComercial', 'AdminSysController@destroyLocalComercial')->name('destroyLocalComercial');
/*
 * CRUD avisos
 */
Route::get('dashAdminSysavisos', 'AdminSysController@avisos')->name('dashAdminSysavisos');
Route::get('dashAdminSysavisosCrear', 'AdminSysController@avisosCrear')->name('dashAdminSysavisosCrear');
Route::post('createAviso', 'AdminSysController@createAviso')->name('createAviso');
Route::post('showAviso', 'AdminSysController@showAviso')->name('showAviso');
Route::get('getOneAviso', 'AdminSysController@getOneAviso')->name('getOneAviso');
Route::post('editAviso', 'AdminSysController@editAviso')->name('editAviso');
Route::post('destroyAviso', 'AdminSysController@destroyAviso')->name('destroyAviso');
Route::post('dashAdminSysavisosEditar', 'AdminSysController@avisosEditar')->name('dashAdminSysavisosEditar');
/*
 * CRUD promociones
 */
Route::get('dashAdminLocalPromociones', 'AdminLocalController@promociones')->name('dashAdminLocalPromociones');
Route::get('promocionesCrear', 'AdminLocalController@promocionesCrear')->name('promocionesCrear');
/*
 * Perfil
 */
Route::get('dashAdminSysperfil', 'AdminSysController@perfil')->name('dashAdminSysperfil');
Route::post('editPerfil', 'AdminSysController@editPerfil')->name('editPerfil');