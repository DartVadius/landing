@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Страницы сайта</h1>
            {{--<a href="{{route('post_create')}}" class="btn btn-success">Добавить пост</a>--}}
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Создано</th>
                    <th>Отредактировано</th>
                    <th>Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>
                            {{ $page->id }}
                        </td>
                        <td>
                            {{$page->title}}
                        </td>
                        <td>
                            {{$page->created_at}}
                        </td>
                        <td>
                            {{$page->updated_at}}
                        </td>
                        <td>
                            <a href="{{route('page_edit', $page->id)}}" class="btn btn-primary">Редактировать</a>
                            {{--<a href="{{route('post_destroy', $post->id)}}" onclick="return confirm('Уверены?')" class="btn btn-danger">Удалить</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
