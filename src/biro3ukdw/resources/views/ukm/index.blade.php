@extends('layout.app')
@section('head_title')
UKM - Biro3 | UKDW
@endsection

@section('nav_ukm')
active
@endsection

<?php
	use App\AppUtility;
?>

@section('head_addition')
<script src="{{ url('/utility/searchbuff/searchbuff.js') }}"></script>
@endsection

@section('body_content')

<div class="container body-content">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					UKM
				</h2>
				<span>
					<input type="text" id="ajax-search-bar" data-url="{{ url('/ukm/list') }}" placeholder="Cari UKM">
					<span class="glyphicon glyphicon-search"></span>
					{!! csrf_field() !!}
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 ukm-container">

		</div>
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var searchBar = $('input#ajax-search-bar');
	var lastQuery = "";
	searchBuff.url = searchBar.attr('data-url');
	searchBuff.postload = function(){
		lastQuery = searchBar.val();
	}
	searchBuff.success = function(data){
		$('.ukm-container').html(data);
	}
	searchBuff.preload = function(){
		$('.ukm-container').html("<div class='cinema'><span>Memuat</span></div>")
	}
	searchBuff.error = function(data){
		if($('.ukm-container').html().trim()==''){
			$('.ukm-container').html("<div class='cinema'><span>Telah terjadi kesalahan</span></div>")
		}
	}
	searchBuff.data = {query:""};
	searchBuff.start();
	searchBar.keyup(function(){
		searchBuff.data = {query:searchBar.val()}
		if(lastQuery != searchBar.val()){
			searchBuff.start();
		}
	})
</script>

@endsection