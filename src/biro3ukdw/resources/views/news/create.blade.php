@extends('layout.app')
@section('head_title')
Edit News - Biro3 | UKDW
@endsection
@section('body_content')
<div class="container-fluid">
    <div class ="row">
         <div class ="col-md-8 col-md-offset-2">
             <div class ="panel panel-default">
<h2 class= "text-center" style="color:black;">Create News</h2>

    <hr>
 
{!! Form::model( ['method' => 'POST', 'action' => ['NewsController@update']]) !!}
    <div class="form-group">
        {!! Form::label( 'Id :') !!}
        {!! Form::text(null, array('class' => 'form-control')) !!}
    </div>
 
    <div class="form-group">
        {!! Form::label( 'HEADER_PIC :') !!}
        {!! Form::text( null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label( 'CONTENT :') !!}
        {!! Form::text( null, array('class' => 'form-control')) !!}
        
    </div>
 <br>

    {!! Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-left:45%')) !!}
 
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection