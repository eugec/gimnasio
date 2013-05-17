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
		return $this->getKey();
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
	private function attachedRolesIds()
	{
		return DB::table('rol_usuario')
						->where('usuario_id',$this->id)
						->pluck('rol_id');
	}

	/*
	 * return @array
	 * 
	 */
	private function detachedRolesIds()
	{
    	return DB::table('rol')
    					->whereNotIn('id', $this->attachedRolesIds());
	}

	public function detachedRoles()
	{
    	$roles = detachedRolesIds();
		var_dump($roles);
		return $roles;
	}

}