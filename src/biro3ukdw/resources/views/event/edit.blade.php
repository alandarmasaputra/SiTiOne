@extends('layout.app')
@section('head_title')
Edit Event - Biro3 | UKDW
@endsection

@section('head_addition')
<link href="{{ url('utility/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
<script src="{{ url('utility/summernote/summernote.js') }}"></script>
@endsection

<?php
use App\AppUtility;
use Carbon\Carbon;
?>

@section('body_content')
<div class="container">
    @if(session('errorMessage'))
        <div>
            <span class="label label-warning">Alert</span> {{ session('error_message') }}
        </div>
    @endif
    @if(session('successMessage'))
        <div>
            <span class="label label-success">Success</span> {{ session('success_message') }}
        </div>    
    @endif
    <div class="page-header">
        <h2>
            Edit Event
        </h2>
    </div>
    <!-- jangan diubah ubah -->
    <div class="text-left editor">
        <form method="post" action="{{ url('/event/update/'.$event->id) }}" enctype="multipart/form-data"><!--  -->
            {!! csrf_field() !!}
            <div class="editor-header">
                     
                @if($event->header_pic)
                <div id="header-pic-show" style="background-image: url('{{AppUtility::get_image_data($event->header_pic) }}'); height: 400px">
                    <div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
                    <label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                </div>
                @else
                <div id="header-pic-show">
                    <div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
                    <label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                </div>
                @endif
                <textarea name="header-pic-old" style="display:none;">{{ $event->header_pic }}</textarea>
                <h2>
                    <label>Nama event:</label>
                    <input name="title" id="editor-header-title" type="text" value="{{ $event->name }}" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Kategori Event:</label>
                    <input name="kategori" id="editor-header-title" type="text" value="{{ $event->kategori }}" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Sumber Event:</label>
                    <input name="sumber" id="editor-header-title" type="text" value="{{ $event->sumber }}" required>
                </h2>
                <h2 class="text-left nofade">
                    <label>Tempat Event:</label>
                    <input name="tempat" id="editor-header-title" type="text" value="{{ $event->tempat }}" required>
                </h2>
                <div>
                    <label>Tanggal Event:</label>
                    <input type="date" name="tanggal" value="{{ (new Carbon($event->event_date))->format('Y-m-d') }}" required>
                </div>
            </div>
            <h2 class="editor-content-label text-left">
                Content
            </h2>
            <div id="editor-content">
                <?php
                    //start counter
                    $i = 0;
                ?>
                @foreach($event->content as $content)
                
                
                <div class="editor-item row">
                    <div class="editor-item-number">{{ $i+1 }}</div>
                    <div class="editor-record">
                    @if($content->type == 's')
                        <input class="editor-item-id" type="hidden" name="type-{{$i}}" value="text" id="type-{{$i}}">
                        <textarea class="content-old" id="content-{{$i}}-old" name="content-{{$i}}-old" style="display:none;">{{ $content->content }}</textarea>
                        <textarea class="editor-paragraph" id="paragraph-{{$i}}" name="paragraph-{{$i}}" style="display: none;"></textarea>
                        
                    @elseif($content->type == 'i')
                        <input class="editor-item-id" type="hidden" name="type-{{$i}}" value="image" id="type-{{$i}}">
                        <textarea class="content-old" id="content-{{$i}}-old" name="content-{{$i}}-old" style="display:none;">{{ $content->content }}</textarea>
                        <div class='editor-image-show' style="background-image:url('{{ AppUtility::get_image_data($content->content) }}'); height:400px;'">
                            <input class='editor-image' type='file' onchange='imageupload(this)'>
                        </div>
                    @endif
                    </div>
                    {!! newButtonPanel() !!}
                </div>
                
                
                
                <?php
                    //iterates counter
                    $i += 1;
                ?>
                @endforeach
            </div>
            <button type="button" id="new-paragraph"><span class="glyphicon glyphicon-plus"></span> Paragraph</button>
            <button type="button" id="new-image"><span class="glyphicon glyphicon-plus"></span> Image</button>
            
            <br>
            <br>
            <div class="text-center">
                <input type="submit">
            </div>
            
            <!-- include harus sebelum tutup form -->
            <script src="{{ url('utility/editor/editor.js') }}"></script>
        </form>
        <script src="{{ url('utility/editor/editor_load.js') }}"></script>
    </div>
    <!-- -->
</div>
@endsection

<?php

function newButtonPanel(){
    return "<div class='editor-button'>"
                ."<button type='button' onclick='insertParagraphBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Text</button>"
                ."<button type='button' onclick='insertImageBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Image</button>"
                ."<button type='button' onclick='deleteParent(event,this)'><span class='glyphicon glyphicon-remove'></span>Delete</button>"
            ."</div>";
}

?>