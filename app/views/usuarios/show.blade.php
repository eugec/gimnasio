@extends('layouts.scaffold')

@section('main')

<h1>Show Usuario</h1>

<p>{{ link_to_route('admin.usuarios.index', 'Return to all usuarios') }}</p>

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
    </tbody>
</table>

@stop