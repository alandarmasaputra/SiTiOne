@extends('layout.app')
@section('head_title')
Edit Event - Biro3 | UKDW
@endsection
@section('body_content')
<div class="container-fluid">
    <div class ="row">
         <div class ="col-md-8 col-md-offset-2">
             <div class ="panel panel-default">
<h2 class= "text-center" >Edit Event</h2>

    <hr>
 
{!! Form::model($event, ['method' => 'POST', 'action' => ['EventController@update', $event->id]]) !!}
    <div class="form-group">
        {!! Form::label('id', 'Id :') !!}
        {!! Form::text('id', null, array('class' => 'form-control')) !!}
    </div>
 <div class="form-group">
        {!! Form::label('kategori', 'Kategori :') !!}
        {!! Form::text('kategori', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sumber', 'Sumber :') !!}
        {!! Form::text('sumber', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('header_pic', 'Header Picture :') !!}
        {!! Form::text('header_pic', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tempat', 'Tempat :') !!}
        {!! Form::text('tempat', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('event_date', 'Event Date :') !!}
        {!! Form::date('event_date', null, array('class' => 'form-control')) !!}
    </div>
    
 <br>

    {!! Form::submit('Edit data', array('class' => 'btn btn-primary')) !!}
 <!-- -->
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection