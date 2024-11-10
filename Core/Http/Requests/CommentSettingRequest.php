<?php

namespace Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommentSettingRequest extends FormRequest
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
            'close_comments_days_old' => 'nullable|integer|min:1',
            'thread_comments_level' => 'nullable|integer|between:2,10',
            'comments_per_page' => 'nullable|integer|min:8',
            'default_comments_page' => 'nullable|integer|between:1,2',
            'comment_order' => 'nullable|integer|between:1,2',
            'comment_max_links' => 'integer|min:1',
            'avatar_default' =>['nullable',Rule::in(config('settings.blog_comment_default_avatar'))],
        ];
    }


    /**
     * Custom message
     * 
     * @return array
     */
    public function messages()
    {
        return  [
            'close_comments_days_old.integer' =>  translate('Please Enter a Valid Number for Comment Close Days.'),
            'close_comments_days_old.min' =>  translate('The Minimum Number for Comment Close Days is 1'),
            'thread_comments_level.*' =>  translate('Please Select a valid option for Comment Threads Level'),
            'comments_per_page.integer' =>  translate('Please Enter a Valid Number for Per Page Comment'),
            'comments_per_page.min' =>  translate('The Minimum Comments for per Page is 8'),
            'default_comments_page.*' =>  translate('Please Select a valid option for Default Comment Page'),
            'comment_order.*' =>  translate('Please Select a valid option for Comment order'),
            'comment_max_links.integer' =>  translate('Please Enter a Valid Number for Comment links'),
            'comment_max_links.min' =>  translate('The Minimum Comment links number must be 1'),
            'avatar_default.*' => translate('Please Select a valid Default Avatar'),
        ];
    }
}
