<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autopark;

class AutoparkController extends Controller
{
    public function index()
    {
        $depo = Autopark::get();
        return view('autoparks.autoparks', compact('depo'));
    }


    public function show($id)
    {
        $autopark = Autopark::find($id);
        return view('autoparks.autopark-details', compact('autopark'));
    }


}
