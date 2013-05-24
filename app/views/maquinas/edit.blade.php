@extends('layouts.scaffold')

@section('main')

<h1>Edit Maquina</h1>
{{ Form::model($maquina, array('method' => 'PATCH', 'route' => array('maquinas.update', $maquina->id))) }}
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
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('maquinas.show', 'Cancel', $maquina->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop