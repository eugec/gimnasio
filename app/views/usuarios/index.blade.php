@extends('layouts.scaffold')

@section('main')

<h1>All Usuarios</h1>

<p>{{ link_to_route('admin.usuarios.create', 'Add new usuario') }}</p>

@if ($usuarios->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Active</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
					<td>{{ $usuario->email }}</td>
					<td>{{ $usuario->password }}</td>
					<td>{{ $usuario->active }}</td>
                    <td>{{ link_to_route('admin.usuarios.edit', 'Edit', array($usuario->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.usuarios.destroy', $usuario->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no usuarios
@endif

@stop