@extends('master')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Автопарки</h2>
    <form class="form" action="{{route('update',$autopark->id)}}" method="post">
        @csrf
        <input type="hidden" name="name" value="{{$autopark->id}}">
        <div class="form-group">
            <p>Название:</p><input class="input form-control" type="text" name="name" value="{{$autopark->name}}">
        </div>
        <div class="form-group">
            <p>Адрес:</p><input class="input form-control" type="text" name="address" value="{{$autopark->address}}">
        </div>
        <div class="form-group">
            <p>График работы:</p><input class="input form-control" type="text" name="work_time" value="{{$autopark->work_time}}">
        </div>
        <hr>
        <h2>Машины</h2>
        <p class="btn btn-success delete" id="add_btn">Добавить</p>
        <div class="car-wrapp">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Номер машины</th>
                    <th scope="col">Имя водителя</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr class="list">
                        <td>
                            <input type="hidden" name="hidden-number[]" value="{{$car->number}}">
                            <input type="hidden" name="hidden-name[]" value="{{$car->driver_name}}">
                            <input class="form-control" type="text" name="number[]" value="{{$car->number}}">
                        </td>
                        <td>
                            <input class="form-control" type="text" name="driver_name[]" value="{{$car->driver_name}}">
                        </td>
                        <td>
                            <p class="btn btn-danger delete" data-autopark_id="{{$autopark->id}}" data-car_id="{{$car->id}}">Удалить</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <input type="submit" class="btn btn-success" value="Сохранить">
    </form>
    @include('inc.js')
@endsection
