<?php

use Mockery as m;

class RolesControllerTest extends TestCase {

    public function __construct()
    {
        $this->mock = m::mock('Eloquent', 'Rol');
        $this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
    }

    public function setUp()
    {
        parent::setUp();
        $rol = new Rol;
        $rol->name = 'Administrador';
        $rol->description = 'Puede gestionar el sistema en su totalidad.';
        $rol->id = 1;
        $this->attributes = $rol;
        $this->app->instance('Rol', $this->mock);
    }

    public function testIndex()
    {
        $this->mock->shouldReceive('all')->once()->andReturn($this->collection);
        $this->call('GET', 'admin/roles');

        $this->assertViewHas('roles');
    }

    public function testCreate()
    {
        $this->call('GET', 'admin/roles/create');

        $this->assertResponseOk();
    }

    public function testStore()
    {
        $this->mock->shouldReceive('create')->once();
        $this->validate(true);
        $this->call('POST', 'admin/roles');

        $this->assertRedirectedToRoute('admin.roles.index');
    }

    public function testStoreFails()
    {
        $this->mock->shouldReceive('create')->once();
        $this->validate(false);
        $this->call('POST', 'admin/roles');

        $this->assertRedirectedToRoute('admin.roles.create');
        $this->assertSessionHasErrors();
        $this->assertSessionHas('message');
    }

    public function testShow()
    {
        $this->mock->shouldReceive('findOrFail')
                   ->with(1)
                   ->once()
                   ->andReturn($this->attributes);

        $this->call('GET', 'admin/roles/1');

        $this->assertViewHas('rol');
    }

    public function testEdit()
    {
        $this->collection->id = 1;
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->once()
                   ->andReturn($this->collection);

        $this->call('GET', 'admin/roles/1/edit');

        $this->assertViewHas('rol');
    }

    public function testUpdate()
    {
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->andReturn(m::mock(array('update' => true)));

        $this->validate(true);
        $this->call('PATCH', 'admin/roles/1');

        $this->assertRedirectedTo('admin/roles/1');
    }

    public function testUpdateFails()
    {
        $this->mock->shouldReceive('find')
                   ->with(1)
                   ->andReturn(m::mock(array('update' => true)));
        $this->validate(false);
        $this->call('PATCH', 'admin/roles/1');

        $this->assertRedirectedTo('admin/roles/1/edit');
        $this->assertSessionHasErrors();
        $this->assertSessionHas('message');
    }

    public function testDestroy()
    {
        $this->mock->shouldReceive('find')->with(1)
            ->andReturn(m::mock(array('delete' => true)));

        $this->call('DELETE', 'admin/roles/1');
    }

    protected function validate($bool)
    {
        Validator::shouldReceive('make')
                ->once()
                ->andReturn(m::mock(array('passes' => $bool)));
    }
}