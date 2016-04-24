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
    <div class="text-center">
    @foreach($events as $event)
    <a href="{{url('/event/'.$event->id)}}" style="display:block;">
    <h2>{{ $event->name }} {{ $event->kategori }} {{ $event->sumber }} {{ $event->tempat }}</h2>
    </a>
    @endforeach
    </div>
    <div class="text-center">
    @foreach($ukms as $ukm)
    <a href="{{url('/ukm/'.$ukm->id)}}" style="display:block;">
    <h2>{{ $ukm->name }}</h2>
    </a>
    @endforeach
    </div>
    <div class="text-center">
    @foreach($news as $new)
    <a href="{{url('/news/'.$new->id)}}" style="display:block;">
    <h2>{{ $new->name }} {{ $new->kategori }}</h2>
    </a>
    @endforeach
    </div>
    <div class="text-center">
    @foreach($beasiswas as $beasiswa)
    <a href="{{url('/beasiswa/'.$beasiswa->id)}}" style="display:block;">
    <h2>{{ $beasiswa->name }} {{ $beasiswa->kategori }} {{ $beasiswa->sumber }}</h2>
    </a>
    @endforeach
    </div>
</div>
@endsection