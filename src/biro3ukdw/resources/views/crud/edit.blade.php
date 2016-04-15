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


 {!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['user.update', $user->id]
]) !!}

<div class="form-g">
    {!! Form::label('title', 'Username:', ['class' => 'control-label']) !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-g">
    {!! Form::label('description', 'Email:', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Level:', ['class' => 'control-label']) !!}
    {!! Form::text('auth_level', null, ['class' => 'form-control']) !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Status:', ['class' => 'control-label']) !!}
    {!! Form::text('is_aktif', null, ['class' => 'form-control']) !!}
</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 

		@stop
			
			
		
				
