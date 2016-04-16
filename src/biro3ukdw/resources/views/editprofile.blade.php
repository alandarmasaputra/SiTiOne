@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')
<?php 
$addition = $user->addition();
?>
<div class="page-header">
	<h1>EDIT PROFILE</h1>
	<hr>
</div>
<br>
@if(Auth::user()-> auth_level <= 1)
<div class="page-header">
	<a href="{{url('/user')}}"><button class="button-delete">CRUD USER</button></a>
</div>
<?php $addition = $user->addition();
?>
@endif
<div class="row">
	<div class="col-md-12 body-content card">
		<!-- jangan diubah ubah -->
		<div>
			<form method="post" action="{{ url('/edituser/edit/'.$user->id) }}" enctype="multipart/form-data"><!--  -->
				{!! csrf_field() !!}

					<div class="editor-header-input-group">
						<div class="editor-header-input-control">
							<label>Jabatan User:</label>
						   	<input type="text" name="jabatan">
						</div>
						<div class="editor-header-input-control">
							<label>Email User:</label>
							<input type="text" name="email" value="{{ $user->email }}"  >
						</div>
						<div class="editor-header-input-control">
							<label>Telepon User:</label>
							<input type="text" name="email">
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

