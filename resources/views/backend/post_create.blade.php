@extends('layouts.admin')
@section('content')

    <h1>Новый пост</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--{!! Form::open(['url' => URL::route('gallery_store')]) !!}--}}
    {!! Form::model($post, ['url' => empty($post->id) ? URL::route('post_store') : URL::route('post_update', ['id' => $post->id])]) !!}
    <div class="row">
        <div class="col-lg-6">
            {!! Form::label('title', 'Название галереи'); !!}
            <p>{!! Form::text('title', null, ['size' => 50, 'required' => true]) !!}</p>
            {!! Form::label('slug', 'Slug'); !!}
            <p>{!! Form::text('slug', null, ['size' => 50]) !!}</p>
            {!! Form::label('short_text', 'Краткое описание'); !!}
            <p>{!! Form::textarea('short_text', null, ['cols' => 50, 'rows' => 5]) !!}</p>
        </div>
        <div class="col-lg-6">
            {!! Form::label('meta_title', 'Мета тайтл'); !!}
            <p>{!! Form::text('meta_title', null, ['size' => 50]) !!}</p>
            {!! Form::label('meta_keywords', 'Ключевые слова'); !!}
            <p>{!! Form::text('meta_keywords', null, ['size' => 50]) !!}</p>
            {!! Form::label('meta_description', 'Мета описание'); !!}
            <p>{!! Form::textarea('meta_description', null, ['cols' => 50, 'rows' => 5]) !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::label('text', 'Текст поста'); !!}
            <p>{!! Form::textarea('text', null, ['cols' => 130, 'rows' => 20, 'class' => 'editor']) !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::submit('Сохранить'); !!}
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern codesample",
                "toc imagetools help"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent removeformat formatselect| link image media | emoticons charmap | code codesample | forecolor backcolor",
//            external_plugins: { "nanospell": "http://demo_handmade/js/tinymce/plugins/nanospell/plugin.js" },
            nanospell_server: "php",
            browser_spellcheck: true,
            relative_urls: false,
            remove_script_host: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinymce.activeEditor.windowManager.open({
                    file: '<?= route('elfinder.tinymce4') ?>',// use an absolute path!
                    title: 'File manager',
                    width: 900,
                    height: 450,
                    resizable: 'yes'
                }, {
                    setUrl: function (url) {
                        win.document.getElementById(field_name).value = url;
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
    <script>
        {!! File::get(base_path('vendor/barryvdh/laravel-elfinder/resources/assets/js/standalonepopup.min.js')) !!}
    </script>
@endsection