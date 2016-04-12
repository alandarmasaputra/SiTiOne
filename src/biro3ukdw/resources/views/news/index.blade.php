@extends('layout.app')
@section('head_title')
News - Biro3 | UKW
@endsection
@section('body_content')
<?php
use Carbon\Carbon;
use App\AppUtility;
?>
<div class="container-fluid body-content">
    <div class="beasiswa-container">
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
						
					</div>
				</div>
			</div>
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
								 
							 ?>
							 	style="background-image: url('{{url('style/images/ico/beasiswa_dalam.png')}}')"
							 
							 	
							 <?php
							 }
							 ?>>
							 >
						</div>
					</div>
					<div class="text-center beasiswa-preview-title">
						<h2>
							{{$news->name}}
							
						</h2>
					</div>
					<div class="beasiswa-preview-description">
						
						<h4 class="text-left">createde at: <strong>{{$news->created_at ->format('l, d F Y')}}</strong></h4>
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
    </div>
</div>
@endsection