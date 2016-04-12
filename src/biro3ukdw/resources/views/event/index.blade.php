@extends('layout.app')
@section('head_title')
Event - Biro3 | UKDW
@endsection

@section('nav_event')
active
@endsection

<?php
    use App\AppUtility;
?>

@section('body_content')


<div class="container-fluid body-content">
    <div class="page-header">
        <h2>
            Event 
        </h2>
    </div>
    <div class="ukm-container">
        <div class="ukm-item">
            <a href="{{url('/event/new')}}">
                <div class="ukm-item-facade text-center flex-column contents-center">
                    <div>
                        <h2>
                            <span class="glyphicon glyphicon-plus">
                            </span>
                        </h2>
                    </div>
                    <h2>
                        Tambah Event
                    </h2>
                </div>
            </a>
        </div>
        @foreach($events as $event)
        <div class="ukm-item"
            <?php if($event->header_pic){ ?>
            style="background-image: url('{{ AppUtility::get_image_data($event->header_pic)}}')"
            <?php } ?>>
            <div class="ukm-item-facade">
                <div class="ukm-preview-title">
                    <a href="{{ url('/event/'.$event->id) }}">
                        {{$event->name}}
                    </a>
                </div>
                <div class="ukm-preview-content">
                    @foreach($event->content as $content)
                        @if($content->type=='s')
                        <div>
                            {!!$content->content!!}
                        </div>
                            <?php break; ?>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
