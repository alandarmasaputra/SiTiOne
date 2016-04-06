@extends('layout.app')
@section('head_title')
News - Biro3 | UKDW
@endsection

<?php
	use App\AppUtility;
?>

@section('body_content')


<div class="container-fluid body-content">
	<div class="page-header">
		<h2>
			News	
		</h2>
	</div>
	<div class="ukm-container">
		<div class="ukm-item">
			<a href="{{url('/news/new')}}">
				<div class="ukm-item-facade text-center flex-column contents-center">
					<div>
						<h2>
							<span class="glyphicon glyphicon-plus">
							</span>
						</h2>
					</div>
					<h2>
						Tambah News
					</h2>
				</div>
			</a>
		</div>
		@foreach($news as $news)
		<div class="ukm-item"
			<?php if($news->header_pic){ ?>
			style="background-image: url('{{ AppUtility::get_image_data($news->header_pic)}}')"
			<?php } ?>>
			<div class="ukm-item-facade">
				<div class="ukm-preview-title">
					<a href="{{ url('/news/'.$news->id) }}">
						{{$news->name}}
					</a>
				</div>
				<div class="ukm-preview-content">
					@foreach($news->content as $content)
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