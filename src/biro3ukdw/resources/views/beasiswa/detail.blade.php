@extends('layout.app')
@section('head_title')
Detail Beasiswa - Biro3 | UKW
@endsection
@section('body_content')
<?php
use App\AppUtility;
?>
<div class="container-fluid body-content">
    <div class="page-header">
        <h2>
            Detail Beasiswa
        </h2>
    </div>
    <div class="beasiswa-detail-body">
		<div class="beasiswa-detail-header">
			<div class="ukm-detail-pic">
				@if($beasiswa->header_pic)
				<img src="{{AppUtility::get_image_data($beasiswa->header_pic)}}">
				@else
				@if(strpos($beasiswa->kategori,'internal')!==false)
				<?php $internal = true ?>
				<img src="{{url('style/images/ico/beasiswa_dalam.png')}}">
				@else
				<?php $internal = false ?>
				<img src="{{url('style/images/ico/beasiswa_luar.png')}}">
				@endif
				@endif
			</div>
			<div class="beasiswa-detail-header-buttons">
				<a href="{{url('/beasiswa/edit/'.$beasiswa->id)}}"><button>Edit</button></a>
				<a href="#"><button>Delete</button></a>
			</div>
			<h1>{{$beasiswa->name}}</h1>
			@if($internal)
			<h4>Beasiswa Internal</h4>
			@else
			<h4>Beasiswa External</h4>
			@endif
			<br>
			<div>
				@foreach(explode(' ',$beasiswa->kategori) as $tag)
				<span class="tag-list-item">{{$tag}}</span>
				@endforeach
			</div>
		</div>
		<div class="beasiswa-detail-description">
			@foreach($beasiswa->content as $content)
			{!! $content->content !!}
			@endforeach
		</div>
    </div>
</div>
@endsection