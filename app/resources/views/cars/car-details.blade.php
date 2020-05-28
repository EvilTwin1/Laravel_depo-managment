@extends('master')

@section('content')
    <div class="card" >
        <div class="card-header">
            <h1>Номер машины: {{$car->number}}</h1>
            <p>Nмя водителя: {{$car->driver_name}}</p>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($car->autoparks as $autopark)
                <li class="list-group-item">
                    <p>Название автопарка: {{$autopark->name}}</p>
                    <p>Адрес: {{$autopark->address}}</p>
                    <p>Время работы: {{$autopark->work_time}}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
