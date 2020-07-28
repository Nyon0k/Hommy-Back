<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Republic;

class RepublicFormRequest extends FormRequest
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
            'name'=>'required|string|unique:republics,name',
            'adress'=>'required',
            'freeBedrooms'=>'required|min:1|numeric',
            'phone'=>'required|min:11|numeric',
            'price'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.alpha'=>'Nome deve conter apenas caracteres alfabeticos',
            'name.unique'=>'Este nome de republica ja existe',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
