@extends('layouts.scaffold')

@section('main')

<h1>Búsqueda de Usuarios</h1>

<p>{{ link_to_route('admin.usuarios.index', 'Volver al índice') }}</p>

@if ($usuarios->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($usuarios as $usuario)
            @if ($usuario->active)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ link_to_route('admin.usuarios.edit', 'Edit', array($usuario->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.usuarios.destroy', $usuario->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
@else
    No hay usuarios
@endif

@stop