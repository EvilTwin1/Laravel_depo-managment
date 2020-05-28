<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::get();
        return view('cars.cars', compact('cars'));
    }


    public function show($id)
    {
        $car = Car::find($id);
        return view('cars.car-details', compact('car'));
    }

}
