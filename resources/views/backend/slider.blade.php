@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Слайдеры</h1>
            <a href="{{route('slider_create')}}" class="btn btn-success">Добавить слайдер</a>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sliders as $slider)
                    <tr>
                        <td>
                            {{ $slider->id }}
                        </td>
                        <td>
                            {{$slider->name}}
                        </td>
                        <td>
                            <a href="{{route('slider_edit', $slider->id)}}" class="btn btn-primary">Редактировать</a>
                            <a href="{{route('slider_destroy', $slider->id)}}" onclick="return confirm('Уверены?')" class="btn btn-danger">Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
