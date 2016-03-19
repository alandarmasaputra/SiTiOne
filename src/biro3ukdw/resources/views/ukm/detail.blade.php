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
        @if($ukm->header_pic)
            <img src="{{ AppUtility::get_image_data($ukm->header_pic) }}">
        @endif
        <h2>{{ $ukm->name }}</h2>
    </div>
    <div class="text-center">
        @foreach($ukm->content as $ukm_content)
        
            @if($ukm_content->type == 's')
                <div>
                    {!! $ukm_content->content !!}
                </div>
            @elseif($ukm_content->type == 'i')
                <img src="{{ AppUtility::get_image_data($ukm_content->content) }}">
            @endif

        @endforeach
    </div>
</div>
@endsection