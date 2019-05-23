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
Route::get('/', 'HomeController@index')->name('home');
