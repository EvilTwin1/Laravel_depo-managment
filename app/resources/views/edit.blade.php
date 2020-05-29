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
    <form action="{{route('update',$autopark->id)}}" method="post">
        @csrf
        <label for=""><input type="hidden" name="name" value="{{$autopark->id}}"></label><br>
        <label for="">Название: <input type="text" name="name" value="{{$autopark->name}}"></label><br>
        <label for="">Адрес: <input type="text" name="address" value="{{$autopark->address}}"></label><br>
        <label for="">График работы: <input type="text" name="work_time" value="{{$autopark->work_time}}"></label><br>
        <hr>
        <a href="#" id="add_btn">+</a>
        <div class="form-group">
            @foreach($cars as $car)
                <div class="list">
                    <input type="hidden" name="hidden-number[]" value="{{$car->number}}">
                    <input type="hidden" name="hidden-name[]" value="{{$car->driver_name}}">
                    <label for="">Номер машины: <input type="text" name="number[]" value="{{$car->number}}"></label>
                    <label for="">Имя водителя: <input type="text" name="driver_name[]" value="{{$car->driver_name}}"></label>
                    <p class="btn btn-danger delete" data-autopark_id="{{$autopark->id}}" data-car_id="{{$car->id}}">Удалить</p>
                </div>
            @endforeach
        </div>
        <input type="submit" class="btn btn-success" value="Сохранить">
    </form>
{{--    <p class="delete" data-autopark_id="{{$autopark->id}}" data-car_id="{{$car->id}}">x</p>--}}
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script>
        $(document).on("click", ".delete" , function() {
            var car_id = $(this).data('car_id');
            var autopark_id = $(this).data('autopark_id');
            var el = this;
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '/car/destroy/'+autopark_id+'/'+car_id,
                type: 'get',
                data:{
                    _toket: token
                },
                success: function(response){
                    $(el).closest( ".list" ).remove();
                    // alert(response);
                }
            });
        });

        $(document).ready(function () {
            $('#add_btn').on('click', function () {
                var html = '';
                html += '<div class="list">';
                html += '<input type="hidden" name="hidden-number[]">';
                html += '<label for="">Номер машины<input type="text" name="number[]"></label>';
                html += '<label for="">Имя водителя<input type="text" name="driver_name[]"></label>';
                html += '<a href="#" id="remove_btn">x</a>';
                html += '</div>';
                $('.form-group').append(html);
            });
        });

        $(document).on('click', '#remove_btn', function () {
            $(this).closest('.list').remove();
        });
    </script>
@endsection

