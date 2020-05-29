@extends('master')


@section('content')
    <div class="card" >
        <div class="card-header">
            <h1>{{$autopark->name}}</h1>
            <p>Адрес: {{$autopark->address}}</p>
            <p>Время работы: {{$autopark->work_time}}</p>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($autopark->cars as $car)
                <li class="list-group-item">
                    <p>Номер машины: {{$car->number}}</p>
                    <p>Имя водителя: {{$car->driver_name}}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

