@extends('layouts.scaffold')

@section('main')

{{ Form::open(array('method'=> 'POST', 'route' => 'login')) }}
<ul>
    <li>
        {{ Form::label('name', 'Nombre de usuario:') }}
        {{ Form::text('name') }}
    </li>
    <li>
        {{ Form::label('password', 'Contraseña:') }}
        {{ Form::password('password') }}
    </li>
    <li>
        {{ Form::label('remember', 'Recuérdeme:') }}
        {{ Form::checkbox('remember') }}
    </li>
    <li>
        {{ Form::submit('Autenticarse', 
            array('class' => 'btn'))}}
    </li>
</ul>
{{ Form::close() }}

@stop
