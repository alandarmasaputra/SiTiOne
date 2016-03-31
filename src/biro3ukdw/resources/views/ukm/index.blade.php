@extends('layout.app')
@section('head_title')
UKM - Biro3 | UKDW
@endsection

<?php
	use App\AppUtility;
?>

@section('body_content')


<div class="container-fluid body-content">
	<div class="page-header">
		<h2>
			UKM	
		</h2>
	</div>
	<div class="ukm-container">
		@foreach($ukms as $ukm)
		<div class="ukm-item"
			<?php if($ukm->header_pic){ ?>
			style="background-image: url('{{ AppUtility::get_image_data($ukm->header_pic)}}')"
			<?php } ?>>
			<div class="ukm-item-facade">
				<div class="ukm-preview-title">
					<a href="{{ url('/ukm/'.$ukm->id) }}">
						{{$ukm->name}}
					</a>
				</div>
				<div class="ukm-preview-content">
					@foreach($ukm->content as $content)
						@if($content->type=='s')
							{!!$content->content!!}
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