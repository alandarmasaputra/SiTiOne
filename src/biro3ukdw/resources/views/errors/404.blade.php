@section('head_title')
404
@endsection


@extends('layout.app')
@section('body_content')
<section class="container">
	<div class="row">
		<div class="card text-center">
			<h1>404</h1>
			<br>
			<p>Anda mengakses halaman yang tidak ada </p>
			<p>
			<a href="{{ url('/home') }}">Klik di sini</a> untuk kembali ke halaman beranda</p>
		</div>
	</div>
</section><!--/#blog-->
@endsection