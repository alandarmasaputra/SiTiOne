<?php
use App\AppUtility;
?>

@if(Auth::user())
<div class="ukm-item">
	<a href="{{url('/ukm/new')}}">
		<div class="ukm-item-facade text-center flex-column contents-center">
			<div>
				<h2>
					<span class="glyphicon glyphicon-plus">
					</span>
				</h2>
			</div>
			<h2>
				Tambah UKM
			</h2>
		</div>
	</a>
</div>
@else
@if(count($ukms) == 0)
<div class="cinema">
	<span>Hasil yang sesuai dengan pencarian tidak ditemukan</span>
</div>
@endif
@endif
@foreach($ukms as $ukm)
<div class="ukm-item"
	<?php if($ukm->header_pic){ ?>
	style="background-image: url('{{ AppUtility::get_image_data($ukm->header_pic)}}')"
	<?php } ?>>
	<a href="{{ url('/ukm/'.$ukm->id) }}">
		<div class="ukm-item-facade">
			<div class="ukm-preview-title">
					{{$ukm->name}}
			</div>
			<div class="ukm-preview-content">
				@foreach($ukm->content as $content)
					@if($content->type=='s')
					<div>
						{!! AppUtility::str_limit($content->content,100)!!}
					</div>
						<?php break; ?>
					@endif
				@endforeach
			</div>
		</div>
	</a>
</div>
@endforeach