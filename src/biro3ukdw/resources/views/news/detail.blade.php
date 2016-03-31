@extends('layout.app')
@section('head_title')
New News - Biro3 | UKW
@endsection
<?php 

use App\AppUtility;

?>
@section('body_content')
<div class="container-fluid body-content body-ukm-detail">
    <div class="text-left ukm-cover"
     <?php
        if($news->header_pic){
     ?>
        style="background-image: url('{{AppUtility::get_image_data($news->header_pic)}}')"
     <?php
        }
     ?>>
        <div class="ukm-item-facade">
            <div>
                <a href="{{ url('/news/edit/'.$news->id) }}"><button class="button-inline">edit</button></a>
                <button class="button-inline">delete</button>
            </div>
            <h2 class="ukm-title">{{ $news->name }}</h2>
        </div>
    </div>
    <div class="text-left ukm-description">
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