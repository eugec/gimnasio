@extends('layouts.scaffold')

@section('main')

<h1>Roles</h1>

@if (!$roles->isEmpty())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
				<th>Description</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <td>{{ $rol->name }}</td>
					<td>{{ $rol->description }}</td>
                    
					<td>
                        {{ link_to_action(
                            'UsuariosController@attachRol',
                            'Agregar',
                            array(
                            $rol->id,
                            $usuario_id),
                            array('class' => 'btn'))
                        }}
					</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No hay roles disponibles.
@endif

@stop