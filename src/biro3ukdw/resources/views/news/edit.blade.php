@extends('layout.app')
@section('head_title')
Edit News - Biro3 | UKDW
@endsection
@section('body_content')
<div class="container-fluid">
    <div class ="row">
         <div class ="col-md-8 col-md-offset-2">
             <div class ="panel panel-default">
<h2 class= "text-center" >Edit News</h2>

    <hr>
 
{!! Form::model($news, ['method' => 'PATCH', 'action' => ['NewsController@update', $news->id]]) !!}
    <div class="form-group">
        {!! Form::label('id', 'Id :') !!}
        {!! Form::text('id', null, array('class' => 'form-control')) !!}
    </div>
 
    <div class="form-group">
        {!! Form::label('header_pic', 'HEADER_PIC :') !!}
        {!! Form::text('header_pic', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('header_pic', 'CONTENT :') !!}
        {!! Form::text('header_pic', null, array('class' => 'form-control')) !!}
    </div>
 <br>

    {!! Form::submit('Edit data', array('class' => 'btn btn-primary')) !!}
 
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection