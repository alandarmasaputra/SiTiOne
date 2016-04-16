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
			<h2 class="text-center">Tambah Beasiswa</h2>
		</div>
		<div class="beasiswa-addnew flex justify-center">
			<a href="{{ url('/beasiswa/new') }}"><span class="glyphicon glyphicon-plus"></span></a>
			<!--
			<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-download-alt"></span></a>
			<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-print"></span></a>
			-->
		</div>
	</div>
</div>
@else
@if(count($beasiswas) == 0)
<div class="cinema">
	<span>Hasil yang sesuai dengan pencarian tidak ditemukan</span>
</div>
@endif
@endif
@foreach($beasiswas as $beasiswa)
<div class="beasiswa-preview-item">
	<div class="beasiswa-facade">
		<div class="beasiswa-preview-pic-border">
			<div class="beasiswa-preview-pic"
				 <?php
				 if($beasiswa->header_pic){
				 ?>
					style="background-image: url('{{AppUtility::get_image_data($beasiswa->header_pic)}}')" 
				 <?php
				 }else{
					 if($beasiswa->isInternal()){
				 ?>
					style="background-image: url('{{url('style/images/ico/beasiswa_dalam.png')}}')"
				 <?php
					 }else{
				 ?>
					style="background-image: url('{{url('style/images/ico/beasiswa_luar.png')}}')"
				 <?php
				 }}
				 ?>>
			</div>
		</div>
		<div class="text-center beasiswa-preview-title">
			<h2>
				{{$beasiswa->name}}
				@if($beasiswa->isInternal())
				(<em>Internal</em>)
				@endif
			</h2>
		</div>
		<div class="beasiswa-preview-description">
			<h4 class="text-left">Sumber: <strong>{{$beasiswa->sumber}}</strong></h4>
			@if($beasiswa->deadline_date)
			<h4 class="text-left">Pendaftaran Terakhir: <strong>{{(new Carbon($beasiswa->deadline_date))->format('l, d F Y')}}</strong></h4>
			@endif
			<br>
			@foreach($beasiswa->content as $content)
			@if($content->type == 's')
			{!! $content->content !!}
			<?php break; ?>
			@endif
			@endforeach
		</div>
		<div class="beasiswa-addnew flex justify-center">
			<a href="{{ url('/beasiswa/'.$beasiswa->id) }}">Read More</a>
		</div>
	</div>
</div>
@endforeach