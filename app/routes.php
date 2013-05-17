<?php

Route::get('/test', 'HomeController@showTest');

Route::get('/', 'HomeController@showHome');

Route::group(array('prefix' => 'admin'), function()
{
	Route::get('/', 'HomeController@showAdmin');

	Route::resource('usuarios','UsuariosController');
	Route::post('usuarios/{id}/showAttachableRoles',
		'UsuariosController@showAttachableRoles');

	Route::resource('roles', 'RolesController');

});


