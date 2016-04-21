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


  {!! Form::open(array('action' => array('UserController@updatess', $user->id))) !!}

<div class="form-g">
    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password') !!}


</div>

<div class="form-g">
    {!! Form::label('password_confirmation', 'Ulang Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password_confirmation') !!}


</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 


        @stop
            
            
        
                
