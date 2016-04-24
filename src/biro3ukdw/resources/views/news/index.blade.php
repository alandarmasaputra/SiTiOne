@extends('layout.app')
@section('head_title')
News - Biro3 | UKDW
@endsection

@section('nav_news')
active
@endsection

@section('head_addition')
<script src="{{ url('/utility/searchbuff/searchbuff.js') }}"></script>
@endsection

@section('body_content')
<?php
use Carbon\Carbon;
use App\AppUtility;
?>

<div class="container body-content">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					News
				</h2>
				<span>
					<input type="text" id="ajax-search-bar" data-url="{{ url('/news/list') }}" placeholder="Cari news">
					<span class="glyphicon glyphicon-search"></span>
					{!! csrf_field() !!}
				</span>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="beasiswa-container col-md-12 glass">
		</div>
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var searchBar = $('input#ajax-search-bar');
	var lastQuery = "";
	var itemContainer = $('.beasiswa-container');
	searchBuff.url = searchBar.attr('data-url');
	searchBuff.postload = function(){
		lastQuery = searchBar.val();
	}
	searchBuff.success = function(data){
		itemContainer.html(data);
	}
	searchBuff.preload = function(){
		itemContainer.html("<div class='cinema'><span>Memuat</span></div>")
	}
	searchBuff.error = function(data){
		console.log(data.responseText);
		if(itemContainer.html().trim()==''){
			//itemContainer.html(data.responseText)
			itemContainer.html("<div class='cinema'><span>Telah terjadi kesalahan</span></div>")
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