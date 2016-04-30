@extends('layout.app')
@section('head_title')
Detail News - Biro3 | UKW
@endsection


@section('nav_news')
active
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
        <div class="news-detail-body body-content">
            <div class="news-detail-header">
				{{(new Carbon($news->craeted_at))->format('l, d F Y')}}
				<h1 class="news-detail-header-title">{{$news->name}}</h1>
				<hr>
				<div class="news-detail-pic">
				@if($news->header_pic)
					<img src="{{AppUtility::get_image_data($news->header_pic)}}">
				@endif
				</div>
				<br>
				@if(Auth::user())
				<div class="news-detail-header-buttons">
					<a href="{{url('/news/edit/'.$news->id)}}"><button>Edit</button></a>
					<a href="{{url('/news/delete/'.$news->id)}}"><button class="button-delete">Delete</button></a>
				</div>
				@endif
				<div class="news-detail-description">
					@foreach($news->content as $content)
					@if($content->type=='i')
					<div class="img-container">
						<img src="{{AppUtility::get_image_data($content->content)}}">
					</div>
					@else
					{!! $content->content !!}
					@endif
					@endforeach
				</div>
				<div class="news-detail-description">
					<span class="glyphicon glyphicon-tags"> </span> <span>Tags:</span>
					@foreach(explode(' ',trim($news->kategori)) as $tag)
					@if($tag!='')
					<a href="{{ url('/search?q='.$tag) }}"><span class="tag-list-item">{{$tag}}</span></a>
					@endif
					@endforeach
				</div>
            </div>
           
        </div>
    </div>
</div>
@endsection