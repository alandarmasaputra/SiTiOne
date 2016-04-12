@extends('layout.app')
@section('head_title')
Detail Event - Biro3 | UKW
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
                    <a href="{{ url('/event') }}">
                        <span class="glyphicon glyphicon-menu-left">
                        </span>
                    </a>
                </button>
                <h2>
                    Event {{$event->name}}
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="beasiswa-detail-body body-content">
            <div class="beasiswa-detail-header">
                <div class="beasiswa-detail-pic">
                    @if($event->header_pic)
                    <img src="{{AppUtility::get_image_data($event->header_pic)}}">
                    @else
                    
                    <img src="{{url('style/images/ico/beasiswa_dalam.png')}}">
                    
                    @endif
                    
                </div>
                @if(Auth::user())
                <div class="beasiswa-detail-header-buttons">
                    <a href="{{url('/event/edit/'.$event->id)}}"><button>Edit</button></a>
                    <a href="#"><button class="button-delete">Delete</button></a>
                </div>
                @endif
                <h2 class="beasiswa-detail-header-title">{{$event->name}}</h2>
               
                <br>
            </div>
            <div class="beasiswa-detail-description">
                <dl class="beasiswa-detail-metadata">
                    
                    
                    
                    <dt>Created At</dt>
                    <dd>
                        {{(new Carbon($event->craeted_at))->format('l, d F Y')}}
                    </dd>
                </dl>
                @foreach($event->content as $content)
                {!! $content->content !!}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection