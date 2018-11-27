@extends('layouts.admin')

@section('content')
    <h1>Редактированиe галереи</h1>
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
    {!! Form::model($gallery, ['url' => URL::route('gallery_update', $gallery->id)]) !!}
    <div class="row">
        <div class="col-lg-6">
            {!! Form::label('name', 'Название галереи'); !!}
            <p>{!! Form::text('name', null, ['size' => 50, 'required' => true]) !!}</p>
            {!! Form::label('slug', 'Slug'); !!}
            <p>{!! Form::text('slug', null, ['size' => 50]) !!}</p>
            {!! Form::label('description', 'Краткое описание'); !!}
            <p>{!! Form::textarea('description', null, ['cols' => 50, 'rows' => 5]) !!}</p>
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
            {!! Form::submit('Сохранить'); !!}
        </div>
    </div>
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12">
            <p>
            <h3>Загрузка фотографий</h3>
            <input id="img_upload" type="file" name="photos[]" multiple/>
            </p>

        </div>
    </div>
    <div class="error">

    </div>
    @if (count($photos) > 0)
        @foreach ($photos as $photo)
            <div id="{{$photo['id']}}">
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            <img src="{{ Storage::disk('photos')->url($photo['path']) }}">
                        </p>
                        <p>
                            Описание изображения: {{$photo['description']}}
                        </p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            <a href="{{route('photo_edit', $photo['id'])}}" class="btn btn-primary">Редактировать</a>
                            <a href="{{route('photo_destroy', $photo['id'])}}" class="btn btn-danger">Удалить</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <script>
        $(document).ready(function () {
            $('#img_upload').change(function (e) {
                $(".error").empty();
                var data = new FormData();
                $.each($('#img_upload')[0].files, function (i, file) {
                    data.append(i, file);
                });
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').attr('value')
                    }
                });
                $.ajax({
                    url: "/admin/gallery/add_photos/{{$gallery->id}}",
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (responce) {
                        location.reload();
                    },
                    error: function (responce) {
                        var errors = responce.responseJSON[0];
                        var html = "<div class='alert alert-danger'><ul>";
                        for (var i = 0, len = errors.length; i < len; i++) {
                            html += "<li>" + errors[i] + "</li>";
                            console.log(errors[i]);
                        }
                        html += "</ul></div>";
                        $(".error").append(html);
                    }
                });
            });
        });
    </script>

@endsection
