@extends('layout.app')
@section('head_title')
Event - Biro3 | UKW
@endsection

@section('body_content')
<div class="container">
	<div
    <div class="page-header">
        <h2>
            Search Result
        </h2>
    </div>
	
	<div class="row">
		<div class="result-event">
			<h1>Event</h1>
					@foreach($events as $event)
					<a href="{{url('/event/'.$event->id)}}" style="display:inline-block;">
						<h2>Nama Event : {{ $event->name }}</h2><h2><?php
				$tags = $event->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					
						{{ $tag }}
					
				</span>
				@endif
				@endforeach </h2> <h2> {{ $event->sumber }} </h2> <h2> {{ $event->tempat }}</h2>
					</a>
					<br>
					@endforeach
					@if (count($events) === 0)
					Tidak ada yang sesuai dengan kata kunci...
					@endif
		</div>

		<div></div>
		<div class="result-ukm">
			<h1>UKM</h1>
					@foreach($ukms as $ukm)
					<a href="{{url('/ukm/'.$ukm->id)}}" style="display:inline-block;">
					<h2>Nama UKM : {{ $ukm->name }}</h2>
					</a>
					@endforeach
					@if (count($ukms) === 0)
					Tidak ada yang sesuai dengan kata kunci...
					@endif
		</div>


		<div class="result-news">
			<h1>News</h1>
					@foreach($news as $new)
					<a href="{{url('/news/'.$new->id)}}" style="display:inline-block;">
					<h2>Nama Berita : {{ $new->name }}</h2><h2><?php
				$tags = $new->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					
						{{ $tag }}
					
				</span>
				@endif
				@endforeach </h2> 
					</a>
					@endforeach
					@if (count($news) === 0)
					Tidak ada yang sesuai dengan kata kunci...
					@endif
		</div>


		<div class="result-beasiswa">
			<h1>Beasiswa</h1>
					@foreach($beasiswas as $beasiswa)
					<a href="{{url('/beasiswa/'.$beasiswa->id)}}" style="display:inline-block;">
					<h2>Nama Beasiswa : {{ $beasiswa->name }}</h2><h2><?php
				$tags = $beasiswa->kategori;
				$tags = explode(' ',$tags);
				?>
 				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					
						{{ $tag }}
					
				</span>
				@endif
				@endforeach </h2> <h2> {{ $beasiswa->sumber }}</h2>
					</a>
					@endforeach
					@if (count($beasiswas) === 0)
					Tidak ada yang sesuai dengan kata kunci...
					@endif
		</div>
	</div>
	
	
</div>
@endsection