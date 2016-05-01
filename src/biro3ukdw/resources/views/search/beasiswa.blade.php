<?php
	use Carbon\Carbon;
?>
@foreach($beasiswas as $beasiswa)
<div class="item">
	<div class="text-left">
		<small>{{(new Carbon($beasiswa->created_at))->format('l, d F Y')}}</small>
		<a href="{{url('/beasiswa/'.$beasiswa->id)}}">
			<div class="judul">{{ $beasiswa->name }}
			</div>
		</a>
	</div>
	<?php
		$tags = $beasiswa->kategori;;
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
	<div class="text-left"> Sumber :{{ $beasiswa->sumber }}
		<dl>
			<dt>Sumber</dt>
			<dd></dd>
			@if($beasiswa->deadline_date)
			<dt>Pendaftaran Terakhir</dt>
			<dd>{{(new Carbon($beasiswa->deadline_date))->format('l, d F Y')}}</dd>
			@endif
		</dl>
	</div> 


	<br>	
</div>
@endforeach
