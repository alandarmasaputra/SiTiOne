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
$addition = $user->addition();
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
    {!! Form::label('description', 'Email:',['class' => 'control-label']) !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Level:',['class' => 'control-label']) !!}
    <br>
    {!! Form::select('auth_level', array('0' => 'Super Admin', '1' => 'Admin',  '2' => 'Staff', '3' => 'Volunteer')); !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Status:', ['class' => 'control-label']) !!}
    <br>{!! Form::select('is_aktif', array('0' => 'Tidak Aktif', '1' => 'Aktif')); !!}
</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 


		@stop
			
			
		
				
