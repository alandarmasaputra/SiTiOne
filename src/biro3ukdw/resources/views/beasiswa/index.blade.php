@extends('layout.app')
@section('head_title')
Beasiswa - Biro3 | UKW
@endsection

@section('body_content')
<div class="container">
    <div class="page-header">
        <h2>
            Beasiswa
        </h2>
    </div>
    <div class="text-center">
        @foreach($beasiswas as $beasiswa)
            <h2>{{ $beasiswa->kategori }} <small>{{ $beasiswa->sumber }}: Level {{ $beasiswa->jumlah }}</small></h2>
        @endforeach
    </div>
</div>
@endsection