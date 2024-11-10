<?php
namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest{
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
            'placeholder_image' => 'nullable',
            'large_thumb_image_width' => 'required',
            'large_thumb_image_height' => 'required',
            'medium_thumb_image_width' => 'required',
            'medium_thumb_image_height' => 'required',
            'small_thumb_image_width' => 'required',
            'small_thumb_image_height' => 'required'
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
            'large_thumb_image_width.*' => 'Large thumb image width is required',
            'large_thumb_image_height.*' => 'Large thumb image height is required',
            'medium_thumb_image_width.*' => 'Medium thumb image width is required',
            'medium_thumb_image_height.*' => 'medium thumb image width is required',
            'small_thumb_image_width.*' => 'Small thumb image width is required',
            'small_thumb_image_height.*' => 'Small thumb image width is required'
        ];
    }
}