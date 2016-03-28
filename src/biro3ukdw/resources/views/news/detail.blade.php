@extends('layout.app')
@section('head_title')
New UKM - Biro3 | UKW
@endsection
<?php 

use App\AppUtility;

?>
@section('body_content')
<div class="container-fluid">
    <div class="text-center">
        @if($news->header_pic)
            <img src="{{ AppUtility::get_image_data($news->header_pic) }}">
        @endif
        <h2>{{ $news->name }}</h2>
    </div>
    <div class="text-center">
        @foreach($news->content as $news_content)
        
            @if($news_content->type == 's')
                <div>
                    {!! $news_content->content !!}
                </div>
            @elseif($news_content->type == 'i')
                <img src="{{ AppUtility::get_image_data($news_content->content) }}">
            @endif

        @endforeach
    </div>
</div>
@endsection