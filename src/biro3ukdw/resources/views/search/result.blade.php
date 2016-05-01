@extends('layout.app')
@section('head_title')
Event - Biro3 | UKW
@endsection
<?php
use Carbon\Carbon;
?>
@section('body_content')
<div class="container">
    <div class="page-header">
        <h2>
            Search Result
        </h2>
    </div>
	<div class="row">
		<div class="result-event">
			<div class="judul-event">
			<h1>Event</h1>
		</div>
		
		<div class="result-detail">
			@foreach($events as $event)
			<div class="results">

				<div class="text-left">

				<a href="{{url('/event/'.$event->id)}}">
				<div class="judul">	Nama Event : {{ $event->name }}
					</div></a>
					</div>
					<div class="text-left">
						<?php 
							$tags = $event->kategori;
							$tags = explode(' ',$tags);
						?>
						@foreach($tags as $tag)
						@if($tag!='')
						<span class="tag-list-item">

							{{ $tag }}

						</span>
						@endif

						@endforeach 
					</div> 
					<div class="text-left"> 
						Sumber : {{ $event->sumber }}
					</div> 
					<div class="text-left">
						Tempat : {{ $event->tempat }}
					</div>
				<br>
			</div>
			@endforeach


			{!!$events->appends(array_except(Request::query(), 'page_event'))->links();!!}


			@if (count($events) === 0)
			Tidak ada yang sesuai dengan kata kunci
			@endif
			</div>

			
		</div>	


		<div class="result-ukm">
			<div class="judul-UKM">
			<h1>UKM</h1>
		</div>
			<div class="result-detail">
					@foreach($ukms as $ukm)
					<div class="results">
					<div class="text-left">
					<a href="{{url('/ukm/'.$ukm->id)}}">
					<div class="judul">	Nama UKM : {{ $ukm->name }}
					</div>	</a>
						</div>

					<br>
					</div>
					@endforeach
					{!!$ukms->appends(array_except(Request::query(), 'page_ukm'))->links();!!}
					@if (count($ukms) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>
		</div>

		<div class="result-news">
			<div class="judul-news">
			<h1>News</h1>
		</div>
		<div class="result-detail">
					@foreach($news as $new)
					<div class="results">
					<div class="text-left">
					<a href="{{url('/news/'.$new->id)}}">
					<div class="judul">	Nama Berita : {{ $new->name }}
						</div></a>
						</div>
						<div class="text-left"><?php
				$tags = $new->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')

				<span class="tag-list-item">
					
						{{ $tag }} 
					
				</span>
				@endif
				@endforeach 
			    <br>Tanggal Buat : {{(new Carbon($new->created_at))->format('l, d F Y')}}			    </div> 
					

					<br>
					</div>
					@endforeach
					{!!$news->appends(array_except(Request::query(), 'page_news'))->links();!!}
					@if (count($news) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>
		</div>

		<div class="result-beasiswa">
			<div class="judul-beasiswa">
			<h1>Beasiswa</h1>
		</div>
		<div class="result-detail">
					@foreach($beasiswas as $beasiswa)
					<div class="results">
					<div class="text-left">
					<a href="{{url('/beasiswa/'.$beasiswa->id)}}">
					<div class="judul">	Nama Beasiswa : {{ $beasiswa->name }}
					</div>	</a>
						</div>
						<div class="text-left"><?php
				$tags = $beasiswa->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					
						{{ $tag }}
					
				</span>
				@endif
				@endforeach </div> 
						<div class="text-left"> Sumber :{{ $beasiswa->sumber }}
						<br>Tanggal Buat : {{(new Carbon($beasiswa->created_at))->format('l, d F Y')}}</div> 
						

					<br>	
					</div>
					@endforeach

                    {!!$beasiswas->appends(array_except(Request::query(), 'page_bea'))->links();!!}
					@if (count($beasiswas) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
			</div>
		</div>
	</div>
</div>
@endsection