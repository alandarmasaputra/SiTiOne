@extends('layout.app')
@section('head_title')
Beasiswa - Biro3 | UKW
@endsection
@section('body_content')
<div class="container-fluid body-content">
    <div class="page-header">
        <h2>
            Beasiswa
        </h2>
    </div>
    <div class="beasiswa-container">
			<div class="beasiswa-preview-item">
				<div class="beasiswa-facade">
					<div class="beasiswa-preview-pic-border">
						<div class="beasiswa-preview-pic-plus">
						</div>
					</div>
					<div class="beasiswa-preview-description">
						<h2 class="text-center">Tambah Beasiswa</h2>
					</div>
					<div class="beasiswa-readmore flex justify-end">
						<a href="{{ url('/beasiswa/new') }}"><span class="glyphicon glyphicon-plus"></span></a>
						<!--
						<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-download-alt"></span></a>
						<a href="#" class="btn btn-xs btn-hover btn-default"><span class="glyphicon glyphicon-print"></span></a>
						-->
					</div>
				</div>
			</div>
        @foreach($beasiswas as $beasiswa)
			<div class="beasiswa-preview-item">
				<div class="beasiswa-facade">
					<div class="beasiswa-preview-pic-border">
						<div class="beasiswa-preview-pic"
							 <?php if($beasiswa->header_pic){ ?>
							 	style="background-image: url('{{AppUtility::get_image_data($beasiswa->header_pic)}}')" 
							 <?php }else{ ?>
							 	style="background-image: url('{{url('style/images/ico/beasiswa_placeholder.png')}}')"
							 <?php } ?>>
						</div>
					</div>
					<div class="beasiswa-preview-description">
						<h2 class="text-center">Beasiswa Luar Negri</h2>
						@foreach($beasiswa->content as $content)
						@if($content->type == 's')
						{!! $content->content !!}
						<?php break; ?>
						@endif
						@endforeach
					</div>
					<div class="beasiswa-readmore flex justify-end">
						<a href="">Read More</a>
					</div>
				</div>
			</div>
            <h2>{{ $beasiswa->kategori }} <small>{{ $beasiswa->sumber }}: Level {{ $beasiswa->jumlah }}</small></h2>
        @endforeach
    </div>
</div>
@endsection