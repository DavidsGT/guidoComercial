<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});
//hecho por @DAVIDS

// rutas para ejecutar el crud
route::resource('almacen/categoria','CategoriaController');
route::resource('almacen/articulo','ArticuloController');
route::resource('almacen/stockmin','ArticuloController@indexstock');
route::resource('ventas/cliente','ClienteController');
route::resource('entidades/contribuyente','ContribuyenteController');
route::resource('ventas/empleado','EmpleadoController');
route::resource('compras/proveedor','ProveedorController');
route::resource('compras/ingreso','IngresoController');
route::resource('compras/devoluciones','DevolucionControl');
route::resource('ventas/devoluciones','DeventasControl');
route::get('compras/devoluciones/create/{ing}','DevolucionControl@create');
route::get('ventas/devoluciones/create/{ing}','DeventasControl@create');
route::resource('ventas/apertura','CajaControl');
route::get('compras/devoluciones/show/{ing}','DocumentoControl@store');
//route::get('compras/devoluciones/','DocumentoControl@store');
route::resource('ventas/venta','VentasController');
route::resource('ventas/factura','FacturaController');
route::resource('seguridad/usuario','UsuarioController');
route::resource('seguridad/perfil','PerfilControl');
route::resource('entidades/bancos','BancosController');
route::resource('contabilidad/ordencp','OrdencpController');
route::resource('control/menu','MenuControl');
route::resource('contabilidad/inventario','InventarioControl');
route::get('contabilidad/ordencp/create/{ing}','OrdencpController@create');
route::get('contabilidad/ordencp/show/{ing}','OrdencpController@show');
route::get('contabilidad/inventario/show/{id}','InventarioControl@show');
route::get('reportes/contenedor1/','PdfController@conte1');
route::get('reportes/ventas/','rptVentasController@indexVenta');
route::get('reportes/kardex/','RptKardexController@index');
route::get('entidades/contribuyente/','ContribuyenteController@index');
route::get('reportes/contenedor2/','PdfController@conte2');
route::get('reportes/clientes/rptfactura/{ven} ','PdfController@getPDFPR');
route::get('reportes/clientes/rptcompegreso/{ing} ','DocumentoControl@rptce');
route::get('reportes/clientes/reportecompra','PdfController@getPDFC');
route::resource('control/inicio','UsuarioController@inicio');
Route::auth();
route::get('ventas/venta/codigo/{cod}', 'VentasController@codigovendedor');
route::get('compras/ingreso/codigo/{cod}', 'VentasController@codigovendedor');
route::get('ventas/empleado/codigo/{cod}', 'EmpleadoController@codigoexistente');
Route::post('/reportes/clientes/reportecliente', ['as' => 'date','uses' => 'PdfController@getPDFV', 
                            function () {
                                return '';
                            }]);
Route::post('/reportes/clientes/reportecompra', ['as' => 'date','uses' => 'PdfController@getPDFC', 
                            function () {
                                return '';
                            }]);

Route::post('/reportes/clientes/reportebitacora', ['as' => 'date','uses' => 'PdfController@getPDFBI', 
                            function () {
                                return '';
                            }]);

Route::post('/reportes/clientes/reportecuotas', ['as' => 'date','uses' => 'PdfController@getPDFCU', 
                           function () {
                               return '';
                           }]);

Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');
Route::post('/reportes/ventas/rptventas-detallado-cajero', ['as' => 'date','uses' => 'RptVentasController@getPDFVentaDetalladoCajero', 
                            function () {
                                return '';
                            }]);
Route::post('/reportes/kardex/rptkardex', ['as' => 'date','uses' => 'RptKardexController@getPDFKardex', 
                            function () {
                                return '';
                            }]);