@extends('layouts.admin')

@section('content')
    <h1>Редактированиe фотографии</h1>
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
    {!! Form::model($photo, ['url' => URL::route('photo_update', [$photo->id])]) !!}
    <div class="row">
        <div class="col-lg-12">
            {!! Form::label('description', 'Описание фото (alt)'); !!}
            <p>{!! Form::text('description', null, ['size' => 50, 'required' => false]) !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::submit('Сохранить'); !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
