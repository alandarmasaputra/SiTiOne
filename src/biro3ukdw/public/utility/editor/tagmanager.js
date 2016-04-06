var tagManager = {};
	tagManager.tags = [];
	tagManager.delete = function(word){
		var index = tagManager.find(word);
		while(index!=null){
			tagManager.tags.splice(index,1);
			index = tagManager.find(word);
		}
	}
	tagManager.find = function(word){
		for(var i = 0; i<tagManager.tags.length; i++){
			if(tagManager.tags[i]==word){
				return i;
			}
		}
		return null;
	}
	tagManager.exists = function(word){
		return tagManager.find(word)!=null;
	}
	tagManager.addToTag = function(word){
		if(!tagManager.exists(word)){
			tagManager.tags.push(word);
		}
	}
	tagManager.sort = function(){
		tagManager.tags.sort();
	}
	tagManager.toString = function(){
		var str = "";
		for(var i = 0; i<tagManager.tags.length; i++){
			str+=" "+tagManager.tags[i];
		}
		str = str.trim();
	}
	tagManager.iterate = function(func){
		for(var i = 0; i<tagManager.tags.length; i++){
			func(tagManager.tags[i]);
		}
	}

function loadTagList(){
	var tagString = $('#kategori-tambahan').val().trim();
	var tagSplit = tagString.split(" ");
	for(var i = 0; i<tagSplit.length; i++){
		tagManager.addToTag(tagSplit[i]);
	}
	updateTagList();
}

function updateTagList(){
	var tagListItems = "";
	var tagListHidden = "";
	tagManager.iterate(function(word){
		tagListItems += createTagListItem(word);
		tagListHidden += " "+word
	})
	tagListHidden.trim();
	$('#kategori-tambahan').val(tagListHidden);
	$('#tag-list').html(tagListItems);
	refreshRemoveButton();
}

function createTagListItem(word){
	return "<span class='tag-list-item'><span class='tag-list-string'>"+word+"</span><span class='glyphicon glyphicon-remove tag-list-remove'></span></span>"
}

$('#tag-add').click(function(event){
	event.preventDefault();
	var newTag = $('#tag-input').val();
	newTag = newTag.trim();
	newTag = newTag.toLowerCase();

	if(newTag.length>0){
		tagManager.addToTag(newTag);
		tagManager.sort();
		updateTagList();
	}


	$('#tag-input').val("");
});

function refreshRemoveButton(){
	$('.tag-list-remove').click(function(event){
		event.preventDefault();
		var deleteTag = $(this).parent('.tag-list-item').children('.tag-list-string').html().trim();

		tagManager.delete(deleteTag);
		updateTagList();
	})
}