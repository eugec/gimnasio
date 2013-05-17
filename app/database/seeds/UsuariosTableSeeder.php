<?php

class UsuariosTableSeeder extends Seeder {
		
    public function run()
    {
    	DB::table('usuarios')
            ->whereIn('id', array(
            	1,
            	2,
            	3))->delete();


		$brian = new Usuario;
        $brian->name = 'Brian Blanque';
        $brian->email = 'bblanque@gmail.com';
        $brian->password = Hash::make('brian');
        $brian->id = 1;
        $brian->active = true;
        $brian->created_at = new DateTime;
        $brian->updated_at = new DateTime;
        $brian->save();

        $euge = new Usuario;
        $euge->name = 'Eugenia Cespedes';
        $euge->email = 'eugeniacespedes@outlook.com';
        $euge->password = Hash::make('euge');
        $euge->id = 2;
        $euge->active = true;
        $euge->created_at = new DateTime;
        $euge->updated_at = new DateTime;
        $euge->save();

        $juli = new Usuario;
        $juli->name = 'Julian Massolo';
        $juli->email = 'j.massolo@gmail.com';
        $juli->password = Hash::make('juli');
        $juli->id = 3;
        $juli->active = true;
        $juli->created_at = new DateTime;
        $juli->updated_at = new DateTime;
        $juli->save();

    }

}