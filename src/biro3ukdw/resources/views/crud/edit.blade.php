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
		<th>Password</th>
		<th>Level</th>
		<th>Status</th>		
		<th>option</th>
		
	</thead>
	<tbody>
		<a href="{{ url('#') }}"><b>Create New User<b></a>
		@foreach ($user as $data)

		
		<br>
		<br>
		 

		<tr>
			<td> <input name="title"  type="text" value="{{ $data->username }}" required></td>
			<td><input name="title"  type="text" value="{{ $data->email }}" required></td>
			<td>{{ $data->password}}</td>
			<td>
			
			@if($data->auth_level==0)
			<select>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            </select></td>	
			
			@elseif($data->auth_level=1)
			<select>
			<option value="1">1</option>
            <option value="0">0</option>
            <option value="2">2</option>
            <option value="3">3</option>
            </select></td>	
            @elseif($data->auth_level=2)
			<select>
			<option value="2">2</option>
			<option value="1">1</option>
            <option value="0">0</option>
            <option value="3">3</option>
            </select></td>	
            @elseif($data->auth_level=3)
			<select>
			<option value="3">3</option>
			<option value="1">1</option>
            <option value="0">0</option>
            <option value="2">2</option>
            
            </select></td>	
			
            @endif
            
			<td>
			@if($data->is_aktif==0)

			<select>
            <option value="0">0</option>
            <option value="1">1</option>
            </select></td>		
            @else
            <select>
            <option value="1">1</option>
            <option value="0">0</option>
            
            </select></td>	

            @endif
		
				<td>         

				
				{!! Form::open(['method' => 'POST', 'route' => ['user.update', $data->id]]) !!}
				{!! Form::submit('Update') !!}   
				{!! Form::close() !!}
				
				
				</td>
				              
				
				
				
				
				

		</tr>
		</tbody>
		@endforeach
	</table>
 </div>
 
@stop

