@extends('layouts.app')

@section('title', 'HandmadeHome | ' . $page->meta_title)
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)

@section('content')

    <!-- Section -->
    <section>
        <div class="inner">
            <header>
                <h1>Мои работы</h1>
            </header>
            {!! $page->text !!}

            <section class="columns double">
                @foreach ($galleries as $gallery)
                    <div class="column">
                        <span class="image left special"><img src="{{Storage::disk('photos')->url($gallery->photos()->first()->path)}}" alt=""/></span>
                        <h3><a href="{{ route('gallery_view', ['slug' => $gallery->slug]) }}" class="active">{{$gallery->name}}</a></h3>
                        {{$gallery->description}}
                        <a href="{{ route('gallery_view', ['slug' => $gallery->slug]) }}">Все фото</a>
                    </div>
                @endforeach
            </section>
            <div class="pagination1">
                {{ $galleries->render() }}
            </div>
        </div>
    </section>
@endsection