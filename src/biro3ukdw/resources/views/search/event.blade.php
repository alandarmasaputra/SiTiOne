<?php
	use Carbon\Carbon;
?>

@foreach($events as $event)
<div class="item">
	<div class="text-left">
		<small>{{(new Carbon($event->created_at))->format('l, d F Y')}}</small>
		<a href="{{url('/event/'.$event->id)}}">
			<div class="judul">
				{{ $event->name }}
			</div>
		</a>
	</div>
	<?php 
	$tags = $event->kategori;
	$printTags = trim($tags) != '';
	$tags = explode(' ',$tags);
	?>
	@if($printTags)
	<div class="text-left">
		<span class="glyphicon glyphicon-tags"></span> Tags:
		@foreach($tags as $tag)
			@if($tag!='')
			<span class="tag-list-item">
			{{ $tag }}
			</span>
			@endif
		@endforeach
	</div> 
	@endif
	<div class="text-left"> 
		<dl>
			<dt>
				Sumber
			</dt>
			<dd>
				{{ $event->sumber }}
			</dd>
			@if($event->tempat)
			<dt>
				Tempat
			</dt>
			<dd>
				{{ $event->tempat }}
			</dd>
			@endif
			@if($event->event_date)
			<dt>
				Tanggal Event
			</dt>
			<dd>
				{{(new Carbon($event->event_date))->format('l, d F Y')}}
			</dd>
			@endif
		</dl>
	</div>
</div>
@endforeach

