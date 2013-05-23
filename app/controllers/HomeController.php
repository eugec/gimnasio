<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showTest()
	{
		$query = 'Ju';
		$query = trim(filter_var($query, FILTER_SANITIZE_STRING));

		var_dump($query);
		print('-----------');
		var_dump(DB::table('usuarios')
						->where('name','LIKE','%'.$query.'%')
						->get());
	}

	public function showHome()
	{
		return View::make('home');
	}

	public function showAdmin()
	{
		return View::make('admin');
	}

}