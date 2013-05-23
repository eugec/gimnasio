<?php



Route::get('/test', 'HomeController@showTest');

Route::get('/', 'HomeController@showHome');

#Autenticación
Route::get('/login', array(
			'uses' => 'LoginController@login',
 			'as' => 'login'));
Route::post('/login', array(
			'uses' => 'LoginController@loginAttempt',
 			'as' => 'loginAttempt'));
Route::get('/logout', array(
			'uses' => 'LoginController@logout',
 			'as' => 'logout'));

#Tiene que estar autenticado
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
	Route::get('/', 'HomeController@showAdmin');

	Route::resource('usuarios','UsuariosController');

	Route::get('usuarios/search',
	array(
		'uses' => 'UsuariosController@search',
		'as' => 'admin.usuarios.search')
	);

	Route::get('usuarios/{usuario_id}',
		array(
			'uses' => 'UsuariosController@show',
			'as' => 'admin.usuarios.show')
		)->where('id', '\d+');

	Route::get('usuarios/{usuario_id}/showAttachableRoles',
		array(
			'uses' => 'UsuariosController@showAttachableRoles',
			'as' => 'admin.usuarios.showAttachableRoles')
		);

	Route::get('usuarios/{usuario_id}/showAttachableRoles/{rol_id}',
		array(
			'uses' => 'UsuariosController@attachRol',
			'as' => 'admin.usuarios.attachRol')
		);

	Route::get('usuarios/{usuario_id}/showDetachableRoles',
		array(
			'uses' => 'UsuariosController@showDetachableRoles',
			'as' => 'admin.usuarios.showDetachableRoles')
		);

	Route::get('usuarios/{usuario_id}/showDetachableRoles/{rol_id}',
		array(
			'uses' => 'UsuariosController@detachRol',
			'as' => 'admin.usuarios.detachRol')
		);


	Route::resource('ejercicios', 'EjerciciosController');

	Route::get('ejercicios/search',
	array(
		'uses' => 'EjerciciosController@search',
		'as' => 'admin.ejercicios.search')
	);

	Route::get('ejercicios/{ejercicio_id}',
		array(
			'uses' => 'EjerciciosController@show',
			'as' => 'admin.ejercicios.show')
		)->where('id', '\d+');

	Route::get('ejercicios/{ejercicio_id}/showAttachableMaquinas',
		array(
			'uses' => 'EjerciciosController@showAttachableMaquinas',
			'as' => 'admin.ejercicios.showAttachableMaquinas')
		);

	Route::get('ejercicios/{ejercicio_id}/showAttachableMaquinas/{maquina_id}',
		array(
			'uses' => 'EjerciciosController@attachMaquina',
			'as' => 'admin.ejercicios.attachMaquina')
		);

	Route::get('ejercicios/{ejercicio_id}/showDetachableMaquinas',
		array(
			'uses' => 'EjerciciosController@showDetachableMaquinas',
			'as' => 'admin.ejercicios.showDetachableMaquinas')
		);

	Route::get('ejercicios/{ejercicio_id}/showDetachableMaquinas/{maquina_id}',
		array(
			'uses' => 'EjerciciosController@detachMaquina',
			'as' => 'admin.ejercicios.detachMaquina')
		);

	Route::resource('paquetes', 'PaquetesController');

	Route::resource('rutinas', 'RutinasController');

	Route::resource('maquinas', 'MaquinasController');
	Route::resource('roles', 'RolesController');
});




