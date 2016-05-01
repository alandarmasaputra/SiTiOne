@section('head_title')
500
@endsection


@extends('layout.app')
@section('body_content')
<section class="container">
	<div class="row">
		<div class="card text-center">
			<h1>500</h1>
			<br>
			<p>Ada kesalahan pada server</p>
			<p>
			<a href="{{ url('/home') }}">Klik di sini</a> untuk kembali ke halaman beranda</p>
		</div>
	</div>
</section><!--/#blog-->
@endsection