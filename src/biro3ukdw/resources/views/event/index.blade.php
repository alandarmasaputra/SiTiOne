@extends('layout.app')
@section('head_title')
Event - Biro3 | UKDW
@endsection

@section('nav_event')
active
@endsection

<?php
    use App\AppUtility;
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
		<div class="event-container event-timeline">
			<div class="event-timeline-block">
				<div class="event-timeline-img">
					<img src="{{ asset('style/images/eventmark/cd-icon-location.svg') }}">
				</div>
				<div class="event-timeline-content">
					<a href="{{url('/event/new')}}">
						<div class="event-tambah text-center flex-column contents-center">
							<div>
								<h2>
									<span class="glyphicon glyphicon-plus">
									</span>
								</h2>
							</div>
							<h2>
								Tambah Event
							</h2>
						</div>
					</a>
				</div>
			</div>
			@foreach($events as $event)
			<div class="event-timeline-block">
				<div class="event-timeline-img">
					<img src="{{ asset('style/images/eventmark/cd-icon-location.svg') }}">
				</div>
				<div class="event-timeline-content">
					
						<?php if($event->header_pic){ ?>
						style="background-image: url('{{ AppUtility::get_image_data($event->header_pic)}}')"
						<?php } ?>>
						<div class="ukm-item-facade">
							<div class="ukm-preview-title">
								<a href="{{ url('/event/'.$event->id) }}">
									{{$event->name}}
								</a>
							</div>
							<div class="ukm-preview-content">
								@foreach($event->content as $content)
									@if($content->type=='s')
									<div>
										{!!$content->content!!}
									</div>
										<?php break; ?>
									@endif
								@endforeach
							</div>
						</div>
					
				</div>
			</div>
			@endforeach
		</div>
	</div>
    
</div>
@endsection
