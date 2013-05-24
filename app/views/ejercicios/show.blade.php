@extends('layouts.scaffold')

@section('main')

<h1>Show Ejercicio</h1>

<p>{{ link_to_route('admin.ejercicios.index', 'Return to all ejercicios') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
				<th>Descripcion</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $ejercicio->nombre }}</td>
			<td>{{ $ejercicio->descripcion }}</td>
            <td>{{ link_to_route('admin.ejercicios.edit', 'Edit', array($ejercicio->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.ejercicios.destroy', $ejercicio->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop