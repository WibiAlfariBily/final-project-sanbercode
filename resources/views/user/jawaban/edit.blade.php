<?php

    use Illuminate\Support\Facades\Auth;
    
    use Carbon\Carbon;
    $current_date_time = Carbon::now()->toDateTimeString(); 

?>

<!DOCTYPE HTML>
@extends('layouts.app')

@section('title', 'Buat Pertanyaan')

@section('content')

<div class="row p-2">

    <div class="col-md-2 mb-2">
        @include('layouts.partials.leftbar')
    </div>

    <div class="col-md-8 mb-2">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card main">
                        <div class="card-header">Edit Jawaban</div>
                        {{-- {{dd($data_jawab->created_at)}} --}}
                        <div class="card-body">
                            {{-- @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif --}}
                            <form method="post" action="{{url('/edit-jawaban/')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$data_jawab->id}}">
                                <input type="hidden" name="created_at" value="{{$data_jawab->created_at}}">
                                <input type="hidden" name="updated_at" value="{{$current_date_time}}">
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="pertanyaan_id" value="{{$data_jawab->pertanyaan_id}}">
                                <div class="form-group">
                                    <label for="isi"><b>Isi Jawaban</b></label>
                                    <textarea style="height: 200px" name="description" class="form-control my-editor">{!! $data_jawab->description !!}</textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-outline-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-2">
            <div class="card main">
                <div class="card-body">
                    @include('layouts.partials.rightbar')
                </div>
            </div>
        </div>

</div>

    


@endsection

@push('scripts')
    
<script>
    var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
    } else {
        cmsURL = cmsURL + "&type=Files";
    }

    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
    });
    }
};

tinymce.init(editor_config);
</script>

@endpush