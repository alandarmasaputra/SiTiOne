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
    <div class="text-center">
        <form>
            <img id="header-pic-show">
            <input id="header-pic" type="file" onchange="read">
            <script>
                function imageupload(element){
                    var id = element.id;
                    if(element.files && element.files[0]){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('#blah')
                            .attr('src', e.target.result)
                        }
                    }
                }
            </script>
        </form>
    </div>
</div>
@endsection