@extends('layout.app')
@section('head_title')
Create Beasiswa - Biro3 | UKDW
@endsection
@section('body_content')
<div class="container-fluid">
    <div class ="row">
         <div class ="col-md-8 col-md-offset-2">
             <div class ="panel panel-default">
<h2 class= "text-center" >Create Beasiswa</h2>

    <hr>
 
{!! Form::model(['method' => 'POST', 'action' => ['BeasiswaController@submit_new']]) !!}
        <div class="form-group">
        {!! Form::label('kategori', 'Kategori :') !!}
        {!! Form::text('kategori', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sumber', 'Sumber :') !!}
        {!! Form::text('sumber', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('jumlah', 'Jumlah :') !!}
        {!! Form::text('jumlah', null, array('class' => 'form-control')) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('header_pic', 'Header Picture :') !!}
        {!! Form::text('header_pic', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('deadline_date', 'Deadline Date :') !!}
        {!! Form::date('deadline_date', null, array('class' => 'form-control')) !!}
    </div>
    
 <br>

    {!! Form::submit('Create data', array('class' => 'btn btn-primary')) !!}
 <!-- -->
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection