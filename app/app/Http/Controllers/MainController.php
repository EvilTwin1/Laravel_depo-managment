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

        if ($request->input('number') === null){
            $autopark = Autopark::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'work_time' => $request->input('work_time'),
            ]);
        }else{
            $autopark = Autopark::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'work_time' => $request->input('work_time'),
            ]);

            $counter = count($request->input('number'));
            for ($i = 0; $i < $counter; $i++) {
                $car = Car::create(['number' => $request->input("number.$i"), 'driver_name' => $request->input("driver_name.$i")]);
                $carObj[] = $car;
            }

            foreach ($carObj as $obj) {
                $autopark->cars()->syncWithoutDetaching($obj->id);
            }
        }

        return redirect(route('autoparks'))->with('status', 'Автопарк создан!');
    }


    public function destroy($id)
    {
        Autopark::find($id)->delete();
        return redirect()->back()->with('status', 'Автопарк удален!');
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

        $counter = count($request->input('number'));
        for ($i = 0; $i < $counter; $i++) {
            $car = new Car;
//            $car=  Car::where(['number' => $request->input("number.$i"), 'driver_name' => $request->input("driver_name.$i")]);
            $car->updateOrCreate(
                ['number' => $request->input("id.$i")],
                ['number' => $request->input("number.$i"), 'driver_name' => $request->input("driver_name.$i")]
            );
//            $car->fill(
//                [
//                    'number' => $request->input("number.$i"),
//                    'driver_name' => $request->input("driver_name.$i")
//                ]
//            );
            $car->updateOrCreate(
                ['id' => $request->input("id.$i")],
                ['number' => $request->input("number.$i"), 'driver_name' => $request->input("driver_name.$i")]
            );
            $carObj[] = $car;
        }


        $autopark = Autopark::find($id);
        $autopark->fill(
            [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'work_time' => $request->input('work_time'),

            ]);
        $autopark->save();


        foreach ($carObj as $obj) {
//            $autopark->cars()->sync($obj->id);
            dd($obj);
            $autopark->cars()->syncWithoutDetaching($obj->id);
        }

        return redirect()->back();
    }

}
