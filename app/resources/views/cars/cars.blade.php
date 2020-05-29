@extends('master')


@section('content')
    <ul class="list-group list-group-flush">
        @foreach($cars as $car)
            <li class="list-group-item">
                <h1>Номер машины: {{$car->number}}</h1>
                <div>
                    <a href="{{route('cars.show',['id' => $car->id])}}" class="btn btn-info">More</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

