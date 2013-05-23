<?php

class RolUsuarioTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('rol_usuario')
            ->whereIn('id', array(
            	1,
            	2,
            	3,
            	4))->delete();
        $roles_usuarios= array(
        	array('id' => 1,
        		  'rol_id' => 1,
        		  'usuario_id' => 1),
        	array('id' => 2,
        		  'rol_id' => 1,
        		  'usuario_id' => 2),
        	array('id' => 3,
        		  'rol_id' => 1,
        		  'usuario_id' => 3),
        	array('id' => 4,
        		  'rol_id' => 2,
        		  'usuario_id' => 1),
        );

        DB::table('rol_usuario')->insert($roles_usuarios);
    }
}