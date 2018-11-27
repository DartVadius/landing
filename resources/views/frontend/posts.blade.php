@extends('layouts.app')

@section('title', 'HandmadeHome | ' . $page->meta_title)
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)

@section('content')

    <!-- Section -->
    <section>
        <div class="inner">
            <header>
                <h1>Мои новости</h1>
            </header>
            {!! $page->text !!}

            <section class="columns double">
                @foreach ($posts as $post)
                    <div class="column">
                        <h3><a href="{{ route('post_view', ['slug' => $post->slug]) }}" class="active">{{$post->title}}</a></h3>
                        <p class="small">{{$post->date_create}}</p>
                        {{$post->short_text}}
                        <p><a href="{{ route('post_view', ['slug' => $post->slug]) }}">Подробнее</a></p>
                    </div>
                @endforeach
            </section>
            <div class="pagination1">
                {{ $posts->render() }}
            </div>
        </div>
    </section>
@endsection