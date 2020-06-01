@extends('master')


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
    <form class="form" action="{{route('store')}}" method="post">
        @csrf
        <div class="form-group">
            <p>Название:</p><input class="input form-control" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <p>Адрес:</p><input class="input form-control" type="text" name="address" value="{{old('address')}}">
        </div>
        <div class="form-group">
            <p>График работы:</p><input class="input form-control" type="text" name="work_time" value="{{old('work_time')}}">
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
                    <tr class="list">
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="submit" class="btn btn-success" value="Сохранить">
    </form>
    @include('inc.js')
@endsection
