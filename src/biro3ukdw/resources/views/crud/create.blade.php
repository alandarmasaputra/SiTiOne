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
<div class="container card">
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('/user') }}"><h1>Data User</h1> </a>
            <hr>
            
            
        </div>
    </div>
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">


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
    {!! Form::label('password_confirmation', 'Ulang Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password_confirmation') !!}


</div>

<div class="form-g">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('auth_level', 'Level:', ['class' => 'control-label']) !!} <br>
    {!! Form::select('auth_level', array('1' => 'Admin',  '2' => 'Staff', '3' => 'Volunteer')); !!}
</div>
<div class="form-g">
    {!! Form::label('is_aktif', 'Status:', ['class' => 'control-label']) !!}
    <br>{!! Form::select('is_aktif', array('0' => 'Tidak Aktif', '1' => 'Aktif')); !!}
</div>
{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}





{!! Form::close() !!}
 </table>
</div>
</div>
</div>



        @stop
            
				
