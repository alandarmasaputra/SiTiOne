@extends('layout.app')
@section('head_title')
Biro Kemahasiswaan UKDW
@endsection
@section('nav_event')
active
@endsection
@section('body_content')
<?php
use App\AppUtility;
use Carbon\Carbon;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <button>
                    <a href="{{ url('/event') }}">
                        <span class="glyphicon glyphicon-menu-left">
                        </span>
                    </a>
                </button>
                <h2>
                    Event: {{$event->name}}
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 event-detail">
			<div class="row">
				<div class="col-md-offset-1 col-md-10 event-detail-facade">
					<div class="col-md-5 event-detail-header">
						@if($event->header_pic)
						<div class="event-detail-pic" style="background-image: url('{{AppUtility::get_image_data($event->header_pic)}}')">
						</div>
						@endif
						@if(Auth::user())
						<div>
							<a href="{{ url('event/edit/'.$event->id) }}"><button>Edit</button></a>
							<a href="{{ url('event/delete/'.$event->id) }}"><button class="button-delete">Delete</button></a>
						</div>
						@endif
						@if($event->event_date)
						<div>
							<span class="glyphicon glyphicon-calendar"> </span>&nbsp;Tanggal: <strong> {{(new Carbon($event->event_date))->format('l, d F Y')}}</strong>
						</div>
						@endif
						@if($event->tempat)
						<div>
							<span class="glyphicon glyphicon-map-marker"> </span>&nbsp;Tempat: <strong> {{$event->tempat}}</strong>
						</div>
						@endif
						@if($event->sumber)
						<div>
							<?php
							$sumberlink = $event->sumberlink()
							?>
							@if($sumberlink!=false)
							<span class="glyphicon glyphicon-bullhorn"> </span>&nbsp;Penyelenggara: <strong><a href="{{ url($sumberlink) }}">{{$event->sumber}}</a></strong>
							@else
							<span class="glyphicon glyphicon-bullhorn"> </span>&nbsp;Penyelenggara: <strong> {{$event->sumber}}</strong>
							@endif
						</div>
						@endif
						@if(strlen(trim($event->kategori))>0)
						<div>
							<span class="glyphicon glyphicon-tag"> </span>&nbsp;Tags:
						</div>
						<div>
							<?php
								$tags = $event->kategori;
								$tags = explode(' ',$tags);
							?>
							@foreach($tags as $tag)
							<span class="tag-list-item">
								{{$tag}}
							</span>
							@endforeach
						</div>
						@endif
					</div>
					<div class="col-md-7 event-detail-content">
						<h2>
							{{ $event->name}}
							<hr>
						</h2>
						@foreach($event->content as $content)
						@if($content->type=='s')
						{!! $content->content !!}
						@else
						<div class="text-center">
							<img src="{{ AppUtility::get_image_data( $content->content )}}">
						</div>
						@endif
						@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-10 event-detail-facade">
					<h2>
						Event lain
						<hr>
					</h2>
					<div class="event-lain">
						<?php
							$i = 0;
						?>
						@foreach($event->otherEvents() as $otherEvent)
						@if($otherEvent->header_pic)
							<div>
								<a href="{{ url('event/'.$otherEvent->id) }}">
									<div>
										<img src="{{ AppUtility::get_image_data($otherEvent->header_pic) }}" title="Event:{{ $otherEvent->name }}">
									</div>
									<div>
										{{ $otherEvent->name }}
									</div>
								</a>
							</div>


							<?php
							//break after 8 printed
							$i++;
							if($i>8){
								break;
							}
							?>
						@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection