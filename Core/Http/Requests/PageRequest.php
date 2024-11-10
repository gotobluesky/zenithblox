<?php

namespace Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PageRequest extends FormRequest
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
        if ($this->input('id')) {
            return [
                'title' => 'required|max:225||unique:tl_pages,title,' . $this->input('id'),
                'permalink' => 'required|unique:tl_pages,permalink,' . $this->input('id'),
                'content'  => 'nullable',
                'page_image' => 'nullable|exists:tl_uploaded_files,id',
                'meta_title' => 'nullable',
                'meta_description' => 'nullable',
                'meta_image' => 'nullable|exists:tl_uploaded_files,id',
                'visibility' => ['required', Rule::in(config('settings.visibility_status'))],
                'page_parent' => 'nullable|exists:tl_pages,id',
            ];
        } else {
            return [
                'title' => 'required|max:225||unique:tl_pages,title',
                'permalink' => 'required|unique:tl_pages,permalink',
                'page_image' => 'nullable|exists:tl_uploaded_files,id',
                'content'  => 'nullable',
                'meta_title' => 'nullable',
                'meta_description' => 'nullable',
                'meta_image' => 'nullable|exists:tl_uploaded_files,id',
                'visibility' => ['required', Rule::in(config('settings.visibility_status'))],
                'page_parent' => 'nullable|exists:tl_pages,id',
            ];
        }
    }


    /**
     * Custom message
     * 
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' =>  translate('Please Insert Page Title'),
            'title.unique' => translate('This Title is Already Available Please Insert Another'),
            'title.max' => translate('Please Write The Page Title under 225 words'),
            'permalink.unique' => translate('This Permalink is Already Available Please Insert Another'),
            'page_image.exists' => translate('Please Insert A Valid Image'),
            'meta_image.exists' => translate('Please Select a Valid Image'),
            'visibility.*' => translate('Something went Wrong, Please Select Visibility Again'),
            'page_parent.*' => translate('Something went Wrong, Please Select Parent Again'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->redirector->to($this->getRedirectUrl())
            ->withErrors($validator->getMessageBag())
            ->withInput()
            ->with('form-error', translate('Please check for missing field or invalid data and try again.')));
    }
}
