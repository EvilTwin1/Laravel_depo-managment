@extends('master')


@section('content')
    <ul class="list-group list-group-flush">
        @foreach($depo as $dep)
            <li class="list-group-item">
                <h2>{{$dep->name}}</h2>
                <a href="{{route('autoparks.show',['id' => $dep->id])}}" class="btn btn-info">Детали</a>
                <a href="{{route('edit',['id' => $dep->id])}}" class="btn btn-warning">Редактировать</a>
                <form action="{{ route('destroy',$dep->id) }}" method="post" style="display: initial">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </li>
        @endforeach
    </ul>
@endsection

