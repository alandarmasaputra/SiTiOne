@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_home')
active
@endsection

@extends('layout.app')
@section('body_content')

<?php
	use App\AppUtility;
	use Carbon\Carbon;
?>

<div class="container">
	<div class="col-md-10 col-md-offset-1 home">
		<div class="carousel slide row" id="maincarousel" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#maincarousel" data-slide-to="0" class="active">
				</li>
				<?php $c_index=1; ?>
				@foreach($carousel as $c_item)
				<li data-target="#maincarousel" data-slide-to="{{ $c_index }}">
				</li>
				<?php $c_index++; ?>
				@endforeach
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active" style="background: rgba(0,0,0,0.5);">
					<div class="facade">
						<div class="pre-title">
							Selamat Datang di
						</div>
						<div class="title">
							Biro Kemahasiswaan
						</div>
						<div class="description">
							<div class="text-center">
								<img class="carousel-logo" src="{{ asset('style/images/ico/logo-white.svg') }}">
							</div>
							Universitas Kristen Duta Wacana
						</div>
					</div>
				</div>
				@if(isset($carousel['beasiswa']))
				<div class="item" style="background-image: url('{{ AppUtility::get_image_data($carousel['beasiswa']->header_pic) }}')">
					<div class="facade">
						<div class="pre-title">
							Ambil Beasiswa Terbaru
						</div>
						<div class="title">
							<a href="{{ url('beasiswa/'.$carousel['beasiswa']->id) }}" style="font-size:1em; font-variant: normal">
								{{ $carousel['beasiswa']->name }}
							</a>
						</div>
						<div class="description">
						</div>
					</div>
				</div>
				@endif
				@if(isset($carousel['news']))
				<div class="item" style="background-image: url('{{ AppUtility::get_image_data($carousel['news']->header_pic) }}')">
					<div class="facade">
						<div class="pre-title">
							Berita Terbaru
						</div>
						<div class="title">
							<a href="{{ url('news/'.$carousel['news']->id) }}" style="font-size:1em; font-variant: normal">
								{{ $carousel['news']->name }}
							</a>
						</div>
						<div class="description">
						</div>
					</div>
				</div>
				@endif
				@if(isset($carousel['event']))
				<div class="item" style="background-image: url('{{ AppUtility::get_image_data($carousel['event']->header_pic) }}')">
					<div class="facade">
						<div class="pre-title">
							Event Terkini
						</div>
						<div class="title">
							<a href="{{ url('event/'.$carousel['event']->id) }}" style="font-size:1em; font-variant: normal">
								{{ $carousel['event']->name }}
							</a>
						</div>
						<div class="description">
						</div>
					</div>
				</div>
				@endif
				@if(isset($carousel['ukm']))
				<div class="item" style="background-image: url('{{ AppUtility::get_image_data($carousel['ukm']->header_pic) }}')">
					<div class="facade">
						<div class="pre-title">
							Kunjungi UKM
						</div>
						<div class="title">
							<a href="{{ url('ukm/'.$carousel['ukm']->id) }}" style="font-size:1em; font-variant: normal">
								{{ $carousel['ukm']->name }}
							</a>
						</div>
						<div class="description">
						</div>
					</div>
				</div>
				@endif
			</div>
			<a class="left carousel-control" href="#maincarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#maincarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<div class="row home-white-preview" style="margin-top:0; margin-bottom:0">
			<div class="row">
			</div>
			<div class="col-sm-7">
				<h2>
					Beasiswa
					<hr>
				</h2>
				<?php $i = 0; ?>
				@foreach($beasiswas as $beasiswa)
				<div class="beasiswa-home-preview">
					@if($beasiswa->header_pic)
					<div class="picture" style="background-image: url('{{AppUtility::get_image_data($beasiswa->header_pic)}}')">
					</div>
					@else
					@if($beasiswa->isInternal())
					<div class="picture" style="background-image: url('{{url('style/images/ico/beasiswa_dalam.png')}}')">
					</div>
					@else
					<div class="picture" style="background-image: url('{{url('style/images/ico/beasiswa_luar.png')}}')">
					</div>
					@endif
					@endif
					<div class="title">
						<a>
							{{ $beasiswa->name }}
						</a>
						<small>
						<small>
							<dl>
								<dt>Pendaftaran terakhir</dt>
								<dd class="text-right"><?php echo $beasiswa->deadline_date?(new Carbon($beasiswa->deadline_date))->format('l, d F Y'):"-"; ?></dd>
								<dt>Sumber</dt>
								<dd class="text-right"><?php echo $beasiswa->sumber?$beasiswa->sumber:"-"; ?></dd>
							</dl>
						</small>
						</small>
					</div>
				</div>
				<?php
					$i++;
					if($i>4){
						break;
					}
				?>
				@endforeach
				<div style="clear:both" class="text-right"><a href="{{ url('/beasiswa') }}">Beasiswa Selengkapnya</a></div>
				<hr>
			</div>
			<div class="col-sm-5">
				<h2>
					Berita dan Event terkini
					<hr>
				</h2>
				<?php
				$i = 0;
				$n = 0;
				$e = 0;
				$ei = 0;
				$ni = 0;
				$e_n;
				$link;
				
				$e_ava = true;
				$n_ava = true;
				?>
				@while(true)
				<?php
				if($e_ava == true && count($events)<=$ei){
					$e_ava = false;
				}
				if($n_ava == true && count($newss)<=$ni){
					$n_ava = false;
				}
				
				if(!$e_ava && !$n_ava){
					break;
				}
				else if(!$e_ava){
					$e_n = $newss[$ni];
					$link = 'news';
					$ni++;
				}
				else if(!$n_ava){
					$e_n = $events[$ei];
					$link = 'event';
					$ei++;
				}
				else{
					if($events[$ei]->created_at>$newss[$ni]->created_at){
						$e_n = $events[$ei];
						$link = 'event';
						$ei++;
					}
					else{
						$e_n = $newss[$ni];
						$link = 'news';
						$ni++;
					}
				}
				?>
				<div class="e-n-home-preview">
					<h2><a href="{{ url($link."/"."$e_n->id") }}">{{$e_n->name}}</a></h2>
					<small>{{(new Carbon($e_n->created_at))->format('l, d F Y')}}</small>
				</div>
				<?php
					$i++;
					if($i>6){
						break;
					}
				?>
				@endwhile
			</div>
		</div>
		<div class="row ukm-home-preview" style="margin-top:0px;">
			<h2>
				Ukm
				<hr>
			</h2>
			@if(count($ukms)>0)
			<div class="ukm-container">
				@foreach($ukms as $ukm)
				<div class="ukm-item"
					<?php if($ukm->header_pic){ ?>
					style="background-image: url('{{ AppUtility::get_image_data($ukm->header_pic)}}')"
					<?php } ?>>
					<a href="{{ url('/ukm/'.$ukm->id) }}">
						<div class="ukm-item-facade">
							<div class="ukm-preview-title">
									{{$ukm->name}}
							</div>
							<div class="ukm-preview-content">
								@foreach($ukm->content as $content)
									@if($content->type=='s')
									<div>
										{!!$content->content!!}
									</div>
										<?php break; ?>
									@endif
								@endforeach
							</div>
						</div>
					</a>
				</div>
				@endforeach
				<div class="ukm-item">
					<a href="{{ url('/ukm') }}">
						<div class="ukm-item-facade" style="justify-content: center;">
							<h4>
								<span class="glyphicon glyphicon-menu-right"></span>Selengkapnya
							</h4>
						</div>
					</a>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
 
@stop

