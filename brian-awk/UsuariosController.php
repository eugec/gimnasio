<?php

use Illuminate\Database\Eloquent\Collection as Collection;

class UsuariosController extends BaseController {

    /**
     * Usuario Repository
     *
     * @var Usuario
     */
    protected $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $usuarios = $this->usuario->all();

        return View::make('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Usuario::$rules);

        if ($validation->passes())
        {
            $this->usuario->create($input);

            return Redirect::route('admin.usuarios.index');
        }

        return Redirect::route('admin.usuarios.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $usuario = $this->usuario->findOrFail($id);

        return View::make('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $usuario = $this->usuario->find($id);

        if (is_null($usuario))
        {
            return Redirect::route('admin.usuarios.index');
        }

        return View::make('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Usuario::$rules);

        if ($validation->passes())
        {
            $usuario = $this->usuario->find($id);
            $usuario->update($input);

            return Redirect::route('admin.usuarios.show', $id);
        }

        return Redirect::route('admin.usuarios.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->usuario->find($id)
            ->delete();

        return Redirect::route('admin.usuarios.index');
    }

    //Views que seran sub-views

    public function showAttachableRoles($usuario_id)
    {
        $roles = $this->usuario->find($usuario_id)
            ->detachedRoles();
        $roles = new Collection($roles);

        return View::make('usuarios.showAttachableRoles',
            array('usuario_id' => $usuario_id, 'roles' => $roles));
    }

    public function attachRol($rol_id, $usuario_id)
    {
        $this->usuario->find($usuario_id)
            ->roles()->attach($rol_id);

        return Redirect::route('admin.usuarios.showAttachableRoles', $usuario_id);
    }

    public function showDetachableRoles($usuario_id)
    {
        $roles = $this->usuario->find($usuario_id)
            ->attachedRoles();
        $roles = new Collection($roles);

        return View::make('usuarios.showDetachableRoles',
            array('usuario_id' => $usuario_id, 'roles' => $roles));
    }

    public function detachRol($rol_id, $usuario_id)
    {
        $this->usuario->find($usuario_id)
            ->roles()->detach($rol_id);

        return Redirect::route('admin.usuarios.showDetachableRoles', $usuario_id);
    }


    public function search()
    {
        $query = Input::get('query');
        $usuarios = $this->usuario->findLike($query);
        $usuarios = new Collection($usuarios);

        return View::make('usuarios.search', compact('usuarios'));
    }

}