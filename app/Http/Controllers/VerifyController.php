<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    //

    public function index($lang,$token){
        $user= User::where('remember_token',$token)->first();
        $email = $user->email;
        
        if(!empty($user)){
            $new_token=Str::random(60);
            User::where('remember_token',$token)->where('email',$user->email)->update([
                "email_verify_date"=> Carbon::now(),
                "remember_token"=> $new_token,
            ]);
            $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Բարև՛ Ձեզ:
Շնորհակալություն dasaxos.am կայքում գրանցվելու համար: 
Ձեր անկետայի ստուգումն ավարտված է:
Անձնական սենյակ մուտք գործելուց հետո անհրաժեշտ է ընթերցել համագործակցության պայմանները: 
Ուսանողների նոր հարցումները Դուք կարող տեսնել « Նոր հարցումներ» բաժնում:
Հուսանք, մեր համագործակցությունը կլինի բեղմնավոր և արդյունավետ:
Здравствуйте!
Спасибо, что зарегистрировались на сайте dasaxos.am  
Проверка Вашей анкеты завершена.
После того, как Вы зайдете в личный кабинет на сайте, необходимо прочитать условия сотрудничества.
Новые заявки от учеников можно просматривать на странице «Новые заявки».
Надеемся на плодотворное сотрудничество!
Hello! 
Thank you for registering on dasaxos.am 
The verification of your profile is completed. 
After you enter your personal account on the site, you must read the terms of cooperation. 
New student applications can be viewed on the New Applications page. 
We hope for fruitful cooperation!';
                Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
                $message->to($email)->subject('Շնորհակալություն գրանցվելու համար/Спасибо за регистрацию/ Thank you for registering');
                });
//            Auth::loginUsingId($find->id, TRUE);
            $user_find = User::find($user->id);
            Auth::login($user_find);
            return redirect()->route('account',$lang)->with('success', 'Ձեր էլ փոստը հաստատված է');;
        }

    }
    
    public function resend($lang){
        $remember = Str::random(60);
        $email=Auth::user()->email;
        User::where('email', $email)->update(['remember_token' => $remember]);
        $token = "<a href='https://dasaxos.am/hy/verify/$remember'>https://dasaxos.am/hy/verify/$remember</a>";

        Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "
<img src='https://dasaxos.am/dasaxos.jpg'><pre>Էլ. փոստի հաստատում
Բարև՛ Ձեզ: Խնդրում ենք հաստատել Ձեր էլ. փոստը՝ անցում կատարելով հետևյալ հղումով՝ $token
Եթե Ձեզ մոտ չստացվեց հաստատել էլ. փոստը, պատճենե՛ք նշված հղումը և տեղադրե՛ք դիտարկիչի (բրաուզերի) հասցեի տողում:

Подтверждение email
Здравствуйте! Пожалуйста, подтвердите ваш email, перейдя по ссылке $token.

Если у вас не получается подтвердить email, скопируйте данную ссылку и вставьте в адресную строку браузера:

Email confirmation
Hello! Please confirm your email by following the link $token.

If you are unable to verify your email, copy this link and paste it into your browser address bar"], function ($message) use($email) {
            $message->to($email)->subject('Էլ. փոստի հաստատում/ Подтверждение email/ Email confirmation');
        });
 
            return redirect()->back();
        }

}

