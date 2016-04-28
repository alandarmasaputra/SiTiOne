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
					@foreach($events as $event)
					<a href="{{url('/event/'.$event->id)}}" style="display:block;">
						<h2>{{ $event->name }}</h2><h2>{{ $event->kategori }} </h2> <h2> {{ $event->sumber }} </h2> <h2> {{ $event->tempat }}</h2>
					</a>
					@endforeach
					@if (count($events) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>

		<div></div>
		<div class="result-ukm">
			<div class="judul-UKM">
			<h1>UKM</h1>
		</div>
					@foreach($ukms as $ukm)
					<a href="{{url('/ukm/'.$ukm->id)}}" style="display:block;">
					<h2>{{ $ukm->name }}</h2>
					</a>
					@endforeach
					@if (count($ukms) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>


		<div class="result-news">
			<div class="judul-news">
			<h1>News</h1>
		</div>
					@foreach($news as $new)
					<a href="{{url('/news/'.$new->id)}}" style="display:block;">
					<h2>{{ $new->name }}</h2><h2> {{ $new->kategori }}</h2>
					</a>
					@endforeach
					@if (count($news) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>


		<div class="result-beasiswa">
			<div class="judul-beasiswa">
			<h1>Beasiswa</h1>
		</div>
					@foreach($beasiswas as $beasiswa)
					<a href="{{url('/beasiswa/'.$beasiswa->id)}}" style="display:block;">
					<h2>{{ $beasiswa->name }}</h2><h2> {{ $beasiswa->kategori }} {{ $beasiswa->sumber }}</h2>
					</a>
					@endforeach
					@if (count($beasiswas) === 0)
					Tidak ada yang sesuai dengan kata kunci
					@endif
		</div>
	</div>
@endsection