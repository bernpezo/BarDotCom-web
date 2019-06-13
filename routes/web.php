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
Route::get('dashAdminSyslocales', 'AdminSysController@locales')->name('dashAdminSyslocales');
Route::post('dashAdminSyslocalesCrear', 'AdminSysController@localesCrear')->name('dashAdminSyslocalesCrear');
Route::post('dashAdminsSyslocalesEditar', 'AdminSysController@localesEditar')->name('dashAdminSyslocalesEditar');
Route::get('dashAdminSysadministradores', 'AdminSysController@administradores')->name('dashAdminSysadministradores');
Route::post('dashAdminSysadministradoresCrear', 'AdminSysController@administradoresCrear')->name('dashAdminSysadministradoresCrear');
Route::post('dashAdminSysadministradoresEditar', 'AdminSysController@administradoresEditar')->name('dashAdminSysadministradoresEditar');
Route::get('dashAdminSysusuarios', 'AdminSysController@usuarios')->name('dashAdminSysusuarios');
Route::post('dashAdminSysusuariosCrear', 'AdminSysController@usuariosCrear')->name('dashAdminSysusuariosCrear');
Route::post('dashAdminSysusuariosEditar', 'AdminSysController@usuariosEditar')->name('dashAdminSysusuariosEditar');
Route::get('dashAdminSysavisos', 'AdminSysController@avisos')->name('dashAdminSysavisos');
Route::post('dashAdminSysavisosCrear', 'AdminSysController@avisosCrear')->name('dashAdminSysavisosCrear');
Route::post('dashAdminSysavisosEditar', 'AdminSysController@avisosEditar')->name('dashAdminSysavisosEditar');
Route::get('dashAdminSysperfil', 'AdminSysController@perfil')->name('dashAdminSysperfil');