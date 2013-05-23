<?php

use Mockery as m;

class RoutesTest extends TestCase {

	public function testHome()
	{
		$this->call('GET','/');
		$this->assertResponseOk();
	}

	public function testAdmin()
	{
		$this->call('GET','/admin');
		$this->assertResponseOk();
	}

	public function testTest()
	{
		$this->call('GET','/test');
		$this->assertResponseOk();
	}

	public function testLogin()
	{
		$this->call('GET','/login');
		$this->assertResponseOk();
	}

	public function testLogout()
	{
		$this->call('GET','/login');
		$this->assertResponseOk();
	}

	
}

	// public function testAdminUsuarios(){
	// 	$this->call('GET','/admin/usuarios');
	// 	$this->assertResponseOk();
	// }

	// public function test()
	// {
	// 	$this->call('GET','/admin');
	// 	$this->assertResponseOk();
	// }

	// public function testBasicExample()
	// {
	// 	$crawler = $this->client->request('GET', '/');

	// 	$this->assertTrue($this->client->getResponse()->isOk());

	// 	$this->assertCount(1, $crawler->filter('h1:contains("Hello World!")'));
	// }
