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

/*************  Routes del sistema  *************/
// Authentication Routes...
Auth::routes();
Route::get('password/email/{id}', 'Auth\ForgotPasswordController@sendEmail');
Route::get('password/reset/{id}', 'Auth\ForgotPasswordController@showResetForm');

Route::group(['prefix'=>'auth', 'as'=>'auth.', 'namespace'=>'Auth'], function() {
	Route::resource('usuarios', 'RegisterController');
	Route::resource('roles', 'RoleController');
	Route::resource('permisos', 'PermissionController');
});

//Dashboard
Route::get('getDashboardUsuariosPorRol', 'Auth\RoleController@getUsuariosPorRol');

Route::group(['middleware'=>'auth'], function() {
	//Página principal. Si el usuario es admin, se muestra el dashboard.
	Route::get('/', function(){
		if(Entrust::hasRole(['owner','admin','gesthum']))
			return view('dashboard/charts');
		return view('layouts.menu');
	});
	//Ruta para select2 con ajax
	Route::get('getArrModel', 'Controller@ajax');
	Route::get('getDataSelectDepediente', 'Controller@getDataSelectDepediente');
	//
	/*/Idea para reemplazar las rutas de Json Datatable Ajax EN DESARROLLO
	Route::get('getDatatableJson/{namespace}/{controller}', function($namespace, $controller ){
		$controller = '\App\Http\Controllers\\'.$namespace.'\\'.$controller.'Controller';
		$app = app($controller);
		return $app->callAction('getData', $parameters = request()->all());
	});*/
});

//Admn App
Route::group(['prefix'=>'app', 'as'=>'app.', 'namespace'=>'App', 'middleware'=>'auth'], function() {
	Route::resource('menu', 'MenuController', ['parameters'=>['menu'=>'MENU_ID']]);
	Route::resource('parametersglobal', 'ParameterGlobalController', ['parameters'=>['parametersglobal'=>'PGLO__ID']]);
	Route::post('menu/reorder', 'MenuController@reorder')->name('menu.reorder');
	Route::get('upload', 'UploadDataController@index')->name('upload.index');
	Route::post('upload', 'UploadDataController@upload')->name('upload');

	Route::get('createFromAjax/{model}', 'ModelController@createFromAjax')->name('createFromAjax');
});

//Reportes
Route::group(['prefix'=>'reports', 'as'=>'reports.', 'namespace'=>'Report', 'middleware'=>'auth'], function() {
	Route::get('/', 'ReportController@index')->name('index');
	Route::get('/viewForm', 'ReportController@viewForm')->name('viewForm');
	Route::post('getData/{controller}/{action}', 'ReportController@getData')->name('getData');
});
/*************  Fin Routes del sistema  *************/

Route::group(['middleware'=>'auth'], function() {
	Route::group(['prefix'=>'cnfg-geograficos', 'as'=>'CnfgGeograficos.', 'namespace'=>'CnfgGeograficos'], function() {
		Route::resource('paises', 'PaisController', ['parameters'=>['pais'=>'PAIS_ID']]);
			 Route::get('getPaises', 'PaisController@getData');
		Route::resource('departamentos', 'DepartamentoController', ['parameters'=>['departamento'=>'DEPA_ID']]);
			 Route::get('getDepartamentos', 'DepartamentoController@getData');
		Route::resource('ciudades', 'CiudadController', ['parameters'=>['ciudad'=>'CIUD_ID']]);
			 Route::get('getCiudades', 'CiudadController@getData');
		Route::resource('barrios', 'BarrioController', ['parameters'=>['barrio'=>'BARR_ID']]);
			 Route::get('getBarrios', 'BarrioController@getData');
	});


	Route::group(['prefix'=>'core', 'as'=>'Core.', 'namespace'=>'Core'], function() {
		Route::resource('mascotas', 'MascotaController', ['parameters'=>['mascota'=>'MASC_ID']]);
			 Route::get('getMascotas', 'MascotaController@getData');
		Route::resource('personas', 'PersonaController', ['parameters'=>['persona'=>'PERS_ID']]);
			 Route::get('getPersonas', 'PersonaController@getData');
		Route::resource('publicaciones', 'PublicacionController', ['parameters'=>['publicacione'=>'PUBL_ID']]);
			 Route::get('getPublicaciones', 'PublicacionController@getData');
	});


});
