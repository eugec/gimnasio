@extends('layouts.scaffold')

@section('main')

<h1>Ejercicios</h1>

<p>
    {{ link_to_route('admin.ejercicios.create', 'Add new ejercicio') }}
    {{ Form::open(array(
        'method' => 'get',
        'route' => array('admin.ejercicios.search'))) }}
    {{ Form::text('query') }}
        {{ Form::submit('Buscar', array('class' => 'btn btn-info')) }}
    {{ Form::close() }}
    {{ link_to_route('admin.ejercicios.search', 'Buscar un ejercicio') }}
</p>

@if ($ejercicios->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
				<th>Descripcion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($ejercicios as $ejercicio)
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
            @endforeach
        </tbody>
    </table>
@else
    No hay ejercicios
@endif

@stop