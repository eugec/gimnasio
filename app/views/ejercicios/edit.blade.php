@extends('layouts.scaffold')

@section('main')

<h1>Editar Ejercicio</h1>
{{ Form::model($ejercicio, array('method' => 'PATCH', 'route' => array('ejercicios.update', $ejercicio->id))) }}
    <ul>
        <li>
            {{ Form::label('nombre', 'Nombre:') }}
            {{ Form::text('nombre') }}
        </li>

        <li>
            {{ Form::label('descripcion', 'Descripcion:') }}
            {{ Form::text('descripcion') }}
        </li>

        <li>
            {{ Form::submit('Modificar', array('class' => 'btn btn-info')) }}
            {{ link_to_action(
                'EjerciciosController@showAttachableMaquinas',
                'Agregar Maquina',
                $ejercicio->id,
                array('class' => 'btn'))}}
            {{ link_to_action(
                'EjerciciosController@showDetachableMaquinas',
                'Sacar Maquina',
                $ejercicio->id,
                array('class' => 'btn'))}}
            {{ link_to_route('admin.ejercicios.show', 'Cancelar', $ejercicio->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop