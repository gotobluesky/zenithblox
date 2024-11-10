<?php
namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageInfoUpdateRequest extends FormRequest{
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
            'system_name' => 'required',
            
            'black_background_logo' => 'nullable|mimes:jpg,png,svg,jpeg,bmp',
            'black_mobile_background_logo' => 'nullable|mimes:jpg,png,svg,jpeg,bmp',
            'white_background_logo' => 'nullable|mimes:jpg,png,svg,jpeg,bmp',
            'white_mobile_background_logo' => 'nullable|mimes:jpg,png,svg,jpeg,bmp',
            
            'favicon' => 'nullable|mimes:jpg,png,svg,jpeg,bmp',
            'default_language' => 'required',
            'default_timezone' => 'required',
            'decimal_number_limit' => 'required'
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
            'system_name.*' => 'Please give a system name',
            
            'black_background_logo.*' => 'Please give a valid logo for black background',
            'black_mobile_background_logo.*' => 'Please give a valid logo for black background',
            'white_background_logo.*' => 'Please give a valid logo for white background',
            'white_mobile_background_logo.*' => 'Please give a valid logo for white background',
            
            'favicon.*' => 'Please give a valid favicon',
            'default_language.*' => 'Invalid language selection',
            'default_timezone.*' => 'Invalid timezone selection',
            'decimal_number_limit.*' => 'Please give a valid limit'
        ];
    }
}