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
<div class=" container card">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
 <h1>Data User</h1> <hr>
 </div></div>

 <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">

  {!! Form::open(array('action' => array('UserController@updatess', $user->id))) !!}

<div class="form-g">
    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password') !!}


</div>

<div class="form-g">
    {!! Form::label('password_confirmation', 'Ulang Password:', ['class' => 'control-label']) !!}
    <br>{!! Form::password('password_confirmation') !!}


</div>


{!! Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 
</table></div></div>

        @stop
            
            
        
                
