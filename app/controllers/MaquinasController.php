<?php

class MaquinasController extends BaseController {

    /**
     * Maquina Repository
     *
     * @var Maquina
     */
    protected $maquina;

    public function __construct(Maquina $maquina)
    {
        $this->maquina = $maquina;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $maquinas = $this->maquina->all();

        return View::make('maquinas.index', compact('maquinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('maquinas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Maquina::$rules);

        if ($validation->passes())
        {
            $this->maquina->create($input);

            return Redirect::route('maquinas.index');
        }

        return Redirect::route('maquinas.create')
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
        $maquina = $this->maquina->findOrFail($id);

        return View::make('maquinas.show', compact('maquina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $maquina = $this->maquina->find($id);

        if (is_null($maquina))
        {
            return Redirect::route('maquinas.index');
        }

        return View::make('maquinas.edit', compact('maquina'));
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
        $validation = Validator::make($input, Maquina::$rules);

        if ($validation->passes())
        {
            $maquina = $this->maquina->find($id);
            $maquina->update($input);

            return Redirect::route('maquinas.show', $id);
        }

        return Redirect::route('maquinas.edit', $id)
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
        $this->maquina->find($id)->delete();

        return Redirect::route('maquinas.index');
    }

}