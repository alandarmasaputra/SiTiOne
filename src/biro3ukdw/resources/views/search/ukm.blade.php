<?php
	use Carbon\Carbon;
?>
@foreach($ukms as $ukm)
<div class="item">
	<div class="text-left">
	<a href="{{url('/ukm/'.$ukm->id)}}">
		<div class="judul">{{ $ukm->name }}
		</div>
	</a>
	</div>
</div>
@endforeach
					