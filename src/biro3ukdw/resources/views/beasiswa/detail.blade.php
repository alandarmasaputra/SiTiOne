@extends('layout.app')
@section('head_title')
Detail Beasiswa - Biro3 | UKW
@endsection
@section('body_content')
<div class="container">
    <div class="page-header">
        <h2>
            Detail Beasiswa
        </h2>
    </div>
    <div class="text-center">
        <form>
            <img id="header-pic-show">
            <input id="header-pic" type="file" onchange="imageupload(this)">
            <script>
                function imageupload(element){
                    var elementId = element.id;
                    if(element.files && element.files[0]){
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
        </form>
    </div>
</div>
@endsection