<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $arr = [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'user_type' => ['required', 'in:member,manager'],
            
        ];
        if($this->user_type == 'member'){
            $arr['role'] = 'required|string';
            $arr['salary'] = 'required|numeric';
            $arr['date_start'] = 'required|date';
            $arr['date_end'] = 'required|after:date_start';
        }
        return $arr;
    }
}
