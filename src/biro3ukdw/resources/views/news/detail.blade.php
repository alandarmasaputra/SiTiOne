@extends('layout.app')
@section('head_title')
Detail News - Biro3 | UKW
@endsection
@section('body_content')
<?php
use App\AppUtility;
use Carbon\Carbon;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <button>
                    <a href="{{ url('/news') }}">
                        <span class="glyphicon glyphicon-menu-left">
                        </span>
                    </a>
                </button>
                <h2>
                    News {{$news->name}}
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="beasiswa-detail-body body-content">
            <div class="beasiswa-detail-header">
                <div class="beasiswa-detail-pic">
                    @if($news->header_pic)
                    <img src="{{AppUtility::get_image_data($news->header_pic)}}">
                    @else
                    
                    <img src="{{url('style/images/ico/beasiswa_dalam.png')}}">
                    
                    @endif
                    
                </div>
                @if(Auth::user())
                <div class="beasiswa-detail-header-buttons">
                    <a href="{{url('/news/edit/'.$news->id)}}"><button>Edit</button></a>
                    <a href="{{url('/news/delete/'.$news->id)}}"><button class="button-delete">Delete</button></a>
                </div>
                @endif
                <h2 class="beasiswa-detail-header-title">{{$news->name}}</h2>
               
                <br>
            </div>
            <div class="beasiswa-detail-description">
                <dl class="beasiswa-detail-metadata">
                    
                    <dt>Kata Kunci</dt>
                    <dd>
                        <div>
                            @foreach(explode(' ',$news->kategori) as $tag)
                            <span class="tag-list-item">{{$tag}}</span>
                            @endforeach
                        </div>
                    </dd>
                    <br>
                    <dt>Created At</dt>
                    <dd>
                        {{(new Carbon($news->craeted_at))->format('l, d F Y')}}
                    </dd>
                </dl>
                @foreach($news->content as $content)
                {!! $content->content !!}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection