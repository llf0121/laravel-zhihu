<?php

namespace App\Service;
use App\User;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class EmailService
{

    public function sendRegisterEmail(User $user){
        // 模板变量
        $confirmation_token = str_random(40);
        $bind_data = [
            'url' => route('verify',['confirmation_token' =>$confirmation_token]),
            'name'=>$user->name
        ];
        $subject = 'zhihu.dev注册激活邮件';
        $template_name  = 'register_mail';
       return  $this->sendEmails($user,$bind_data,$template_name,$subject,$confirmation_token);
    }

    private function sendEmails(User $user,$bind_data,$template_name,$subject,$confirmation_token){
        $template = new SendCloudTemplate($template_name, $bind_data);
        $user->confirmation_token = $confirmation_token;
        $user->save();
       return  Mail::raw($template, function ($message) use ($user,$subject) {
            $message->to($user->email)->subject($subject);
        });
    }


}