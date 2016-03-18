function imageupload(element){
    var elementId = element.id;
    if(element.files && element.files[0]){
        var file = element.files[0];
        var validFileType = ".jpg, .png, .bmp";
        var extension = file.name.substring(file.name.lastIndexOf('.'));
        $("#"+elementId+"-show").attr('src', "");

        //validatefile
        if(validFileType.toLowerCase().indexOf(extension)<0){
            $("#"+elementId+"-alert").show();
            return;
        }
        $("#"+elementId+"-alert").hide();

        //showfile
        var reader = new FileReader();
        reader.onload = function(e){
            $("#"+elementId+"-show")
            .attr('src', e.target.result)
        }
        if (reader.readAsDataURL) {reader.readAsDataURL(element.files[0]);}
        else if(reader.readAsDataurl) {reader.readAsDataurl(element.files[0]);}
        else if(reader.readAsDataUrl) {reader.readAsDataUrl(element.files[0]);}
    }
    else{
        $(elementId+"-show").attr('src',"");
    }
}

function deleteParent(event,element){
    event.preventDefault();
    $(element).parent().parent().remove();
    serializeId()
}

function initSummernote(jqElement){
    $(jqElement).summernote({
        callbacks: {
            onKeydown: function(e) {
                var num = $(this).parent().find('.note-editor .note-editable').text().length;
                var key = e.keyCode;
                var maxlength = 16000;
                allowed_keys = [8, 37, 38, 39, 40, 46]
                if($.inArray(key, allowed_keys) != -1)
                    return true
                else if(num >= maxlength){
                    $(this).parent().find('.note-editor .note-editable').text($(this).parent().find('.note-editor .note-editable').text().substr(0,maxlength))
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
            ['codeview', ['codeview']]
        ],
        disableDragAndDrop: true
    });
}

function insertParagraphBefore(event,element){
    event.preventDefault();
    var nElement = $(newParagraph());
    $(nElement).insertBefore($(element).parent().parent());
    initSummernote(nElement.find('textarea'))
    serializeId()
}

function insertImageBefore(event,element){
    event.preventDefault();
    var nElement = $(newImage());
    $(nElement).insertBefore($(element).parent().parent());
    serializeId()
}

function newButtonPanel(){
    return "<div class='editor-button'>"
                +"<button onclick='insertParagraphBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Text</button>"
                +"<button onclick='insertImageBefore(event,this)'><span class='glyphicon glyphicon-plus'></span>Image</button>"
                +"<button onclick='deleteParent(event,this)'><span class='glyphicon glyphicon-remove'></span>Delete</button>"
            +"</div>"
}

function newEditorNumber(){
    return "<div class='editor-item-number'></div>"
}

function newParagraph(){
    return "<div class='editor-item row'>"
            +newEditorNumber()
            +"<div class='editor-record'>"
                +"<input class='editor-item-id' type='hidden' name='type' value='text'>"
                +"<textarea class='editor-paragraph' maxlength='200'></textarea>"
            +"</div>"
            +newButtonPanel()
        +"</div>"
}

function newImage(){
    return "<div class='editor-item row'>"
            +newEditorNumber()
            +"<div class='editor-record'>"
                +"<img class='editor-image-show'></img>"
                +"<input class='editor-item-id' type='hidden' name='type' value='image'>"
                +"<input class='editor-image' type='file' onchange='imageupload(this)'>"
            +"</div>"
            +newButtonPanel()
        +"</div>"
}

function serializeId(){
    var i = 0;
    $('#editor-content').children().each(function(){
        $(this).find(".editor-item-number").html(i);

        $(this).find(".editor-item-id").attr('id','type-'+i)
        $(this).find(".editor-item-id").attr('name','type-'+i)

        $(this).find(".editor-paragraph").attr('id','paragraph-'+i)
        $(this).find(".editor-paragraph").attr('name','paragraph-'+i)

        $(this).find(".editor-image").attr('id','img-'+i)
        $(this).find(".editor-image").attr('name','img-'+i)

        $(this).find(".editor-image-show").attr('id','img-'+i+"-show")
        i++;
    })
}

$('#new-paragraph').click(function(e){
    e.preventDefault();
    var nElement = $(newParagraph());
    $('#editor-content').append(nElement);

    initSummernote(nElement.find('textarea'))
    serializeId()
})

$('#new-image').click(function(e){
    e.preventDefault();
    var nElement = $(newImage());
    $('#editor-content').append(nElement);

    initSummernote(nElement.find('textarea'))
    serializeId()
})