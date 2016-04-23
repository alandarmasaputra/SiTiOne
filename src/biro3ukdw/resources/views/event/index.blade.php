@extends('layout.app')
@section('head_title')
Biro Kemahasiswaan UKDW
@endsection

@section('nav_event')
active
@endsection

@section('head_addition')
<script src="{{ url('/utility/searchbuff/searchbuff.js') }}"></script>
@endsection

<?php
    use App\AppUtility;
	use Carbon\Carbon;
?>

@section('body_content')


<div class="container body-content">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Event 
				</h2>
				<span>
					<input type="text" id="ajax-search-bar" data-url="{{ url('/event/list') }}" placeholder="Cari event">
					<span class="glyphicon glyphicon-search"></span>
					{!! csrf_field() !!}
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="event-container event-timeline glass">
			<!-- event-items -->
			
		</div>
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var searchBar = $('input#ajax-search-bar');
	var lastQuery = "";
	var itemContainer = $('.event-container');
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
