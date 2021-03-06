<?php

namespace App\Http\Requests\Assistant;

use App\Http\Requests\Request;

class CreateAssistantRequest extends Request
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
            'user_id' => 'required|exists:users,id|unique:assistants',
        ];
    }

    /**
     * Set custom error messages for predefined rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required'      => 'ID User harus diisi.',
            'user_id.exists'        => 'User tidak terdaftar.',
            'user_id.unique'        => 'User sudah merupakan asisten.',
        ];
    }
}
