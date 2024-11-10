<?php

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestEmailRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
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
            'email.required' => translate('Email is required'),
            'subject.required' => translate('Subject is required'),
            'message.required' => translate('Message is required'),
        ];
    }
}
