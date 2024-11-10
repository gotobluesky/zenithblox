<?php

namespace Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        $comment_setting = commentFormSettings();

        if ($comment_setting['require_name_email'] == '1') {
            return [
                'id' => 'required|numeric',
                'user_name' => 'required|max:50',
                'user_email' => 'required|email',
                'user_website' => 'nullable',
                'comment' => 'required',
                'status' => ['required',Rule::in(config('settings.blog_comment_status_name'))],
                'comment_date' => 'required',
            ];
        }else{
            return [
                'id' => 'required|numeric',
                'user_name' => 'nullable|max:50',
                'user_email' => 'nullable|email',
                'user_website' => 'nullable',
                'comment' => 'required',
                'status' => ['required',Rule::in(config('settings.blog_comment_status_name'))],
                'comment_date' => 'required',
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
            'id.required' =>  translate('Blog Update Failed'),
            'id.numeric' =>  translate('Blog Update Failed'),
            'user_name.required' => translate('Please Insert Author Name'),
            'user_name.max' => translate('Author Maximum Length is 50'),
            'user_email.required' => translate('Please Insert Author Email'),
            'user_email.email' => translate('Email is not valid'),
            'comment.required' => translate('Please Write Some Comment'),
            'status.*' => translate('Comment Status is Required'),
            'comment_date.required' => translate('Submitted Field Must not be Empty'),
        ];
    }
}
