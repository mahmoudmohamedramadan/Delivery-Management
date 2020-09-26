<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarAjaxController extends Controller
{
    public function store()
    {
        Car::create($this->validation());
        return response()->json([
            'status' => true
        ]);
    }

    public function update($id)
    {
        Car::findOrFail($id)->update($this->validation());
        return response()->json([
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function validation()
    {
        return request()->validate([
            'type' => 'required',
            'char' => 'required|numeric',
            'number' => 'required|numeric',
            'mechanic_id' => 'required'
        ]);
    }
}
