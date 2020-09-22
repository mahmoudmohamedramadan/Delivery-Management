<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;

class CarAjaxController extends Controller
{
    public function store()
    {
        $car = \App\Models\Car::create( $this->validation() );
        if( $car ) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return $car;
        }
    }
    public function update($id)
    {
        $car = \App\Models\Car::findOrFail( $id );
        if( $car ) {
            $car->update( $this->validation() );
            return response()->json([
                'status' => true
            ]);
        } else {
            return $car;
        }
    }
    public function destroy($id)
    {
        $car = \App\Models\car::findOrFail( $id );
        if( $car ) {
            $car->delete();
            return response()->json([
                'status' => true
            ]);
        } else {
            return $car;
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
