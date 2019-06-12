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
Route::get('dashAdminSysadministradores', 'AdminSysController@administradores')->name('dashAdminSysadministradores');
Route::get('dashAdminSysusuarios', 'AdminSysController@usuarios')->name('dashAdminSysusuarios');
Route::get('dashAdminSysavisos', 'AdminSysController@avisos')->name('dashAdminSysavisos');
Route::get('dashAdminSysreportes', 'AdminSysController@reportes')->name('dashAdminSysreportes');
Route::get('dashAdminSysperfil', 'AdminSysController@perfil')->name('dashAdminSysperfil');