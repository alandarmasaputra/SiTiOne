@extends('layout.app')
@section('head_title')
Event Baru
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
            Event Baru
        </h2>
    </div>
    <!-- jangan diubah ubah -->
    <div class="text-left editor editor-new">
        <form method="post" action="{{ url('/event/new') }}" enctype="multipart/form-data"><!--  -->
            {!! csrf_field() !!}
            <div class="editor-header">
                <div id="header-pic-show">
                    <div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
                    <label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                </div>
                <h2 class="text-left nofade">
                    <label>Nama Event:</label>
                    <input name="title" id="editor-header-title" type="text" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Kategori Event:</label>
                    <input name="kategori" type="text" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Sumber Event:</label>
                    <input name="sumber" type="text" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Tempat Event:</label>
                    <input name="tempat" type="text" required>
                </h2>
                <div>
                    <label>Deadline-date: </label>
                    <input type="date" name="tanggal" required>
                </div>
                
            </div>
            <h2 class="editor-content-label text-left">
                Content
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
        </form>
    </div>
    <!-- -->
</div>
@endsection