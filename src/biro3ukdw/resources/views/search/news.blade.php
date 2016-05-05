<?php
	use Carbon\Carbon;
?>
@foreach($news as $new)
<div class="item">
	<div class="text-left">
		<small>{{(new Carbon($new->created_at))->format('l, d F Y')}}</small>
		<a href="{{url('/news/'.$new->id)}}">
		<div class="judul">
			{{ $new->name }}
		</div>
		</a>
	</div>
	<?php
		$tags = $new->kategori;
		$printTags = trim($tags) != '';
		$tags = explode(' ',$tags);
	?>
	<div class="text-left">
	@if($printTags)
		@foreach($tags as $tag)
		
		
			@if($tag!='')
			<span class="tag-list-item">
				{{ $tag }} 
			</span>
			@endif
		
		
		@endforeach
	@endif
	</div>
</div>
@endforeach
					