@extends('layout.app')

@section('head_title')
New Beasiswa - Biro3 | UKW
@endsection

@section('nav_beasiswa')
active
@endsection

@section('head_addition')
	<link href="{{ url('utility/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
	<script src="{{ url('utility/summernote/summernote.js') }}"></script>
@endsection

@section('body_content')
<div class="container-fluid body-content">
    @if(session('errorMessage'))
        <div>
            <span class="label label-warning">Alert</span> {{ session('errorMessage') }}
        </div>
    @endif
    @if(session('successMessage'))
        <div>
            <span class="label label-success">Success</span> {{ session('successMessage') }}
        </div>    
    @endif
    <div class="page-header">
        <h2>
            Beasiswa Baru
        </h2>
    </div>
    <!-- jangan diubah ubah -->
    <div class="editor editor-new">
        <form method="post" action="{{ url('/beasiswa/new') }}" enctype="multipart/form-data"><!--  -->
            {!! csrf_field() !!}
            <div class="editor-header">
				<div id="header-pic-show">
					<div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
					<label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                </div>
                <h2 class="text-left nofade">
					<label>Judul Beasiswa:</label>
					<input name="title" id="editor-header-title" type="text" required>
				</h2>
				<br>
				
				<div>
					<label>Sumber: </label>
					<input type="text" name="sumber" required>
				</div>
				<br>
				
				<div>
					<label>Deadline-date: </label>
					<input type="date" name="deadline-date" required>
				</div>
				<br>
				<div>
					<label>Kategori: </label>
					<input type="radio" name="kategori-utama" value="internal" required><label>Internal</label>
					<input type="radio" name="kategori-utama" value="external" required><label>External</label>
				</div>
				
				<label>Tag</label>
				<div>
					<input type="text" id="tag-input"><button id="tag-add"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
				<div id="tag-list">
				</div>
				<input type="hidden" id="kategori-tambahan" name="kategori-tambahan">
				<br>
            </div>
			<h2 class="editor-content-label text-left">
				Deskripsi
			</h2>
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
@endsection