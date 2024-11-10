<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'purchase_code' => 'required',
            'zip_file' => 'required|mimes:zip'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'purchase_code.required' => translate('Purchase code is required'),
            'zip_file.required' => translate('Zip file is required'),
            'zip_file.mimes' => translate('Zip file must be zip format'),
        ];
    }
}
