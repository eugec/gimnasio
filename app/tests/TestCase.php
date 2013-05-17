<?php

/*	Testeo con Mockery para controladores
 *	http://net.tutsplus.com/tutorials/php/testing-laravel-controllers/?search_index=7
 *	Testeo con SQLite para DB
 *  http://net.tutsplus.com/tutorials/php/testing-like-a-boss-in-laravel-models/
 */
use Mockery as m;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

    // public function setUp()
    // {
    //     parent::setUp();
 
    //     $this->prepareForTests();
    // }

	public function tearDown()
    {
        m::close();
    }

	/**
	* Migrates the database and set the mailer to 'pretend'.
	* This will cause the tests to run quickly.
	* ( Con SQLite )
	*
	*/
	// private function prepareForTests()
	// {
	// 	Artisan::call('migrate');
	// 	Mail::pretend(true);
	// }

}
