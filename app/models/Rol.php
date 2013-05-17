<?php

class Rol extends Eloquent {
    protected $guarded = array();
    protected $table = 'roles';
    public static $rules = array(
		'name' => 'required'
	);

	public function usuarios()
	{
		return $this->belongsToMany('Usuario');
	}
}