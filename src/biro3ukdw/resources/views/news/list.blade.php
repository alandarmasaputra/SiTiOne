<?php

use Carbon\Carbon;
use App\AppUtility;

?>

@if(Auth::user())
<div class="beasiswa-preview-item">
	<div class="beasiswa-facade">
		<div class="beasiswa-preview-pic-border">
			<div class="beasiswa-preview-pic-plus">
			</div>
		</div>
		<div class="beasiswa-preview-title">
			<h2 class="text-center">Tambah News</h2>
		</div>
		<div class="beasiswa-addnew flex justify-center">
			<a href="{{ url('/news/new') }}"><span class="glyphicon glyphicon-plus"></span></a>
			<!--
			<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-download-alt"></span></a>
			<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-print"></span></a>
			-->
		</div>
	</div>
</div>
@else
@if(count($news) == 0)
<div class="cinema">
	<span>Hasil yang sesuai dengan pencarian tidak ditemukan</span>
</div>
@endif
@endif
@foreach($news as $news)
<div class="beasiswa-preview-item">
	<div class="beasiswa-facade">
		<div class="beasiswa-preview-pic-border">
			<div class="beasiswa-preview-pic"
				 <?php
				 if($news->header_pic){
				 ?>
					style="background-image: url('{{AppUtility::get_image_data($news->header_pic)}}')" 
				 <?php
				 }else{
					 if(strpos($news->kategori,'internal')!==false){
						 $internal = true;
				 ?>
					style="background-image: url('{{url('style/images/ico/beasiswa_dalam.png')}}')"
				 <?php
					 }else{
						 $internal = false;
				 ?>
					style="background-image: url('{{url('style/images/ico/beasiswa_luar.png')}}')"
				 <?php
				 }}
				 ?>>
			</div>
		</div>
		<div class="text-center beasiswa-preview-title">
			<h2>
				{{$news->name}}
				@if($internal)
				(<em>Internal</em>)
				@endif
			</h2>
		</div>
		<div class="beasiswa-preview-description">
			
			<br>
			@foreach($news->content as $content)
			@if($content->type == 's')
			{!! $content->content !!}
			<?php break; ?>
			@endif
			@endforeach
		</div>
		<div class="beasiswa-addnew flex justify-center">
			<a href="{{ url('/news/'.$news->id) }}">Read More</a>
		</div>
	</div>
</div>
@endforeach