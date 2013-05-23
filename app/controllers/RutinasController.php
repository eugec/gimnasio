<?php

class RutinasController extends BaseController {

    /**
     * Rutina Repository
     *
     * @var Rutina
     */
    protected $rutina;

    public function __construct(Rutina $rutina)
    {
        $this->rutina = $rutina;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rutinas = $this->rutina->all();

        return View::make('rutinas.index', compact('rutinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('rutinas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Rutina::$rules);

        if ($validation->passes())
        {
            $this->rutina->create($input);

            return Redirect::route('rutinas.index');
        }

        return Redirect::route('rutinas.create')
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
        $rutina = $this->rutina->findOrFail($id);

        return View::make('rutinas.show', compact('rutina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $rutina = $this->rutina->find($id);

        if (is_null($rutina))
        {
            return Redirect::route('rutinas.index');
        }

        return View::make('rutinas.edit', compact('rutina'));
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
        $validation = Validator::make($input, Rutina::$rules);

        if ($validation->passes())
        {
            $rutina = $this->rutina->find($id);
            $rutina->update($input);

            return Redirect::route('rutinas.show', $id);
        }

        return Redirect::route('rutinas.edit', $id)
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
        $this->rutina->find($id)->delete();

        return Redirect::route('rutinas.index');
    }

}