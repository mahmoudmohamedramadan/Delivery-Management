<?php

namespace App\Http\Controllers\Mechanic;

use App\Models\Mechanic;
use App\Http\Controllers\Controller;

class MechanicController extends Controller
{
    public function index()
    {
        // data passed using View Composer in boot method(Second Way).
        return view('project.mechanic.index_mechanic');
    }

    public function create()
    {
        return view('project.mechanic.create_mechanic');
    }

    public function store()
    {
        Mechanic::create($this->validation());

        return redirect()->to('/index/mechanic/create')
            ->with('message', 'data saved successfully');
    }

    public function edit($id)
    {
        $mechanic = Mechanic::findOrFail($id);

        return view('project.mechanic.edit_mechanic', compact('mechanic'));
    }

    public function update($id)
    {
        Mechanic::findOrFail($id)->update($this->validation());
        
        return redirect()->to('/index/mechanic')
            ->with('message', 'data updated successfully');
    }

    public function validation()
    {
        return request()->validate([
            'name' => 'required|unique:mechanics,name',
            'address' => 'required|max:255',
        ]);
    }
}
