@extends('layouts.master')
@section('content')

<div class="row">
<div class="col-lg-12">

<h1>Tampilkan Data Pegawai</h1>

    <div class="jumbotron text-center">
        <h2>{{ $pegawai->nama }}</h2>
        <p>
            <strong>Email :</strong> {{ $pegawai->email }}<br>
            <strong>Level :</strong> {{ $pegawai->level }}
        </p>
    </div>

</div>
</div>
@stop