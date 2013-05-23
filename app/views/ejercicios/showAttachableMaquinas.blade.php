@extends('layouts.scaffold')

@section('main')

<h1>Maquinas</h1>

@if (!$maquinas->isEmpty())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
				<th>Descripcion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($maquinas as $maquina)
                <tr>
                    <td>{{ $maquina->name }}</td>
					<td>{{ $maquina->description }}</td>
                    
					<td>
                        {{ link_to_action(
                            'EjerciciosController@attachMaquina',
                            'Agregar',
                            array(
                            $maquina->id,
                            $ejercicio_id),
                            array('class' => 'btn'))
                        }}
					</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No hay maquinas disponibles.
@endif

@stop