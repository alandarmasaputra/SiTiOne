
$('.editor .nofade').css('opacity',1);
$('.editor .nofade *').css('opacity',1);
$('.editor-new .editor-header *').prop('disabled',true);
$('.editor-new .editor-content-container').prop('disabled',true);
$('.editor-new .editor-content-label').prop('disabled',true);
$('.editor .nofade').prop('disabled',false);
$('.editor .nofade *').prop('disabled',false);
$('form[enctype="multipart/form-data"]').attr('onsubmit','return false');

$('#editor-header-title').blur(function(){
	if($('#editor-header-title').val().trim()!=''){
		if($('.editor-new .editor-header *').css('opacity')==0){
			$('.editor-new .editor-header *').css('opacity',1);
			$('.editor-new .editor-content-container').css('opacity',1);
			$('.editor-new .editor-content-label').css('opacity',1);
			$('.editor-new .editor-header *').prop('disabled',false);
			$('.editor-new .editor-content-container').prop('disabled',false);
			$('.editor-new .editor-content-label').prop('disabled',false);
			$('.editor-new').removeClass('editor-new');
			initNew();
			$('form[enctype="multipart/form-data"]').removeAttr('onsubmit');
		}
	}
})