<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
          'name' => 'required|unique:companies,name',
          'manager' => 'required',
          'address' => 'required|max:25',
          'email' => 'required|unique:companies,email',
          'phone' => 'required|unique:companies,phone|email',
          'product_name' => 'required|max:25',
          'quantity' => 'required'
        ];
    }

    public function attributes()
    {
      return [
        'email' => 'email address'
      ];
    }
}
