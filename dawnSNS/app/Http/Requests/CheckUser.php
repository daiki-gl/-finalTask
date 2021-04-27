<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username' => 'required|string|max:255|min:4',
            'mail' => 'required|string|email|max:255|min:4|unique:users',
            'password' => 'required|string|max:255|min:4|confirmed',
            'password-confirm' => 'required|string|max:255|min:4|confirmed',
        ];
    }

     /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'username is required',
            'mail.required'  => 'mail is required',
            'password.required'  => 'password is required',
            'password-confirm.required'  => 'password-confirm is required',
        ];
    }
}
