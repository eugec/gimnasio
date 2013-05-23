@extends('layouts.scaffold')

@section('main')

<h1>Show Rutina</h1>

<p>{{ link_to_route('rutinas.index', 'Return to all rutinas') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
				<th>Descripcion</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $rutina->nombre }}</td>
					<td>{{ $rutina->descripcion }}</td>
                    <td>{{ link_to_route('rutinas.edit', 'Edit', array($rutina->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('rutinas.destroy', $rutina->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
        </tr>
    </tbody>
</table>

@stop