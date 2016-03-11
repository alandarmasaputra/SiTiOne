@extends('app')
 
@section('body_content')
    <h1>Edit Data <small></small></h1>
    <hr>
 
{!! Form::model($news, ['method' => 'Post', 'action' => ['NewsController@update', $news->id]]) !!}
    <div class="form-group">
        {!! Form::label('id', 'Id :') !!}
        {!! Form::text('id', null, array('class' => 'form-control')) !!}
    </div>
 
    <div class="form-group">
        {!! Form::label('header_pic', 'HEADER_PIC :') !!}
        {!! Form::text('header_pic', null, array('class' => 'form-control')) !!}
    </div>
 
    {!! Form::submit('Edit data', array('class' => 'btn btn-primary')) !!}
 
{!! Form::close() !!}
 
@stop