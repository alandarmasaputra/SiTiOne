@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<?php 
use App\AppUtility;
$addition = $user->addition() 
?>
<div class="card">
 <h1>Data User</h1> <hr>


 {!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['user.update', $user->id]
]) !!}

<div class="form-g">
    {!! Form::label('title', 'Username:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('username') !!}
</div>

<div class="form-g">
    {!! Form::label('description', 'Email:', ['class' => 'control-label']) !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Level:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('auth_level') !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Status:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('is_aktif') !!}
</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 


		@stop
			
			
		
				
