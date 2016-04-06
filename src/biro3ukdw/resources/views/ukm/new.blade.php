@extends('layout.app')
@section('head_title')
UKM Baru
@endsection

@section('head_addition')
<link href="{{ url('utility/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
<script src="{{ url('utility/summernote/summernote.js') }}"></script>
@endsection

@section('body_content')

<div class="container">
	<div class="row">
		<div class="col-sm-3">
			@include('layout.dashboard')
		</div>
		<div class="col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<button>
							<a href="{{ url('/ukm') }}">
								<span class="glyphicon glyphicon-menu-left">
								</span>
							</a>
						</button>
						<h2>
							UKM Baru
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 body-content card">
					<!-- jangan diubah ubah -->
					<div class="editor editor-new">
						<form method="post" action="{{ url('/ukm/new') }}" enctype="multipart/form-data"><!--  -->
							{!! csrf_field() !!}
							<div class="editor-header">
								<div id="header-pic-show">
									<div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
									<label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
								</div>
								<h2 class="text-left nofade">
									<input name="title" id="editor-header-title" type="text" placeholder="Nama UKM" required>
								</h2>
							</div>
							<div class="editor-content-container text-center">
								<div id="editor-content">
								</div>
								<button id="new-paragraph"><span class="glyphicon glyphicon-plus"></span> Paragraph</button>
								<button id="new-image"><span class="glyphicon glyphicon-plus"></span> Image</button>
							</div>
							<br>
							<br>
							<div class="text-center">
								<input type="submit">
							</div>

							<!-- include harus sebelum tutup form -->
							<script src="{{ url('utility/editor/editor.js') }}"></script>
							<script src="{{ url('utility/editor/editor_new.js') }}"></script>
							<script src="{{ url('utility/editor/tagmanager.js')}}"></script>
						</form>
					</div>
					<!-- -->
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection