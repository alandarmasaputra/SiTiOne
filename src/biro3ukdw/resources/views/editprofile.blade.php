@section('head_title')
Biro3 | UKDW
@endsection

@extends('layout.app')
@section('body_content')

<?php
use App\AppUtility;
$addition = $user->addition();
?>

<div class="container card">
	<div class="row">
		<div class="col-md-12">
			<?php if(Auth::user()->auth_level<=1){?>
			<div class='row'>
				<div class="col-xs-10 col-xs-offset-1 text-center">
					Sebagai administrator anda memiliki akses untuk mengedit user yang ada di website ini dengan mengeklik tombol berikut
					<br><a href="{{url('/user')}}"><button class="button-delete">Ubah User</button></a>
					<a href="{{url('/admin/reset/'.$user->id)}}"><button class="button-delete">Ubah Password Anda</button></a>
				</div>
			</div>
			<?php } ?>
			<form method="post" action="{{ url('/editprofile/editself') }}" enctype="multipart/form-data"><!--  -->
				{!! csrf_field() !!}
				<div class="row">
					<div>
						<div class="editor-header-input-group">
							<div class="editor-header-input-control">
								<label>Nama User:</label>
								<input type="text" name="display_name" <?php if($addition){if($addition->display_name){echo "value='$addition->display_name'";}} ?>>
							</div>
							<div class="editor-header-input-control">
								<label>Jabatan User:</label>
								<input type="text" name="jabatan" <?php if($addition){if($addition->jabatan){echo "value='$addition->jabatan'";}} ?>>
							</div>
							<div class="editor-header-input-control">
								<label>Email User:</label>
								<input type="text" name="email" value="{{ $user->email }}"  >
							</div>
							<div class="editor-header-input-control">
								<label>Telepon User:</label>
								<input type="text" name="phone" <?php if($addition){if($addition->phone){echo "value='$addition->phone'";}} ?>>
							</div>
							<div class="editor-header-input-control display-picture"
								 <?php if($addition){if($addition->display_pic){echo 'style="background-image:url(\''.AppUtility::get_image_data($addition->display_pic).'\');"';}} ?>
								 >
								<label>Foto:</label>
								<textarea class="hidden" name='foto-old'> <?php if($addition){if($addition->display_pic){echo AppUtility::get_image_data($addition->display_pic);}} ?></textarea>
								<input type="file" name="foto">
							</div>
						</div>
					</div>
				</div>

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
	</div>
</div>

@stop

