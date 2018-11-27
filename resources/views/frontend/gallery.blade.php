@extends('layouts.app')

@section('title', 'HandmadeHome | ' . $gallery->meta_title)
@section('keywords', $gallery->meta_keywords)
@section('description', $gallery->meta_description)

@section('content')
    <!-- Main -->
    <section id="main">

        <!-- Header -->
        <header id="header">
            <div><a href="{{ route('galleries') }}">Назад</a></div>
        </header>

        <!-- Gallery -->
        <section id="galleries">

            <!-- Photo Galleries -->
            <div class="gallery">

                <!-- Filters -->
                <header>
                    <h1>{{$gallery->name}}</h1>
                    <p>{{$gallery->description}}</p>
                    {{--<ul class="tabs">--}}
                        {{--<li><a href="#" data-tag="all" class="button active">All</a></li>--}}
                        {{--<li><a href="#" data-tag="people" class="button">People</a></li>--}}
                        {{--<li><a href="#" data-tag="place" class="button">Places</a></li>--}}
                        {{--<li><a href="#" data-tag="thing" class="button">Things</a></li>--}}
                    {{--</ul>--}}
                </header>

                <div class="content">
                    @foreach ($gallery->photos as $photo)
                        <div class="media all people">
                            <a href="{{ Storage::disk('photos')->url($photo->path) }}"><img
                                        src="{{ str_replace('900_', 'thumb_', Storage::disk('photos')->url($photo->path)) }}"
                                        alt="{{$photo->description}}" title="{{$photo->description}}"/></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </section>
@endsection