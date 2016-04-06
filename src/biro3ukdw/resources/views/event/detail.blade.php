@extends('layout.app')
@section('head_title')
Detail Event - Biro3 | UKW
@endsection
<?php 

use App\AppUtility;

?>
@section('body_content')
<div class="container-fluid body-content ukm-detail-body">
    <div class="text-left ukm-cover"
	 <?php
	 	if($event->header_pic){
	 ?>
	 	style="background-image: url('{{AppUtility::get_image_data($event->header_pic)}}')"
	 <?php
		}
	 ?>>
		<div class="ukm-item-facade">
			<div>
				<a href="{{ url('/event/') }}"><button class="button-inline"><span class="glyphicon glyphicon-menu-left"></span>back</button></a>
				<a href="{{ url('/event/edit/'.$event->id) }}"><button class="button-inline">edit</button></a>
				<button class="button-inline">delete</button>
			</div>
        	<h2 class="ukm-title">{{ $event->name }}</h2>
		</div>
    </div>
    <div class="text-left ukm-description">
        @foreach($event->content as $event_content)
        
            @if($event_content->type == 's')
                <div>
                    {!! $event_content->content !!}
                </div>
            @elseif($event_content->type == 'i')
                <img src="{{ AppUtility::get_image_data($event_content->content) }}">
            @endif

        @endforeach
    </div>
</div>
@endsection