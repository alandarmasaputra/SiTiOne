@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_profil')
active
@endsection

@extends('layout.app')

<?php
	use App\AppUtility;
?>

@section('body_content')

<section id="blog" class="container-fluid">
	<div class="row profil-card">		
		@if(Auth::user())	
		@if(Auth::user()->auth_level < 2)
		<div class="col-xs-12 text-right">
			<a href="{{ url('/profil/edit') }}"><button>Edit Profil Biro Kemahasiswaan UKDW</button></a>
		</div>
		@endif
		@endif

		<div class="col-md-4 section-side">
			<div class="row">
				<div class="col-md-11">
					@foreach($section_side as $content){!! $content->content !!}@endforeach
				</div>
			</div>
		</div> 
		<div class="col-md-5">
			<div class="row section-top">
				<div class="col-xs-12 col-sm-12 blog-content">
					@foreach($section_top as $content){!! $content->content !!}@endforeach
				</div>
			</div>   
			<hr>
			<div class="row section-middle">
				<div class="col-xs-12 col-sm-12 blog-content">
					@foreach($section_middle as $content){!! $content->content !!}@endforeach
				</div>
			</div> 
		</div>

		<div class="col-md-3 avatars">
			<div>
				<h2><strong>Staff dan Karyawan</strong></h2>
			</div>
			@foreach($section_avatar as $avatar)
			<?php
				$addition = $avatar->addition();
				if($addition == null){
					$addition = $avatar->additionTemplate();
				}
			?>
			<div class="avatar-item">
				<div class="display-pic" style="<?php
												if($addition->display_pic){
													echo "background-image: url('".AppUtility::get_image_data($addition->display_pic)."')";
												}
												else
												{
													echo "background-color: rgba(124,124,124,0.1)";
												}
												?>">
					<?php
					if(!$addition->display_pic){
						echo "No photo";
					}
					?>
				</div>
				<div class="name">
					<h2>
					{{ $addition->display_name ? $addition->display_name : $avatar->username}}
					</h2>
				</div>
				<div class="detail">
					<dl>
						@if($avatar->email)
						<dt>
							Email
						</dt>
						<dd>
							{{ $avatar->email }}
						</dd>
						@endif
						@if($addition->jabatan)
						<dt>
							Jabatan
						</dt>
						<dd>
							{{ $addition->jabatan }}
						</dd>
						@endif
						@if($addition->phone)
						<dt>
							Nomor Kontak
						</dt>
						<dd>
							{{ $addition->phone }}
						</dd>
						@endif
					</dl>
				</div>
				
			</div>
			@endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="text-center">
				<a id="back-to-top" href="#" class="back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
			</div>
		</div>
	</div>
</section>
@endsection