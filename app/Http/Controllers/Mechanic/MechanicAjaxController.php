<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Mechanic;

class MechanicAjaxController extends Controller
{
    public function store()
    {
        Mechanic::create($this->validation());
        return response()->json([
            'status' => true,
        ]);
    }

    public function update($id)
    {
        Mechanic::findOrFail($id)->update(request()->all());
        return response()->json([
            'status' => true,
        ]);
    }

    public function destroy($id)
    {
        Mechanic::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
        ]);
    }

    public function validation()
    {
        return request()->validate([
            'name' => 'required', 'address' => 'required',
        ]);
    }
}
