@extends('layouts.app')

@section('title', 'HandmadeHome | ' . $page->meta_title)
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)

@section('content')
    <!-- Banner -->
    <section id="banner">
        <div class="inner">
            <h1>Hello! It's a Handmade home</h1>
            <p>A fully responsive gallery template by <a href="https://templated.co">TEMPLATED</a></p>
            <ul class="actions">
                <li><a href="#galleries" class="button alt scrolly big">Продолжить</a></li>
            </ul>
        </div>
    </section>

    <!-- Gallery -->
    <section id="galleries">

        <!-- Photo Galleries -->
        <div class="gallery">
            <header class="special">
                <h2>Случайные работы</h2>
            </header>
            <div class="content">
                @if($photos)
                    @foreach ($photos as $photo)
                        <div class="media">
                            <a href="{{ Storage::disk('photos')->url($photo->path) }}"><img
                                        src="{{ str_replace('900_', 'thumb_', Storage::disk('photos')->url($photo->path)) }}"
                                        alt="{{$photo->description}}" title="{{$photo->description}}"/></a>
                        </div>
                    @endforeach
                @endif
            </div>
            <footer>
                <p><a href="{{ route('galleries') }}" class="button big">Все работы</a></p>
                <p><a href="{{ route('posts') }}" class="button big">Что нового</a></p>
            </footer>
        </div>
    </section>
@endsection
