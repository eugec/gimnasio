<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolesTableSeeder');
		$this->call('UsuariosTableSeeder');
		$this->call('RolUsuarioTableSeeder');
		$this->call('EjerciciosTableSeeder');
		$this->call('MaquinasTableSeeder');
		$this->call('PaquetesTableSeeder');
		$this->call('RutinasTableSeeder');
	}

}