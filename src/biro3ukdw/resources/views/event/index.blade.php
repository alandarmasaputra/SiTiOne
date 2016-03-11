@extends('layout.app')
@section('head_title')
Event - Biro3 | UKW
@endsection

@section('body_content')
<div class="container">
    <div class="page-header">
        <h2>
            Event
        </h2>
    </div>
    <div class="text-center">
    @foreach($events as $event)
    <h2>{{ $event->kategori }} <small>{{ $event->sumber }}: Level {{ $event->jumlah }}</small></h2>
    @endforeach
    </div>
</div>
@endsection