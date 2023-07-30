<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;
use App\Models\Delegate;
use App\Traits\Delegate\ValidateDelegateTrait;

class EditDelegate extends Component
{
    use ValidateDelegateTrait;

    public $delegate_id, $name, $national_id, $phone, $motor_size, $cars, $car_id, $made_date, $image;

    /* if you want use updated lifecycle hooks in snake case like car_id write
    method in pascal case without underscore to be CarId*/

    public function mount($id)
    {
        $delegate = Delegate::findOrFail($id);
        $this->fill([
            'delegate_id' => $id, 'name' => $delegate->name, 'national_id' => $delegate->national_id,
            'phone' => $delegate->phone, 'motor_size' => $delegate->motor_size,
            'car_id' => Car::find($delegate->car_id), 'cars' => Car::all(),
            'made_date' => $delegate->made_date, 'image' => $delegate->image,
        ]);
    }

    public function update($id)
    {
        $data = $this->validate([
            'name' => 'required', 'national_id' => 'required|numeric',
            'phone' => 'required|numeric', 'motor_size' => 'required|numeric',
            'car_id' => 'required', 'made_date' => 'required',
        ]);
        Delegate::findOrFail($id)->update($data);
        return $this->redirect('/index/delegate');
    }

    public function render()
    {
        return view('livewire.edit-delegate');
    }
}
