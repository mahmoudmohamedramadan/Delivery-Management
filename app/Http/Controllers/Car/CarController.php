<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index()
    {
        $cars = \App\Models\Car::get();
        return view('project.car.index_car')->with('cars', $cars);
    }
    public function create()
    {
        $last_car = \App\Models\Car::max('id') + 1;
        $car_transaction = \App\Models\CarTransactoin::find($last_car);
        $mechanics = \App\Models\Mechanic::get();
        if ($mechanics && $car_transaction) {
            return view('project.car.create_car')->with([
                'error' => false,
                'payment_error' => false,
                'mechanics' => $mechanics
            ]);
        } else if (!$car_transaction) {
            return view('project.car.create_car')->with([
                 'error' => false,
                'payment_error' => true,
                'mechanics' => $mechanics
            ]);
        } else {
            return view('project.car.create_car')->with([
                'error' => true,
                'payment_error' => true,
                'mechanics' => $mechanics
            ]);
        }
    }
    public function store()
    {
        \App\Models\Car::create($this->validation());
        return redirect()->back()->with('message', 'data saved successfully');
    }
    public function edit($id)
    {
        $car = \App\Models\Car::findOrFail($id);
        if ($car) {
            return view('project.car.edit_car', compact('car'));
        }
    }
    public function update($id)
    {
        $car = \App\Models\Car::findOrFail($id);
        if ($car) {
            $car->update($this->validation());
            return redirect()->to('/index/car');
        }
    }
    public function destroy($id)
    {
        $car = \App\Models\Car::findOrFail($id);
        if ($car) {
            $car->delete();
        }
    }
    public function validation()
    {
        $data = request()->validate([
            'type' => 'required|unique:cars,type',
            'char' => 'required|numeric',
            'number' => 'required|numeric|unique:cars,number',
            'mechanic_id' => 'required'
        ]);
        return $data;
    }
}
