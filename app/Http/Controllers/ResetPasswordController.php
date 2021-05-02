<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use App\Mail\SendMess;
class ResetPasswordController extends Controller {

    public function reset(Request $request) {

        if ($request->email_reset) {
            $validatedData = $request->validate([
                'email_reset' => ['required', 'email']
                    ], [
                'email_reset.required' => 'Էլ. փոստը պարտադիր է լրացնել',
                'email_reset.email' => 'Էլ. փոստը վավեր չէ',
            ]);

            $email = $request->email_reset;
            $result = User::where('email', $email)->first();

            if (!empty($result)) {
                $remember = Str::random(60);

                User::where('email', $email)->update(['remember_token' => $remember]);
                $token = "<a href='https://dasaxos.am/hy/update-password/$remember'>https://dasaxos.am/hy/update-password/$remember</a>";
                

                
                Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "<img src='https://dasaxos.am/dasaxos.jpg'><pre>Ձեր գաղտնաբառը վերականգնելու համար հետևեք այս հղմանը $token:

Для восстановления вашего пароля перейдите по следующей ссылке $token.

To recover your password, go to the following link $token."], function ($message) use($email) {
                    $message->to($email)->subject('Գաղտնաբառի վերականգնումը/Восстановление пароля/ Password recovery');
                });

                return redirect()->back()->with('success', 'Ստուգեք Ձեր էլ. փոստը');
            } else {
                return redirect()->back()->with('error', 'Մուտքագրեք ձեր էլ փոստ, որով գրանցված եք');
            }
        } else {
            return view('reset');
        }
    }

    public function resetpassword(Request $request) {

     
            $validatedData = $request->validate([
                'email_reset' => ['required'],
                'password_reset' => ['required', 'min:6'],
                'repeat_password_reset' => ['required', 'min:6'],
                    ], [
                'email_reset.required' => 'Էլ. փոստը պարտադիր է լրացնել',
                'password_reset.required' => 'Գաղտնաբառը պարտադիր է լրացնել',
                'password_reset.min' => 'Գաղտնաբառի դաշտը պետք է պարունակի 6 նիշ',
                'repeat_password_reset.required' => 'Գաղտնաբառը պարտադիր է լրացնել',
                'repeat_password_reset.min' => 'Գաղտնաբառի դաշտը պետք է պարունակի 6 նիշ',
            ]);

            $token = $request->link;
            $email = $request->email_reset;
            $password_reset = $request->password_reset;
            $repeat_pass_reset = $request->repeat_password_reset;
             
            if ($password_reset == $repeat_pass_reset) {

                $data = User::where('remember_token', $token)->where('email', $email)->first();
                
                if (empty($data)) {
                    return redirect()->back()->with('error', 'Խնդրում ենք կրկին փորձել:');
                } else {
                    $remember = Str::random(60);
                    User::where('remember_token', $token)->where('email',$email)->update([
                        'password' => Hash::make($password_reset),
                        'remember_token' => $remember
                    ]);
                    $email = $data['email'];
                     Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "<img src='https://dasaxos.am/dasaxos.jpg'><pre>
Բարև՛ Ձեզ: Դուք հայցել եք dasaxos.am-ի անձնական սենյակի գաղտնաբառի վերականգնումը: Գաղտնաբառը հաջողությամբ վերականգնվել է: 
Вы запросили восстановление пароля от личного кабинета dasaxos.am. Пароль успешно восставлен. 
You have requested password recovery from your dasaxos.am personal account. The password was successfully recovered."], function ($message) use($email) {
                        $message->to($email)->subject('Գաղտնաբառը վերականգնվել է/ Пароль восстановлен / The password was recovered');
                    });
                    
                    
                    return redirect()->back()->with('success', 'Գաղտանաբառը փոփոխված է:');;
                }
            } else {
                return redirect()->back()->with('error', 'Գաղտնաբառերը չեն համընկնում:');
            }
        
    }

}
