@extends('layouts.scaffold')

@section('main')

<h1>All Paquetes</h1>

<p>{{ link_to_route('paquetes.create', 'Add new paquete') }}</p>

@if ($paquetes->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
				<th>Descripcion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($paquetes as $paquete)
                <tr>
                    <td>{{ $paquete->nombre }}</td>
					<td>{{ $paquete->descripcion }}</td>
                    <td>{{ link_to_route('paquetes.edit', 'Edit', array($paquete->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('paquetes.destroy', $paquete->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no paquetes
@endif

@stop