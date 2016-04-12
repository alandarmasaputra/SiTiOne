@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<div class="page-header">
 <h1>Data User</h1> <hr>
 
<table class="table table-bordered">
	<thead>
		<th>Username</th>
		<th>Email</th>
		<th>Level</th>
		<th>option</th>
	</thead>
	<tbody>
		@foreach ($user as $data)
 
		<tr>
			<td><a href="{{ url('user/'. $data->id . '/edit') }}">{{ $data->username }}</a></td>
			<td>{{ $data->email}}</td>
			<td>{{ $data->auth_level }}</td>			
			<td>                
				{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
				{!! Form::submit('Hapus') !!}   {!! Form::submit('Create') !!}
				{!! Form::close() !!}
			</tr>
		</tbody>
		@endforeach
	</table>
 </div>
 
@stop

