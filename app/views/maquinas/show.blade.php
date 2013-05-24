@extends('layouts.scaffold')

@section('main')

<h1>Show Maquina</h1>

<p>{{ link_to_route('maquinas.index', 'Return to all maquinas') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
				<th>Descripcion</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $maquina->nombre }}</td>
					<td>{{ $maquina->descripcion }}</td>
                    <td>{{ link_to_route('maquinas.edit', 'Edit', array($maquina->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('maquinas.destroy', $maquina->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
        </tr>
    </tbody>
</table>

@stop