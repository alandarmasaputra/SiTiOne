@extends('layout.app')
@section('head_title')
Search
@endsection
<?php
use Carbon\Carbon;
?>

@section('body_content')
{!! csrf_field() !!}
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h2>
                    Search Result for : {{$query}}
                </h2>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12 search-page">
			<div class="row">
				<div class="col-sm-6 search-result search-beasiswa" data-url="{{url('/search/beasiswa')}}">
					<div class="section-name">
						Beasiswa
					</div>
					@if($beasiswaCount>0)
					<div class="result">
					</div>
					<div class="pagination">
						<ul class="pagination">
							<?php
							for($i=1; $i<=$beasiswaCount; $i++){
							?>
							<li <?php if($i==1){echo 'class="active"';}?> ><a onclick="page.changePage(event,this)" data-page='{{$i}}'>{{$i}}</a></li>
							<?php
							}
							?>
						</ul>
					</div>
					@else
					<div class="no-result">Hasil tidak ditemukan</div>
					@endif
				</div>
				<div class="col-sm-6 search-result search-events" data-url="{{url('/search/event')}}">
					<div class="section-name">
						Events
					</div>
					@if($eventCount>0)
					<div class="result">
					</div>
					<div class="pagination">
						<ul class="pagination">
							<?php
							for($i=1; $i<=$eventCount; $i++){
							?>
							<li <?php if($i==1){echo 'class="active"';}?> ><a onclick="page.changePage(event,this)" data-page='{{$i}}'>{{$i}}</a></li>
							<?php
							}
							?>
						</ul>
					</div>
					@else
					<div class="no-result">Hasil tidak ditemukan</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 search-result search-news" data-url="{{url('/search/news')}}">
					<div class="section-name">
						News
					</div>
					@if($newsCount>0)
					<div class="result">
					</div>
					<div class="pagination">
						<ul class="pagination">
							<?php
							for($i=1; $i<=$newsCount; $i++){
							?>
							<li <?php if($i==1){echo 'class="active"';}?> ><a onclick="page.changePage(event,this)" data-page='{{$i}}'>{{$i}}</a></li>
							<?php
							}
							?>
						</ul>
					</div>
					@else
					<div class="no-result">Hasil tidak ditemukan</div>
					@endif
				</div>
				<div class="col-sm-6 search-result search-ukm" data-url="{{url('/search/ukm')}}">
					<div class="section-name">
						UKM
					</div>
					@if($ukmCount>0)
					<div class="result">
					</div>
					<div class="pagination">
						<ul class="pagination">
							<?php
							for($i=1; $i<=$ukmCount; $i++){
							?>
							<li <?php if($i==1){echo 'class="active"';}?> ><a onclick="page.changePage(event,this)" data-page='{{$i}}'>{{$i}}</a></li>
							<?php
							}
							?>
						</ul>
					</div>
					@else
					<div class="no-result">Hasil tidak ditemukan</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<div id="repo" class="hidden">
	<div class="query">
		{{$query}}
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var page = {};
	$(document).ready(function(){
		page.query = $('#repo>.query').html().trim()
		page.getPage = function(element){
			var pagenumber = $(element).attr('data-page')
			var section = $(element).parents('div.search-result');
			var url = section.attr('data-url').trim()
			var result = section.find('div.result')
			console.log(url)
			try{
				$.ajax({
					url: url,
					method: 'post',
					data: {'pageNumber':pagenumber,'q':page.query},
					success: function(data){
						result.html(data)
					},
					error: function(e){
						console.log(e)
						//result.html("Terjadi kesalahan")
						result.html(e.responseText)
					}
				})
			}catch(e){
				result.html("Terjadi kesalahan")
			}
		}
		page.changePage = function(e,element){
			e.preventDefault();
			page.getPage(element)
		}
		$('.pagination li.active').each(function(){
			page.getPage(this)
		})
	})
</script>
@endsection