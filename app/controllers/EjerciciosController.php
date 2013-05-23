<?php

use Illuminate\Database\Eloquent\Collection as Collection;

class EjerciciosController extends BaseController {

    /**
     * Ejercicio Repository
     *
     * @var Ejercicio
     */
    protected $ejercicio;

    public function __construct(Ejercicio $ejercicio)
    {
        $this->ejercicio = $ejercicio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ejercicios = $this->ejercicio->all();

        return View::make('ejercicios.index', compact('ejercicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('ejercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Ejercicio::$rules);

        if ($validation->passes())
        {
            $this->ejercicio->create($input);

            return Redirect::route('admin.ejercicios.index');
        }

        return Redirect::route('admin.ejercicios.create')
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
        $ejercicio = $this->ejercicio->findOrFail($id);

        return View::make('ejercicios.show', compact('ejercicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ejercicio = $this->ejercicio->find($id);

        if (is_null($ejercicio))
        {
            return Redirect::route('admin.ejercicios.index');
        }

        return View::make('ejercicios.edit', compact('ejercicio'));
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
        $validation = Validator::make($input, Ejercicio::$rules);

        if ($validation->passes())
        {
            $ejercicio = $this->ejercicio->find($id);
            $ejercicio->update($input);

            return Redirect::route('admin.ejercicios.show', $id);
        }

        return Redirect::route('admin.ejercicios.edit', $id)
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
        $this->ejercicio->find($id)->delete();

        return Redirect::route('admin.ejercicios.index');
    }

    public function showAttachableMaquinas($ejercicio_id)
    {
        $maquinas = $this->ejercicio->find($ejercicio_id)
            ->detachedMaquinas();
        $maquinas = new Collection($maquinas);

        return View::make('ejercicios.showAttachableMaquinas',
            array('ejercicio_id' => $ejercicio_id, 'maquinas' => $maquinas));
    }

    public function attachMaquina($maquina_id, $ejercicio_id)
    {
        $this->ejercicio->find($ejercicio_id)
            ->maquinas()->attach($maquina_id);

        return Redirect::route('admin.ejercicios.showAttachableMaquinas', $ejercicio_id);
    }

    public function showDetachableMaquinas($ejercicio_id)
    {
        $maquinas = $this->ejercicio->find($ejercicio_id)
            ->attachedMaquinas();
        $maquinas = new Collection($maquinas);

        return View::make('ejercicios.showDetachableMaquinas',
            array('ejercicio_id' => $ejercicio_id, 'maquinas' => $maquinas));
    }

    public function detachMaquina($maquina_id, $ejercicio_id)
    {
        $this->ejercicio->find($ejercicio_id)
            ->maquinas()->detach($maquina_id);

        return Redirect::route('admin.ejercicios.showDetachableMaquinas', $ejercicio_id);
    }


    public function search()
    {
        $query = Input::get('query');
        $ejercicios = $this->ejercicio->findLike($query);
        $ejercicios = new Collection($ejercicios);

        return View::make('ejercicios.search', compact('ejercicios'));
    }

}