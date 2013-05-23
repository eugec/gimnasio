<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

    protected $guarded = array();
    protected $hidden = array('password');
    public static $rules = array(
		'name' => 'required',
		'email' => 'required|email',
		'password' => 'required'

	);

    # Contratos

	public function getAuthIdentifier()
	{
		return $this->name;
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}


    // public function setPassword($password){
    // 	$this->password = Hash::make($password);
    // }

	# Relaciones

    public function roles()
    {
		return $this->belongsToMany('Rol');
	}

	# metodos

	/*
	 * return @array
	 * 
	 */
	public function attachedRolesIds()
	{
		return DB::table('rol_usuario')
						->where('usuario_id', $this->id)
						->lists('rol_id');
	}

	/*
	 * return @array
	 * 
	 */
	public function attachedRolesNombres()
	{
		return DB::table('roles')
						->whereIn('id',$this->attachedRolesIds())
						->lists('name');
	}

		/*
	 * return @array
	 * 
	 */
	public function attachedRoles()
	{
		return DB::table('roles')
						->whereIn('id',$this->attachedRolesIds())
						->get();
	}

	/*
	 * return @array
	 * 
	 */
	public function detachedRoles()
	{
    	return DB::table('roles')
    					->whereNotIn('id', $this->attachedRolesIds())
    					->get();
	}

	public function findLike($query)
	{
		$query = trim(filter_var($query, FILTER_SANITIZE_STRING));
		return DB::table('usuarios')
						->where('name','LIKE','%'.$query.'%')
						->get();
	}

}