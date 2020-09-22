<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DelegateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'   => 'required', 'national_id' => 'required|numeric',
      'phone'  => 'required|numeric', 'motor_size' => 'required|numeric',
      'car_id' => 'required', 'made_date' => 'required',
      'image'  => 'sometimes|file|image|max:2000|unique:delegates,image'
    ];
  }

  public function messages()
  {
    return [
      'name.required'        => __('delegate_validation.name'),
      'national_id.required' => __('delegate_validation.national_id'),
      'phone.required'       => __('delegate_validation.phone'),
      'motor_size.required'  => __('delegate_validation.motor_size'),
      'car_type.required'    => __('delegate_validation.car_type'),
      'made_date.required'   => __('delegate_validation.made_date')
      // remember to change fallback_locale in app.php
    ];
  }
}
