<?php

class PaquetesController extends BaseController {

    /**
     * Paquete Repository
     *
     * @var Paquete
     */
    protected $paquete;

    public function __construct(Paquete $paquete)
    {
        $this->paquete = $paquete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paquetes = $this->paquete->all();

        return View::make('paquetes.index', compact('paquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('paquetes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Paquete::$rules);

        if ($validation->passes())
        {
            $this->paquete->create($input);

            return Redirect::route('paquetes.index');
        }

        return Redirect::route('paquetes.create')
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
        $paquete = $this->paquete->findOrFail($id);

        return View::make('paquetes.show', compact('paquete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $paquete = $this->paquete->find($id);

        if (is_null($paquete))
        {
            return Redirect::route('paquetes.index');
        }

        return View::make('paquetes.edit', compact('paquete'));
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
        $validation = Validator::make($input, Paquete::$rules);

        if ($validation->passes())
        {
            $paquete = $this->paquete->find($id);
            $paquete->update($input);

            return Redirect::route('paquetes.show', $id);
        }

        return Redirect::route('paquetes.edit', $id)
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
        $this->paquete->find($id)->delete();

        return Redirect::route('paquetes.index');
    }

}