@extends('layout.app')
@section('head_title')
Detail UKM - Biro3 | UKW
@endsection
<?php 

use App\AppUtility;

?>
@section('body_content')
<div class="container-fluid body-content ukm-detail-body">
    <div class="text-left ukm-cover"
	 <?php
	 	if($ukm->header_pic){
	 ?>
	 	style="background-image: url('{{AppUtility::get_image_data($ukm->header_pic)}}')"
	 <?php
		}
	 ?>>
		<div class="ukm-item-facade">
			<div>
				<a href="{{ url('/ukm/') }}"><button class="button-inline"><span class="glyphicon glyphicon-menu-left"></span>back</button></a>
				<a href="{{ url('/ukm/edit/'.$ukm->id) }}"><button class="button-inline">edit</button></a>
				<button class="button-inline">delete</button>
			</div>
        	<h2 class="ukm-title">{{ $ukm->name }}</h2>
		</div>
    </div>
    <div class="text-left ukm-description">
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