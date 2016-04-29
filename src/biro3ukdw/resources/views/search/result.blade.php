@extends('layout.app')
@section('head_title')
Event - Biro3 | UKW
@endsection

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
					<div class="text-left">
					<a href="{{url('/event/'.$event->id)}}">
						Nama Event : {{ $event->name }}
						</a>
						</div>
						<div class="text-left"><?php
				$tags = $event->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					
						{{ $tag }}
					
				</span>
				@endif
				@endforeach </div> 
						<div class="text-left"> {{ $event->sumber }}</div> 
						<div class="text-left"> {{ $event->tempat }}</div>

					<br>
					
					@endforeach
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
					<div class="text-left">
					<a href="{{url('/ukm/'.$ukm->id)}}">
						Nama UKM : {{ $ukm->name }}
						</a>
						</div>

					<br>
					
					@endforeach
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
					<div class="text-left">
					<a href="{{url('/news/'.$new->id)}}">
						Nama Berita : {{ $new->name }}
						</a>
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
				@endforeach </div> 
					

					<br>
					
					@endforeach
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
					<div class="text-left">
					<a href="{{url('/beasiswa/'.$beasiswa->id)}}">
						Nama Beasiswa : {{ $beasiswa->name }}
						</a>
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
						<div class="text-left"> {{ $beasiswa->sumber }}</div> 
						

					<br>
					
					@endforeach
					@if (count($beasiswas) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
			</div>
		</div>
	</div>
</div>
@endsection