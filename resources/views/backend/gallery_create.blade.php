@extends('layouts.admin')

@section('content')
    <h1>Новая галерея</h1>
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
    {!! Form::model($gallery, ['url' => URL::route('gallery_store')]) !!}
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
@endsection
