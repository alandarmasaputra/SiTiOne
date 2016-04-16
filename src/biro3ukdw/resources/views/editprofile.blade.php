@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<div class="page-header">
 <h1>EDIT PROFILE</h1> <hr>
 </div>
 <br>
 @if(Auth::user()-> auth_level <= 1)
 <div class="page-header">
 	
    <a href="{{url('/user')}}"><button class="button-delete">CRUD USER</button></a>
   
 </div>
   
  @endif

@stop

