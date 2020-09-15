<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveFormRequest extends FormRequest
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
            'day_off' => 'required|after:'.Date('d-m-Y'),
            'content' => 'required|string'
        ];
    }

    public function messages(){
        return [
            'day_off.after' => 'Ngày viết đơn phải sau ngày hiện tại',
        ];
    }
}
