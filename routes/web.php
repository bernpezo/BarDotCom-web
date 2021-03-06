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
Route::get('selectComunaPre', 'HomeController@selectComunaPre')->name('selectComunaPre');
Route::post('selectRubro', 'HomeController@selectRubro')->name('selectRubro');
Route::get('selectRubroPre', 'HomeController@selectRubroPre')->name('selectRubroPre');
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
Route::get('detalleLocal', 'ClienteController@detalleLocal')->name('detalleLocal');
Route::get('revisarCarta', 'ClienteController@revisarCarta')->name('revisarCarta');
Route::get('detalleItem', 'ClienteController@detalleItem')->name('detalleItem');
Route::post('hacerPedido', 'ClienteController@hacerPedido')->name('hacerPedido');
Route::get('verCuenta', 'ClienteController@verCuenta')->name('verCuenta');
Route::get('pedirCuenta', 'ClienteController@pedirCuenta')->name('pedirCuenta');
/*
 * Rutas AdminSys
 */
Route::get('dashAdminSys', 'AdminSysController@index')->name('dashAdminSys');
/*
 * Rutas AdminLocal
 */
Route::get('dashAdminLocal', 'AdminLocalController@index')->name('dashAdminLocal');
/*
 * Rutas UsuarioLocal
 */
Route::get('dashUsuarioLocal', 'UsuarioLocalController@index')->name('dashUsuarioLocal');
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
/*
 * CRUD promociones
 */
Route::get('dashAdminLocalPromociones', 'AdminLocalController@promociones')->name('dashAdminLocalPromociones');
Route::get('promocionesCrear', 'AdminLocalController@promocionesCrear')->name('promocionesCrear');
Route::post('createPromocion', 'AdminLocalController@createPromocion')->name('createPromocion');
Route::post('showPromocion', 'AdminLocalController@showPromocion')->name('showPromocion');
Route::get('getOnePromocion', 'AdminLocalController@getOnePromocion')->name('getOnePromocion');
Route::post('editPromocion', 'AdminLocalController@editPromocion')->name('editPromocion');
Route::post('destroyPromocion', 'AdminLocalController@destroyPromocion')->name('destroyPromocion');
/*
 * CRUD mesas
 */
Route::get('dashAdminLocalMesas', 'AdminLocalController@mesas')->name('dashAdminLocalMesas');
Route::get('mesasCrear', 'AdminLocalController@mesasCrear')->name('mesasCrear');
Route::post('createMesa', 'AdminLocalController@createMesa')->name('createMesa');
Route::post('showMesa', 'AdminLocalController@showMesa')->name('showMesa');
Route::get('getOneMesa', 'AdminLocalController@getOneMesa')->name('getOneMesa');
Route::post('editMesa', 'AdminLocalController@editMesa')->name('editMesa');
Route::post('destroyMesa', 'AdminLocalController@destroyMesa')->name('destroyMesa');
/*
 * CRUD items
 */
Route::get('dashAdminLocalItems', 'AdminLocalController@items')->name('dashAdminLocalItems');
Route::get('itemsCrear', 'AdminLocalController@itemsCrear')->name('itemsCrear');
Route::post('createItem', 'AdminLocalController@createItem')->name('createItem');
Route::post('showItem', 'AdminLocalController@showItem')->name('showItem');
Route::get('getOneItem', 'AdminLocalController@getOneItem')->name('getOneItem');
Route::post('editItem', 'AdminLocalController@editItem')->name('editItem');
Route::post('destroyItem', 'AdminLocalController@destroyItem')->name('destroyItem');
/*
 * Gestores registro pedido y cuenta
 */
Route::get('registrarCliente', 'UsuarioLocalController@registrarCliente')->name('registrarCliente');
Route::post('registrarNFC', 'UsuarioLocalController@registrarNFC')->name('registrarNFC');
Route::post('showPedidosPendientes', 'UsuarioLocalController@showPedidosPendientes')->name('showPedidosPendientes');
Route::get('entregarPedido', 'UsuarioLocalController@entregarPedido')->name('entregarPedido');
Route::post('destroyPedido', 'UsuarioLocalController@destroyPedido')->name('destroyPedido');
Route::post('showCuentasPendientes', 'UsuarioLocalController@showCuentasPendientes')->name('showCuentasPendientes');
Route::get('entregarCuenta', 'UsuarioLocalController@entregarCuenta')->name('entregarCuenta');
Route::post('destroyCuenta', 'UsuarioLocalController@destroyCuenta')->name('destroyCuenta');
/*
 * Historial pedido y cuenta
 */
Route::get('pedidosEntregados', 'UsuarioLocalController@pedidosEntregados')->name('pedidosEntregados');
Route::post('showPedidosEntregados', 'UsuarioLocalController@showPedidosEntregados')->name('showPedidosEntregados');
Route::get('cuentasEntregadas', 'UsuarioLocalController@cuentasEntregadas')->name('cuentasEntregadas');
Route::post('showCuentasEntregadas', 'UsuarioLocalController@showCuentasEntregadas')->name('showCuentasEntregadas');
/*
 * Reportes
 */
Route::get('reportes', 'AdminLocalController@reportes')->name('reportes');
Route::get('reporteItems', 'AdminLocalController@reporteItems')->name('reporteItems');
Route::post('showReporteItem', 'AdminLocalController@showReporteItem')->name('showReporteItem');
Route::get('reporteSemanal', 'AdminLocalController@reporteSemanal')->name('reporteSemanal');
Route::post('showReporteSemanal', 'AdminLocalController@showReporteSemanal')->name('showReporteSemanal');
Route::get('reporteMensual', 'AdminLocalController@reporteMensual')->name('reporteMensual');
Route::post('showReporteMensual', 'AdminLocalController@showReporteMensual')->name('showReporteMensual');
Route::get('reporteCuenta', 'AdminLocalController@reporteCuenta')->name('reporteCuenta');
Route::post('showReporteCuenta', 'AdminLocalController@showReporteCuenta')->name('showReporteCuenta');
/*
 * Perfil
 */
Route::get('dashAdminSysperfil', 'AdminSysController@perfil')->name('dashAdminSysperfil');
Route::get('dashAdminLocalperfil', 'AdminLocalController@perfil')->name('dashAdminLocalperfil');
Route::get('dashClienteperfil', 'ClienteController@perfil')->name('dashClienteperfil');
Route::get('dashUsuarioLocalperfil', 'UsuarioLocalController@perfil')->name('dashUsuarioLocalperfil');
Route::post('AdminSyseditPerfil', 'AdminSysController@editPerfil')->name('AdminSyseditPerfil');
Route::post('AdminLocaleditPerfil', 'AdminLocalController@editPerfil')->name('AdminLocaleditPerfil');
Route::post('UsuarioLocaleditPerfil', 'UsuarioLocalController@editPerfil')->name('UsuarioLocaleditPerfil');
Route::post('ClienteeditPerfil', 'ClienteController@editPerfil')->name('ClienteeditPerfil');
Route::post('ClienteeliminarCuenta', 'ClienteController@eliminarCuenta')->name('ClienteeliminarCuenta');