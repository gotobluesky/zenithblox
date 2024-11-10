<?php
namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest{
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
            'role_name' => 'required|unique:roles,name,'.request('id'),
            'permissions' => 'required',
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
            'role_name.required' => translate('Role name is required'),
            'role_name.unique' => translate('Role name already exists'),
            'permissions.unique' => translate('Role permission required')
        ];
    }
}