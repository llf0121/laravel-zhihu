<?php

namespace App\Http\Controllers\Auth;

use App\Service\EmailService;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected  $emailService ;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmailService $emailService)
    {
        $this->middleware('guest');
        $this->emailService = $emailService;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            'name.required' => '姓名不能为空',
            'email.required'  => '邮件地址不能为空',
            'password.required'  => '密码不能为空',
            'password.confirmed'  => '两次输入的密码不一致',
            'email.email'  => '请输入正确的邮箱地址',
            'email.unique'  => '此邮箱已被占用',
            'password.min'  => '请输入至少6位密码',
        ]);
    }


    protected function create($request)
    {
        return  User::register($this->emailService,$request);
    }


}
