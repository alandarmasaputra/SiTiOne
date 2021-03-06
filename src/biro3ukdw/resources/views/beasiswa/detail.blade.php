@extends('layout.app')
@section('head_title')
Detail Beasiswa - Biro3 | UKW
@endsection

@section('nav_beasiswa')
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
				<a href="{{ url('/beasiswa') }}">
					<button>
						<span class="glyphicon glyphicon-menu-left">
						</span>
					</button>
				</a>
				<h2>
					Beasiswa {{$beasiswa->name}}
				</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="beasiswa-detail-body body-content">
			<div class="beasiswa-detail-header">
				<div class="beasiswa-detail-pic">
					@if($beasiswa->header_pic)
					<img src="{{AppUtility::get_image_data($beasiswa->header_pic)}}">
					@else
						@if($beasiswa->isInternal())
						<?php $internal = true ?>
						<img src="{{url('style/images/ico/beasiswa_dalam.png')}}">
						@else
						<?php $internal = false ?>
						<img src="{{url('style/images/ico/beasiswa_luar.png')}}">
					@endif
					@endif
				</div>
				@if(Auth::user())
				<div class="beasiswa-detail-header-buttons">
					<a href="{{url('/beasiswa/edit/'.$beasiswa->id)}}"><button>Edit</button></a>
					<a href="{{url('/beasiswa/delete/'.$beasiswa->id)}}" onclick="return confirm('Anda yakin akan melakukan delete?');"><button class="button-delete">Delete</button></a>
				</div>
				@endif
				<h2 class="beasiswa-detail-header-title"><strong>{{$beasiswa->name}}</strong></h2>
				@if($beasiswa->isInternal())
				<h4>Beasiswa Internal</h4>
				@else
				<h4>Beasiswa External</h4>
				@endif
				<br>
			</div>
			<div class="beasiswa-detail-description">
				<dl class="beasiswa-detail-metadata">
					<dt>Sumber</dt>
					<dd>{{ $beasiswa->sumber }}</dd>
					<dt>Tags</dt>
					<dd>
						<div class="tag-list-container">
							@foreach(explode(' ',$beasiswa->kategori) as $tag)
							<a href="{{ url('/search?q='.$tag) }}"><span class="tag-list-item">{{$tag}}</span></a>
							@endforeach
						</div>
					</dd>
					@if($beasiswa->deadline_date)
					<dt>Pendaftaran Terakhir</dt>
					<dd>
						{{(new Carbon($beasiswa->deadline_date))->format('l, d F Y')}}
					</dd>
					@endif
				</dl>
				@foreach($beasiswa->content as $content)
				@if($content->type=='i')
				<div class="img-container">
					<img src="{{AppUtility::get_image_data($content->content)}}">
				</div>
				@else
				{!! $content->content !!}
				@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection