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
						{{ trim($content->content) }}
						@endforeach
					</textarea>
					<div class="editor-header-input-control">
						<label>Staff yang akan ditampilkan:</label>
						<label><small>Instruksi: masukkan username dari staff yang akan ditampilkan</small></label>
						<div>
							<input type="text" id="tag-input"><button id="tag-add"><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div id="tag-list">
						</div>
						<span id='tag-notification'></span>
					</div>   
				</div>
				<div class="col-xs-12 col-sm-12 avatar-container">
				</div>
				<div class="col-xs-12 col-sm-12 text-right">
					<button type="button" class="avatar-submit button-submit">Save</button>
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="row editor-parent">
				<div class="col-xs-12 col-sm-12 blog-content">
					<textarea class="hidden" id="section-top-old">@foreach($section_top as $content){!! trim($content->content) !!}@endforeach
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
					<textarea class="hidden" id="section-middle-old">@foreach($section_middle as $content){!! $content->content !!}@endforeach
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
					<textarea class="hidden" id="section-side-old">@foreach($section_side as $content){!! trim($content->content) !!}@endforeach</textarea>
					<textarea class="summernote" id="section-side"></textarea>
				</div>
				<div class="col-xs-12 col-sm-10 text-right">
					<button type="button" class="section-submit button-submit">Save</button>
				</div>
			</div>
		</div> 
	</div>
	
</section>

<div class='hidden' id='repo'>
	<div class="avatarSubmitUrl">
		{{ url('/profil/saveavatar') }}
	</div>
	<div class="avatarCheckUrl">
		{{ url('/profil/checkavatar') }}
	</div>
	<div class='submitUrl'>
		{{ url('/profil/edit') }}
	</div>
</div>

<script src="{{ url('utility/searchbuff/preparetoken.js') }}"></script>
<script>
	var staffs = [];
	var submitUrl;
	var avatarSubmitUrl;
	var avatarCheckUrl;
	var refreshStaff;
	var removeStaff;
	var checkAvatar;
	var saveAvatar;
	var tagNotification;
	var tagInput;
	var tagList
	var createTagListItem;
	var loadStaff;
	$(document).ready(function(){
		createTagListItem = function(word,i){
			return "<span data-index='"+i+"' class='tag-list-item'><span class='tag-list-string'>"+word+"</span><span class='glyphicon glyphicon-remove tag-list-remove'></span></span>"
		}
		submitUrl = $('#repo>.submitUrl').html().trim();
		avatarSubmitUrl = $('#repo>.avatarSubmitUrl').html().trim();
		avatarCheckUrl = $('#repo>.avatarCheckUrl').html().trim();
		tagNotification = $('#tag-notification')
		tagInput = $('#tag-input')
		tagList = $('#tag-list')
		loadStaff = function(){
			var oldStaffs = $('#avatar-old').html().trim();
			oldStaffs = oldStaffs.split(' ');
			
			for(var i = 0; i<oldStaffs.length; i++){
				staffs.push(oldStaffs[i]);
			}
			refreshStaff();
		}
		refreshStaff = function(){
			$('#tag-list').html('')
			for(var i = 0; i< staffs.length; i++){
				$('#tag-list').append(createTagListItem(staffs[i],i))
			}
			$('#tag-list .tag-list-remove').click(removeStaff)
		}
		removeStaff = function(e){
			staffs.splice($(this).attr('data-index'),1);
			refreshStaff();
		}
		checkAvatar = function(){
			var username  = tagInput.val().trim()
			if(username.length<1){
				return
			}
			$.ajax({
				url: avatarCheckUrl,
				method: 'post',
				data: {'username':username},
				success: function(data){
					try{
						data = JSON.parse(data);
						if(data['status']==1){
							tagNotification.html('<span class="alert-success">'+data['message']+'</span>')
							staffs.push(username)
							refreshStaff();
							tagInput.val('')
						}
						else if(data['status']==0){
						console.log(data)
							tagNotification.html('<span class="alert-warning">'+data['message']+'</span>')
						}
					}catch(error){
						console.log(error)
						tagNotification.html('<span class="alert-danger">Terjadi kesalahan pada sistem</span>')
					}
				},
				error: function(error){
					console.log(error)
					tagNotification.html('<span class="alert-danger">Terjadi kesalahan pada sistem</span>')
				}
			})
		}
		$('#tag-add').click(checkAvatar)
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
		
		$('button.avatar-submit').click(function(){
			$.ajax({
				url: avatarSubmitUrl,
				method: 'post',
				data: {'data':JSON.stringify(staffs)},
				success : function(data){
					console.log(data)
					data = JSON.parse(data)
					if(data['status']==1){
						$('.notification-bar').html('<div><span class="label">Success</span>Berhasil mengupdate daftar staff. </div>')
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
		loadStaff();
	})
</script>
@endsection