@extends('layouts.scaffold')

@section('main')

<h1>Editar Usuario</h1>
{{ Form::model($usuario, array('method' => 'PATCH', 'route' => array('admin.usuarios.update', $usuario->id))) }}
    <ul>
        <li>
            {{ Form::label('name', 'Nombre:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email') }}
        </li>
        <li>
            {{ Form::submit('Modificar', array('class' => 'btn btn-info')) }}
            {{ link_to_action(
                'UsuariosController@showAttachableRoles',
                'Agregar Rol',
                $usuario->id,
                array('class' => 'btn'))}}
            {{ link_to_action(
                'UsuariosController@showDetachableRoles',
                'Sacar Rol',
                $usuario->id,
                array('class' => 'btn'))}}
            {{ link_to_route('admin.usuarios.show',
                'Cancelar',
                $usuario->id,
                array('class' => 'btn'))}}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop