<?php
namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest{
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
        if(!request('id')){
            return [
                'name' => 'required|unique:tl_users,name,'.request('id'),
                'email' => 'required|unique:tl_users,name,'.request('id'),
                'pro_pic' => 'required',
                'role' => 'required',
                'password' => 'required|confirmed|min:6'
            ];
        }
        else{
            if(request('is_for_profile')){
                if(request('password')!=null || request('password_confirmation')!=null || request('old_password')!=null){
                    return [
                        'name' => 'required|unique:tl_users,name,'.request('id'),
                        'email' => 'required|unique:tl_users,name,'.request('id'),
                        'bio' => 'max:200',
                        'pro_pic' => 'nullable',
                        'old_password' => 'required|min:6',
                        'password' => 'required|confirmed|min:6'
                    ];
                }
                else{
                    return [
                        'name' => 'required|unique:tl_users,name,'.request('id'),
                        'email' => 'required|unique:tl_users,name,'.request('id'),
                        'bio' => 'max:200',
                        'pro_pic' => 'nullable'
                    ];
                }
            }
            else{
                return [
                    'name' => 'required|unique:tl_users,name,'.request('id'),
                    'email' => 'required|unique:tl_users,name,'.request('id'),
                    'pro_pic' => 'nullable'
                ];
            }
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pro_pic.required' => translate('Profile pic is required'),
            'pro_pic.mimes' => translate('Invalid selection')
        ];
    }
}