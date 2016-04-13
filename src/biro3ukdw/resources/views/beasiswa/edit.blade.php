@extends('layout.app')
@section('head_title')
Edit Beasiswa - Biro3 | UKDW
@endsection

@section('head_addition')
<link href="{{ url('utility/summernote/summernote.css')}}" rel="stylesheet" type="text/css">
<script src="{{ url('utility/summernote/summernote.js') }}"></script>
@endsection

<?php
use App\AppUtility;
use Carbon\Carbon;
?>

@section('body_content')
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			@include('layout.dashboard')
		</div>
		<div class="col-xs-12 col-sm-9">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<button>
							<a href="{{ url('/beasiswa/'.$beasiswa->id) }}">
								<span class="glyphicon glyphicon-menu-left">
								</span>
							</a>
						</button>
						<h2>
            				Edit Beasiswa
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 body-content card">
					<!-- jangan diubah ubah -->
					<div class="editor">
						<form method="post" action="{{ url('/beasiswa/update/'.$beasiswa->id) }}" enctype="multipart/form-data"><!--  -->
							{!! csrf_field() !!}
							<div class="editor-header">
								@if($beasiswa->header_pic)
								<div id="header-pic-show" style="background-image: url('{{AppUtility::get_image_data($beasiswa->header_pic) }}'); height: 400px">
									<div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
									<label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
								</div>
								@else
								<div id="header-pic-show">
									<div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
									<label>Upload foto:</label> <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
								</div>
								@endif
								<textarea name="header-pic-old" style="display:none;">{{ $beasiswa->header_pic }}</textarea>
								<h2 class="text-left">
									<input name="title" id="editor-header-title" type="text" value="{{ $beasiswa->name }}" required>
								</h2>
								<div class="editor-header-input-group">
									<div class="editor-header-input-control">
										<label>Sumber: </label>
										<input type="text" name="sumber" value="{{ $beasiswa->sumber }}" required>
									</div>

									<div class="editor-header-input-control">
										<label>Pendaftaran Terakhir: </label>
										@if($beasiswa->deadline_date)
										<input type="date" name="deadline-date" value="{{ (new Carbon($beasiswa->deadline_date))->format('Y-m-d') }}">
										@else
										<input type="date" name="deadline-date">
										@endif
										
									</div>

									<div class="editor-header-input-control">
										<label>Kategori: </label>
										<div>
											<div>
												<input type="radio" name="kategori-utama" value="internal" required<?php if($beasiswa->isInternal()){ echo " checked"; } ?>><label>Internal</label>
											</div>
											<div>
												<input type="radio" name="kategori-utama" value="external" required<?php if($beasiswa->isExternal()){ echo " checked"; } ?>><label>External</label>
											</div>
										</div>
									</div>

									<div class="editor-header-input-control">
										<label>Tags:</label>
										<div>
											<input type="text" id="tag-input"><button id="tag-add"><span class="glyphicon glyphicon-plus"></span></button>
										</div>
										<div id="tag-list">
										</div>
										<input type="hidden" id="kategori-tambahan" name="kategori-tambahan" value="{{ $beasiswa->tags() }}">
									</div>
								</div>
							</div>
							<div class="editor-content-container text-center">
								<div id="editor-content">
								<?php
									//start counter
									$i = 0;
								?>
								@foreach($beasiswa->content as $content)


								<div class="editor-item row">
									<div class="editor-item-number">{{ $i+1 }}</div>
									<div class="editor-record">
									@if($content->type == 's')
										<input class="editor-item-id" type="hidden" name="type-{{$i}}" value="text" id="type-{{$i}}">
										<textarea class="content-old" id="content-{{$i}}-old" name="content-{{$i}}-old" style="display:none;">{{ $content->content }}</textarea>
										<textarea class="editor-paragraph" id="paragraph-{{$i}}" name="paragraph-{{$i}}" style="display: none;"></textarea>

									@elseif($content->type == 'i')
										<input class="editor-item-id" type="hidden" name="type-{{$i}}" value="image" id="type-{{$i}}">
										<textarea class="content-old" id="content-{{$i}}-old" name="content-{{$i}}-old" style="display:none;">{{ $content->content }}</textarea>
										<div class='editor-image-show' style="background-image:url('{{ AppUtility::get_image_data($content->content) }}'); height:400px;'">
											<input class='editor-image' type='file' onchange='imageupload(this)'>
										</div>
									@endif
									</div>
									{!! newButtonPanel() !!}
								</div>



								<?php
									//iterates counter
									$i += 1;
								?>
								@endforeach
								</div>
								<button id="new-paragraph"><span class="glyphicon glyphicon-plus"></span> Paragraph</button>
								<button id="new-image"><span class="glyphicon glyphicon-plus"></span> Image</button>
							</div>
							<br>
							<br>
							<div class="text-center">
								<input type="submit">
							</div>

							<!-- include harus sebelum tutup form -->
							<script src="{{ url('utility/editor/editor.js') }}"></script>
							<script src="{{ url('utility/editor/editor_load.js') }}"></script>
							<script src="{{ url('utility/editor/tagmanager.js')}}"></script>
							<script src="{{ url('utility/editor/tagmanager_load.js')}}"></script>
						</form>
					</div>
					<!-- -->
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection

<?php
function newButtonPanel(){
    return "<div class='editor-button'>"
                ."<button type='button' onclick='insertParagraphBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Text</button>"
                ."<button type='button' onclick='insertImageBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Image</button>"
                ."<button type='button' onclick='deleteParent(event,this)'><span class='glyphicon glyphicon-remove'></span>Delete</button>"
            ."</div>";
}
?>