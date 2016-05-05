
<?php
use Carbon\Carbon;
use App\AppUtility;
?>
@if(Auth::user())
<div class="event-timeline-block">
	<div class="event-timeline-img">
		<div>
			<span class="glyphicon glyphicon-plus"></span>
		</div>
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
@else
@if(count($events)==0)
<div class='cinema'><span>Hasil yang sesuai dengan pencarian tidak ditemukan</span></div>
@endif
@endif

@foreach($events as $event)
<div class="event-timeline-block">
	<div class="event-timeline-img text-center">
		<div>
			<?php $nowDate = new Carbon($event->event_date)?>
			<div class="text-left">
				{{$nowDate->format('M')}}
			</div>
			<div class="text-left">
				{{$nowDate->format('d')}}
			</div>
		</div>
		<!--<img src="{{ asset('style/images/eventmark/cd-icon-location.svg') }}"> -->
	</div>
	<div class="event-timeline-content">
		@if($event->header_pic)
		<div class="event-timeline-pic"
			 style="background-image: url('{{ AppUtility::get_image_data($event->header_pic)}}')">
		</div>
		@endif
		<div class="event-timeline-text">
			<div class="event-timeline-title">
				<a href="{{ url('/event/'.$event->id) }}">
					{{$event->name}}
				</a>
				<div class="event-timeline-sumber">{{$event->sumber}}</div>
			</div>
			@if($event->event_date)
			<div class="event-timeline-date">
				<strong>
				Tanggal Posting: {{(new Carbon($event->created_at))->format('l, d F Y')}}
				</strong>
			</div>
			@endif
			<div class="event-detail-content">
				@foreach($event->content as $content)
					@if($content->type=='s')
					<div>
						{!! $content->content !!}
					</div>
						<?php break; ?>
					@endif
				@endforeach
			</div>
			<hr>
			<div>
				<?php
				$tags = trim($event->kategori);
				$tags = explode(' ',$tags);
				?>
				Tags:
				@foreach($tags as $tag)
				@if($tag!='')
				<span class="tag-list-item">
					<a href="{{ url('search?q='.$tag) }}">
						{{$tag}}
					</a>
				</span>
				@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@endforeach