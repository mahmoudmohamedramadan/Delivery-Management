<?php

namespace App\Traits\Delegate;

trait ValidateDelegateTrait
{
    public function validation()
    {
        return request()->validate([
            'name' => 'required', 'national_id' => 'required|numeric',
            'phone' => 'required|numeric', 'motor_size' => 'required|numeric',
            'car_id' => 'required', 'made_date' => 'required',
            'image' => 'sometimes|file|image|max: 2000|unique:delegates,image',
        ]);
    }
}
