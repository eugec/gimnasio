<?php

class RolesController extends BaseController {

    /**
     * Rol Repository
     *
     * @var Rol
     */
    protected $rol;

    public function __construct(Rol $rol)
    {
        $this->rol = $rol;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->rol->all();

        return View::make('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Rol::$rules);

        if ($validation->passes())
        {
            $this->rol->create($input);

            return Redirect::route('admin.roles.index');
        }

        return Redirect::route('admin.roles.create')
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
        $rol = $this->rol->findOrFail($id);

        return View::make('roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $rol = $this->rol->find($id);

        if (is_null($rol))
        {
            return Redirect::route('admin.roles.index');
        }

        return View::make('roles.edit', compact('rol'));
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
        $validation = Validator::make($input, Rol::$rules);

        if ($validation->passes())
        {
            $rol = $this->rol->find($id);
            $rol->update($input);

            return Redirect::route('admin.roles.show', $id);
        }

        return Redirect::route('admin.roles.edit', $id)
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
        $this->rol->find($id)->delete();

        return Redirect::route('admin.roles.index');
    }

}