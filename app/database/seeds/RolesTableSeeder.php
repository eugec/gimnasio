<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('roles')->delete();

    	DB::table('roles')
            ->whereIn('id', array(
            	1,
            	2,
            	3))->delete();

        $roles = array(
        	array(
        	'name' => 'Administrador',
        	'description' => 'Gestiona todo el sistema',
        	'id' => 1,
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        	),
        	array(
        	'name' => 'Entrenador',
        	'description' => 'Gestiona las rutinas',
        	'id' => 2,
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        	),
        	array(
        	'name' => 'Nutricionista',
        	'description' => 'Gestiona las dietas',
        	'id' => 3,
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        	),
        );

        // Uncomment the below to run the seeder
        DB::table('roles')->insert($roles);
    }

}