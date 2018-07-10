<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '姓名不能为空',
            'email.required'  => '邮件地址不能为空',
            'password.required'  => '密码不能为空',
            'password.confirmed'  => '两次输入的密码不一致',
            'email.email'  => '请输入正确的邮箱地址',
            'password.min'  => '请输入至少6位密码',
        ];
    }






}
