<?php

class Rutina extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'descripcion' => 'required'
	);
}