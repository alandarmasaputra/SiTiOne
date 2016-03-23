@extends('layout.app')

@section('head_title')
New Beasiswa - Biro3 | UKW
@endsection

@section('head_addition')
	<link href="{{ url('utility/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
	<script src="{{ url('utility/summernote/summernote.js') }}"></script>
@endsection

@section('body_content')
<div class="container">
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
    <div class="text-center editor">
        <form method="post" action="{{ url('/beasiswa/new') }}" enctype="multipart/form-data"><!--  -->
            {!! csrf_field() !!}
            <div class="editor-header">
                <div><label>Photo</label></div>
                <img id="header-pic-show">
                <br>
                <div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
                <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                <h2>
                <div><label>Nama UKM</label></div>
                <input name="title" type="text" required></h2>
            </div>
            <hr>
            <div id="editor-content">
            </div>
            <button id="new-paragraph"><span class="glyphicon glyphicon-plus"></span> Paragraph</button>
            <button id="new-image"><span class="glyphicon glyphicon-plus"></span> Image</button>
            
            <br>
            <br>
            <input type="submit">
            
            <!-- include harus sebelum tutup form -->
            <script src="{{ url('utility/editor/editor.js') }}"></script>
        </form>
    </div>
    <!-- -->
</div>
@endsection