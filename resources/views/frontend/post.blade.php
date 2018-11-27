@extends('layouts.app')

@section('title', 'HandmadeHome | ' . $post->meta_title)
@section('keywords', $post->meta_keywords)
@section('description', $post->meta_description)

@section('content')
    <!-- Main -->
    <section id="main">

        <!-- Header -->
        <header id="header">
            <div><a href="{{ route('posts') }}">Назад</a></div>
        </header>

        <!-- Gallery -->
        <section id="galleries">

            <!-- Photo Galleries -->
            <div class="gallery">
                <div class="content">
                    <h1>{{$post->title}}</h1>
                    {!! $post->text !!}
                </div>
            </div>
        </section>

    </section>
@endsection