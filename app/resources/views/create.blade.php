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
    <form action="{{route('store')}}" method="post">
        @csrf
        <label for="">Название:
            <input type="text" name="name" value="{{old('name')}}">
        </label><br>
        <label for="">Адрес:
            <input type="text" name="address" value="{{old('address')}}">
        </label><br>
        <label for="">График работы:
            <input type="text" name="work_time" value="{{old('work_time')}}">
        </label><br>
        <hr>
        <a href="#" class="btn btn-info" id="add_btn">Добавить машину</a>
        <div class="form-group">
            <div class="list"></div>
        </div>
        <input type="submit" class="btn btn-success" value="Сохранить">
    </form>
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#add_btn').on('click', function () {
                var html = '';
                html += '<div class="list">';
                html += '<label for="">Номер машины<input type="text" name="number[]"></label>';
                html += '<label for="">Имя водителя<input type="text" name="driver_name[]"></label>';
                html += '<a href="#" class="btn btn-danger" id="remove_btn">x</a>';
                html += '</div>';
                $('.form-group').append(html);
            })
        });
        $(document).on('click', '#remove_btn', function () {
            $(this).closest('.list').remove();
        });

    </script>
@endsection


