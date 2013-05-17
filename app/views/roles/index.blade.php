@extends('layouts.scaffold')

@section('main')

<h1>All roles</h1>

<p>{{ link_to_route('admin.roles.create', 'Add new rol') }}</p>

@if ($roles->count())
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
                    <td>{{ link_to_route('admin.roles.edit', 'Edit', array($rol->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.roles.destroy', $rol->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no roles
@endif

@stop