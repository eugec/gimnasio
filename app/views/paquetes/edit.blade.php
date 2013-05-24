@extends('layouts.scaffold')

@section('main')

<h1>Edit Paquete</h1>
{{ Form::model($paquete, array('method' => 'PATCH', 'route' => array('paquetes.update', $paquete->id))) }}
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
            {{ link_to_route('paquetes.show', 'Cancel', $paquete->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop