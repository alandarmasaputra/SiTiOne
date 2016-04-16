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
$addition = $user->addition() 
?>
<div class="card">
 <h1>Data User</h1> <hr>

<!--
 {!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['user.update', $user->id]
]) !!}

<div class="form-g">
    {!! Form::label('title', 'Username:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('username') !!}
</div>

<div class="form-g">
    {!! Form::label('description', 'Email:', ['class' => 'control-label']) !!}
   <br> {!! Form::text('email') !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Level:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('auth_level') !!}
</div>
<div class="form-g">
    {!! Form::label('description', 'Status:', ['class' => 'control-label']) !!}
    <br>{!! Form::text('is_aktif') !!}
</div>


{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
 -->
 <div class="row">
                <div class="col-md-12 body-content card">
                    <!-- jangan diubah ubah -->
                    <div>
                        <form method="post" action="{{ url('/edituser/edit/'.$user->id) }}" enctype="multipart/form-data"><!--  -->
                            {!! csrf_field() !!}
                            
                                <div class="editor-header-input-group">
                                    <div class="editor-header-input-control">
                                        <label>Jabatan User:</label>
                                        <input type="text" name="jabatan" <?php if($addition){ echo 'value=$addition->jabatan'; } ?>>
                                    </div>
                                    <div class="editor-header-input-control">
                                        <label>Email User:</label>
                                        <input type="text" name="email" value="{{ $user->email }}"  >
                                    </div>
                                    <div class="editor-header-input-control">
                                        <label>Telepon User:</label>
                                        <input type="text" name="email" <?php if($addition){ echo 'value="$addition->phone"'; } ?>  >
                                    </div>
                                       
                                </div>
                            </div>
                            
                            <br>
                            <br>
                            <div class="text-center">
                                <input type="submit">
                            </div>

                            <!-- include harus sebelum tutup form -->
                            <script src="{{ url('utility/editor/editor.js') }}"></script>
                            <script src="{{ url('utility/editor/editor_load.js') }}"></script>
                            <script src="{{ url('utility/editor/tagmanager.js')}}"></script>
                            <script src="{{ url('utility/editor/tagmanager_load.js')}}"></script>
                        </form>
                    </div>
                    <!-- -->
                </div>
            </div>

		@stop
			
			
		
				
