@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<div class="card">
 
 <h1>Data User</h1> <hr>
 
<table class="table table-bordered">
	<thead>
		<th>Username</th>
		<th>Email</th>
		<th>Level</th>
		<th></th>
		<th></th>
		
		
	</thead>
	<tbody>
		<a href="{{ url('#') }}"><b>Create New User<b></a>
		<br>
		 
		
		@foreach ($user as $data)

		
		<br>
		<br>
		  @if(Auth::user()-> auth_level < $data['auth_level'])

		<tr>
			<td>{{ $data->username }}</td>
			<td>{{ $data->email}}</td>
			<td>{{ $data->auth_level }}</td>			
			<td>                
				{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
				{!! Form::submit('Hapus') !!}   
				{!! Form::close() !!}
				
				</td>
				<td><a href="{{url('/edituser/edit/'.$data->id)}}"><b>Edit Data<b></a>  </td>
				
		@endif		
				

			    
			    

  
                
				
				              
				
				
				
				
				

		</tr>
		</tbody>
		@endforeach
	</table>
 </div>
 
@stop

