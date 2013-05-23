<?php

class LoginController extends BaseController {

	public function login()
	{
		return View::make('login');
	}
	
	public function loginAttempt()
	{
		$name = Input::get('name');
		if (Auth::attempt(array(
				'name' => $name,
		 		'password' => Input::get('password')
		 		), Input::get('remember'))
		 		// && 
				// function (){
				// if (DB::table('usuarios')
				// 			->select(DB::raw(1))
		 	// 				->from('usuarios')
		 	// 				->where('name', $name)->get())
				// {
		 	// 		return true;
		 	// 	}
		 	// 		return false;
		 	// 	} && Hash::check(Input::get('password'),
		 	// 			DB::table('usuarios')
		 	// 	 			->where('name', $name)
		 	// 	 			->pluck('password')
		 	// 	 	)
		 		)
		{	
			#integer
			Session::put('id', DB::table('usuarios')
					 				->where('name', $name)
					 				->pluck('id'));
			#string
			Session::put('name', $name);
			$roles = array();
			$roles = Usuario::find(Session::get('id'))
							->attachedRolesNombres();
			#array							
			Session::put('roles', $roles);

		    return Redirect::refresh()
		    	->with('message','Se ha autenticado correctamente.');
		}

		return Redirect::refresh()
			->with('message','Todavía no está autenticado,
			 su usuario y/o contraseña ha sido incorrecta.');
	}

	public function logout()
	{
		Session::flush();
		return Redirect::route('login')
			->with('message','Se ha desautenticado correctamente');
	}
}