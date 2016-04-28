@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<section class="container">
       
            <div class="rows" >
            
                    <div class="blog-item">
                    	<div class="text-center">
                        <h1>CRUD USER </h1>
                        <hr>
                        </div>
                        <div class="row">  
                            <div class="col-xs-12 col-sm-12 blog-content">
                                        <div class="col-md-12 blog-content">
                                    <!-- Nav tabs --><div class="card">
                                  

                                    <!-- Tab panes -->
                                    <div class="tab-content">  
                                    	<ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#au" aria-controls="home" role="tab" data-toggle="tab">Data User</a></li>
                                        <li role="presentation"><a href="#tt" aria-controls="profile" role="tab" data-toggle="tab">Create user</a></li>
                                        <li role="presentation"><a href="#vm" aria-controls="messages" role="tab" data-toggle="tab">Admin</a></li>
                                        <li role="presentation"><a href="#tp" aria-controls="settings" role="tab" data-toggle="tab">Staff</a></li>
                                        <li role="presentation"><a href="#lu" aria-controls="settings" role="tab" data-toggle="tab">Volunteer</a></li>
                                        <li role="presentation"> <a href="{{url('/editprofile')}}" >Edit Profile</a></li>
                                    </ul>    
                                    <hr>
                                                                    
                                        <div role="tabpanel" class="tab-pane active" id="au">
                                        <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            	                        <h3>Data User</h3>
                                        <thead>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        </thead>
                    <tbody>
                    @foreach ($user as $data)
                    <tr>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email}}</td>
                        @if($data->auth_level=="0")
                        <td>Super Admin</td>
                        @elseif($data->auth_level=="1")
                        <td>Admin</td>
                        @elseif($data->auth_level=="2")
                        <td>Staff</td>
                        @else
                        <td>Volunteer</td>
                        @endif

                        @if($data->is_aktif=="0")   
                        <td>Tidak aktif</td>
                        @else
                        <td>Aktif</td>
                        @endif  
                        <td>                
                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
                        {!! Form::submit('Hapus') !!}   
                        {!! Form::close() !!}

                        </td>
                        <td><a href="{{url('/cruduser/edit/'.$data->id)}}"><b>Edit Data<b></a>
                        <td><a href="{{url('/cruduser/resets/'.$data->id)}}"><b>Reset Password<b></a>  </td>  </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
            
        </div></div><hr></div>
                                    





        

        <div role="tabpanel" class="tab-pane" id="vm">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            	<h3>Admin</h3>
                <thead>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    @if($data->auth_level=="1")
                    <tr>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email}}</td>
                        <td>Admin</td>
                        @if($data->is_aktif=="0")   
                        <td>Tidak aktif</td>
                        @else
                        <td>Aktif</td>
                        @endif  
                        <td>                
                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
                        {!! Form::submit('Hapus') !!}   
                        {!! Form::close() !!}

                        </td>
                        <td><a href="{{url('/cruduser/edit/'.$data->id)}}"><b>Edit Data<b></a>
                        <td><a href="{{url('/cruduser/resets/'.$data->id)}}"><b>Reset Password<b></a>  </td>  </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
          
        </div>
    </div>
                                    <hr>    </div>







                                        
<div role="tabpanel" class="tab-pane" id="tt">
<?php 
use App\AppUtility;

?>

<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            <h3>Create User</h3>


 {!! Form::model( new App\User, [
    'route' => ['user.store']
]) !!}

<div class="form-g">
    {!! Form::label('username', 'Username:') !!}
    <br>{!! Form::text('username') !!}
</div>

<div class="form-g">
    {!! Form::label('password', 'Password:') !!}
    <br>{!! Form::password('password') !!}
</div>

<div class="form-g">
    {!! Form::label('password_confirmation', 'Ulang Password:') !!}
    <br>{!! Form::password('password_confirmation') !!}
</div>

<div class="form-g">
    {!! Form::label('email', 'Email:') !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('auth_level', 'Level:') !!} <br>
    {!! Form::select('auth_level', array('0' => 'Super Admin', '1' => 'Admin',  '2' => 'Staff', '3' => 'Volunteer')); !!}
</div>
<div class="form-g">
    {!! Form::label('is_aktif', 'Status:') !!}
    <br>{!! Form::select('is_aktif', array('0' => 'Tidak Aktif', '1' => 'Aktif')); !!}
</div>
{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
 </table>
</div>
</div><hr>
</div>
                                        
        <div role="tabpanel" class="tab-pane" id="tp">                                           
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            	<h3>Staff Admin</h3> 
                <thead>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    @if($data->auth_level=="2")
                    <tr>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email}}</td>
                        <td>Staff</td>
                        @if($data->is_aktif=="0")   
                        <td>Tidak aktif</td>
                        @else
                        <td>Aktif</td>
                        @endif  
                        <td>                
                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
                        {!! Form::submit('Hapus') !!}   
                        {!! Form::close() !!}

                        </td>
                        <td><a href="{{url('/cruduser/edit/'.$data->id)}}"><b>Edit Data<b></a>
                        <td><a href="{{url('/cruduser/resets/'.$data->id)}}"><b>Reset Password<b></a>  </td>  </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div><hr>
                                        </div>
                                        
                                        

        <div role="tabpanel" class="tab-pane" id="lu">                                          
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered">
            	<h3>Volunteer</h3> 
                <thead>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    @if($data->auth_level=="3")
                    <tr>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->email}}</td>
                        <td>Volunteer</td>
                        @if($data->is_aktif=="0")   
                        <td>Tidak aktif</td>
                        @else
                        <td>Aktif</td>
                        @endif  
                        <td>                
                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $data->id]]) !!}
                        {!! Form::submit('Hapus') !!}   
                        {!! Form::close() !!}

                        </td>
                        <td><a href="{{url('/cruduser/edit/'.$data->id)}}"><b>Edit Data<b></a>
                        <td><a href="{{url('/cruduser/resets/'.$data->id)}}"><b>Reset Password<b></a>  </td>  </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div><hr>
                                        </div></div>
                                    </div>
                                </div>
                             </div>
                           
                    </div><!--/.blog-item-->
                   
                </div><!--/.col-md-8-->
                
            </div>
        </div>
        
    </section><!--/#blog-->
@endsection