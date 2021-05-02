<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Blog;
use App\Subject;
use App\City;
use App\PagesView;
use App\Region;
use App\User;
use App\Comment;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;

class MenuController extends Controller {
    
    /* subjects in random order */
    public function index() {
      
    $firstDay = Carbon::now()->startOfMonth()->toDateString();
    PagesView::where("view_date","<",$firstDay)->delete();
 
        if(Auth::check() && Auth::user()->user_role == 1){
           return redirect()->intended('/admin/dashboard/blogs');
        }
        
        $background = DB::table("other")->select()->where('property','=','background')->first();
        $bottom_img = DB::table("other")->select()->where('property','=','bottom_img')->first();
        $slider = DB::table("other")->select()->where('property','=','slider')->get()->toArray();

        $blogs = Blog::all();
        $regions = Region::all();
        $cities = City::all();
        $subjects = Subject::all();
        $subjects_school = Subject::where('school_subjects',1)->inRandomOrder()->paginate(4);
        $subjects_foreign = Subject::where('foreign_langs',1)->inRandomOrder()->paginate(4);
        $subjects_final = Subject::where('final_entrance',1)->inRandomOrder()->paginate(4);
        $subjects_student = Subject::where('for_students',1)->inRandomOrder()->paginate(4);
        $subjects_other = Subject::where('other',1)->inRandomOrder()->paginate(4);
        $comment = Comment::where('avg_value','>','3.9')->where("preview",1)->inRandomOrder()->paginate(6);
//        $teachers = Comment::select("comments.*","users.*","users.id as userId","subjects.*","subjects.id as subjectId")->leftjoin("users","users.id","=","comments.user_id")
 //               ->leftjoin("subjects","subjects.id","=","comments.subject_id")->groupby('users.id')->paginate(12);
        $teachers = User::select("users.*","users.id as userId","price_lists.*","price_lists.id as priceId","subjects.*","subjects.id as subjectId")->leftjoin("price_lists","users.id","=","price_lists.user_id")
                ->leftjoin("subjects","subjects.id","=","price_lists.subject_id")->where("users.user_active","=",1)->where("users.user_role","=",0)->groupby('users.id')->get();
        
        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');
        
        $rates = [];
        foreach ($all_rating as $key => $value){
           $rates[$value->user_id] = $value->teacher_val;
        }
        
        $meta_tags= DB::table('meta_tags')->where('page','home')->first();

         return view('welcome',[
             'blogs' => $blogs,
             'subjects' => $subjects,
             'subjects_school' => $subjects_school,
             'subjects_foreign' => $subjects_foreign,
             'subjects_final' => $subjects_final,
             'subjects_student' => $subjects_student,
             'subjects_other' => $subjects_other,
             'comment' => $comment,
             'rates' => $rates,
             'teachers' => $teachers,
             'regions' => $regions,
             'background' => $background,
             'bottom_img' => $bottom_img,
             'slider' => $slider,
             'cities' => $cities,
             'meta_tags'=> $meta_tags
                 ]);
    }
    
    
    public function contact(Request $request) {
        if (app()->getLocale() == 'ru') {
            $message = 'Ваше письмо отправлено';
            $name_req = 'Поле';
            $l_name_req = 'Поле';
            $email_req = 'Поле';
            $email_email = 'Поле';
            $phone_req = 'Поле';
        } elseif (app()->getLocale() == 'en') {
            $message = 'send';
            $name_req = 'Field';
            $l_name_req = 'Field';
            $email_req = 'Field';
            $email_email = 'Field';
            $phone_req = 'Field';
        } elseif (app()->getLocale() == 'hy') {
            $message = 'Նամակն ուղարկված է';
            $name_req = 'Պարտադիր է լրացնել անուն դաշտը';
            $l_name_req = 'Պարտադիր է լրացնել ազգանուն դաշտը';
            $email_req = 'Պարտադիր է լրացնել էլ․ փոստ դաշտը';
            $email_email = 'Էլ․ փոստը վավեր չէ';
            $phone_req = 'Պարտադիր է լրացնել հեռախոսահամար դաշտը';
        }

        $validatedData = $request->validate([
            'name' => ['required'],
            'l_name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
            'letter' => ['required'],
        ],[
            'name.required' => $name_req ,         
            'l_name.required' => $l_name_req ,        
            'email.required' => $email_req,         
            'email.email' => $email_email,      
            'phone.required' => $phone_req,               
            'letter.required' => $phone_req,         
        ]);
        
        
        ContactUs::insert([
            'name' => $request->name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'letter' => $request->letter,
            'ip' => \Request::ip()
        ]);
        
        $email = "dasaxos-am@mail.ru";
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Առկա է նոր հաղորդագրություն հետադարձ կապ բաժնում';
                Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
                $message->to($email)->subject('Նոր հարցում');
                });

        
        return redirect()->back()->with('success', $message);
    }
    
    public function contact_us() {
        $background = DB::table("other")->select()->where('property','=','background')->first();
        $meta_tags= DB::table('meta_tags')->where('page','contact')->first();

        return view('contact',['background'=>$background,'meta_tags'=>$meta_tags]);
    }
    
    public function subjects() {
        
        $subjects = Subject::all();
        $school_subjects = Subject::where("school_subjects",1)->get();
        $foreign_langs = Subject::where("foreign_langs",1)->get();
        $final_entrance = Subject::where("final_entrance",1)->get();
        $for_students = Subject::where("for_students",1)->get();
        $other = Subject::where("other",1)->get();
        $meta_tags= DB::table('meta_tags')->where('page','select_subject')->first();

        
        
        return view('subjects',['subjects'=>$subjects,
            'school_subjects'=>$school_subjects,
            'foreign_langs'=>$foreign_langs,
            'final_entrance'=>$final_entrance,
            'for_students'=>$for_students,
            'other'=>$other,
            'meta_tags'=>$meta_tags
                ]);
        
    }
    
    public function about() {
        $meta_tags= DB::table('meta_tags')->where('page','about')->first();
        $about_img = DB::table("other")->select()->where('property','=','about_img')->first();

        return view('about',['about_img'=>$about_img,'meta_tags'=>$meta_tags]);
        
    }

}
