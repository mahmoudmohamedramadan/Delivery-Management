<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::get();
        return view('project.car.index_car')->with('cars', $cars);
    }
    public function create()
    {
        $last_car = Car::max('id') + 1;
        $car_transaction = \App\Models\CarTransactoin::find($last_car);
        $mechanics = \App\Models\Mechanic::get();
        if ($mechanics && $car_transaction) {
            return view('project.car.create_car')->with([
                'error' => false,
                'payment_error' => false,
                'mechanics' => $mechanics,
            ]);
        } else if (!$car_transaction) {
            return view('project.car.create_car')->with([
                'error' => false,
                'payment_error' => true,
                'mechanics' => $mechanics,
            ]);
        } else {
            return view('project.car.create_car')->with([
                'error' => true,
                'payment_error' => true,
                'mechanics' => $mechanics,
            ]);
        }
    }

    public function store()
    {
        Car::create($this->validation());
        return redirect()->back()->with('message', 'data saved successfully');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $mechanics = \App\Models\Mechanic::get()->except($car->mechanic_id);
        return view('project.car.edit_car', compact('car', 'mechanics'));
    }

    public function update($id)
    {
        Car::findOrFail($id)->update($this->validation());
        return redirect()->to('/index/car');
    }

    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
    }

    public function validation()
    {
        return request()->validate([
            'type' => 'required',
            'char' => 'required|numeric',
            'number' => 'required|numeric',
            'mechanic_id' => 'required',
        ]);
    }
}
