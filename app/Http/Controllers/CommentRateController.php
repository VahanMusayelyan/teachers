<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\ContactTeacher;
use App\User;
use Illuminate\Support\Facades\Mail;
use DB;

class CommentRateController extends Controller
{
    public function show($lang,$id) {
        
        $comment = Comment::where("user_id",$id)->where("comments.preview", "1")->paginate(6);
        $user = User::select("users.name","users.l_name","users.id")->where("id",$id)->first();
        $meta_tags_comm= DB::table('meta_tags')->where('page','comment')->first();
        return view('teacher-comment',['comment'=>$comment,"user"=>$user,"meta_tags_comm"=>$meta_tags_comm]);
    }
    
    public function add_comment(Request $request) {
        if (app()->getLocale() == 'ru') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել ազգանունը';
            $comment = 'Պարտադիր է լրացնել մեկնաբանությունը';
        } elseif (app()->getLocale() == 'en') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել ազգանունը';
            $comment = 'Պարտադիր է լրացնել մեկնաբանությունը';
        } elseif (app()->getLocale() == 'hy') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել ազգանունը';
            $comment = 'Պարտադիր է լրացնել մեկնաբանությունը';
        }
        
          $validatedData = $request->validate([
            'name' => ['required'],
            'lastname' => ['required'],
            'comment' => ['required'],
        ],[
            'name.required' => $name_req,            
            'lastname.required' => $email_req,     
            'comment.required' => $comment    
        ]);

          if(empty($request->rate)){
              $avg = 0.00;
          }else{
              $avg = $request->rate;
          }
          
        Comment::insert([
            'user_id' => $request->teacher_number,
            'name' => $request->name,
            'l_name' => $request->lastname,
            'avg_value' => $avg,
            'comment' => $request->comment,
            'ip' => \Request::ip()
        ]);
        
       
        return redirect()->back();
    }
    
    public function contact_teacher(Request $request) {
        if (app()->getLocale() == 'ru') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $phone = 'Պարտադիր է լրացնել հեռախոսահամար';
        } elseif (app()->getLocale() == 'en') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $phone = 'Պարտադիր է լրացնել հեռախոսահամար';
        } elseif (app()->getLocale() == 'hy') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $phone = 'Պարտադիր է լրացնել հեռախոսահամար';
        }
        
        $validatedData = $request->validate([
            'name_lname' => ['required'],
            'phone' => ['required'],
        ],[
            'name_lname.required' => $name_req,            
            'phone.required' => $phone      
        ]);
        
        ContactTeacher::insert([
            'name_lname' => $request->name_lname,
            'phone' => $request->phone,
            'subject_id' => $request->subject_teacher,
            'user_id' => $request->teacher_number
        ]);
        
            
        
        $email = "dasaxos-am@mail.ru";
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Առկա է դասախոսի նոր հարցում';
                Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
                $message->to($email)->subject('Նոր հարցում');
                });

   
        
       
        return redirect()->back();
     //   return route('show',app()->getLocale(),$request->teacher_number);
    }
}
