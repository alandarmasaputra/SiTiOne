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

?>
<div class="card">
 <h1>Data User</h1> <hr>


 {!! Form::model( new App\User, [
    'route' => ['user.store']
]) !!}

<div class="form-g">
    {!! Form::label('username', 'Username:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('username') !!}
</div>

<div class="form-g">
    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password') !!}


</div>

<div class="form-g">
    {!! Form::label('ulang password', 'Ulang Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password') !!}


</div>

<div class="form-g">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('auth_level', 'Level:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('auth_level') !!}
</div>
<div class="form-g">
    {!! Form::label('is_aktif', 'Status:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('is_aktif') !!}
</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 


        @stop
            
				
