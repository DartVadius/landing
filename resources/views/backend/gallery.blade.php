@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-lg-12">
                <h1>Галереи</h1>
                <a href="{{route('gallery_create')}}" class="btn btn-success">Добавить галерею</a>
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
                    @foreach ($galleries as $gallery)
                        <tr>
                            <td>
                                {{ $gallery->id }}
                            </td>
                            <td>
                                {{$gallery->name}}
                            </td>
                            <td>
                                {{$gallery->date_create}}
                            </td>
                            <td>
                                {{$gallery->date_update}}
                            </td>
                            <td>
                                <a href="{{route('gallery_edit', $gallery->id)}}" class="btn btn-primary">Редактировать</a>
                                <a href="{{route('gallery_destroy', $gallery->id)}}" onclick="return confirm('Уверены?')" class="btn btn-danger">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
@endsection
