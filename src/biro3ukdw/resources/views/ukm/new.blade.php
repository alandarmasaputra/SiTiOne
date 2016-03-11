@extends('layout.app')
@section('head_title')
New UKM - Biro3 | UKW
@endsection
@section('body_content')
<div class="container">
    <div class="page-header">
        <h2>
            UKM Baru
        </h2>
    </div>
    <div class="text-center editor">
        <form method="post" action="{{ url('/beasiswa/new') }}">
            <div class="editor-header">
                <img id="header-pic-show">
                <div id="header-pic-alert" style="display:none;">please select valid file type. The supported file types are .jpg, .png, .bmp</div>
                <input name="header-pic" id="header-pic" type="file" onchange="imageupload(this)">
                <h2><input name="title" type="text"></h2>
            </div>
            <script>
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
            </script>
            
            <div id="editor-content">
            </div>
            <button id="new-paragraph">Add New Paragraph</button>
            <br>
            <button id="new-image">Add New Image</button>
            
            <br>
            <br>
            <input type="submit">
        </form>
        
        <script>
            function deleteParent(element){
                $(element).parent().remove();
                serializeId()
            }
            
            function newParagraph(){
                return "<div class='editor-item row'>"
                    +"<input type='hidden' value='text'>"
                    +"<textarea></textarea>"
                    +"<button onclick='deleteParent(this)'>Delete</button>"
                    +"</div>"
            }
            
            function newImage(){
                return "<div class='editor-item row'>"
                    +"<img></img>"
                    +"<input type='hidden' value='image'>"
                    +"<input type='file' onchange='imageupload(this)'>"
                    +"<button onclick='deleteParent(this)'>Delete</button>"
                    +"</div>"
            }
            
            function serializeId(){
                var i = 0;
                $('#editor-content').children().each(function(){
                    $(this).children("input[type='hidden']").attr('id','type'+i)
                    $(this).children("input[type='hidden']").attr('name','type'+i)
                    
                    $(this).children("textarea").attr('id','paragraph'+i)
                    $(this).children("textarea").attr('name','paragraph'+i)
                    
                    $(this).children("input[type='file']").attr('id','img-'+i)
                    $(this).children("input[type='file']").attr('name','img-'+i)
                    
                    $(this).children("img").attr('id','img-'+i+"-show")
                    i++;
                })
            }
            
            $('#new-paragraph').click(function(){
                $('#editor-content').append(newParagraph());
                serializeId()
            })
            
            $('#new-image').click(function(){
                $('#editor-content').append(newImage())
                serializeId()
            })
        </script>
    </div>
</div>
@endsection