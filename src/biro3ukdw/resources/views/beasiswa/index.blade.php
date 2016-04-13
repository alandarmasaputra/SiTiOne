@extends('layout.app')
@section('head_title')
Beasiswa - Biro3 | UKW
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
					Beasiswa
				</h2>
				<span>
					<input type="text" id="ajax-search-bar" data-url="{{ url('/beasiswa/list') }}" placeholder="Cari beasiswa">
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
	searchBuff.error = function(data){
		if(itemContainer.html().trim()==''){
			itemContainer.html("<div class='cinema'>Telah terjadi kesalahan</div>")
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