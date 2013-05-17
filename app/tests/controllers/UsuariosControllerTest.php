<?php

use Mockery as m;


class UsuariosControllerTest extends TestCase {

    public function __construct()
    {
        $this->mock = m::mock('Eloquent', 'Usuario');

        $this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();

    }

    public function setUp()
    {
        parent::setUp();
        $usuario = new Usuario;
        $usuario->name = 'Brian Blanque';
        $usuario->email = 'bblanque@gmail.com';
        $usuario->password = 'brian';
        $usuario->id = 1;
        $usuario->active = true;
        $this->attributes = $usuario;
        $this->app->instance('Usuario', $this->mock);
    }

	public function testIndex()
    {
        $this->mock->shouldReceive('all')->once()->andReturn($this->collection);
        $this->call('GET', 'admin/usuarios');

        $this->assertViewHas('usuarios');
    }

    public function testCreate()
    {
        $this->call('GET', 'admin/usuarios/create');

        $this->assertResponseOk();
    }

    public function testStore()
    {
        $this->mock->shouldReceive('create')->once();
        $this->validate(true);
        $this->call('POST', 'admin/usuarios');

        $this->assertRedirectedToRoute('admin.usuarios.index');
    }

    public function testStoreFails()
    {
        $this->mock->shouldReceive('create')->once();
        $this->validate(false);
        $this->call('POST', 'admin/usuarios');

        $this->assertRedirectedToRoute('admin.usuarios.create');
        $this->assertSessionHasErrors();
        $this->assertSessionHas('message');
    }

    public function testShow()
    {
        $this->mock->shouldReceive('findOrFail')
                   ->with(1)
                   ->once()
                   ->andReturn($this->attributes);

        $this->call('GET', 'admin/usuarios/1');

        $this->assertViewHas('usuario');
    }

    public function testEdit()
    {
        $this->collection->id = 1;
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->once()
                   ->andReturn($this->collection);

        $this->call('GET', 'admin/usuarios/1/edit');

        $this->assertViewHas('usuario');
    }

    public function testUpdate()
    {
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->andReturn(m::mock(array('update' => true)));

        $this->validate(true);
        $this->call('PATCH', 'admin/usuarios/1');

        $this->assertRedirectedTo('admin/usuarios/1');
    }

    public function testUpdateFails()
    {
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->andReturn(m::mock(array('update' => true)));
        $this->validate(false);
        $this->call('PATCH', 'admin/usuarios/1');

        $this->assertRedirectedTo('admin/usuarios/1/edit');
        $this->assertSessionHasErrors();
        $this->assertSessionHas('message');
    }

    public function testDestroy()
    {
        $this->mock->shouldReceive('find')->with(1)
            ->andReturn(m::mock(array('delete' => true)));

        $this->call('DELETE', 'admin/usuarios/1');
    }

    protected function validate($bool)
    {
        Validator::shouldReceive('make')
                ->once()
                ->andReturn(m::mock(array('passes' => $bool)));
    }

}