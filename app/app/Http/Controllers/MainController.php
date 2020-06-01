<?php

namespace App\Http\Controllers;

use App\Autopark;
use App\Car;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        $autopark = Autopark::find($id);
        $cars = $autopark->cars;
        return view('edit', compact('autopark', 'cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'work_time' => 'required',
            'name' => 'required',
            'number.*' => 'required',
            'driver_name.*' => 'required',
        ]);

        // Если при создании автопарка нет машин,просто сохранить автопарк

        if ($request->input('number') === null){
            $autopark = Autopark::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'work_time' => $request->input('work_time'),
            ]);
        }else{

            // Если машины добавлены привязать их к автопарку

            $autopark = Autopark::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'work_time' => $request->input('work_time'),
            ]);

            // Перебираем все полученые данные о машинах

            $counter = count($request->input('number'));
            for ($i = 0; $i < $counter; $i++) {

                // Если машина существует, привязываем ее к автопарку

                $carExist = Car::where('number','=', $request->input("number.$i"))->first();
                if ($carExist && $request->input("number.$i") == $carExist->number){
                    $autopark->cars()->syncWithoutDetaching($carExist->id);
                }else {

                    // Если машина новая,сохраняем ее в базу данных и привязываем ее к автопарку

                    $car = new Car;
                    $car->fill([
                        'number' => $request->input("number.$i"),
                        'driver_name' => $request->input("driver_name.$i")
                    ]);
                    $car->save();
                    $autopark->cars()->syncWithoutDetaching($car->id);
                }
            }
        }

        return redirect(route('autoparks'))->with('status', 'Автопарк создан!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'work_time' => 'required',
            'number.*' => 'required',
            'driver_name.*' => 'required',
        ]);

        // Обновляем данные автопарка

        $autopark = Autopark::find($id);
        $autopark->fill([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'work_time' => $request->input('work_time'),
        ]);
        $autopark->save();

        // Перебираем все полученые данные о машинах

        $counter = count($request->input('number'));
        for ($i = 0; $i < $counter; $i++) {

            // Добавление новой машины на странице редактирования

            if ($request->input("hidden-number.$i") === null){

                // Если машина уже существует, привязываем ее к автопарку

                $carExist = Car::where('number','=', $request->input("number.$i"))->first();
                if ($carExist && $request->input("number.$i") == $carExist->number){
                    $autopark->cars()->syncWithoutDetaching($carExist->id);
                }else {

                    // Добавляем новую машину и привязываем к автопарку

                    $car = new Car;
                    $car->fill([
                        'number' => $request->input("number.$i"),
                        'driver_name' => $request->input("driver_name.$i")
                    ]);
                    $car->save();
                    $autopark->cars()->syncWithoutDetaching($car->id);
                }
            }else{

                // Если машина существует, обновляем ее данные

                $concurrenceNumber = $request->input("hidden-number.$i") != $request->input("number.$i");
                $concurrenceName = $request->input("hidden-name.$i") != $request->input("driver_name.$i");
                if ($concurrenceNumber || $concurrenceName){
                    $car=  Car::where(['number' => $request->input("hidden-number.$i"),'driver_name' => $request->input("hidden-name.$i")])->first();
                    $car->fill([
                        'number' => $request->input("number.$i"),
                        'driver_name' => $request->input("driver_name.$i")
                    ]);
                    $car->save();
                }
            }
        }

        return redirect()->back()->with('status', 'Автопарк обновлен!');
    }

    public function destroy($id)
    {
        Autopark::find($id)->delete();
        return redirect()->back()->with('status', 'Автопарк удален!');
    }

    public function destroyCar($autopark_id, $car_id)
    {
        $autopark = Autopark::find($autopark_id);
        $car = Car::find($car_id);

        $countRelation = count($car->autoparks);
        if ($countRelation == 1){
            Car::destroy($car_id);
        }else{
            $autopark->cars()->detach($car->id);
        }
    }
}


