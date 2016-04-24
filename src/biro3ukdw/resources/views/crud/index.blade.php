@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<div class="container card">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1>Data User</h1>
			<hr>
			
			<a href="{{ url('/cruduser/new') }}"><b>Create New User<b></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-bordered">
				<thead>
					<th>Username</th>
					<th>Email</th>
					<th>Level</th>
					<th>Status</th>
					<th></th>
					<th></th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($user as $data)
					<tr>
						<td>{{ $data->username }}</td>
						<td>{{ $data->email}}</td>
						@if($data->auth_level=="0")
						<td>Super Admin</td>
						@elseif($data->auth_level=="1")
						<td>Admin</td>
						@elseif($data->auth_level=="2")
						<td>Staff</td>
						@else
						<td>Volunteer</td>
						@endif

						@if($data->is_aktif=="0")	
						<td>Tidak aktif</td>
						@else
						<td>Aktif</td>
						@endif	
						<td>                
						{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
						{!! Form::submit('Hapus') !!}   
						{!! Form::close() !!}

						</td>
						<td><a href="{{url('/cruduser/edit/'.$data->id)}}"><b>Edit Data<b></a>
						<td><a href="{{url('/cruduser/resets/'.$data->id)}}"><b>Reset Password<b></a>  </td>  </td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<a href="{{url('/editprofile')}}">Kembali</a>
		</div>
	</div>


</div>
 
@stop

