@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Блог</h1>
            <a href="{{route('post_create')}}" class="btn btn-success">Добавить пост</a>
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
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            {{ $post->id }}
                        </td>
                        <td>
                            {{$post->title}}
                        </td>
                        <td>
                            {{$post->date_create}}
                        </td>
                        <td>
                            {{$post->date_update}}
                        </td>
                        <td>
                            <a href="{{route('post_edit', $post->id)}}" class="btn btn-primary">Редактировать</a>
                            <a href="{{route('post_destroy', $post->id)}}" onclick="return confirm('Уверены?')" class="btn btn-danger">Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
