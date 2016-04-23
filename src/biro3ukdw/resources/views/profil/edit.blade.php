@extends('layout.app')

@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_profil')
active
@endsection


@section('head_addition')
<!--script src="readmore.js"></script-->
<script src="{{ url('utility/summernote/summernote.js') }}"></script>
<link rel='stylesheet' href="{{ url('utility/summernote/summernote.css') }}">
        
<style>
	img.avatar {
		border: 3px solid #e1e1e1;
		height: 100px;
		width: 100px;
		margin: auto;
	}

	.only-bottom-margin {
	  margin-top: 3%;
	}

	.activity-mini {
	  padding-right: 0px;
	  float: left;
	}
	.img-circle {
		-webkit-animation: fadein 2.5s; /* Safari and Chrome */
		-moz-animation: fadein 2.5s; /* Firefox */
		-ms-animation: fadein 2.5s; /* Internet Explorer */
		-o-animation: fadein 2.5s; /* Opera */
		animation: fadein 2.5s;
	}

	@keyframes fadein {
		from { opacity: 0; }
		to   { opacity: 1; }
	}

	/* Firefox */
	@-moz-keyframes fadein {
		from { opacity: 0; }
		to   { opacity: 1; }
	}

	/* Safari and Chrome */
	@-webkit-keyframes fadein {
		from { opacity: 0; }
		to   { opacity: 1; }
	}

	/* Internet Explorer */
	@-ms-keyframes fadein {
		from { opacity: 0; }
		to   { opacity: 1; }
	}

	/* Opera */
	@-o-keyframes fadein {
		from { opacity: 0; }
		to   { opacity: 1; }
	}
</style>
@endsection
@section('body_content')
<section id="blog" class="container">
	{!! csrf_field() !!}
	<div class="row profil-card">	
		<div class="col-md-3 avatars">
			<div class="row">
				<div class="col-xs-12 col-sm-12">
					<textarea class="hidden" id="avatar-old">
						@foreach($section_avatar as $content)
						{{ $content->content }}
						@endforeach
					</textarea>
					<input class="hidden" id="avatar" type="number">
				</div>
				<div class="col-xs-12 col-sm-12 avatar-container">
				</div>
				<div class="col-xs-12 col-sm-12 text-right">
					<button type="button" class="button-submit">Save</button>
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="row editor-parent">
				<div class="col-xs-12 col-sm-12 blog-content">
					<textarea class="hidden" id="section-top-old">
						@foreach($section_top as $content)
						{{ $content->content }}
						@endforeach
					</textarea>
					<textarea class="summernote" id="section-top">
					</textarea>
				</div>
				<div class="col-xs-12 col-sm-12 text-right">
					<button type="button" class="section-submit button-submit">Save</button>
				</div>
			</div>   
			<hr>
			<div class="row editor-parent">
				<div class="col-xs-12 col-sm-12 blog-content">
					<textarea class="hidden" id="section-middle-old">
						@foreach($section_middle as $content)
						{{ $content->content }}
						@endforeach
					</textarea>
					<textarea class="summernote" id="section-middle"></textarea>
				</div>
				<div class="col-xs-12 col-sm-12 text-right">
					<button type="button" class="section-submit button-submit">Save</button>
				</div>
			</div> 
		</div>

		<div class="col-md-4">
			<div class="row editor-parent">
				<div class="col-md-11">
					<textarea class="hidden" id="section-side-old">
						@foreach($section_side as $content)
						{{ $content->content }}
						@endforeach
					</textarea>
					<textarea class="summernote" id="section-side"></textarea>
				</div>
				<div class="col-xs-12 col-sm-10 text-right">
					<button type="button" class="section-submit button-submit">Save</button>
				</div>
			</div>
		</div> 
	</div>
	<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</section>

<div class='hidden' id='repo'>
	<div class='submitUrl'>
		{{ url('/profil/edit') }}
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var staffs = [];
	var submitUrl;
	$(document).ready(function(){
		submitUrl = $('#repo>.submitUrl').html().trim();
		$('textarea.summernote').each(function(){
			var thisElement = $(this)
			var thisId = $(this).attr('id')
			thisElement.text($(this).parents('.editor-parent').find('textarea#'+thisId+"-old").text())
		})
		
		$('#avatar').each(function(){
			var thisElement = $(this)
			var thisId = $(this).attr('id')
			thisElement.val($(this).parents('.editor-parent').find('textarea#'+thisId+"-old").text())
		})
		
		$('textarea.summernote').summernote({
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				},
				onKeydown: function(e) {
					var num = $(this).parents('.editor-item').find('.note-editor .note-editable').text().length;
					var key = e.keyCode;
					var maxlength = 16000;
					allowed_keys = [8, 37, 38, 39, 40, 46]
					if($.inArray(key, allowed_keys) != -1)
						return true
					else if(num >= maxlength){
						$(this).parents('.editor-item').find('.note-editor .note-editable').text($(this).parents('.editor-item').find('.note-editor .note-editable').text().substr(0,maxlength))
						e.preventDefault();
						e.stopPropagation();
					}
				}
			},
			toolbar:[
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']],
				['insert',['link']],
				['codeview', ['codeview']]
			],
			disableDragAndDrop: true,
			minHeight: "180px"
		});
		
		$('button.section-submit').click(function(){
			var textarea = $(this).parents('.editor-parent').find('.summernote')
			var data = {
				'section_name' : textarea.attr('id'),
				'content' : textarea.summernote('code')
			}
			console.log(textarea.summernote('code'))
			
			
			$.ajax({
				url: submitUrl,
				method: 'post',
				data: {'data':JSON.stringify(data)},
				success : function(data){
					console.log(data)
					data = JSON.parse(data)
					if(data['status']==1){
						$('.notification-bar').html('<div><span class="label">Success</span>Berhasil mengupdate '+textarea.attr('id')+' </div>')
					}
					else{
						$('.notification-bar').html('<div><span class="label">Alert</span>Terjadi kesalahan pada sistem</div>')
					}
				},
				error : function(error){
					console.log(error)
					$('.notification-bar').html(error.responseText)
					//$('.notification-bar').html('<div><span class="label">Alert</span>Terjadi kesalahan pada sistem</div>')
					/*
						<div>
							<span class="label">Alert</span>
						</div>
					*/
				}
				
			})
		})
	})
</script>
@endsection