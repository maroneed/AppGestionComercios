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
Route ::group (['middleware'=>['guest']],function(){
    Route ::get('/','Auth\LoginController@showLoginForm');
    Route :: post ('/login','Auth\LoginController@Login')->name('login');
});
Route ::group (['middleware'=>['auth']],function(){
    Route ::group (['middleware'=>['administrador']],function(){
        
        Route :: resource('seguridad/usuario','UsuarioController');
        Route :: resource('seguridad/roles','RolController');
        Route :: resource('compras/imprimir-ingresos','IngresoController');
        Route ::get('/seguridad/usuario', 'UsuarioController@index');
        Route ::get('/seguridad/roles', 'RolController@index');
    });

    
    
});
Route ::group (['middleware'=>['auth']],function(){
    Route ::group (['middleware'=>['almacenero']],function(){
        Route ::get('/almacen/categoria', 'CategoriaController@index');
        Route ::get('/almacen/articulo', 'ArticuloController@index');
        Route :: resource('almacen/articulo','ArticuloController');
        Route :: resource('almacen/categoria','CategoriaController');
        Route ::get('/compras/proveedor', 'ProveedorController@index');
        Route ::get('/compras/ingreso', 'IngresoController@index');
        Route :: resource('compras/proveedor','ProveedorController');
        Route :: resource('compras/ingreso','IngresoController');
        Route :: resource('almacen/imprimir-articulo','ArticuloController');
        Route :: resource('almacen/imprimir-categoria','CategoriaController');
        Route :: resource('almacen/imprimir-codigo','ArticuloController');
        Route ::get('/compras/imprimir-ingresos', 'IngresoController@imprimir')->name('imprimir-ingreso');
        

        Route ::get('/compras/imprimir-proveedor', 'ProveedorController@imprimir')->name('imprimir-proveedor');
        Route ::get('/almacen/imprimir-articulo', 'ArticuloController@imprimir')->name('imprimir-articulo');
        Route ::get('/almacen/imprimir-categoria', 'CategoriaController@imprimir')->name('imprimir-categoria');
        Route ::get('/almacen/imprimir-codigo','ArticuloController@codigoBarra')->name('imprimir-codigo');
        Route ::get('/compras/imprimir-ingreso', 'IngresoController@imprimirIngreso')->name('imprimir-ingresos');
        

        


    });
    
    
});

Route ::group (['middleware'=>['auth']],function(){
    Route ::group (['middleware'=>['vendedor']],function(){
        Route :: resource('ventas/imprimir-ventas','VentaController');
        Route :: resource('ventas/imprimir-cliente','ClienteController');
        Route :: resource('ventas/cliente','ClienteController');
        Route :: resource('ventas/venta','VentaController');
        Route ::get('/ventas/cliente', 'ClienteController@index');
        Route ::get('/ventas/venta', 'VentaController@index');
        Route :: resource('ventas/imprimir-ventas','VentaController');
        Route ::get('/ventas/imprimir-ventas', 'VentaController@imprimir')->name('imprimir');
        Route ::get('/ventas/imprimir-cliente', 'ClienteController@imprimir')->name('imprimir-cliente');
        Route ::get('/ventas/imprimir-venta', 'VentaController@imprimirVenta')->name('imprimir-ventas');
    });

});
//Auth ::routes();



   




Route :: resource('calendar','VentaController');
Route :: resource('welcome','HomeController');

Route :: auth(['verify'=> true]);
Route ::get('/home','HomeController@index')->name('home')->middleware('verified');
Route ::get('/home','HomeController@index')->name('almacen/articulo');
Route ::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route :: get('/{slug?}','HomeController@index');  //si se coloca una ruta que no existe redirecciona a ventas(se setea en el archivo home.blade.php donde queres redireccionar en ese caso)
Route ::get('/welcome','HomeController@index')->name('resumen');


//MIddleware



Route ::get('/resumen','HomeController@index')->middleware('auth');

//



Route ::get('/calendar', 'CalendarioController@index')->name('calendar');


Route ::get('imprimirVenta/{id}', [
    'as' => 'imprimirVenta',
    'uses' => 'VentaController@imprimirVenta',
]);

Route ::get('imprimirIngreso/{id}', [
    'as' => 'imprimirIngreso',
    'uses' => 'IngresoController@imprimirIngreso',
]);

Route ::get('codigoBarra/{id}', [
    'as' => 'codigoBarra',
    'uses' => 'ArticuloController@codigoBarra',
]);












